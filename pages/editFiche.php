<?php
    $data = array(
		'URL'=>$CFG_URL);
		$message = makeCorps($data, "fiche_depot.html");
?>
<script>
	function initPage() {
		x_return_html('fiche_depot', display_fiche_depot);
	}

	function unloadPage() {}


	var data2PDF = "";
	data2PDF =
		"<? foreach ($data as $key => $val) {echo $key."#3D".$val."#2C";}?>";

	function display_fiche_depot(val) {
		<? if ($infAppli['ADMIN']) {?>
			getElement('editor_fiche_depot').innerHTML=val;
			CKEDITOR.replace( 'editor_fiche_depot' );
		<?}?>
		//getElement('fiche_depot').innerHTML=val;
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
		location.reload();
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
<span class="link url" onclick='x_action_makePDF(new Array(), display_openPDF);' )>
	telecharger le fiche_depot</span>
	<? if ($infAppli['ADMIN']) {?>
	<span>
		<i class="fas fa-edit" id="fiche_depot_edit" onclick="affichEditor('fiche_depot')"></i>
		<i class="fas fa-save" id="fiche_depot_save" style='display:none' 
			onclick="saveEditor('fiche_depot',CKEDITOR.instances.editor_fiche_depot.getData())"></i>	
		<i class="fas fa-times"id="fiche_depot_cancel" style='display:none' onclick="cancelEditor('fiche_depot')"></i>	
	</span>	
	<?}?>

<div id="fiche_depot" ><?=$message?></div>
<? if ($infAppli['ADMIN']) {?>
<div id="fiche_depot_maj"  style='display:none'>
	<textarea style="width:100%" rows=150 id="editor_fiche_depot" contenteditable="true"></textarea>
</div>
<script>
	// Inline styles.
	CKEDITOR.stylesSet.add( 'style_fic', [
    { name: 'rubrique', element: 'div', styles: {
			'background': '#c0c0c0',
			'width': '100%',
			'text-align': 'center',
			'font-weight': 'bold',
			'font-size': 'large'} 
	},
	{ name: 'border black', element: 'td', styles: {
		'border': '1px solid black'}
	},
	{ name: 'ecrit span', element: 'span', styles: {
		'border-bottom': '1px solid blue'}
	},
	{ name: 'ecrit TD', element: 'td', styles: {
		'border-bottom': '1px solid blue' }
	}
	]);
	CKEDITOR.config.stylesSet='style_fic';
	CKEDITOR.config.height = '400pt';
</script>
<?}?>