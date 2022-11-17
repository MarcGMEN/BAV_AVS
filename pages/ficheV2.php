<? $idRamdom = rand(1000, 9999); ?>
<script>
	var idFiche = '<?= $GET_id ?>';
	// pour rendre le champ nom du client unique
	var idRamdom = "<?= $idRamdom ?>";
</script>
<script src="JS/fiche.js" type="text/javascript"></script>

<? if (!$infAppli['ADMIN'] && $GET_modePage == 'create') { ?>
	<div class='alert alert-info'>
		<p>Avant de venir déposer votre vélo les à La Soucoupe, nous vous conseillons de remplir la fiche dépôt.</p>
		<p>- Soit en saissisant votre demande avec le formulaire ci-dessous qui vous transmettra, après confirmation, la fiche dépot par mel.
			<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Il n'est pas nécéssaire de connaitre le prix de vente, <i>vous pourrez le renseigner le jour du dépôt.</i>
			<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Vous pouvez également modifier votre fiche grace au lien que vous recevrez par mel.
			<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Vous recevez un mel directement lorsque votre vélo est vendu.</b>
			<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cette fiche dépôt devra être imprimée par vous pour vous rendre à la Bourse. Une par vélo et un gain de temps sur place lors du dépôt.
		</p>
		<p>- Soit en téléchargeant, puis en imprimant la fiche dépôt à remplir que vous trouverez ici 
		<A  href="downloads/Fiche_BAV_2021.pdf" target="_blank"> <img class="link url" src="Images/pdf.png" height='40px' alt="téléchargement de la fiche" title="téléchargement de la fiche"></A>
			<small><i>Attention aux droits d'ouvertures des popUp, en fonction de votre navigateur.</i></small></p>
		<p>- Si vous souhaitez déposer plus de 15 vélos, contactez nous pour mettre en place un procédure spéciale.
			<a href="mailto:bourse1000velos@avs44.com">bourse1000velos@avs44.com</a> </p>
	</div>
	<div class='alert alert-warning'>
		En cas de non réception des mails, ou de soucis lors du pré-dépôt via le site, n'hésitez pas a nous contacter <a href='mailto:bourse1000velos@avs44.com' class="url">bourse1000velos@avs44.com</a>
	</div>
<? } ?>

<form name="accesForm" method="POST" onsubmit="return submitForm()" action="">
	<div class="row">
		<div class="col-sm-6 col-md-6 col-xs-6">
			Pour votre dépot, saisisez votre mail pour vous pré-enregistrer <input type='email' width=10% size=30 maxlength="80" name='new_email_depot'/> 
		</div>
		<div class="col-sm-6 col-md-6 col-xs-6">
			et cliquez ici <input type='button' value='Enregrister'/>
		</div>
	</div>
	<h2>OU</h2>
	<div class="row">
		<div class="col-sm-6 col-md-6 col-xs-6">
				Vous vous êtes déjà enregister <input type='email' size=30 maxlength="80" name='email_depot'/> et mot de passe <input type='password' name='pass_depot'/>
		</div>
		<div class="col-sm-6 col-md-6 col-xs-6">
			<input type='button' value='Connexion'/>
		</div>
	</div>
</form>
<form name="ficheForm" method="POST" onsubmit="return submitForm()" action="">
	<input type=hidden name="obj_id" />
	<!--cli_id <i id=cli_id></i>-->
	<input type=hidden name="cli_id" />
	<input type=hidden name="ach_id" />
	<input type=hidden name="obj_etat" />

	<!-- VENDEUR -->
	<!-- VENDEUR -->
	<!-- VENDEUR -->
	<!-- VENDEUR -->
	<fieldset class=fiche>
		<legend class="titreFiche link" id='legendVendeur'
		<? if ($GET_modePage != "create") { ?> 
				onclick='goTo("client.php","consult",document.ficheForm.cli_id.value,"")' title="Accès au vendeur"
		<?}?>	
		>
			Le vendeur
			<? if ($infAppli['ADMIN']) { ?>
				<span style="font-size: 0.7em" id="cli_id">...</span>
			<? } ?>
		</legend>
		<div class="row">
			<div class="col-sm-6 col-md-6 col-xs-12">
				<span class="titrow  col-md-3 col-sm-3 col-xs-3">Emel <span title="Obligatoire">*</span></span>
				<span class="tabInput col-md-9 col-sm-9 col-xs-9">
					<input type=email name='cli_emel' id="cli_emel" size="50" maxlength="100" tabindex=<?= $tabindex++ ?> placeholder="aaaa.bbbb@ccc.dd" required onblur='searchByMel(this.value)' list='listVendeur' />
					<datalist id="listVendeur"></datalist>
				</span>
			</div>
			<div class="col-sm-6 col-md-6 col-xs-12">
				<span class="titrow  col-md-3 col-sm-3 col-xs-3">Nom et prénom <span title="Obligatoire">*</span></span>
				<span class="tabInput col-md-9 col-sm-9 col-xs-9">
					<input type=text name='cli_nom' tabindex=<?= $tabindex++ ?> size="50" maxlength="100" required onblur='searchByName(this.value)' list='listVendeurName' />
					<datalist id="listVendeurName"></datalist>
				</span>
			</div>
			<div class="col-sm-6 col-md-6 col-xs-12">
				<span class="titrow  col-md-3 col-sm-3 col-xs-3">Adresse</span>
				<span class="tabInput col-md-9 col-sm-9 col-xs-9">
					<input type=text name="cli_adresse" size=50 maxlength='100' tabindex=<?= $tabindex++ ?> placeholder="Adresse" onkeyup="setStartSaisie(true);" />
					<br />
					<input type=text name="cli_adresse1" size=50 maxlength='100' tabindex=<?= $tabindex++ ?> placeholder="Complement adresse" onkeyup="setStartSaisie(true);" />
					<br />
					<input type=text name="cli_code_postal" size=5 maxlength='10' tabindex=<?= $tabindex++ ?> placeholder="Code postal" onkeyup="setStartSaisie(true);" />
					<input type=text name="cli_ville" size=40 maxlength='100' tabindex=<?= $tabindex++ ?> placeholder="Ville" />
				</span>
			</div>
			<div class="col-sm-6 col-md-6 col-xs-12">
				<span class="titrow  col-md-3 col-sm-3 col-xs-3">Telephone</span>
				<span class="tabInput col-md-9 col-sm-9 col-xs-9">
					<input type=text name='cli_telephone' size="15" maxlength="15" tabindex=<?= $tabindex++ ?> placeholder="Pour vous joindre durant la bourse" onkeyup="setStartSaisie(true);" title="Pour vous joindre durant la bourse" />
					<input type=text name='cli_telephone_bis' size="15" maxlength="15" tabindex=<?= $tabindex++ ?> placeholder="autre numéro" onkeyup="setStartSaisie(true);" title="autre numéro" />
				</span>
			</div>
		</div>
		<div class="row" id=trTauxCom style='display:none'>
			<div class="col-sm-6 col-md-6 col-xs-12">
				<span class="titrow  col-md-3 col-sm-3 col-xs-3">Taux commission</span>
				<span class="tabInput col-md-9 col-sm-9 col-xs-9">
					<select name='cli_taux_com' tabindex=<?= $tabindex++ ?> onchange="affectPrix();setStartSaisie(true);"></select>%
				</span>
			</div>
			<div class="col-sm-6 col-md-6 col-xs-12">
				<span class="titrow  col-md-3 col-sm-3 col-xs-3">Tarif Depot</span>
				<span class="tabInput col-md-9 col-sm-9 col-xs-9">
					<select name='cli_prix_depot' tabindex=<?= $tabindex++ ?> onchange="affectPrix();setStartSaisie(true);"></select>&#8364;
				</span>
			</div>
		</div>
	</fieldset>
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
					<? if ($infAppli['ADMIN']) { ?>
						<span  style="font-size:0.6em; text-align: left;">
							Stock[<span id="obj_modif_stock"></span>]
							<span><select name=obj_modif_stock style="width:80px" onchange="setStartSaisie(true);">
									<option value=0>A jour</option>
									<option value=1>Nouveau</option>
							</select></span>
							&nbsp;Data[<span id="obj_modif_data"></span>]
							<span><select name=obj_modif_data style="width:80px" onchange="setStartSaisie(true);">
									<option value=0>A jour</option>
									<option value=1>Nouvelle</option>
									<option value=2>Modifié</option>
							</select></span>
							&nbsp;Vendeur[<span id="obj_modif_vendeur"></span>]
							<select name=obj_modif_vendeur style="width:80px" onchange="setStartSaisie(true);">
									<option value=0>A jour</option>
									<option value=1>Nouvelle</option>
									<option value=2>Modifié</option>
							</select>
						</span>
						
					<? } ?>
					</div>
				</div>
				<div class="col-sm-4 col-md-4 col-xs-4 tabl1">
					<span class="alert-info" id="obj_etat_libelle"></span>
					<input type=button onclick="goTo('saisieExpress.php', '',idFiche,null);" id=BtnSaisieExpress value="Gestion Fiche" style='display: none' />
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
					<br/>
				</span>
				<span class="tabInput col-md-9 col-sm-9 col-xs-9">
					<input type=date  name="obj_date_achat" tabindex=<?= $tabindex++ ?> placeholder="Date achat" onkeyup="setStartSaisie(true);" />
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
					<br/>
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


				<!-- prix depot -->
				<span class="titrow col-md-2 col-sm-2 col-xs-3">Prix</span>
				<span class="tabInput col-md-10 col-sm-10 col-xs-9">
					<input type=number name="obj_prix_depot" size=5 maxlength="10" tabindex=<?= $tabindex++ ?> onkeyup="setStartSaisie(true);" step="0.1" min="0" title="Prix vente, vous pouvez le laisser vide et le renseigner le jour du dépôt." placeholder="00.00" />&#8364;
				</span>

			</div>


			<!--	<div class="col-sm-6 col-md-6 col-xs-12">
				<span class="titrow col-md-2 col-sm-2 col-xs-3">Accessoires
					<span class="help link" onmouseover="Aff_layer('aide_accessoire')" onmouseout="Cache_layer('aide_accessoire')">?</span>
				</span>
				<span class="tabInput col-md-9 col-sm-9 col-xs-9">
					<textarea rows="5" cols=100 max-size=200 tabindex=<?= $tabindex++ ?> 
						name="obj_accessoire"  onkeyup="setStartSaisie(true);"
						placeholder="Saisissez la liste des accessoires qui ne sont pas fixé au vélo (compteur, pompe, pneu...)"></textarea>
				</span>
				<span class="col-md-12 col-sm-12 col-xs-12 help">
					<div id="aide_accessoire" style="visibility: hidden;">
						<small>Saisissez la liste des accessoires qui ne sont pas fixé au vélo (compteur, pompe, pneu...)</small>
					</div>
				</span>
			</div>-->

			<div class="col-sm-6 col-xs-12" id="divModifPrix" style="display:none">
				<!-- modif de prix-->
				<div class="tittab col-md-12 col-sm-12 col-xs-12">Modification du prix</div>
				<div class="col-xs-12">
					<span class="tittab col-md-3">
						Nv prix
					</span>
					<span class="tittab col-md-4">
						Date demande
					</span>
					<span class="tittab col-md-5">
						Date validation
					</span>
				</div>
				<div id="tabModifPrix">
				</div>
				<div class="fiche col-md-12" id="divActionModifPrix">
					<span class="col-md-6">
						<input type=hidden name="mop_id_obj" />
						<br />Votre nouveau prix
						<input type=number name="mop_prix_demande" min=1 style="width:40%" step="0.1" placeholder="00.00" 
							onchange="if ((parseFloat(this.form.obj_prix_vente.value) !=parseFloat(this.value) && parseFloat(this.form.obj_prix_vente.value) > 0)) {this.form.btnModif.disabled=false;} else {this.form.btnModif.disabled=true;}"
							onkeyup="if ((parseFloat(this.form.obj_prix_vente.value)  !=parseFloat(this.value) && parseFloat(this.form.obj_prix_vente.value) > 0)) {this.form.btnModif.disabled=false;} else {this.form.btnModif.disabled=true;}"
							
						<br />&nbsp;
					</span>
					<span class="col-md-6">
						<br /><input type=button value="Demander la mise à jour" name="btnModif" onclick='addDemande()' disabled>
						<br />&nbsp;
					</span>
				</div>
			</div>
		</div>


		<hr />
		<div class="row" id="divPrix" style='display:none;'>
			<!-- PRIX vente -->
			<div class="col-sm-4 col-md-4 col-xs-4">
				<span class="titrow col-md-6 col-sm-6  col-xs-12">PRIX :</span>
				<span class="tabl1 col-md-6 col-sm-6 col-xs-12">
					<? if (($infAppli['ADMIN']) && $GET_modePage != "create") { ?>
						<input type=number name="obj_prix_vente" size=5 maxlength="10" tabindex=<?= $tabindex++ ?> onkeyup="setStartSaisie(true);" onchange="affectPrix();" title="Prix vente" required step="0.1" min="0" placeholder="00.00" />&nbsp;&#8364;
					<? } else { ?>
						<input type=hidden name="obj_prix_vente">
						&nbsp&nbsp<span id="obj_prix_vente">0.00</span>&nbsp;&#8364;&nbsp <span id="date_vente">
						</span>
					<? } ?>
			</div>
			<!-- depot  -->
			<div class="col-sm-4 col-md-4 col-xs-4">
				<span class="titrow col-md-6 col-sm-6 col-xs-12">Depot :</span>
				<span class="tabl1 col-md-6 col-sm-6 col-xs-12">
					&nbsp&nbsp<span id="depot_calc">...</span>&nbsp;&#8364;
				</span>
			</div>
			<!-- commision  -->
			<div class="col-sm-4 col-md-4 col-xs-4">
				<span class="titrow  col-md-6 col-sm-6 col-xs-12">Commission :</span>
				<span class="tabl1 col-md-6 col-sm-6 col-xs-12">
					&nbsp&nbsp<span id="comission_calc">...</span>&nbsp;&#8364;
				</span>
			</div>
		</div>
	</fieldset>

	

	<!-- BARRE ACTION -->
	<!-- BARRE ACTION -->
	<!-- BARRE ACTION -->
	<!-- BARRE ACTION -->
	<div class="row fiche">
		<div class="col-sm-12 col-md-12 col-xs-12" id="tdCGU">
			<input type="checkbox" name="checkCGU" required />Je déclare avec lu et pris connaissance des
			<A HREF="downloads/CGU_BAV_2019.pdf" target="_blanck">CGU</A>
		</div>

		<div class="col-sm-3 col-md-3 col-xs-6 btnAction" id="tdBtnAction">
			<!-- etat vide pour reconnaitre une action de modif simple -->
			<button name="buttonValideFiche" tabindex=<?= $tabindex++ ?> disabled>Enregistrer
			</button>
		</div>
		<div class="col-sm-3 col-md-3 col-xs-6 btnAction" style='display:none' id="tdBtnPdf">
			<input type=button value="Impression Fiche" onclick="imprimeFiche()" name="buttonPDFFiche" tabindex=<?= $tabindex++ ?>>
			<? if ($infAppli['ADMIN']) { ?>
				<input type=button value="Impression Etiquette" onclick="imprimeEtiquette()" name="buttonPDFEtiquette" tabindex=<?= $tabindex++ ?> style="display:none">
			<? } ?>
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
			<div class="col-sm-6 col-md-6 col-xs-12">
				<span class="titrow  col-md-3 col-sm-3 col-xs-3">Nom et prénom <span title="Obligatoire">*</span></span>
				<span class="tabInput col-md-9 col-sm-9 col-xs-9">
					<input type=text name='ach_nom' tabindex=<?= $tabindex++ ?> size="50" maxlength="100" onblur='searchAchByName(this.value)' list='listAcheteurName' />
					<datalist id="listAcheteurName"></datalist>
				</span>
			</div>
			<div class="col-sm-6 col-md-6 col-xs-12">
				<span class="titrow  col-md-3 col-sm-3 col-xs-3">Code postal</span>
				<span class="tabInput col-md-9 col-sm-9 col-xs-9">
					<input type=text name="ach_code_postal" size=5 maxlength='10' tabindex=<?= $tabindex++ ?> placeholder="Code postal" onkeyup="setStartSaisie(true);" />
				</span>
			</div>
		</div>
	</fieldset>
</form>