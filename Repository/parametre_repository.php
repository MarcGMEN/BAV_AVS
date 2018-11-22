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
    // todo : fr sur les champs sauf cleID
    $virgule="";
    foreach($obj as $key => $val) {
        if ($key != "par_numero_bav") {
            $req .= $virgule.$key." = '".addslashes($val)."'";
            $virgule=" , ";
        }
    }
    $req .= " where par_numero_bav = '".$obj['par_numero_bav']."'";
    //echo $req;
    if (!$GLOBALS['MYSQLI']->query($req)) {
        throw new Exception("Pb d'update' [$req]".mysqli_error());
    }
    return true;
}
function insertParametre($obj) {
    $req = "insert into parametre (";
    // todo : fr sur les champs sauf cleID
    $virgule="";
    foreach($obj as $key => $val) {
        $req .= $virgule.$key;
        $virgule=" , ";
    }
    $req.=") values (";
    $virgule="";
    foreach($obj as $key => $val) {
        $req .= $virgule."'".addslashes($val)."'";
        $virgule=" , ";
    }
    $req.=")";
    
    if (!$GLOBALS['MYSQLI']->query($req)) {
         throw new Exception("Pb d'insert' [$req]".mysqli_error());
     }
    return true;
}

?>
