<script>
	function initPage() {
		x_return_html('bav_actu', display_bav_actu);
		x_return_html('bav_bourse', display_bav_bourse);
		x_return_html('bav_statistique', display_bav_statistique);
		x_return_html('bav_programme', display_bav_programme);
		x_return_html('bav_vendre', display_bav_vendre);
	//	x_return_html('bav_principe', display_bav_principe);
	}

	function display_bav_bourse(val) {
		<? if ($infAppli['ADMIN']) {?>
		getElement('editor_bav_bourse').innerHTML=val;
		<?}?>
		getElement('bav_bourse').innerHTML=val;
	}
	function display_bav_actu(val) {
		<? if ($infAppli['ADMIN']) {?>
		getElement('editor_bav_actu').innerHTML=val;
		<?}?>
		getElement('bav_actu').innerHTML=val;
	}
	
	function display_bav_statistique(val) {<? if ($infAppli['ADMIN']) {?>
		getElement('editor_bav_statistique').innerHTML=val;<?}?>
		getElement('bav_statistique').innerHTML=val;
	}
	function display_bav_programme(val) {<? if ($infAppli['ADMIN']) {?>
		getElement('editor_bav_programme').innerHTML=val;<?}?>
		getElement('bav_programme').innerHTML=val;
	}
	function display_bav_vendre(val) {<? if ($infAppli['ADMIN']) {?>
		getElement('editor_bav_vendre').innerHTML=val;<?}?>
		getElement('bav_vendre').innerHTML=val;
	}
	function display_bav_principe(val) {<? if ($infAppli['ADMIN']) {?>
		getElement('editor_bav_principe').innerHTML=val;<?}?>
		getElement('bav_principe').innerHTML=val;
	}

	function unloadPage() {}

	function affichEditor(id) {
		getElement(id).style.display='none';
		<? if ($infAppli['ADMIN']) {?>
		getElement(id+"_edit").style.display='none';
		getElement(id+"_save").style.display='inline';
		getElement(id+"_cancel").style.display='inline';
		getElement(id+"_maj").style.display='block';
		<?}?>
	}

	function saveEditor(id,data) {
		x_save_html(id, data, display_fin_save);
		cancelEditor(id);
	}
	function display_fin_save(val) {
		initPage();
	}
	function cancelEditor(id) {
		getElement(id).style.display='block';
		<? if ($infAppli['ADMIN']) {?>
		getElement(id+"_edit").style.display='inline';
		getElement(id+"_save").style.display='none';
		getElement(id+"_cancel").style.display='none';
		getElement(id+"_maj").style.display='none';
		<?}?>
	}
</script>
<?php
	$data = array(
		'date1'=>date('d', $infAppli['date_j1']),
		'date2'=>date('d', $infAppli['date_j2']),
		'date3'=>date('d', $infAppli['date_j3']),
		'mois'=>moisFrench(date('m', $infAppli['date_j2'])),
		'annee'=>date('Y', $infAppli['date_j2']),
		'URL'=>$CFG_URL);
    ?>
    <script>
		var data2PDF = new Object();
		<? foreach ($data as $key => $val) {echo "data2PDF['$key']='$val';\n"; }?>
    </script>
<?
	$tabInfo=['News' => "bav_actu",
			  'LA BOURSE' => "bav_bourse",
			  "QUOI VENDRE ?" => "bav_vendre",
			 // "PRINCIPES" => 'bav_principe',
			  'NOS STATISTIQUES' => "bav_statistique",
		      'PROGRAMME' => "bav_programme"
	];
	foreach ($tabInfo as $title => $idText) {
?>
<div id="tag<?=$idText?>" ></div>
<h3 class="titreFiche">
	<span ><?=$title?><span>
	<? if ($infAppli['ADMIN']) {?>
	<span>
		<i class="fas fa-edit" id="<?=$idText?>_edit" onclick="affichEditor('<?=$idText?>')"></i>
		<i class="fas fa-save" id="<?=$idText?>_save" style='display:none' 
			onclick="saveEditor('<?=$idText?>',getElement('editor_<?=$idText?>').value)"></i>	
		<i class="fas fa-times"id="<?=$idText?>_cancel" style='display:none' 
			onclick="cancelEditor('<?=$idText?>')"></i>	
	</span>	
	<?}?>
</h3>

<div id="<?=$idText?>" ></div>
<? if ($infAppli['ADMIN']) {?>
<div id="<?=$idText?>_maj"  style='display:none'>
<textarea style="width:100%" rows=10 id="editor_<?=$idText?>" ></textarea>
<!--<textarea id="editor_<?=$idText?>" contenteditable="true" ></textarea>-->
<script>
	// Turn off automatic editor creation first.
	//CKEDITOR.replace( 'editor_<?=$idText?>' );
</script>
</div>
<?}?>
<?}?>
