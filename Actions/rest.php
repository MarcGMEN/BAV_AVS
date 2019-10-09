<?php

require_once "../Commun/commun_functions.php";
require_once "../Commun/connect.php";
require_once "../config.ini";
require_once "../Repository/base_repository.php";
require_once "../Repository/parametre_repository.php";
require_once "../AJAX/parametre_AJAX.php";
require_once "../Repository/fiche_repository.php";
require_once "../Repository/client_repository.php";
require_once "../Commun/Sajax.php";
require_once "../Commun/mail.php";
require_once "../Commun/html2pdf.php";

if (!isset($_COOKIE['NUMERO_BAV'])) {
    setcookie('NUMERO_BAV', date('Y'), time() + (86400 * 30), "/"); // 86400 = 1 day
    $_COOKIE['NUMERO_BAV'] = date('Y');
}

$par = return_infoAppli();
// demande de confirmation de la fiche;
if ($GET_a == "C") {
    try {
        $fiche = getOneFicheByIdModif($GET_id);
        if ($fiche) {
            if (trim($fiche['obj_etat']) == "INIT") {
                $fiche['obj_etat'] = 'CONFIRME';

                makeNumeroFiche($FICHE_INFO, $fiche);

                //$row['obj_date_depot_FR'] = formateDateMYSQLtoFR($row['obj_date_depot'], true);
                $tabPlus['obj_date_depot_FR_SH'] = formateDateMYSQLtoFR($fiche['obj_date_depot'], false);

                $client = getOneClient($fiche['obj_id_vendeur']);

                $tabPlus['titre'] = $par['titre'];
                $tabPlus['URL'] = $CFG_URL;

                // convert en PDF
                $filePDF = html2pdf(array_merge($fiche, $client, $tabPlus), "fiche_depot.html", "Fiche_" . $fiche['obj_numero']);

                //updateFiche($fiche);
                updateFiche($fiche);

                $tabPlus['lien_update_fiche'] = $CFG_URL . "/index.php?modePage=rest&id=" . $fiche['obj_id_modif'];
                $tabPlus['lien_vue-client'] = $CFG_URL . "/index.php?modePage=rest&id=" . $client['cli_id_modif'];
                $tabPlus['lien_print_fiche'] = $CFG_URL . "/Actions/rest.php?a=I&id=" . $fiche['obj_id_modif'];

                if ($fiche['obj_prix_depot'] == 0) {
                    $tabPlus['obj_prix_depot'] = 'A renseigner le jour du dépôt dernier délai';
                    $fiche['obj_prix_depot'] = 0;
                } else {
                    $tabPlus['obj_prix_depot'] = $fiche['obj_prix_depot'] . " €";
                }

                $tabPlus['obj_prix_vente'] = "<u style='color:blue'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </u>";
                $tabPlus['cli_com'] = "<u style='color:blue'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>";
                // envoi du mel au client
                $titreMel = "Enregistrement correct de votre fiche " . $fiche['obj_numero'];
                $message = makeMessage($titreMel, array_merge($fiche, $client, $tabPlus), "mel_confirme.html");

                //$retour = sendMail($titreMel, $client['cli_emel'], $message, $CFG_PROJET.$filePDF);
                $retour = sendMail($titreMel, $client['cli_emel'], $message);
                if ($retour == 1) {
                    $retour = "Un mel de confirmation avec votre fiche n°[" .
                        $fiche['obj_numero'] . "] de dépôt vous a été envoyé à : " . $client['cli_emel'];
                    $retour .= "<br/>Merci pour votre dépot. Vous allez recevoir un mel avec la fiche de dépôt à imprimer.";
                }
            } else {
                $retour = "Fiche déjà confirmé avec le n°[" . $fiche['obj_numero'] . "].";
            }
        } else {
            $retour = "Fiche déjà confirmé.";
        }
    } catch (Exception $e) {
        $retour = $e->getMessage();
    }
    $page_src = "location:../index.php?message=$retour";
}

if ($GET_a == "I") {
    try {
        $page_src = "location:../index.php";
        $fiche = getOneFicheByIdModif($GET_id);
        if ($fiche) {
            //if (trim($fiche['obj_etat']) == "CONFIRME") {

            //$row['obj_date_depot_FR'] = formateDateMYSQLtoFR($row['obj_date_depot'], true);
            $tabPlus['obj_date_depot_FR_SH'] = formateDateMYSQLtoFR($fiche['obj_date_depot'], false);

            $client = getOneClient($fiche['obj_id_vendeur']);

            if ($fiche['obj_prix_vente'] != $fiche['obj_prix_depot'] && $fiche['obj_prix_vente'] > 0) {
                $fiche['obj_prix_depot'] = "<s>" . $fiche['obj_prix_depot'] . " €</s><span style='color:RED'>" . $fiche['obj_prix_vente'] . "</span>";
            }

            if ($fiche['obj_prix_vente'] > 0) {
                if ($fiche['obj_prix_vente'] < 1000) {
                    $client['cli_com'] = $fiche['obj_prix_vente'] * ($client['cli_taux_com'] / 100);
                } else {
                    $client['cli_com'] = 100;
                }
            } else {
                $fiche['obj_prix_vente'] = "<u style='color:blue'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </u>";
                $client['cli_com'] = "<u style='color:blue'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>";
            }

            $tabPlus['titre'] = $par['titre'];
            $tabPlus['URL'] = $CFG_URL;

            $fiche['obj_description'] = str_replace("\n", " / ", $fiche['obj_description']);
            $fiche['obj_description'] = str_replace("<br/>", " / ", $fiche['obj_description']);
            
            // convert en PDF
            $filePDF = html2pdf(array_merge($fiche, $client, $tabPlus), "fiche_depot.html", "Fiche_" . $fiche['obj_numero']);

            $page_src = "location:" . $CFG_PROJET . $filePDF;
            //              echo $page_src;
            //header($page_src);
        } else {
            $retour = "Fiche non imprimable actuelle, contactez nous.";
        }
        /*} else {
            $retour = "Fiche inconnue";
        }*/
    } catch (Exception $e) {
        $retour = $e->getMessage();
    }
    $page_src .= "?message=$retour";
}

header($page_src);
