<script>
	function initPage() {
		x_return_html('bav_bourse', display_bav_bourse);
		x_return_html('bav_statistique', display_bav_statistique);
		x_return_html('bav_programme', display_bav_programme);
		x_return_html('bav_vendre', display_bav_vendre);
		x_return_html('bav_principe', display_bav_principe);
	}

	function display_bav_bourse(val) {
		<? if ($infAppli['ADMIN']) {?>
		getElement('editor_bav_bourse').innerHTML=val;
		<?}?>
		getElement('bav_bourse').innerHTML=val;
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
        $data = array('date1'=>8, 'date2'=>9, 'date3'=>10, 'mois'=>'novembre', 'annee'=>2019,'URL'=>$CFG_URL);
        $message = makeCorps($data, "reglement.html");
    ?>
    <script>
        var data = "";
        data ="<? foreach ($data as $key => $val) {echo $key."#3D".$val."#2C";}?>";
    </script>
<?
	$tabInfo=['LA BOURSE' => "bav_bourse",
			 'NOS STATISTIQUES]' => "bav_statistique",
			 "QUOI VENDRE ?" => "bav_vendre",
			'PROGRAMME' => "bav_programme",
			"PRINCIPES" => 'bav_principe'
	];
	foreach ($tabInfo as $title => $idText) {
?>
<h3 class="titreFiche">
	<span ><?=$title?><span>
	<? if ($infAppli['ADMIN']) {?>
	<span>
		<i class="fas fa-edit" id="<?=$idText?>_edit" onclick="affichEditor('<?=$idText?>')"></i>
		<i class="fas fa-save" id="<?=$idText?>_save" style='display:none' onclick="saveEditor('<?=$idText?>',getElement('editor_<?=$idText?>').value)"></i>	
		<i class="fas fa-times"id="<?=$idText?>_cancel" style='display:none' onclick="cancelEditor('<?=$idText?>')"></i>	
	</span>	
	<?}?>
</h3>

<div id="<?=$idText?>" ></div>
<? if ($infAppli['ADMIN']) {?>
<div id="<?=$idText?>_maj"  style='display:none'>
<textarea style="width:100%" rows=10 id="editor_<?=$idText?>" contenteditable="true" ></textarea>
<!-- <script>
	// Turn off automatic editor creation first.
	CKEDITOR.replace( 'editor_<?=$idText?>' );
</script> -->
</div>
<?}?>
<?}?>
