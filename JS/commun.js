var regExpBeginning = /^\s+/;
var regExpEnd = /\s+$/;



function sizeof(tab) {
	var j = 0;
	for (var i in tab) {
		j++;
	}
	return parseInt(j);
}

function trim(aString) {
	res = aString.replace(regExpBeginning, '').replace(regExpEnd, '');
	return res;
}

function ltrim(aString) {
	return aString.replace(regExpBeginning, '');
}


function rtrim(aString) {
	return aString.replace(regExpEnd, '');
}

function findPos(obj) {
	var curleft = curtop = 0;
	if (obj.offsetParent) {
		do {
			curleft += obj.offsetLeft;
			curtop += obj.offsetTop;
		} while (obj = obj.offsetParent);
		return [curleft, curtop];
	}
}

function display_formulaire(val, laForm) {
	if (typeof val == "object") {
		for (var i in val) {
			if (typeof val[i] == "object") {
				for (var j in val[i]) {
					jnum = parseInt(j) + 1;
					// console.log(j+ "   type :"+typeof j+ " ("+ typeof jnum +") value : "+val[i][j]);
					if (typeof j == "string" && !jnum) {
						//alert(j+ "OK");
						if (laForm && laForm.elements[j]) {
							if (laForm.elements[i].type == "checkbox") {
								laForm.elements[i].checked = true;
							}
							laForm.elements[j].value = miseEnFormeData(j, val[i][j]);
							//laForm.elements[j].className = "";
						}
						if (getElement(j)) {
							getElement(j).innerHTML = miseEnFormeData(j, val[i][j]);
						}
					}
				}
			} else {
				jnum = parseInt(i) + 1;
				// console.log(i+ "   type :"+typeof i+ " ("+jnum+" "+ typeof jnum +") value : "+val[i]);
				//alert(i+ "   type :"+typeof i+ " ("+jnum+" "+ typeof jnum +") value : "+val[i]);
				if (typeof i == "string" && !jnum) {
					if (laForm && laForm.elements[i] != undefined) {
						// console.log("FORM : "+i+" = "+laForm.elements[i].type+" <- "+val[i]+" ("+laForm.elements[i].value+")");
						//alert(i+" = "+laForm.elements[i].type );
						if (laForm.elements[i].type == "checkbox") {
							laForm.elements[i].checked = true;
						}
						if (laForm.elements[i].type == "date") {
							laForm.elements[i].value = val[i];
						} else {
							laForm.elements[i].value = miseEnFormeData(i, val[i]);
						}
						//laForm.elements[i].className = "";
					}
					if (getElement(i) != undefined) {
						// console.log("ID : "+i+" = "+val[i]+" => "+miseEnFormeData(i, val[i]));
						getElement(i).innerHTML = miseEnFormeData(i, val[i]);
					}
				}
			}
		}
	}
}

function recup_formulaire(laForm, trigrame) {
	var obj = {};
	if (laForm) {
		for (key in laForm.elements) {
			var element = laForm.elements[key];
			if (element) {
				var name = element.name;
				if (name && name.startsWith(trigrame)) {
					obj[name] = element.value;
				}
			}
		}
		// console.log(obj);
	}
	return obj;
}

function disable_formulaire(laForm, trigrame) {
	var obj = [];
	if (laForm) {
		for (key in laForm.elements) {
			var element = laForm.elements[key];
			if (element) {
				var name = element.name;
				if (name && name.startsWith(trigrame)) {
					laForm.elements[key].disabled = true;
				}
			}
		}
		// console.log(obj);
	}
	return obj;
}

function tabToString(par) {
	var res = JSON.stringify(par);
	return res;
}


function miseEnFormeData(id, val) {
	/*
	 * if (id == "REC_NUMIR") { alert("4,4 :"+id.substr(4,4)); alert("8,4
	 * :"+id.substr(8,4)); }
	 */
	var retour = '';
	var reg1 = new RegExp("(DATE|date)", "g");
	if (id.match(reg1)) {
		// alert(id+" = "+val);
		retour = formatDate(val);
	} else {
		if (typeof val == "string") {
			retour = trim(val);
		} else {
			retour = val;
		}
	}
	return retour;
}

function formatDate(date, affHeure = true) {
	if (date) {
		// alert(date.length );
		exprSlash = new RegExp("^([0-9]+)([\]+)([0-9]+)([\]+)([0-9]+)$");
		exprMysql = new RegExp("^([0-9]+)([-]+)([0-9]+)([-]+)([0-9]+)$");
		if (exprSlash.test(date)) {
			return date;
		} else if (exprMysql.test(date)) {
			var reg = new RegExp("[-]+", "g");
			var tableau = date.split(reg);
			var jour = tableau[2];
			var mois = tableau[1]
			var annee = tableau[0];
			return (jour + "/" + mois + "/" + annee);
		} else if (date.length > 10) {
			var jour = date.substring(8, 10);
			var mois = date.substring(5, 7);
			var annee = date.substring(0, 4);
			var heure = date.substring(11, 19);
			tst = false;
			try {
				nd = new Date(annee, mois - 1, jour);
				tst = (annee > 1800 && annee < 2200 && annee == nd.getFullYear() &&
					mois == (nd.getMonth() + 1) && jour == nd.getDate());
			} catch (e) {
			}
			if (tst) {
				if (affHeure) {
					return (jour + "/" + mois + "/" + annee + " " + heure);
				}
				else {
					return (jour + "/" + mois + "/" + annee);
				}
			} else {
				return "";
			}
		} else {
			var jour = date.substring(8, 10);
			var mois = date.substring(5, 7);
			var annee = date.substring(0, 4);

			tst = false;
			try {
				nd = new Date(annee, mois - 1, jour);
				tst = (annee > 1800 && annee < 2200 && annee == nd.getFullYear() &&
					mois == (nd.getMonth() + 1) && jour == nd.getDate());
			} catch (e) {

			}
			if (tst) {
				return (jour + "/" + mois + "/" + annee);
			} else {
				return "";
			}
		}
	} else {
		return ("");
	}
}


function valideEmail(value) {
	//Expression = new RegExp("^([a-zA-Z0-9]+)@([a-zA-Z0-9]+).{2,4}$");
	//Expression2 = new RegExp("^([a-zA-Z0-9]+)([_\.-]+)([a-zA-Z0-9]+){1,}@([a-zA-Z0-9]+).([a-zA-Z]+){2,4}$");
	// 	Expression2 = new RegExp("^([a-zA-Z0-9_.-]+){1,}@([a-zA-Z0-9_.-]+).([a-zA-Z]+){2,4}$", "g");
	Expression = new RegExp("^([a-zA-Z0-9_-]+)@([a-zA-Z0-9_-]+).{2,4}$");
	Expression2 = new RegExp("^([a-zA-Z0-9_-]+).([a-zA-Z0-9_-]+){1,}@([a-zA-Z0-9_-]+).([a-zA-Z_-]+){2,4}$");
	Expression3 = new RegExp("^([a-zA-Z0-9_-]+).([a-zA-Z0-9_-]+){1,}@([a-zA-Z0-9_-]+).([a-zA-Z0-9_-]+).([a-zA-Z]+){2,4}$");
	//Expression3 = new RegExp("^([a-zA-Z0-9_.-]+){1,}@([a-zA-Z0-9]+)([_\.-]+)([a-zA-Z0-9]+).([a-zA-Z]+){2,4}$","g");
	re = new RegExp("^/\S+@\S+\.\S+/");
	if (value.length > 0 &&
		!re.test(value)
		//	!Expression.test(value) &&
		//!Expression2.test(value) && 
		//!Expression3.test(value) 
	) {
		return false;
	}
	return true;

}

function display_list_select(val, champ, leForm) {
	tabPrixDepot = val;
	var select = leForm.elements[champ];
	if (select) {
		while (select.firstChild) {
			select.removeChild(select.firstChild);
	  	}
		for (index in val) {
			select.appendChild(new Option(val[index], val[index]));
			if (index == 1) {
				select.selectedIndex = val[index];
			}
		}
	}
}

function basename(path, suffix) {
	// http://kevin.vanzonneveld.net
	// + original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
	// + improved by: Ash Searle (http://hexmen.com/blog/)
	// + improved by: Lincoln Ramsay
	// + improved by: djmix
	// * example 1: basename('/www/site/home.htm', '.htm');
	// * returns 1: 'home'

	var b = path.replace(/^.*[\/\\]/g, '');
	if (typeof (suffix) == 'string' && b.substr(b.length - suffix.length) == suffix) {
		b = b.substr(0, b.length - suffix.length);
	}
	return b;
}

function dirname(path) {
	return path.match(/.*\//);
}

// ********************************************
// FONCTION Valide_date2()
// ********************************************
function Valide_date2(nDate) {
	// Ajouter ce code dans la saisie du champs date
	// onBlur="Valide_date2(this)"
	var ok = "oui";
	var nChar;
	var aDate;
	var nJ;
	var nM;
	var nA;
	var nbSlash = 0;
	nAccepte = "0123456789/";
	if (nDate.value.length < 4 || nDate.value.length > 10)
		ok = "non";
	else {
		// teste des caract�res accept�s
		for (var i = 0; i < nDate.value.length; i++) {
			nChar = "" + nDate.value.substring(i, i + 1);
			if (nAccepte.indexOf(nChar) == "-1") ok = "non";
		}
		if (ok == "oui") {
			for (var i = 0; i < nDate.value.length; i++) {
				nChar = "" + nDate.value.substring(i, i + 1);
				if (nChar == "/") nbSlash++;
			}
			// format incorrect
			if (nbSlash == 1 || nbSlash > 2) ok = "non";

			if (nbSlash == 2) {
				aDate = nDate.value.split("/");
				// format J/M/A obligatoire
				nJ = aDate[0];
				nM = aDate[1];
				nA = aDate[2];
				nDate.value.length = 3;
			} else {
				if (nDate.value.length == 4) {
					// format possible "jmaa"
					nJ = nDate.value.substring(0, 1);
					nM = nDate.value.substring(1, 2);
					nA = nDate.value.substring(2, 4);
				}

				if (nDate.value.length == 5) {
					// format possible "jjmaa" ou "jmmaa"
					nJ = nDate.value.substring(0, 2);
					nM = nDate.value.substring(2, 3);
					nA = nDate.value.substring(3, 5);
					ok = testDate(nJ, nM, nA);
					if (nA.length == 2)
						if (nA < 50) {
							nA = "19" + nA
						} else {
							nA = "20" + nA
						}
					if (ok == "non") {
						ok = "oui";
						nJ = nDate.value.substring(0, 1);
						nM = nDate.value.substring(1, 3);
						nA = nDate.value.substring(3, 5);
					}
				}

				if (nDate.value.length == 6) {
					// format possible "jjmmaa" ou "jmaaaa"
					nJ = nDate.value.substring(0, 2);
					nM = nDate.value.substring(2, 4);
					nA = nDate.value.substring(4, 6);
					if (nA.length == 2)
						if (nA < 50) {
							nA = "19" + nA
						} else {
							nA = "20" + nA
						}
					ok = testDate(nJ, nM, nA);
					if (ok == "non") {
						ok = "oui";
						nJ = nDate.value.substring(0, 1);
						nM = nDate.value.substring(1, 2);
						nA = nDate.value.substring(2, 6);
					}
				}

				if (nDate.value.length == 7) {
					// format possible "jmmaaaa" ou "jjmaaaa"
					nJ = nDate.value.substring(0, 1);
					nM = nDate.value.substring(1, 3);
					nA = nDate.value.substring(3, 7);
					if (nA.length == 2)
						if (nA < 50) {
							nA = "19" + nA
						} else {
							nA = "20" + nA
						}
					ok = testDate(nJ, nM, nA);
					if (ok == "non") {
						ok = "oui";
						nJ = nDate.value.substring(0, 2);
						nM = nDate.value.substring(2, 3);
						nA = nDate.value.substring(3, 7);
					}
				}

				if (nDate.value.length == 8) {
					// format possible "jjmmaaaa"
					nJ = nDate.value.substring(0, 2);
					nM = nDate.value.substring(2, 4);
					nA = nDate.value.substring(4, 8);
				}

				if (nDate.value.length > 8) ok = "non";
			}

			if (nA.length == 2)
				if (nA < 50) {
					nA = "19" + nA
				} else {
					nA = "20" + nA
				}
			if (ok == "oui")
				ok = testDate(nJ, nM, nA);
		}

	}
	if (ok == "non" && nDate.value.length > 0) {
		alert("\nDate invalide!. Veuillez entrer une date valide:");
		nDate.select();
		nDate.style.color = 'RED';
		nDate.focus();
	} else {
		if (nDate.value.length > 0) {
			nDate.value = nJ + "/" + nM + "/" + nA;
		}
		nDate.style.color = 'BLACK';

	}
}

function testDate(nJ, nM, nA) {
	var ok = "oui";
	var jMax = 31;

	// alert (nJ+"/"+nM+"/"+nA);
	if ((nJ < 1 || nJ > jMax) ||
		(nM < 1 || nM > 12) ||
		(nA < 1900 || nA > 2100)) ok = "non";
	else {
		if (nM == 2) {
			if (AnneeBissex(nA) == true) {
				jMax = 29
			} else {
				jMax = 28
			}
		}
	}
	// alert( jMax);
	if ((nM == 1 || nM == 3 || nM == 5 || nM == 7 || nM == 8 || nM == 10 || nM == 12)) jMax = 31
	if ((nM == 4 || nM == 6 || nM == 9 || nM == 11)) jMax = 30
	if (nJ < 1 || nJ > jMax) ok = "non";

	return ok;
}

function AnneeBissex(nA) {
	if (nA % 100 == 0)
		return true;
	else
		if (nA % 400 == 0)
			return true;

	return false;
}

// ********************************************
// FONCTION Valide_heure()
// ********************************************
function Valide_heure(nHeure) {
	// Ajouter ce code dans la saisie du champs date
	// onBlur="Valide_heure(this,'HH:mm')"
	// Noter que vous devriez indiquer � l'usager le format valide...
	var ok = "oui";
	var nChar;
	var aHeure;
	var nH;
	var nM;
	var hMax = 23;
	var mMax = 59;
	nAccepte = "0123456789:";
	if (nHeure.value.length > 0) {
		if (nHeure.value.length != 5) ok = "non";
		for (var i = 0; i < nHeure.value.length; i++) {
			nChar = "" + nHeure.value.substring(i, i + 1);
			if (nAccepte.indexOf(nChar) == "-1") ok = "non";
		}
		if (ok == "oui") {
			aDate = nHeure.value.split(":");
			nH = aHeure[0];
			nM = aHeure[1];
			if ((nH < 1 || nH > hMax) || (nM < 1 || nM > mMax)) ok = "non";
		}

		if (ok == "non") {
			nHeure.focus();
			nHeure.select();
			if (nlang == "fr")
				alert("\nHeure invalide!. Veuillez entrer une Heure valide: HH:MM.")
			else
				alert("\nInvalid time. Please re-enter valid time: HH:mm.")
		}
	}
}

/**
 * 
 * @param {test si un object est vide} obj 
 */
function objectIsEmpty(obj) {
	for (var key in obj) {
		if (obj.hasOwnProperty(key))
			return false;
	}
	return true;
}

function nl2br(str, is_xhtml) {
	// http://kevin.vanzonneveld.net
	// +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
	// +   improved by: Philip Peterson
	// +   improved by: Onno Marsman
	// +   improved by: Atli Þór
	// +   bugfixed by: Onno Marsman
	// +      input by: Brett Zamir (http://brett-zamir.me)
	// +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
	// +   improved by: Brett Zamir (http://brett-zamir.me)
	// +   improved by: Maximusya
	// *     example 1: nl2br('Kevin\nvan\nZonneveld');
	// *     returns 1: 'Kevin<br />\nvan<br />\nZonneveld'
	// *     example 2: nl2br("\nOne\nTwo\n\nThree\n", false);
	// *     returns 2: '<br>\nOne<br>\nTwo<br>\n<br>\nThree<br>\n'
	// *     example 3: nl2br("\nOne\nTwo\n\nThree\n", true);
	// *     returns 3: '<br />\nOne<br />\nTwo<br />\n<br />\nThree<br />\n'
	var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br ' + '/>' : '<br>'; // Adjust comment to avoid issue on phpjs.org display

	return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
}

function noAccent(chaine) {
	temp = chaine.replace(/[àâä]/gi, "a")
	temp = temp.replace(/[éèêë]/gi, "e")
	temp = temp.replace(/[îï]/gi, "i")
	temp = temp.replace(/[ôö]/gi, "o")
	temp = temp.replace(/[ùûü]/gi, "u")
	return temp
}


function compte_ligne(texte) {
	var nl = "\r\n";
	var nbligne = texte.split(nl).length;
	return nbligne;
}

function limit_ligne(f, lettre, texte) {
	var chaine = "";
	var nbligne_max = 4;//nombre max de ligne souhaité
	var nl = "\r\n";//correspond au caractère retour chariot
	var tableau = texte.split(nl);
	var nbligne = compte_ligne(texte);

	console.log(tableau);
	console.log(nbligne);

	if ((lettre == 13) && (nbligne > nbligne_max - 1)) {
		for (var i = 0; i < nbligne_max; i++) {
			if (i < nbligne_max - 1) {
				chaine += tableau[i] + '\r\n';
			}
			else {
				chaine += tableau[i];
			}
		}
		f.value = chaine;
	}
}

function MaxLengthTextarea(objettextarea, maxlength) {
	if (objettextarea.value.length >= maxlength) {
		objettextarea.value = objettextarea.value.substring(0, maxlength);
		alert('Votre texte ne doit pas dépasser ' + maxlength + ' caractères!');
	}
}