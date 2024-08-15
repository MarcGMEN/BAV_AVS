<?php
	$data = array(
		'date1'=>date('d', $infAppli['date_j1']),
		'date2'=>date('d', $infAppli['date_j2']),
		'date3'=>date('d', $infAppli['date_j3']),
		'mois1' => moisFrench(date('m', $infAppli['date_j1'])),
	    'mois2' => moisFrench(date('m', $infAppli['date_j1'])),
    	'mois3' => moisFrench(date('m', $infAppli['date_j3'])),
		'annee'=>date('Y', $infAppli['date_j2']),
		'URL'=>$CFG_URL);
?>
<script>
	function initPage() {
		x_return_html('bav_bourse', display_bav_bourse);
	}

	function display_bav_bourse(val) {

		val =val.replaceAll("--date1--",'<?=$data['date1']?>');
		val =val.replaceAll("--date2--",'<?=$data['date2']?>');
		val =val.replaceAll("--date3--",'<?=$data['date3']?>');
		val =val.replaceAll("--annee--",'<?=$data['annee']?>');
		val =val.replaceAll("--mois1--",'<?=$data['mois1']?>');
		val =val.replaceAll("--mois2--",'<?=$data['mois2']?>');
		val =val.replaceAll("--mois3--",'<?=$data['mois3']?>');

		getElement('bav_bourse').innerHTML = val;

	}

	function unloadPage() { }
</script>



<div class="col-md-12 col-sm-12 col-xs-12" id="bav_bourse">
