<?php

require_once "../Commun/commun_functions.php";
require_once "../Commun/connect.php";
require_once "../config.ini";
require_once "../Repository/base_repository.php";
require_once "../Repository/parametre_repository.php";
require_once "../Repository/fiche_repository.php";
require_once "../Repository/client_repository.php";
require_once "../Commun/Sajax.php";
require_once "../Commun/mail.php";

// demande de confirmation de la fiche
if ($GET_a=="C") {
    try {
        $fiche = getOneFicheByIdModif($GET_id);
        
        if (trim($fiche['obj_etat']) == "INIT") {
            $fiche['obj_etat'] = 'CONFIRME';

            // affectation du vrai numero de fiche
            $fiche['obj_numero']=getFicheLibre(700);
            // creation de idmodif
            $fiche['obj_id_modif']=substr(hash_hmac('md5', $fiche['obj_numero'], 'avs44'), 0, 5);
            $tabPlus['obj_date_depot_FR_SH'] = formateDateMYSQLtoFR($fiche['obj_date_depot'], false);

            
            $client = getOneClient($fiche['obj_id_vendeur']);

            $tabPlus['URL']=$CFG_URL;
            
            // création de la fiche et envoi par mel
            $message = makeCorps(array_merge($fiche, $client, $tabPlus), "fiche_depot.html");
            print_r($message);
            file_put_contents("../fiche_".$fiche['obj_numero'].".html", stripslashes($message));

            //updateFiche($fiche);

            // convert en PDF

            // envoi du mel au client
            $message = makeMessage("Confirmation", array_merge($fiche, $client), "mel_confirm.html");
            print_r($message);
        } else {
            $message="Fiche déjà confirmé.";
        }
    } catch (Exception $e) {
        print_r($e);
    }
}
