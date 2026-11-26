var tabEtat= ['Déposé','A restituer','Restitué'];
var tabAction= ['Déposer','A restituer','Restituer'];


function initPage() {
	if (ADMIN || GetCookie('CAFFARD_BAV')) {
		getElement('inputSearch').focus();
	} else {
		goTo();
	}
}
function getNextAction( value) {
  const index = tabEtat.indexOf(value);

  // Vérifie si la valeur existe et n'est pas le dernier élément
  if (index === -1 || index === tabEtat.length - 1) {
    return ""; // ou null selon votre besoin
  }

  return tabAction[index + 1];
}
function getPrecAction( value) {
  const index = tabEtat.indexOf(value);

  // Vérifie si la valeur existe et n'est pas le dernier élément
  if (index === -1 || index === 0) {
    return ""; // ou null selon votre besoin
  }

  return tabAction[index -1 ];
}



function searchAccessoire(numFiche) {
	console.log("searchAccessoire", numFiche);
	x_return_oneAccessoireByNumero(numFiche, display_accessoire);
}

function addAccessoire(numFiche, commentaire) {
}

function display_accessoire(val) {
	
	if (val) {
		val['acc_etat_next']=getNextAction(val['acc_etat']);
		getElement('acc_etat_next').style.display='block';
		if (val['acc_etat_next']=="") {
			getElement('acc_etat_next').style.display='none';
		}
		val['acc_etat_prec']=getPrecAction(val['acc_etat']);
 		getElement('acc_etat_prec').style.display='block';
		if (val['acc_etat_prec']=="") {
			getElement('acc_etat_prec').style.display='none';
		}
		getElement('acc_commentaire').disabled=false;
		console.log(val);
		display_formulaire(val);
	}
	else {
		// console.log('New accessoire');
		var val=[];
		val['acc_etat_next']="Déposer";
		getElement('acc_etat_next').style.display='block';
		val['acc_etat_prec']="";
		getElement('acc_etat_prec').style.display='none';
		val['acc_etat']="";
		getElement('acc_etat').style.display='none';
		val['acc_commentaire']="";
		getElement('acc_commentaire').disabled=false;
		display_formulaire(val);
	}
	
}

function cghtEtat(value, num) {
	const etat=tabEtat[tabAction.indexOf(value)];
	
	
	if (etat== tabEtat[0]) {
		console.log("Creation de ",num);
	}
	else {
		console.log("cht etat ",etat, num);
	}
	location.reload();

}