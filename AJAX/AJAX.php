<?
require_once "../Functions/commun_functions.php";
require_once "../Functions/fiche_functions.php";
require_once "../Functions/client_functions.php";
require_once "../Functions/mailing_functions.php";
require_once "../Functions/parametres_functions.php";
require_once "../Commun/connect.php";
require_once "../Commun/Sajax.php";
require_once "../Commun/mail.php";
require_once("../Commun/html2pdf.class.php");


error_reporting(E_ERROR);
//Creation de l'aJAX avec tout les AJAX possible _AJAX.php
$tabFile=searchFiles("AJAX","_AJAX.php");

//@trigger_error("");

foreach ($tabFile as $val) {
	include_once $val;
}


function return_numeros_bav() {
	return get_numeros_bav(); 
}

//print_r(error_get_last());
function return_nb_fiche() {
	$nbBav=$_COOKIE["NUMERO_BAV"];
	return get_nb_fiche_from_bav($nbBav);
}

function return_nb_vendeur() {
	$nbBav=$_COOKIE["NUMERO_BAV"];
	return get_nb_vendeur_from_bav($nbBav);
}

function return_nb_acheteur() {
	$nbBav=$_COOKIE["NUMERO_BAV"];
	return get_nb_acheteur_from_bav($nbBav);
}

function return_nb_clients() {
	return get_nb_clients();
}


function return_nb_vendu() {
	$nbBav=$_COOKIE["NUMERO_BAV"];
	return get_nb_vendu($nbBav);
}

function return_nb_stock() {
	$nbBav=$_COOKIE["NUMERO_BAV"];
	return get_nb_stock($nbBav);
}

function return_nb_retour() {
	$nbBav=$_COOKIE["NUMERO_BAV"];
	return get_nb_retour($nbBav);
}


//sajax_init("");
// definition des fonction ajax possible
include "exportAJAX.php";
sajax_handle_client_request();
?>