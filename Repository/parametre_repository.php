<?
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
    $req .= "par_titre = '".addslashes($obj['par_titre'])."'";
    $req .= "where par_numero_bav = '".$obj['par_numero_bav']."'";

    if (!$GLOBALS['MYSQLI']->query($req)) {
        throw new Exception("Pb de mise a jour ".mysql_error());
    }
    return true;
}
?>
