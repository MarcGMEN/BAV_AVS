<script>
	var tri = "obj_numero";
	var sens = "asc";
	var tabSel = {};

	tabSel[modePage] = '<?= $GET_id ?>';

	function initPage() {
		x_return_enum('bav_objet', 'obj_type', display_list_type);
		//x_return_enum('bav_objet', 'obj_public', display_list_public);
		//x_return_enum('bav_objet', 'obj_pratique', display_list_pratique);

		x_return_list_marques(display_list_marque)
		x_return_list_unique("bav_objet", "obj_etat", display_list_etat)
		x_return_list_unique("bav_objet", "obj_couleur", display_list_couleur)
		x_return_fiches(tri, sens, tabToString(tabSel), display_fiches);
	}

	function display_list_type(val) {
		display_list(val, 'type');
	}

	function display_list_public(val) {
		display_list(val, 'public');
	}

	function display_list_pratique(val) {
		display_list(val, 'pratique');
	}


	function display_list_marque(val) {
		display_list(val, 'marque');
	}

	function display_list_couleur(val) {
		display_list(val, 'couleur');
	}

	function display_list_etat(val) {
		display_list(val, 'etat');
	}

	function display_list(val, row) {
		console.log(val);
		var select = getElement("sel_obj_" + row);
		select.options[select.options.length] = new Option("Choix", "*");
		for (index in val) {
			select.options[select.options.length] = new Option(val[index], val[index]);
			if (tabSel['obj_' + row] != null && tabSel['obj_' + row] == val[index]) {
				select.options[select.options.length - 1].selected = true;
			}
		}
	}

	function unloadPage() {}

	// recuperation des donnees de la BAV
	function setParamVal(val) {
		setParamValIndex(val);
		if (TABLE || ADMIN) {} else {
			goTo();
		}
	}

	function display_fiches(val) {
		if (val instanceof Object) {

			var total = 0;
			var repr = "<table width='100%' border=1>";
			for (index in val) {
				if (!isNaN(index)) {
					repr += "<tr class='tabl0 " + val[index]['obj_etat'] + " link' onclick='goTo(\"fiche.php\",\"modif\"," + val[index]['obj_id'] + ")'>";
					repr += "<td width=5% align=center>";
					repr += val[index]['obj_numero'];
					repr += "</td>";
					repr += "<td width=10% >";
					repr += val[index]['obj_type'];
					repr += "</td>";
					/*repr += "<td width=10% >";
					repr += val[index]['obj_public'];
					repr += "</td>";
					repr += "<td width=10% >";
					repr += val[index]['obj_pratique'];
					repr += "</td>";*/
					repr += "<td class='maskMobile' width=10% >";
					repr += val[index]['obj_marque'];
					repr += "</td>";
					repr += "<td class='maskMobile' width=10% >";
					repr += val[index]['vendeur_nom'];
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
					repr += "<td width=10% class='maskMobile' >";
					repr += formatDate(val[index]['obj_date_depot'], false);
					repr += "</td>";
					repr += "<td class='maskMobile' width=10% >";
					repr += val[index]['acheteur_nom'];
					repr += "</td>";
					repr += "<td class='maskMobile' width=20% title='date vente - date retour'>";
					repr += formatDate(val[index]['obj_date_vente'], false);
					repr += " - ";
					repr += formatDate(val[index]['obj_date_retour'], false);
					repr += "</td>";
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
			getElement('total_vente_rendu').innerHTML = val['total_vente_RENDU'];
				


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
		x_return_fiches(col, sens, tabToString(tabSel), display_fiches);
		tri = col;
	}

	function selectColonne(col, mask) {
		tabSel['obj_type'] = getElement("sel_obj_type").value;
		tabSel['obj_marque'] = getElement("sel_obj_marque").value;
		tabSel['obj_etat'] = getElement("sel_obj_etat").value;
		//tabSel[col] = mask;

		console.log(col + "," + sens);
		console.log(tabSel);
		x_return_fiches(col, sens, tabToString(tabSel), 0, display_fiches);
	}

	function display_listVendeur(val) {
		var list = getElement("listVendeur");
		list.innerHTML = "";;
		for (index in val) {
			list.appendChild(new Option(val[index], val[index]));
		}
	}
</script>
<table width="100%" class="alert alert-info">
	<tr>
		<td width=12%>
			Nb
		</td>
		<td width=22%>Dépôt</td>
		<td width=22%>Stock</td>
		<td width=22%>Vendu</td>
		<td width=22%>Payé / Rendu</td>
	</tr>
	<tr>
		<td >
			<span id=total></span>		
		</td>
		<td ><b><span id=total_vente_depot>0.00</span> €</b></td>
		<td ><b><span id=total_vente_stock>0.00</span> €</b></td>
		<td ><b><span id=total_vente_vendu>0.00</span> €</b></td>
		<td ><b><span id=total_vente_paye>0.00</span> €</b> / <b><span id=total_vente_rendu>0.00</span> €</b></td>
	</tr>
	<tr>
		<td ></td><td ></td>
		<td >Dépôt </td>
		<td >Com</td>
		<td >Com recu</td>
		
	</tr>	
	<tr>
		<td ></td><td ></td>
		<td ><b><span id=total_depot>0.00</span> €</b></td>
		<td ><b><span id=total_com_vendu>0.00</span> €</b></td>
		<td ><b><span id=total_com_paye>0.00</span> €</b></td>
		
	</tr>	
</table>
<table width="100%">
	<tr>
		<td class="tittab" width=5%>
			<span id='obj_numero' onclick="triColonne('obj_numero')" class="sortable">No&nbsp;&nbsp;</span></td>
		<td class="tittab" width=10%>
			<span id='obj_type' onclick="triColonne('obj_type')" class="sortable">Type&nbsp;&nbsp;</span>
			&nbsp;<select id="sel_obj_type" onchange="selectColonne('obj_type', this.value)"></select></td>
		<!--<td class="tittab" width=10%>
			<span id='obj_public' onclick="triColonne('obj_public')" class="sortable">Public&nbsp;&nbsp;&nbsp;</span>
			&nbsp;<select id="sel_obj_public" onchange="selectColonne('obj_public', this.value)"></select></td>
		<td class="tittab" width=10%>
			<span id='obj_pratique' onclick="triColonne('obj_pratique')" class="sortable">Pratique&nbsp;&nbsp;&nbsp;</span>
			&nbsp;<select id="sel_obj_pratique" onchange="selectColonne('obj_pratique', this.value)"></select></td>-->
		<td class="tittab maskMobile" width=10%>
			<span id='obj_marque' onclick="triColonne('obj_marque')" class="sortable">Marque&nbsp;&nbsp;</span>
			&nbsp;<select id="sel_obj_marque" onchange="selectColonne('obj_marque', this.value)"></select></td>
		<!--<td class="tittab maskMobile" width=10%>
			<span id='obj_marque' onclick="triColonne('obj_couleur')" class="sortable">Couleur&nbsp;&nbsp;&nbsp;</span>
			&nbsp;<select id="sel_obj_couleur" onchange="selectColonne('obj_couleur', this.value)"></select></td>-->
		<td class="tittab maskMobile" width=10%>
			<span id='vendeur_nom' onclick="triColonne('vendeur_nom')" class="sortable">Vendeur&nbsp;&nbsp;</span>
			<!--<input type=text name='cli_nom_<?= rand(1, 100) ?>' size="20" class="autocomplete" maxlength="100" 
				onkeyup="x_return_listClientByName(this.value, display_listVendeur);"
				onblur="selectColonne('cli_id_vendeur', this.value)"
				list=listVendeur />
			<datalist id="listVendeur"></datalist>-->
		</td>
		<td class="tittab" width=10%>
			<span class="sortable" id='obj_prix_vente' onclick="triColonne('obj_prix_vente')">Prix vente&nbsp;&nbsp;</span></td>
		<td class="tittab" width=10%>
			<span id='obj_etat' onclick="triColonne('obj_etat')" class="sortable">Etat&nbsp;&nbsp;</span>
			&nbsp;<select id="sel_obj_etat" onchange="selectColonne('obj_etat', this.value)"></select></td>
		<td class="tittab maskMobile" width=10%>
			<span class="sortable" id='obj_date_depot' onclick="triColonne('obj_date_depot')">Date depot&nbsp;&nbsp;</span></td>
		<td class="tittab maskMobile" width=10%>
			<span id='acheteur_nom' onclick="triColonne('acheteur_nom')" class="sortable">Acheteur&nbsp&nbsp;</span></td>
		<td class="tittab maskMobile" width=20%>
			<span class="sortable" id='obj_date_vente' onclick="triColonne('obj_date_vente')">Date vente&nbsp;&nbsp;</span></td>
	</tr>
</table>
<div id=fiches></div>