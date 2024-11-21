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

<h3>Liste des vélos disponibles triés par marque.</h3>
<br />
<table width="100%" class="alert alert-info">
	<tr>
		<td width=80%>
			Recherche : <input type=text class="autocomplete" name='search_<?= rand(1, 100) ?>' size="10" maxlength="100" onkeyup="search(this.value)" style='width:50%'
			placeholder="Recherche avec plusieurs mots possible."/>
		</td>
		<td width=20%>
			Nb <span id=total></span>
		</td>
	</tr>
</table>
<div id=fiches></div>