<script>
	function initPage() {
		x_return_html('bav_actu', display_bav_actu);
		x_return_html('bav_bourse', display_bav_bourse);
		x_return_html('bav_statistique', display_bav_statistique);
		x_return_html('bav_programme', display_bav_programme);
		x_return_html('bav_vendre', display_bav_vendre);
		x_return_html('bav_orga', display_bav_orga);
		//	x_return_html('bav_principe', display_bav_principe);
	}

	function display_bav_bourse(val) {

		getElement('bav_bourse').innerHTML = val;
	}

	function display_bav_actu(val) {

		getElement('bav_actu').innerHTML = val;
	}

	function display_bav_statistique(val) {
		getElement('bav_statistique').innerHTML = val;
	}

	function display_bav_programme(val) {
		getElement('bav_programme').innerHTML = val;
	}

	function display_bav_vendre(val) {
		getElement('bav_vendre').innerHTML = val;
	}

	function display_bav_principe(val) {
		getElement('bav_principe').innerHTML = val;
	}

	function display_bav_orga(val) {
		getElement('bav_orga').innerHTML = val;
	}

	function unloadPage() {}


	function searchVente(numero) {
		x_add_counter_action("searchVente", ADMIN ? 'ADMIN' : 'VISITEUR', numero, display_rien);
		x_return_oneFicheByCode(numero, display_getFicheVente);
		document.bavFormFiche.inputSearch.value = "";
		return false;
	}
</script>
<?php
$data = array(
	'date1' => date('d', $infAppli['date_j1']),
	'date2' => date('d', $infAppli['date_j2']),
	'date3' => date('d', $infAppli['date_j3']),
	'mois' => moisFrench(date('m', $infAppli['date_j2'])),
	'annee' => date('Y', $infAppli['date_j2']),
	'URL' => $CFG_URL
);
?>
<script>
	var data2PDF = new Object();
	<? foreach ($data as $key => $val) {
		echo "data2PDF['$key']='$val';\n";
	} ?>
</script>
<?
$tabInfo = [
	'Quoi de neuf ?' => "bav_actu",
	'La Bourse' => "bav_bourse",
	"Quoi vendre ?" => "bav_vendre",
	// "PRINCIPES" => 'bav_principe',
	'Les stats' => "bav_statistique",
	'Programme' => "bav_programme",
	'Organisateur' => "bav_orga"
]; ?>

<!-- <table style="width: 100%;" border=1><tr> -->
<div class="row">
	<? foreach ($tabInfo as $title => $idText) { ?>
		<div class="col-sm-2 col-xs-12 titreFiche link" width="<?= (int)(100 / sizeof($tabInfo)) ?>%">
			<A HREF="#tag<?= $idText ?>"><?= $title ?></A>
		</div>
	<? } ?>
</div>
<!-- </tr></table> -->
<br />

<? if ($infAppli['bav_en_cours'] || $infAppli['ADMIN']) { ?>
	<form name="bavFormFiche" action="#" onsubmit='return searchVente(document.bavFormFiche.inputSearchBAV.value)'>
		<h3>Votre vélo est il vendu ? </h3>
		<h2>
			<input type="text" name="numeroFiche" size="8" maxlength="50" title="Saisisez le numéro de fiche" placeholder="N° fiche" id="inputSearchBAV" onsubmit='searchVente(this.value)' style='background-color:LIGHTGREEN;font-weight: bold' autofocus />
			<i class="fas fa-search link loupe" onclick="searchVente(document.bavFormFiche.inputSearchBAV.value)"></i>
		</h2>
	</form>
<? } ?>

<?foreach ($tabInfo as $title => $idText) {?>
	<div id="tag<?= $idText ?>"></div>
	<h3 class="titreFiche">
		<span><?= $title ?><span>
				<A HREF="#"><i class="fas fa-level-up-alt"></i></A>
	</h3>

	<div id="<?= $idText ?>"></div>
<? } ?>