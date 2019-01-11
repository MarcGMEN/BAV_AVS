<?
/**
 * verification des droit d'acces a cette rubrique, module, option pour un utilisateur
 * @param unknown_type $mod
 * @param unknown_type $rub
 * @param unknown_type $option
 * @param unknown_type $user
 * @return unknown_type
 */
function verif_paramURL($tabPost, $user) {
	$retour=false;

	$option=isset($tabPost['option']) ? $tabPost['option'] : "";
	if (preg_match("[modif]",$option) || preg_match("[gestion]",$option) || preg_match("[create]",$option))  {
		//echo "modif";
		$rubOK=return_rubriqueForUserModif($tabPost['rub'], $user);

	}
	else {
		//echo "lecture";
		$rubOK=return_rubriqueForUser($tabPost['rub'], $user);
	}
	//  print_r($rubOK);
	if (sizeof($rubOK) > 0) {
		$tabBloc=return_tybFromRub($rubOK['rub_id']);
		// test sur bloc
		//print_r($tabBloc);
		foreach ($tabBloc as $valBloc) {
			//echo "niveau bloc : ".$valBloc['tyb_module'] ." ==  ".$tabPost['mod']." && ".$valBloc['tyb_option'] ."== $option <br/>" ;
			if ($valBloc['tyb_module'] == $tabPost['mod'] && $valBloc['tyb_option'] == $option ){
				$retour=true;
			}
		}
		// si pas d'acces avec un bloc verification de l'acces avec le module par defaut
		//  echo "niveau rubrique : !$retour && ".$rubOK['rub_module'] ."== ".$tabPost['mod']." <br/>";
		if (!$retour && $rubOK['rub_module'] == $tabPost['mod']) {
			$retour =true;
		}
	}
	return $retour;

}

function miseAPlat($tab, $keySous) {

	$tabRetour =  array();
	$index=0;
	foreach ($tab as $key => $val) {
		$tabRetour[]=$val;
		if (sizeof($val[$keySous]) > 0) {
			$tabRetour=array_merge($tabRetour ,miseAPlat($val[$keySous], $key));
		}
	}
	return $tabRetour;
}

function makeCheckBox($tab, $key, $val, $select) {
	$repr="";
	foreach ($tab as $keyVal => $valTab) {
		$repr.="<input type='checkbox' value='".$valTab[$key]."' name='".$keyVal."' ";
		if ($select != null  && $select==$valTab[$key]) {
			$repr.=" checked ";
		}
		$repr.=		">";
		$repr.=ltrim($valTab[$val]);
	}
	return $repr;

}

/**
 * retourne les mois en format francais
 * @param unknown_type $num_m
 * @return unknown_type
 */
function moisFrench($num_m) {
	switch ($num_m)
	{
		case 1:  $mois="janvier";break;
		case 2:  $mois="f�vrier";break;
		case 3:  $mois="mars";break;
		case 4:  $mois="avril";break;
		case 5:  $mois="mai";break;
		case 6:  $mois="juin";break;
		case 7:  $mois="juillet";break;
		case 8:  $mois="aout";break;
		case 9:  $mois="septembre";break;
		case 10: $mois="octobre";break;
		case 11: $mois="novembre";break;
		case 12: $mois="décembre";break;
	}
	return $mois;
}

/**
 * retourne les mois en format francais
 * @param unknown_type $num_m
 * @return unknown_type
 */
function jourFrench($num_j) {
	switch ($num_j)
	{
		case 0:  $jour="dimanche";break;
		case 1:  $jour="lundi";break;
		case 2:  $jour="mardi";break;
		case 3:  $jour="mercredi";break;
		case 4:  $jour="jeudi";break;
		case 5:  $jour="vendredi";break;
		case 6:  $jour="samedi";break;
		case 7:  $jour="dimanche";break;
	}
	return $jour;
}

/**
 * recherche des fichiers de config dans le repertoire config/config*.xml
 * @return unknown_type
 */
function searchFiles($rep,$mask) {
	$tabFic =array();
	$index=0;
	$trouve=false;

	for ($index = 0; $index <4; $index++) {
		if (!is_dir($rep)) {
			$rep = "../".$rep ;
		}
		else {
			$trouve=true;
			break;
		}
	}
	$index=0;
	if ($trouve && $handle = opendir($rep)) {
		while (false !== ($file = readdir($handle))) {
			if ($file != "." && $file != "..") {
				if (preg_match("[".$mask."$]", $file) > 0) {
					$tabFic[$index++]=$file;
				}
			}
		}
		closedir($handle);
	}

	return $tabFic;
}

function utf8_encode2($str) { 

    $final_str = $str; 

    $final_str = str_replace('œ', '&#339;',  $final_str); 
    $final_str = str_replace('’', '&#2019;', $final_str); 
    $final_str = str_replace('“', '&#201C;', $final_str); 
    $final_str = str_replace('”', '&#201D;', $final_str); 
    $final_str = str_replace('…', '&#2026;', $final_str); 
    $final_str = str_replace('€', '&#8364;', $final_str); 

    $final_str = utf8_encode($final_str); 

    $final_str = str_replace(utf8_encode('&#339;') , 'Å“',     $final_str); 
    $final_str = str_replace(utf8_encode('&#2019;'), 'â€™', $final_str); 
    $final_str = str_replace(utf8_encode('&#201C;'), 'â€œ', $final_str); 
    $final_str = str_replace(utf8_encode('&#2026;'), 'â€¦', $final_str); 
    $final_str = str_replace(utf8_encode('&#201D;'), 'â€', $final_str); 
    $final_str = str_replace(utf8_encode('&#8364;'), 'â‚¬', $final_str); 

    return $final_str; 
} 

function utf8Encode($texte) {
	if (CFG_UTF8_AJAX == "true" ) {
		return utf8_encode2(ltrim($texte));
	}
	else {
		return ltrim($texte);
	}
}

function utf8Decode($texte) {
	if (CFG_UTF8_AJAX == "true" ) {
		return utf8_decode(ltrim($texte));
	}
	else {
		return ltrim($texte);
	}
}

function formateDateFRtoMYSQL($dateFR) {
	$date="";
	if ($dateFR) {
		$tab_date1 = explode('/',$dateFR);
		$date=$tab_date1[2]."-".$tab_date1[1]."-".$tab_date1[0];
	}

	return $date;

}
function formateDateMYSQLtoFR($date,$heure=false) {
	$motif='`(\d{4})-(\d{1,2})-(\d{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})`';
	$dateR="";
	if ($date) {
		if (preg_match($motif,$date)) {
			$tab_date = explode(' ',$date);
		}
		else {
			$tab_date[0]=$date;
		}
		$tab_date1 = explode('-',$tab_date[0]);

		$dateR=$tab_date1[2]."/".$tab_date1[1]."/".$tab_date1[0];
		
		if ($dateR!="00/00/0000") {
			if ($heure && isset($tab_date[1])) {
				$dateR.=" à ".$tab_date[1];
			}
		}
		else {
			$dateR="";
		}
	
	}
	return $dateR ;
}

function dateMysqlInt($date) {
	$tab_date=array();
	$motif='`(\d{4})-(\d{1,2})-(\d{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})`';
	if (preg_match($motif,$date)) {
		$tab_date = explode(' ',$date);
	}
	else {
		$tab_date[0]=$date;
	}
	$tab_date1 = explode('-',$tab_date[0]);
	$tabHeure[0]=0;
	$tabHeure[1]=0;
	$tabHeure[2]=0;
	if (isset($tab_date[1])) {
		$tabHeure=explode(':',$tab_date[1]);
	}
	return mktime($tabHeure[0],$tabHeure[1],$tabHeure[2],$tab_date1[1],$tab_date1[2],$tab_date1[0]);
}
function diffDateMysql($d1,$d2) {
	$d1Int = dateMysqlInt($d1) ;
	$d2Int = dateMysqlInt($d2) ;
	
	$dDiff = $d2Int-$d1Int;

	$nbJour=floor($dDiff/(60*60*24));
	//echo  "Nb jour entre $d1 et $d2 => $nbJour";
	
	return $nbJour;
} 

function is_date($value, $format = 'yyyy-mm-dd'){

	if(strlen($value) == 10 && strlen($format) == 10){

		// find separator. Remove all other characters from $format
		$separator_only = str_replace(array('m','d','y'),'', $format);
		$separator = $separator_only[0]; // separator is first character

		if($separator && strlen($separator_only) == 2){
			// make regex
			$regexp = str_replace('mm', '[0-1][0-9]', $value);
			$regexp = str_replace('dd', '[0-3][0-9]', $value);
			$regexp = str_replace('yyyy', '[0-9]{4}', $value);
			$regexp = str_replace($separator, "\\" . $separator, $value);

			if($regexp != $value && preg_match('/'.$regexp.'/', $value)){

				// check date
				$day = substr($value,strpos($format, 'd'),2);
				$month = substr($value,strpos($format, 'm'),2);
				$year = substr($value,strpos($format, 'y'),4);

				if(@checkdate($month, $day, $year))
				return true;
			}
		}
	}
	return false;
}
//echo date('d/m/Y H:i:s',dateMysqlInt("2001-06-12 12:12:12"));
//echo "\n";
//echo  date('d/m/Y H:i:s',dateMysqlInt("2001-06-12"));

function makeCorps($data, $fileHTML)
{
    $messageMail="";

	$messageMail.=file_get_contents(dirname(__FILE__)."/../html/$fileHTML");
    foreach ($data as $key => $val) {
        //echo "publipost de $key avec $val\n";
        $messageMail=str_replace("--$key--", $val, $messageMail);
    }
	
    return  $messageMail;
}

?>