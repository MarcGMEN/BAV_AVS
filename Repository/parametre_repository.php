<?
include_once("base_reposirory.php");

function getOneParemetre($id)
{
    return getOne($id, 'parametre');
}

function getAllParametre($id)
{
	return getAll('parametre','par_id');
}

?>
