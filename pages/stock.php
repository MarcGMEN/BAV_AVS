<script>
	var tri = "obj_numero";
	var sens = "asc";
	var tabSel = new Array();

	tabSel[modePage] = '<?=$GET_id?>';

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
		var select = getElement("sel_obj_" + row);
		select.options[select.options.length] = new Option("Choix", "*");
		for (index in val) {
			select.options[select.options.length] = new Option(val[index], val[index]);
			if (tabSel['obj_' + row] == val[index]) {
				select.options[select.options.length - 1].selected = true;
			}
		}
	}

	function unloadPage() {

	}
	// recuperation des donnees de la BAV
	function setParamVal(val) {
    setParamValIndex(val);
    if (TABLE || ADMIN) {

    } else {
        goTo();
    }
}

	function display_fiches(val) {
		var total = 0;
		var repr = "<table width='100%'>";
		for (index in val) {
            if (!isNaN(index)) {
				repr += "<tr class='tabl0 link' onclick='goTo(\"fiche.php\",\"modif\"," + val[index]['obj_id'] + ")'>";
				repr += "<td width=10% align=center>";
				repr += val[index]['obj_numero'];
				repr += "</td>";
				repr += "<td width=20% >";
				repr += val[index]['obj_type'];
				repr += "</td>";
				/*repr += "<td width=10% >";
				repr += val[index]['obj_public'];
				repr += "</td>";
				repr += "<td width=10% >";
				repr += val[index]['obj_pratique'];
				repr += "</td>";*/
				repr += "<td class='maskMobile' width=20% >";
				repr += val[index]['obj_marque'];
				repr += "</td>";
				repr += "<td class='maskMobile' width=20% >";
				repr += val[index]['obj_couleur'];
				repr += "</td>";
				repr += "<td width=15% >";
				if (val[index]['obj_prix_vente'] == 0) {
					repr += "<span style='color:orange'>"+val[index]['obj_prix_depot']+"</span>";
				} else {
					repr += val[index]['obj_prix_vente'];
				}
				repr += "</td>";
				repr += "<td width=15% >";
				repr += val[index]['obj_etat'];
				repr += "</td>";
				repr += "</tr>";

				total = total + 1;
			}
		}
		repr += "</table>";

		getElement('fiches').innerHTML = repr;

		getElement('total').innerHTML = total;
		getElement('total_vente').innerHTML = val['total_vente'];


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
		console.log(col + "," + sens);
		console.log(tabSel);
		x_return_fiches(col, sens, tabToString(tabSel), display_fiches);
		tri = col;
	}

	function selectColonne(col, mask) {
		tabSel['obj_type'] = getElement("sel_obj_type").value;
		//tabSel['obj_public'] = getElement("sel_obj_public").value;
		//tabSel['obj_pratique'] = getElement("sel_obj_pratique").value;
		tabSel['obj_marque'] = getElement("sel_obj_marque").value;
		tabSel['obj_etat'] = getElement("sel_obj_etat").value;
		tabSel['obj_couleur'] = getElement("sel_obj_couleur").value;
		console.log(col + "," + sens);
		console.log(tabSel);
		x_return_fiches(col, sens, tabToString(tabSel), 0, display_fiches);
	}
</script>
<table>
	<tr>
		<td width=33%>
			<h3>Nb Total de la selection : <span id=total></span></h3>
		</td>
		<td width=33%>
			<h3>Total vente : <span id=total_vente></span>€</h3>
		</td>
	</tr>
	<table width="100%">
		<tr>
			<td class="tittab" width=10%>
				<span id='obj_numero' onclick="triColonne('obj_numero')" class="sortable">Numero&nbsp;&nbsp;&nbsp;</span></td>
			<td class="tittab" width=20%>
				<span id='obj_type' onclick="triColonne('obj_type')" class="sortable">Type&nbsp;&nbsp;&nbsp;</span>
				&nbsp;<select id="sel_obj_type" onchange="selectColonne('obj_type', this.value)"></select></td>
			<!--<td class="tittab" width=10%>
				<span id='obj_public' onclick="triColonne('obj_public')" class="sortable">Public&nbsp;&nbsp;&nbsp;</span>
				&nbsp;<select id="sel_obj_public" onchange="selectColonne('obj_public', this.value)"></select></td>
			<td class="tittab" width=10%>
				<span id='obj_pratique' onclick="triColonne('obj_pratique')" class="sortable">Pratique&nbsp;&nbsp;&nbsp;</span>
				&nbsp;<select id="sel_obj_pratique" onchange="selectColonne('obj_pratique', this.value)"></select></td>-->
			<td class="tittab maskMobile" width=20%>
				<span id='obj_marque' onclick="triColonne('obj_marque')" class="sortable">Marque&nbsp;&nbsp;&nbsp;</span>
				&nbsp;<select id="sel_obj_marque" onchange="selectColonne('obj_marque', this.value)"></select></td>
			<td class="tittab maskMobile" width=20%>
				<span id='obj_marque' onclick="triColonne('obj_couleur')" class="sortable">Couleur&nbsp;&nbsp;&nbsp;</span>
				&nbsp;<select id="sel_obj_couleur" onchange="selectColonne('obj_couleur', this.value)"></select></td>
			<td class="tittab" width=15%>
				<span class="sortable" id='obj_prix_vente' onclick="triColonne('obj_prix_vente')">Prix vente&nbsp;&nbsp;&nbsp;</span></td>
			<td class="tittab" width=15%>
				<span id='obj_etat' onclick="triColonne('obj_etat')" class="sortable">Etat&nbsp;&nbsp;&nbsp;</span>
				&nbsp;<select id="sel_obj_etat" onchange="selectColonne('obj_etat', this.value)"></select></td>
		</tr>
	</table>
	<div id=fiches></div>