
<script>
	var tri="obj_numero";
	var sens="asc";
	var selection="*";
	var tabSel =new Array();
	
	function initPage() {
		x_return_fiches(tri,sens,selection,0,display_fiches);
		x_return_list_type(display_list_fiche);
		x_return_list_public(display_list_public);
	}
	function display_list_fiche(val) {
		var select = getElement("sel_obj_type");
		select.options[select.options.length] = new Option("Tous", "*");
		for(index in val) {
			    select.options[select.options.length] = new Option(val[index], val[index]);
		}
	}
	function display_list_public(val) {
		var select = getElement("sel_obj_public");
		select.options[select.options.length] = new Option("Tous", "*");
		for(index in val) {
			    select.options[select.options.length] = new Option(val[index], val[index]);
		}
	}
	
	function unloadPage() {
		
	} 

	function display_fiches(val) {

		var total = 0;
		var repr="<table width='100%'>";
		for (index in val) {
			repr+="<tr class='tabl0 link' onclick='location.href=\"index.php?page=fiche.php&numeroFiche="+val[index]['obj_numero']+"&action=visu\"'>";
			repr+="<td width=10% align=center>";
			repr+=val[index]['obj_numero'];
			repr+="</td>";
			repr+="<td width=20% >";
			repr+=val[index]['obj_type'];
			repr+="</td>";
			repr+="<td width=20% >";
			repr+=val[index]['obj_public'];
			repr+="</td>";
			repr+="<td width=20% >";
			repr+=val[index]['obj_marque'];
			repr+="</td>";
			repr+="<td width=10% >";
			repr+=val[index]['obj_prix_vente'];
			repr+="</td>";
			repr+="<td width=5% >";
			repr+=val[index]['obj_etat'];
			repr+="</td>";
			repr+="</tr>";

			total=total+1;
		}
		repr+="</table>";

		getElement('fiches').innerHTML=repr;

		getElement('total').innerHTML=total;

		if (sens=="asc") { classSort="sortUp";} else {classSort="sortDown";}
		getElement(tri).className=classSort;
	}

	function triColonne(col) {
		if (col==tri) {
			if (sens=="asc") {
				sens="desc";
			} 
			else {
				sens="asc";
			}
		}
		else {
			sens="asc";
		}
		getElement(tri).className="sortable";

		x_return_fiches(col,sens,tabSel,display_fiches);
		tri=col;
	}

	function selectColonne(col,mask) {
		tabSel[0]=getElement("sel_obj_type").value;
		tabSel[1]=getElement("sel_obj_public").value;
		//tabSel[2]=getElement("sel_obj_etat").value;
		x_return_fiches(col,sens,tabSel,0,display_fiches);
	}
	
</script>
<h2>Nb Total de la sélection :	<span id=total></span></h2>
<table width="100%">
<tr>
<td class="tittab" width=10% >
<span id='obj_numero' onclick="triColonne('obj_numero')" class="sortable">Numero&nbsp;&nbsp;&nbsp;</span></td>
<td class="tittab" width=20% >
<span id='obj_type' onclick="triColonne('obj_type')" class="sortable">Type&nbsp;&nbsp;&nbsp;</span> 
&nbsp;<select id="sel_obj_type" onchange="selectColonne('obj_type', this.value)"></select></td>
<td class="tittab" width=20% >
<span id='obj_public'  onclick="triColonne('obj_public')" class="sortable">Public&nbsp;&nbsp;&nbsp;</span> 
&nbsp;<select  id="sel_obj_public" onchange="selectColonne('obj_public', this.value)"></select></td>
<td class="tittab" width=20% >
<span id='obj_marque' onclick="triColonne('obj_marque')" class="sortable">Marque&nbsp;&nbsp;&nbsp;</span></td>
<td class="tittab" width=10% >
<span class="sortable" id='obj_prix_vente' onclick="triColonne('obj_prix_vente')">Prix vente&nbsp;&nbsp;&nbsp;</span></td>
<td class="tittab" width=5%>
<span id='obj_etat' onclick="triColonne('obj_etat')" class="sortable">Etat&nbsp;&nbsp;&nbsp;</span> 
<!--  &nbsp;<select id="sel_obj_etat" onchange="selectColonne('obj_etat', this.value)">
<option value="*">Tous</option>
<option>Vendu</option>
<option>Stock</option>
<option>Retour</option>
</select>-->
</td>
</tr>
</table>
<div id=fiches></div>