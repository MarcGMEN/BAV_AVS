<?php
include("../jpGraph/src/jpgraph.php");
include("../jpGraph/src/jpgraph_pie.php");
include("../jpGraph/src/jpgraph_bar.php");

/**************************************/
/**************************************/
/* STAT */
/**************************************/
/**************************************/

function return_stat($selection)
{
    try {

        $infoAppli = return_infoAppli();

        //print_r($infoAppli);
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


        $tabCount['vente_J2-AM'] = 0;
        $tabCount['vente_J2-PM'] = 0;
        $tabCount['vente_J3-AM'] = 0;
        $tabCount['vente_J3-PM'] = 0;
        $tabCount['depot_J30'] = 0;
        $tabCount['depot_J15'] = 0;
        $tabCount['stock_J1'] = 0;
        $tabCount['stock_J2-AM'] = 0;
        $tabCount['stock_J2-PM'] = 0;
        $tabCount['stock_J3-AM'] = 0;
        $tabCount['stock_J3-PM'] = 0;
        $tabCount["count"] = 0;
        $tabCount["count_tarif"] = [];

        $tabTmp = ['type', 'public', 'marque', 'pratique', 'couleur'];
        foreach ($tabTmp as $key) {
            $tabCount["count_$key"] = [];
        }

        $tabTarif = [30, 50, 100, 150, 200, 250, 500, 750, 1000, 1250, 1500, 1750, 2000];

        $date["J1"] = $infoAppli['date_j1'];
        $date["J2-MIDI"] = mktime(12, 00, 00, date("n", $infoAppli['date_j2']), date("j", $infoAppli['date_j2']), date("Y", $infoAppli['date_j2']));
        $date["J3-MIDI"] = mktime(12, 00, 00, date("n", $infoAppli['date_j3']), date("j", $infoAppli['date_j3']), date("Y", $infoAppli['date_j3']));
        $date["depot_J30"] = mktime(00, 00, 00, date("n", $infoAppli['date_j1']), date("j", $infoAppli['date_j1']) - 15, date("Y", $infoAppli['date_j1']));
        $date["depot_J15"] = $infoAppli['date_j1'];

        foreach ($tab as $key => $val) {
            if (
                $val['obj_etat'] == "CONFIRME" ||
                $val['obj_etat'] == "STOCK" ||
                $val['obj_etat'] == "VENDU" ||
                $val['obj_etat'] == "RENDU" ||
                $val['obj_etat'] == "PAYE"
            ) {
                if ($val['obj_etat'] == "CONFIRME") {
                    $thePrix = $val['obj_prix_depot'];
                } else {
                    $thePrix = $val['obj_prix_vente'];
                }

                $tarifOld = "0";
                $tarifOK = false;
                foreach ($tabTarif as $valTarif) {
                    $keyTarif = $tarifOld . " -> " . $valTarif;
                    if (!isset($tabCount["count_tarif"][$keyTarif])) {
                        $tabCount["count_tarif"][$keyTarif] = 0;
                    }
                    if ($thePrix <= $valTarif) {
                        $tabCount["count_tarif"][$keyTarif]++;
                        $tarifOK = true;
                        break;
                    }
                    $tarifOld = $valTarif;
                }
                if (!$tarifOK) {
                    $tabCount["count_tarif"]["> " . $valTarif]++;
                }

                foreach ($tabTmp as $keyTmp) {
                    $keyObj = rtrim(trim($val['obj_' . $keyTmp]));
                    if (!isset($tabCount["count_$keyTmp"][$keyObj])) {
                        $tabCount["count_$keyTmp"][$keyObj] = 0;
                    }
                    $tabCount["count_$keyTmp"][$keyObj]++;
                }

                if ($thePrix < $tabCount['prixMini']) {
                    $tabCount['prixMini'] = $thePrix;
                    $tabCount['objprixMini'] = $val;
                }
                // prix_maxi
                if ($thePrix > $tabCount['prixMaxi']) {
                    $tabCount['prixMaxi'] = $thePrix;
                    $tabCount['objprixMaxi'] = $val;
                }
                $total += $thePrix;
                $nb++;


                $dateDepotInt = dateMysqlInt($val['obj_date_depot']);
                if ($dateDepotInt < $infoAppli['date_j2']) {
                    $tabCount['stock_J1']++;
                }
                if ($dateDepotInt > $infoAppli['date_j2'] && $dateDepotInt < $date["J2-MIDI"]) {
                    $tabCount['stock_J2-AM']++;
                } else if ($dateDepotInt >= $date["J2-MIDI"] && $dateDepotInt < $infoAppli['date_j3']) {
                    $tabCount['stock_J2-PM']++;
                } else if ($dateDepotInt > $infoAppli['date_j3'] && $dateDepotInt < $date["J3-MIDI"]) {
                    $tabCount['stock_J3-AM']++;
                } else if ($dateDepotInt >= $date["J3-MIDI"]) {
                    $tabCount['stock_J3-PM']++;
                }

                if ($val['obj_date_vente']) {
                    // echo dateMysqlInt($val['obj_date_vente']) . "-" . dateMysqlInt($val['obj_date_depot']);
                    // echo date('d/m/Y H:i:s', dateMysqlInt($val['obj_date_vente']));
                    // echo date('d/m/Y H:i:s', dateMysqlInt($val['obj_date_depot']));
                    $timeSV = dateMysqlInt($val['obj_date_vente']) - $infoAppli['date_j2'];
                    if ($timeSV > 0) {
                        $totalTimeSV += $timeSV;
                        $nbTimeSV++;

                        if ($timeSV < $tabCount['delaiMinSV']) {
                            $tabCount['delaiMinSV'] = $timeSV;
                            $tabCount['objdelaiMinSV'] = $val;
                        }
                        // echo "--> " .duree2HMS($timeSV);
                    }

                    $dateVenteInt = dateMysqlInt($val['obj_date_vente']);
                    if ($dateVenteInt > $infoAppli['date_j2'] && $dateVenteInt < $date["J2-MIDI"]) {
                        $tabCount['vente_J2-AM']++;
                    } else if ($dateVenteInt >= $date["J2-MIDI"] && $dateVenteInt < $infoAppli['date_j3']) {
                        $tabCount['vente_J2-PM']++;
                    } else if ($dateVenteInt > $infoAppli['date_j3'] && $dateVenteInt < $date["J3-MIDI"]) {
                        $tabCount['vente_J3-AM']++;
                    } else if ($dateVenteInt >= $date["J3-MIDI"]) {
                        $tabCount['vente_J3-PM']++;
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
                $dateDepotInt = dateMysqlInt($val['obj_date_depot']);
                if ($dateDepotInt < $date["depot_J30"]) {
                    $tabCount['depot_J30']++;
                } else if ($dateDepotInt < $date["depot_J15"]) {
                    $tabCount['depot_J15']++;
                }

                $tabCount["count"]++;


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
            $tabCount['delaiMinSV'] = duree2HMS($tabCount['delaiMinSV']);
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
            $tabCount['clinbVeloMaxiVendeur'] = getOneClient(array_search(max($tabVendeur), $tabVendeur));
            $tabCount['nbVeloVendeur'] = number_format(array_sum($tabVendeur) / count($tabVendeur), 2, ',', '.');
        }
        if (sizeof($tabAcheteur) > 0) {
            $tabCount['nbVeloMaxiAcheteur'] = max($tabAcheteur);
            $tabCount['clinbVeloMaxiAcheteur'] = getOneClient(array_search(max($tabAcheteur), $tabAcheteur));
            $tabCount['nbVeloAcheteur'] = number_format(array_sum($tabAcheteur) / count($tabAcheteur), 2, ',', '.');
        }
    } catch (Exception $e) {
        return "ERREUR " . $e->getMessage();
    }
    // print_r($tabCount);
    return $tabCount;
}

function return_graphCount($by)
{
    $tabCount = return_stat(null);
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

function return_histoCount($by, $width = 400, $height = 250, $sort = 0)
{
    $tabCount = return_stat(null);
    if ($sort == 1) {
        arsort($tabCount["count_$by"]);
    } else if ($sort == 2) {
        ksort($tabCount["count_$by"]);
    }
    // $tabCount["count_$by"]=array(13,8,19,7,17,6);
    //print_r($tabCount["count_$by"]);
    // Construction du conteneur
    // Spécification largeur et hauteur
    $graph = new Graph($width, $height);

    // Réprésentation linéaire
    // Echelle lineaire ('lin') en ordonnee et pas de valeur en abscisse ('text')
    // Valeurs min et max seront determinees automatiquement
    $graph->SetScale("textlin");

    // Ajouter une ombre au conteneur
    $graph->SetShadow();

    // Fixer les marges
    $graph->img->SetMargin(40, 30, 30, 80);

    // Création du graphique histogramme
    $index = 0;
    $tabData = [];
    foreach (array_values($tabCount["count_$by"]) as $val) {
        $tabData[$index++] = $val;
    }
    $tabData[$index] = "";
    //print_r($tabData);
    $bplot = new BarPlot($tabData);
    // Ajouter les barres au conteneur
    $graph->Add($bplot);

    // Spécification des couleurs des barres
    $aColors = array('white', 'black', 'green', 'yellow', 'brown', 'red', 'blue', 'lightgreen');
    //$bplot->SetFillColor($aColors);
    $bplot->SetFillGradient('AntiqueWhite2', 'AntiqueWhite4:0.8', GRAD_VERT);
    $bplot->SetColor('yellow');

    // Fixer l'aspect de la police
    $bplot->value->SetFont(FF_FONT2, FS_NORMAL, 10);
    // Modifier le rendu de chaque valeur
    $bplot->value->SetFormat('%d');
    // Afficher les valeurs pour chaque barre
    $bplot->value->Show();

    // Le titre
    $graph->title->Set("Repartition par $by");
    $graph->title->SetFont(FF_FONT1, FS_BOLD);

    // Titre pour l'axe horizontal(axe x) et vertical (axe y)
    //$graph->xaxis->title->Set($by);
    $graph->yaxis->title->Set("Nombre");
    $graph->yaxis->title->SetFont(FF_FONT1, FS_BOLD);

    // Légende pour l'axe horizontal
    $index = 0;
    $tabTick = [];
    foreach (array_keys($tabCount["count_$by"]) as $val) {
        $tabTick[$index++] = $val;
    }
    $graph->xaxis->SetTickLabels($tabTick);
    $graph->xaxis->SetLabelAngle(45);

    // Provoquer l'affichage (renvoie directement l'image au navigateur)
    $graph->Stroke("../out/img/histo_$by.png");

    return "./out/img/histo_$by.png";
}
