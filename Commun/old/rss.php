<?php
//Fonction pour re écrire les url. A modifier ou à adapter selon vos besoins
function OptimiseUrl($chaine)
{
	$chaine=strtolower($chaine);

	$accents = Array("/é/", "/è/", "/ê/","/ë/", "/ç/", "/à/", "/â/","/á/","/ä/","/ã/","/å/",
 "/î/", "/ï/", "/í/", "/ì/", "/ù/", "/ô/", "/ò/", "/ó/", "/ö/");
	$sans = Array("e", "e", "e", "e", "c", "a", "a","a", "a","a", "a", "i", "i", "i", "i",
 "u", "o", "o", "o", "o");

	$chaine = preg_replace($accents, $sans,$chaine);
	$chaine = preg_replace('#[^A-Za-z0-9]#','-',$chaine);

	// Remplace les tirets multiples par un tiret unique
	$chaine = ereg_replace( "\-+", '-', $chaine );
	// Supprime le dernier caractère si c'est un tiret
	$chaine = rtrim( $chaine, '-' );

	while (strpos($chaine,'--') !== false) $chaine = str_replace('--','-',$chaine);

	return $chaine;
}

function enteteRSS($actu) {
	global $CFG_TITRE;
	//	Entête du flux rss. A complèter selon vos besoins
	$enteteRSS="<?xml version=\"1.0\" encoding=\"iso-8859-1\" ?>\n";
	$enteteRSS.="<rss version=\"2.0\">\n";
	$enteteRSS.="<channel>\n";
	$enteteRSS.="<title>".$CFG_TITRE."</title>\n";
	$enteteRSS.="<link>"."http://".$_SERVER["SERVER_NAME"]."</link>\n";
	$enteteRSS.="<description>".$CFG_TITRE." - ".$actu."</description>\n";
	$enteteRSS.="<language>fr</language>\n\n";
	
	return $enteteRSS; 
}

function piedRSS() {
	return "</channel>\n</rss>";
}
?>