<script>
	var nb_eti_page = '<?= $infAppli['nb_eti_page'] ?>';
	var nb_coupon_page = '<?= $infAppli['nb_coupon_page'] ?>';
</script>

<script src="JS/editFiche.js"></script>
<?
$tabInfo = [
	'FICHE DEPOT' => "fiche_depot",
	'ETIQUETTE' => "etiquette",
	'COUPON VENDEUR' => "coupon_vendeur",
	'COUPON ACHETEUR' => "coupon_acheteur",
	'' => "",
	'CREATE MODAL' => "modal_confirm_create",
	'CONFIRME MODAL' => "modal_confirm_confirme",
	'PAYE MODAL' => "modal_confirm_paye",
	// 'RENDRE MODAL' => "modal_confirm_rendre",
	// 'RESTOCK MODAL' => "modal_confirm_restock",
	'MAIL ENREGISTREMENT' => "mel_enregistrement",
	'MAIL CONFIRME' => "mel_confirme",
	'MAIL MODIF' => "mel_modif",
	'MAIL VENDU' => "mel_vendu"
];
?>
<h1>Gestion des éditions</h1>
<table width="100%" id="tableHTML" style="padding:2 2 2 2 ;">
	<tr class="tittab">
		<td width=20%>Fichier</td>
		<td width=80% colspan="2">Actions</td>

	</tr>
	<? foreach ($tabInfo as $title => $idText) {
		$format = "P";
		if ($title == "COUPON VENDEUR" || $title == "COUPON ACHETEUR") {
			$format = "L";
		} ?>
		<tr class="tabl0" style="border-bottom:1px solid grey">
			<td><?= $title ?></td>

			<td width=10%>
				<? if ($idText != "") { ?>
					<span class="link url" onclick='viewPdf("<?= $idText ?>","<?= $format ?>");' title="Génération du PDF")>PDF</span>
					<?= $format ?>&nbsp;
					<i class="fas fa-edit" onclick="x_return_html('<?= $idText ?>', display_html_file);idText='<?= $idText ?>';getElement('html_file_title').innerHTML='<?= $title ?>'" title="Modification du document"></i>
				<? } else { ?>
					<div style="background-color: lightblue;">&nbsp;</div>
				<? } ?>
			</td>
			<td width=70%>
				<? if ($title == "ETIQUETTE") { ?>
					<form style="color:black">
						<table width=100% border=0>
							<tr >
								<td rowspan=5 width=15%><i>Test <input type='checkbox' name="testEtiq" checked></i></td>
								<td colspan=2></td>
								<td rowspan=5 width=20%>Param PDF: <br/><?= $infAppli['nb_eti_page'] ?>/page</td>
							</tr>
							<tr class="tabAction">
								<td width=50%>
									- De <input type=number min='<?= $infAppli['base_info'] ?>' name=eti0 value='<?= $infAppli['base_info'] ?>' style='width:10%' size=5> 
									a <input type=number name=eti1 size=5 style='width:10%' min='<?= $infAppli['base_info'] ?>'>
								</td>
								<td width=15%>
									<input type=button value='Imprimer' onclick='imprimeEtiquettes(this.form.eti0.value,this.form.eti1.value,this.form.testEtiq.checked?1:0)'>
								</td>
							</tr>
							<tr class="tabAction">
								<td >
									- Numérotés 1 -> <?= $infAppli['base_info']-1 ?>
								</td>
								<td >
									<input type=button value='Imprimer' onclick='imprimeEtiquettes(1,<?= $infAppli["base_info"]-1 ?>)'>
								</td>
							</tr>
							<tr class="tabAction">
							<td >
									- 1 page de vierge
								</td>
								<td >
									<input type=button value='Imprimer' onclick='imprimeEtiquettes(-1,-1)'>
								</td>
							</tr>
							<tr class="tabAction">
								<td> - Modifs <span id="nbAImprimer"></span> (<?= $infAppli['nb_eti_page'] ?>/page) : <span id="nb_fiche_eti"></span>
									[C: <b><span id="nb_fiche_new"></span></b>; M:<b><span id="nb_fiche_modif"></span></b>]
								</td>
								<td>
									<input type=button name='printEtiquette' value='Imprimer' disabled id="btnImprimeEtiquettesPage" 
										onclick='imprimeEtiquettesPage(this.form.forceEtiquette.checked,this.form.testEtiq.checked?1:0)'>
									<input type='checkbox' id="forceEtiquette" onchange="this.checked?this.form.printEtiquette.disabled=false:this.form.printEtiquette.disabled=true">Force
								</td>
							</tr>
						</table>
					</form>
				<? } ?>
				<? if ($title == "FICHE DEPOT") { ?>
					<form style="color:black">
						<table width=100% border=0>
							<tr>
								<td rowspan=3 width=15%>&nbsp;</td>
								<td colspan=2></td>
								<td rowspan=3 width=20%>Param PDF: <br/>marge HB: 10pt, GD:10pt<br/>Zoom 79%</td>
							</tr>
							<tr class="tabAction">
								<td width=50%>
									- De <input type=number  min='<?= $infAppli['base_info'] ?>' name=eti0 value='<?= $infAppli['base_info'] ?>' style='width:10%' size=5> 
									a <input type=number name=eti1 size=5 style='width:10%' min='<?= $infAppli['base_info'] ?>'>
								</td>
								<td width=15%>
									<input type=button value='Imprimer' onclick='imprimeFiches(this.form.eti0.value,this.form.eti1.value)'>
								</td>
							</tr>
							<tr class="tabAction">
							<td >
									- Vierge
								</td>
								<td >
									<input type=button value='Imprimer' onclick='imprimeFiche()' />
								</td>
							</tr>
						</table>
					</form>
				<? } ?>
				<? if ($title == "COUPON VENDEUR") {?>
					<form style="color:black">
						<table width=100% border=0>
							<tr>
								<td rowspan=5 width=15%><i>Test <input type='checkbox' name="testCoupon" checked /></i></td>
								<td colspan=2></td>
								<td rowspan=5 width=20%>Param PDF (Paysage): <br/> <?= $infAppli['nb_coupon_page'] ?>/page</td>
							</tr>
							<tr class="tabAction">
								<td width=50%>- De <input type=number min='<?= $infAppli['base_info'] ?>' name=eti0 value='<?= $infAppli['base_info'] ?>' style='width:10%' size=5>
									à <input type=number name=eti1 size=5 style='width:10%' min='<?= $infAppli['base_info'] ?>'>
								</td>
								<td width=15%>
									<input type=button value='Imprimer' onclick='imprimeCoupons(this.form.eti0.value,this.form.eti1.value,this.form.testCoupon.checked?1:0,"coupon_vendeur")'>
								</td>
								
							</tr>
							<tr class="tabAction">
							<td >
									- Numérotés 1 -> <?= $infAppli['base_info']-1 ?>
								</td>
								<td >
									<input type=button value='Imprimer' onclick='imprimeCoupons(1,<?= $infAppli["base_info"]-1 ?>,0,"coupon_vendeur")'>
								</td>
							</tr>
							<tr class="tabAction">
							<td >
									- 1 page de vierge
								</td>
								<td >
									<input type=button value='Imprimer' onclick='imprimeCoupons(-1,-1,0,"coupon_vendeur")'>
								</td>
							</tr>
							<tr class="tabAction">
								<td>
									- Modifs <span id="nbCouponAImprimer"></span> (<?= $infAppli['nb_coupon_page'] ?>/page) : <span id="nb_fiche_coupon"></span>
									[C: <b><span id="nb_fiche_new_coupon"></span></b>; M:<b><span id="nb_fiche_modif_coupon"></span></b>]</td>
								<td>
									<input type=button name='printCoupon' value='Imprimer' disabled id="btnImprimeCouponsPage" onclick='imprimeCouponsPage(this.form.forceCoupon.checked,this.form.testCoupon.checked?1:0,"coupon_vendeur")'>
									<input type='checkbox' id="forceCoupon" onchange="this.checked?this.form.printCoupon.disabled=false:this.form.printCoupon.disabled=true">Force
								</td>
							</tr>
							
						</table>
					</form>
				<? } ?>
				<? if ($title == "COUPON ACHETEUR") {?>
					<form style="color:black">
						<table width=100% border=0>
							<tr>
								<td rowspan=5 width=15%></td>
								<td colspan=2></td>
								<td rowspan=5 width=20%>Param PDF (Paysage): <br/><?= $infAppli['nb_coupon_page'] ?>/page</td>
							</tr>
							<tr class="tabAction">
							<td width=50%>
									- Numérotés 1 -> 1500
								</td>
								<td width=15%>
									<input type=button value='Imprimer' onclick='imprimeCoupons(1,1500,0,"coupon_acheteur")'>
								</td>
							</tr>
							<tr class="tabAction">
							<td >
									- 1 page de vierge
								</td>
								<td >
									<input type=button value='Imprimer' onclick='imprimeCoupons(-1,-1,0,"coupon_acheteur")'>
								</td>
							</tr>
						</table>
					</form>
				<? } ?>
			</td>
		</tr>
	<? } ?>
</table>
<form name="formEdition" onsubmit="return false">
	<div id="edition" style="display:none">
		<h2 class=fiche>
			<div class="row">
				<div class="col-sm-6" id="html_file_title"></div>
				<div class="col-sm-2"><i class="far fa-eye link" onclick='alertModalInfo(CKEDITOR.instances.editor_html_file.getData());' )></i></div>
				<div class="col-sm-1"><i class="fas fa-save link" onclick="saveEditor(idText,CKEDITOR.instances.editor_html_file.getData())"></i></div>
				<div class="col-sm-1"><i class="far fa-file-pdf link" onclick='viewOnPdf(idText, idText=="coupon_vendeur"?"L":"P")' )></i></div>
				<div class="col-sm-2" style="text-align: right"><i class="fas fa-times link"  onclick="cancelEditor('html_file')"></i></div>
			</div>
		</h2>
		<textarea style="width:100%" rows=150 id="editor_html_file" contenteditable="true"></textarea>
		<!-- <textarea style="width:100%;heigth:40%" rows=25 id="editor_html_file"></textarea> -->
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
				name: 'confirmation',
				element: 'div',
				styles: {
					'background': 'DARKBLUE',
					'color': 'WHITE',
					'width': '75%',
					'text-align': 'center',
					'font-weight': 'bold',
					'font-size': 'large'
				}
			},
			{
				name: 'visualisation',
				element: 'div',
				styles: {
					'background': 'LIGHTGREEN',
					'width': '75%',
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
</form>