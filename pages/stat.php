

<script>
	// var idRamdom = "<?= $idRamdom ?>";
	// var theId = '<?= $_GET['id'] ?>';
	// var maxFiche = "<?= $maxFiche ?>";
	var anneeBav = '<?= $infAppli['numero_bav'] ?>';
	var date1 = new Date('<?= $infAppli['par_date_debut_depot_FR'] ?>');
	var date2 = '<?= $infAppli['date_j2'] ?>';
	var date3 = '<?= $infAppli['date_j3'] ?>';
	var anneeBavActive = '<?= $infAppli['numero_bav_active'] ?>';
</script>
<script src="JS/stat.js" type="text/javascript"></script>

<style type="text/css">
	#map {
		/* la carte DOIT avoir une hauteur sinon elle n'apparaît pas */
		height: 400px;
	}
</style>

<? // echo "_COOKIE['par_numero_bav_stat'] = ".$_COOKIE['par_numero_bav_stat']
?>
<? //echo "infoAppli['numero_bav'] = ".$infAppli['numero_bav']
?>

<h3 class="titreFiche">Stat de la BAV <?= $infAppli['numero_bav'] ?></h3>
<select id="annee_stat" onchange="changeNumeroBAV(this.value)"></select>

<!-- <canvas id="canvasSuivi0" height="200">Votre navigateur est trop vieux</canvas> -->
<div>
	<div class="row">
		<div class="col-sm-9 col-xs-9">
			Choix de la BAV a comparer par rapport à <?= $infAppli['numero_bav'] ?> :
			<span id='annee_statSuvi'></span>
		</div>
		<div class="col-sm-3 col-xs-3" style='text-align:right'>
			<input type=checkbox onchange='cumul=cumul == 1 ? 0 : 1;x_return_nbFichesByDay(anneeBav, display_statByAnneeRef);'> No cumul</input>
		</div>
	</div>
	<canvas id="canvasSuivi1" height="200" style='width:100%;max-width: 100%' ;>Votre navigateur est trop vieux</canvas>
</div>

<fieldset class=fiche>
	<legend class=titreFiche>Stat diverses</legend>
	<table width="100%">
		<tr>
			<td class="tittab" width=33%>
				<span>Type</span>
				&nbsp;<select id="sel_obj_type" onchange="selectColonne()"></select>
			</td>
			<td class="tittab" width=33%>
				<span>Public</span>
				&nbsp;<select id="sel_obj_public" onchange="selectColonne()"></select>
			</td>
			<td class="tittab" width=33%>
				<span>Pratique</span>
				&nbsp;<select id="sel_obj_pratique" onchange="selectColonne()"></select>
			</td>
		</tr>
	</table>
	<?php
	$tabCategLigneDepot = [
		'prixMinidepot' => 'Prix mini depot',
		'prixMaxidepot' => 'Prix maxi depot',
		'prixMoyendepot' => 'Prix moyen depot',
		'nbVeloVendeurdepot' => 'Nombre moyen de velo depose / vendeur',
		'nbVeloMaxiVendeurdepot' => 'Nombre maxi de velo depose / vendeur',
	];
	$tabCategLigneVente = [
		'prixMinivente' => 'Prix mini vente',
		'prixMaxivente' => 'Prix maxi vente',
		'prixMoyenvente' => 'Prix moyen vente',
		'nbVeloVendeurvente' => 'Nombre moyen de velo vendu /vendeur ',
		'nbVeloMaxiVendeurvente' => 'Nombre maxi de vélo vendu / vendeur',
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
		'' => '__',
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
				<span id='count_depot'>()</span>&nbsp;
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
	<hr />
	<table width="100%">
		<tr class='tabl1'>
			<td class="tittab">Nombre de vélos superieur à
				<input type=range oninput="getElement('resultRangeDepot').innerHTML=this.value" onchange="x_return_countByTarifSup(tabToString(tabSel),this.value,'depot', display_countByTarifSupDepot);" min=0 max=3500 range=50 value=500 list="tickmarksDepot" />
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
				<span id='count_vente'>()</span>&nbsp;
				<span id='pourcent'>..</span>

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
	<hr />
	<table width="100%">
		<tr class='tabl1'>
			<td class="tittab">Nombre de velo superieur a <input type=range oninput="getElement('resultRangeVente').innerHTML=this.value" onchange="x_return_countByTarifSup(tabToString(tabSel),this.value, 'vente', display_countByTarifSupVente);" min=0 max=3500 range=50 value=500 list="tickmarksVente" />
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
				<div class="col-sm-4 col-xs-4" id='<?= $keyL; ?>' style='text-align:center'>__</div>
			</div>
		<?php
		} ?>
	</div>
</fieldset>
<br />
<fieldset class=fiche>
	<legend class=titreFiche>Repartition</legend>
	<div class="row">
		<div class="col-sm-12 col-xs-12">
			<input type='radio' name='choixMap' onclick='x_return_statClient("tous",display_statClient);' checked>Tous</input>
			<input type='radio' name='choixMap' onclick='x_return_statClient("vendeur",display_statClient);'>Vendeur</input>
			<input type='radio' name='choixMap' onclick='x_return_statClient("acheteur",display_statClient);'>Acheteur</input>
		</div>
		<div class="col-sm-8 col-xs-12">
			<div id=map></div>
			<h3 class=tittab>Distances</h3>
			<div id=km30></div>
		</div>
		<div class="col-sm-4 col-xs-12">
			<h3 class=tittab>Communes</h3>
			<div id=tabCodePostal></div>
		</div>
	</div>
</fieldset>