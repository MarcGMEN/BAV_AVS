<script>
	var idFiche='<?=$GET_id?>';
	// pour rendre le champ nom du client unique
	<?php $idRamdom = rand(1000, 9999);?>
	var idRamdom="<?=$idRamdom?>";
</script>

<script src="JS/fiche.js" type="text/javascript">
</script>

<form name="ficheForm" method="POST" onsubmit="return submitForm()" action="">
	<input type=hidden name="obj_id" />
	cli_id <i id=cli_id ></i>
	<input type=hidden name="cli_id" />
	<fieldset class=fiche>
		<legend class=titreFiche>Le depot</legend>
		<table width=100% cellpadding=4 cellspacing=0>
			<!-- Pas en creation -->
			<tr id='trTitreFiche' style='display: none'>
				<td colspan=10>
					<table width="100%" class="tittab" cellpadding=0 cellspacing=0 >
						<tr>
							<td class="titrow" width=8%>No Fiche</td>
							<td class="tabl1" width=25%>
								<input type="hidden" name="obj_numero" />
								<span id='obj_numero'></span>
							</td>
							<td class="tabl1" width=18%  >
								<span id="obj_etat"></span>
								<input type="hidden" name="obj_etat" />
								<input type="hidden" name="obj_etat_new" />
								<span>
							<td class="fiche tabl1" width=15% id="tdBtnEtat" style="display:none" >
								<input type=submit  name="buttonEtatFiche" 
									tabindex=<?=$tabindex++?> />
								<input type=submit  name="buttonEtatFicheBis" style="display:none" 
									onclick="this.form.obj_etat_new.value='RENDU'" tabindex=<?=$tabindex++?> />
								</span>
							</td>
							<td class="titrow" width=8%>ID</td>
							<td class="tabl1" width=25%>
								<span id='obj_id_modif'></span>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td class="titrow" width=8%>Type</td>
				<td class="tabInput" width=25%>
					<select name='obj_type' tabindex=<?=$tabindex++?>
						onchange="setStartSaisie(true);">
					</select>
				</td>
				<td class="titrow" width=8%>Public</td>
				<td class="tabInput" width=25%>
					<select name='obj_public' tabindex=<?=$tabindex++?>
						onchange="setStartSaisie(true);">
					</select>
				</td>
				<td class="titrow" width=8%>Pratique</td>
				<td class="tabInput" width=25%>
					<select name='obj_pratique' tabindex=<?=$tabindex++?>
						onchange="setStartSaisie(true);">
					</select>
				</td>
			</tr>
			<tr>
				<td class="titrow">Marque <span title="Obligatoire">*<span></td>
				<td class="tabInput">
					<input type=text list="listMarques" name="obj_marque_<?=$idRamdom?>"
					 size=30 maxlength="50" tabindex=<?=$tabindex++?>
					style="text-transform:uppercase"
					placeholder="Marque du vélo" onkeyup="setStartSaisie(true);" required/>
					<datalist id="listMarques"></datalist>
				</td>
				<td class="titrow">Modele</td>
				<td class="tabInput">
					<input type=text name="obj_modele" size=30 maxlength="50" tabindex=<?=$tabindex++?>
					style="text-transform:uppercase"
					placeholder="Nom du vélo"
					onkeyup="setStartSaisie(true);"/>
				</td>
				<td class="titrow">Couleur <span title="Obligatoire">*<span></td>
				<td class="tabInput">
					<input type=text name="obj_couleur" size=20 maxlength="30" tabindex=<?=$tabindex++?>
					style="text-transform:uppercase"
					placeholder="Couleurs dominantes" onkeyup="setStartSaisie(true);" required/>
				</td>
			</tr>
			<tr>
				<td colspan=10>
					<table width="100%" cellpadding=0 cellspacing=0>
						<tr>
							<td class="titrow" width=8%>Description</td>
							<td class="tabInput" width=20%>
								<textarea rows="5" cols="95" tabindex=<?=$tabindex++?>
								name="obj_description"  onkeyup="setStartSaisie(true);"
								placeholder="Année d'achat, prix d'achat, taille, accessoires, révision (transmission, pneus, freins..)">Taille :
Prix d'achat : 
Année d'achat : 
.....</textarea>
							</td>
							<td class="help link" onclick="inverseLayer('aide_descript')" width="1%">?</td>
							<td class="help">
								<div id="aide_descript" style="visibility: hidden;">
Année d'achat, prix d'achat, taille, accessoires, révision (transmission, pneus, freins..)
								</div>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td class="titrow">Prix</td>
				<td class="tabInput">
					<input type=number name="obj_prix_depot" size=5 maxlength="10" tabindex=<?=$tabindex++?>
					onkeyup="setStartSaisie(true);" onchange="affectPrix();"
					title="Prix vente, vous pouvez le laisser vide et le renseigner le jour du dépôt." 
					placeholder="00.00"/>&#8364;
					</span>
				</td>
			</tr>
			<tr>
				<td colspan=10>
					<hr />
				</td>
			</tr>
			<!-- vue uniqueTABLE -->
			<tr id=trPrix style='display:none'>
				<td class="titrow">
					PRIX : </span>
				</td>
				<td class="tabl1">
					<input type=hidden name="obj_prix_vente">
					&nbsp&nbsp<span id="obj_prix_vente">0.00</span>&#8364;&nbsp <span id="date_vente">
				</td>
				<td class="titrow">Depot : </td>
				<td class="tabl1">
					&nbsp&nbsp<span id="depot_calc">...</span>&#8364;
				</td>
				<td class="titrow">Com : </td>
				<td class="tabl1">
					&nbsp&nbsp<span id="comission_calc">...</span>&#8364;
				</td>
			</tr>
		</table>
		<fieldset class=fiche>
			<legend class=titreFiche id='legendVendeur'>Le vendeur</legend>
			<table width=100% cellpadding=2 cellspacing=2>
				<tr>
				<tr>
					<td class="titrow" width="10%">Emel <span title="Obligatoire">*<span></td>
					<td class="tabInput" width=40%>
						<input type=email name='cli_emel' id="cli_emel" size="50" maxlength="100" tabindex=<?=$tabindex++?>
						placeholder="aaaa.bbbb@ccc.dd" required onkeyup="keyUpMel()"
						onblur='x_return_oneClientByMel(this.value, display_infoClientVendeur)'
						list='listVendeur'/>
						<datalist id="listVendeur"></datalist>
					<td class="titrow" width=10%>Nom/prenom <span title="Obligatoire">*<span></td>
					<td class="tabInput" width=40%>
						<input type=text name='cli_nom' tabindex=<?=$tabindex++?>
						size="50" maxlength="100" required onkeyup="setStartSaisie(true);"/>

					</td>
				</tr>
				<tr>
					<td class="titrow">Adresse</td>
					<td class="tabInput">
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
					</td>
					<td class="titrow">Telephone</td>
					<td class="tabInput">
						<input type=text name='cli_telephone' size="15" maxlength="15" tabindex=<?=$tabindex++?>
						placeholder="Pour vous joindre durant la bourse" onkeyup="setStartSaisie(true);"
						title="Pour vous joindre durant la bourse"/>
						<input type=text name='cli_telephone_bis' size="15" maxlength="15" tabindex=<?=$tabindex++?>
						placeholder="autre numéro" onkeyup="setStartSaisie(true);"
						title="autre numéro"/>
					</td>
				</tr>
				<!-- TODO : juste TABLE -->
				<tr id=trTauxCom style='display:none'>
					<td class="titrow">Taux commission</td>
					<td class="tabInput" %>
						<select name='cli_taux_com' tabindex=<?=$tabindex++?>
							onchange="affectPrix();setStartSaisie(true);"></select>%
					</td>
					<td class="titrow">Tarif Depot</td>
					<td class="tabInput">
						<select name='cli_prix_depot' tabindex=<?=$tabindex++?>
							onchange="affectPrix();setStartSaisie(true);"></select>&#8364;
					</td>
				</tr>
			</table>
		</fieldset>
	</fieldset>
	<table width=100% class=fiche>
		<tr>
			<td colspan=3 class="cgu" id="tdCGU">
				<input type="checkbox" name="checkCGU" required />Je déclare avec lu et pris connaissance des
				<A HREF="data/CGU.pfg" target="_blanck">CGU</A>
			</td>
		</tr>
		<tr>
			<td width=25% class="btnAction">
				<button name="buttonValideFiche" tabindex=<?=$tabindex++?> disabled 
					onclick="this.form.obj_etat_new.value=''">Enregristrer
				</button>
			</td>
			<td width=25% class="btnAction" style='display:none'>
				<button name="buttonValideBisFiche" tabindex=<?=$tabindex++?>>???????
				</button>
			</td>

			<td width=25% align=center id="tdBtnPdf" style='display:none'>
				<input type=button value="Impression" onclick="imprimeFiche()" name="buttonPDFFiche" tabindex=<?=$tabindex++?>>
			</td>
			<td width=25% align=center id="tdBtnSup" style='display:none'>
				<input type=button value="Supprimer" name="buttonSupprimeFiche" onclick="supprimerFiche()" tabindex=<?=$tabindex++?>
				>
			</td>
			<td width=25% align=center>
				<input type=button value="Annuler" onclick="fermerCRUD()" tabindex=<?=$tabindex++?>>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
	</table>

	<fieldset class=fiche style='display:none' id="fieldSetAcheteur">
			<legend class=titreFiche>L'acheteur</legend>
			<table width=100% align=center cellpadding=2 cellspacing=2>
				<tr>
				<tr>
					<td class="titrow" width="10%">Emel </td>
					<td class="tabInput" width=40% id="ach_emel">
					<td class="titrow" width=10% >Nom/prenom </td>
					<td class="tabInput" width=40% id='ach_nom'></td>
				</tr>
				<tr>
					<td class="titrow">Adresse</td>
					<td class="tabInput">
						<div id='ach_adresse' ></div>
						<div id='ach_adresse1' ></div>
						<div id='ach_code_postal'></div>
						<div id='ach_ville'></div>
					</td>
					<td class="titrow">Telephone</td>
					<td class="tabInput">
						<div id='ach_telephone' ></div>
						<div id='ach_telephone_bis' ></div>
					</td>
				</tr>
			</table>
		</fieldset>
	</fieldset>
</form>