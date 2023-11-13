<script>
	var tri = "obj_marque";
	var sens = "asc";
	var tabSel = {};
	if (CLIENT) {
		// tabSel['obj_etat'] = 'CONFIRME';
	}
	else {
		// tabSel['obj_etat'] = 'STOCK';
	}
	// tabSel['obj_etat'] = 'RENDU';
	var vueParc = "<?= $infAppli['vue_parc'] ?>";

	function initPage() {

		console.log(vueParc);
		if (vueParc == '1' || ADMIN) {
			x_return_enum('bav_objet', 'obj_type', display_list_type);
			x_return_enum('bav_objet', 'obj_public', display_list_public);
			//x_return_enum('bav_objet', 'obj_pratique', display_list_pratique);

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
		console.log(val);
		if (val instanceof Object) {

			var total = 0;
			var repr = "<table width='100%' border=1>";
			for (index in val) {
				if (!isNaN(index)) {
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
					repr += "</td>";
					repr += "<td  width=10% >";
					repr += val[index]['obj_public'];
					repr += "</td>";
					repr += "<td  width=15% >";
					repr += val[index]['obj_marque'];
					repr += "</td>";
					repr += "<td  width=15% >";
					repr += val[index]['obj_modele'];
					repr += "</td>";
					repr += "<td width=5% class='maskMobile' >";
					repr += val[index]['obj_taille'];
					repr += "</td>";
					repr += "<td class='maskMobile' style='text-align:center;width:15%' >";
					if (val[index]['obj_date_achat']) {
						var year=new Date(val[index]['obj_date_achat']).getFullYear();
						repr += year;
					}
					
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
		tabSel['obj_type'] = getElement("sel_obj_type").value;
		tabSel['obj_marque'] = getElement("sel_obj_marque").value;
		tabSel['obj_public'] = getElement("sel_obj_public").value;
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
</script>
<br />
<table width="100%" class="alert alert-info">
	<tr>
		<td width=70%>
			Recherche : <input type=text class="autocomplete"
				name='search_<?= rand(1, 100) ?>' size="10" maxlength="100"
				onkeyup="search(this.value)" />
		</td>
		<td width=30%>
			Nb <span id=total></span>
		</td>
	</tr>
</table>
<table width="100%">
	<tr>
		<!-- <td class="tittab" width=5%>
			<span id='obj_numero' onclick="triColonne('obj_numero')" class="sortable">No&nbsp;&nbsp;</span>
		</td> -->
		<td class="tittab" width=10%>
			<span id='obj_type' onclick="triColonne('obj_type')"
				class="sortable">Type&nbsp;&nbsp;</span>
			&nbsp;<select id="sel_obj_type"
				onchange="selectColonne('obj_type', this.value)"></select>
		</td>
		<!-- <td class="tittab" width=10%>
			<span id='obj_couleur' onclick="triColonne('obj_couleur')" class="sortable">Couleur&nbsp;&nbsp;&nbsp;</span>
			&nbsp;
		</td> -->
		<td class="tittab" width=10%>
			<span id='obj_public' onclick="triColonne('obj_public')"
				class="sortable">Public&nbsp;&nbsp;&nbsp;</span>
			&nbsp;<select id="sel_obj_public"
				onchange="selectColonne('obj_public', this.value)"></select>
		</td>

		<td class="tittab " width=15%>
			<span id='obj_marque' onclick="triColonne('obj_marque')"
				class="sortable">Marque&nbsp;&nbsp;</span>
			&nbsp;<select id="sel_obj_marque"
				onchange="selectColonne('obj_marque', this.value)"></select>
		</td>
		<td class="tittab " width=15%>
			<span id='obj_modele' onclick="triColonne('obj_modele')"
				class="sortable">Modèle&nbsp;&nbsp;
		</td>
		<td class="tittab maskMobile" width=5%>
			<span id='obj_taille' onclick="triColonne('obj_taille')"
				class="sortable">Taille&nbsp;&nbsp;&nbsp;</span>
			&nbsp;
		</td>
		<td class="tittab maskMobile" width=15%>
			<span id='obj_date_achat' onclick="triColonne('obj_date_achat')"
				class="sortable">Année modèle&nbsp;&nbsp;&nbsp;</span>
			&nbsp;
		</td>

		<td class="tittab maskMobile" width=35%>
			Description</td>
		<!-- <td class="tittab" width=10%>
			<span class="sortable" id='obj_prix_vente' onclick="triColonne('obj_prix_vente')">Prix vente&nbsp;&nbsp;</span>
		</td> -->
	</tr>
</table>
<div id=fiches></div>