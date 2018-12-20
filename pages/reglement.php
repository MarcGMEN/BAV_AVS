<?php
echo "CFG_URL $CFG_URL";
	$data = array('date1'=>8, 'date2'=>9, 'date3'=>10, 'mois'=>'novembre', 'annee'=>2019,'URL'=>$CFG_URL);
	$message = makeCorps($data, "reglement.html");
?>
<script>
	function initPage() {}

	function unloadPage() {}
	var data = "";
	data =
		"<? foreach ($data as $key => $val) {echo $key."#3D".$val."#2C";}?>";
</script>

<span class="link navigation" onclick='x_action_makePDFFromHtml(data,"reglement.html", display_openPDF);' )>
	telecharger le reglement</span>
<hr />
<?=$message?>
