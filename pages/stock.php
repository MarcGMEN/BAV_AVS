<script>
	var tri = "obj_numero";
	var sens = "asc";
	var tabSel = {};

	tabSel[modePage] = '<?= $GET_id; ?>';

</script>
<script src="JS/stock.js" ></script>
<table width="100%" class="alert alert-info">
	<tr>
		<td width=12%>
			Nb
		</td>
		<td width=22%>Total</td>
		<td width=22%>Stock</td>
		<td width=22%>Vendu</td>
		<td width=22%>Payé</td>
	</tr>
	<tr>
		<td>
			<span id=total></span>
		</td>
		<td><b><span id=total_vente_depot>0.00</span> €</b></td>
		<td><b><span id=total_vente_stock>0.00</span> €</b></td>
		<td><b><span id=total_vente_vendu>0.00</span> €</b></td>
		<td><b><span id=total_vente_paye>0.00</span> €</b>
			<!--/ <b><span id=total_vente_rendu>0.00</span> €</b>-->
		</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td>Dépôt </td>
		<td>Com</td>
		<td>Com recu</td>

	</tr>
	<tr>
		<td></td>
		<td></td>
		<td><b><span id=total_depot>0.00</span> €</b></td>
		<td><b><span id=total_com_vendu>0.00</span> €</b></td>
		<td><b><span id=total_com_paye>0.00</span> €</b></td>

	</tr>
</table>
<table width="100%" >
	<tr>
		<td class="tittab" width=5%>
			<span id='obj_numero' onclick="triColonne('obj_numero')" class="sortable">No&nbsp;&nbsp;</span></td>
		<td class="tittab" width=8%>
			<span id='obj_type' onclick="triColonne('obj_type')" class="sortable">Type&nbsp;&nbsp;</span>
			&nbsp;<select id="sel_obj_type" onchange="selectColonne('obj_type', this.value)"></select></td>
		<td class="tittab maskMobile" width=8%>
			<span id='obj_couleur' onclick="triColonne('obj_couleur')" class="sortable ">Couleur&nbsp;&nbsp;&nbsp;</span>
			&nbsp;<input size=7 id='inp_obj_couleur' onkeyup="searchColonne('inp_obj_couleur')"  /></td>
		<!--<td class="tittab" width=10%>
			<span id='obj_pratique' onclick="triColonne('obj_pratique')" class="sortable">Pratique&nbsp;&nbsp;&nbsp;</span>
			&nbsp;<select id="sel_obj_pratique" onchange="selectColonne('obj_pratique', this.value)"></select></td>-->
		<td class="tittab maskMobile" width=12%>
			<span id='obj_marque' onclick="triColonne('obj_marque')" class="sortable">Marque&nbsp;&nbsp;</span>
			&nbsp;<select id="sel_obj_marque" onchange="selectColonne('obj_marque', this.value)"></select></td>
		<!--<td class="tittab maskMobile" width=10%>
			<span id='obj_marque' onclick="triColonne('obj_couleur')" class="sortable">Couleur&nbsp;&nbsp;&nbsp;</span>
			&nbsp;<select id="sel_obj_couleur" onchange="selectColonne('obj_couleur', this.value)"></select></td>-->
		<td class="tittab maskMobile" width=14%>
			<span id='vendeur_nom' onclick="triColonne('vendeur_nom')" class="sortable">Vendeur&nbsp;&nbsp;</span>
			<!--<input type=text name='cli_nom_<?= rand(1, 100); ?>' size="20" class="autocomplete" maxlength="100" 
				onkeyup="x_return_listClientByName(this.value, display_listVendeur);"
				onblur="selectColonne('cli_id_vendeur', this.value)"
				list=listVendeur />
			<datalist id="listVendeur"></datalist>-->
		</td>
		<td class="tittab" width=8%>
			<span class="sortable" id='obj_prix_vente' onclick="triColonne('obj_prix_vente')">Prix vente&nbsp;</span></td>
		<td class="tittab" width=8%>
			<span id='obj_etat' onclick="triColonne('obj_etat')" class="sortable">Etat&nbsp;&nbsp;</span>
			&nbsp;<select id="sel_obj_etat" onchange="selectColonne('obj_etat', this.value)"></select></td>
		<td class="tittab maskMobile" width=8%>
			<span class="sortable" id='obj_date_depot' onclick="triColonne('obj_date_depot')">Date depot&nbsp;</span></td>
		<td class="tittab maskMobile" width=14%>
			<span id='acheteur_nom' onclick="triColonne('acheteur_nom')" class="sortable">Acheteur&nbsp&nbsp;</span></td>
		<td class="tittab maskMobile" width=16%>
			<span class="sortable" id='obj_date_vente' onclick="triColonne('obj_date_vente')">Date vente&nbsp;&nbsp;</span></td>
	</tr>
</table>
<div id=fiches></div>