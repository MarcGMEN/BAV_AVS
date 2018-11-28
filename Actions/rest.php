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
    $_COOKIE['NUMERO_BAV']=date('Y');
}
$par=return_infoAppli();
// demande de confirmation de la fiche;
if ($GET_a=="C") {
    try {
        $fiche = getOneFicheByIdModif($GET_id);
        if ($fiche) {
            if (trim($fiche['obj_etat']) == "INIT") {
                $fiche['obj_etat'] = 'CONFIRME';

                // affectation du vrai numero de fiche
                $fiche['obj_numero']=getFicheLibre(700);
                // creation de idmodif
                $fiche['obj_id_modif']=substr(hash_hmac('md5', $fiche['obj_numero'], 'avs44'), 0, 5);
                //$row['obj_date_depot_FR'] = formateDateMYSQLtoFR($row['obj_date_depot'], true);
                $tabPlus['obj_date_depot_FR_SH'] = formateDateMYSQLtoFR($fiche['obj_date_depot'], false);

            
                $client = getOneClient($fiche['obj_id_vendeur']);

                $tabPlus['URL']=$CFG_URL;
                $tabPlus['titre']=$par['titre'];
            
                // convert en PDF
                $filePDF = html2pdf(array_merge($fiche, $client, $tabPlus), "fiche_depot.html", "Fiche_".$fiche['obj_numero']);

                //updateFiche($fiche);
                updateFiche($fiche);
            
                print_r($client);
                $tabPlus['lien_update_fiche']=$CFG_URL."/index.php?consult.php&id=".$fiche['obj_id_modif'];
                $tabPlus['lien_vue-client']=$CFG_URL."/index.php?consult.php&id=".$client['cli_id_modif'];

                if ($fiche['obj_prix_depot'] == "") {
                    $fiche['obj_prix_depot']='____.__';
                }
                // envoi du mel au client
                makeMessage("Confirmation", array_merge($fiche, $client, $tabPlus), "mel_confirme.html");
                $message="Un mel de confirmation avec votre fiche de dépot vous a été envoyé à : ".$client['cli_emel'];
            } else {
                $message="Fiche déjà confirmé.";
            }
        } else {
            $message="Fiche Inconnue.";
        }
    } catch (Exception $e) {
        $message=$e->getMessage();
    }
}
$page_src = "location:../index.php?message=$message";
header($page_src);
