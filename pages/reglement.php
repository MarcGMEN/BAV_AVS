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
<? if ($infAppli['ADMIN']) {?>
<div>
Admin
<div id="editor1" contenteditable="true">
<?=file_get_contents('html/reglement.html')?>
</div>
<script>
CKEDITOR.replace( 'editor1' );
</script>
</div>
<?}?>


<span class="link url" onclick='x_action_makePDFFromHtml(data,"reglement.html", display_openPDF);' )>
	telecharger le reglement</span>
<hr />

<?=$message?>
