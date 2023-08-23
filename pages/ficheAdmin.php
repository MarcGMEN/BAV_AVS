<? $idRamdom = rand(1000, 9999); ?>
<script>
	var idFiche = '<?= $GET_id ?>';
	// pour rendre le champ nom du client unique
	var idRamdom = "<?= $idRamdom ?>";
</script>
<script src="JS/ficheAdmin.js" type="text/javascript"></script>

<form name="ficheForm" method="POST" onsubmit="return submitForm()" action="">
	<input type=hidden name="obj_id" />
	<!--cli_id <i id=cli_id></i>-->
	<input type=hidden name="cli_id" />
	<input type=hidden name="ach_id" />
	<input type=hidden name="obj_etat" />
	<fieldset class=fiche>
		<legend class=titreFiche>Le depot</legend>
		<h4>
			<div class="row tittab" id='trTitreFiche' style='display: none;vertical-align: middle;'>
				<div class="col-sm-8 col-md-8 col-xs-8" style="border:1px solid blue">
					<div class="col-sm-4 col-md-4 col-xs-4">
						<input type="hidden" name="obj_numero" />
						No&nbsp;:&nbsp;<span style="font-size: 1.5em" id='obj_numero'></span>
						<!--<span  id="obj_id_modif" style="color:black; font-size: 0.5em; text-align: left;"></span>-->
					</div>
					<div class="col-sm-8 col-md-8 col-xs-8">
						<span style="font-size:0.6em; text-align: left;">
							Etiquette
							<span><select name=obj_modif_data style="width:80px" onchange="setStartSaisie(true);">
									<option value=0>A jour</option>
									<option value=1>Nouvelle</option>
									<option value=2>Modifié</option>
								</select></span>
							&nbsp;Coupon dépôt
							<select name=obj_modif_vendeur style="width:80px" onchange="setStartSaisie(true);">
								<option value=0>A jour</option>
								<option value=1>Nouvelle</option>
								<option value=2>Modifié</option>
							</select>
							&nbsp;Coupon sortie
							<span><select name=obj_modif_stock style="width:80px" onchange="setStartSaisie(true);">
									<option value=0>A jour</option>
									<option value=1>Nouveau</option>
								</select></span>
						</span>
					</div>
				</div>
				<div class="col-sm-4 col-md-4 col-xs-4 tabl1">
					<span class="alert-info" id="obj_etat_libelle"></span>
					<input type=button onclick="goTo('saisieExpress.php', '',document.ficheForm.obj_numero.value,null);" id=BtnSaisieExpress value="Gestion Fiche" style='display: none' />
				</div>
			</div>
		</h4>
		<div class="row">
			<!-- NEw LINE -->
			<!-- type -->
			<div class="col-sm-4 col-md-4 col-xs-12">
				<span class="titrow col-md-3 col-sm-3 col-xs-3" width=20%>Type</span>
				<span class="tabInput col-md-9 col-sm-9 col-xs-9">
					<select name='obj_type' tabindex=<?= $tabindex++ ?> onchange="setStartSaisie(true);">
					</select>
				</span>
			</div>
			<!-- public -->
			<div class="col-sm-4 col-md-4 col-xs-12">
				<span class="titrow  col-md-3 col-sm-3 col-xs-3">Public</span>
				<span class="tabInput col-md-9 col-sm-9 col-xs-9">
					<select name='obj_public' tabindex=<?= $tabindex++ ?> onchange="setStartSaisie(true);">
					</select>
				</span>
			</div>
			<!-- pratique -->
			<div class="col-sm-4 col-md-4 col-xs-12">
				<span class="titrow col-md-3 col-sm-3 col-xs-3">Pratique</span>
				<span class="tabInput col-md-9 col-sm-9 col-xs-9">
					<select name='obj_pratique' tabindex=<?= $tabindex++ ?> onchange="setStartSaisie(true);">
					</select>
				</span>
			</div>
			<!-- NEw LINE -->
			<!-- marque -->
			<div class="col-sm-4 col-md-4 col-xs-12">
				<span class="titrow  col-md-3 col-sm-3 col-xs-3">Marque <span title="Obligatoire">*</span>

				</span>

				<span class="tabInput col-md-9 col-sm-9 col-xs-9">
					<input type=text list="listMarques" name="obj_marque_<?= $idRamdom ?>" size=30 maxlength="50" tabindex=<?= $tabindex++ ?> style="text-transform:uppercase" placeholder="Marque du vélo" onkeyup="setStartSaisie(true);" onblur="x_return_list_modeles(this.value,display_list_modeles)" required />
					<datalist id="listMarques"></datalist>
					<!--					<br/><span style='font-size:7pt'>Saisie libre</span>-->
				</span>
			</div>
			<!-- Modele -->
			<div class="col-sm-4 col-md-4 col-xs-12">
				<span class="titrow  col-md-3 col-sm-3 col-xs-3">Mod&egrave;le</span>
				<span class="tabInput col-md-9 col-sm-9 col-xs-9">
					<input type=text name="obj_modele" size=25 maxlength="30" tabindex=<?= $tabindex++ ?> style="text-transform:uppercase" list="listModeles" placeholder="Nom du vélo" onkeyup="setStartSaisie(true);" />
					<datalist id="listModeles"></datalist>
				</span>
			</div>
			<!-- Couleur -->
			<div class="col-sm-4 col-md-4 col-xs-12">
				<span class="titrow  col-md-3 col-sm-3 col-xs-3">Couleur <span title="Obligatoire">*</span></span>
				<span class="tabInput col-md-9 col-sm-9 col-xs-9">
					<input type=text name="obj_couleur" size=20 maxlength="30" tabindex=<?= $tabindex++ ?> style="text-transform:uppercase" placeholder="Couleurs dominantes" onkeyup="setStartSaisie(true);" required />
				</span>
			</div>

			<!-- NEw LINE -->
			<!-- Date achat -->
			<div class="col-sm-4 col-md-4 col-xs-12">
				<span class="titrow  col-md-3 col-sm-3 col-xs-3">Date achat
					<span class="help link" onmouseover="Aff_layer('aide_date_achat')" onmouseout="Cache_layer('aide_date_achat')">?</span>
					<br />
				</span>
				<span class="tabInput col-md-9 col-sm-9 col-xs-9">
					<input type=date name="obj_date_achat" tabindex=<?= $tabindex++ ?> placeholder="Date achat" onkeyup="setStartSaisie(true);" />
				</span>
				<span class="col-md-12 col-sm-12 col-xs-12 ">
					<div id="aide_date_achat" style="visibility: hidden;" class='help'>
						<small>Saisisez 01/01/AAAA si vous ne connaissez pas la date exacte.</small>
					</div>
				</span>
			</div>
			<!-- prix achat -->
			<div class="col-sm-4 col-md-4 col-xs-12">
				<span class="titrow  col-md-3 col-sm-3 col-xs-3">Prix achat</span>
				<span class="tabInput col-md-9 col-sm-9 col-xs-9">
					<input type=number name="obj_prix_achat" size=5 maxlength="10" tabindex=<?= $tabindex++ ?> onkeyup="setStartSaisie(true);" step="0.1" min="0" title="Prix d'achat de votre vélo" placeholder="00.00" />&#8364;
				</span>
			</div>
			<!-- Taille -->
			<div class="col-sm-4 col-md-4 col-xs-12">
				<span class="titrow  col-md-3 col-sm-3 col-xs-3">Taille </span>
				<span class="tabInput col-md-9 col-sm-9 col-xs-9">
					<input type=text name="obj_taille" size=25 maxlength="30" tabindex=<?= $tabindex++ ?> style="text-transform:uppercase" list="listTailles" placeholder="Taille du vélo" onkeyup="setStartSaisie(true);" />
					<datalist id="listTailles"></datalist>
				</span>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 col-xs-12">
				<!-- Descpription -->
				<span class="titrow col-md-2 col-sm-2 col-xs-3">Description <small>(facultative)</small>
					<span class="help link" onmouseover="Aff_layer('aide_descript')" onmouseout="Cache_layer('aide_descript')">?</span>
					<br />
				</span>
				<span class="tabInput col-md-10 col-sm-10 col-xs-9">
					<textarea rows="4" cols="100" tabindex=<?= $tabindex++ ?> style="resize:none;overflow: none;" name="obj_description" maxlength="250" onkeyup="MaxLengthTextarea(this, 250);setStartSaisie(true)" placeholder="Accessoires, révision (transmission, pneus, freins..)"></textarea>
				</span>
				<span class="col-md-12 col-sm-12 col-xs-12" id='id_descplus' style="visibility: hidden;">
					<div style='color:blue; background-color: yellow;' class=' help'>Pour saisir une description plus précise qui accompagnera votre vélo,
						<span class="link" onclick="action_descript_plus()"> cliquez ici.</span>
					</div>
				</span>
				<span class="col-md-12 col-sm-12 col-xs-12">
					<div id="aide_descript" style="visibility: hidden;" class=' help'>
						<small>Saisisez ici les accessoires, les révisions (transmission, pneus, freins..), et autres</small>
					</div>
				</span>
			</div>
			<div class="col-sm-6 col-xs-12" style="vertical-align: bottom;">
				<!-- prix depot -->
				<div class="titrow col-md-2 col-sm-2 col-xs-3">Prix</div>
				<div class="tabInput col-md-4 col-sm-4 col-xs-9">
					<input type=number name="obj_prix_depot" size=5 maxlength="10" tabindex=<?= $tabindex++ ?> onkeyup="setStartSaisie(true);" step="0.1" min="0" title="Prix vente, vous pouvez le laisser vide et le renseigner le jour du dépôt." placeholder="00.00" />&#8364;
				</div>
				<!-- PRIX vente -->
				<div class="titrow col-md-2 col-sm-2  col-xs-3">Prix de vente:</div>
				<div class="tabl1 col-md-4 col-sm-4 col-xs-9">
					<input type=number name="obj_prix_vente" size=5 maxlength="10" tabindex=<?= $tabindex++ ?> onkeyup="setStartSaisie(true);" onchange="affectPrix();" title="Prix vente" required step="0.1" min="0" placeholder="00.00" />&nbsp;&#8364;
				</div>
			</div>
		</div>
	</fieldset>

	<!-- VENDEUR -->
	<!-- VENDEUR -->
	<!-- VENDEUR -->
	<!-- VENDEUR -->
	<div class="row">
		<div class="col-sm-6 col-xs-12">
			<fieldset class=fiche>
				<legend class="titreFiche link" id='legendVendeur' <? if ($GET_modePage != "create") { ?> onclick='goTo("client.php","consult",document.ficheForm.cli_id.value,"")' title="Accès au vendeur" <? } ?>>
					Le vendeur
					<? if ($infAppli['ADMIN']) { ?>
						<span style="font-size: 0.7em" id="cli_id">...</span>
					<? } ?>
				</legend>
				<div class="row">
					<div class="col-sm-6 col-md-6 col-xs-12">
						<span class="titrow  col-md-3 col-sm-3 col-xs-3">Mail <span title="Obligatoire">*</span></span>
						<span class="tabInput col-md-9 col-sm-9 col-xs-9">
							<input type=email name='cli_emel' id="cli_emel" size="50" maxlength="100" tabindex=<?= $tabindex++ ?> placeholder="aaaa.bbbb@ccc.dd" required onkeyup="setStartSaisie(true);" onblur='searchByMel(this.value)' list='listVendeur' />
							<datalist id="listVendeur"></datalist>
						</span>
					</div>
					<div class="col-sm-6 col-md-6 col-xs-12">
						<span class="titrow  col-md-3 col-sm-3 col-xs-3">Nom et prénom <span title="Obligatoire">*</span></span>
						<span class="tabInput col-md-9 col-sm-9 col-xs-9">
							<input type=text name='cli_nom' tabindex=<?= $tabindex++ ?> size="50" maxlength="100" required onkeyup="setStartSaisie(true);" onblur='searchByName(this.value)' list='listVendeurName' />
							<datalist id="listVendeurName"></datalist>
						</span>
					</div>
				</div>
			</fieldset>
		</div>
		<div class="col-sm-6 col-xs-12">
			<!-- ACHETEUR -->
			<!-- ACHETEUR -->
			<!-- ACHETEUR -->
			<!-- ACHETEUR -->
			<fieldset class=fiche style='display:none' id="fieldSetAcheteur">
				<legend class="titreFiche link" onclick='goTo("client.php","consult",document.ficheForm.ach_id.value,"")'>
					L'acheteur
					<span style="font-size: 0.7em" id="ach_id">...</span>
				</legend>
				<div class="row">
					<div class="col-sm-12 col-md-12 col-xs-12">
						<span class="titrow  col-md-3 col-sm-3 col-xs-3">Nom et prénom <span title="Obligatoire">*</span></span>
						<span class="tabInput col-md-9 col-sm-9 col-xs-9">
							<input type=text name='ach_nom' tabindex=<?= $tabindex++ ?> size="50" maxlength="100" onkeyup="setStartSaisie(true);" onblur='searchAchByName(this.value)' list='listAcheteurName' />
							<datalist id="listAcheteurName"></datalist>
						</span>
					</div>
				</div>
			</fieldset>
		</div>
	</div>

	<!-- BARRE ACTION -->
	<!-- BARRE ACTION -->
	<!-- BARRE ACTION -->
	<!-- BARRE ACTION -->
	<div class="row fiche">
		<div class="col-sm-3 col-md-3 col-xs-6 btnAction" id="tdBtnAction">
			<!-- etat vide pour reconnaitre une action de modif simple -->
			<button name="buttonValideFiche" tabindex=<?= $tabindex++ ?> disabled>Enregistrer
			</button>
		</div>
		<div class="col-sm-3 col-md-3 col-xs-6 btnAction" style='display:none' id="tdBtnPdf">
			<input type=button value="Impression Fiche" onclick="imprimeFiche()" name="buttonPDFFiche" tabindex=<?= $tabindex++ ?>>
		</div>
		<div class="col-sm-3 col-md-3 col-xs-6 btnAction" style='display:none' id="tdBtnSup">
			<input type=button value="Supprimer" name="buttonSupprimeFiche" onclick="supprimerFiche()" tabindex=<?= $tabindex++ ?> />
		</div>
		<div class="col-sm-3 col-md-3 col-xs-6 btnAction" style='display:none' id="tdBtnEmel">
			<input type=button value="Emel confirme" name="buttonEmelConfirmFiche" onclick="x_action_reMelConfirme(this.form.obj_id.value,  display_retour_test)" tabindex=<?= $tabindex++ ?> />
			<input type=hidden name="obj_etat_new" value="CONFIRME" />
			<input type=button value="Confirme" name="buttonConfirmFiche" onclick="confirmeFiche()" tabindex=<?= $tabindex++ ?> />
		</div>

		<div class="col-sm-3 col-md-3 col-xs-6 btnAction">
			<input type=button value="Annuler" onclick="fermerCRUD()" tabindex=<?= $tabindex++ ?>>
		</div>
	</div>
</form>