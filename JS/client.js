/*
 * action lors du chargement de la page
 */
function initPage() {
	// chargement des taux
	x_return_tauxBAV(display_list_taux_com);
	// chargement des depot
	x_return_depotsBAV(display_list_prix_depot);

	document.clientForm.cli_emel.focus();

	if (idClient) {
		x_return_oneClient(idClient, display_client);
	} else {
		goTo();
	}
}

// que faire en cas de changement de saisie
function pageSaisie() {
	if (startSaisie) {
		document.clientForm.buttonValideFiche.disabled = false;
		document.clientForm.buttonPDFFiche.title = "Valider vos modifications";
		document.clientForm.buttonPDFFiche.disabled = true;
		document.clientForm.buttonPDFFiche.title = "Valider les modifications avant d'imprimer";
	} else {
		document.clientForm.buttonValideFiche.disabled = true;
		document.clientForm.buttonPDFFiche.title = "Rien de changé";
		document.clientForm.buttonPDFFiche.disabled = false;
		document.clientForm.buttonPDFFiche.title = "Impression en PDF";
	}
}


/*
 * action lors du derchargement de la page
 */
function unloadPage() {

}

/**
 * 
 */
function display_client(val) {
	if (val instanceof Object) {
		display_formulaire(val, document.clientForm);
		console.log(val);

	} else {
		goTo(null, null, null, "Client inconnue.");
	}
}

// recuperation des donnees de la BAV
function setParamVal(val) {
	setParamValIndex(val);
	if (TABLE || ADMIN) {} else if (!CLIENT) {
		goTo();
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
		console.log(tabCli);
		var tabData = Object.assign({}, tabObj, tabCli);
		x_action_updateClient(tabToString(tabData), display_fin_modif);
	}
	return false;
}

function display_fin_modif(val) {
    console.log(val);
    if (val instanceof Object) {
		setStartSaisie(false);
		x_return_oneClient(idClient, display_client);
    } else {
        alertModalWarnTimeout(val, 2);
    }
}

function display_client(val) {
	display_formulaire(val, document.clientForm);
}

function display_list_taux_com(val) {
	display_list_select(val, 'cli_taux_com', document.clientForm);
}

function display_list_prix_depot(val) {
	display_list_select(val, 'cli_prix_depot', document.clientForm);
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
		repr += "<tr class='tabl0 link' onclick='location.href=\"index.php?page=fiche.php&numeroFiche=" + val[index]['obj_numero'] + "&action=visu\"'>";
		repr += "<td width=10% align=center>";
		repr += val[index]['obj_numero'];
		repr += "</td>";
		repr += "<td width=20% >";
		repr += val[index]['obj_type'];
		repr += "</td>";
		repr += "<td width=20% >";
		repr += val[index]['obj_public'];
		repr += "</td>";
		repr += "<td width=20% >";
		repr += val[index]['obj_marque'];
		repr += "</td>";
		repr += "<td width=10% >";
		repr += val[index]['obj_prix_vente'];
		repr += "</td>";
		repr += "<td width=10% >";
		repr += val[index]['obj_comission'];
		repr += "</td>";
		repr += "<td width=5% >";
		repr += val[index]['obj_etat'];
		repr += "</td>";
		repr += "</tr>";

		total = total + 1;
	}
	repr += "</table>";

	getElement('fiches').innerHTML = repr;

	if (sens == "asc") {
		classSort = "sortUp";
	} else {
		classSort = "sortDown";
	}
	getElement(tri).className = classSort;
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

	x_return_fiches(tri, sens, selection, idClient, display_fiches);

	tri = col;
}