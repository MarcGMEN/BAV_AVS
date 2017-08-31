<?php

$module="client";

/**************************************/
/**************************************/
/* FICHE */
/**************************************/
/**************************************/

function cmp_cli_vente_desc($a, $b)
{
	return cmp_cumul("cli_vente",$a,$b,-1); 
}

function cmp_cli_vente_asc($a, $b)
{
	return cmp_cumul("cli_vente",$a,$b,1); 
}

function cmp_cli_depot_desc($a, $b)
{
	return cmp_cumul("cli_depot",$a,$b,-1); 
}
function cmp_cli_depot_asc($a, $b)
{
	return cmp_cumul("cli_depot",$a,$b,1); 
}

function cmp_cli_achat_asc($a, $b)
{
	return cmp_cumul("cli_achat",$a,$b,1); 
}
function cmp_cli_achat_desc($a, $b)
{
	return cmp_cumul("cli_achat",$a,$b,-1); 
}


function cmp_cumul($col,$a,$b,$sens) {
	
    $cmp = strcmp($a[$col], $b[$col])*$sens;
    if ($cmp ==0) {
    	
    	if ($a['cli_nom'] == $b['cli_nom']) {
        	$cmp=0;
    	}
    	else {        
        	$cmp = ($a['cli_nom'] < $b['cli_nom']) ? -1 : 1;
    	}
    }
    return $cmp;
	
}



function return_clients($numBav,$tri,$sens,$mask) {
	$tabTmp = get_clients($numBav,$tri,$sens,$mask);
	
	$index=0;
	
	$triBase=$tri;
	if ($triBase == "cli_vente" || $triBase == "cli_depot" || $triBase == "cli_achat"  ) {
		$tri="cli_nom";
	}
	
	foreach ($tabTmp as $id => $row) {
		foreach ($row as $key => $val) {
				$row[$key]=utf8_encode($val);
		}
		$tabFiche[$index++]=$row;
	}
	//print_r($tabFiche);
	if ($triBase == "obj_etat") {
		if ($sens == "asc") {
			usort($tabFiche, "cmp_etat_asc");
		}
		else {
			usort($tabFiche, "cmp_etat_desc");
		}
	}
	//print_r($tabFiche);
	if ($triBase == "cli_vente" || $triBase == "cli_depot" || $triBase == "cli_achat"  ) {
		if ($sens == "asc") {
//			echo "sort cmp_".$triBase."_asc";
			usort($tabFiche, "cmp_".$triBase."_asc");
		}
		else {
	//		echo "sort cmp_".$triBase."_desc";
			usort($tabFiche, "cmp_".$triBase."_desc");
		}
	}
	
	return $tabFiche;
}
?>