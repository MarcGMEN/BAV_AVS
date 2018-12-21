<?$idRamdom = rand(1000, 9999);?>
<script>
	var idFiche = '<?=$GET_id?>';
	// pour rendre le champ nom du client unique
	var idRamdom = "<?=$idRamdom?>";
</script>

<script src="JS/fiche.js" type="text/javascript"></script>

<form name="ficheForm" method="POST" onsubmit="return submitForm()" action="">
	<input type=hidden name="obj_id" />
	cli_id <i id=cli_id></i>
	<input type=hidden name="cli_id" />
	<fieldset class=fiche>
		<legend class=titreFiche>Le depot</legend>
		<div class="row tittab" id='trTitreFiche' style='display: none'>
			<div class="col-sm-4 col-md-4 col-xs-4">
				<span class="titrow col-md-3 col-sm-3 col-xs-3" width=20%>No</span>
				<span class="tabl1 col-md-9 col-sm-9 col-xs-9">
					<input type="hidden" name="obj_numero" />
					<span id='obj_numero'></span>
				</span>
			</div>
			<div class="col-sm-4 col-md-4 col-xs-4">
				<div class="col-sm-6 col-md-6 col-xs-6 tabl1">
					<span id="obj_etat"></span>
					<input type="hidden" name="obj_etat" />
					<input type="hidden" name="obj_etat_new" />
				</div>
				<div class="col-sm-6 col-md-6 col-xs-6 tabl1" id="tdBtnEtat"  style='display: none'>
				<input type=submit name="buttonEtatFiche" tabindex=<?=$tabindex++?>	/>
				<input type=submit name="buttonEtatFicheBis" style="display:none" onclick="this.form.obj_etat_new.value='RENDU'"
					 tabindex=<?=$tabindex++?> />
				</div>
			</div>
			<div class="col-sm-4 col-md-4 col-xs-4">
				<span class="titrow col-md-3 col-sm-3 col-xs-3" width=20%>ID</span>
				<span class="tabl1 col-md-9 col-sm-9 col-xs-9">
					<span id='obj_id_modif'></span>
				</span>
			</div>
		</div>
		
		<div class="row">
			<div class="col-sm-4 col-md-4 col-xs-12">
				<span class="titrow col-md-3 col-sm-3 col-xs-3" width=20%>Type</span>
				<span class="tabInput col-md-9 col-sm-9 col-xs-9">
					<select name='obj_type' tabindex=<?=$tabindex++?>
						onchange="setStartSaisie(true);">
					</select>
				</span>
			</div>
			<div class="col-sm-4 col-md-4 col-xs-12">
				<span class="titrow  col-md-3 col-sm-3 col-xs-3">Public</span>
				<span class="tabInput col-md-9 col-sm-9 col-xs-9">
					<select name='obj_public' tabindex=<?=$tabindex++?>
						onchange="setStartSaisie(true);">
					</select>
				</span>
			</div>
			<div class="col-sm-4 col-md-4 col-xs-12">
				<span class="titrow col-md-3 col-sm-3 col-xs-3">Pratique</span>
				<span class="tabInput col-md-9 col-sm-9 col-xs-9">
					<select name='obj_pratique' tabindex=<?=$tabindex++?>
						onchange="setStartSaisie(true);">
					</select>
				</span>
			</div>
			<div class="col-sm-4 col-md-4 col-xs-12">
				<span class="titrow  col-md-3 col-sm-3 col-xs-3">Marque <span title="Obligatoire">*</span></span>
				<span class="tabInput col-md-9 col-sm-9 col-xs-9">
					<input type=text list="listMarques" name="obj_marque_<?=$idRamdom?>"
					 size=30 maxlength="50" tabindex=<?=$tabindex++?>
					style="text-transform:uppercase"
					placeholder="Marque du vélo" onkeyup="setStartSaisie(true);"
					onblur="x_return_list_modeles(this.value,display_list_modeles)" required/>
					<datalist id="listMarques"></datalist>
				</span>
			</div>
			<div class="col-sm-4 col-md-4 col-xs-12">
				<span class="titrow  col-md-3 col-sm-3 col-xs-3">Modele</span>
				<span class="tabInput col-md-9 col-sm-9 col-xs-9">
					<input type=text name="obj_modele" size=30 maxlength="50" tabindex=<?=$tabindex++?>
					style="text-transform:uppercase" list="listModeles"
					placeholder="Nom du vélo"
					onkeyup="setStartSaisie(true);"/>
					<datalist id="listModeles"></datalist>
				</span>
			</div>
			<div class="col-sm-4 col-md-4 col-xs-12">
				<span class="titrow  col-md-3 col-sm-3 col-xs-3">Couleur <span title="Obligatoire">*</span></span>
				<span class="tabInput col-md-9 col-sm-9 col-xs-9">
					<input type=text name="obj_couleur" size=20 maxlength="30" tabindex=<?=$tabindex++?>
					style="text-transform:uppercase"
					placeholder="Couleurs dominantes" onkeyup="setStartSaisie(true);" required/>
				</span>
			</div>

			<div class="col-sm-8 col-md-8 col-xs-12">
				<span class="titrow col-md-2 col-sm-2 col-xs-3">Description
					<span class="help link" onclick="inverseLayer('aide_descript')">?</span>
				</span>
				<span class="tabInput col-md-10 col-sm-10 col-xs-9">
					<textarea rows="5" cols=300 tabindex=<?=$tabindex++?>
						name="obj_description"  onkeyup="setStartSaisie(true);"
						placeholder="Année d'achat, prix d'achat, taille, accessoires, révision (transmission, pneus, freins..)">Taille :
Prix d'achat : 
Année d'achat : 
.....</textarea>
				</span>
			</div>
			<div class="col-sm-4 col-md-4 col-xs-12">
				<span class="col-md-12 col-sm-12 col-xs-12 help">
					<div id="aide_descript" style="visibility: hidden;">
						Année d'achat, prix d'achat, taille, accessoires, révision (transmission, pneus, freins..)
					</div>
				</span>
			</div>
			<div class="col-sm-8 col-md-8 col-xs-12">
				<span class="titrow col-md-2 col-sm-2 col-xs-3">Prix</span>
				<span class="tabInput col-md-10 col-sm-10 col-xs-9">
					<input type=number name="obj_prix_depot" size=5 maxlength="10" tabindex=<?=$tabindex++?>
					onkeyup="setStartSaisie(true);" onchange="affectPrix();"
					title="Prix vente, vous pouvez le laisser vide et le renseigner le jour du dépôt."
					placeholder="00.00"/>&#8364;
				</span>
			</div>
		</div>
		<hr />
		<div class="row" id="divPrix" style='display:none'>
			<!-- vue uniqueTABLE -->
			<div class="col-sm-4 col-md-4 col-xs-4">
				<span class="titrow  col-md-3 col-sm-3 col-xs-12">PRIX :</span>
				<span class="tabl1 col-md-9 col-sm-9 col-xs-12">
					<input type=hidden name="obj_prix_vente">
					&nbsp&nbsp<span id="obj_prix_vente">0.00</span>&#8364;&nbsp <span id="date_vente">
					</span>
			</div>
			<div class="col-sm-4 col-md-4 col-xs-4">
				<span class="titrow col-md-3 col-sm-3 col-xs-12">Depot :</span>
				<span class="tabl1 col-md-9 col-sm-9 col-xs-12">
					&nbsp&nbsp<span id="depot_calc">...</span>&#8364;
				</span>
			</div>
			<div class="col-sm-4 col-md-4 col-xs-4">
				<span class="titrow  col-md-3 col-sm-3 col-xs-12">Commission :</span>
				<span class="tabl1 col-md-9 col-sm-9 col-xs-12">
					&nbsp&nbsp<span id="comission_calc">...</span>&#8364;
				</span>
			</div>
		</div>
	</fieldset>
	<fieldset class=fiche>
		<legend class=titreFiche id='legendVendeur' onclick='goTo("client.php","consult",document.ficheForm.cli_id.value,"")'>
			Le vendeur
		</legend>
		<div class="row">
			<div class="col-sm-6 col-md-6 col-xs-12">
				<span class="titrow  col-md-3 col-sm-3 col-xs-3">Emel <span title="Obligatoire">*</span></span>
				<span class="tabInput col-md-9 col-sm-9 col-xs-9">
					<input type=email name='cli_emel' id="cli_emel" size="50" maxlength="100" tabindex=<?=$tabindex++?>
						placeholder="aaaa.bbbb@ccc.dd" required onkeyup="keyUpMel()"
						onblur='x_return_oneClientByMel(this.value, display_infoClientVendeur)'
						list='listVendeur'/>
						<datalist id="listVendeur"></datalist>
				</span>
			</div>
			<div class="col-sm-6 col-md-6 col-xs-12">
				<span class="titrow  col-md-3 col-sm-3 col-xs-3">Nom/prenom <span title="Obligatoire">*</span></span>
				<span class="tabInput col-md-9 col-sm-9 col-xs-9">
					<input type=text name='cli_nom' tabindex=<?=$tabindex++?>
					size="50" maxlength="100" required onkeyup="setStartSaisie(true);"/>
				</span>
			</div>
			<div class="col-sm-6 col-md-6 col-xs-12">
				<span class="titrow  col-md-3 col-sm-3 col-xs-3">Adresse</span>
				<span class="tabInput col-md-9 col-sm-9 col-xs-9">
					<input type=text name="cli_adresse" size=50 maxlength='100' tabindex=<?=$tabindex++?>
					placeholder="Adresse" onkeyup="setStartSaisie(true);"/>
					<br />
					<input type=text name="cli_adresse1" size=50 maxlength='100' tabindex=<?=$tabindex++?>
					placeholder="Complement adresse" onkeyup="setStartSaisie(true);"/>
					<br />
					<input type=text name="cli_code_postal" size=5 maxlength='10' tabindex=<?=$tabindex++?>
					placeholder="Code postal" onkeyup="setStartSaisie(true);"/>
					<input type=text name="cli_ville" size=40 maxlength='100' tabindex=<?=$tabindex++?>
					placeholder="Ville" />
				</span>
			</div>
			<div class="col-sm-6 col-md-6 col-xs-12">
				<span class="titrow  col-md-3 col-sm-3 col-xs-3">Telephone</span>
				<span class="tabInput col-md-9 col-sm-9 col-xs-9">
					<input type=text name='cli_telephone' size="15" maxlength="15" tabindex=<?=$tabindex++?>
					placeholder="Pour vous joindre durant la bourse" onkeyup="setStartSaisie(true);"
					title="Pour vous joindre durant la bourse"/>
					<input type=text name='cli_telephone_bis' size="15" maxlength="15" tabindex=<?=$tabindex++?>
					placeholder="autre numéro" onkeyup="setStartSaisie(true);"
					title="autre numéro"/>
				</span>
			</div>
		</div>
		<div class="row" id=trTauxCom style='display:none'>
			<!-- TODO : juste TABLE -->
			<div class="col-sm-6 col-md-6 col-xs-12"  >
				<span class="titrow  col-md-3 col-sm-3 col-xs-3">Taux commission<</span>
				<span class="tabInput col-md-9 col-sm-9 col-xs-9">
					<select name='cli_taux_com' tabindex=<?=$tabindex++?>
						onchange="affectPrix();setStartSaisie(true);"></select>%
				</span>
			</div>
			<div class="col-sm-6 col-md-6 col-xs-12" >
				<span class="titrow  col-md-3 col-sm-3 col-xs-3">Tarif Depot<</span>
				<span class="tabInput col-md-9 col-sm-9 col-xs-9">
					<select name='cli_prix_depot' tabindex=<?=$tabindex++?>
						onchange="affectPrix();setStartSaisie(true);"></select>&#8364;
				</span>
			</div>
		</div>
	</fieldset>
	<div class="row fiche" >
		<div class="col-sm-12 col-md-12 col-xs-12" id="tdCGU">
			<input type="checkbox" name="checkCGU" required />Je déclare avec lu et pris connaissance des
			<A HREF="data/CGU.pfg" target="_blanck">CGU</A>
		</div>

		<div class="col-sm-3 col-md-3 col-xs-6 btnAction" id="tdBtnAction" >
			<button name="buttonValideFiche" tabindex=<?=$tabindex++?> disabled onclick="this.form.obj_etat_new.value=''">Enregristrer
			</button>
		</div>
<!--		<div class="col-sm-3 col-md-3 col-xs-6 btnAction" style='display:none'>
			<button name="buttonValideBisFiche" tabindex=<?=$tabindex++?>>???????</button>
		</div>-->
		<div class="col-sm-3 col-md-3 col-xs-6 btnAction" style='display:none' id="tdBtnPdf">
			<input type=button value="Impression" onclick="imprimeFiche()" name="buttonPDFFiche" tabindex=<?=$tabindex++?>>
		</div>
		<div class="col-sm-3 col-md-3 col-xs-6 btnAction" style='display:none' id="tdBtnSup">
			<input type=button value="Supprimer" name="buttonSupprimeFiche" onclick="supprimerFiche()" tabindex=<?=$tabindex++?> />
		</div>
		<div class="col-sm-3 col-md-3 col-xs-6 btnAction"  >
			<input type=button value="Annuler" onclick="fermerCRUD()" tabindex=<?=$tabindex++?>>
		</div>
	</div>

	<fieldset class=fiche style='display:none' id="fieldSetAcheteur">
		<legend class=titreFiche>L'acheteur</legend>
		<div class="row">
			<div class="col-sm-6 col-md-6 col-xs-12">
				<span class="titrow  col-md-3 col-sm-3 col-xs-3">Emel </span>
				<span class="tabInput col-md-9 col-sm-9 col-xs-9" id="ach_emel">
				</span>
			</div>
			<div class="col-sm-6 col-md-6 col-xs-12">
				<span class="titrow  col-md-3 col-sm-3 col-xs-3">Nom/prenom </span></span>
				<span class="tabInput col-md-9 col-sm-9 col-xs-9" id="ach_nom">
				</span>
			</div>
			<div class="col-sm-6 col-md-6 col-xs-12">
				<span class="titrow  col-md-3 col-sm-3 col-xs-3">Adresse</span>
				<span class="tabInput col-md-9 col-sm-9 col-xs-9" >
					<div id='ach_adresse'></div>
					<div id='ach_adresse1'></div>
					<div id='ach_code_postal'></div>
					<div id='ach_ville'></div>
				</span>
			</div>
			<div class="col-sm-6 col-md-6 col-xs-12">
				<span class="titrow  col-md-3 col-sm-3 col-xs-3">Telephone</span>
				<span class="tabInput col-md-9 col-sm-9 col-xs-9">
					<div id='ach_telephone'></div>
					<div id='ach_telephone_bis'></div>
				</span>
			</div>
		</div>
	</fieldset>
</form>