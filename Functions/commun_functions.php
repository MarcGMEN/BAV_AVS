<?
function phpVersionDouble() {
	$phpversion = phpversion();

	$phpversion=preg_replace("[A-Za-z]","",$phpversion);
	$tabTmp=explode(".",$phpversion);
	$phpVersionInt=(double)($tabTmp[0].".".$tabTmp[1]);
	return $phpVersionInt;
}

function isInstall(){
	if (file_exists("./install/.initInstall") || file_exists("../install/.initInstall")) {
		return true;
	}
	return false;
}

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

/**
 * retourne le nom de fichier d'une applet d'un bloc
 * @param unknown_type $applet
 * @param unknown_type $type
 * @param unknown_type $skin
 * @return unknown_type
 */
function return_bloc($applet,$type) {
	//echo "$applet,$type,$skin";
	$file="$type/".trim($applet)."_$type.php";
	$fileDef="userfiles/modules/$type/".trim($applet)."_$type.html";
	if (file_exists($file)) {
		return $file;
	}
	else if (file_exists($fileDef)) {
		return $fileDef;
	}
	else if (($type == "coteD") || ($type == "coteG") ) {
		return return_bloc($applet, "cote");
	}
	//trigger_error("Impossible de trouver $applet pour $type", E_USER_WARNING);
}

function makeOption($tab, $key, $val, $select) {
	$repr="";
	foreach ($tab as $valTab) {
		if ($val) {
			$repr.="<option value='".$valTab[$key]."'";
			if ($select != null  && $select==$valTab[$key]) {
				$repr.=" selected ";
			}
			$repr.=		">";
			$repr.=$valTab[$val];
			$repr.="</option>";
		}
		else {
			$repr.="<option value='".$valTab."'";
			if ($select != null  && $select==$valTab) {
				$repr.=" selected ";
			}
			$repr.=		">";
			$repr.=$valTab;
			$repr.="</option>";
		}
	}
	return $repr;

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
		case 12: $mois="d�cembre";break;
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


$TAB_KEY="0123456789AZERTUUIOPQSDFGHJKLMWXCVBN";
$GLOBALS['TAB_KEY']=$TAB_KEY;
/**
 * verfication de la clef de l'id
 * @param unknown_type $id
 * @return unknown_type
 */
function verif_id($id) {
	$keyTrue=return_key($id);

	$keyTest=substr($id,6,4);

	if ($keyTest != $keyTrue) {
		return false;
	}
	else {
		return true;
	}
}
/**
 * calcul de la clef de l'id
 * @param unknown_type $id
 * @return unknown_type
 */
function return_key($id) {
	global  $TAB_KEY;

	$key="AAAA";
	// 7eme caracteres
	$index=(strpos($TAB_KEY, $id[0])*strpos($TAB_KEY, $id[1]))%(strlen($TAB_KEY)-1);
	$key[0]=substr($TAB_KEY,$index,1);
	// 8eme caracteres
	$index=(strpos($TAB_KEY, $id[1])*strpos($TAB_KEY, $id[2]))%(strlen($TAB_KEY)-1);
	$key[1]=substr($TAB_KEY,$index,1);
	// 9eme caracteres
	$index=(strpos($TAB_KEY, $id[3])*strpos($TAB_KEY, $id[4]))%(strlen($TAB_KEY)-1);
	$key[2]=substr($TAB_KEY,$index,1);
	// 10eme caracteres
	$index=(strpos($TAB_KEY, $id[4])*strpos($TAB_KEY, $id[5]))%(strlen($TAB_KEY)-1);
	$key[3]=substr($TAB_KEY,$index,1);

	return $key;
}

function makeTicket2($id) {
	// timestamp today
	$clef=time();
	$clefFinal =strtohex($id)."-".$clef;

	return $clefFinal;
}

function hextostr($x) {
	$s='';
	foreach(explode("\n",trim(chunk_split($x,2))) as $h) $s.=chr(hexdec($h));
	return($s);
}

function strtohex($x) {
	$s='';
	foreach(str_split($x) as $c) $s.=sprintf("%02X",ord($c));
	return($s);
}

function verifTicket2($clef) {
	$tabTmp=explode('-',$clef);

	$clef2=$tabTmp[1];
	$clef1=$tabTmp[0];

	$today=time();

	$id="";
	if ($clef2<=$today) {
		if (date('d/m/Y' ,$clef2)) {
			$id=hextostr($clef1);
		}
		else {
			echo "clef pas date";
		}

	}
	else {
		echo "clef future";
	}
	return $id;
}



function makeTicket() {
	global  $TAB_KEY;
	$key="AZERTY";
	// creation de la clef sur 10 caract�res rando.
	for ($i=0;$i<5;$i++) {
		$key[$i]=substr($TAB_KEY,rand(0, strlen($TAB_KEY)-1),1);
	}
	$key.=return_key($key);
	return $key;
}

function sed($find, $replace, $input_file, $output_file = NULL){
	$contents = file_get_contents($input_file);
	$contents = preg_replace($find, $replace, $contents);
	if($output_file == NULL)
	$output_file = $input_file;
	if (!file_put_contents($output_file, $contents)) {
		echo "PB d'ecriture de $output_file sur remplacement de $find avec $replace <br/>";
	}
}


function add_slashes($texte) {
	if (CFG_ADDSLASHES == "true" ) {
		return addslashes(ltrim($texte));
	}
	else {
		return ltrim($texte);
	}
}

function utf8Encode($texte) {
	if (CFG_UTF8_AJAX == "true" ) {
		return utf8_encode(ltrim($texte));
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
/**
 * suppression d'un repertoire
 * @param $current_dir
 * @param $mode Recursif par defaut , si different le repertoire doit etre vde
 * @return unknown_type
 */
function remove_dir($current_dir, $mode="R") {

	$delRep=true;
	//echo "opendir $current_dir<br/>";
	if($dir = @opendir($current_dir)) {
		//echo "is dir $current_dir<br/>";

		//echo $mode;
		// si mode recursif
		if ($mode == "R") {
			while (($f = readdir($dir)) != false) {
				if($f != "." && $f != "..") {
					if (is_file($current_dir."/".$f)) {
						//echo "sup de $current_dir/$f<br/>";
						if (!unlink($current_dir."/".$f)) {
							// echo "erreur lors du unlink<br/> ";
						}
					} elseif(is_dir($current_dir."/".$f)) {
						// echo "sup  de $current_dir/$f<br/>";
						remove_dir($current_dir."/".$f);
					}
				}
			}
		}
		else {
			// si c'est pas le mode recursif on supprime le repertoire que s'il est vide.
			$tabf = scandir($current_dir);
			if (sizeof($tabf) > 2) {
				$delRep=false;
				//  echo "pas de suppression du repertoire $current_dir";
			}
		}
		closedir($dir);
	}


	if ($delRep) {
		//echo "deplacement du repertoire $current_dir sous trash ";
		if (!is_dir("../.trash/trash")) {
			if (!mkdir("../.trash/trash",0777,true)) {
				return "creation  ../.trash/trash";
			}
		}
		if (is_dir($current_dir)) {
			if (!rename ($current_dir,"../.trash/trash")) {
				return "Renomage dans trash impossible....";
			}
		}
	}


	return $delRep;
}
function recurse_copy($src,$dst) {

	$tabTrace=array();
	$i=0;
	//echo "opendir $src<br/>";
	if (!is_dir($dst)) {
		mkdir($dst);
	}
	//echo "mkdir $dst<br/>";
	if($dir = @opendir($src)) {
		while (($f = readdir($dir)) != false) {
			if($f != "." && $f != "..") {
				if (is_file($src."/".$f)) {
					//echo "sup de $current_dir/$f<br/>";
					//echo "$src."/".$f,$dst."/".$f";
					copy($src."/".$f,$dst."/".$f );
					array_push($tabTrace,$dst."/".$f);
				} elseif(is_dir($src."/".$f)) {
					// echo "sup  de $current_dir/$f<br/>";
					$tabTrace = array_merge($tabTrace,recurse_copy($src."/".$f,$dst."/".$f));
				}
			}
		}
		closedir($dir);
	}
	return $tabTrace;
}

function my_is_dir($dir)
{
	error_reporting(E_PARSE);
	$retour = is_dir($dir);
	error_reporting(E_ERROR);
	return $retour;
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
				$dateR.=" � ".$tab_date[1];
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

?>