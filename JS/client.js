/*
 * action lors du chargement de la page
 */
function initPage() {
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
	} else {
		document.clientForm.buttonValideFiche.disabled = true;
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
		tabSel['obj_id_vendeur']=val['cli_id'];
		x_return_fiches(tri, sens, tabToString(tabSel), display_fiches);
		display_formulaire(val, document.clientForm);
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
			repr += "<tr class='tabl0 link' onclick='goTo(\"fiche.php\",\"modif\","+val[index]['obj_id']+",null)'>";
			repr += "<td width=10% align=center>";
			repr += val[index]['obj_numero'];
			repr += "</td>";
			repr += "<td width=20%>";
			repr += val[index]['obj_type'];
			repr += "</td>";
			repr += "<td width=20% >";
			repr += val[index]['obj_public'];
			repr += "</td>";
			repr += "<td width=20% >";
			repr += val[index]['obj_marque'];
			repr += "</td>";
			repr += "<td width=15% >";
			repr += val[index]['obj_prix_vente'];
			repr += "</td>";
			repr += "<td width=15% >";
			repr += val[index]['obj_etat'];
			repr += "</td>";
			repr += "</tr>";
		}

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