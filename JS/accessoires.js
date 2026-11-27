var tabEtat = ['Déposé', 'A restituer', 'Restitué'];
var tabAction = ['Déposer', 'A restituer', 'Restituer'];
var tabClass = ['CONFIRME', 'STOCK', 'VENDU'];

var etatVue =[];
function initPage() {
	if (ADMIN || GetCookie('CAFFARD_BAV')) {
		initForm();
		getElement('numFicAcc').focus();
		x_return_allAccessoires(display_accessoires);

		reloadPage();
	} else {
		goTo();
	}
}

function reloadPage() {
	setTimeout('reloadPage()',10*1000);
	x_return_allAccessoires(display_accessoires)
}

function getNextAction(value) {
	const index = tabEtat.indexOf(value);

	// Vérifie si la valeur existe et n'est pas le dernier élément
	if (index === -1 || index === tabEtat.length - 1) {
		return ""; // ou null selon votre besoin
	}

	return tabAction[index + 1];
}
function getPrecAction(value) {
	const index = tabEtat.indexOf(value);

	// Vérifie si la valeur existe et n'est pas le dernier élément
	if (index === -1 || index === 0) {
		return ""; // ou null selon votre besoin
	}

	return tabAction[index - 1];
}


function filtreSuivi() {
	etatVue=[];
	if (getElement('etat0').checked) {
		etatVue[0]=tabEtat[0];
	}
	if (getElement('etat1').checked) {
		etatVue[1]=tabEtat[1];
	}
	if (getElement('etat2').checked) {
		etatVue[2]=tabEtat[2];
	}
	x_return_allAccessoires(display_accessoires);
}

function searchAccessoire(numFiche) {
	// console.log("searchAccessoire", numFiche);
	x_return_oneAccessoireByNumero(numFiche, display_accessoire);
}

function addAccessoire(num) {
	var dataAccessoire = recup_formulaire(searchFormAccessoire, 'acc');
	dataAccessoire['acc_etat'] = tabEtat[0];
	dataAccessoire['acc_numero'] = num;

	x_action_createAccessoire(tabToString(dataAccessoire), display_finCreate);
}

function display_finCreate(val) {
	initForm();
	getElement('numFicAcc').focus();
	x_return_allAccessoires(display_accessoires);
}

function initForm() {
	// getElement('acc_etat_prec').style.display = 'none';
	getElement('acc_etat_next').style.display = 'none';
	getElement('acc_etat').style.display = 'none';
	getElement('acc_commentaire').disabled = true;
	getElement('acc_modif').style.display = 'none';
	getElement('acc_reset').style.display = 'none';
	var val = []
	val['acc_etat_prec'] = "";
	val['acc_etat_next'] = "";
	val['acc_etat'] = "";
	val['acc_commentaire'] = "";
	val['numFicAcc'] = "";
	display_formulaire(val, searchFormAccessoire);
}

function display_accessoire(val) {
	getElement('acc_commentaire').disabled = false;
	
	if (val) {
		var classEtat = '';
		// console.log(val[i]['acc_etat'], indexEtat,tabEtat.length)
		//  var indexEtat = 0;
		//  var classEtatN="";
		//  var classEtatP="";
		//  indexEtat = tabEtat.indexOf(val['acc_etat']);
		//  if (indexEtat > 0) {
		//  	classEtatP = tabClass[indexEtat-1];
		//  }
		//  if (indexEtat != tabEtat.length - 1) {
		//  	classEtatN = tabClass[indexEtat+1];
		//  }
		
		// val['acc_etat_prec'] = getPrecAction(val['acc_etat']);
		// getElement('acc_etat_prec').style.display = 'inline';
		// getElement('acc_etat_prec').className+=" "+classEtatP;
		// if (val['acc_etat_prec'] == "") {
		// 	getElement('acc_etat_prec').style.display = 'none';
		// }
		
		// val['acc_etat_next'] = getNextAction(val['acc_etat']);
		// getElement('acc_etat_next').style.display = 'inline';
		// getElement('acc_etat_next').className+=" "+classEtatN;
		// if (val['acc_etat_next'] == "") {
		// 	getElement('acc_etat_next').style.display = 'none';
		// }
		getElement('acc_etat_next').style.display = 'none';
		getElement('acc_modif').style.display = 'none';
		getElement('acc_commentaire').disabled = true;
		if (val['acc_etat'] == tabEtat[0]) {
			getElement('acc_modif').style.display = 'inline';
			getElement('acc_commentaire').disabled = false;
		}
		getElement('acc_reset').style.display = 'inline';
		display_formulaire(val, searchFormAccessoire);
	}
	else {
		getElement('acc_modif').style.display = 'none';
		getElement('acc_reset').style.display = 'inline';
		var val = [];
		val['acc_etat_next'] = "Déposer";
		getElement('acc_etat_next').className+=" "+tabClass[0];
		getElement('acc_etat_next').style.display = 'inline';
		// val['acc_etat_prec'] = "";
		// getElement('acc_etat_prec').style.display = 'none';
		val['acc_etat'] = "";
		getElement('acc_etat').style.display = 'none';
		val['acc_commentaire'] = "";
		display_formulaire(val, searchFormAccessoire);
	}

}

function cghtEtat(value, num) {

	const etat = tabEtat[tabAction.indexOf(value)];
	if (etat == tabEtat[0]) {
		addAccessoire(num);

	}
	else {
		console.log('non bascule sur ', etat)
		x_action_chgtEtatAccessoire(num, etat, display_finCreate);
	}

}

function updateAcc(num) {
	var dataAccessoire = recup_formulaire(searchFormAccessoire, 'acc');
	dataAccessoire['acc_numero'] = num;
	console.log(dataAccessoire);
	x_action_createAccessoire(tabToString(dataAccessoire), display_finCreate);
	
}

function display_accessoires(val) {
	console.log(val);
	var repr = "<div class='row'>";
	var nbAccVue=0;
	var nbAcc=0;
			
	if (val instanceof Object) {
		for (i in val) {
			nbAcc++;
			var indexEtat = 0;
			indexEtat = tabEtat.indexOf(val[i]['acc_etat']);
			indexEtatVue = etatVue.indexOf(val[i]['acc_etat']);

			if (etatVue.length == 0 || indexEtatVue != -1 ) {
				nbAccVue++;
				var classEtat = '';
				// console.log(val[i]['acc_etat'], indexEtat,tabEtat.length)
				classEtat = tabClass[indexEtat];
				repr += "<div class='col-xs-6 col-sm-4 col-md-4' > "
				repr += "  <div class='fiche link0 " + classEtat + "' ";
				if (indexEtat != tabEtat.length - 1) {
					repr += "    onclick='cghtEtat(\"" + tabAction[indexEtat + 1] + "\"," + val[i]['acc_numero'] + ") ' ";
				}
				repr += "   title='Basculer vers " + tabEtat[indexEtat + 1] + "'>";
				repr += "     <div class='titreFiche'>" + val[i]['acc_numero'] + "</div>";
				repr += "     <div>&nbsp;" + val[i]['acc_commentaire'] + "</div>";
				repr += "     <div class=titrow>Vélo : " + val[i]['obj_marque'] + "</div>";
				repr += "  </div>";
				// repr += tabEtat[indexEtat];
				if (indexEtat > 0) {
					var classEtatPrec = tabClass[indexEtat - 1];

					repr += "<div class='tittab link0 " + classEtatPrec + "' ";
					repr += " onclick='cghtEtat(\"" + tabAction[indexEtat - 1] + "\"," + val[i]['acc_numero'] + ")' >";
					repr += " Retour vers : " + tabEtat[indexEtat - 1] + "</div>";
				}
				else if (indexEtat != tabEtat.length - 1) {
					repr += "<div class='tittab link0 error' ";
					repr += " onclick='deleteAccessoire(" + val[i]['acc_numero'] + ")' >Supprimer</div>";
				}
				else {
					repr += "<div class='tittab'>&nbsp;</div> ";
				}
				repr += "</div>";
			}

		}
	}
	repr += "</div>";

	if (nbAccVue == nbAcc) {
		getElement('nbAcc').innerHTML = nbAccVue;	
	}
	else {
		getElement('nbAcc').innerHTML = nbAccVue+"/"+nbAcc;	
	}
	
	getElement('Accessoires').innerHTML = repr;
}

function deleteAccessoire(num) {
	x_action_deleteAccessoire(num, display_finCreate);
}



