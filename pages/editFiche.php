<script>
  var nb_eti_page = '<?=$infAppli['nb_eti_page']?>';
  var nb_coupon_page = '<?=$infAppli['nb_coupon_page']?>';
</script>

<script src="JS/editFiche.js" ></script>
<h1>Gestion des textes HTML</h1>
<table width="100%" id="tableHTML" style="padding:2; spacing:2">
	<tr class="tittab">
		<td width=20%>Fichier</td>
		<td width=80% colspan="2">Actions</td>

	</tr>
	<?
	$tabInfo = [
		'FICHE DEPOT' => "fiche_depot",
		'ETIQUETTE' => "etiquette",
		'COUPON VENDEUR' => "coupon_vendeur",
		'CREATE MODAL' => "modal_confirm_create",
		'CONFIRME MODAL' => "modal_confirm_confirme",
		'PAYE MODAL' => "modal_confirm_paye",
		// 'RENDRE MODAL' => "modal_confirm_rendre",
		// 'RESTOCK MODAL' => "modal_confirm_restock",
		'MAIL ENREGISTREMENT' => "mel_enregistrement",
		'MAIL CONFIRME' => "mel_confirme",
		'MAIL VENDU' => "mel_vendu"
	];
	foreach ($tabInfo as $title => $idText) {
		?>
		<tr class="tabl0" style="border-bottom:1px solid grey">
			<td><?= $title ?></td>
			<td width=10%><span class="link url" onclick='x_action_makePDF(new Array(), "<?= $idText ?>.html", display_openPDF);' )>
					PDF</span>
				<i class="fas fa-edit" onclick="x_return_html('<?= $idText ?>', display_html_file);idText='<?= $idText ?>';getElement('html_file_title').innerHTML='<?= $title ?>'" ;></i>
			</td>
			<td width=70%>
				<? if ($title == "ETIQUETTE") { ?>
					<form style="color:black">
						Impression de <input type=number name=eti0 value='<?= $infAppli['base_info'] ?>' style='width:10%' size=5> a <input type=number name=eti1 size=5 style='width:10%'>
						<input type=button value='Imprimer' onclick='imprimeEtiquettes(this.form.eti0,this.form.eti1)'>
						<br/><b>OU</b><br/> 
						Impression des modifs <span id="nbAImprimer"></span> (<?=$infAppli['nb_eti_page']?>/page) : <span id="nb_fiche_eti"></span> 
							[C:<span id="nb_fiche_new"></span>; M:<span id="nb_fiche_modif"></span>]
						<input type=button value='Imprimer' disabled id="btnImprimeEtiquettesPage" onclick='imprimeEtiquettesPage()'>
					</form>
				<? } ?>
				<? if ($title == "FICHE DEPOT") { ?>
					<form style="color:black">
						Impression de <input type=number name=eti0 value='<?= $infAppli['base_info'] ?>' style='width:10%' size=5> a <input type=number name=eti1 size=5 style='width:10%'>
						<input type=button value='Imprimer' onclick='imprimeFiches(this.form.eti0,this.form.eti1)'>
						
					</form>
				<? } ?>
				<? if ($title == "COUPON VENDEUR") { ?>
					<form style="color:black">
						Impression de <input type=number name=eti0 value='<?= $infAppli['base_info'] ?>' style='width:10%' size=5> a <input type=number name=eti1 size=5 style='width:10%'>
						<input type=button value='Imprimer' onclick='imprimeFiches(this.form.eti0,this.form.eti1)'>
						<br/><b>OU</b><br/> 
						Impression des modifs <span id="nbCouponAImprimer"></span> (<?=$infAppli['nb_coupon_page']?>/page) : <span id="nb_fiche_coupon"></span> 
							[C:<span id="nb_fiche_new_coupon"></span>; M:<span id="nb_fiche_modif_coupon"></span>]
						<input type=button value='Imprimer' disabled id="btnImprimeCouponsPage" onclick='imprimeCouponsPage()'>
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