<?php
include('../vendor/phpqrcode/qrlib.php');
/**************************************/
/**************************************/
/* FICHE */
/**************************************/
/**************************************/

/**
 * appel AJAX pour le comptage par etat
 */
function return_countByEtat()
{
    return countByEtat();
}

function return_count_fiches()
{
    return countBy([], null, "", "", "'CONFIRME','STOCK','RENDU','VENDU','PAYE'");
}

function return_num_max_fiches()
{
    return getNumMaxFiche();
}

/**
 * retourne la liste des marques connue pour la BAV, avec une base
 * triée par ordre alpha
 */
function return_list_marques()
{
    $tabMarques = [
        'TREK', 'SCOTT', 'CANNONDALE', 'GITANE', 'PEUGEOT', 'MERCIER', 'SUNN', 'GT', 'EXS', 'CERVELO', 'BIANCHI',
        'COLNAGO', 'KUOTA', 'BH', 'BMC', 'B\'TWIN', 'DECATHLON', 'CANYON', 'CKT', 'COMMENCAL', 'DIAMONDBACK', 'GIANT', 'KONA',
        'KTM', 'MBK', 'MERIDA', 'ORBEA', 'PINARELLO', 'RIDLEY', 'SPECIALIZED', 'TIME', 'WILLIER', 'LOOK'
    ];
    $tabRetour = array_merge($tabMarques, selectVue("v_marque", "obj_marque"));
    $tabRetour = array_unique($tabRetour);
    sort($tabRetour);
    return $tabRetour;
}

function return_list_tailles()
{
    $index = 0;
    for ($i = 34; $i < 62; $i += 2) {
        $tabMarques[$index++] = $i;
    }
    $tabRetour = array_merge($tabMarques, ['XS', 'S', 'M', 'L', 'XL', '10 pouces', '12 pouces', '14 pouces', '16 pouces', '20 pouces', '24 pouces']);
    //$tabRetour = array_merge($tabMarques, listUnique("bav_objet", "obj_taille"));
    $tabRetour = array_unique($tabRetour);
    sort($tabRetour);
    return $tabRetour;
}

/**
 * retourne la liste des modeles connus pour une marque donnée
 */
function return_list_modeles($marque)
{
    $tabRetour = get_modelesByMarques(strtoupper($marque));
    sort($tabRetour);
    return $tabRetour;
}

/**
 * appel AJAX pour la recherche d'une fiche avec son numero
 * si par trouvé, on initialise l'objet fiche avec le numero saisie
 */
function return_oneFicheByCode($id)
{
    $row = getOneFicheByCode($id);
    if ($row) {
        $row['obj_date_depot_FR'] = formateDateMYSQLtoFR($row['obj_date_depot'], true);
        $row['obj_date_achat_FR'] = formateDateMYSQLtoFR($row['obj_date_achat'], false);
        $row['cli_com'] = getCommission($row);
    } else {
        $row['obj_numero'] = $id;
    }
    return $row;
}

/**
 * recherche de la fiche avec son id_modif
 * utilisé pour les acces en REST
 * A priori inutile el AJAX
 */
function return_oneFicheByIdModif($id)
{
    $row = getOneFicheByIdModif($id);
    if ($row) {
        $row['obj_date_depot_FR'] = formateDateMYSQLtoFR($row['obj_date_depot'], true);
        $row['obj_date_achat_FR'] = formateDateMYSQLtoFR($row['obj_date_achat'], false);

        $row['cli_com'] = getCommission($row);
    }
    return $row;
}

/**
 * Recherche d'une fiche avec son ID
 */
function return_oneFiche($id)
{
    $row = getOneFiche($id);
    if ($row) {
        $row['obj_date_depot_FR'] = formateDateMYSQLtoFR($row['obj_date_depot'], true);
        $row['obj_date_achat_FR'] = formateDateMYSQLtoFR($row['obj_date_achat'], false);

        $row['cli_com'] = getCommission($row);
    }
    return $row;
}

/**
 * creation d'une fiche, complete
 * on doit retrouve le client et la fiche
 * en mode ADMIN :  creation directe et mise en STOCK
 * en mode CLIENT : creation en INIT avec un numero dans le 5000 et envoi d'un mail pour confirmer la creation
 */
function action_createFiche($data)
{
    extract($GLOBALS);
    $ADMIN = $INFO_APPLI['ADMIN'];

    $retour = [];
    try {
        $tabObj = tabToObject(string2Tab($data), "obj");
        $tabCli = tabToObject(string2Tab($data), "cli");

        // creation du client, si mel ou nom OK, on le recupere
        // on en normalement avec le mel uniquement
        // on a pas de cli_id
        //makeClient($tabCli);

        error_log("cli_id = " . $tabCli['cli_id']);
        if ($tabCli['cli_id'] != 0) {

            // en cas de creation, on reforce un update
            // en cas de client trouve par mel ou nom on prend compte les modifs possible
            // adresse ou nom si mel ok.
            //updateClient($tabCli);

            $tabObj['obj_id_vendeur'] = $tabCli['cli_id'];

            $tabObj['obj_id'] = 0;

            // on pousse la marque et le modele en capitale
            $tabObj['obj_marque'] = strtoupper($tabObj['obj_marque']);
            $tabObj['obj_modele'] = strtoupper($tabObj['obj_modele']);
            $tabObj['obj_couleur'] = strtoupper($tabObj['obj_couleur']);

            if ($ADMIN) {
                // creation du numero a partir de la base parametre pour la BAV
                makeNumeroFiche($INFO_APPLI['base_info'], $tabObj, false);
                // on passe en STOCK
                $tabObj['obj_etat'] = 'STOCK';
                // on valide le prix de vente
                $tabObj['obj_prix_vente'] = $tabObj['obj_prix_depot'];
                // date de creation
                $tabObj['obj_date_depot'] = date('y-m-d H:i:s');
            } else {
                $tabObj['obj_etat'] = 'CONFIRME';
                makeNumeroFiche($INFO_APPLI['base_info'], $tabObj, true);

                $tabObj['obj_modif_data'] = 1;
                $tabObj['obj_modif_vendeur'] = 1;
                $tabObj['obj_modif_stock'] = 1;

                updateFiche($tabObj);

                // creation du lien REST pour confirmer le depot
                // $tabPlus['lien_confirm'] = $CFG_URL . "/Actions/rest.php?a=C&id=" . $tabObj['obj_id_modif'];

                // // si pas de pri de depot, alors phrase de rappel
                // if ($tabObj['obj_prix_depot'] == "") {
                //     $tabPlus['obj_prix_depot'] = 'A renseigner le jour du dépôt dernier délai';
                //     $tabObj['obj_prix_depot'] == 0;
                // } else {
                //     $tabPlus['obj_prix_depot'] = $tabObj['obj_prix_depot'] . " €";
                // }

                // $tabPlus['titre'] = $INFO_APPLI['titre'];

                // $tabPlus['obj_date_achat_FR'] = formateDateMYSQLtoFR($fiche['obj_date_achat'], false);

                // // titre du mel
                // $titreMel = "Confirmation de votre dépôt à " . $INFO_APPLI['titre'];

                // // creation du message du mel
                // // template : html/mel_enregristrement.html
                // $message = makeMessage($titreMel, array_merge($tabObj, $tabCli, $tabPlus), "mel_enregistrement.html");
            }

            $tabObj['obj_numero_bav'] = $INFO_APPLI['numero_bav'];
            //        print_r($tabObj);
            // creation de la fiche
            $tabObj['obj_id'] = insertFiche($tabObj);

            $retour = 1;
        } else {
            return "ERREUR : problème de création du client";
        }
    } catch (Exception $e) {
        return "ERREUR " . $e->getMessage();
    }
    return $retour;
}

/**
 * renvoi d'un mel de confirmation
 * cas ou on voit ou recoit une fausse adresse mel, et pour relancer
 */
function action_reMelConfirme($id)
{
    extract($GLOBALS);
    $ADMIN = $INFO_APPLI['ADMIN'];

    $retour = "";
    try {
        // recherche de la fiche
        $fiche = return_oneFiche($id);
        if ($fiche['obj_id']) {

            // creation du lien de REST
            $tabPlus['lien_confirm'] = $CFG_URL . "/Actions/rest.php?a=C&id=" . $fiche['obj_id_modif'];

            if ($fiche['obj_prix_depot'] == "") {
                $tabPlus['obj_prix_depot'] = 'A renseigner le jour du dépôt dernier délai';
                $fiche['obj_prix_depot'] == 0;
            } else {
                $tabPlus['obj_prix_depot'] = $fiche['obj_prix_depot'] . " €";
            }
            $tabPlus['obj_date_achat_FR'] = formateDateMYSQLtoFR($fiche['obj_date_achat'], false);

            // recherche du client
            $tabCli = getOneClient($fiche['obj_id_vendeur']);

            $tabPlus['titre'] = $INFO_APPLI['titre'];

            $titreMel = "Re-confirmation de votre dépôt à " . $INFO_APPLI['titre'];
            // creation du message avec comme template
            // html/mel_enregistrement.html
            $message = makeMessage($titreMel, array_merge($fiche, $tabCli, $tabPlus), "mel_enregistrement.html");

            // envoi du mel
            $retour = sendMail($titreMel, $tabCli['cli_emel'], $message);
            if ($retour == 1) {
                $retour = "Mel re-envoyé a " . $tabCli['cli_emel'];
            }
        } else {
            $retour = "Pas de fiche pour $id";
        }
    } catch (Exception $e) {
        return "ERREUR " . $e->getMessage();
    }
    return $retour;
}

/**
 * creation expres
 */
function action_createFicheExpress($data)
{
    extract($GLOBALS);

    $retour = "";
    try {
        $tabObj = tabToObject(string2Tab($data), "obj");
        $tabCli = tabToObject(string2Tab($data), "cli");

        // creation mais pas modification
        // on recoit un mel et ou un nom
        // en cas de mel, on ignore le nom
        // en cas de nom, pas de mel a priori
        $tabCli = makeClient($tabCli);

        $tabObj['obj_prix_depot'] = $tabObj['obj_prix_vente'];

        $tabObj['obj_id_vendeur'] = $tabCli['cli_id'];
        // creation de la clef unique REST
        $tabObj['obj_id_modif'] = hash_hmac(
            'md5',
            $tabObj['obj_numero'] . $GLOBALS['INFO_APPLI']['numero_bav'],
            'avs44'
        );
        $tabObj['obj_id'] = 0;

        // on pousse la marque et le modele en capitale
        $tabObj['obj_marque'] = strtoupper($tabObj['obj_marque']);
        $tabObj['obj_couleur'] = strtoupper($tabObj['obj_couleur']);

        // affectationa la BAV
        $tabObj['obj_numero_bav'] = $INFO_APPLI['numero_bav'];

        // insertion dans la base
        if ($id  = insertFiche($tabObj)) {
            $retour = $tabObj;
            $retour['obj_id'] = $id;
        } else {
            return "Oups problème de mise a jour";
        }
    } catch (Exception $e) {
        return "ERREUR " . $e->getMessage();
    }
    return $retour;
}

/**
 * supresion d'une fiche
 */
function action_deleteFiche($id)
{
    //extract($GLOBALS);
    //$ADMIN = $INFO_APPLI['ADMIN'];

    //if ($ADMIN) {
    deleteFiche($id);
    //}
}

/**
 * creation des etiquetes sur une feuille A4
 * parametre : le numero de depart, la mise a jour de l'impression, le nombre de page
 */
function action_makeA4Etiquettes($eti0, $eti1, $test = true)
{
    extract($GLOBALS);

    $data = array(
        'date1' => date('d', $INFO_APPLI['date_j1']),
        'date2' => date('d', $INFO_APPLI['date_j2']),
        'date3' => date('d', $INFO_APPLI['date_j3']),
        'mois' => date('M', $INFO_APPLI['date_j2']),
        'annee' => date('Y', $INFO_APPLI['date_j2']),
        'titre' => $INFO_APPLI['titre'],
        'URL' => $CFG_URL,
        'numero_bav' => $INFO_APPLI['numero_bav']
    );


    $etiquettes = "";
    // TODO : recherche des fiches a imprimer en fonction de la table bav_etiquette.
    // avec une base eti0
    $tabFiche = [];
    $index = 1;
    if ($eti0 == 0) {
        //recherche des fiches modifié ou crée, regroupé par page
        // $eti1 => 1 force ; 0 : normal
        $fiches = getFichesModif('data');
        $nbEtiq = 10000;
        if ($eti1 == "false") {
            //limite le tableau au modulo par page            
            $nbEtiq = ((int) (sizeof($fiches) / $INFO_APPLI['nb_eti_page'])) * $INFO_APPLI['nb_eti_page'];
        }
        if ($nbEtiq > 0) {
            foreach ($fiches as $fiche) {
                $tabFiche[$index++] = $fiche['obj_numero'];
                if ($index > $nbEtiq) {
                    break;
                }
            }
        }
    } else if ($eti0 > 0) {
        for ($numFiche = $eti0; $numFiche <= $eti1; $numFiche++) {
            $tabFiche[$index++] = $numFiche;
        }
    } else if ($eti0 == -1) {
        for ($numFiche = 0; $numFiche < $INFO_APPLI['nb_eti_page']; $numFiche++) {
            $tabFiche[$index++] = $numFiche;
        }
    }

    $index = 1;
    foreach ($tabFiche as $numFiche) {
        $fiche = [];
        if ($eti0 >= 0 && $fiche = getOneFicheByCode($numFiche)) {
            error_log($fiche['obj_id']);
            if ($fiche['obj_id']) {
                error_log("[action_makeA4Etiquettes] test $test");
                if (!$test) {
                    $fiche['obj_modif_data'] = 0;
                    updateFiche($fiche);
                }

                // refaire les descriptions, pas de retour chariots et limite.
                $fiche['obj_description'] = str_replace("\n", " / ", $fiche['obj_description']);
                if (strlen($fiche['obj_description']) > 250) {
                    $fiche['obj_description'] = substr($fiche['obj_description'], 0, 250) . "...";
                }

                if ($fiche['obj_prix_depot'] == 0) {
                    $fiche['obj_prix_depot'] = "";
                }
                $adresse = $CFG_URL . "/index.php?modePage=restV&id=" . $fiche['obj_id_modif'] . "&type=Etiquette";
                $keyQrcode = "restV-" . $fiche['obj_id_modif'] . "-Etiquette";
                $qrcodeFic = makeQrCode($adresse, $keyQrcode, 2);

                // $fiche['QRCODE'] = "<img src='https://chart.googleapis.com/chart?chs=100x100&cht=qr&chl=$adresse&choe=UTF-8' title='Fiche " . $fiche['obj_numero'] . "' />";
                $fiche['QRCODE'] = "<img  src='$CFG_URL/$qrcodeFic' title='Fiche " . $fiche['obj_numero'] . "' height='90px'/>";
                //$fiche['QRCODE']="";
                if ($CFG_DEBUG) {
                    $data['adresse'] = $adresse;
                } else {
                    $data['adresse'] = "";
                }
                $fiche['obj_achat'] = "-";
                if ($fiche['obj_prix_achat'] != "" && $fiche['obj_prix_achat'] > 0) {
                    $fiche['obj_achat'] .= $fiche['obj_prix_achat'] . " &euro; ";
                }
                if ($fiche['obj_date_achat_FR'] != "") {
                    $fiche['obj_achat'] .= "(" . $fiche['obj_date_achat_FR'] . ")";
                }
            }
        } else {
            if ($eti0 == -1) {
                $fiche['obj_numero'] = "";
                $fiche['obj_id_modif'] = "";
                $fiche['QRCODE'] = "";
                $data['adresse'] = "";
            } else {
                $fiche['obj_numero'] = $numFiche;
                /*makeIdModif($fiche, false);
                $adresse = $CFG_URL . "/index.php?modePage=restV&id=" . $fiche['obj_id_modif'] . "&type=Etiquette";
                $keyQrcode = "restV-" . $fiche['obj_id_modif'] . "-Etiquette";
                $qrcodeFic = makeQrCode($adresse, $keyQrcode, 1);

                // $fiche['QRCODE'] = "<img src='https://chart.googleapis.com/chart?chs=100x100&cht=qr&chl=$adresse&choe=UTF-8' title='Fiche " . $fiche['obj_numero'] . "' />";
                $fiche['QRCODE'] = "Plus de détail,scanner le QRCode <br/><img  src='$CFG_URL/$qrcodeFic' title='Fiche " . $fiche['obj_numero'] . "' />";*/
                $fiche['QRCODE'] = "";
                $data['adresse'] = "";
            }

            $fiche['obj_type'] = "<br/><span style='font-size:9px'><i>Autre-VTT-Route-VTC-Ville-VAE-Enfant</i></span>";
            $fiche['obj_public'] = "<br/><span style='font-size:9px'><i>Mixte-Homme-Femme</i></span>";
            $fiche['obj_pratique'] = "";
            // $fiche['obj_pratique'] = "<br/><span style='font-size:9px'><i>Sportive-Loisir-Compétition-Autre</i></span>";
            $fiche['obj_marque'] = "&nbsp;";
            $fiche['obj_modele'] = "&nbsp;";
            $fiche['obj_couleur'] = "";
            $fiche['obj_accessoire'] = "";
            $fiche['obj_description'] = "";
            $fiche['obj_prix_vente'] = "";
            $fiche['obj_prix_depot'] = "";
            $fiche['obj_taille'] = "";
            $fiche['obj_date_achat_FR'] = "";
            $fiche['obj_achat'] = "";
            $fiche['obj_prix_achat'] = "";
        }

        if (sizeof($fiche) > 0) {
            $tabCoupons[$index++] = makeCorps(array_merge($fiche, $data), 'etiquette.html');
        }
    }

    $nbCoupon = $INFO_APPLI['nb_eti_page'];
    $nbPage = ceil(sizeof($tabCoupons) / $nbCoupon);

    // echo "nb coupon : $nbCoupon ;  nbPage = $nbPage";
    $ligne = 1;
    $page = 0;
    $nbCouponTotal = sizeof($tabCoupons);
    // echo  $nbCouponTotal;
    foreach ($tabCoupons as $key => $value) {
        $pos = $ligne + $nbCoupon * $page;
        // echo "$key => $ligne+$nbCoupon*$page => ".($pos)." <br\>";
        if ($pos > $nbCouponTotal) {
            $page = 0;
            $ligne++;
            $nbPage--;
            $pos = $ligne + $nbCoupon * $page;
        }
        // echo "BIS $key => $ligne+$nbCoupon*$page => ".($pos)." <br\>";
        $tabImpression[$pos] = $value;
        $page++;
        if ($page >= $nbPage) {
            $page = 0;
            $ligne++;
        }
    }

    ksort($tabImpression);
    foreach ($tabImpression as $key => $value) {
        $etiquettes .= "<hr  />";
        $etiquettes .= $value;
        if ($index++ % $INFO_APPLI['nb_eti_page'] == 0) {
            $etiquettes .= "<hr  />";
            $etiquettes .= "<div style='page-break-after:always; clear:both;font-size:10pt;height:10pt'>..........</div>";
        }
    }

    $fileHTML = "../out/html/etiquettes_" . $eti0 . "_" . $eti1 . ".html";

    file_put_contents($fileHTML, utf8_decode($etiquettes));

    // if ($eti0 != 1) {
    //     $filePDF = html2pdf("", $fileHTML, "etiquettes_" . $eti0 . "_" . $eti1);
    //     unlink($fileHTML);
    //     return  $CFG_URL . $filePDF;
    // }
    // else {
    return  $CFG_URL . "/out/html/etiquettes_" . $eti0 . "_" . $eti1 . ".html";
    // }


}

/**
 * creation des etiquetes sur une feuille A4
 * parametre : le numero de depart, la mise a jour de l'impression, le nombre de page
 */
function action_makeA4Coupons($eti0, $eti1, $test = true, $nameCoupon = "coupon_vendeur")
{
    extract($GLOBALS);

    $data = array(
        'date1' => date('d', $INFO_APPLI['date_j1']),
        'date2' => date('d', $INFO_APPLI['date_j2']),
        'date3' => date('d', $INFO_APPLI['date_j3']),
        'mois' => date('M', $INFO_APPLI['date_j2']),
        'annee' => date('Y', $INFO_APPLI['date_j2']),
        'titre' => $INFO_APPLI['titre'],
        'URL' => $CFG_URL,
        'numero_bav' => $INFO_APPLI['numero_bav']
    );

    $etiquettes = "<html><head><link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'              integrity='sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u' crossorigin='anonymous'></head><body>";

    // TODO : recherche des fiches a imprimer en fonction de la table bav_etiquette.
    // avec une base eti0
    $tabFiche = [];
    $index = 1;
    if ($eti0 == 0) {
        //recherche des fiches modifié ou crée, regroupé par page
        // $eti1 => 1 force ; 0 : normal
        if ($nameCoupon == "coupon_vendeur") {
            $fiches = getFichesModif('vendeur');
        } else {
            $fiches =  getFichesModif('stock');
            //$fiches = getFichesModif('vendeur');
        }
        $nbEtiq = 10000;
        if ($eti1 == "false") {
            //limite le tableau au modulo par page            
            $nbEtiq = ((int) (sizeof($fiches) / $INFO_APPLI['nb_coupon_page'])) * $INFO_APPLI['nb_coupon_page'];
        }
        if ($nbEtiq > 0) {
            foreach ($fiches as $fiche) {
                $tabFiche[$index++] = $fiche['obj_numero'];
                if ($index > $nbEtiq) {
                    break;
                }
            }
        }
    } else if ($eti0 > 0) {
        for ($numFiche = $eti0; $numFiche <= $eti1; $numFiche++) {
            $tabFiche[$index++] = $numFiche;
        }
    } else if ($eti0 == -1) {
        for ($numFiche = 0; $numFiche < $INFO_APPLI['nb_coupon_page']; $numFiche++) {
            $tabFiche[$index++] = $numFiche;
        }
    }
    $espace75 = "";
    for ($i = 0; $i <= 60; $i++) {
        $espace75 .= "&nbsp;";
    }
    $espace50 = "";
    for ($i = 0; $i <= 30; $i++) {
        $espace50 .= "&nbsp;";
    }
    $espace100 = "";
    for ($i = 0; $i <= 90; $i++) {
        $espace100 .= "&nbsp;";
    }

    $tabImpression = [];
    $tabCoupons = [];

    $index = 1;
    foreach ($tabFiche as $numFiche) {
        if ($eti0 >= 0 && $fiche = getOneFicheByCode($numFiche)) {
            if ($fiche['obj_id']) {
                if (!$test) {
                    if ($nameCoupon == "coupon_acheteur") {
                        $fiche['obj_modif_stock'] = 0;
                    } else {
                        $fiche['obj_modif_vendeur'] = 0;
                    }
                    updateFiche($fiche);
                }
                $client = getOneClient($fiche['obj_id_vendeur']);
            }
            $client['cli_prenom'] = "";
            $client['cli_nom1'] = $client['cli_nom'];
            //$client['cli_nom1'] .="<br/><small>".$fiche['obj_id_modif']."</<small>";
            if ($nameCoupon == "coupon_vendeur") {
                $adresse = $CFG_URL . "/index.php?modePage=restV&id=" . $fiche['obj_id_modif'] . "&type=$nameCoupon";
                $keyQrcode = "restV-" . $fiche['obj_id_modif'] . "-$nameCoupon";
                $qrcodeFic = makeQrCode($adresse, $keyQrcode);

                // $fiche['QRCODE'] = "<img src='https://chart.googleapis.com/chart?chs=100x100&cht=qr&chl=$adresse&choe=UTF-8' title='Fiche " . $fiche['obj_numero'] . "' />";
                $fiche['QRCODE'] = "<img  src='$CFG_URL/$qrcodeFic' title='Fiche " . $fiche['obj_numero'] . "' />";
            } else {
                $fiche['QRCODE'] = "";
            }

            if ($CFG_DEBUG) {
                $data['adresse'] = $adresse;
            } else {
                $data['adresse'] = "";
            }


            $fiche['obj_object'] = trim($fiche['obj_marque']) . " " . trim($fiche['obj_modele']);

            $fiche['obj_marque'] = trim($fiche['obj_marque']) == "" ? "<u>$espace100</u>" : $fiche['obj_marque'];
            $fiche['obj_modele'] = trim($fiche['obj_modele']) == "" ? "<u>$espace75</u>" : $fiche['obj_modele'];
            $fiche['obj_couleur'] = trim($fiche['obj_couleur']) == "" ? "<u>$espace50</u>" : $fiche['obj_couleur'];



            // $fiche['QRCODE'] .=  $adresse;
        } else {
            $client['cli_prix_depot'] = "";
            $client['cli_nom1'] = "<u>$espace50</u>";
            $client['cli_nom'] = "<u>$espace50</u>";;
            $client['cli_prenom'] = "<u>$espace50</u>";
            $client['cli_emel'] = "<u>$espace50</u>";
            $client['cli_adresse'] = "";
            $client['cli_adresse1'] = "";
            $client['cli_code_postal'] = "";
            $client['cli_ville'] = "<u>$espace50</u>";;
            $client['cli_telephone'] = "<u>$espace50</u>";;
            $client['cli_telephone_bis'] = "";
            $client['cli_taux_com'] = "10";
            $client['cli_id_modif'] = "";
            if ($eti0 == -1) {
                $fiche['obj_numero'] = "";
                $fiche['obj_id_modif'] = "";
                $fiche['QRCODE'] = "";
            } else {
                $fiche['obj_numero'] = $numFiche;
                makeIdModif($fiche, false);
                //$client['cli_nom1'] = "<small>".$fiche['obj_id_modif']."</<small>";
                $adresse = $CFG_URL . "index.php?modePage=restV&id=" . $fiche['obj_id_modif'] . "&type=$nameCoupon";
                $keyQrcode = "restV-" . $fiche['obj_id_modif'] . "-$nameCoupon";
                $qrcodeFic = makeQrCode($adresse, $keyQrcode);
                // $fiche['QRCODE'] = "<img src='https://chart.googleapis.com/chart?chs=100x100&cht=qr&chl=$adresse&choe=UTF-8' title='Fiche " . $fiche['obj_numero'] . "' />";
                $fiche['QRCODE'] = "<img src='$CFG_URL/$qrcodeFic' title='Fiche " . $fiche['obj_numero'] . "' />";
                // $fiche['QRCODE'] .=  $adresse;
            }
            $fiche['obj_type'] = "<br/><span style='font-size:9px'><i>Autre-VTT-Route-VTC-Ville-VAE-Enfant</i></span>";
            $fiche['obj_public'] = "<br/><span style='font-size:9px'><i>Mixte-Homme-Femme</i></span>";
            $fiche['obj_pratique'] = "";
            // $fiche['obj_pratique'] = "<br/><span style='font-size:9px'><i>Sportive-Loisir-Compétition-Autre</i></span>";
            $fiche['obj_marque'] = "<u>$espace75</u>";
            $fiche['obj_modele'] = "<u>$espace75</u>";
            $fiche['obj_object'] = "";
            $fiche['obj_couleur'] = "<u>$espace50</u>";
            $fiche['obj_accessoire'] = "";
            $fiche['obj_description'] = "";
            $fiche['obj_prix_vente'] = "";
            $fiche['obj_prix_depot'] = "";
            $fiche['obj_taille'] = "";
            $fiche['obj_date_achat'] = "";
            $fiche['obj_prix_achat'] = "";

            if ($CFG_DEBUG) {
                $data['adresse'] = $adresse;
            } else {
                $data['adresse'] = "";
            }
        }

        if (sizeof($fiche) > 0) {
            $tabCoupons[$index++] = makeCorps(array_merge($fiche, $client, $data), $nameCoupon . '.html');
        }
    }

    $nbCoupon = $INFO_APPLI['nb_coupon_page'];
    $nbPage = ceil(sizeof($tabCoupons) / $nbCoupon);

    // echo "nb coupon : $nbCoupon ;  nbPage = $nbPage";
    $ligne = 1;
    $page = 0;
    $nbCouponTotal = sizeof($tabCoupons);
    // echo  $nbCouponTotal;
    foreach ($tabCoupons as $key => $value) {
        $pos = $ligne + $nbCoupon * $page;
        // echo "$key => $ligne+$nbCoupon*$page => ".($pos)." <br\>";
        if ($pos > $nbCouponTotal) {
            $page = 0;
            $ligne++;
            $nbPage--;
            $pos = $ligne + $nbCoupon * $page;
        }
        // echo "BIS $key => $ligne+$nbCoupon*$page => ".($pos)." <br\>";
        $tabImpression[$pos] = $value;
        $page++;
        if ($page >= $nbPage) {
            $page = 0;
            $ligne++;
        }
    }

    ksort($tabImpression);
    foreach ($tabImpression as $key => $value) {
        $etiquettes .= $value;

        if ($index++ % $INFO_APPLI['nb_coupon_page'] == 0) {
            $etiquettes .= "<div style='page-break-after:always; clear:both'>...</div>";
        } else {
            $etiquettes .= "<hr style='border:1px solid black'/>";
        }
    }

    $fileHTML = "../out/html/" . $nameCoupon . "_" . $eti0 . "_" . $eti1 . ".html";


    $etiquettes .= "</body></html>";
    file_put_contents($fileHTML, utf8_decode($etiquettes));

    return  $CFG_URL . "/out/html/" . $nameCoupon . "_" . $eti0 . "_" . $eti1 . ".html";
    // $filePDF = html2pdf("", $fileHTML, "coupon_vendeur_" . $eti0 . "_" . $eti1, "L");
    // unlink($fileHTML);

    // return  $CFG_URL . $filePDF;
}

/**
 * generation d'une edition sur des données de la fichie
 */
function action_makeLibreFiche($eti, $nameFdp)
{
    extract($GLOBALS);
    $data = array(
        'date1' => date('d', $INFO_APPLI['date_j1']),
        'date2' => date('d', $INFO_APPLI['date_j2']),
        'date3' => date('d', $INFO_APPLI['date_j3']),
        'mois' => date('M', $INFO_APPLI['date_j2']),
        'annee' => date('Y', $INFO_APPLI['date_j2']),
        'titre' => $INFO_APPLI['titre'],
        'URL' => $CFG_URL,
        'numero_bav' => $INFO_APPLI['numero_bav'],
        'today' => date('d/m/Y')
    );
    try {
        $fiche = return_oneFicheByCode($eti);
        error_log("-" . $fiche['obj_id'] . "-");
        if ($fiche != null && $fiche['obj_id'] != '') {
            error_log("OK pour la fiche");
            // refaire les descriptions, pas de retour chariots et limite.
            $client = getOneClient($fiche['obj_id_vendeur']);
            $acheteur = '';
            if ($fiche['obj_id_acheteur']) {
                $acheteur = getOneClient($fiche['obj_id_acheteur']);
            }

            if (!is_array($acheteur)) {
                $acheteur = array();
                $acheteur['ach_nom'] = "____________________________________";
                $acheteur['ach_adresse'] = "_____________________________________";
                $acheteur['ach_adresse1'] = "_____________________________________";
                $acheteur['ach_ville'] = "_______________________________";
                $acheteur['ach_code_postal'] = "__________";
            } else {
                foreach ($acheteur as $key => $value) {
                    $newKey = str_replace("cli_", "ach_", $key);
                    $acheteur[$newKey] = $value;
                    unset($acheteur[$key]);
                }
            }
            // MISE EN FORME DE LA FICHE
            // MISE EN FORME DE LA FICHE
            // regroupement de la description
            $fiche['obj_description'] = concatDescription($fiche['obj_description']);

            if (
                $fiche['obj_prix_vente'] > 0 && ($fiche['obj_etat'] == 'VENDU' || $fiche['obj_etat'] == 'PAYE')
            ) {
                $client['cli_com'] = getCommission($fiche);
            } else {
                $fiche['obj_prix_vente'] = "<u style='color:blue'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </u>";
                $client['cli_com'] = "<u style='color:blue'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>";
            }

            if ($fiche['obj_prix_vente'] != $fiche['obj_prix_depot'] && $fiche['obj_prix_vente'] > 0) {
                $fiche['obj_prix_depot'] = "<s>" . $fiche['obj_prix_depot'] . " €</s><span style='color:RED'>" . $fiche['obj_prix_vente'] . "</span>";
            }

            if ($fiche['obj_prix_depot'] == 0) {
                $fiche['obj_prix_depot'] = "";
            }
            // MISE EN FORME DE LA FICHE
            // MISE EN FORME DE LA FICHE

            // creation du html avec comme template
            // html/fiche_depot.html
            $etiquettes .= makeCorps(array_merge($fiche, $client, $data, $acheteur), $nameFdp . '.html');
            //print_r($acheteur);


            // fichier HTML resultant
            $fileHTML = "../out/html/" . $nameFdp . "_" . $eti . ".html";

            // enregistrement du fichier html
            file_put_contents($fileHTML,  utf8_decode($etiquettes));

            return  $CFG_URL . "/out/html/" . $nameFdp . "_" . $eti . ".html";
        } else {
            return  "Fiche $eti non trouvé.";
        }
    } catch (Exception $e) {
        return "ERREUR " . $e->getMessage();
    }
}

/**
 * accumulation des fiches dans un seul fichiers pour impression rapide
 */
function action_makeA4Fiches($eti0, $eti1)
{
    extract($GLOBALS);
    $data = array(
        'date1' => date('d', $INFO_APPLI['date_j1']),
        'date2' => date('d', $INFO_APPLI['date_j2']),
        'date3' => date('d', $INFO_APPLI['date_j3']),
        'mois' => date('M', $INFO_APPLI['date_j2']),
        'annee' => date('Y', $INFO_APPLI['date_j2']),
        'titre' => $INFO_APPLI['titre'],
        'URL' => $CFG_URL,
        'numero_bav' => $INFO_APPLI['numero_bav']
    );
    try {
        for ($numFiche = $eti0; $numFiche <= $eti1; $numFiche++) {
            $fiche = return_oneFicheByCode($numFiche);
            if ($fiche != null && $fiche['obj_id'] != '') {
                // refaire les descriptions, pas de retour chariots et limite.
                $client = getOneClient($fiche['obj_id_vendeur']);

                // MISE EN FORME DE LA FICHE
                // MISE EN FORME DE LA FICHE
                // regroupement de la description
                $fiche['obj_description'] = concatDescription($fiche['obj_description']);

                if (
                    $fiche['obj_prix_vente'] > 0 && ($fiche['obj_etat'] == 'VENDU' || $fiche['obj_etat'] == 'PAYE')
                ) {
                    $client['cli_com'] = getCommission($fiche);
                } else {
                    $fiche['obj_prix_vente'] = "<u style='color:blue'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </u>";
                    $client['cli_com'] = "<u style='color:blue'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>";
                }

                if ($fiche['obj_prix_vente'] != $fiche['obj_prix_depot'] && $fiche['obj_prix_vente'] > 0) {
                    $fiche['obj_prix_depot'] = "<s>" . $fiche['obj_prix_depot'] . " €</s><span style='color:RED'>" . $fiche['obj_prix_vente'] . "</span>";
                }

                if ($fiche['obj_prix_depot'] == 0) {
                    $fiche['obj_prix_depot'] = "";
                }
                // MISE EN FORME DE LA FICHE
                // MISE EN FORME DE LA FICHE

                // creation du html avec comme template
                // html/fiche_depot.html
                $etiquettes .= makeCorps(array_merge($fiche, $client, $data), 'fiche_depot.html');
                $etiquettes .= "<div style='page-break-after:always; clear:both'>...</div>";
            }
        }

        // fichier HTML resultant
        $fileHTML = "../out/html/fiches_" . $eti0 . "_" . $eti1 . ".html";

        // enregistrement du fichier html
        file_put_contents($fileHTML,  utf8_decode($etiquettes));

        // // generation du PDF
        // $filePDF = html2pdf("", $fileHTML, "fiches_" . $eti0 . "_" . $eti1);

        // //suppression du fichier HTML
        // unlink($fileHTML);

        // return  $CFG_URL . $filePDF;

        return  $CFG_URL . "/out/html/fiches_" . $eti0 . "_" . $eti1 . ".html";
    } catch (Exception $e) {
        return "ERREUR " . $e->getMessage();
    }
}


/**
 * calcul de la commission
 */
function getCommission($fiche)
{
    $commission = 0;
    if ($fiche['obj_id_vendeur']) {
        $client = getOneClient($fiche['obj_id_vendeur']);
        if ($fiche != null && $fiche['obj_prix_vente']) {
            if ($fiche['obj_prix_vente'] < 1000) {
                $commission = $fiche['obj_prix_vente'] * ($client['cli_taux_com'] / 100);
            } else {
                // TODO : parametre en fonction du taux
                if ($client['cli_taux_com'] == 5) {
                    $commission = 80;
                } else {
                    $commission = 100;
                }
            }
        } else {
            $commission = 0;
        }
    } else {
        $commission = 0;
    }
    return $commission;
}

/**
 * concatenation de la description
 */
function concatDescription($desc)
{
    // regroupement de la description
    $desc = str_replace("\n", " / ", $desc);
    $desc = str_replace("<br/>", " / ", $desc);

    return $desc;
}

/**
 * creation d'une fiche en PDF
 */
function action_makeData($id, $test = false)
{
    extract($GLOBALS);
    $ADMIN = $INFO_APPLI['ADMIN'];

    $numBAV = $INFO_APPLI['numero_bav'];
    $par = return_oneParametre($numBAV);

    $data = array(
        'date1' => date('d', $INFO_APPLI['date_j1']),
        'date2' => date('d', $INFO_APPLI['date_j2']),
        'date3' => date('d', $INFO_APPLI['date_j3']),
        'mois' => date('M', $INFO_APPLI['date_j2']),
        'annee' => date('Y', $INFO_APPLI['date_j2']),
        'titre' => $INFO_APPLI['titre'],
        'URL' => $CFG_URL,
        'numero_bav' => $numBAV
    );

    // pas de data, on fait un objet vide
    if ($id) {
        $fiche = getOneFiche($id);
        $client = getOneClient($fiche['obj_id_vendeur']);

        if (
            $fiche['obj_prix_vente'] > 0 && ($fiche['obj_etat'] == 'VENDU' || $fiche['obj_etat'] == 'PAYE')
        ) {
            $client['cli_com'] = getCommission($fiche);
        } else {
            $fiche['obj_prix_vente'] = "<u style='color:blue'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </u>";
            $client['cli_com'] = "<u style='color:blue'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>";
        }

        if ($fiche['obj_prix_vente'] != $fiche['obj_prix_depot'] && $fiche['obj_prix_vente'] > 0) {
            $fiche['obj_prix_depot'] = "<s>" . $fiche['obj_prix_depot'] . " €</s><span style='color:RED'>" . $fiche['obj_prix_vente'] . "</span>";
        }

        if ($fiche['obj_prix_depot'] == 0) {
            $fiche['obj_prix_depot'] = "";
        }
    } elseif ($test) {
        $client['cli_prix_depot'] = $par['par_prix_depot_1'];
        $client['cli_nom'] = "mr TEST henry";
        $client['cli_prenom'] = "";
        $client['cli_nom1'] = $client['cli_nom'];

        $client['cli_id_modif'] = "be49226b2150c567adf4f090c21be17f";
        $client['cli_emel'] = "test@test.com";
        $client['cli_adresse'] = "votre adresse";
        $client['cli_adresse1'] = "";
        $client['cli_code_postal'] = "44600";
        $client['cli_ville'] = "Saint Nazaire";
        $client['cli_telephone'] = "02 45 78 98 78";
        $client['cli_telephone_bis'] = "";
        $client['cli_taux_com'] = $par['par_taux_1'];
        $client['cli_id_modif'] = "";
        $client['cli_com'] = "1.3";

        $ach['ach_nom'] = "TEST acheteur";
        $ach['ach_id_modif'] = "be49226b2150c567adf4f090c21be17f";
        $ach['ach_emel'] = "test.acheteur@test.com";
        $ach['ach_adresse'] = "votre adresse";
        $ach['ach_adresse1'] = "";
        $ach['ach_code_postal'] = "44500";
        $ach['ach_ville'] = "La Baule";
        $ach['ach_telephone'] = "02 55 55 55 55 78 98 78";
        $ach['ach_telephone_bis'] = "";

        $fiche['obj_numero'] = "1000";
        $fiche['obj_id_modif'] = "be49226b2150c567adf4f090c21be17f";
        $fiche['obj_type'] = "VTT";
        $fiche['obj_public'] = "Homme";
        $fiche['obj_pratique'] = "Sportive";
        $fiche['obj_marque'] = "Décathlon";
        $fiche['obj_modele'] = "RockRider Super Star";
        $fiche['obj_couleur'] = "Noir et rouge";
        $fiche['obj_accessoire'] = "";
        $fiche['obj_description'] = "ceci est un texte long pour essayer de prendre de la place sur une ligne avec un maximun de place, allez on saute une ligne<br/>une ligne<br/> et encore une<br/>3<br/>4<br/>5<br/>6<br/>7<br/>8<br/>9";
        $fiche['obj_prix_vente'] = "130";
        $fiche['obj_prix_depot'] = "150";
        $fiche['obj_id_acheteur'] = 999999;
        $fiche['obj_etat'] = "VENDU";
        $fiche['obj_taille'] = "XL";
        $fiche['obj_date_achat_FR'] = "01/01/1901";
        $fiche['obj_prix_achat'] = "3200";
        $fiche['obj_achat'] = "3200";
        $fiche['obj_achat'] = "-";
        if ($fiche['obj_prix_achat'] != "" && $fiche['obj_prix_achat'] > 0) {
            $fiche['obj_achat'] .= $fiche['obj_prix_achat'] . " &euro; ";
        }
        if ($fiche['obj_date_achat_FR'] != "") {
            $fiche['obj_achat'] .= "(" . $fiche['obj_date_achat_FR'] . ")";
        }
        $fiche['obj_object'] = trim($fiche['obj_marque']) . " " . trim($fiche['obj_modele']);
        $fiche['QRCODE'] = "";
        $data['lien_confirm'] = $CFG_URL . "/Actions/rest.php?a=C&id=" . $fiche['obj_id_modif'];

        $adresse = $CFG_URL . "/index.php?modePage=restV&id=" . $fiche['obj_id_modif'] . "&type=Etiquette";
        $keyQrcode = "restV-" . $fiche['obj_id_modif'] . "-Etiquette";
        $qrcodeFic = makeQrCode($adresse, $keyQrcode, 2);

        // $fiche['QRCODE'] = "<img src='https://chart.googleapis.com/chart?chs=100x100&cht=qr&chl=$adresse&choe=UTF-8' title='Fiche " . $fiche['obj_numero'] . "' />";
        $fiche['QRCODE'] = "<img  src='$CFG_URL/$qrcodeFic' title='Fiche " . $fiche['obj_numero'] . "' height='90px'/>";
        $data['adresse'] = "";
    } else {
        $data['titre'] = "--" . $data['titre'] . "--";
        $client['cli_prix_depot'] = $par['par_prix_depot_1'];
        $client['cli_nom'] = "";
        $client['cli_prenom'] = "";
        $client['cli_nom1'] = $client['cli_nom'];
        $client['cli_emel'] = "";
        $client['cli_adresse'] = "";
        $client['cli_adresse1'] = "";
        $client['cli_code_postal'] = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        $client['cli_ville'] = "";
        $client['cli_telephone'] = "";
        $client['cli_telephone_bis'] = "";
        $client['cli_taux_com'] = $par['par_taux_1'];
        $client['cli_id_modif'] = "";

        $fiche['obj_numero'] = "_______";
        $fiche['obj_type'] = "<br/><span style='font-size:9px'><i>Autre-VTT-Route-VTC-Ville-VAE-Enfant</i></span>";
        $fiche['obj_public'] = "<br/><span style='font-size:9px'><i>Mixte-Homme-Femme</i></span>";
        $fiche['obj_pratique'] = "";
            // $fiche['obj_pratique'] = "<br/><span style='font-size:9px'><i>Sportive-Loisir-Compétition-Autre</i></span>";
            
        $fiche['obj_marque'] = "";
        $fiche['obj_modele'] = "";
        $fiche['obj_couleur'] = "";
        $fiche['obj_accessoire'] = "";
        $fiche['obj_description'] = "";
        $fiche['obj_prix_vente'] = "<u style='color:blue'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </u>";
        $fiche['obj_prix_depot'] = "<u style='color:blue'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </u>";
        $fiche['obj_id_modif'] = "";
        $fiche['obj_taille'] = "";
        $fiche['obj_date_achat_FR'] = "";
        $fiche['obj_date_achat'] = "";
        $fiche['obj_prix_achat'] = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        $fiche['QRCODE'] = "";
        $fiche['obj_object'] = "";
        $client['cli_com'] = "";

        $data['lien_confirm'] = $CFG_URL . "/Actions/rest.php?a=C&id=" . $fiche['obj_id_modif'];
    }

    // MISE EN FORME DE LA FICHE
    // MISE EN FORME DE LA FICHE
    // regroupement de la description
    $fiche['obj_description'] = concatDescription($fiche['obj_description']);

    // MISE EN FORME DE LA FICHE
    // MISE EN FORME DE LA FICHE

    return array_merge($fiche, $client, $data);
}

function action_makeHtml($id, $html, $test)
{
    $data = action_makeData($id, $test);
    error_log($html);
    return  makeCorps($data, $html);
}

function action_makePDF($id, $html = 'fiche_depot.html', $test = false, $format = "P")
{
    extract($GLOBALS);
    $data = action_makeData($id, $test);
    try {

        $filePDF = html2pdf($data, $html, basename($html, ".html") . "_" . $data['obj_numero'], $format);
    } catch (Exception $e) {
        print_r($e);
        return "ERREUR " . $e->getMessage();
    }
    return $CFG_URL . $filePDF;
}

/**
 * modification de l'etat de la fiche
 */
function action_changeEtatFiche($obj)
{
    extract($GLOBALS);
    $ADMIN = $INFO_APPLI['ADMIN'];

    if ($ADMIN) {
        $fiche = string2Tab($obj);
        // on bascule la fiche au nouvel ETAT
        $fiche['obj_etat'] = $fiche['obj_etat_new'];
        unset($fiche['obj_etat_new']);

        // si la fiche pass a confirme
        if ($fiche['obj_etat'] == 'CONFIRME') {
            // creation de la fiche avec le numero info
            makeNumeroFiche($INFO_APPLI['base_info'], $fiche);
            // mise a jour de la date
            $fiche['obj_date_depot'] = date('y-m-d H:i:s');
            $fiche['obj_modif_data'] = 1;
            $fiche['obj_modif_vendeur'] = 1;
        } elseif ($fiche['obj_etat'] == 'STOCK') {
            // passage en stock
            // on valide le prix
            $fiche['obj_prix_vente'] = $fiche['obj_prix_depot'];
            // mise a jour de la date
            $fiche['obj_date_depot'] = date('y-m-d H:i:s');
            // if ($fiche['obj_numero'] < 1001) {
            //     $fiche['obj_modif_stock'] = 1;
            // }

            // TODO : envoi mel de depot pour note modif prix
        } elseif ($fiche['obj_etat'] == 'DESTOCK') {
            // on remet en CONFIRME
            $fiche['obj_etat'] = 'CONFIRME';
            // on remet le prix de vente a 0
            $fiche['obj_prix_vente'] = 0;
            $fiche['obj_modif_stock'] = 0;
        } elseif ($fiche['obj_etat'] == 'RENDU' || $fiche['obj_etat'] == 'PAYE') {
            // action RENDU et PAYE
            // on valide la date de fin
            $fiche['obj_date_retour'] = date('y-m-d H:i:s');
        } elseif ($fiche['obj_etat'] == 'DERENDRE') {
            // on remet en STOCK
            // annulation date de retour RENDU
            $fiche['obj_date_retour'] = null;
            $fiche['obj_etat'] = 'STOCK';
        } elseif ($fiche['obj_etat'] == 'DEVENDRE') {
            // on remet en STOCK
            $fiche['obj_date_vente'] = null;
            $fiche['obj_etat'] = 'STOCK';
            $fiche['obj_id_acheteur'] = null;

            // TODO : mel d'erreur d'envoi ????
        } elseif ($fiche['obj_etat'] == 'DEPAYER') {
            // on remet en VENDU
            $fiche['obj_date_retour'] = null;
            $fiche['obj_etat'] = 'VENDU';
        }

        try {
            updateFiche($fiche);
        } catch (Exception $e) {
            return "ERREUR " . $e->getMessage();
        }
    }
    return $fiche;
}

/**
 * mise en vente
 */
function action_vendFiche($data)
{
    extract($GLOBALS);
    $tab = array(
        'date1' => date('d', $INFO_APPLI['date_j1']),
        'date2' => date('d', $INFO_APPLI['date_j2']),
        'date3' => date('d', $INFO_APPLI['date_j3']),
        'mois' => date('M', $INFO_APPLI['date_j2']),
        'annee' => date('Y', $INFO_APPLI['date_j2']),
        'titre' => $INFO_APPLI['titre'],
        'URL' => $CFG_URL,
        'numero_bav' => $numBAV
    );
    try {
        $fiche = tabToObject(string2Tab($data), "obj");
        $client = tabToObject(string2Tab($data), "cli");

        // creation de l'acheteur (ATTENTION : on re recherche l'agent)
        // on recoit un mel et ou un nom
        // en cas de mel, on ignore le nom
        // en cas de nom, pas de mel a priori
        $client = makeClient($client);

        // on recoit l'etat VENDU
        $fiche['obj_etat'] = $fiche['obj_etat_new'];
        unset($fiche['obj_etat_new']);

        // on affecte le nouveau acheteur
        $fiche['obj_id_acheteur'] = $client['cli_id'];

        // la date de vente
        $fiche['obj_date_vente'] = date('y-m-d H:i:s');

        // mise a jour de la fiche
        updateFiche($fiche);

        // on recherche la fiche
        $theFiche = getOneFiche($fiche['obj_id']);

        // on recherche le vendeur
        $cliVend = return_oneClient($theFiche['obj_id_vendeur']);

        // si le client a un mel on envoi un mel
        if ($cliVend['cli_emel'] != "") {
            // calcul de la commission
            $tab['cli_com'] = getCommission($theFiche);

            // TODO : envoi du mail
            $titreMel = "BAV #" . $theFiche['obj_numero'] . ", votre vélo est vendu .";

            // creation du message avec le template
            // html/mel_vendu.html
            $message = makeMessage($titreMel, array_merge($theFiche, $cliVend, $tab), "mel_vendu.html");

            error_log($message);
            // envoi du mel
            sendMail($titreMel, $cliVend['cli_emel'], $message);
        }
        return $theFiche;
    } catch (Exception $e) {
        return "ERREUR " . $e->getMessage();
    }
}


/**
 * mise a jour de la fiche
 */
function action_updateFiche($data)
{
    $fiche = tabToObject(string2Tab($data), "obj");
    $client = tabToObject(string2Tab($data), "cli");
    $acheteur = tabToObject(string2Tab($data), "ach");

    if ($acheteur) {
        $clientAcheteur = [];
        foreach ($acheteur as $key => $val) {
            $newKey = str_ireplace("ach_", "cli_", $key);
            $clientAcheteur[$newKey] = $val;
        }
        $clientAcheteur = makeClient($clientAcheteur);

        $fiche['obj_id_acheteur'] = $clientAcheteur['cli_id'];
    }

    $ficheOld = getOneFiche($fiche['obj_id']);

    // attention au doublon
    // un mel, on cherche si OK, si oui on modifie les données
    // si pas de mel, on cherche le nom si OK, on recupere et modifis les données
    // attention au homonyne..
    // si rien trouvé on le crée.
    if ($client) {
        $client = makeClient($client);
        $fiche['obj_id_vendeur'] = $client['cli_id'];

        $cliOld = return_oneClient($fiche['obj_id_vendeur']);

        if (strtoupper($client['cli_nom']) != strtoupper($cliOld['cli_nom'])) {
            $fiche['obj_modif_vendeur'] = 2;
        }
    }

    // en mode CONFIRME
    // on recherche le vendeur
    if ($fiche['obj_etat'] == "CONFIRME") {
        // error_log("test cli_nom  " . strtoupper($client['cli_nom']) . " != " . strtoupper($cliOld['cli_nom']));
        // si modification de client de la fiche
        if ($ficheOld['obj_modif_vendeur'] == 0 && (strtoupper($fiche['obj_marque']) != strtoupper($ficheOld['obj_marque']) ||
            strtoupper($fiche['obj_modele']) != strtoupper($ficheOld['obj_modele']))) {
            $fiche['obj_modif_vendeur'] = 2;
        }

        // si modification de datas de la fiche
        if (
            $ficheOld['obj_modif_data'] == 0 && (strtoupper($fiche['obj_modele']) != strtoupper($ficheOld['obj_modele']) ||
                strtoupper($fiche['obj_type']) != strtoupper($ficheOld['obj_type']) ||
                strtoupper($fiche['obj_public']) != strtoupper($ficheOld['obj_public']) ||
                strtoupper($fiche['obj_marque']) != strtoupper($ficheOld['obj_marque']) ||
                strtoupper($fiche['obj_modele']) != strtoupper($ficheOld['obj_modele']) ||
                strtoupper($fiche['obj_couleur']) != strtoupper($ficheOld['obj_couleur']) ||
                strtoupper($fiche['obj_taille']) != strtoupper($ficheOld['obj_taille']) ||
                strtoupper($fiche['obj_date_achat']) != strtoupper($ficheOld['obj_date_achat']) ||
                strtoupper($fiche['obj_prix_achat']) != strtoupper($ficheOld['obj_prix_achat']) ||
                //strtoupper($fiche['obj_description']) != strtoupper($ficheOld['obj_description']) ||
                strtoupper($fiche['obj_prix_depot']) != strtoupper($ficheOld['obj_prix_depot']))
        ) {
            $fiche['obj_modif_data'] = 2;
        }
    }

    try {
        $fiche['obj_marque'] = strtoupper($fiche['obj_marque']);
        $fiche['obj_modele'] = strtoupper($fiche['obj_modele']);

        updateFiche($fiche);

        updateClient($client);

        if ($fiche['obj_id_acheteur']) {
            updateClient($clientAcheteur);
        }

        return $fiche;
    } catch (Exception $e) {
        return "ERREUR " . $e->getMessage();
    }
}

function return_fichesModif($type = 'data')
{
    try {
        $par = return_parametreActif();
        $tab = getFichesModif($type);
        return $tab;
    } catch (Exception $e) {
        return "ERREUR " . $e->getMessage();
    }
}
/**
 * recherche des fiches
 */
function return_fiches($tri, $sens, $selection, $detail = 1)
{
    try {
        $tab = getFiches($tri, $sens, string2Tab($selection));

        foreach ($tab as $key => $val) {
            if ($detail == 1) {
                $tab['total_vente_' . $val['obj_etat']] += $val['obj_prix_vente'];
                $tab['total_nb_' . $val['obj_etat']]++;

                if ($val['obj_etat'] == "PAYE") {
                    $tab['total_com_paye'] += getCommission($val);
                } elseif ($val['obj_etat'] == "VENDU") {
                    $tab['total_com_vendu'] += getCommission($val);
                }
                if (
                    $val['obj_etat'] == "STOCK" || $val['obj_etat'] == "VENDU" || $val['obj_etat'] == "RENDU" || $val['obj_etat'] == "PAYE"
                ) {
                    $tab['total_vente_depot'] += $val['obj_prix_vente'];
                    $tab['total_depot'] += $val['cli_prix_depot'];
                }
            }
        }
        return $tab;
    } catch (Exception $e) {
        return "ERREUR " . $e->getMessage();
    }
}

/**
 * retou de toutes les fiches
 */
function return_fiches_express($base)
{
    return  getFichesExpress($base);
}


function return_nbFichesByDay($numeroBAV)
{
    return getNbFichesByDay($numeroBAV);
}

function return_nbFichesByDayAvantBAV($numeroBAV)
{
    return getNbFichesByDayAvantBAV($numeroBAV);
}
