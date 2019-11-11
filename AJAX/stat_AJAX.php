<?php

include '../jpGraph/src/jpgraph.php';
include '../jpGraph/src/jpgraph_pie.php';
include '../jpGraph/src/jpgraph_bar.php';

/**************************************/
/**************************************/
/* STAT */
/**************************************/
/**************************************/
function return_statClient()
{
    try {
        $infoAppli = return_infoAppli();

        $tab = getClients(null, 'asc', null, false);

        $tabCount['count_code_postal'] = [];
        foreach ($tab as $key => $val) {
            $keyCDP = $val['cli_code_postal'];
            if (!isset($tabCount['count_code_postal'][$keyCDP])) {
                $tabCount['count_code_postal'][$keyCDP] = 0;
            }
            ++$tabCount['count_code_postal'][$keyCDP];
        }
    } catch (Exception $e) {
        return 'ERREUR '.$e->getMessage();
    }
    // print_r($tabCount);
    return $tabCount;
}

function return_countByTarifSup($ref) {
    $val = countBy("obj_prix_vente", ">=" , $ref);
    if ($val == 0) {
        $val = countBy("obj_prix_depot", ">=" , $ref);
    }
    return $val;

}

function return_stat($selection)
{
    try {
        $infoAppli = return_infoAppli();

        //print_r($infoAppli);
        $tab = getFiches(null, 'asc', string2Tab($selection));
        $tabCategLigne = [
            'prixMiniDepot' => 'Prix mini depot',
            'prixMaxiDepot' => 'Prix maxi depot',
            'prixMoyenDepot' => 'Prix moyen depot',
            'prixMiniVente' => 'Prix mini vente',
            'prixMaxiVente' => 'Prix maxi vente',
            'prixMoyenVente' => 'Prix moyen vente',
            'delaiMoyenSV' => 'Delai moyen Stock-Vente',
            'delaiMinSV' => 'Delai mini Stock-Vente',
            // 'delaiMoyenVP' => 'Delai mini Vente Paye',
            'delaiMoyenVR' => 'Delai mini Vente Rendu',
            'nbVeloVendeur' => 'Nombre moyen de vélo par vendeur',
            'nbVeloMaxiVendeurDepot' => 'Nombre maxi de vélo pour un vendeur',
            'nbVeloMaxiVendeurVente' => 'Nombre maxi de vélo pour un deposeur',
            'nbVeloAcheteur' => 'Nombre moyen de vélo par vendeur',
            'nbVeloMaxiAcheteur' => 'Nombre maxi de vélo pour un acheteur',
            'nbVeloPlus500' => 'Nombre de vélo au dessus de 500€',
        ];

        foreach ($tabCategLigne as $keyL => $valL) {
            $tabCount[$keyL] = 0;
        }
        $tabCount['prixMiniDepot'] = 1000000;
        $tabCount['prixMiniVente'] = 1000000;
        $tabCount['delaiMinSV'] = 1000000;

        $totalVente= 0;
        $totalDepot=0;
        $nbVente = 0;
        $nbDepot = 0;

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
        $tabCount['depot_J7'] = 0;
        $tabCount['stock_J1'] = 0;
        $tabCount['stock_J2-AM'] = 0;
        $tabCount['stock_J2-PM'] = 0;
        $tabCount['stock_J3-AM'] = 0;
        $tabCount['stock_J3-PM'] = 0;
        $tabCount['count'] = 0;
        $tabCount['nbVeloPlus500'] = 0;
        $tabCount['count_tarif'] = [];
        

        $tabTmp = ['type', 'public', 'marque', 'pratique', 'couleur'];
        foreach ($tabTmp as $key) {
            $tabCount["count_$key"] = [];
        }

        $tabTarif = [30, 50, 100, 150, 200, 250, 500, 750, 1000, 1250, 1500, 1750, 2000];

        $date['J1'] = $infoAppli['date_j1'];
        $date['J2-MIDI'] = mktime(12, 00, 00, date('n', $infoAppli['date_j2']), date('j', $infoAppli['date_j2']), date('Y', $infoAppli['date_j2']));
        $date['J3-MIDI'] = mktime(12, 00, 00, date('n', $infoAppli['date_j3']), date('j', $infoAppli['date_j3']), date('Y', $infoAppli['date_j3']));
        $date['depot_J30'] = mktime(00, 00, 00, date('n', $infoAppli['date_j1']), date('j', $infoAppli['date_j1']) - 7, date('Y', $infoAppli['date_j1']));
        $date['depot_J7'] = $infoAppli['date_j1'];

        foreach ($tab as $key => $val) {
            if (
                $val['obj_etat'] == 'STOCK' ||
                $val['obj_etat'] == 'VENDU' ||
                $val['obj_etat'] == 'RENDU' ||
                $val['obj_etat'] == 'PAYE'
            ) {
                $thePrix = $val['obj_prix_vente'];
            
                $tarifOld = '0';
                $tarifOK = false;
                foreach ($tabTarif as $valTarif) {
                    $keyTarif = $tarifOld.' -> '.($valTarif-1);
                    if (!isset($tabCount['count_tarif'][$keyTarif])) {
                        $tabCount['count_tarif'][$keyTarif] = 0;
                    }
                    if ($thePrix < $valTarif) {
                        ++$tabCount['count_tarif'][$keyTarif];
                        $tarifOK = true;
                        break;
                    }
                    $tarifOld = $valTarif;
                }
                if (!$tarifOK) {
                    ++$tabCount['count_tarif']['> '.$valTarif];
                }

                if ($thePrix >= 400) {
                    ++$tabCount['nbVeloPlus500'];
                }

                foreach ($tabTmp as $keyTmp) {
                    $keyObj = rtrim(trim($val['obj_'.$keyTmp]));
                    if (!isset($tabCount["count_$keyTmp"][$keyObj])) {
                        $tabCount["count_$keyTmp"][$keyObj] = 0;
                    }
                    ++$tabCount["count_$keyTmp"][$keyObj];
                }

                if (
                    $val['obj_etat'] == 'VENDU' ||
                    $val['obj_etat'] == 'PAYE'
                ) {
                    if ($thePrix < $tabCount['prixMiniVente']) {
                        $tabCount['prixMiniVente'] = $thePrix;
                        $tabCount['objprixMiniVente'] = $val;
                    }
                    // prix_maxi
                    if ($thePrix > $tabCount['prixMaxiVente']) {
                        $tabCount['prixMaxiVente'] = $thePrix;
                        $tabCount['objprixMaxiVente'] = $val;
                    }
                    $totalVente += $thePrix;
                    ++$nbVente;
                }    
                    
                if ($thePrix < $tabCount['prixMiniDepot']) {
                    $tabCount['prixMiniDepot'] = $thePrix;
                    $tabCount['objprixMiniDepot'] = $val;
                }
                // prix_maxi
                if ($thePrix > $tabCount['prixMaxiDepot']) {
                    $tabCount['prixMaxiDepot'] = $thePrix;
                    $tabCount['objprixMaxiDepot'] = $val;
                }
                $totalDepot += $thePrix;
                ++$nbDepot;

                $dateDepotInt = dateMysqlInt($val['obj_date_depot']);
                if ($val['obj_etat'] != "CONFIRME") {
                    if ($dateDepotInt < $infoAppli['date_j2']) {
                        $tabCount['stock_J1']++;
                    }
                    if ($dateDepotInt >= $infoAppli['date_j2'] && $dateDepotInt < $date["J2-MIDI"]) {
                        $tabCount['stock_J2-AM']++;
                    } else if ($dateDepotInt >= $date["J2-MIDI"] && $dateDepotInt < $infoAppli['date_j3']) {
                        $tabCount['stock_J2-PM']++;
                    } else if ($dateDepotInt >= $infoAppli['date_j3'] && $dateDepotInt < $date["J3-MIDI"]) {
                        $tabCount['stock_J3-AM']++;
                    } else if ($dateDepotInt >= $date["J3-MIDI"]) {
                        $tabCount['stock_J3-PM']++;
                    }
                }

                if ($val['obj_date_vente']) {
                    // echo dateMysqlInt($val['obj_date_vente']) . "-" . dateMysqlInt($val['obj_date_depot']);
                    // echo date('d/m/Y H:i:s', dateMysqlInt($val['obj_date_vente']));
                    // echo date('d/m/Y H:i:s', dateMysqlInt($val['obj_date_depot']));
                    $timeSV = dateMysqlInt($val['obj_date_vente']) - $infoAppli['date_j2'];
                    if ($timeSV > 0) {
                        $totalTimeSV += $timeSV;
                        ++$nbTimeSV;

                        if ($timeSV < $tabCount['delaiMinSV']) {
                            $tabCount['delaiMinSV'] = $timeSV;
                            $tabCount['objdelaiMinSV'] = $val;
                        }
                        // echo "--> " .duree2HMS($timeSV);
                    }

                    $dateVenteInt = dateMysqlInt($val['obj_date_vente']);
                    if ($dateVenteInt > $infoAppli['date_j2'] && $dateVenteInt < $date['J2-MIDI']) {
                        ++$tabCount['vente_J2-AM'];
                    } elseif ($dateVenteInt >= $date['J2-MIDI'] && $dateVenteInt < $infoAppli['date_j3']) {
                        ++$tabCount['vente_J2-PM'];
                    } elseif ($dateVenteInt >= $infoAppli['date_j3'] && $dateVenteInt < $date['J3-MIDI']) {
                        ++$tabCount['vente_J3-AM'];
                    } elseif ($dateVenteInt >= $date['J3-MIDI']) {
                        ++$tabCount['vente_J3-PM'];
                    }
                    // echo "\n";
                }
                if ($val['obj_date_vente'] && $val['obj_date_retour']) {
                    $timeVR = dateMysqlInt($val['obj_date_retour']) - dateMysqlInt($val['obj_date_vente']);
                    if ($timeVR > 0) {
                        $totalTimeVR += $timeVR;
                        ++$nbTimeVR;
                    }
                }

                if (!$tabVendeurDepot[$val['obj_id_vendeur']]) {
                    $tabVendeurDepot[$val['obj_id_vendeur']] = 0;
                }
                ++$tabVendeurDepot[$val['obj_id_vendeur']];


                if (
                    $val['obj_etat'] == 'VENDU' ||
                    $val['obj_etat'] == 'PAYE'
                ) {

                    if (!$tabVendeurVente[$val['obj_id_vendeur']]) {
                        $tabVendeurVente[$val['obj_id_vendeur']] = 0;
                    }
                    ++$tabVendeurVente[$val['obj_id_vendeur']];


                    if (!$tabAcheteur[$val['obj_id_acheteur']]) {
                        $tabAcheteur[$val['obj_id_acheteur']] = 0;
                    }
                    ++$tabAcheteur[$val['obj_id_acheteur']];
                }
                $dateDepotInt = dateMysqlInt($val['obj_date_depot']);
                if ($dateDepotInt < $date['depot_J30']) {
                    ++$tabCount['depot_J30'];
                } elseif ($dateDepotInt < $date['depot_J7']) {
                    ++$tabCount['depot_J7'];
                }

                $tabCount["count"]++;
            }
        }

        if ($tabCount['delaiMinSV'] == 1000000) {
            $tabCount['delaiMinSV'] = '0:0:0';
        } else {
            $tabCount['delaiMinSV'] = duree2HMS($tabCount['delaiMinSV']);
        }
        if ($tabCount['prixMiniVente'] == 1000000) {
            $tabCount['prixMiniVente'] = '0 &euro;';
        } else {
            $tabCount['prixMiniVente'] .= ' &euro;';
        }
        $tabCount['prixMaxiVente'] .= ' &euro;';
        if ($totalVente == 0) {
            $tabCount['prixMoyenVente'] = '0 &euro;';
        } else {
            $tabCount['prixMoyenVente'] = number_format($totalVente / $nbVente, 2, ',', '.').' &euro;';
        }
        
        if ($tabCount['prixMiniDepot'] == 1000000) {
            $tabCount['prixMiniDepot'] = '0 &euro;';
        } else {
            $tabCount['prixMiniDepot'] .= ' &euro;';
        }
        $tabCount['prixMaxiDepot'] .= ' &euro;';
        if ($totalDepot == 0) {
            $tabCount['prixMoyenDepot'] = '0 &euro;';
        } else {
            $tabCount['prixMoyenDepot'] = number_format($totalDepot / $nbDepot, 2, ',', '.').' &euro;';
        }
        
        
        $tabCount['delaiMoyenSV'] = duree2HMS($totalTimeSV / $nbTimeSV);
        $tabCount['delaiMoyenVR'] = duree2HMS($totalTimeVR / $nbTimeVR);

        if (sizeof($tabVendeurVente) > 0) {
            $tabCount['nbVeloMaxiVendeurVente'] = max($tabVendeurVente);
            $tabCount['clinbVeloMaxiVendeurVente'] = getOneClient(array_search(max($tabVendeurVente), $tabVendeurVente));
            $tabCount['nbVeloVendeurVente'] = number_format(array_sum($tabVendeurVente) / count($tabVendeurVente), 2, ',', '.');
        }
        if (sizeof($tabVendeurDepot) > 0) {
            $tabCount['nbVeloMaxiVendeurDepot'] = max($tabVendeurDepot);
            $tabCount['clinbVeloMaxiVendeurDepot'] = getOneClient(array_search(max($tabVendeurDepot), $tabVendeurDepot));
            $tabCount['nbVeloVendeurDepot'] = number_format(array_sum($tabVendeurDepot) / count($tabVendeurDepot), 2, ',', '.');
        }
        
        if (sizeof($tabAcheteur) > 0) {
            $tabCount['nbVeloMaxiAcheteur'] = max($tabAcheteur);
            $tabCount['clinbVeloMaxiAcheteur'] = getOneClient(array_search(max($tabAcheteur), $tabAcheteur));
            $tabCount['nbVeloAcheteur'] = number_format(array_sum($tabAcheteur) / count($tabAcheteur), 2, ',', '.');
        }
    } catch (Exception $e) {
        return 'ERREUR '.$e->getMessage();
    }
    // print_r($tabCount);
    return $tabCount;
}

function return_graphCount($by, $data = '')
{
    if ($data == 'client') {
        $tabCount = return_statClient();
    } else {
        $tabCount = return_stat(null);
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

function return_histoCount($by, $width = 400, $height = 250, $sort = 0, $data = '', $minima=0)
{
    if ($data == 'client') {
        $tabCount = return_statClient();
    } else {
        $tabCount = return_stat(null);
    }
    $tabUse=[];
    foreach ($tabCount["count_$by"] as $key => $val ) {
        if ($val > $minima) {
            $tabUse[$key] = $val;
        }
    }

    if ($sort == 1) {
        arsort($tabUse);
    } elseif ($sort == 2) {
        ksort($tabUse);
    }
    // $tabCount["count_$by"]=array(13,8,19,7,17,6);
    //print_r($tabCount["count_$by"]);
    // Construction du conteneur
    // Spécification largeur et hauteur
    $graph = new Graph($width, $height);

    // Réprésentation linéaire
    // Echelle lineaire ('lin') en ordonnee et pas de valeur en abscisse ('text')
    // Valeurs min et max seront determinees automatiquement
    $graph->SetScale('textlin');

    // Ajouter une ombre au conteneur
    $graph->SetShadow();

    // Fixer les marges
    $graph->img->SetMargin(40, 30, 30, 80);

    // Création du graphique histogramme
    $index = 0;
    $tabData = [];
    foreach (array_values($tabUse) as $val) {
        $tabData[$index++] = $val;
    }
    $tabData[$index] = '';
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
    $titre="Repartition par $by";
    if ($minima > 0) {
        $titre.=" (avec un minima > $minima)";
    }
    $graph->title->Set($titre);
    $graph->title->SetFont(FF_FONT1, FS_BOLD);

    // Titre pour l'axe horizontal(axe x) et vertical (axe y)
    //$graph->xaxis->title->Set($by);
    $graph->yaxis->title->Set('Nombre');
    $graph->yaxis->title->SetFont(FF_FONT1, FS_BOLD);

    // Légende pour l'axe horizontal
    $graph->xaxis->SetTickLabels(array_keys($tabUse));
    $graph->xaxis->SetLabelAngle(45);

    // Provoquer l'affichage (renvoie directement l'image au navigateur)
    $graph->Stroke("../out/img/histo_$by.png");

    return "./out/img/histo_$by.png";
}
