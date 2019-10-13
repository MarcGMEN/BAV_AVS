<script>
	var idText = "";

	function initPage() {
		if (ADMIN) {
					}
		else {
			goTo();
		}
	}

	function unloadPage() {}

	function display_html_file(val) {
		CKEDITOR.replace('editor_html_file');
		CKEDITOR.instances.editor_html_file.setData(val);
		getElement('edition').style.display = 'block';
		getElement('tableHTML').style.display = 'none';
	}

	function unloadPage() {}


	function saveEditor(id, data) {
		console.log(data);
		alertModalInfo(data);
		x_save_html(id, data, display_fin_save);
		//cancelEditor(id);
	}

	function display_fin_save(val) {
		alertModalInfoTimeout("save OK " + val, 1);
		//location.reload();
	}

	function cancelEditor(id) {
		getElement('edition').style.display = 'none';
		CKEDITOR.instances.editor_html_file.destroy();
		getElement('tableHTML').style.display = 'table';

	}

	function imprimeEtiquettes(eti0, eti1) {
		console.log("Impression des etiquettes de " + eti0.value + " a " + eti1.value);
		document.body.style.cursor = 'progress';
		x_action_makeA4Etiquettes(eti0.value, eti1.value, display_openPDF);
	}

	function imprimeFiches(eti0, eti1) {
		console.log("Impression des fiches de " + eti0.value + " a " + eti1.value);
		document.body.style.cursor = 'progress';
		x_action_makeA4Fiches(eti0.value, eti1.value, display_openPDF);
	}
</script>
<h1>Gestion des textes HTML</h1>
<table width="100%" id="tableHTML">
	<tr class="tittab">
		<td width=40%>Fichier</td>
		<td width=60% colspan="2">Actions</td>

	</tr>
	<?
	$tabInfo = [
		'FICHE DEPOT' => "fiche_depot",
		'ETIQUETTE' => "etiquette",
		'CREATE MODAL' => "modal_confirm_create",
		'CONFIRME MODAL' => "modal_confirm_confirme",
		'PAYE MODAL' => "modal_confirm_paye",
		'RENDRE MODAL' => "modal_confirm_rendre",
		'RESTOCK MODAL' => "modal_confirm_restock",
		'MAIL ENREGISTREMENT' => "mel_enregistrement",
		'MAIL CONFIRME' => "mel_confirme",
		'MAIL VENDU' => "mel_vendu"
	];
	foreach ($tabInfo as $title => $idText) {
		?>
		<tr class="tabl0">
			<td><?= $title ?></td>
			<td width=20%><span class="link url" onclick='x_action_makePDF(new Array(), "<?= $idText ?>.html", display_openPDF);' )>
					PDF</span>
				<i class="fas fa-edit" onclick="x_return_html('<?= $idText ?>', display_html_file);idText='<?= $idText ?>';getElement('html_file_title').innerHTML='<?= $title ?>'" ;></i>
			</td>
			<td width=40%>
				<? if ($title == "ETIQUETTE") { ?>
					<form style="color:black">
						Impression de <input type=number name=eti0 value='<?= $FICHE_INFO ?>' style='width:10%' size=5> a <input type=number name=eti1 size=5 style='width:10%'>
						<input type=button value='Imprimer' onclick='imprimeEtiquettes(this.form.eti0,this.form.eti1)'>
					</form>
				<? } ?>
				<? if ($title == "FICHE DEPOT") { ?>
					<form style="color:black">
						Impression de <input type=number name=eti0 value='<?= $FICHE_INFO ?>' style='width:10%' size=5> a <input type=number name=eti1 size=5 style='width:10%'>
						<input type=button value='Imprimer' onclick='imprimeFiches(this.form.eti0,this.form.eti1)'>
					</form>
				<? } ?>
			</td>
		</tr>
	<? } ?>
</table>

<div id="edition" style="display:none">
	<hr />
	<h2 class=fiche>
		<span id="html_file_title"></span>
		<i class="fas fa-save" onclick="saveEditor(idText,CKEDITOR.instances.editor_html_file.getData())"></i>
		<i class="fas fa-times" onclick="cancelEditor('html_file')"></i>
		<i class="far fa-file-pdf" onclick='x_action_makePDF(new Array(), idText+".html", true,display_openPDF);' )></i>
	</h2>
	<textarea style="width:100%" rows=150 id="editor_html_file" contenteditable="true"></textarea>
	<script>
		// Inline styles.
		CKEDITOR.stylesSet.add('style_fic', [{
				name: 'rubrique',
				element: 'div',
				styles: {
					'background': '#c0c0c0',
					'width': '100%',
					'text-align': 'center',
					'font-weight': 'bold',
					'font-size': 'large'
				}
			},
			{
				name: 'border black',
				element: 'td',
				styles: {
					'border': '1px solid black'
				}
			},
			{
				name: 'ecrit span',
				element: 'span',
				styles: {
					'border-bottom': '1px solid blue'
				}
			},
			{
				name: 'ecrit TD',
				element: 'td',
				styles: {
					'border-bottom': '1px solid blue'
				}
			}
		]);
		CKEDITOR.config.stylesSet = 'style_fic';
		CKEDITOR.config.height = '400pt';
	</script>
</div>