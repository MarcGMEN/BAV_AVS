<script>
	function initPage() {
		x_return_html('bav_actu', display_bav_actu);
	}

	function display_bav_actu(val) {
		getElement('bav_actu').innerHTML = val;
		x_makeCarroussel('carroussel', display_carroussel);
		x_makeCarroussel('carroussel1', display_carroussel1);
	}
	function unloadPage() {
	}

	function display_carroussel(val) {
		if (getElement('carroussel')) {
			getElement('carroussel').innerHTML = val;
			showNextImage('carroussel');
		}
	}

	function display_carroussel1(val) {
		if (getElement('carroussel1')) {
			getElement('carroussel1').innerHTML = val;
			showNextImage('carroussel1');
		}
	}
	

	function searchVente(numero) {
		x_add_counter_action("searchVente", ADMIN ? 'ADMIN' : 'VISITEUR', numero, display_rien);
		x_return_oneFicheByCode(numero, display_getFicheVente);
		document.bavFormFiche.inputSearchBAV.value = "";
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
<? if ($infAppli['bav_en_cours'] || $infAppli['ADMIN'] ||  (isset($_COOKIE['CAFFARD_BAV']))) { ?>
	<form name="bavFormFiche" action="#" onsubmit='return searchVente(document.bavFormFiche.inputSearchBAV.value)'>
		<h3>Votre vélo est il vendu ? 
			<input type="text" name="numeroFiche" size="8" maxlength="50" title="Saisisez le numéro de fiche" placeholder="N° fiche" id="inputSearchBAV" onsubmit='searchVente(this.value)' style='background-color:LIGHTGREEN;font-weight: bold;width:200px' autofocus />
			<i class="fas fa-search link loupe" onclick="searchVente(document.bavFormFiche.inputSearchBAV.value)"></i>
		</h3>
	</form>
<? } ?>
	<div id="bav_actu"></div>