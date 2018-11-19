<?
function getOneParemetre($id)
{
    echo "icic";
    return getOne($id, 'parametre');
}

function getAllParametre()
{
	return getAll('parametre','par_numero_bav');
}

?>
