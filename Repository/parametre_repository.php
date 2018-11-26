<?
function getAllParametre()
{
	return getAll('parametre','par_numero_bav');
}

function getOneParemetre($id)
{
    return getOne($id, 'parametre','par_numero_bav');
}


// x_return_list_taux_commision(display_list_taux_com);
		// x_return_list_prix_depot(display_list_prix_depot);

function updateParametre($obj) {
    return update('parametre', $obj, "par_numero_bav");
    
}

function insertParametre($obj) {
    return insert('parametre', $obj);
}

?>
