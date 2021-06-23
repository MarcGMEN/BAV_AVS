<?php
    $data = array(
		'date1'=>date('d', $infAppli['date_j1']),
		'date2'=>date('d', $infAppli['date_j2']),
		'date3'=>date('d', $infAppli['date_j3']),
		'mois'=>moisFrench(date('m', $infAppli['date_j2'])),
		'annee'=>date('Y', $infAppli['date_j2']),
		'URL'=>$CFG_URL);
	$message = makeCorps($data, "reglement.html");
?>
<script>
	var data2PDF = new Object();
	function initPage() {
		x_return_html('reglement', display_reglement);
		<? foreach ($data as $key => $val) {echo "data2PDF['$key']='$val';\n"; }?>
	}

	function unloadPage() {}
	
	function display_reglement(val) {
		if (ADMIN) {
			getElement('editor_reglement').innerHTML=val;
			CKEDITOR.replace( 'editor_reglement' );
		}
		//getElement('reglement').innerHTML=val;
	}

	function unloadPage() {}

	function affichEditor(id) {
		getElement(id).style.display='none';
		if (ADMIN) {
			getElement(id+"_edit").style.display='none';
			getElement(id+"_save").style.display='inline';
			getElement(id+"_cancel").style.display='inline';
			getElement(id+"_maj").style.display='block';
		}
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
<span class="link url" onclick='x_action_makePDFFromHtml(tabToString(data2PDF),"reglement.html", display_openPDF);' >
	telecharger le reglement</span>
	<? if ($infAppli['ADMIN']) {?>
	<span>
		<i class="fas fa-edit" id="reglement_edit" onclick="affichEditor('reglement')"></i>
		<i class="fas fa-save" id="reglement_save" style='display:none' 
			onclick="saveEditor('reglement',CKEDITOR.instances.editor_reglement.getData())"></i>	
		<i class="fas fa-times"id="reglement_cancel" style='display:none' onclick="cancelEditor('reglement')"></i>	
	</span>	
	<?}?>

<div id="reglement" ><?=$message?></div>
<? if ($infAppli['ADMIN']) { ?>
<div id="reglement_maj"  style='display:none'>
	<textarea style="width:100%" rows=150 id="editor_reglement" contenteditable="true"></textarea>
</div>
<script>
	CKEDITOR.stylesSet.add( 'style_reg', [
    // Inline styles.
    { name: 'dt p', element: 'p', styles: { 'font-size': 'medium',
        'color': 'black',
        'font-weight': 'bold',
        'margin-top': '5px',
        'margin-bottom': '5px'} },
	{ name: 'dd div', element: 'div', styles: {  'margin-left': '20px',
		'margin-right': '20px',
        'margin-top': '2px',
        'margin-bottom': '2px' } }
]);
	CKEDITOR.config.stylesSet='style_reg';
	CKEDITOR.config.height = 300;

</script>
<?}?>