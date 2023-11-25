
function initPage() {

	if (vueParc == '1' || ADMIN) {
		// x_return_enum('bav_objet', 'obj_type', display_list_type);
		// x_return_enum('bav_objet', 'obj_public', display_list_public);
		//x_return_enum('bav_objet', 'obj_pratique', display_list_pratique);
		// 
		x_return_list_marques(display_list_marque)
		x_return_fiches(tri, sens, tabToString(tabSel), 0, 0, display_fiches);
	} else {
		goTo();
	}
}

function display_list_public(val) {
	display_list(val, 'public');
}

function display_list_pratique(val) {
	display_list(val, 'pratique');
}

function display_list_type(val) {
	display_list(val, 'type');
}

function display_list_marque(val) {
	display_list(val, 'marque');
}


function display_list_modele(val) {
	display_list(val, 'modele');
}

function display_list(val, row) {
	//console.log(val);
	var select = getElement("sel_obj_" + row);
	select.options[select.options.length] = new Option("Choix", "*");
	for (index in val) {
		select.options[select.options.length] = new Option(val[index], val[index]);
		if (tabSel['obj_' + row] != null && tabSel['obj_' + row] == val[index]) {
			select.options[select.options.length - 1].selected = true;
		}
	}
}

function unloadPage() { }

// recuperation des donnees de la BAV
function setParamVal(val) {
	setParamValIndex(val);
	if (ADMIN) { } else {
		goTo();
	}
}

function display_fiches(val) {
	// console.log(val);
	if (val instanceof Object) {

		var total = 0;
		var repr = "<table width='100%' border=1>";
		for (index in val) {
			if (!isNaN(index)) {

				val['obj_marque_orig'] = val[index]['obj_marque'];
				val['obj_modele_orig'] = val[index]['obj_modele'];
				if (gSearch) {
					var tabSearch = gSearch.replace("%", " ").split(" ");
					for (i in tabSearch) {
						if (tabSearch[i] != "") {
							var reg = new RegExp("(" + tabSearch[i] + ")", "gi");
							val[index]['obj_modele'] = val[index]['obj_modele'].replace(reg, "<b style='color:BLUE'>$1</b>");
							val[index]['obj_description'] = val[index]['obj_description'].replace(reg, "<b style='color:BLUE'>$1</b>");
							// val[index]['obj_prix_vente'] = val[index]['obj_prix_vente'].replace(reg, "<b style='color:BLUE'>$1</b>");
							// val[index]['obj_prix_depot'] = val[index]['obj_prix_depot'].replace(reg, "<b style='color:BLUE'>$1</b>");
							val[index]['obj_couleur'] = val[index]['obj_couleur'].replace(reg, "<b style='color:BLUE'>$1</b>");
							val[index]['obj_public'] = val[index]['obj_public'].replace(reg, "<b style='color:BLUE'>$1</b>");
							val[index]['obj_type'] = val[index]['obj_type'].replace(reg, "<b style='color:BLUE'>$1</b>");
							val[index]['obj_marque'] = val[index]['obj_marque'].replace(reg, "<b style='color:BLUE'>$1</b>");
							val[index]['obj_taille'] = val[index]['obj_taille'].replace(reg, "<b style='color:BLUE'>$1</b>");
						}
					}
				}

				repr += "<tr class='tabl0' >";
				// repr += "<td width=5% align=center>";
				// repr += val[index]['obj_numero'];
				// repr += "</td>";
				repr += "<td width=10% >";
				repr += val[index]['obj_type'];
				repr += " "
				repr += val[index]['obj_public'] != "Autre" ? val[index]['obj_public'] : "";
				repr += "</td>";
				repr += "<td  width=30% >";
				repr += val[index]['obj_marque'];
				var year = "";
				if (val[index]['obj_date_achat']) {
					year = new Date(val[index]['obj_date_achat']).getFullYear();
				}
				if (val[index]['obj_modele']) {
					repr += " " + val[index]['obj_modele'];
					repr += "&nbsp<A href='https://www.google.fr/search?tbm=isch&q=" + val['obj_marque_orig'] + " " + val['obj_modele_orig'] + " " + year + "' target='_blank' ><img src='https://www.we-do-it-better.fr/wp-content/uploads/2019/04/googlesearch.png' height='20px'/></A></span>";
				}
				repr += "</td>";
				if (GetCookie('CAFFARD_BAV')) {
					repr += "<td width=20% >";
					repr += val[index]['obj_prix_depot'];
					if (val[index]['obj_prix_nego'] != "0.00") {
						repr += " -> " + val[index]['obj_prix_nego'];
					}
					repr += "</td>";
				}

				repr += "<td width=5% class='maskMobile' >";
				repr += val[index]['obj_taille'];
				repr += "</td>";
				repr += "<td class='maskMobile' style='text-align:center;width:15%' >";
				repr += year;
				repr += "</td>";

				repr += "<td class='maskMobile' width=35% >";
				repr += val[index]['obj_description'];
				repr += "</td>";

				// repr += "<td width=10% >";
				// if (val[index]['obj_prix_vente'] == 0) {
				// 	repr += "<span style='color:RED'>" + val[index]['obj_prix_depot'] + "</span>";
				// } else {
				// 	if (val[index]['obj_prix_depot'] != val[index]['obj_prix_vente']) {
				// 		repr += '<div style="text-align:left;color:grey;font-size:0.8em;text-decoration:line-through;">' + val[index]['obj_prix_depot'] + ' &euro;</div>';
				// 	}
				// 	repr += val[index]['obj_prix_vente'];
				// }
				// repr += "&nbsp;&euro;";
				// repr += "</td>";
				repr += "</tr>";

				total = total + 1;
			}
		}
		repr += "</table>";

		getElement('fiches').innerHTML = repr;

		getElement('total').innerHTML = total;

		if (sens == "asc") {
			classSort = "sortUp";
		} else {
			classSort = "sortDown";
		}
		getElement(tri).className = classSort;
	} else {
		alertModalWarn(val);
	}


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
	x_return_fiches(col, sens, tabToString(tabSel), 0, 0, display_fiches);
	tri = col;
}

function selectColonne(col, mask) {
	// tabSel['obj_type'] = getElement("sel_obj_type").value;
	tabSel['obj_marque'] = getElement("sel_obj_marque").value;
	// tabSel['obj_public'] = getElement("sel_obj_public").value;
	//tabSel['obj_pratique'] = getElement("sel_obj_pratique").value;
	//tabSel[col] = mask;

	// console.log(col + "," + sens);
	// console.log(tabSel);
	x_return_fiches(col, sens, tabToString(tabSel), 0, 0, display_fiches);
}
var gSearch = ""

function search(search) {
	gSearch = search;
	tabSel['obj_search'] = search;
	x_return_fiches(tri, sens, tabToString(tabSel), 0, 0, display_fiches);
}
