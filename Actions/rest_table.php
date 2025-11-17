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

if (isset($_COOKIE['TABLE_BAV'])) {
}
else {
    $page_src = "location:../index.php";
    header($page_src);

}
