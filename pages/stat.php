

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
	<?php
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
		<tr >
			<th class="tittab" width='20%'></th>
			<th class="tittab" width='40%'>Dépôt</th>
			<th class="tittab" width='40%'>Vente</th>
		</tr>
		<tr class='tabl1'>
			<td class="titrow">Prix maxi</td>
			<td style='text-align:center'>
				<div id="prixMaxidepot" >prixMaxidepot</div>
				<small><div class="link" id='plusprixMaxidepot' style='text-align:center'>qui</div></small>
			</td>
			<td  style='text-align:center'>
				<div id="prixMaxivente" >prixMaxivente</div>
				<small><div class="link" id='plusprixMaxivente' style='text-align:center'>qui</div></small>
			</td>
		</tr>
		<tr class='tabl1'>
			<td class="titrow">Prix moyen</td>
			<td id='prixMoyendepot' style='text-align:center'>prixMoyendepot
				<div class="link" id='plusprixMoyendepot' style='text-align:center'></div>
			</td>
			<td id='prixMoyenvente' style='text-align:center'>prixMoyenvente
				<div class="link" id='plusprixMoyenvente' style='text-align:center'></div>
			</td>
		</tr>
		<tr class='tabl1'>
			<td class="titrow">Prix médian</td>
			<td id='prixMediandepot' style='text-align:center'>prixMediandepot
				<div class="link" id='plusprixMoyendepot' style='text-align:center'></div>
			</td>
			<td id='prixMedianvente' style='text-align:center'>prixMedianvente
				<div class="link" id='plusprixMedianvente' style='text-align:center'></div>
			</td>
		</tr>
		<tr class='tabl1'>
			<td class="titrow">Nombre de vélos à
				<input type=range 
					oninput="getElement('resultRange').innerHTML=this.value" 
					onchange="x_return_countByTarifSup(tabToString(tabSel),this.value,'depot', display_countByTarifSupDepot);
					x_return_countByTarifSup(tabToString(tabSel),this.value, 'vente', display_countByTarifSupVente);" 
					min=0 max=3000 range=50 value=500 list="tickmarks" />
				<datalist id="tickmarks">
					<option value="0">
					<option value="50">
					<option value="100">
					<option value="150">
					<option value="200">
					<option value="250">
					<option value="300">
					<option value="400">
					<option value="500">
					<option value="750">
					<option value="1000">
					<option value="1500">
					<option value="2000">
					<option value="2500">
				</datalist>
				<div> <span id="resultRange">500</span> &euro;</div>
			</td>
			<td  style='text-align:center'>
				<span id="count_rangeDepotMoins"></span>			
				<span >-</span>			
				<span id="count_rangeDepotPlus"></span>			
			</td>
			<td  style='text-align:center'>
				<span id="count_rangeVenteMoins"></span>			
				<span >-</span>			
				<span id="count_rangeVentePlus"></span>			
			</td>
		</tr>
		<tr>
			<td class="titrow">Répartition par prix</td>
			<td style='text-align: center'><img id="tarifDepot" /></td>
			<td style='text-align: center' ><img id="tarifVente" /></td>
		</tr>
		<tr>
			<td class="titrow">Répartition par type</td>
			<td colspan=2 style='text-align: center'><img id="typeVente" /></td>
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