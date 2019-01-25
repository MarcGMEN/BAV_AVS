<?php

require_once "../Commun/commun_functions.php";
require_once "../Commun/connect.php";
require_once "../config.ini";
require_once "../Repository/base_repository.php";
require_once "../Repository/parametre_repository.php";
require_once "../Repository/fiche_repository.php";
require_once "../Repository/client_repository.php";
require_once "../Repository/faq_repository.php";
require_once "../Commun/Sajax.php";
require_once "../Commun/mail.php";
require_once "../Commun/html2pdf.php";

ini_set('session.cookie_httponly', 1);
    
error_reporting(E_ERROR);
//Creation de l'aJAX avec tout les AJAX possible _AJAX.php
$tabFile=searchFiles("AJAX", "_AJAX.php");
foreach ($tabFile as $val) {
    include_once $val;
}

function whatYourName($pass)
{
    if (password_verify($pass, $GLOBALS['PASS_ADMIN'])) {
        //setcookie("AADD", 1, time()+1000, '/') or die('unable to create cookie');
        //$_COOKIE['AADD']=1;
        return $GLOBALS['PASS_ADMIN'];
    } else {
        //setcookie('AADD', null, 0, "/")  or die('unable to remove cookie');
        //$_COOKIE['AADD']=0;
        return null;
    }
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
    $obj = str_replace('%u20AC', '€', $obj);
    $json= json_decode($obj, true);
    switch (json_last_error()) {
        case JSON_ERROR_NONE:
            //echo ' - Aucune erreur';
            break;
        case JSON_ERROR_DEPTH:
            echo ' - Profondeur maximale atteinte';
            break;
        case JSON_ERROR_STATE_MISMATCH:
            echo ' - Inadéquation des modes ou underflow';
            break;
        case JSON_ERROR_CTRL_CHAR:
            echo ' - Erreur lors du contrôle des caractères';
            break;
        case JSON_ERROR_SYNTAX:
            echo ' - Erreur de syntaxe ; JSON malformé';
            break;
        case JSON_ERROR_UTF8:
            $obj8 = utf8_encode2($obj);
            $obj8 = str_replace('â‚¬', '€', $obj8);
            $json =json_decode($obj8, true);
            break;
        default:
            echo ' - Erreur inconnue';
            break;
    }
    /*$tabArg = explode("#2C", $obj);
    $tab=array();
    foreach ($tabArg as $val) {
        $tabTmp = explode("#3D", $val);
        if ($tabTmp[0]) {
            $tab[$tabTmp[0]]=$tabTmp[1];
        }
    }
    return $tab;*/
    return $json;
}
    
function return_enum($table, $champ)
{
    $tabEnum = recupEnumToArray($table, $champ);
    foreach ($tabEnum as $key => $val) {
        $tabEnum[$key]=utf8Encode($val);
    }
    return $tabEnum;
}

function return_list_unique($table, $champ)
{
    return listUnique($table, $champ);
}


function get_publiHtml($data, $html)
{
    return makeCorps(string2Tab($data), $html);
}

function action_makePDFFromHtml($data, $html)
{
    extract($GLOBALS);
    $filePDF = html2pdf(string2Tab($data), "../html/$html", "reglement_" .$_COOKIE['NUMERO_BAV']);

    return $CFG_URL.$filePDF;
}

function return_html($html)
{
    extract($GLOBALS);
    $data=['URL'=>$CFG_URL];
	return makeCorps($data, '../html/'.$html.'.html');
}

function save_html($html, $data)
{
     file_put_contents('../html/'.$html.'.html', $data);
     return $html;
}

sajax_init("");
// definition des fonction ajax possible
include "exportAJAX.php";

sajax_handle_client_request();
