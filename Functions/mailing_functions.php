<?php
function get_countMail() {
	$requete2 = " SELECT count(*) from mailing  ";
	$resultat = mysql_query ( $requete2 );
	if ($row = mysql_fetch_array ( $resultat, MYSQL_ASSOC )) {
		return $row ['count(*)'];
	}
	return 0;
}
function get_countMailAEnvoyer() {
	$requete2 = " SELECT count(*) from mailing where iml_date is null or iml_date = '0000-00-00' ";
	$resultat = mysql_query ( $requete2 );
	if ($row = mysql_fetch_array ( $resultat, MYSQL_ASSOC )) {
		return $row ['count(*)'];
	}
	return 0;
}

function get_countMailEnErreur() {
	$requete2 = " SELECT count(*) from mailing where iml_erreur != '' ";
	$resultat = mysql_query ( $requete2 );
	if ($row = mysql_fetch_array ( $resultat, MYSQL_ASSOC )) {
		return $row ['count(*)'];
	}
	return 0;
}

function get_countMailEnvoye() {
	$requete2 = " SELECT count(*) from mailing where iml_date is not null and iml_date != '0000-00-00' ";
	$resultat = mysql_query ( $requete2 );
	if ($row = mysql_fetch_array ( $resultat, MYSQL_ASSOC )) {
		return $row ['count(*)'];
	}
	return 0;
}

function return_mailingAEnvoyer() {
	$requete2 = " SELECT iml_email from mailing where iml_date is null or iml_date = '0000-00-00' ";
	$resultat = mysql_query ( $requete2 );
	$tab = array ();
	$index=0;
	while ( $row = mysql_fetch_array ( $resultat, MYSQL_ASSOC ) ) {
		$tab [$index ++] = $row['iml_email'];
	}
	return $tab;
}

function valideEnvoi($mel) {
	$requete2 = " update mailing set iml_date = '".date('Y-m-d')."', iml_erreur = '' where iml_email = '".$mel."' ";
	mysql_query ( $requete2 );
}

function badEnvoi($mel,$ret) {
	$requete2 = " update mailing set iml_erreur = '".$ret."' where iml_email = '".$mel."' ";
	mysql_query ( $requete2 );
}

function initEnvoi() {
	$requete2 = " update mailing set iml_date = null, iml_erreur = '' ";
	if (!mysql_query($requete2)) {
		return mysql_error();
	}
	else {
		return 0;
	}
}
?>