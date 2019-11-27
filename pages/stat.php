<script>
	var tri = "obj_numero";
	var sens = "asc";
	var tabSel = {};

	function initPage() {
		if (ADMIN) {
			// recupereatio de la liste des selections
			x_return_enum('bav_objet', 'obj_type', display_list_type);
			x_return_enum('bav_objet', 'obj_public', display_list_public);
			x_return_enum('bav_objet', 'obj_pratique', display_list_pratique);

			// retour de stat client
			x_return_statClient(display_statClient);

			// retour de stat de delais
			x_return_statDelais(display_formulaire);

			// retour de stat de delais
			x_return_statRepartition(display_formulaire);

			// visu de la stat de depot
			x_return_statByType(tabToString(tabSel),"depot", display_statDepot);

			// affichage d'un histo des tarifs de depot
			x_return_histoCount('tarif', 500, 250, 0, 'depot', display_countTarifDepot);

			// retour du nombre d'objet vendu supérieur a 500 
			x_return_countByTarifSup(500, "depot", display_countByTarifSupDepot);

			// visu de la stat de vente
			x_return_statByType(tabToString(tabSel),"vente", display_statVente);

			// affichage d'un histo des tarifs de vente
			x_return_histoCount('tarif', 500, 250, 0, 'vente', display_countTarifVente);

			// retour du nombre d'objet vendu supérieur a 500 
			x_return_countByTarifSup(500, "vente", display_countByTarifSupVente);

		} else {
			// si pas ADMIN retour page accueil
			goTo();
		}
	}
	function unloadPage() {}

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
	/* Affichage des stats clients sous format map */
	function display_statClient(val) {
		// usage example:
		initMap();
		for (i in val['count_code_postal']) {
			if (i) {
				geoPosClient(i, false, false, val['count_code_postal'][i]);
			}
		}
	}

	function display_countTarifDepot(val) {
		getElement('tarifDepot').src = val;
	}

	function display_countTarifVente(val) {
		getElement('tarifVente').src = val;
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

		// visu de la stat de depot
		x_return_statByType(tabToString(tabSel),"depot", display_statDepot);
		// visu de la stat de vente
		x_return_statByType(tabToString(tabSel),"vente", display_statVente);
	}

	function display_statDepot(val) {

		infoPlusObj("prixMinidepot", val['objprixMinidepot']);
		infoPlusObj("prixMaxidepot", val['objprixMaxidepot']);

		infoPlusCli("nbVeloMaxiVendeurdepot", val['clinbVeloMaxiVendeurdepot']);
		
		display_formulaire(val, null);
	}

	function display_statVente(val) {

		infoPlusObj("prixMinivente", val['objprixMinivente']);
		infoPlusObj("prixMaxivente", val['objprixMaxivente']);

		infoPlusCli("nbVeloMaxiVendeurvente", val['clinbVeloMaxiVendeurvente']);
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
			obj['plus' + id] = "(" + obj['cli_id'] + ") " + obj['cli_nom'];
			getElement('plus' + id).onclick = function() {
				goTo("client.php", "modif", obj['cli_id']);
			};
		}
	}

	function display_countByTarifSupDepot(val) {
		getElement('count_rangeDepot').innerHTML = val;
	}
	function display_countByTarifSupVente(val) {
		getElement('count_rangeVente').innerHTML = val;
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
    $tabCategLigneDepot = [
        'prixMinidepot' => 'Prix mini depot',
        'prixMaxidepot' => 'Prix maxi depot',
		'prixMoyendepot' => 'Prix moyen depot',
		'nbVeloVendeurdepot' => 'Nombre moyen de velo vendu / vendu',
		'nbVeloMaxiVendeurdepot' => 'Nombre maxi de velo vendu / vendeur',
	];
	$tabCategLigneVente = [
        'prixMinivente' => 'Prix mini vente',
        'prixMaxivente' => 'Prix maxi vente',
		'prixMoyenvente' => 'Prix moyen vente',
		'nbVeloVendeurvente' => 'Nombre moyen de velo vendi /vendeur ',
		'nbVeloMaxiVendeurvente' => 'Nombre maxi de vélo vendu / vendeur',
		'delaiMoyenSV' => 'Delai moyen Stock-Vente',
        'delaiMinSV' => 'Delai mini Stock-Vente',
        'nbVeloAcheteur' => 'Nombre moyen de velo par acheteur',
		'nbVeloMaxiAcheteur' => 'Nombre maxi de velo pour un acheteur'
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
        foreach ($tabCategLigneDepot as $keyL => $valL) {
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
			<td class="tittab">Nombre de velo superieur a 
				<input type=range oninput="getElement('resultRangeDepot').innerHTML=this.value" 
					onchange="x_return_countByTarifSup(this.value,'depot', display_countByTarifSupDepot);" 
					min=0 max=3000 range=50 value=500 list="tickmarksDepot" />
				<datalist id="tickmarksDepot">
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
				<div id="resultRangeDepot">500</div>
			</td>
			<td width='30%' id='count_rangeDepot' style='text-align:center'>--</td>
			<td width='40%'><img id="tarifDepot" /></td>
		</tr>
	</table>
	
	
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
        foreach ($tabCategLigneVente as $keyL => $valL) {
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
			<td class="tittab">Nombre de velo superieur a <input type=range oninput="getElement('resultRangeVente').innerHTML=this.value" 
				onchange="x_return_countByTarifSup(this.value, 'vente', display_countByTarifSupVente);" 
				min=0 max=3000 range=50 value=500 list="tickmarksVente" />
				<datalist id="tickmarksVente">
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
				<div id="resultRangeVente">500</div>
			</td>
			<td width='30%' id='count_rangeVente' style='text-align:center'>--</td>
			<td width='40%'><img id="tarifVente" />
</td>
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
		<div class="col-sm-8 col-xs-12">
			<div id=map></div>
		</div>
	</div>
</fieldset>
<hr />