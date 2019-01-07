
<script>
	function initPage() {
	}

	function unloadPage() {}

	function display_html_file(val) {
		getElement('editor_html_file').innerHTML=val;
		CKEDITOR.replace( 'editor_html_file' );
		getElement('html_file_title').innerHTML="TITRE";
		getElement('edition').style.display='block';
	}

	function unloadPage() {}


	function saveEditor(id,data) {
		x_save_html(id, data, display_fin_save);
		cancelEditor(id);
	}
	function display_fin_save(val) {
		location.reload();
	}
	function cancelEditor(id) {
		getElement('edition').style.display='none';
		CKEDITOR.editor_html_file.destroy();
		CKEDITOR.remove('editor_html_file');
		getElement('editor_html_file').innerHTML="";
	}
</script>
<table width="100%" > 
<?
$tabInfo=['FICHE DEPOT' => "fiche_depot",
'ETIQUETTE' => "etiquette",
	];
	foreach ($tabInfo as $title => $idText) {
?>
	<tr>
		<td class='tittab'><?=$title?></td>
		<td class='tittab'><span class="link url" onclick='x_action_makePDF(new Array(), "<?=$idText?>.html", display_openPDF);' )>
				PDF</span>
		</td>
		<td class='tittab'>
			<i class="fas fa-edit" onclick="x_return_html('<?=$idText?>', display_html_file);"></i>
		</td>
	</tr>
<?}?>
</table>

<div id="edition" style="display:none">
	<hr/>
	<div id="html_file_title" ></div>
<i class="fas fa-save" onclick="saveEditor('<?=$idText?>',CKEDITOR.instances.editor_html_file.getData())"></i>	
<i class="fas fa-times" onclick="cancelEditor('html_file')"></i>

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