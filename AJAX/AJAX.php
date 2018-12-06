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
require_once "../Commun/html2pdf.php";

error_reporting(E_ERROR);
//Creation de l'aJAX avec tout les AJAX possible _AJAX.php
$tabFile=searchFiles("AJAX", "_AJAX.php");
foreach ($tabFile as $val) {
    include_once $val;
}

function string2Tab($obj)
{
    $tabArg = explode("#2C", $obj);
    $tab=array();
    foreach ($tabArg as $val) {
        $tabTmp = explode("#3D", $val);
        if ($tabTmp[0]) {
            $tab[$tabTmp[0]]=$tabTmp[1];
        }
    }
    return $tab;
}
    
function return_enum($table, $champ)
{
     return recupEnumToArray($table, $champ);
}

function get_publiHtml($data, $html)
{
    return makeCorps(string2Tab(utf8_encode($data)), $html);
}

sajax_init("");
// definition des fonction ajax possible
include "exportAJAX.php";

sajax_handle_client_request();
