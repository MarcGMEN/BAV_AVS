
<script>
	var idText="";
	function initPage() {
	}

	function unloadPage() {}

	function display_html_file(val) {
        CKEDITOR.replace( 'editor_html_file' );
		CKEDITOR.instances.editor_html_file.setData(val);
		getElement('edition').style.display='block';
		getElement('tableHTML').style.display='none';
	}

	function unloadPage() {}


	function saveEditor(id,data) {
        console.log(data);
		alertModalInfo(data);
		x_save_html(id, data, display_fin_save);
		//cancelEditor(id);
	}
	function display_fin_save(val) {
        alertModalInfoTimeout("save OK "+val,1);
		//location.reload();
	}
	function cancelEditor(id) {
		getElement('edition').style.display='none';
		CKEDITOR.instances.editor_html_file.destroy();
		getElement('tableHTML').style.display='table';
		
	}
</script>
<h1>Gestion des textes HTML</h1>
<table width="100%" id="tableHTML"> 
	<tr class="tittab">
		<td >Fichier</td>
		<td >Actions</td>
	</tr>
<?
$tabInfo=[	'FICHE DEPOT' => "fiche_depot",
			'ETIQUETTE' => "etiquette",
			'CREATE MODAL' => "modal_confirm_create",
			'CONFIRME MODAL' => "modal_confirm_confirme",
			'PAYE MODAL' => "modal_confirm_paye",
			'RENDRE MODAL' => "modal_confirm_rendre",
			'MAIL ENREGISTREMENT' => "mel_enregistrement",
			'MAIL CONFIRME' => "mel_confirme"
	];
	foreach ($tabInfo as $title => $idText) {
?>
	<tr class="tabl0">
		<td ><?=$title?></td>
		<td ><span class="link url" onclick='x_action_makePDF(new Array(), "<?=$idText?>.html", display_openPDF);' )>
				PDF</span>
			<i class="fas fa-edit" 
				onclick="x_return_html('<?=$idText?>', display_html_file);idText='<?=$idText?>';getElement('html_file_title').innerHTML='<?=$title?>'";></i>
		</td>
	</tr>
<?}?>
</table>

<div id="edition" style="display:none">
	<hr/>
	<h2 class=fiche> 
		<span id="html_file_title" ></span>
		<i class="fas fa-save" onclick="saveEditor(idText,CKEDITOR.instances.editor_html_file.getData())"></i>	
		<i class="fas fa-times" onclick="cancelEditor('html_file')"></i>
	</h2>
<textarea style="width:100%" rows=150 id="editor_html_file" contenteditable="true"></textarea>
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
</div>