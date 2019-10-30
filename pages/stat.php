<script>
	var tri = "obj_numero";
	var sens = "asc";
	var tabSel = {};

	function initPage() {
		if (ADMIN || TABLE) {
			x_return_enum('bav_objet', 'obj_type', display_list_type);
			x_return_enum('bav_objet', 'obj_public', display_list_public);
			x_return_enum('bav_objet', 'obj_pratique', display_list_pratique);

			x_return_stat(tabToString(tabSel), display_stat)
			x_return_graphCount('type', display_countType);
			//x_return_graphCount('pratique', display_countPratique);
			x_return_graphCount('public', display_countPublic);
			x_return_histoCount('marque', 1000, 250, 1,display_countMarque);
			x_return_histoCount('tarif', 500, 250, display_countTarif);

			x_return_graphCount('code_postal', 'client', display_countCDP);
		} else {
			goTo();
		}
	}
	function display_countCDP(val) {
		console.log(val);
		getElement('code_postal').src = val;
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
		if (TABLE || ADMIN) {} else {
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

		infoPlusObj("prixMini", val['objprixMini']);
		infoPlusObj("prixMaxi", val['objprixMaxi']);
		infoPlusObj("delaiMinSV", val['objdelaiMinSV']);
		infoPlusCli("nbVeloMaxiVendeur", val['clinbVeloMaxiVendeur']);
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
</script>
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
        'total',
    ];

    $tabCount = [
        'depot_J30' => 'Depot < 15',
        'depot_J15' => 'Depot 15 < 0',
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
<br/>
<fieldset class=fiche>
	<legend class=titreFiche>Repartition</legend>
	<div class="row">
		<?php foreach (['type', 'public', 'code_postal'] as $valL) {
            ?>
			<div class="col-sm-4 col-xs-12">
				<img id="<?= $valL; ?>" />
			</div>
		<?php
        } ?>
		<div class="col-sm-12 col-xs-12">
			<center><img id="marque" /></center>
		</div>
		<div class="col-sm-12 col-xs-12">
			<center><img id="tarif" /></center>
		</div>
		</div>
</fieldset>
<hr />
