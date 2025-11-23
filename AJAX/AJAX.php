<?php
error_reporting(E_ERROR);

ini_set("allow_url_fopen", false);

require_once "../Commun/commun_functions.php";
require_once "../Commun/connect.php";
require_once "../config.ini";
require_once "../Repository/base_repository.php";
require_once "../Repository/parametre_repository.php";
require_once "../Repository/fiche_repository.php";
require_once "../Repository/client_repository.php";
require_once "../Repository/faq_repository.php";
require_once "../Repository/actu_repository.php";
require_once "../Repository/counter_access_repository.php";
require_once "../Repository/avis_repository.php";
require_once "../Repository/creneau_repository.php";
require_once "../Commun/Sajax.php";
require_once "../Commun/mail.php";
require_once "../Commun/html2pdf.php";


// export en GLOBALS des parametres de l'application
$INFO_APPLI = return_infoAppli();

//Creation de l'aJAX avec tout les AJAX possible _AJAX.php
$tabFile = searchFiles("AJAX", "_AJAX.php");
foreach ($tabFile as $val) {
    include_once $val;
}

/**
 * Fonction de confirmation de la connexion
 */
function whatYourName($pass)
{
    if (password_verify($pass, $GLOBALS['PASS_ADMIN'])) {
        return $GLOBALS['PASS_ADMIN'];
    } else {
        return null;
    }
}

/**
 * tranformation d'un tableau en object PHP
 */
function tabToObject($dataObj, $trigramme)
{
    foreach ($dataObj as $key => $val) {
        if (substr($key, 0, 4) == $trigramme . '_') {
            $obj[$key] = $val;
        }
    }
    return $obj;
}

/**
 * Transformation d'un string JSON en tableau
 */
function string2Tab($obj)
{
    $json = "";
    if ($obj) {
        $obj = str_replace('%u20AC', '€', $obj);
        $json = json_decode($obj, true);
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
                echo ' - Erreur de syntaxe ; JSON mal formé';
                print_r($obj);
                break;
            case JSON_ERROR_UTF8:
                $obj8 = utf8_encode($obj);
                $obj8 = str_replace('â¬', '€', $obj8);
                $json = json_decode($obj8, true);
                break;
            default:
                echo ' - Erreur inconnue';
                break;
        }
    }
    return $json;
}

/**
 * retourne les champs d'un enum de la base de donnée
 */
function return_enum($table, $champ)
{
    $tabEnum = recupEnumToArray($table, $champ);
    foreach ($tabEnum as $key => $val) {
        $tabEnum[$key] = $val;
    }
    return $tabEnum;
}

/**
 * Appel ajax pour un retour d'une liste unique de valeur dans une table/champ
 */
function return_list_unique($table, $champ)
{
    return listUnique($table, $champ);
}

/**
 * Appel Ajax pour meetre jour une page HTML avec des datas
 * date  au format --data-- dans le html
 */
function get_publiHtml($dataLC, $html)
{
    extract($GLOBALS);
    $theTab = string2Tab($dataLC);
    $theTab +=array_merge($theTab, $INFO_APPLI);
    $theTab['URL'] = $CFG_URL;
    return makeCorps($theTab, $html);
}

function delete_file($file)
{
    unlink("../" . $file);
}

/**
 * Creation d'un PDF a partir d'un html avec en nom le fichier html sans l'extension
 */
function action_makePDFFromHtml($dataPDF, $html)
{
    extract($GLOBALS);
    $tabSplit = explode(".", $html);
    $ext = $tabSplit[sizeof($tabSplit) - 1];
    $nameBase = str_replace("." . $ext, "", $html);
    $filePDF = html2pdf(string2Tab($dataPDF), "../html/$html", $nameBase);

    return $CFG_URL . $filePDF;
}

/**
 * cherche un fichier HTML dans le repertoire html, en modifiant au moins le champ URL
 */
function return_html($html)
{
    extract($GLOBALS);
    //$data = ['URL' => $CFG_URL];
    return makeCorps("", '../html/' . $html . '.html');
}

/**
 * sauvegarde d'un fichier HTML
 */
function save_html($html, $dataPDF)
{
    file_put_contents('../html/' . $html . '.html', utf8_encode($dataPDF));
    return $html;
}

function action_menage($fic)
{
    extract($GLOBALS);
    $ficSys = str_replace($CFG_URL, "", $fic);
    unlink("../$ficSys");
}

function add_counter_action($page, $modePage, $type = "")
{
// print_r("add $page");
    $tabPageSuivi= ['bav.php','news.php','avis.php','consult.php','stock_client.php','pre_depot.php','searchVente','open Link','pre_depot.php','clientV2.php','animations.php','faq.php','presse.php'];
    if  (in_array(strtolower($page), $tabPageSuivi)) {
        
        extract($GLOBALS);
        $cas['cas_page'] = $page;
        $cas['cas_mode_page'] = $modePage;
        $cas['cas_type'] = $type;
        $cas['cas_numero_bav'] = $INFO_APPLI['numero_bav'];    
        $cas['cas_navigateur'] = getBrowser();
        $cas['cas_os'] = getOSlight();
        $cas['cas_admin'] = $INFO_APPLI['ADMIN'];
        $cas['cas_ip'] = getIp();
        insertCounterAction($cas);
        // print_r("insert $page");
    }
}

function add_cdp($cdp, $lat, $lon, $plus)
{
    $tabCdp = return_all_lat_lon_cdp();

    if (!$tabCdp || !array_search($cdp, array_keys($tabCdp))) {
        $tabCdp[utf8_encode($cdp)] = $lat . "," . $lon . "," . utf8_encode($plus);
        // error_log(utf8_encode($cdp) ."=> ".$tabCdp[utf8_encode($cdp)]);    
    }
    $strFile = "";

    ksort($tabCdp);
    foreach ($tabCdp as $cdp => $value) {
        $strFile .= $cdp . "=" . $value . "\n";
        // error_log("$cdp => $value");    
    }

    // $strFile = implode('\n', $tabCdp);
    file_put_contents("../Commun/cdp.txt", $strFile);
}

function return_lat_lon_cdp($cdp)
{
    $tabCdp = return_all_lat_lon_cdp();

    if (array_search($cdp, array_keys($tabCdp))) {
        return $tabCdp[$cdp];
    }
}

function return_all_lat_lon_cdp()
{
    $strCdp = file_get_contents("../Commun/cdp.txt");

    $tabFile = explode("\n", $strCdp);

    foreach ($tabFile as $key => $value) {
        // error_log($value);   
        if ($value) {
            $tabTmp = explode("=", $value);
            $tabCdp[$tabTmp[0]] = $tabTmp[1];
        }
    }
    return $tabCdp;
}

function makeCarroussel($id)
{
    // Chemin du répertoire contenant les images
    $imagesDir = "./Images/$id";
    $imagesDirSearch = "../Images/$id";

    // Ouvre le répertoire et récupère la liste des fichiers
    if (is_dir($imagesDirSearch)) {
        $files = scandir($imagesDirSearch);
    } else {
        die('Erreur : Le répertoire ' . $imagesDirSearch . ' des images n\'existe pas.');
    }

    // Filtre les fichiers pour ne garder que les images (jpg, jpeg, png, gif)
    $imageFiles = array_filter($files, function ($file) use ($imagesDirSearch) {
        $filePath = $imagesDirSearch . '/' . $file;
        return is_file($filePath) && preg_match('/\.(jpg|jpeg|png|gif)$/i', $file);
    });

    $theCarroussel = "<style>
.$id {
    width: 250px;
    /* max-width: 600px; */
    overflow: hidden;
    margin: auto;
    position: relative;
}

.$id-images {
    display: flex;
    transition: transform 0.5s ease-in-out;
}

.$id-images img {
    width: 250px;
    flex-shrink: 0;
}</style>";


    // Génère les balises <img> pour chaque image
    $theCarroussel .= "<div class='" . $id . "-images' >";
    foreach ($imageFiles as $file) {
        $imgStr = "<img src=" . $imagesDir . "/" . $file . "  />";
        $theCarroussel .= "
        <img src='" . $imagesDir . "/" . $file . "' alt='" . pathinfo($file, PATHINFO_FILENAME) . "' 
        onclick=\"alertModalInfo('" . $imgStr . "')\">";
    }
    $theCarroussel .= "</div>";
    return $theCarroussel;
}

function makeCarrousselGrand($id)
{
    // Chemin du répertoire contenant les images
    $imagesDir = "./Images/$id";
    $imagesDirSearch = "../Images/$id";

    // Ouvre le répertoire et récupère la liste des fichiers
    if (is_dir($imagesDirSearch)) {
        $files = scandir($imagesDirSearch);
    } else {
        die('Erreur : Le répertoire ' . $imagesDirSearch . ' des images n\'existe pas.');
    }

    // Filtre les fichiers pour ne garder que les images (jpg, jpeg, png, gif)
    $imageFiles = array_filter($files, function ($file) use ($imagesDirSearch) {
        $filePath = $imagesDirSearch . '/' . $file;
        return is_file($filePath) && preg_match('/\.(jpg|jpeg|png|gif)$/i', $file);
    });

    $theCarroussel = "<style>
.$id {
    width: 90%;
    height:100%vh;
    /* max-width: 600px; */
    overflow: hidden;
    margin: 0;
    position: fixed;  
    z-index:-1
}

.$id-images {
    display: flex;
    transition: transform 1s ease-in-out;
    opacity: 0.4;
}

.$id-images img {
    width: 100%;
    flex-shrink: 0;
}</style>";

    $theCarroussel .=" <div class=" . $id . " >";
    // Génère les balises <img> pour chaque image
    $theCarroussel .= "<div class='" . $id . "-images' >";
    foreach ($imageFiles as $file) {
        $imgStr = "<img src=" . $imagesDir . "/" . $file . "  />";
        $theCarroussel .= "
        <img src='" . $imagesDir . "/" . $file . "' alt='" . pathinfo($file, PATHINFO_FILENAME) . "' >";
    }
    $theCarroussel .= "</div>";
    $theCarroussel .= "</div>";
    return $theCarroussel;
}

/* *************************** AVSI ******************************* */
function add_avis($note, $commentaire)
{
    extract($GLOBALS);
    $cas['avs_note'] = $note;
    $cas['avs_commentaire'] = utf8_encode($commentaire);
    $cas['avs_numero_bav'] = $INFO_APPLI['numero_bav'];
    insertAvis($cas);

    return $cas;
}

function get_avis($withBav=false,$note=null) {
    return getAllAvisForBav($withBav,$note);
}

function get_countAvis($withBav=false) {
    return getCountByNote($withBav);
}

function delete_avis($id) {
    return deleteAvis($id);
}


sajax_init("");
// definition des fonction ajax possible

include "exportAJAX.php";
sajax_handle_client_request();
