<script>

	var tri = "obj_marque";
	var sens = "asc";
	var tabSel = {};
	if (CLIENT) {
		tabSel['obj_etat'] = 'CONFIRME';
	}
	else {
		tabSel['obj_etat'] = 'STOCK';
	}

	// tabSel['obj_etat'] = 'RENDU';
	var vueParc = "<?= $infAppli['vue_parc'] ?>";
</script>
<script src="JS/stock-client.js"></script>

<h3>Liste des vélos disponibles.</h3>
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
				class="sortable">Type</span>
			<!-- &nbsp;<select id="sel_obj_type"
				onchange="selectColonne('obj_type', this.value)"></select> -->
		</td>
		<!-- <td class="tittab" width=10%>
			<span id='obj_couleur' onclick="triColonne('obj_couleur')" class="sortable">Couleur&nbsp;&nbsp;&nbsp;</span>
			&nbsp;
		</td> -->
		<!-- <td class="tittab" width=10%>
			<span id='obj_public' onclick="triColonne('obj_public')"
				class="sortable">Public&nbsp;&nbsp;&nbsp;</span>
			&nbsp;<select id="sel_obj_public"
				onchange="selectColonne('obj_public', this.value)"></select> -->
		<!-- </td> -->

		<td class="tittab " width=30%>
			<span id='obj_marque' onclick="triColonne('obj_marque')"
				class="sortable">Marque&nbsp;&nbsp;</span>
			&nbsp;<select id="sel_obj_marque"
				onchange="selectColonne('obj_marque', this.value)"></select>
		</td>

		<? if (isset($_COOKIE['CAFFARD_BAV'])) { ?>
		<td class="tittab " width=20%>
			Prix/ prix négo
		</td>
		<?}?>

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