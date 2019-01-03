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

function tabToObject($data, $trigramme)
{
    foreach ($data as $key => $val) {
        if (substr($key, 0, 4) == $trigramme.'_') {
            $obj[$key]=$val;
        }
    }
    return $obj;
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

function return_list_unique($table, $champ)
{
    return listUnique($table, $champ);
}


function get_publiHtml($data, $html)
{
    return makeCorps(string2Tab(utf8_encode($data)), $html);
}

function action_makePDFFromHtml($data, $html)
{
    extract($GLOBALS);
    $filePDF = html2pdf(string2Tab(utf8_encode($data)), "../html/$html", "reglement_" .$_COOKIE['NUMERO_BAV']);

    return $CFG_URL.$filePDF;
}

function return_html($html)
{
    return file_get_contents('../html/'.$html.'.html');
}

function save_html($html, $data)
{
//     file_put_contents('../html/'.$html.'.html', htmlspecialchars_decode(utf8_encode($data)));
     file_put_contents('../html/'.$html.'.html', utf8_encode($data));
     return $html;
}

sajax_init("");
// definition des fonction ajax possible
include "exportAJAX.php";

sajax_handle_client_request();
