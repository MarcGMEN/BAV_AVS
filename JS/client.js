/*
 * action lors du chargement de la page
 */

function initPage() {
	if (idClient) {

		x_return_tauxBAV(display_list_taux_com);
		// chargement des depot
		x_return_depotsBAV(display_list_prix_depot);

		x_return_oneClient(idClient, display_client);
	} else {
		goTo();
	}
}

// que faire en cas de changement de saisie
function pageSaisie() {
	if (startSaisie) {
		document.clientForm.buttonValideFiche.disabled = false;
	} else {
		document.clientForm.buttonValideFiche.disabled = true;
	}
}


/*
 * action lors du derchargement de la page
 */
function unloadPage() {

}

function display_list_taux_com(val) {
	display_list_select(val, 'cli_taux_com', document.clientForm);
}

function display_list_prix_depot(val) {
	display_list_select(val, 'cli_prix_depot', document.clientForm);
}
/**
 * 
 */
function display_client(val) {
	if (val instanceof Object) {
		display_formulaire(val, document.clientForm);
		cli_id=val['cli_id'];

		var tabSel = {
			"obj_id_vendeur": val['cli_id']
		};

		console.log("appel fiches vente");
		x_return_fiches(tri, sens, tabToString(tabSel), display_fiches);

		var tabSelA = {
			"obj_id_acheteur": val['cli_id']
		};
		
		console.log("appel fiches achat");
		x_return_fiches(tri, sens, tabToString(tabSelA), display_fiches_achat);
	} else {
		goTo(null, null, null, "Client inconnue.");
	}
}

function unloadPage() {}

// ***********************************************************
// ***********************************************************
// *****CLIENT
// ***********************************************************
// ***********************************************************
/**
 * Action en submit de form si valide
 */
function submitForm() {
	if (modePage == 'modif') {
		var tabCli = recup_formulaire(document.clientForm, 'cli');
		x_action_updateClient(tabToString(tabCli), display_fin_modif);
	}
	return false;
}

function display_fin_modif(val) {
	setStartSaisie(false);
	if (val instanceof Object) {
		var tabSel = {
			"obj_id_vendeur": val['cli_id']
		};
		x_return_fiches(tri, sens, tabToString(tabSel), display_fiches);
	} else if (val) {
		alertModalWarnTimeout(val, 2);
	}
}


// ***********************************************************
// ***********************************************************
// *****FiCHES
// ***********************************************************
// ***********************************************************


var tri = "obj_numero";
var sens = "asc";
var selection = "*";
var tabSel = new Array();

function display_fiches(val) {

	var total = 0;
	var repr = "<table width='100%'>";
	for (index in val) {
		if (!isNaN(index)) {
			repr += "<tr class='tabl0 link' onclick='goTo(\"fiche.php\",\"modif\"," + val[index]['obj_id'] + ",null)'>";
			repr += "<td width=10% align=center>";
			repr += val[index]['obj_numero'];
			repr += "</td>";
			repr += "<td class='maskmobile' width=20%>";
			repr += val[index]['obj_type'];
			repr += "</td>";
			repr += "<td class='maskmobile' width=20% >";
			repr += val[index]['obj_public'];
			repr += "</td>";
			repr += "<td width=30% >";
			repr += val[index]['obj_marque'];
			repr += "</td>";
			repr += "<td width=10% >";
			if (val[index]['obj_prix_vente'] == 0) {
				repr += "<span style='color:orange'>" + val[index]['obj_prix_depot'] + "</span>";
			} else {
				repr += val[index]['obj_prix_vente'];
			}
			repr += "</td>";
			repr += "<td width=10% >";
			repr += val[index]['obj_etat'];
			repr += "</td>";
			repr += "</tr>";
			total = total + 1;
		}
	}
	repr += "</table>";

	getElement('fiches').innerHTML = repr;

	if (sens == "asc") {
		classSort = "sortUp";
	} else {
		classSort = "sortDown";
	}
	getElement(tri).className = classSort;

	if (total == 0) {
		getElement('tdBtnSup').style.display = "block";
	}
	getElement('total').innerHTML = total;

	getElement('total_vente_stock').innerHTML = "0.00";
	getElement('total_vente_vendu').innerHTML = "0.00";
	getElement('total_vente_paye').innerHTML = "0.00";
	getElement('total_vente_depot').innerHTML = "0.00";;
	getElement('total_com_vendu').innerHTML = "0.00";
	getElement('total_com_paye').innerHTML = "0.00";
	getElement('total_depot').innerHTML = "0.00";

	if (val['total_vente_STOCK']) {
		getElement('total_vente_stock').innerHTML = val['total_vente_STOCK'];
		getElement('total_vente_depot').innerHTML = val['total_vente_depot'];
		getElement('total_depot').innerHTML = val['total_depot'];
	}
	if (val['total_vente_VENDU']) {
		getElement('total_vente_vendu').innerHTML = val['total_vente_VENDU'];
		getElement('total_com_vendu').innerHTML = val['total_com_vendu'];
	}

	if (val['total_vente_PAYE']) {
		getElement('total_vente_paye').innerHTML = val['total_vente_PAYE'];
		getElement('total_com_paye').innerHTML = val['total_com_paye'];
	}

}

function display_fiches_achat(val) {

	var total = 0;
	var repr = "<table width='100%'>";
	for (index in val) {
		if (!isNaN(index)) {
			repr += "<tr class='tabl0 link' onclick='goTo(\"fiche.php\",\"modif\"," + val[index]['obj_id'] + ",null)'>";
			repr += "<td width=10% align=center>";
			repr += val[index]['obj_numero'];
			repr += "</td>";
			repr += "<td class='maskmobile' width=20%>";
			repr += val[index]['obj_type'];
			repr += "</td>";
			repr += "<td class='maskmobile' width=20% >";
			repr += val[index]['obj_public'];
			repr += "</td>";
			repr += "<td width=30% >";
			repr += val[index]['obj_marque'];
			repr += "</td>";
			repr += "<td width=10% >";
			if (val[index]['obj_prix_vente'] == 0) {
				repr += "<span style='color:orange'>" + val[index]['obj_prix_depot'] + "</span>";
			} else {
				repr += val[index]['obj_prix_vente'];
			}
			repr += "</td>";
			repr += "<td width=10% >";
			repr += val[index]['obj_etat'];
			repr += "</td>";
			repr += "</tr>";
			total = total + 1;
		}
	}
	repr += "</table>";

	getElement('fichesA').innerHTML = repr;
}

function triColonne(col) {
	if (col == tri) {
		if (sens == "asc") {
			sens = "desc";
		} else {
			sens = "asc";
		}
	} else {
		sens = "asc";
	}
	getElement(tri).className = "sortable";

	var tabSel = {
		"obj_id_vendeur": idClient
	};

	console.log("appel fiches vente");
	x_return_fiches(tri, sens, tabToString(tabSel), display_fiches);

	var tabSelA = {
		"obj_id_acheteur": idClient
	};
	
	console.log("appel fiches achat");
	x_return_fiches(tri, sens, tabToString(tabSelA), display_fiches_achat);

	tri = col;
}


function supprimerClient(id) {
	console.log("Suppression du client "+id);
	x_action_deleteClient(id, display_fin_delete);
}

function  display_fin_delete(val) {
	if (val == 1) {
		goTo("bav.php");
	} else if (val) {
		alertModalWarnTimeout(val, 2);
	}
}