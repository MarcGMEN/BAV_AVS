<script>
	var tri = "obj_numero";
	var sens = "asc";
	var tabSel = {};

	function initPage() {
		if (ADMIN || TABLE) {
			x_return_enum('bav_objet', 'obj_type', display_list_type);
		x_return_enum('bav_objet', 'obj_public', display_list_public);
		x_return_enum('bav_objet', 'obj_pratique', display_list_pratique);

		x_return_stat(tabToString(tabSel), display_stat)}
		else {
			goTo();
		}
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

	function display_list(val, row) {
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

	function selectColonne() {
		tabSel['obj_type'] = getElement("sel_obj_type").value;
		tabSel['obj_public'] = getElement("sel_obj_public").value;
		tabSel['obj_pratique'] = getElement("sel_obj_pratique").value;
		//tabSel[col] = mask;

		console.log(tabSel);
		x_return_stat(tabToString(tabSel), display_stat)
	}

	function display_stat(val) {
		console.log(val);

		display_formulaire(val, null);
	}
</script>
<table width="100%">
	<tr>
		<td class="tittab" width=33%>
			<span id='obj_type'>Type</span>
			&nbsp;<select id="sel_obj_type" onchange="selectColonne()"></select></td>
		<td class="tittab" width=33%>
			<span id='obj_public'>Public</span>
			&nbsp;<select id="sel_obj_public" onchange="selectColonne()"></select></td>
		<td class="tittab" width=33%>
			<span id='obj_pratique'>Pratique</span>
			&nbsp;<select id="sel_obj_pratique" onchange="selectColonne()"></select></td>
	</tr>
</table>
<br />
<table width="100%">
	<tr>
		<td class="tittab" width=30%></td>
		<td class="tittab" width=70%><span>Total</span></td>
	</tr>
	<?
	$tabCategLigne = [
		'prixMini' => 'Prix mini',
		'prixMaxi' => 'Prix maxi',
		'prixMoyen' => 'Prix moyen',
		'delaiMoyenSV' => 'Delai moyen Stock-Vente',
		'delaiMinSV' => 'Delai mini Stock-Vente',
		//'delaiMoyenVP' => 'Delai mini Vente Paye',
		'delaiMoyenVR' => 'Delai moyen Vente Rendu',
		'nbVeloVendeur' => 'Nombre moyen de velo par vendeur',
		'nbVeloMaxiVendeur' => 'Nombre maxi de velo pour un vendeur',
		'nbVeloAcheteur' => 'Nombre moyen de velo par acheteur',
		'nbVeloMaxiAcheteur' => 'Nombre maxi de velo pour un acheteur',

	];
	$tabCategCol = [
		'total'
	];
	foreach ($tabCategLigne as $keyL => $valL) { ?>
		<tr class='tabl0'>
			<td class="tittab" ><?= $valL ?></td>
			<? foreach ($tabCategCol as $valC) { ?>
				<td id='<?= $keyL ?>' style='text-align:center'><?= $keyL ?></td>
			<? } ?>
		</tr>
	<? }
	?>
</table>
<div id=fiches></div>