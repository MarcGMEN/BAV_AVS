<script>
	var tri = "obj_numero";
	var sens = "asc";
	var tabSel = {};

	function initPage() {
		if (ADMIN) {
			x_return_enum('bav_objet', 'obj_type', display_list_type);
			x_return_enum('bav_objet', 'obj_public', display_list_public);
			x_return_enum('bav_objet', 'obj_pratique', display_list_pratique);
			x_return_statClient(display_statClient);
			x_return_stat(tabToString(tabSel), display_stat)
			x_return_histoCount('tarif', 500, 250, display_countTarif);
			x_return_countByTarifSup(500, display_countByTarifSup);
		} else {
			goTo();
		}
	}

	function display_countCDP(val) {
		getElement('code_postal').src = val;
	}

	function display_statClient(val) {
		// usage example:
		initMap();
		for (i in val['count_code_postal']) {
			if (i) {
				geoPosClient(i, false, false, val['count_code_postal'][i]);
			}
		}
	}

	function display_countType(val) {
		getElement('type').src = val;
	}

	function display_countPublic(val) {
		getElement('public').src = val;
	}

	function display_countPratique(val) {
		getElement('pratique').src = val;
	}

	function display_countMarque(val) {
		getElement('marque').src = val;
	}

	function display_countTarif(val) {
		getElement('tarif').src = val;
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
		if (ADMIN) {} else {
			goTo();
		}
	}

	function selectColonne() {
		tabSel['obj_type'] = getElement("sel_obj_type").value;
		tabSel['obj_public'] = getElement("sel_obj_public").value;
		tabSel['obj_pratique'] = getElement("sel_obj_pratique").value;

		var tabAff = [];
		tabAff['Tobj_type'] = tabSel['obj_type'];
		tabAff['Tobj_public'] = tabSel['obj_public'];
		tabAff['Tobj_pratique'] = tabSel['obj_pratique']

		display_formulaire(tabAff, null);

		x_return_stat(tabToString(tabSel), display_stat)
	}

	function display_stat(val) {

		infoPlusObj("prixMiniDepot", val['objprixMiniDepot']);
		infoPlusObj("prixMaxiDepot", val['objprixMaxiDepot']);
		infoPlusObj("prixMiniVente", val['objprixMiniVente']);
		infoPlusObj("prixMaxiVente", val['objprixMaxiVente']);
		infoPlusObj("delaiMinSV", val['objdelaiMinSV']);
		infoPlusCli("nbVeloMaxiVendeurVente", val['clinbVeloMaxiVendeurVente']);
		infoPlusCli("nbVeloMaxiVendeurDepot", val['clinbVeloMaxiVendeurDepot']);
		infoPlusCli("nbVeloMaxiAcheteur", val['clinbVeloMaxiAcheteur']);

		display_formulaire(val, null);
	}

	function infoPlusObj(id, obj) {
		if (obj) {
			obj['plus' + id] = "(" + obj['obj_numero'] + ") " + obj['obj_type'] + "-" + obj['obj_public'] + " - " + obj['obj_marque'] + " [" + obj['vendeur_nom'] + "]"
			getElement('plus' + id).onclick = function() {
				goTo("fiche.php", "modif", obj['obj_id']);
			};
		}
	}

	function infoPlusCli(id, obj) {
		if (obj) {
			obj['plus' + id] = "(" + obj['cli_id_modif'] + ") " + obj['cli_nom'];
			getElement('plus' + id).onclick = function() {
				goTo("client.php", "modif", obj['cli_id']);
			};
		}
	}

	function display_countByTarifSup(val) {
		getElement('count_range').innerHTML = val;
	}
</script>

<style type="text/css">
	#map {
		/* la carte DOIT avoir une hauteur sinon elle n'apparaît pas */
		height: 400px;
	}
</style>
<fieldset class=fiche>
	<legend class=titreFiche>Stat diverses</legend>
	<table width="100%">
		<tr>
			<td class="tittab" width=33%>
				<span>Type</span>
				&nbsp;<select id="sel_obj_type" onchange="selectColonne()"></select></td>
			<td class="tittab" width=33%>
				<span>Public</span>
				&nbsp;<select id="sel_obj_public" onchange="selectColonne()"></select></td>
			<td class="tittab" width=33%>
				<span>Pratique</span>
				&nbsp;<select id="sel_obj_pratique" onchange="selectColonne()"></select></td>
		</tr>
	</table>
	<?php
	$tabCategLigne = [
		'prixMiniDepot' => 'Prix mini depot',
		'prixMaxiDepot' => 'Prix maxi depot',
		'prixMoyenDepot' => 'Prix moyen depot',
		'prixMiniVente' => 'Prix mini vente',
		'prixMaxiVente' => 'Prix maxi vente',
		'prixMoyenVente' => 'Prix moyen vente',
		'---------------------------------' => '----------------------------',
		'delaiMoyenSV' => 'Delai moyen Stock-Vente',
		'delaiMinSV' => 'Delai mini Stock-Vente',
		//'delaiMoyenVP' => 'Delai mini Vente Paye',
		//'delaiMoyenVR' => 'Delai moyen Vente Rendu',
		'----------------------------------' => '----------------------------',
		'nbVeloVendeurDepot' => 'Nombre moyen de velo par vendeur',
		'nbVeloMaxiVendeurDepot' => 'Nombre maxi de velo depose / vendeur',
		'nbVeloMaxiVendeurVente' => 'Nombre maxi de vélo vendu / vendeur',
	    '-------------------------------' => '----------------------------',
		'nbVeloAcheteur' => 'Nombre moyen de velo par acheteur',
		'nbVeloMaxiAcheteur' => 'Nombre maxi de velo pour un acheteur'
		//'nbVeloPlus500' => 'Nombre de velo au dessus de 400E',
	];
	$tabCategCol = [
		'total',
	];

	$tabCount = [
		'depot_J30' => 'Depot < 7',
		'depot_J7' => 'Depot 7 < 0',
		'stock_J1' => 'Stock J1',
		'3' => '..',
		'stock_J2-AM' => 'Stock AM J2',
		'vente_J2-AM' => 'Vente AM J2',
		'stock_J2-PM' => 'Stock PM J2',
		'vente_J2-PM' => 'Vente PM J2',
		'stock_J3-AM' => 'Stock AM J3',
		'vente_J3-AM' => 'Vente AM J3',
		'stock_J3-PM' => 'Stock PM J3',
		'vente_J3-PM' => 'Vente PM J3',
	];
	?>
	<br />

	<table width="100%">
		<tr>
			<td class="tittab" width=30%></td>
			<td colspan=2 class="tittab" width=70%>
				<span>Total </span>&nbsp;
				<span id='count'>()</span>&nbsp;
				<span id='Tobj_type'>*</span>&nbsp;
				<span id='Tobj_public'>*</span>&nbsp;
				<span id='Tobj_pratique'>*</span>
			</td>
		</tr>
		<?php
		foreach ($tabCategLigne as $keyL => $valL) {
			?>
			<tr class='tabl1'>
				<td class="tittab"><?= $valL; ?></td>
				<?php foreach ($tabCategCol as $valC) {
						?>
					<td width='30%' id='<?= $keyL; ?>' style='text-align:center'><?= $keyL; ?></td>
					<td width='40%' class="link" id='plus<?= $keyL; ?>' style='text-align:center'></td>
				<?php
					} ?>
			</tr>
		<?php
		} ?>
	</table>
	<hr/>
	<table width="100%">
		<tr class='tabl1'>
			<td class="tittab">Nombre de velo superieur a <input type=range oninput="getElement('resultRange').innerHTML=this.value" onchange="x_return_countByTarifSup(this.value, display_countByTarifSup);" min=0 max=3000 range=50 value=500 list="tickmarks" />
				<datalist id="tickmarks">
					<option value="0">
					<option value="100">
					<option value="200">
					<option value="300">
					<option value="400">
					<option value="500">
					<option value="600">
					<option value="700">
					<option value="800">
					<option value="900">
					<option value="1000">
					<option value="1500">
					<option value="2000">
					<option value="2500">
					<option value="3000">
					<option value="3500">
				</datalist>
				<div id="resultRange">500</div>
			</td>
			<td width='30%' id='count_range' style='text-align:center'>--</td>
			<td width='40%'></td>
		</tr>
	</table>
</fieldset>
<br />
<fieldset class=fiche>
	<legend class=titreFiche>Stat journaliere</legend>
	<div class="row">
		<?php foreach ($tabCount as $keyL => $valL) {
			?>
			<div class="col-sm-3 col-xs-12 tabl1">
				<div class="col-sm-8 col-xs-8 tittab"><?= $valL; ?></div>
				<div class="col-sm-4 col-xs-4" id='<?= $keyL; ?>' style='text-align:center'></div>
			</div>
		<?php
		} ?>
	</div>
</fieldset>
<br />
<fieldset class=fiche>
	<legend class=titreFiche>Repartition</legend>
	<div class="row">
		<?php foreach (['type', 'public', 'pratique'] as $valL) {
			?>
			<div class="col-sm-4 col-xs-12">
				<img id="<?= $valL; ?>" />
			</div>
		<?php
		} ?>
		<div class="col-sm-12 col-xs-12">
			<center><img id="marque" /></center>
		</div>
		<div class="col-sm-4 col-xs-12">
			<center><img id="tarif" /></center>
			<center><img id="code_postal" /></center>
		</div>
		<div class="col-sm-8 col-xs-12">
			<div id=map></div>
		</div>
	</div>
</fieldset>
<hr />