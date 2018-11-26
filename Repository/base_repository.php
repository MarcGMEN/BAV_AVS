<?php

function infoTable($table)
{
    $query = "SELECT * from $table";
    $tab=array();
    if ($result = $GLOBALS['MYSQLI']->query($query)) {
        /* Récupère les informations d'un champ pour toutes les colonnes */
        $finfo = $result->fetch_fields();
        foreach ($finfo as $val) {
            $tab[$val->name]=$val->name;
            // printf("Name:     %s\n", $val->name);
            // printf("Table:    %s\n", $val->table);
            // printf("max. Len: %d\n", $val->max_length);
            // printf("Flags:    %d\n", $val->flags);
            // printf("Type:     %d\n\n", $val->name);
        }
    }
    $result->close();
    return $tab;
}

/**
 * retourne les valeurs d'un enum d'une table
 */
function recupEnumToArray($table, $champ)
{
    // recupearation des datas de la colonne.
	$result = $GLOBALS['MYSQLI']->query("SHOW COLUMNS FROM $table LIKE '$champ'");
    if ($result) {
        $row = $result->fetch_assoc();
        $tab =  explode("','", utf8_encode(preg_replace("/(enum|set)\('(.+?)'\)/", "\\2", $row['Type'])));
        return $tab;
    } else {
        throw new Exception("Pb getEnumValues ".mysqli_error());
    }
}

function recupValToArray($table, $champ, $search)
{
	$tabRet=array();
	$index=1;
	$query_EnumList = "SELECT '$champ' from $table where $champ like '%$search%' group by $champ order by $champ ";
	$EnumList = mysql_query($query_EnumList) or die(mysql_error());
	while ($row_EnumList = mysql_fetch_assoc($EnumList)) {
		$tabRet[$index++]=$row_EnumList[$champ];
	}
	return $tabRet;
}

function getOne($id, $table, $cleId)
{
    $row = null;
    if (isset($id)) {
        $requete2 = " SELECT * from $table ";
        $requete2 .= " where $cleId = '" . $id."'";
        $row=$GLOBALS['MYSQLI']->query($requete2)->fetch_assoc();
    }
    return $row;
}

function getAll($table, $nameId)
{
    $requete2 = " SELECT * from $table ";
    $resultat = $GLOBALS['MYSQLI']->query($requete2);
    $tab=array();
    while ($row = $resultat->fetch_assoc()) {
        $tab[$row[$nameId]]=$row;
    }
    $resultat->close();
    return $tab;
}


function update($table, $obj, $cleId)
{
    $req = "update $table set ";
    // todo : fr sur les champs sauf cleID
    $virgule="";
    foreach ($obj as $key => $val) {
        if ($key != $cleId) {
            $req .= $virgule.$key." = '".addslashes($val)."'";
            $virgule=" , ";
        }
    }
    $req .= " where $cleId = '".$obj[$cleId]."'";
    //echo $req;
    if (!$GLOBALS['MYSQLI']->query($req)) {
        throw new Exception("Pb d'update' [$req]".mysqli_error());
    }
    return true;
}

function insert($table, $obj)
{
    $req = "insert into $table (";
    $virgule="";
    foreach ($obj as $key => $val) {
        $req .= $virgule.$key;
        $virgule=" , ";
    }
    $req.=") values (";
    $virgule="";
    foreach ($obj as $key => $val) {
        $req .= $virgule."'".addslashes($val)."'";
        $virgule=" , ";
    }
    $req.=")";
    
    if (!$GLOBALS['MYSQLI']->query($req)) {
         throw new Exception("Pb d'insert' [$req]".mysqli_error());
    }
    return $GLOBALS['MYSQLI']->insert_id;
}
