<script>
	var nb_eti_page = '<?= $infAppli['nb_eti_page'] ?>';
	var nb_coupon_page = '<?= $infAppli['nb_coupon_page'] ?>';
</script>

<script src="JS/editFiche.js"></script>
<?
$tabInfo = [
	'FICHE DEPOT' => "fiche_depot",
	'ETIQUETTE' => "etiquette",
	'COUPON DEPOT' => "coupon_vendeur",
	'COUPON SORTIE' => "coupon_acheteur",
	'_' => "",
	'CREATE MODAL' => "modal_confirm_create",
	'CONFIRME MODAL' => "modal_confirm_confirme",
	'PAYE MODAL' => "modal_confirm_paye",
	 'VENDRE MODAL' => "modal_confirm_vendre",
	// 'RESTOCK MODAL' => "modal_confirm_restock",
	'MAIL ENTETE' => "entete_mail",
	'MAIL PIED' => "pied_mail",
	'MAIL ENREGISTREMENT' => "mel_enregistrement",
	'MAIL CONFIRME' => "mel_confirme",
	'MAIL VENDU' => "mel_vendu",
	'__' => "",
	'FACTURE' => 'facture' 
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
		if ($title == "COUPON DEPOT" || $title == "COUPON SORTIE") {
			$format = "L";
		} ?>
		<tr class="tabl0" style="border-bottom:1px solid grey">
			<td><?= $title ?></td>

			<td width=10%>
				<? if ($idText != "") { ?>
					<span class="link url" onclick='viewPdf("<?= $idText ?>","<?= $format ?>");' title="Génération du PDF" )>PDF</span>
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
							<tr>
								<td rowspan=5 width=15%><i>Test <input type='checkbox' name="testEtiq" checked></i></td>
								<td colspan=2></td>
								<td rowspan=5 width=20%>Param PDF: <br /><?= $infAppli['nb_eti_page'] ?>/page</td>
							</tr>
							<tr class="tabAction">
								<td width=50%>
									- De <input type=number min='<?= $infAppli['base_info'] ?>' name=eti0 value='<?= $infAppli['base_info'] ?>' style='width:30%' size=5>
									a <input type=number name=eti1 size=5 style='width:30%' min='<?= $infAppli['base_info'] ?>'>
								</td>
								<td width=15%>
									<input type=button value='Imprimer' onclick='imprimeEtiquettes(this.form.eti0.value,this.form.eti1.value,this.form.testEtiq.checked?1:0)'>
								</td>
							</tr>
							<tr class="tabAction">
								<td>
									- Numérotés 1 -> <?= $infAppli['base_info'] - 1 ?>
								</td>
								<td>
									<input type=button value='Imprimer' onclick='imprimeEtiquettes(1,<?= $infAppli["base_info"] - 1 ?>)'>
								</td>
							</tr>
							<tr class="tabAction">
								<td>
									- 1 page de vierge
								</td>
								<td>
									<input type=button value='Imprimer' onclick='imprimeEtiquettes(-1,-1)'>
								</td>
							</tr>
							<tr class="tabAction">
								<td> - Modifs <span id="nbAImprimer"></span> (<?= $infAppli['nb_eti_page'] ?>/page) : <span id="nb_fiche_eti"></span>
									[C: <b><span id="nb_fiche_new"></span></b>; M:<b><span id="nb_fiche_modif"></span></b>]
								</td>
								<td>
									<input type=button name='printEtiquette' value='Imprimer' disabled id="btnImprimeEtiquettesPage" onclick='imprimeEtiquettesPage(this.form.forceEtiquette.checked,this.form.testEtiq.checked?1:0)'>
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
								<td rowspan=3 width=20%>Param PDF: <br />marge HB: 10pt, GD:10pt<br />Zoom 79%</td>
							</tr>
							<tr class="tabAction">
								<td width=50%>
									- De <input type=number min='<?= $infAppli['base_info'] ?>' name=eti0 value='<?= $infAppli['base_info'] ?>' style='width:30%' size=5>
									a <input type=number name=eti1 size=5 style='width:30%' min='<?= $infAppli['base_info'] ?>'>
								</td>
								<td width=15%>
									<input type=button value='Imprimer' onclick='imprimeFiches(this.form.eti0.value,this.form.eti1.value)'>
								</td>
							</tr>
							<tr class="tabAction">
								<td>
									- Vierge
								</td>
								<td>
									<input type=button value='Imprimer' onclick='imprimeFiche()' />
								</td>
							</tr>
						</table>
					</form>
				<? } ?>
				<? if ($title == "COUPON DEPOT") { ?>
					<form style="color:black">
						<table width=100% border=0>
							<tr>
								<td rowspan=5 width=15%><i>Test <input type='checkbox' name="testCoupon" checked /></i></td>
								<td colspan=2></td>
								<td rowspan=5 width=20%>Param PDF (Paysage): <br /> <?= $infAppli['nb_coupon_page'] ?>/page</td>
							</tr>
							<tr class="tabAction">
								<td width=50%>- De <input type=number min='<?= $infAppli['base_info'] ?>' name=eti0 value='<?= $infAppli['base_info'] ?>' style='width:30%' size=5>
									à <input type=number name=eti1 size=5 style='width:30%' min='<?= $infAppli['base_info'] ?>'>
								</td>
								<td width=15%>
									<input type=button value='Imprimer' onclick='imprimeCoupons(this.form.eti0.value,this.form.eti1.value,this.form.testCoupon.checked?1:0,"coupon_vendeur")'>
								</td>

							</tr>
							<tr class="tabAction">
								<td>
									- Numérotés 1 -> <?= $infAppli['base_info'] - 1 ?>
								</td>
								<td>
									<input type=button value='Imprimer' onclick='imprimeCoupons(1,<?= $infAppli["base_info"] - 1 ?>,0,"coupon_vendeur")'>
								</td>
							</tr>
							<tr class="tabAction">
								<td>
									- 1 page de vierge
								</td>
								<td>
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
				<? if ($title == "COUPON SORTIE") { ?>
					<form style="color:black">
						<table width=100% border=0>
							<tr>
								<td rowspan=5 width=15%><i>Test <input type='checkbox' name="testCouponA" checked /></i></td>
								<td colspan=2></td>
								<td rowspan=5 width=20%>Param PDF (Paysage): <br /> <?= $infAppli['nb_coupon_page'] ?>/page</td>
							</tr>
							<tr class="tabAction">
								<td width=50%>- De <input type=number min='<?= $infAppli['base_info'] ?>' name=eti0 value='<?= $infAppli['base_info'] ?>' style='width:30%' size=5>
									à <input type=number name=eti1 size=5 style='width:30%' min='<?= $infAppli['base_info'] ?>'>
								</td>
								<td width=15%>
									<input type=button value='Imprimer' onclick='imprimeCoupons(this.form.eti0.value,this.form.eti1.value,this.form.testCouponA.checked?1:0,"coupon_acheteur")'>
								</td>

							</tr>
							<tr class="tabAction">
								<td>
									- Numérotés 1 -> <?= $infAppli['base_info'] - 1 ?>
								</td>
								<td>
									<input type=button value='Imprimer' onclick='imprimeCoupons(1,<?= $infAppli["base_info"] - 1 ?>,0,"coupon_acheteur")'>
								</td>
							</tr>
							<tr class="tabAction">
								<td>
									- 1 page de vierge
								</td>
								<td>
									<input type=button value='Imprimer' onclick='imprimeCoupons(-1,-1,0,"coupon_acheteur")'>
								</td>
							</tr>
							<tr class="tabAction">
								<td>
									- Modifs <span id="nbCouponAImprimerA"></span> (<?= $infAppli['nb_coupon_page'] ?>/page) : <span id="nb_fiche_couponA"></span>
								</td>
								<td>
									<input type=button name='printCouponA' value='Imprimer' disabled id="btnImprimeCouponsPageA" onclick='imprimeCouponsPage(this.form.forceCouponA.checked,this.form.testCouponA.checked?1:0,"coupon_acheteur")'>
									<input type='checkbox' id="forceCouponA" onchange="this.checked?this.form.printCouponA.disabled=false:this.form.printCouponA.disabled=true">Force
								</td>
							</tr>
						</table>
					</form>
				<? } ?>
				<? if ($title == "FACTURE") { ?>
					<form style="color:black">
						<table width=100% border=1>
							<tr class="tabAction">
								<td width=15%></td>
								<td > Numero <input type=number style='width:30%' name=nfac size=5></td>
								<td width=15%>
									<input type=button value='Imprimer' onclick='imprimeLibreFiche(this.form.nfac.value,"facture")'>
								</td>
								<td width=20%></td>
								
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
				<!-- <div class="col-sm-2"><i class="far fa-eye link" onclick='alertModalInfo(CKEDITOR.instances.editor_html_file.getData());' )></i></div> -->
				<!-- <div class="col-sm-1"><i class="fas fa-save link" onclick="saveEditor(idText,CKEDITOR.instances.editor_html_file.getData())"></i></div> -->
				<div class="col-sm-2"><i class="far fa-eye link" onclick='alertModalInfo(document.formEdition.editing.value);' )></i></div>
				<div class="col-sm-1"><i class="fas fa-save link" onclick="saveEditor(idText,document.formEdition.editing.value)"></i></div>
				<div class="col-sm-1"><i class="far fa-file-code link" onclick='viewOnHtml(idText)' )></i></div>
				<div class="col-sm-2" style="text-align: right"><i class="fas fa-times link" onclick="cancelEditor('html_file')"></i></div>
			</div>
			<div class="row">
			</div>
		</h2>
		<!-- <textarea style="width:100%" rows=150 id="editor_html_file" contenteditable="true"></textarea> -->
		<!-- <textarea style="width:100%;heigth:40%" rows=25 id="editor_html_file"></textarea> -->

		<div style="height: 250px;position: relative;">
			<textarea placeholder="Enter HTML Source Code" 
				id="editing" 
				spellcheck="false" 
				oninput="update(this.value); sync_scroll(this);" 
				onscroll="sync_scroll(this);" 
				onkeydown="check_tab(this, event);"
				onkeyup="getElement('visu_html').innerHTML=this.value">
			</textarea>
			<pre id="highlighting" aria-hidden="true">
				<code class="language-html" id="highlighting-content">
				</code>
			</pre>
		</div>
		<!-- <textarea style="width:100%; height: 200px;" rows=150 id="editor_html_file" onkeyup="getElement('visu_html').innerHTML=this.value"></textarea> -->
		<div id="visu_html" style="border:1px black solid">
		</div>
	</div>
	<script src="JS/prism.js"></script>
	<script src="JS/editor.js"></script>
	
</form>