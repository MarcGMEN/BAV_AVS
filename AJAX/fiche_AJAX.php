<?php

/**************************************/
/**************************************/
/* FICHE */
/**************************************/
/**************************************/

function return_countByEtat()
{
    return countByEtat();
}


function return_list_marques()
{
    $tabMarques = [
        'TREK', 'SCOTT', 'CANNONDALE', 'GITANE', 'PEUGEOT', 'MERCIER', 'SUNN', 'GT', 'EXS', 'CERVELO', 'BIANCHI',
        'COLNAGO', 'KUOTA', 'BH', 'BMC', 'BTWIN', 'DECATHLON', 'CANYON', 'CKT', 'COMMENCAL', 'DIAMONDBACK', 'GIANT', 'KONA',
        'KTM', 'MBK', 'MERIDA', 'ORBEA', 'PINARELLO', 'RIDLEY', 'SPECIALIZED', 'TIME', 'WILLIER', 'LOOK'
    ];
    $tabRetour = array_merge($tabMarques, listUnique("bav_objet", "obj_marque"));
    $tabRetour = array_unique($tabRetour);
    sort($tabRetour);
    return $tabRetour;
}

function return_list_modeles($marque)
{
    $tabRetour = get_modelesByMarques(strtoupper($marque));
    //print_r($tabRetour);
    sort($tabRetour);
    return $tabRetour;
}

function return_oneFicheByCode($id)
{
    $row = getOneFicheByCode($id, $_COOKIE['NUMERO_BAV']);
    if ($row) {
        $row['obj_date_depot_FR'] = formateDateMYSQLtoFR($row['obj_date_depot'], true);
    } else {
        $row['obj_numero'] = $id;
    }
    return $row;
}

function return_oneFicheByIdModif($id)
{
    $row = getOneFicheByIdModif($id);
    if ($row) {
        $row['obj_date_depot_FR'] = formateDateMYSQLtoFR($row['obj_date_depot'], true);
    }
    return $row;
}

function return_oneFiche($id)
{
    $row = getOneFiche($id);
    if ($row) {
        $row['obj_date_depot_FR'] = formateDateMYSQLtoFR($row['obj_date_depot'], true);
    }
    return $row;
}


function action_createFiche($data)
{
    $infoAppli = return_infoAppli();
    // droit = ADMIN+TABLE+CLIENT
    $ADMIN = $infoAppli['ADMIN'];
    $TABLE = $infoAppli['TABLE'];
    $CLIENT = $infoAppli['CLIENT'];

    extract($GLOBALS);
    $retour = "";
    try {
        // creation du client, avec test si pas deja connu
        $tabObj = tabToObject(string2Tab($data), "obj");
        $tabCli = tabToObject(string2Tab($data), "cli");
        makeClient($tabCli);

        $tabObj['obj_id_vendeur'] = $tabCli['cli_id'];

        // TODO : insert fiche
        $tabObj['obj_id'] = 0;

        // creation du numero
        if ($ADMIN || $TABLE) {
            makeNumeroFiche($FICHE_INFO, $tabObj);
            $tabObj['obj_etat'] = 'STOCK';
            $tabObj['obj_prix_vente'] = $tabObj['obj_prix_depot'];
            $tabObj['obj_date_depot'] = date('y-m-d h:m:s');
        } else {
            $tabObj['obj_etat'] = 'INIT';
            makeNumeroFiche(5000, $tabObj);
            $tabPlus['lien_confirm'] = $CFG_URL . "/Actions/rest.php?a=C&id=" . $tabObj['obj_id_modif'];

            if ($tabObj['obj_prix_depot'] == "") {
                $tabPlus['obj_prix_depot'] = 'A renseigner le jour du dépôt dernier délai';
                $tabObj['obj_prix_depot'] == 0;
            } else {
                $tabPlus['obj_prix_depot'] = $tabObj['obj_prix_depot'] . " €";
            }

            $tabPlus['titre'] = $infoAppli['titre'];

            $titreMel = "Confirmation de votre dépôt à " . $infoAppli['titre'];
            $message = makeMessage($titreMel, array_merge($tabObj, $tabCli, $tabPlus), "mel_enregistrement.html");
        }

        $tabObj['obj_numero_bav'] = $_COOKIE['NUMERO_BAV'];
        //        print_r($tabObj);
        $tabObj['obj_id'] = insertFiche($tabObj);

        if ($ADMIN || $TABLE) {
            $retour = array();
            //$retour['message'] = "OK pour creation de ".$tabObj['obj_numero'];
            $retour['id'] = $tabObj['obj_id'];
        } else {
            $retour = sendMail($titreMel, $tabCli['cli_emel'], $message);
        }
    } catch (Exception $e) {
        return "ERREUR " . $e->getMessage();
    }
    return $retour;
}

function action_createFicheExpress($data)
{
    $infoAppli = return_infoAppli();
    // droit = ADMIN+TABLE+CLIENT
    $ADMIN = $infoAppli['ADMIN'];
    $TABLE = $infoAppli['TABLE'];
    $CLIENT = $infoAppli['CLIENT'];

    extract($GLOBALS);
    $retour = "";
    try {
        // creation du client, avec test si pas deja connu
        $tabObj = tabToObject(string2Tab($data), "obj");
        $tabCli = tabToObject(string2Tab($data), "cli");
        //print_r($tabCli);

        makeClient($tabCli);

        $tabObj['obj_prix_depot'] = $tabObj['obj_prix_vente'];

        $tabObj['obj_id_vendeur'] = $tabCli['cli_id'];
        $tabObj['obj_id_modif'] = substr(hash_hmac('md5', $tabObj['obj_numero'], 'avs44' + $_COOKIE['NUMERO_BAV']), 0, 5);
        // TODO : insert fiche
        $tabObj['obj_id'] = 0;

        $tabObj['obj_numero_bav'] = $_COOKIE['NUMERO_BAV'];
        if (insertFiche($tabObj)) { } else {
            print_r($tabObj);
            return "Oups problème de mise a jour";
        }
    } catch (Exception $e) {
        return "ERREUR " . $e->getMessage();
    }
    return $retour;
}


function action_deleteFiche($id)
{
    $infoAppli = return_infoAppli();
    // droit = ADMIN+TABLE+CLIENT
    $ADMIN = $infoAppli['ADMIN'];
    $TABLE = $infoAppli['TABLE'];
    $CLIENT = $infoAppli['CLIENT'];

    extract($GLOBALS);

    deleteFiche($id);
}

// cumul des etiquettes 
function action_makeA4Etiquettes($eti0, $eti1)
{

    extract($GLOBALS);

    $etiquettes = "";
    for ($numFiche = $eti0; $numFiche <= $eti1; $numFiche++) {
        $fiche = return_oneFicheByCode($numFiche);
        if ($fiche['obj_id']) {
            // refaire les descriptions, pas de retour chariots et limite.

            $fiche['obj_description'] = str_replace("\n", " / ", $fiche['obj_description']);

            if ($fiche['obj_prix_depot'] == 0) {
                $fiche['obj_prix_depot']="";
            }

            $etiquettes .= makeCorps($fiche, 'etiquette.html');
            $etiquettes .= "<hr/>";
        }
    }
    $fileHTML = "../html/etiquettes_" . $eti0 . "_" . $eti1 . ".html";

    file_put_contents($fileHTML, $etiquettes);

    $filePDF = html2pdf("", $fileHTML, "etiquettes_" . $eti0 . "_" . $eti1);
    unlink($fileHTML);

    return  $CFG_URL . $filePDF;
}

// cumul des etiquettes 
function action_makeA4Fiches($eti0, $eti1)
{

    extract($GLOBALS);
    try {
        for ($numFiche = $eti0; $numFiche <= $eti1; $numFiche++) {
            $fiche = return_oneFicheByCode($numFiche);
            if ($fiche['obj_id']) {
                // refaire les descriptions, pas de retour chariots et limite.
                $client = getOneClient($fiche['obj_id_vendeur']);

                $fiche['obj_description'] = str_replace("\n", " / ", $fiche['obj_description']);
                $fiche['obj_description'] = str_replace("<br/>", " / ", $fiche['obj_description']);

                if ($fiche['obj_prix_vente'] > 0 && ($fiche['obj_etat'] == 'VENDU' || $fiche['obj_etat'] == 'PAYE')) {
                    if ($fiche['obj_prix_vente'] < 1000) {
                        $client['cli_com'] = $fiche['obj_prix_vente'] * ($client['cli_taux_com'] / 100);
                    } else {
                        $client['cli_com'] = 100;
                    }
                } else {
                    $fiche['obj_prix_vente'] = "<u style='color:blue'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </u>";
                    $client['cli_com'] = "<u style='color:blue'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>";
                }
                $etiquettes .= makeCorps(array_merge($fiche, $client), 'fiche_depot.html');
            }
        }
        $fileHTML = "../html/fiches_" . $eti0 . "_" . $eti1 . ".html";

        file_put_contents($fileHTML, $etiquettes);

        $filePDF = html2pdf("", $fileHTML, "fiches_" . $eti0 . "_" . $eti1);
        unlink($fileHTML);

        return  $CFG_URL . $filePDF;
    } catch (Exception $e) {
        return "ERREUR " . $e->getMessage();
    }
}

function action_makePDF($id, $html = 'fiche_depot.html', $test = false)
{
    //echo $html;
    $infoAppli = return_infoAppli();
    // droit = ADMIN+TABLE+CLIENT
    $ADMIN = $infoAppli['ADMIN'];
    $TABLE = $infoAppli['TABLE'];
    $CLIENT = $infoAppli['CLIENT'];

    extract($GLOBALS);

    $numBAV = $_COOKIE['NUMERO_BAV'];
    $par = return_oneParametre($numBAV);

    // pas de data, on fait un objet vide
    if ($id) {
        $fiche = getOneFiche($id);
        $client = getOneClient($fiche['obj_id_vendeur']);
    } elseif ($test) {
        $client['cli_prix_depot'] = $par['par_prix_depot_1'];
        $client['cli_nom'] = "TEST";
        $client['cli_emel'] = "test@test.com";
        $client['cli_adresse'] = "votre adresse";
        $client['cli_adresse1'] = "";
        $client['cli_code_postal'] = "44600";
        $client['cli_ville'] = "Saint Nazaire";
        $client['cli_telephone'] = "02 45 78 98 78";
        $client['cli_telephone_bis'] = "";
        $client['cli_taux_com'] = $par['par_taux_1'];
        $client['cli_id_modif'] = "";

        $ach['ach_nom'] = "TEST acheteur";
        $ach['ach_emel'] = "test.acheteur@test.com";
        $ach['ach_adresse'] = "votre adresse";
        $ach['ach_adresse1'] = "";
        $ach['ach_code_postal'] = "44500";
        $ach['ach_ville'] = "La Baule";
        $ach['ach_telephone'] = "02 55 55 55 55 78 98 78";
        $ach['ach_telephone_bis'] = "";

        $fiche['obj_numero'] = $FICHE_INFO;
        $fiche['obj_type'] = "VTT";
        $fiche['obj_public'] = "Homme";
        $fiche['obj_pratique'] = "Sportive";
        $fiche['obj_marque'] = "Décathlon";
        $fiche['obj_modele'] = "RockRider";
        $fiche['obj_couleur'] = "Noire";
        $fiche['obj_accessoire'] = "";
        $fiche['obj_description'] = "ceci est un texte long pour essayer de prendre de la place sur une ligne avec un maximun de place, allez on saute une ligne<br/>une ligne<br/> et encore une<br/>3<br/>4<br/>5<br/>6<br/>7<br/>8<br/>9";
        $fiche['obj_prix_vente'] = "130";
        $fiche['obj_prix_depot'] = "150";
        $fiche['obj_id_modif'] = "";
        $fiche['obj_id_acheteur'] = 999999;
        $fiche['obj_etat'] = "VENDU";
    } else {
        $client['cli_prix_depot'] = $par['par_prix_depot_1'];
        $client['cli_nom'] = "";
        $client['cli_emel'] = "";
        $client['cli_adresse'] = "";
        $client['cli_adresse1'] = "";
        $client['cli_code_postal'] = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        $client['cli_ville'] = "";
        $client['cli_telephone'] = "";
        $client['cli_telephone_bis'] = "";
        $client['cli_taux_com'] = $par['par_taux_1'];
        $client['cli_id_modif'] = "";

        $fiche['obj_numero'] = "";
        $fiche['obj_type'] = "<br/><small>VTT-Course-VTC-Ville-BMX-Autre-VAE</small>";
        $fiche['obj_public'] = "<br/><small>Homme-Femme-Mixte-Enfant</small>";
        $fiche['obj_pratique'] = "Sportive-Loisir-Compétition";
        $fiche['obj_marque'] = "";
        $fiche['obj_modele'] = "";
        $fiche['obj_couleur'] = "";
        $fiche['obj_accessoire'] = "";
        $fiche['obj_description'] = "";
        $fiche['obj_prix_vente'] = "<u style='color:blue'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </u>";
        $fiche['obj_prix_depot'] = "<u style='color:blue'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </u>";
        $fiche['obj_id_modif'] = "";
    }

    $tabPlus['titre'] = $par['par_titre'];
    $tabPlus['URL'] = $CFG_URL;

    if ($fiche['obj_prix_vente'] != $fiche['obj_prix_depot'] && $fiche['obj_prix_vente'] > 0) {
        $fiche['obj_prix_depot'] = "<s>" . $fiche['obj_prix_depot'] . " €</s><span style='color:RED'>" . $fiche['obj_prix_vente'] . "</span>";
    }

    if ($fiche['obj_prix_vente'] > 0 && ($fiche['obj_etat'] == 'VENDU' || $fiche['obj_etat'] == 'PAYE')) {
        if ($fiche['obj_prix_vente'] < 1000) {
            $client['cli_com'] = $fiche['obj_prix_vente'] * ($client['cli_taux_com'] / 100);
        } else {
            $client['cli_com'] = 100;
        }
    } else {
        $fiche['obj_prix_vente'] = "<u style='color:blue'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </u>";
        $client['cli_com'] = "<u style='color:blue'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>";
    }

    if ( $fiche['obj_prix_depot'] == 0) {
        $fiche['obj_prix_depot']="";
    }

    $fiche['obj_description'] = str_replace("\n", " / ", $fiche['obj_description']);
    $fiche['obj_description'] = str_replace("<br/>", " / ", $fiche['obj_description']);

    //print_r(array_merge($fiche, $client, $acheteur, $tabPlus));

    $filePDF = html2pdf(array_merge($fiche, $client, $tabPlus), $html, "Fiche_" . $fiche['obj_numero']);

    return $CFG_URL . $filePDF;
}

function action_confirmeFiche($obj)
{
    extract($GLOBALS);
    $infoAppli = return_infoAppli();
    // droit = ADMIN+TABLE+CLIENT
    $ADMIN = $infoAppli['ADMIN'];
    $TABLE = $infoAppli['TABLE'];
    $CLIENT = $infoAppli['CLIENT'];

    if ($ADMIN || $TABLE) {
        $fiche = string2Tab($obj);
        $fiche['obj_etat'] = $fiche['obj_etat_new'];
        unset($fiche['obj_etat_new']);

        makeNumeroFiche($FICHE_INFO, $fiche);

        updateFiche($fiche);
    }
    return $fiche;
}
function action_changeEtatFiche($obj)
{
    extract($GLOBALS);
    $infoAppli = return_infoAppli();
    // droit = ADMIN+TABLE+CLIENT
    $ADMIN = $infoAppli['ADMIN'];
    $TABLE = $infoAppli['TABLE'];

    if ($ADMIN || $TABLE) {
        $fiche = string2Tab($obj);
        $fiche['obj_etat'] = $fiche['obj_etat_new'];
        unset($fiche['obj_etat_new']);

        if ($fiche['obj_etat'] == 'CONFIRME') {
            makeNumeroFiche($FICHE_INFO, $fiche);
        } elseif ($fiche['obj_etat'] == 'STOCK') {
            $fiche['obj_prix_vente'] = $fiche['obj_prix_depot'];
            $fiche['obj_date_depot'] = date('y-m-d h:m:s');
            /*} elseif ($fiche['obj_etat'] == 'VENDU') {
            $fiche['obj_date_vente'] = date('y-m-d h:m:s');
//            $client = getOneClient($fiche['obj_id_vendeur']);*/
        } elseif ($fiche['obj_etat'] == 'RENDU' || $fiche['obj_etat'] == 'PAYE') {
            $fiche['obj_date_retour'] = date('y-m-d h:m:s');
        } elseif ($fiche['obj_etat'] == 'RESTOCK') {
            $fiche['obj_date_retour'] = null;
            $fiche['obj_date_vente']  = null;
            $fiche['obj_id_acheteur'] = 0;
            $fiche['obj_etat'] = 'STOCK';
        }
        //print_r($fiche);
        try {
            updateFiche($fiche);
        } catch (Exception $e) {
            return "ERREUR " . $e->getMessage();
        }
    }
    return $fiche;
}

function action_vendFiche($data)
{
    try {

        $fiche = tabToObject(string2Tab($data), "obj");
        $client = tabToObject(string2Tab($data), "cli");

        makeClient($client);

        $fiche['obj_etat'] = $fiche['obj_etat_new'];
        unset($fiche['obj_etat_new']);

        $fiche['obj_id_acheteur'] = $client['cli_id'];
        $fiche['obj_date_vente'] = date('y-m-d h:m:s');
        updateFiche($fiche);

        $theFiche = getOneFiche($fiche['obj_id']);
        $cliVend = return_oneClient($theFiche['obj_id_vendeur']);

        $tab = array();
        if ($theFiche['obj_prix_vente'] < 1000) {
            $tab['cli_com'] = $theFiche['obj_prix_vente'] * ($cliVend['cli_taux_com'] / 100);
        } else {
            $tab['cli_com'] = 100;
        }

        if ($cliVend['cli_emel'] != "") {
            // TODO : envoi du mail
            $titreMel = "BAV #" . $fiche['obj_numero'] . ", votre vélo est vendu .";
            $message = makeMessage($titreMel, array_merge($fiche, $cliVend, $tab), "mel_vendu.html");
            sendMail($titreMel, $cliVend['cli_emel'], $message);
        }
        return $fiche;
    } catch (Exception $e) {
        return "ERREUR " . $e->getMessage();
    }
}

function action_updateFiche($data)
{
    $fiche = tabToObject(string2Tab($data), "obj");
    $client = tabToObject(string2Tab($data), "cli");

    makeClient($client);

    $fiche['obj_id_vendeur'] = $client['cli_id'];
    try {
        updateFiche($fiche);
        return $fiche;
    } catch (Exception $e) {
        return "ERREUR " . $e->getMessage();
    }
}

function action_insertFiche($obj)
{
    $tab = string2Tab($obj);
    insertFiche($tab);
    return true;
}


function return_fiches($tri, $sens, $selection)
{
    try {
        $tab = getFiches($tri, $sens, string2Tab($selection));

        $tab['total_com'] = 0;
        foreach ($tab as $key => $val) {
            $tab['total_vente_' . $val['obj_etat']] += $val['obj_prix_vente'];

            if ($val['obj_etat'] == "PAYE") {
                $tab['total_com_paye'] += $val['obj_prix_vente'] * ($val['cli_taux_com'] / 100);
            }
            if ($val['obj_etat'] == "VENDU") {
                if ($val['obj_prix_vente'] < 1000) {
                    $tab['total_com_vendu'] += $val['obj_prix_vente'] * ($val['cli_taux_com'] / 100);
                } else {
                    $tab['total_com_vendu'] += 100;
                }
            }
            if (
                $val['obj_etat'] == "STOCK" || $val['obj_etat'] == "VENDU" || $val['obj_etat'] == "RENDU" || $val['obj_etat'] == "PAYE"
            ) {
                $tab['total_vente_depot'] += $val['obj_prix_vente'];
                $tab['total_depot'] += $val['cli_prix_depot'];
            }
        }
        return $tab;
    } catch (Exception $e) {
        return "ERREUR " . $e->getMessage();
    }
}


function return_fiches_express()
{
    $tab = getFichesExpress();
    return $tab;
}

function return_stat($selection)
{
    try {
        $tab = getFiches(null, "asc", string2Tab($selection));
        $tabCategLigne = [
            'prixMini' => 'Prix mini',
            'prixMaxi' => 'Prix maxi',
            'prixMoyen' => 'Prix moyen',
            'delaiMoyenSV' => 'Delai moyen Stock-Vente',
            'delaiMinSV' => 'Delai mini Stock-Vente',
            // 'delaiMoyenVP' => 'Delai mini Vente Paye',
            'delaiMoyenVR' => 'Delai mini Vente Rendu',
            'nbVeloVendeur' => 'Nombre moyen de vélo par vendeur',
            'nbVeloMaxiVendeur' => 'Nombre maxi de vélo pour un vendeur',
            'nbVeloAcheteur' => 'Nombre moyen de vélo par vendeur',
            'nbVeloMaxiAcheteur' => 'Nombre maxi de vélo pour un acheteur',

        ];

        foreach ($tabCategLigne as $keyL => $valL) {
            $tabCount[$keyL] = 0;
        }
        $tabCount['prixMini'] = 1000000;
        $tabCount['delaiMinSV'] = 1000000;

        $total = 0;
        $nb = 0;

        $totalTimeSV = 0;
        $nbTimeSV = 0;

        $totalTimeVR = 0;
        $nbTimeVR = 0;
        $tabVendeur = [];
        $tabAcheteur = [];

        foreach ($tab as $key => $val) {
            if (
                $val['obj_etat'] == "STOCK" ||
                $val['obj_etat'] == "VENDU" ||
                $val['obj_etat'] == "RENDU" ||
                $val['obj_etat'] == "PAYE"
            ) {
                if ($val['obj_prix_vente'] < $tabCount['prixMini']) {
                    $tabCount['prixMini'] = $val['obj_prix_vente'];
                }
                // prix_maxi
                if ($val['obj_prix_vente'] > $tabCount['prixMaxi']) {
                    $tabCount['prixMaxi'] = $val['obj_prix_vente'];
                }
                $total += $val['obj_prix_vente'];
                $nb++;
                if ($val['obj_date_depot'] && $val['obj_date_vente']) {
                    // echo dateMysqlInt($val['obj_date_vente']) . "-" . dateMysqlInt($val['obj_date_depot']);
                    // echo date('d/m/Y H:i:s', dateMysqlInt($val['obj_date_vente']));
                    // echo date('d/m/Y H:i:s', dateMysqlInt($val['obj_date_depot']));
                    $timeSV = dateMysqlInt($val['obj_date_vente']) - dateMysqlInt($val['obj_date_depot']);
                    if ($timeSV > 0) {
                        $totalTimeSV += $timeSV;
                        $nbTimeSV++;

                        if ($timeSV < $tabCount['delaiMinSV']) {
                            $tabCount['delaiMinSV'] = $timeSV;
                        }
                        // echo "--> " .duree2HMS($timeSV);


                    }
                    // echo "\n";
                }
                if ($val['obj_date_vente'] && $val['obj_date_retour']) {
                    $timeVR = dateMysqlInt($val['obj_date_retour']) - dateMysqlInt($val['obj_date_vente']);
                    if ($timeVR > 0) {
                        $totalTimeVR += $timeVR;
                        $nbTimeVR++;
                    }
                }

                if (!$tabVendeur[$val['obj_id_vendeur']]) {
                    $tabVendeur[$val['obj_id_vendeur']] = 0;
                }
                $tabVendeur[$val['obj_id_vendeur']]++;

                if (
                    $val['obj_etat'] == "VENDU" ||
                    $val['obj_etat'] == "PAYE"
                ) {
                    if (!$tabAcheteur[$val['obj_id_acheteur']]) {
                        $tabAcheteur[$val['obj_id_acheteur']] = 0;
                    }
                    $tabAcheteur[$val['obj_id_acheteur']]++;
                }
            }
        }
        if ($tabCount['prixMini'] == 1000000) {
            $tabCount['prixMini'] = "0 &euro;";
        } else {
            $tabCount['prixMini'] .= " &euro;";
        }
        if ($tabCount['delaiMinSV'] == 1000000) {
            $tabCount['delaiMinSV'] = "0:0:0";
        } else {
            $tabCount['delaiMinSV'] = duree2HMS($tabCount['delaiMinSV']);;
        }


        $tabCount['prixMaxi'] .= " &euro;";
        if ($total == 0) {
            $tabCount['prixMoyen'] = "0 &euro;";
        } else {
            $tabCount['prixMoyen'] = number_format($total / $nb, 2, ',', '.') . " &euro;";
        }
        $tabCount['delaiMoyenSV'] = duree2HMS($totalTimeSV / $nbTimeSV);
        $tabCount['delaiMoyenVR'] = duree2HMS($totalTimeVR / $nbTimeVR);

        if (sizeof($tabVendeur) > 0) {
            $tabCount['nbVeloMaxiVendeur'] = max($tabVendeur);
            $tabCount['nbVeloVendeur'] = number_format(array_sum($tabVendeur) / count($tabVendeur), 2, ',', '.');
        }
        if (sizeof($tabAcheteur) > 0) {
            $tabCount['nbVeloMaxiAcheteur'] = max($tabAcheteur);
            $tabCount['nbVeloAcheteur'] = number_format(array_sum($tabAcheteur) / count($tabAcheteur), 2, ',', '.');
        }
    } catch (Exception $e) {
        return "ERREUR " . $e->getMessage();
    }
    // print_r($tabCount);
    return $tabCount;
}
