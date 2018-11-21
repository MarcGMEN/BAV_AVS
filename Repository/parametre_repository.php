<?
$cleIDParametre="par_numero_bav";

//$tabInfoParametre=infoTable('parametre');

function getAllParametre()
{
	return getAll('parametre','par_numero_bav');
}

function getOneParemetre($id)
{
    return getOne($id, 'parametre','par_numero_bav');
}

function updateParametre($obj) {
    $req = "update parametre set ";
    // todo : fr sur les champs sauf cleID
    $virgule="";
    foreach($obj as $key => $val) {
        if ($key != $cleIDParametre) {
            $req .= $virgule.$key." = '".addslashes($val)."'";
            $virgule=" , ";
        }
    }
    $req .= " where par_numero_bav = '".$obj['par_numero_bav']."'";

    //echo $req;
    if (!$GLOBALS['MYSQLI']->query($req)) {
        throw new Exception("Pb de mise a jour ".mysql_error());
    }
    return true;
}
?>
