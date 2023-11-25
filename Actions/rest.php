<?php

require_once "../Commun/commun_functions.php";
require_once "../Commun/connect.php";
require_once "../config.ini";
require_once "../Repository/base_repository.php";
require_once "../Repository/parametre_repository.php";
require_once "../AJAX/AJAX.php";
require_once "../AJAX/parametre_AJAX.php";
require_once "../AJAX/fiche_AJAX.php";
require_once "../Repository/fiche_repository.php";
require_once "../Repository/client_repository.php";
require_once "../Commun/Sajax.php";
require_once "../Commun/mail.php";
require_once "../Commun/html2pdf.php";

$INFO_APPLI = return_infoAppli();

if  (!isset($GET_a)) {
    $GET_a="VIDE";
}
add_counter_action("rest.php", $GET_a);
// demande de confirmation de la fiche;
if ($GET_a == "P") {
    try {
        // expiration dans a la fin de bav +24h
        $expir=$INFO_APPLI['date_j3']+60*60*21;
        
        setcookie('CAFFARD_BAV', $INFO_APPLI['numero_bav'], $expir, '/') or die('unable to create cookie');

        echo "<html><body>";
        echo "<H1>Bonjour,<br/> Votre téléphone est paramétré pour un accès vendeur à la BAV jusqu'au : ".date("d M Y H:i:s",$expir )."</h1>";
        echo "</body></html>";

    } catch (Exception $e) {
    }
}
