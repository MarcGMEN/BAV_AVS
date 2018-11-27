<script>
	// mode de fonctionnement de la page
	// create : creation d'une fiche CLIENT
	// update : modification par le client avec ID_FICHE
	// 
	

	/*
	 * action lors du chargement de la page
	 */
	function initPage() {
		x_return_enum('objet','obj_type',display_list_type);
		x_return_enum('objet','obj_public',display_list_public);
		x_return_enum('objet','obj_pratique',display_list_pratique);

		x_return_list_marques(display_list_marques)
		// chargement des taux
		x_return_tauxBAV(display_list_taux_com);
		// chargement des depot
		x_return_depotsBAV(display_list_prix_depot);
		
		getElement("obj_type").focus();
	}

	// recuperation des donnees de la BAV
	function setParamVal(val) {
		if (TABLE || ADMIN) {
			getElement("trTauxCom").style.display='table-row';
			getElement("trPrix").style.display='table-row';
		}
		getElement("mode").innerHTML="fiche.php "+modePage+"-"+TABLE+"-"+ADMIN;
	}


	/*
	 * action lors du derchargement de la page
	 */
	function unloadPage() {

	}

	function display_list_marques(val) {
		var list = getElement("listMarques");
		for(index in val) {
			list.appendChild(new Option(val[index], val[index]));
		}
	}

	/*
	 * affichage de la liste de type possible
	 */
	function display_list_type(val) {
		var select = getElement("obj_type");
		for(index in val) {
			    select.appendChild(new Option(val[index], val[index]));
		}
	}
	/*
	 * affichage de la liste de pratique possible
	 */
	function display_list_pratique(val) {
		var select = getElement("obj_pratique");
		for(index in val) {
			    select.appendChild(new Option(val[index], val[index]));
		}
	}
	 /*
	 * affichage de la liste de public possible
	 */
	function display_list_public(val) {
		var select = getElement("obj_public");
		for(index in val) {
			select.appendChild(new Option(val[index], val[index]));
		}
	}

	var tabTauxCom;
	function display_list_taux_com(val) {
		tabTauxCom=val;
		var select = getElement("cli_taux_com");
		for(index in val) {
		    select.appendChild(new Option(val[index], val[index]));
			if (index == 0) {
				select.selectedIndex=val[index];
			}
		}
	}
	var tabPrixDepot;
	function display_list_prix_depot(val) {
		tabPrixDepot=val;
		var select = getElement("cli_prix_depot");
		for(index in val) {
			select.appendChild(new Option(val[index], val[index]));
			if (index == 0) {
				select.selectedIndex=val[index];
			}

		}
	}

	// pour rendre le champ nom du client unique
	<?php $idRamdom = rand(1000, 9999);?>
	var idRamdom="<?=$idRamdom?>";

	function submitForm() {
		if (modePage == 'create') {
            enregisterFiche();
		}

        return false;
	}

	var tabCli;
	var tabObj;
	// validation de la fiche
	function enregisterFiche() 	{
		//todo : fabrication du texte de confirmation
		tabObj = recup_formulaire(document.ficheForm, 'obj');
		tabCli = recup_formulaire(document.ficheForm, 'cli');
		tabObj['obj_marque']=document.ficheForm.elements.namedItem('obj_marque_'+idRamdom).value;
		delete tabObj['obj_marque_'+idRamdom];
		
		var repr="";
		repr += "Vous enregistrez un dépôt pour : <br/><ul>";
		repr += "<li><b>"+tabObj['obj_type']+" "+tabObj['obj_public']+"</b> avec une pratique : <b>"+
			tabObj['obj_pratique']+"</b></li>";
		repr += "<li><b>"+tabObj['obj_marque']+" - "+tabObj['obj_modele']+"</b> de couleur : <b>"+
			tabObj['obj_couleur']+"</b></li>";
		repr += "<li> Description : \"<b>"+tabObj['obj_description']+"</b>\"</li>";
		if (tabObj['obj_prix_depot']) {
			repr += "<li> PRIX : <b>"+tabObj['obj_prix_depot']+" &#8364;</b></li><br/>";
		} else {
			repr += "<li> PRIX : <b>A renseigner le jour du dépôt tard</b></li><br/>";
		}
			
		repr += "<li> Vous : <b>"+tabCli['cli_nom']+" ("+tabCli['cli_telephone']+") <br/><blockquote> ";
		repr += tabCli['cli_adresse']+" "+tabCli['cli_adresse1']+" ["+tabCli['cli_code_postal']+"] "+
			tabCli['cli_ville']+"</b></blockquote></li><br/>";
		repr += "Vous allez recevoir un mel à l'adresse <b>"+tabCli['cli_emel']+"</b> pour confirmer ce dépot.<br/>";
		repr += "Une fois cette confirmation effectuée, vous recevrez la "+
			"fiche de dépôt ainsi que les instructions de dépôt.";

        alertModalConfirm(repr, "Fiche");
		return false;
	}

	/**click sur btn cofirm de modalFiche */
	function confirmModalFiche() {
        // enregistrement
        console.log(tabObj);
        console.log(tabCli);
        // stockage cli_id en cookies

        x_action_createFiche(tabToString(tabObj), tabToString(tabCli), display_fin_create);

        // envoi mel
	}	
	
	function display_fin_create(val) {
		// retour sur la fiche en mode Page actuel
		//goTo('fiche.php',modePage);
	}


	function supprimerFiche(laForm) {
		if (confirm("Suppresion de la fiche "+laForm.obj_numero.value+" ?")) {
			laForm.action.value="ficheSupprimer";
			laForm.submit();
		}
	}

	// bouton ANNULER
	function fermerCRUD(LaForm) {
		suite=true;
		if (startSaisie) {
			alertModalConfirm("<br/><br/><center>Vous avez des modifications en cours<center>","Close")
		}
		else {
            confirmModalClose();
		}
	}

    // click de le bouton conform de modalClose;
	function confirmModalClose() {
		closeModal();
		setStartSaisie(false);
		goTo();
	}


	function display_infoClientVendeur(val) {
        console.log(val);
		display_formulaire(val,document.ficheForm);
	}

	</script>


<form name="ficheForm" method="POST" onsubmit="return submitForm()" action="">
	<fieldset class=fiche>
		<legend class=titreFiche>Le depot</legend>
		<table width=100% cellpadding=2 cellspacing=2>
			<!-- Pas en creation -->
			<tr>
				<td colspan=10>
					<table width="100%" class="tittab" cellpadding=0 cellspacing=0>
						<tr>
							<td class="titrow" width=8%>No Fiche</td>
							<td class="tabl1" width=25%>
								<span id='obj_numero'></span>
							</td>
							<td class="tabl1" width=33% colspan=2>CONFIRME - STOCK - VENDU - RETOUR</td>
							<td class="titrow" width=8%>ID</td>
							<td class="tabl1" width=25%>
								<span id='obj_id_fiche'></span>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td class="titrow" width=8%>Type</td>
				<td class="tabInput" width=25%>
					<select name='obj_type' id='obj_type' tabindex=<?=$tabindex++?>
						onchange="setStartSaisie(true);">
					</select>
				</td>
				<td class="titrow" width=8%>Public</td>
				<td class="tabInput" width=25%>
					<select name='obj_public' id='obj_public' tabindex=<?=$tabindex++?>
						onchange="setStartSaisie(true);">
					</select>
				</td>
				<td class="titrow" width=8%>Pratique</td>
				<td class="tabInput" width=25%>
					<select name='obj_pratique' id='obj_pratique' tabindex=<?=$tabindex++?>
						onchange="setStartSaisie(true);">
					</select>
				</td>
			</tr>
			<tr>
				<td class="titrow">Marque <abbr title="Ce champ est obligatoire">*</abbr></td>
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
					onkeyup="setStartSaisie(true);"/>
				</td>
				<td class="titrow">Couleur <span title="Obligatoire">*<span></td>
				<td class="tabInput">
					<input type=text name="obj_couleur" size=20 maxlength="30" tabindex=<?=$tabindex++?>
					style="text-transform:uppercase"
					placeholder="Couleurs dominante" onkeyup="setStartSaisie(true);" required/>
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
								placeholder="Année d'achat, prix d'achat, taille, accessoires, révision (transmission, pneus, freins..)"></textarea>
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
					<input type=text name="obj_prix_depot" size=5 maxlength="10" tabindex=<?=$tabindex++?>
					onkeyup="setStartSaisie(true);"
					title="Prix vente, vous pouvez le laisser vide et le renseigner le jour du dépôt." placeholder="00.00"/>&#8364;
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
					&nbsp&nbsp<span id="prix_vente">0.00</span>&#8364;&nbsp <span id="date_vente">
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
			<legend class=titreFiche>Le vendeur</legend>
			<table width=100% align=center cellpadding=2 cellspacing=2>
				<tr>
				<tr>
					<td class="titrow" width="10%">Emel <span title="Obligatoire">*<span></td>
					<td class="tabInput" width=40%>
						<input type=email name='cli_emel' size="50" maxlength="100" tabindex=<?=$tabindex++?>
						placeholder="aaaa.bbbb@ccc.dd" required
						onblur='x_return_oneClientByMel(this.value, display_infoClientVendeur)'/>
					<td class="titrow" width=10%>Nom/prenom <span title="Obligatoire">*<span></td>
					<td class="tabInput" width=40%>
						<input type=text name='cli_nom' tabindex=<?=$tabindex++?>
						size="50" maxlength="100" required />

					</td>
				</tr>
				<tr>
					<td class="titrow">Adresse</td>
					<td class="tabInput">
						<input type=text name="cli_adresse" size=50 maxlength='100' tabindex=<?=$tabindex++?>
						placeholder="Adresse" />
						<br />
						<input type=text name="cli_adresse1" size=50 maxlength='100' tabindex=<?=$tabindex++?>
						placeholder="Complement adresse" />
						<br />
						<input type=text name="cli_code_postal" size=5 maxlength='10' tabindex=<?=$tabindex++?>
						placeholder="Code postal" />
						<input type=text name="cli_ville" size=40 maxlength='100' tabindex=<?=$tabindex++?>
						placeholder="Ville" />
					</td>
					<td class="titrow">Telephone</td>
					<td class="tabInput">
						<input type=text name='cli_telephone' size="15" maxlength="15" tabindex=<?=$tabindex++?>
						placeholder="Pour vous joindre durant la bourse"
						title="Pour vous joindre durant la bourse"/>
						<input type=text name='cli_telephone_bis' size="15" maxlength="15" tabindex=<?=$tabindex++?>
						placeholder="autre numéro"
						title="autre numéro"/>
					</td>
				</tr>
				<!-- TODO : juste TABLE -->
				<tr id=trTauxCom style='display:none'>
					<td class="titrow">Taux commission</td>
					<td class="tabInput" %>
						<select name='cli_taux_com' id='cli_taux_com' tabindex=<?=$tabindex++?>></select>%
					</td>
					<td class="titrow">Tarif Depot</td>
					<td class="tabInput">
						<select name='cli_prix_depot' tabindex=<?=$tabindex++?>
							id='cli_prix_depot'></select>&#8364;
					</td>
				</tr>
			</table>
		</fieldset>
	</fieldset>
	<table width=100% class=fiche>
		<tr>
			<td colspan=3 class="cgu">
				<input type="checkbox" name="checkCGU" required />Je déclare avec lu et pris connaissance des
				<A HREF="data/CGU.pfg" target="_blanck">CGU</A>
			</td>
		</tr>
		<tr>
			<td width=33% class="btnAction">
				<button name="buttonValideFiche" tabindex=<?=$tabindex++?>>Enregristrer
				</button>
			</td>
			<td width=33% align=center>
				<input type=button value="Supprimer" name="buttonSupprimeFiche" onclick="supprimerFiche()" onkeypress="supprimerFiche()"
				 tabindex=<?=$tabindex++?> disabled="disabled"></td>
			<td width=33% align=center>
				<input type=button value="Annuler" onclick="fermerCRUD()" onkeypress="fermerCRUD()" tabindex=<?=$tabindex++?>>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
	</table>
</form>