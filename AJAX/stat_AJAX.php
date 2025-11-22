<?php

include '../jpGraph/src/jpgraph.php';
include '../jpGraph/src/jpgraph_pie.php';
include '../jpGraph/src/jpgraph_bar.php';

/**************************************/
/**************************************/
/* STAT */
/**************************************/
/**************************************/

/**
 * retour d'un table avec le code postal en clef et le nb d'occurences
 */
function return_statClient($qui)
{
    try {
        $tab = getClients(null, 'asc', null, $qui);

        $tabCount = [];
        foreach ($tab as $key => $val) {
            $keyCDP = $val['cli_code_postal'];
            // if ($val['cli_ville'] != "") {
            //     $keyCDP .= " ".strtoupper(retraitAccent(str_replace('  ',' ',str_replace('-',' ',$val['cli_ville']))));
            // }
            
            if (!isset($tabCount[$keyCDP])) {
                $tabCount[$keyCDP] = 0;
            }
            ++$tabCount[$keyCDP];
        }

        // $tabCount[]['count_adresse'] = [];
        // foreach ($tab as $key => $val) {
        //     $keyCDP = "";
        //     $virgule = "";
        //     // if ($val['cli_adresse'] != "") {
        //     //     $keyCDP = $val['cli_adresse'];
        //     //     $virgule=", ";
        //     // }
        //     if ($val['cli_code_postal'] != "") {
        //         $keyCDP .= $virgule . $val['cli_code_postal'];
        //         $virgule = ", ";
        //     }
        //     // if ($val['cli_ville'] != "") {
        //     //     $keyCDP .= $virgule.$val['cli_ville'];
        //     //     $virgule=", ";
        //     // }

        //     if (!isset($tabCount[$keyCDP]['count_adresse'])) {
        //         $tabCount[$keyCDP]['count_adresse'] = 0;
        //     }
        //     ++$tabCount[$keyCDP]['count_adresse'];
        // }
    } catch (Exception $e) {
        return 'ERREUR ' . $e->getMessage();
    }

    asort($tabCount);
    // print_r($tabCount);
    return $tabCount;
}

/**
 * Comptage des prix a partir d'une reference
 * pour deux types possible  "depot" ou "vente"
 */
function return_countByTarifSup($selection, $ref, $type = "depot")
{
    $etats = $type == "depot" ? "'STOCK','RENDU','VENDU','PAYE'" :  "'PAYE','VENDU'";
    if ($GLOBALS['INFO_APPLI']['avant_bav'] && $type == 'depot' && 
        $GLOBALS['INFO_APPLI']['numero_bav'] == $GLOBALS['INFO_APPLI']['numero_bav_active']) {
        $etats = "'CONFIRME'";
    }   
    
    return countBy(string2Tab($selection), "obj_prix_$type", ">=", $ref, $etats);
}

/**
 * retourne les stats pour une selection données
 * deux notions : depot (confirme-stock) et vente (vendu-paye)
 */
function return_statByType($selection, $type = 'depot')
{
    try {
        // recherche des fiches
        $tab = getFiches(null, 'asc', string2Tab($selection));
        $tabCategLigne = [
            "prixMini$type" => 'Prix mini depot',
            "prixMaxi$type" => 'Prix maxi depot',
            "prixMoyen$type" => 'Prix moyen depot',
            "nbVeloVendeur$type" => 'Nombre moyen de vélo par vendeur',
            "nbVeloMaxiVendeur$type" => 'Nombre maxi de vélo pour un vendeur'
        ];


        // initialisation des valeur a 0
        foreach ($tabCategLigne as $keyL => $valL) {
            $tabCount[$keyL] = 0;
        }

        // initialisation du tableau de comptage par categorie
        //$tabTmp = ['type', 'public', 'marque', 'pratique', 'couleur'];
        $tabTmp = ['type'];
        foreach ($tabTmp as $key) {
            $tabCount["tab_$key"] = [];
        }

        // le prix min et maxi pour le premier
        $tabCount["prixMini$type"] = 1000000;

        // initialisation du tableau de repartition des tarifs
        $tabCount['tab_tarif'] = [];

        $tabCount['count_' . $type] = 0;
        $tabVendeur = [];
        $tabAcheteur = [];

        // initi du total
        $total = 0;
        // le nombre
        $nb = 0;

        // tranches de repartition des tarifs
        $tabTarif = [30, 50, 100, 150, 200, 250, 500, 750, 1000, 1250, 1500, 1750, 2000];

        if ($GLOBALS['INFO_APPLI']['avant_bav']  && $type == 'depot' && 
            $GLOBALS['INFO_APPLI']['numero_bav'] == $GLOBALS['INFO_APPLI']['numero_bav_active']) {
            $type = 'pre-depot';
        }
        // les etats pour la recherche
        if ($type == "depot") {
            $etats = ['STOCK', 'RENDU', 'VENDU', 'PAYE'];
            $champPrix = "obj_prix_depot";
        } else if ($type == "pre-depot") {
            $etats = ['CONFIRME'];
            $champPrix = "obj_prix_depot";
            $type = 'depot';
        } else {
            $etats = ['VENDU', 'PAYE'];
            $champPrix = "obj_prix_vente";
        }

        // iteration de la selection des fiches
        foreach ($tab as $key => $val) {
            if (in_array($val['obj_etat'], $etats)) {

                // recherche du prix a travailler
                $thePrix = $val[$champPrix];

                // creation du tableau pour la repartition des prix
                $tarifOld = '0';
                $tarifOK = false;
                foreach ($tabTarif as $valTarif) {
                    $keyTarif = $tarifOld . ' -> ' . ($valTarif - 1);
                    if (!isset($tabCount['tab_tarif'][$keyTarif])) {
                        $tabCount['tab_tarif'][$keyTarif] = 0;
                    }
                    if ($thePrix < $valTarif) {
                        ++$tabCount['tab_tarif'][$keyTarif];
                        $tarifOK = true;
                        break;
                    }
                    $tarifOld = $valTarif;
                }
                if (!$tarifOK) {
                    ++$tabCount['tab_tarif']['> ' . $valTarif];
                }

                // comptage par categorie
                foreach ($tabTmp as $keyTmp) {
                    $keyObj = rtrim(trim($val['obj_' . $keyTmp]));
                    if (!isset($tabCount["tab_$keyTmp"][$keyObj])) {
                        $tabCount["tab_$keyTmp"][$keyObj] = 0;
                    }
                    ++$tabCount["tab_$keyTmp"][$keyObj];
                }

                // prix mini
                if ($thePrix < $tabCount["prixMini$type"]) {
                    $tabCount["prixMini$type"] = $thePrix;
                    $tabCount["objprixMini$type"] = $val;
                }
                // prix_maxi
                if ($thePrix > $tabCount["prixMaxi$type"]) {
                    $tabCount["prixMaxi$type"] = $thePrix;
                    $tabCount["objprixMaxi$type"] = $val;
                }
                $total += $thePrix;
                ++$nb;

                if (!$tabVendeur[$val['obj_id_vendeur']]) {
                    $tabVendeur[$val['obj_id_vendeur']] = 0;
                }
                ++$tabVendeur[$val['obj_id_vendeur']];

                if (
                    $val['obj_etat'] == 'VENDU' ||
                    $val['obj_etat'] == 'PAYE'
                ) {
                    if (!$tabAcheteur[$val['obj_id_acheteur']]) {
                        $tabAcheteur[$val['obj_id_acheteur']] = 0;
                    }
                    ++$tabAcheteur[$val['obj_id_acheteur']];
                }
                $tabCount["count_$type"]++;
            }
        }

        if ($tabCount["prixMini$type"] == 1000000) {
            $tabCount["prixMini$type"] = '0 &euro;';
        } else {
            $tabCount["prixMini$type"] .= ' &euro;';
        }
        $tabCount["prixMaxi$type"] .= ' &euro;';
        if ($total == 0) {
            $tabCount["prixMoyen$type"] = '0 &euro;';
        } else {
            $tabCount["prixMoyen$type"] = number_format($total / $nb, 2, ',', '.') . ' &euro;';
        }

        if (sizeof($tabVendeur) > 0) {
            $tabCount["nbVeloMaxiVendeur$type"] = max($tabVendeur);
            $tabCount["clinbVeloMaxiVendeur$type"] = getOneClient(array_search(max($tabVendeur), $tabVendeur));
            $tabCount["nbVeloVendeur$type"] = number_format(array_sum($tabVendeur) / count($tabVendeur), 2, ',', '.');
        }

        if (sizeof($tabAcheteur) > 0) {
            $tabCount['nbVeloMaxiAcheteur'] = max($tabAcheteur);
            $tabCount['clinbVeloMaxiAcheteur'] = getOneClient(array_search(max($tabAcheteur), $tabAcheteur));
            $tabCount['nbVeloAcheteur'] = number_format(array_sum($tabAcheteur) / count($tabAcheteur), 2, ',', '.');
        }
    } catch (Exception $e) {
        return 'ERREUR ' . $e->getMessage();
    }
    // print_r($tabCount);
    return $tabCount;
}

function return_statDelais()
{
    try {
        $tab = getFiches(null, 'asc', null);
        $tabCategLigneDelai = [
            "delaiMoyenSV" => 'Delai moyen Stock-Vente',
            "delaiMinSV" => 'Delai mini Stock-Vente',
            "delaiMoyenVP" => 'Delai mini Vente Paye',
            "delaiMoyenVR" => 'Delai mini Vente Rendu',
            'nbVeloAcheteur' => 'Nombre moyen de vélo par vendeur',
            'nbVeloMaxiAcheteur' => 'Nombre maxi de vélo pour un acheteur',
        ];

        foreach ($tabCategLigneDelai as $keyL => $valL) {
            $tabCount[$keyL] = 0;
        }
        $tabCount['delaiMinSV'] = 1000000;

        $total = 0;
        $nb = 0;

        $totalTimeSV = 0;
        $nbTimeSV = 0;

        $totalTimeVR = 0;
        $nbTimeVR = 0;

        foreach ($tab as $key => $val) {
            if (
                $val['obj_etat'] == 'STOCK' ||
                $val['obj_etat'] == 'VENDU' ||
                $val['obj_etat'] == 'RENDU' ||
                $val['obj_etat'] == 'PAYE'
            ) {

                //calcul du delai de depot > vente
                if ($val['obj_date_vente']) {
                    $timeSV = dateMysqlInt($val['obj_date_vente']) - dateMysqlInt($val['obj_date_depot']);
                    if ($timeSV > 0) {
                        $totalTimeSV += $timeSV;
                        ++$nbTimeSV;

                        if ($timeSV < $tabCount['delaiMinSV']) {
                            $tabCount['delaiMinSV'] = $timeSV;
                            $tabCount['objdelaiMinSV'] = $val;
                        }
                    }
                }
                if ($val['obj_date_vente'] && $val['obj_date_retour']) {
                    $timeVR = dateMysqlInt($val['obj_date_retour']) - dateMysqlInt($val['obj_date_vente']);
                    if ($timeVR > 0) {
                        $totalTimeVR += $timeVR;
                        ++$nbTimeVR;
                    }
                }
            }
        }

        if ($tabCount['delaiMinSV'] == 1000000) {
            $tabCount['delaiMinSV'] = '0:0:0';
        } else {
            $tabCount['delaiMinSV'] = duree2HMS($tabCount['delaiMinSV']);
        }

        $tabCount['delaiMoyenSV'] = duree2HMS($totalTimeSV / $nbTimeSV);
        $tabCount['delaiMoyenVR'] = duree2HMS($totalTimeVR / $nbTimeVR);
    } catch (Exception $e) {
        return 'ERREUR ' . $e->getMessage();
    }
    // print_r($tabCount);
    return $tabCount;
}

/**
 * stat de la repartion des depots et ventes sur le 3 jours
 */
function return_statRepartition()
{
    try {
        $tab = getFiches(null, 'asc', null);

        $tabCount['vente_J2-AM'] = 0;
        $tabCount['vente_J2-PM'] = 0;
        $tabCount['vente_J3-AM'] = 0;
        $tabCount['vente_J3-PM'] = 0;
        $tabCount['depot_J30'] = 0;
        $tabCount['depot_J7'] = 0;
        $tabCount['stock_J1'] = 0;
        $tabCount['stock_J2-AM'] = 0;
        $tabCount['stock_J2-PM'] = 0;
        $tabCount['stock_J3-AM'] = 0;
        $tabCount['stock_J3-PM'] = 0;

        $paramBAV = getOneParemetre($GLOBALS['INFO_APPLI']['numero_bav']);

        $date_j1 = strtotime($paramBAV['par_date_debut_depot']);
        $date_j2 = strtotime($paramBAV['par_date_debut_vente']);
        $date_j3 = strtotime($paramBAV['par_date_fin_bav']);
        // init de date
        $date['J1'] = $date_j1;
        $date['J2-MATIN'] = $date_j2;
        $date['J2-MIDI'] = mktime(12, 00, 00, date('n', $date_j2), date('j', $date_j2), date('Y', $date_j2));
        $date['J3-MATIN'] = $date_j3;
        $date['J3-MIDI'] = mktime(12, 00, 00, date('n', $date_j3), date('j', $date_j3), date('Y', $date_j3));
        $date['depot_J30'] = mktime(00, 00, 00, date('n', $date_j1), date('j', $date_j1) - 7, date('Y', $date_j1));
        $date['depot_J7'] = $date_j1;

        foreach ($tab as $key => $val) {
            if (
                $val['obj_etat'] == 'CONFIRME' ||
                $val['obj_etat'] == 'STOCK' ||
                $val['obj_etat'] == 'VENDU' ||
                $val['obj_etat'] == 'RENDU' ||
                $val['obj_etat'] == 'PAYE'
            ) {
                $dateDepotInt = dateMysqlInt($val['obj_date_depot']);
                if ($dateDepotInt < $date['depot_J30']) {
                    $tabCount['depot_J30']++;
                }
                elseif ($dateDepotInt < $date['depot_J7']) {
                    $tabCount['depot_J7']++;
                }
                if ($dateDepotInt < $date['J2-MATIN'] && $dateDepotInt >= $date['depot_J7']) {
                    $tabCount['stock_J1']++;
                }
                if ($dateDepotInt >= $date['J2-MATIN'] && $dateDepotInt < $date["J2-MIDI"]) {
                    $tabCount['stock_J2-AM']++;
                } elseif ($dateDepotInt >= $date["J2-MIDI"] && $dateDepotInt < $date['J3-MATIN']) {
                    $tabCount['stock_J2-PM']++;
                } elseif ($dateDepotInt >= $date['J3-MATIN'] && $dateDepotInt < $date["J3-MIDI"]) {
                    $tabCount['stock_J3-AM']++;
                } elseif ($dateDepotInt >= $date["J3-MIDI"]) {
                    $tabCount['stock_J3-PM']++;
                }

                if ($val['obj_date_vente']) {
                    $dateVenteInt = dateMysqlInt($val['obj_date_vente']);
                    if ($dateVenteInt > $date['J2-MATIN'] && $dateVenteInt < $date['J2-MIDI']) {
                        ++$tabCount['vente_J2-AM'];
                    } elseif ($dateVenteInt >= $date['J2-MIDI'] && $dateVenteInt < $date['J3-MATIN']) {
                        ++$tabCount['vente_J2-PM'];
                    } elseif ($dateVenteInt >= $date['J3-MATIN'] && $dateVenteInt < $date['J3-MIDI']) {
                        ++$tabCount['vente_J3-AM'];
                    } elseif ($dateVenteInt >= $date['J3-MIDI']) {
                        ++$tabCount['vente_J3-PM'];
                    }
                    // echo "\n";
                }
            }
        }
    } catch (Exception $e) {
        return 'ERREUR ' . $e->getMessage();
    }
    //print_r($tabCount);
    return $tabCount;
}

/**
 * creation d'un fromage 
 * by : choix du champ
 * data : client ou objetVente ou objetDepot
 * trie par defaut par la clef
 */
function return_graphCount($by, $dataGraph = '')
{
   if ($dataGraph == 'vente') {
        $tabCount = return_statByType(null, "vente");
    } else {
        $tabCount = return_statByType(null, "depot");
    }

    ksort($tabCount["count_$by"]);
    // ********************************************************************
    // PARTIE : Création du graphique
    // ********************************************************************
    // On spécifie la largeur et la hauteur du graphique conteneur&#160;
    $graph = new PieGraph(400, 300);

    // Titre du graphique
    $graph->title->Set("Répartition par $by");

    // Créer un graphique secteur (classe PiePlot)
    $oPie = new PiePlot(array_values($tabCount["count_$by"]));
    // Ajouter au graphique le graphique secteur
    $graph->Add($oPie);

    // Légendes qui accompagnent chaque secteur, ici chaque année
    $oPie->SetLegends(array_keys($tabCount["count_$by"]));

    // position du graphique (légèrement à droite)
    $oPie->SetCenter(0.4);

    $oPie->SetValueType(PIE_VALUE_ABS);

    $aColors = array('white', 'black', 'green', 'yellow', 'brown', 'red', 'blue', 'lightgreen');
    $oPie->SetColor($aColors);

    // Format des valeurs de type entier
    $oPie->value->SetFormat('%d');

    // Provoquer l'affichage (renvoie directement l'image au navigateur)
    $graph->Stroke("../out/img/secteur_$by.png");

    return "./out/img/secteur_$by.png";
}

/**
 * creation d'une image hostogramme
 * by : choix du champ
 * width, height : taille 
 * sort : tri 0 rien, 1 données triées par ordre decroissant,  2 clef ordre croissant
 * data : client ou objetVente ou objetDepot
 * minima : valeur mininale a afficher, pour retire les 1 par ex
 */
function return_histoCount($selectoin, $by, $width = 400, $height = 250, $sort = 0, $dataGraph = '', $minima = 0)
{
    $tabCount['depot'] = [];
    $tabCount['vente'] = [];

     if ($dataGraph == 'mixte') {
        $tabCount['depot'] = return_statByType(null, "vente");
        $tabCount['vente'] = return_statByType(null, "depot");
    }
    elseif ($dataGraph == 'vente') {
        $tabCount['vente'] = return_statByType($selectoin, "vente");
    } else {
        $tabCount['depot'] = return_statByType($selectoin, "depot");
    }

    $tabKey=[];
    $tabUse['depot'] = [];
    foreach ($tabCount['depot']["tab_$by"] as $key => $val) {
        if ($val >= $minima) {
            $tabUse['depot'][$key] = $val;
        }
        $tabKey[]=$key;
    }
    $tabUse['vente'] = [];
    foreach ($tabCount['vente']["tab_$by"] as $key => $val) {
        if ($val >= $minima) {
            $tabUse['vente'][$key] = $val;
        }
        $tabKey[]=$key;
    }
    if ($dataGraph == 'mixte') {
        foreach ($tabKey as $key ) {
            if (!isset($tabUse['vente'][$key])) { $tabUse['vente'][$key]=0;}
            if (!isset($tabUse['depot'][$key])) { $tabUse['depot'][$key]=0;}
        }
    }

    if ($sort == 1) {
        arsort($tabUse['depot']);
        arsort($tabUse['vente']);
    } elseif ($sort == 2) {
        ksort($tabUse['vente']);
        ksort($tabUse['depot']);
    }
    // Construction du conteneur
    // Spécification largeur et hauteur
    $graph = new Graph($width, $height,'auto');

    // Réprésentation linéaire
    // Echelle lineaire ('lin') en ordonnee et pas de valeur en abscisse ('text')
    // Valeurs min et max seront determinees automatiquement
    $graph->SetScale('textlin');

    // Ajouter une ombre au conteneur
    $graph->SetShadow();

    // Fixer les marges
    $graph->img->SetMargin(40, 30, 30, 80);

    // Création du graphique histogramme
    if ($dataGraph == 'mixte' || $dataGraph == 'depot') {
       $index = 0;
        $tabData = [];
        foreach (array_values($tabUse['depot']) as $val) {
            $tabData['depot'][$index++] = $val;
        }
        if ($by =='tarif' ){
            $tabData['depot'][$index] = '';
        }
    }
    if ($dataGraph == 'mixte' || $dataGraph == 'vente') {
        $index=0;
        foreach (array_values($tabUse['vente']) as $val) {
            $tabData['vente'][$index++] = $val;
        }
        if ($by =='tarif' ){
            $tabData['vente'][$index] = '';
        }
    }
    
    if ($index > 0) {
        if ($dataGraph == 'mixte') {
            // Create the grouped bar plot
            $b1plot = new BarPlot($tabData['depot']);
            $b2plot = new BarPlot($tabData['vente']);
            $gbplot = new GroupBarPlot(array($b1plot,$b2plot));
            // ...and add it to the graPH
            $graph->Add($gbplot);

            $b1plot->SetFillColor('#00b7cd');
            $b1plot->SetColor('white');
            // Fixer l'aspect de la police
            $b1plot->value->SetFont(FF_FONT2, FS_NORMAL, 8);
            // Modifier le rendu de chaque valeur
            $b1plot->value->SetFormat('%d');
            // Afficher les valeurs pour chaque barre
            $b1plot->value->Show();

            $b2plot->SetFillColor('lightgreen');
            $b2plot->SetColor('white');
            // Fixer l'aspect de la police
            $b2plot->value->SetFont(FF_FONT2, FS_NORMAL, 8);
            // Modifier le rendu de chaque valeur
            $b2plot->value->SetFormat('%d');
            // Afficher les valeurs pour chaque barre
            $b2plot->value->Show();

        }
        else {
            //print_r($tabData);
            $bplot = new BarPlot($tabData[$dataGraph]);
            // Ajouter les barres au conteneur
            $graph->Add($bplot);
             // Spécification des couleurs des barres
            //$aColors = array('white', 'black', 'green', 'yellow', 'brown', 'red', 'blue', 'lightgreen','lightblue','salmon');
            //$bplot->SetFillColor($aColors);

            if ($dataGraph == 'depot') {
                $bplot->SetFillColor('#00b7cd');
            }
            else {
                $bplot->SetFillColor('lightgreen');
            }
            $bplot->SetColor('white');
            // $bplot->SetFillGradient('AntiqueWhite2', 'AntiqueWhite4:0.8', GRAD_VERT);
            // $bplot->SetColor('yellow');

            // Fixer l'aspect de la police
            $bplot->value->SetFont(FF_FONT2, FS_NORMAL, 10);
            // Modifier le rendu de chaque valeur
            $bplot->value->SetFormat('%d');
            // Afficher les valeurs pour chaque barre
            $bplot->value->Show();
        }
        // Le titre
        $titre = "Repartition par $by";
        if ($minima > 0) {
            $titre .= " (avec un minima > $minima)";
        }
        $graph->title->Set($titre);
        $graph->title->SetFont(FF_FONT1, FS_BOLD);

        // Titre pour l'axe horizontal(axe x) et vertical (axe y)
        //$graph->xaxis->title->Set($by);
        $graph->yaxis->title->Set('Nombre');
        $graph->yaxis->title->SetFont(FF_FONT1, FS_BOLD);

        // Légende pour l'axe horizontal
        if ($dataGraph == 'mixte') {
            $graph->xaxis->SetTickLabels(array_keys($tabUse['vente']));
        }
        else {
            $graph->xaxis->SetTickLabels(array_keys($tabUse[$dataGraph]));
        }
        $graph->xaxis->SetLabelAngle(45);

        // Provoquer l'affichage (renvoie directement l'image au navigateur)
        $graph->Stroke("../out/img/histo_" . $by . "_" . $dataGraph . ".png");
        return "./out/img/histo_" . $by . "_" . $dataGraph . ".png";
    } else {
        return "./Images/avs.png";
    }
}
