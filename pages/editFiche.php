<script>
	var nb_eti_page = '<?= $infAppli['nb_eti_page'] ?>';
	var nb_coupon_page = '<?= $infAppli['nb_coupon_page'] ?>';
</script>

<script src="JS/editFiche.js"></script>
<?
$tabInfo = [
	'VIDE0' => "Les papiers",
	'Fiche de dépôt' => "fiche_depot",
	'Etiquette' => "etiquette",
	'Etiquette des accessoires' => "coupon_accessoire",
	'Coupon de dépôt' => "coupon_vendeur",
	'Coupon de sortie' => "coupon_acheteur",
	'Coupon Tombola' => "coupon_tombola",
	'VIDE5' => " Listing",
	'Pre-check' => 'pre-check',
	'VIDE4' => " Facturation",
	'Facture' => 'facture',
	'VIDE1' => "Les modals de fiche",
	'Modal de creation de la fiche' => "modal_create_fiche",
	'Modal de suppresion de la fiche' => "modal_confirm_supp",
	//'MODIF MODAL' => "modal_confirm_confirme",
	'VIDE2' => "Les modals de gestion de fiche",
	'Modal de saisie de la vente' => "modal_confirm_vendre",
	// 'RESTOCK MODAL' => "modal_confirm_restock",
	'VIDE3' => "Les Mails",
	'Entete des mails' => "entete_mail",
	'Pied des mails' => "pied_mail",
	'Mail de pré-enregistrement' => "mel_pre-enregistrement",
	'Mail de renvoi du code d\'accès' => "mel_code_access",
	// 'MAIL ENREGISTREMENT' => "mel_enregistrement",
	// 'MAIL CONFIRME' => "mel_confirme",
	'Mail d\'information de la vente' => "mel_vendu",
	'VIDE5' => "La page d'accueil",
	'Page d\'actualité' => 'bav_actu',
	'Page La Bourse' => "bav_bourse",
	'Page de Quoi vendre' => 'bav_vendre',
	'Page des statsitiques' => 'bav_statistique',
	'Page du programme' => 'bav_programme',
	'Page de l\'organisateur' => 'bav_orga',
];
?>

<h3 class="titreFiche">Gestion des éditions</h3>
<table width="100%" id="tableHTML" style="padding:2 2 2 2 ;">
	<? foreach ($tabInfo as $title => $idText) { ?>
		<tr class="tabl0" style="border-bottom:1px solid grey">
			<td width=20%>
				<? if (!startsWith($title, "VIDE")) {
					echo $title;
				} else {
					echo "<div style='background-color: lightblue;'>&nbsp;</div>";
				}
				?>
			</td>

			<? if (startsWith($title, "VIDE")) { ?>
				<td colspan=5>
					<div style="background-color: lightblue;font-weight: bold;">
						<?= $idText ?>
					</div>
				</td>
			<? } else { ?>
				<td width=10%>
					<? if ($idText == "fiche_depot") { ?>
						<span class="link url"
							onclick='viewPdf("<?= $idText ?>","<?= $format ?>");'
							title="Génération du PDF" )>PDF</span>
					<? } ?>
					<i class="fas fa-edit"
						onclick="x_return_html('<?= $idText ?>', display_html_file);idText='<?= $idText ?>';getElement('html_file_title').innerHTML='<?= addslashes($title) ?>'  "
						title="Modification du document"></i>
				</td>
			<? } ?>


			<td width=70%>
				<? if ($idText == "etiquette") { ?>
					<form style="color:black">
						<table width=100% border=0>
							<tr>
								<td rowspan=5 width=15%><i
										title='Décocher pour mettre a jour le suivi des editions'>Test
										<input type='checkbox' name="testEtiq"
											checked></i></td>
								<td colspan=2></td>
								<td rowspan=5 width=20%>Feuille A4 autocollante</td>
							</tr>
							<tr class="tabAction">
								<td width=50%>
									- De <input type=number
										min='<?= $infAppli['base_info'] ?>' name=eti0
										value='<?= $infAppli['base_info'] ?>'
										style='width:30%' size=5>
									a <input type=number name=eti1 size=5
										style='width:30%'
										min='<?= $infAppli['base_info'] ?>'>
								</td>
								<td width=15%>
									<input type=button value='Imprimer'
										onclick='imprimeEtiquettes(this.form.eti0.value,this.form.eti1.value,this.form.testEtiq.checked?1:0,"etiquette")'>
								</td>
							</tr>
							<tr class="tabAction">
								<td>
									- 1 page de vierge
								</td>
								<td>
									<input type=button value='Imprimer'
										onclick='imprimeEtiquettes(-1,-1,0,"etiquette")'>
								</td>
							</tr>
							<tr class="tabAction">
								<td> - Modifs <span id="nbAImprimer"></span> (
									<?= $infAppli['nb_eti_page'] ?>/page) : <span
										id="nb_fiche_eti"></span>
									[C: <b><span id="nb_fiche_new"></span></b>;
									M:<b><span id="nb_fiche_modif"></span></b>]
								</td>
								<td>
									<input type=button name='printEtiquette'
										value='Imprimer' disabled
										id="btnImprimeEtiquettesPage"
										onclick='imprimeEtiquettesPage(this.form.forceEtiquette.checked,this.form.testEtiq.checked?1:0,"etiquette")'>
									<input type='checkbox' id="forceEtiquette"
										onchange="this.checked?this.form.printEtiquette.disabled=false:this.form.printEtiquette.disabled=true">Force
								</td>
							</tr>
						</table>
					</form>
				<? } ?>
				<? if ($idText == "fiche_depot") { ?>
					<form style="color:black">
						<table width=100% border=0>
							<tr>
								<td rowspan=3 width=15%>&nbsp;</td>
								<td colspan=2></td>
								<td rowspan=3 width=20%>Feuille A4 blanche</td>
							</tr>
							<tr class="tabAction">
								<td width=50%>
									- De <input type=number
										min='<?= $infAppli['base_info'] ?>' name=eti0
										value='<?= $infAppli['base_info'] ?>'
										style='width:30%' size=5>
									a <input type=number name=eti1 size=5
										style='width:30%'
										min='<?= $infAppli['base_info'] ?>'>
								</td>
								<td width=15%>
									<input type=button value='Imprimer'
										onclick='imprimeFiches(this.form.eti0.value,this.form.eti1.value)'>
								</td>
							</tr>
							<tr class="tabAction">
								<td>
									- Vierge
								</td>
								<td>
									<input type=button value='Imprimer'
										onclick='imprimeFiche()' />
								</td>
							</tr>
						</table>
					</form>
				<? } ?>
				<? if ($idText == "coupon_vendeur") { ?>
					<form style="color:black">
						<table width=100% border=0>
							<tr>
								<td rowspan=5 width=15%><i
										title='Décocher pour mettre a jour le suivi des editions'>Test
										<input type='checkbox' name="testCoupon"
											checked /></i></td>
								<td colspan=2></td>
								<td rowspan=5 width=20% style='background-color:ORANGE'>
									Feuille A4 orange</td>
							</tr>
							<tr class="tabAction">
								<td width=50%>- De <input type=number
										min='<?= $infAppli['base_info'] ?>' name=eti0
										value='<?= $infAppli['base_info'] ?>'
										style='width:30%' size=5>
									à <input type=number name=eti1 size=5
										style='width:30%'
										min='<?= $infAppli['base_info'] ?>'>
								</td>
								<td width=15%>
									<input type=button value='Imprimer'
										onclick='imprimeCoupons(this.form.eti0.value,this.form.eti1.value,this.form.testCoupon.checked?1:0,"coupon_vendeur")'>
								</td>

							</tr>
							<!-- <tr class="tabAction">
								<td>
									- Numérotés 1 -> <?= $infAppli['base_info'] - 1 ?>
								</td>
								<td>
									<input type=button value='Imprimer' onclick='imprimeCoupons(1,<?= $infAppli["base_info"] - 1 ?>,0,"coupon_vendeur")'>
								</td>
							</tr> -->
							<tr class="tabAction">
								<td>
									- 1 page de vierge
								</td>
								<td>
									<input type=button value='Imprimer'
										onclick='imprimeCoupons(-1,-1,0,"coupon_vendeur")'>
								</td>
							</tr>
							<tr class="tabAction">
								<td>
									- Modifs <span id="nbCouponAImprimer"></span> (
									<?= $infAppli['nb_coupon_page'] ?>/page) : <span
										id="nb_fiche_coupon"></span>
									[C: <b><span id="nb_fiche_new_coupon"></span></b>;
									M:<b><span id="nb_fiche_modif_coupon"></span></b>]
								</td>
								<td>
									<input type=button name='printCoupon'
										value='Imprimer' disabled
										id="btnImprimeCouponsPage"
										onclick='imprimeCouponsPage(this.form.forceCoupon.checked,this.form.testCoupon.checked?1:0,"coupon_vendeur")'>
									<input type='checkbox' id="forceCoupon"
										onchange="this.checked?this.form.printCoupon.disabled=false:this.form.printCoupon.disabled=true">Force
								</td>
							</tr>

						</table>
					</form>
				<? } ?>
				<? if ($idText == "coupon_accessoire") { ?>
					<form style="color:black">
						<table width=100% border=0>
							<tr>
								<td rowspan=5 width=15%><i
										title='Décocher pour mettre a jour le suivi des editions'>Test
										<input type='checkbox' name="testEA"
											checked /></i></td>
								<td colspan=2></td>
								<td rowspan=5 width=20% >
									Feuille A4 autocollante</td>
							</tr>
							<tr class="tabAction">
								<td width=50%>- De <input type=number
										min='<?= $infAppli['base_info'] ?>' name=eti0
										value='<?= $infAppli['base_info'] ?>'
										style='width:30%' size=5>
									à <input type=number name=eti1 size=5
										style='width:30%'
										min='<?= $infAppli['base_info'] ?>'>
								</td>
								<td width=15%>
									<input type=button value='Imprimer'
										onclick='imprimeEtiquettesPage(this.form.eti0.value,this.form.eti1.value,this.form.testCoupon.checked?1:0,"coupon_accessoire")'>
								</td>

							</tr>
							<tr class="tabAction">
								<td>
									- 1 page de vierge
								</td>
								<td>
									<input type=button value='Imprimer'
										onclick='imprimeEtiquettes(-1,-1,0,"coupon_accessoire")'>
								</td>
							</tr>
							<tr class="tabAction">
								<td> - Modifs <span id="nbEAaImprimer"></span> (
									<?= $infAppli['nb_coupon_page'] ?>/page) : <span
										id="nb_ea_eti"></span>
									[C: <b><span id="nb_ea_new"></span></b>;
									M:<b><span id="nb_ea_modif"></span></b>]
								</td>
								<td>
									<input type=button name='printEA'
										value='Imprimer' disabled
										id="btnImprimeEAsPage"
										onclick='imprimeEtiquettesPage(this.form.testEA.checked,this.form.testEA.checked?1:0,"coupon_accessoire")'>
									<input type='checkbox' id="forceAccessoire"
										onchange="this.checked?this.form.printEA.disabled=false:this.form.printEA.disabled=true">Force
								</td>
							</tr>

						</table>
					</form>
				<? } ?>
				<? if ($idText == "coupon_acheteur") { ?>
					<form style="color:black">
						<table width=100% border=0>
							<tr>
								<td rowspan=5 width=15%><i
										title='Décocher pour mettre a jour le suivi des editions'>Test
										<input type='checkbox' name="testCouponA"
											checked /></i></td>
								<td colspan=2></td>
								<td rowspan=5 width=20% style='background-color:LIGHTBLUE'>
									Feuille A4 bleu</td>
							</tr>
							<tr class="tabAction">
								<td width=50%>- De <input type=number
										min='<?= $infAppli['base_info'] ?>' name=eti0
										value='<?= $infAppli['base_info'] ?>'
										style='width:30%' size=5>
									à <input type=number name=eti1 size=5
										style='width:30%'
										min='<?= $infAppli['base_info'] ?>'>
								</td>
								<td width=15%>
									<input type=button value='Imprimer'
										onclick='imprimeCoupons(this.form.eti0.value,this.form.eti1.value,this.form.testCouponA.checked?1:0,"coupon_acheteur")'>
								</td>

							</tr>
							<!-- <tr class="tabAction">
								<td>
									- Numérotés 1 -> <?= $infAppli['base_info'] - 1 ?>
								</td>
								<td>
									<input type=button value='Imprimer' onclick='imprimeCoupons(1,<?= $infAppli["base_info"] - 1 ?>,0,"coupon_acheteur")'>
								</td>
							</tr> -->
							<tr class="tabAction">
								<td>
									- 1 page de vierge
								</td>
								<td>
									<input type=button value='Imprimer'
										onclick='imprimeCoupons(-1,-1,0,"coupon_acheteur")'>
								</td>
							</tr>
							<tr class="tabAction">
								<td>
									- Modifs <span id="nbCouponAImprimerA"></span> (
									<?= $infAppli['nb_coupon_page'] ?>/page) : <span
										id="nb_fiche_couponA"></span>
								</td>
								<td>
									<input type=button name='printCouponA'
										value='Imprimer' disabled
										id="btnImprimeCouponsPageA"
										onclick='imprimeCouponsPage(this.form.forceCouponA.checked,this.form.testCouponA.checked?1:0,"coupon_acheteur")'>
									<input type='checkbox' id="forceCouponA"
										onchange="this.checked?this.form.printCouponA.disabled=false:this.form.printCouponA.disabled=true">Force
								</td>
							</tr>
						</table>

					</form>
				<? } ?>
				<? if ($idText == "coupon_tombola") { ?>
					<form style="color:black">
						<table width=100% border=1>
							<tr class="tabAction">
								<td width=15%>
									&nbsp;
								</td>
								<td width=50%>
									- 1 page de vierge
								</td>
								<td width=15%>
									<input type=button value='Imprimer'
										onclick='imprimeCoupons(-1,-1,0,"coupon_tombola")'>
								</td>
								<td width=20%>Feuille A4 blanche</td>

							</tr>
						</table>
					</form>
				<? } ?>
				<? if ($idText == "facture") { ?>
					<form style="color:black">
						<table width=100% border=1>
							<tr class="tabAction">
								<td width=15%></td>
								<td> Numero <input type=number style='width:30%'
										name=nfac size=5></td>
								<td width=15%>
									<input type=button value='Imprimer'
										onclick='imprimeLibreFiche(this.form.nfac.value,"facture")'>
								</td>
								<td width=20%>Feuille A4 blanche</td>

							</tr>
						</table>
					</form>
				<? } ?>
				<? if ($idText == "pre-check") { ?>
					<form style="color:black">
						<table width=100% border=1>
							<tr class="tabAction">
								<td width=15%></td>
								<td> Classeur(s) (<span id='nbClasseurPret'></span>)
									<select id=classeurs name='classeurs' style='width:150px'>
									</select>
								<td width=15%>
									<input type=button value='Imprimer'
										onclick='imprimePreCheck(this.form.classeurs.value)'>
								</td>
								<td width=20%>Feuille A4 blanche</td>

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
				<div class="col-sm-2"><i class="far fa-eye link"
						onclick='alertModalInfo(document.formEdition.editing.value);'
						)></i></div>
				<div class="col-sm-1"><i class="fas fa-save link"
						onclick="saveEditor(idText,document.formEdition.editing.value)"></i>
				</div>
				<div class="col-sm-1"><i class="far fa-file-code link"
						onclick='viewOnHtml(idText)' )></i></div>
				<div class="col-sm-2" style="text-align: right"><i
						class="fas fa-times link"
						onclick="cancelEditor('html_file')"></i></div>
			</div>
			<div class="row">
			</div>
		</h2>
		<!-- <textarea style="width:100%" rows=150 id="editor_html_file" contenteditable="true"></textarea> -->
		<!-- <textarea style="width:100%;heigth:40%" rows=25 id="editor_html_file"></textarea> -->


		<div style="height: 250px;position: relative;">
			<textarea placeholder="Enter HTML Source Code" id="editing"
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