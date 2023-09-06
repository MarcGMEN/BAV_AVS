<?php
if ($GET_modePage == "") {
	$GET_modePage="B";
}
    $data = array(
		'date1'=>date('d', $infAppli['date_j1']),
		'date2'=>date('d', $infAppli['date_j2']),
		'date3'=>date('d', $infAppli['date_j3']),
		'mois'=>moisFrench(date('m', $infAppli['date_j2'])),
		'annee'=>date('Y', $infAppli['date_j2']),
		'URL'=>$CFG_URL,
		'TITRE' => $infAppli['titre']
	);
	$message = makeCorps($data, "reglement".$GET_modePage.".html");
?>
<script>
	var data2PDF = new Object();
	function initPage() {
		x_return_html('reglement<?=$GET_modePage?>', display_reglement);
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


<table class="BH_CADRE" style="border-spacing:15; padding:15">
	<tr>
        <td class="titreFiche link navigation <?=$GET_modePage == "B" ? "navigationSel" : '';?>" onclick="goTo('reglements.php', 'B', null, null)">Réglement de la bourse aux vélos</td>
		<td class="titreFiche link navigation <?=$GET_modePage == "T" ? "navigationSel" : '';?>" onclick="goTo('reglements.php', 'T', null, null)">Réglement de la tombola</td>
	</tr>
</table>
<hr/>

<span class="link url" onclick='loadReglement("reglements.php","<?=$GET_modePage?>")' >
	T&eacute;l&eacute;charger le r&egrave;glement</span>
	<? if ($infAppli['ADMIN']) {?>
	<span>
		<i class="fas fa-edit" id="reglement_edit" onclick="affichEditor('reglement')"></i>
		<i class="fas fa-save" id="reglement_save" style='display:none' 
			onclick="saveEditor('reglement<?=$GET_modePage?>',CKEDITOR.instances.editor_reglement.getData())"></i>	
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

