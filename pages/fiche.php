<script>
	// mode de fonctionnement de la page
	// create : creation d'une fiche CLIENT
	// update : modification par le client avec ID_FICHE
	// 
	

	/*
	 * action lors du chargement de la page
	 */
	function initPage() {
		modePage='<?=$_GET['modePage']?>';	
		x_return_enum('objet','obj_type',display_list_type);
		x_return_enum('objet','obj_public',display_list_public);
		x_return_enum('objet','obj_pratique',display_list_pratique);

		getElement("obj_type").focus();
	}

	// recuperation des donnees de la BAV
	function setParamVal(val) {
		if (TABLE || ADMIN) {

			// chargement des taux
			x_return_tauxBAV(display_list_taux_com);
			// chargement des depot
			x_return_depotsBAV(display_list_prix_depot);
			getElement("trTauxCom").style.display='table-row';
			getElement("trPrix").style.display='table-row';
			
		}
		getElement("mode").innerHTML=modePage+" -"+TABLE+"-"+ADMIN;
	}


	/*
	 * action lors du derchargement de la page
	 */
	function unloadPage() {

	}

	/*
	 * affichage de la liste de type possible
	 */
	function display_list_type(val) {
		var select = getElement("obj_type");
		for(index in val) {
			    select.options[select.options.length] = new Option(val[index], val[index]);
		}
	}
	/*
	 * affichage de la liste de pratique possible
	 */
	function display_list_pratique(val) {
		var select = getElement("obj_pratique");
		for(index in val) {
			    select.options[select.options.length] = new Option(val[index], val[index]);
		}
	}
	 /*
	 * affichage de la liste de public possible
	 */
	function display_list_public(val) {
		var select = getElement("obj_public");
		for(index in val) {
			    select.options[select.options.length] = new Option(val[index], val[index]);
		}
	}

	var tabTauxCom;
	function display_list_taux_com(val) {
		tabTauxCom=val;
		var select = getElement("cli_taux_com");
		for(index in val) {
		    select.options[select.options.length] = new Option(val[index], index);
		}
	}
	var tabPrixDepot;
	function display_list_prix_depot(val) {
		tabPrixDepot=val;
		var select = getElement("cli_prix_depot");
		for(index in val) {
		    select.options[select.options.length] = new Option(val[index], index);
		}
	}

	// pour rendre le champ nom du client unique
	<?php $idRamdomVendeur = rand(1000, 9999);?>
	var idRamdomVendeur="<?=$idRamdomVendeur?>";

	// validation de la fiche
	function ValideFiche(laForm,action) {
		var tab_fiche = new Array();
		var insert=true;

		if (laForm.obj_marque.value == "") {
			 getElement('OBJ_MARQUE_ERR').innerHTML="Champ obligatoire";
			 insert=false;
		}
		else {
			getElement('OBJ_MARQUE_ERR').innerHTML="";
		}
		if (laForm.obj_couleur.value == "") {
			 getElement('OBJ_COULEUR_ERR').innerHTML="Champ obligatoire";
			 //getElement('obj_couleur').className="error";
			 insert=false;
		}
		else {
			getElement('OBJ_COULEUR_ERR').innerHTML="";
			//getElement('obj_couleur').className="";
		}

		var numcheck = /^[0-9]+([\,\.][0-9]+)?$/g;

		if (laForm.obj_prix_depot.value == "0.00" || parseInt(laForm.obj_prix_depot.value) == "0") {
			 getElement('OBJ_PRIX_DEPOT_ERR').innerHTML="Prix supérieur de zero";
			 insert=false;
		}
		else if (laForm.obj_prix_depot.value != "" && !numcheck.test(laForm.obj_prix_depot.value) ){
			getElement('OBJ_PRIX_DEPOT_ERR').innerHTML="Valeur decimale";
		}
		else {
			getElement('OBJ_PRIX_DEPOT_ERR').innerHTML="";
		}

		laForm.cli_nom.value=laForm.elements.namedItem('cli_nom_'+idRamdomVendeur).value;
		if (laForm.cli_nom.value == "") {
			 getElement('VEN_NOM_ERR').innerHTML="Champ obligatoire";
			 insert=false;
		}
		else {
			getElement('VEN_NOM_ERR').innerHTML="";
		}

		if (laForm.cli_emel.value == "") {
			 getElement('VEN_EMEL_ERR').innerHTML="Champ obligatoire";
			 insert=false;
		}
		else {
			 /*if (!valideEmail(laForm.cli_emel.value)) {
				getElement('VEN_EMEL_ERR').innerHTML="Format mel incorrect";
			 	insert=false;
			 }
			 else {*/
			 getElement('VEN_EMEL_ERR').innerHTML="";
			//}
		}

		if (!laForm.checkCGU.checked) {
			getElement('CHEKCGU_ERR').innerHTML="Veuillez valider les CGU";
			insert=false;
		}
		else {
			getElement('CHEKCGU_ERR').innerHTML="";
		}

		if (insert) {
			laForm.lAction=action;
			laForm.submit();
			return true;
		}
		return false;

	}

	function SupprimerFiche(laForm) {
		if (confirm("Suppresion de la fiche "+laForm.obj_numero.value+" ?")) {
			laForm.action.value="ficheSupprimer";
			laForm.submit();
		}
	}

	// bouton ANNULER
	function fermerCRUD(LaForm) {
		suite=true;
		if (startSaisie) {
			if (alertModalConfirm("<br/><br/><center>Vous avez des modifications en cours<center>","Param")) {
				setStartSaisie(false);
			}
			else {
				suite=false;
			}
		}

		if (suite) {
			modePage="select";
			LaForm.action="index.php";
			LaForm.method='post';
			LaForm.submit();
		}
	}
	function confirmModalParam() {
		closeModal();
		document.ficheForm.action="index.php";
		document.ficheForm.method='post';
		document.ficheForm.submit();
	}

	// ***********************************************************
	// ***********************************************************
	// *****VENDEUR
	// ***********************************************************
	// ***********************************************************

	function ResetVendeur(laForm) {
		if (confirm("Modifier le vendeur de ce dépôt ?")) {
			document.ficheForm.action.value="changeVendeur";
			document.ficheForm.submit();
		}
	}

	function RetourVendeur(laForm) {
		if (confirm("Retour au vendeur de ce dépôt ?")) {
			document.ficheForm.action.value="retourVendeur";
			document.ficheForm.submit();
		}
	}

	function ResetRetourVendeur(laForm) {
		if (confirm("Annulation du retour au vendeur de ce dépôt ?")) {
			document.ficheForm.action.value="resetRetourVendeur";
			document.ficheForm.submit();
		}
	}


	function display_vendeur_completion(val) {
		var repr="";
		if (typeof val == "object") {
			repr="<table>";
			for(index in val) {
				repr+="<tr>";
				repr+="<td class='link' onclick='affectVendeur(index)'>";
				repr+=val[index]['cli_nom']+" "+val[index]['cli_prenom']+" ["+val[index]['cli_emel']+"]";
				repr+="</td>";
				repr+="</tr>";
			}
			repr+="</table>";
		}
		else {
			repr=val;
		}
		getElement("autoCompletionVendeur").innerHTML=repr;

	}

	function affectVendeur(index) {
		x_return_client(index, display_vendeur);
		getElement("autoCompletionVendeur").innerHTML="";
	}

	function display_vendeur(val) {

		val['cli_nom_'+idRamdomVendeur]=val['cli_nom'];
		display_formulaire(val,document.vendeurForm);

		document.ficheForm.obj_prix_depot.value=tabPrixDepot[val['cli_prix_depot']];

		// si retour plus de commision
		var com=0;
		if (document.vendeurForm.buttonResetVendeur.value!="Reset Retour") {
			var com=prixVente*(tabTauxCom[val['cli_taux_com']]/100);
			if (com > 100) com=100;
		}
		document.ficheForm.obj_comission.value=com;

		getElement("obj_prix_depot").innerHTML=document.ficheForm.obj_prix_depot.value+" &#8364;";
		getElement("obj_comission").innerHTML=document.ficheForm.obj_comission.value+" &#8364;";
		getElement("prix_vente").innerHTML=prixVente+" &#8364;";
	}

	// ***********************************************************
	// ***********************************************************
	// *****ACHETEUR
	// ***********************************************************
	// ***********************************************************

	<?php $idRamdomAcheteur = rand(10000, 99999);?>
	var idRamdomAcheteur="<?=$idRamdomAcheteur?>";

	// validation de la fiche
	function ValideAcheteur(laForm) {
		var tab_fiche = new Array();
		var insert=true;

		laForm.cli_nom.value=laForm.elements.namedItem('cli_nom_'+idRamdomAcheteur).value;
		if (laForm.cli_nom.value == "") {
			 getElement('ACH_NOM_ERR').innerHTML="Champ obligatoire";
			 insert=false;
		}
		else {
			getElement('ACH_NOM_ERR').innerHTML="";
		}

		if (laForm.cli_prenom.value == "") {
			 getElement('ACH_PRENOM_ERR').innerHTML="Champ obligatoire";
			 insert=false;
		}
		else {
			getElement('ACH_PRENOM_ERR').innerHTML="";
		}

		if (laForm.cli_telephone.value == "" && laForm.cli_emel.value == "") {
			 getElement('ACH_TELEPHONE_ERR').innerHTML="Champ obligatoire ou  mel";
			 getElement('ACH_EMEL_ERR').innerHTML="Champ obligatoire ou telephone";
			 insert=false;
		}
		else {
			 getElement('ACH_TELEPHONE_ERR').innerHTML="";
			 getElement('ACH_EMEL_ERR').innerHTML="";
		}


		if (insert) {
			laForm.submit();
			return true;
		}
		return false;

	}

	function ResetAcheteur(laForm) {
		if (confirm("Modifier le acheteur de ce dépôt ?")) {
			document.ficheForm.action.value="changeAcheteur";
			document.ficheForm.submit();
		}
	}

	function display_acheteur_completion(val) {
		var repr="";
		if (typeof val == "object") {
			repr="<table>";
			for(index in val) {
				repr+="<tr>";
				repr+="<td class='link' onclick='affectAcheteur(index)'>";
				repr+=val[index]['cli_nom']+" "+val[index]['cli_prenom']+" ["+val[index]['cli_emel']+"]";
				repr+="</td>";
				repr+="</tr>";
			}
			repr+="</table>";
		}
		else {
			repr=val;
		}
		getElement("autoCompletionAcheteur").innerHTML=repr;

	}

	function affectAcheteur(index) {
		x_return_client(index, display_acheteur);
		getElement("autoCompletionAcheteur").innerHTML="";
	}

	function display_acheteur(val) {

		val['cli_nom_'+idRamdomAcheteur]=val['cli_nom'];
		display_formulaire(val,document.acheteurForm);
	}

	function searchAdress(input) {
		var options = {
  		//	types: ['(cities)'],
	  		componentRestrictions: {country: 'fr'}
		};
		autocomplete = new google.maps.places.Autocomplete(input, options);
		if (autocomplete.getPlace() != undefined) {
			alert(autocomplete.getPlace());
		}
	}
</script>


<form name="ficheForm" method="POST" action="return ValideFiche(this.form,'enregister')" >
	<!--<input type=hidden name=obj_numero value='<?=$GET_numeroFiche?>' />-->
	<input type=text name='obj_numero_bav' value="<?=$_COOKIE['NUMERO_BAV']?>"/>
	<input type=hidden name='lAction' value='' />
	<!-- redefiniation car input sur obj_cli_<aleatoire>-->
	<input type=hidden name='cli_nom' value='' />
	<input type=text name='cli_id' value='' />
<fieldset class=fiche>
	<legend class=titreFiche>Le depot</legend>
	<table width=100%  cellpadding=2 cellspacing=2 >
		<!-- Pas en creation -->
		<tr >
			<td colspan=10>
				<table width="100%" class="tittab" cellpadding=0 cellspacing=0 >
					<tr>
						<td class="titrow" width=8%>No Fiche</td>
						<td class="tabl1" width=25%>
							<span id='obj_numero' ></span>
						</td>
						<td class="tabl1" width=33% colspan=2>CONFIRME - STOCK - VENDU - RETOUR</td>
						<td class="titrow" width=8%>ID</td>
						<td class="tabl1" width=25% >
							<span id='obj_id_fiche' ></span>
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
			<td class="tabInput" width=25% >
				<select name='obj_public' id='obj_public' tabindex=<?=$tabindex++?>
					onchange="setStartSaisie(true);">
				</select>
			</td>
			<td class="titrow" width=8%>Pratique</td>
			<td class="tabInput" width=25% >
				<select name='obj_pratique' id='obj_pratique' tabindex=<?=$tabindex++?>
					onchange="setStartSaisie(true);">
				</select>
			</td>
		</tr>
		<tr>
			<td class="titrow" >Marque <span title="Obligatoire">*<span></td>
			<td class="tabInput" >
					<input type=text list="marques" name="obj_marque" size=30 maxlength="50" tabindex=<?=$tabindex++?>
						placeholder="Marque du vélo" onkeyup="setStartSaisie(true);" required/>
						<datalist id="marques">
  	<option value="Meteor">
  	<option value="Pils">
  	<option value="Kronenbourg">
  	<option value="Grimbergen">
	</datalist>
				</td>
				<td class="titrow" >Modele</td>
				<td class="tabInput" id="OBJ_MODELE">
					<input type=text name="obj_modele" size=30 maxlength="50" tabindex=<?=$tabindex++?>
						onkeyup="setStartSaisie(true);"/>
				</td>
				<td class="titrow" width=13%>Couleur <span title="Obligatoire">*<span></td>
				<td class="tabInput" width=20% id="OBJ_COULEUR">
					<input type=text name="obj_couleur" id="obj_couleur" size=20 maxlength="30" tabindex=<?=$tabindex++?>
						placeholder="Couleurs dominante" onkeyup="setStartSaisie(true);" required/>
				</td>
		</tr>
		<tr>
			<td colspan=10>
				<table width="100%" cellpadding=0 cellspacing=0 >
					<tr>
						<td class="titrow" width=8% >Description</td>
						<td class="tabInput" width=20%>
								<textarea rows="5" cols="95" tabindex=<?=$tabindex++?>
								name="obj_description"  onkeyup="setStartSaisie(true);"
								placeholder="Année d'achat, prix d'achat, taille, accessoires, révision (transmission, pneus, freins..)"></textarea>
						</td>
						<td class="help link" onclick="inverseLayer('aide_descript')" width="1%">?</td>
						<td class="help">
							<div id="aide_descript" style="visibility: hidden;" >
								Année d'achat, prix d'achat, taille, accessoires, révision (transmission, pneus, freins..)
							</div>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td class="titrow" >Prix</td>
			<td class="tabInput" >
				<input type=text name="obj_prix_depot" size=5 maxlength="10" tabindex=<?=$tabindex++?>
					onkeyup="setStartSaisie(true);"
					title="Prix vente" placeholder="00.00"/>&#8364;
				</span>
			</td>
		</tr>
		<tr >
			<td colspan=10><hr/></td>
		</tr>
		<!-- vue uniqueTABLE -->
		<tr  id=trPrix style='display:none' >
			<td class="titrow" >
				PRIX : </span>
			</td>
			<td class="tabl1"  >
				&nbsp&nbsp<span id="prix_vente">0.00</span>&#8364;&nbsp <span id="date_vente">
			</td>
			<td class="titrow" >Depot : </td>
			<td class="tabl1"  >
				&nbsp&nbsp<span id="depot_calc">...</span>&#8364;
			</td>
			<td class="titrow" >Com : </td>
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
						placeholder="aaaa.bbbb@ccc.dd" required/>

				<td class="titrow" width=10%>Nom/prenom <span title="Obligatoire">*<span></td>
				<td class="tabInput" width=40%>
					<input type=text name='cli_nom_<?=$idRamdomVendeur?>' tabindex=<?=$tabindex++?>
							size="50" maxlength="100" required />
					<div id="autoCompletionVendeur" style="position: absolute" class="info"></div>
				</td>
			</tr>
			<tr>
				<td class="titrow">Adresse</td>
				<td class="tabInput" >
					<input type=text name="cli_adresse_0" size=50 maxlength='100' tabindex=<?=$tabindex++?>
						placeholder="Adresse" />
					<br/>
					<input type=text name="cli_adresse_1" size=50 maxlength='100' tabindex=<?=$tabindex++?>
						placeholder="Complement adresse" />
					<br/>
					<input type=text name="cli_code_postal" size=5 maxlength='10' tabindex=<?=$tabindex++?>
						placeholder="Code postal" />
					<input type=text name="cli_ville" size=40 maxlength='100' tabindex=<?=$tabindex++?>
						placeholder="Ville" />
				</td>
				<td class="titrow">Telephone</td>
				<td class="tabInput" >
					<input type=text name='cli_telephone' size="15" maxlength="15" tabindex=<?=$tabindex++?>
						placeholder="Pour vous joindre durant la bourse"
						title="Pour vous joindre durant la bourse"/>
					<input type=text name='cli_telephone_bis' size="15" maxlength="15" tabindex=<?=$tabindex++?>
						placeholder="autre numéro"
						title="autre numéro"/>
					</td>
			</tr>
			<!-- TODO : juste TABLE -->
			<tr  id=trTauxCom style='display:none' >
				<td class="titrow">Taux commission</td>
				<td class="tabInput"% >
					<select name='cli_taux_com' id='cli_taux_com' tabindex=<?=$tabindex++?>></select>%
				</td>
				<td class="titrow">Tarif Depot</td>
				<td class="tabInput">
					<select name='cli_prix_depot' tabindex=<?=$tabindex++?> id='cli_prix_depot'></select>&#8364;
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
			<button  name="buttonValideFiche"
				onkeypress="" tabindex=<?=$tabindex++?>>Enregristrer
			</button>
		</td>
		<td width=33% align=center>
			<input type=button value="Supprimer" name="buttonSupprimeFiche"
				onclick="SupprimerFiche(this.form)"
				onkeypress="SupprimerFiche(this.form)" tabindex=<?=$tabindex++?>
				disabled="disabled"></td>
		<td width=33% align=center>
			<input type=button value="Annuler"
				onclick="fermerCRUD(this.form)"
				onkeypress="fermerCRUD(this.form)" tabindex=<?=$tabindex++?>
				></td>

		<td width=33% align=center><input type=button value="Reset"
			onclick="resetFiche(this.form)" tabindex=<?=$tabindex++?>>
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
</table>
</form>
	<table><tr>
		<!--  ********************************************************************************************* -->
		<!--  ********************************************************************************************* -->
		<!--  ********************************************************************************************* -->
		<!--  ********************************************************************************************* -->
		<!--  ********************************************************************************************* -->
		<!--  ********************************************************************************************* -->
		<!--  ********************************************************************************************* -->
		<!--  ********************************************************************************************* -->
		<td width=50% valign="top">
		<fieldset class=fiche><legend class=titreFiche>L'acheteur &nbsp;<span
			onclick="inverseDisplay('divAcheteur')"><img id="iconedivAcheteur"
			src="Images/iconeMoins.png"></img></span> </legend>
		<div id="divAcheteur" style="visibility: visible;">
		<form name="acheteurForm" method="POST" action="Actions/AFiche.php"	onsubmit="return ValideAcheteur(this)">
			<input type=hidden name=obj_numero value='<?=$GET_numeroFiche?>' />
			<input type=hidden name=obj_numero_bav value="<?=$_COOKIE['NUMERO_BAV']?>"/>
			<input type=hidden name=cli_id />
			<input type=hidden name=action value="acheteur" />
			<input type=hidden name=cli_nom />
		<table width=90% align=center cellpadding=2 cellspacing=2>

			<tr>
				<td class="titrow" width=25%>Nom</td>
				<td class="tabl0" width=25%>
					<input type=text name='cli_nom_<?=$idRamdomAcheteur?>' tabindex="200" size="20"
						maxlength="100" onkeyup="x_return_client_completion(this.value,display_acheteur_completion)"
						disabled="disabled" />
					<span id="ACH_NOM_ERR" class="error"></span>
				<div id="autoCompletionAcheteur" style="position: absolute"
					class="info"></div>
				</td>
				<td class="titrow" width=25%>Prénom</td>
				<td class="tabl0" width=25%><input type=text name='cli_prenom'
					 size="20" maxlength="100" disabled="disabled" tabindex="201"/> <span
					id="ACH_PRENOM_ERR" class="error"></span></td>
			</tr>
			<tr>
				<td class="titrow">Adresse</td>
				<td class="tabl0" colspan="3"><textarea name="cli_adresse" rows="2"
					cols="50" disabled="disabled" tabindex="202"></textarea></td>
			</tr>
			<tr>
				<td class="titrow">Code postal</td>
				<td class="tabl0"><input type=text name='cli_codePostal' size="10"
					maxlength="10"  disabled="disabled" tabindex="203"/></td>
				<td class="titrow">Ville</td>
				<td class="tabl0"><input type=text name='cli_ville' size="20"
					maxlength="100" disabled="disabled" tabindex="204"/></td>
			</tr>
			<tr>
				<td class="titrow">Emel</td>
				<td class="tabl0" colspan="3"><input type=text name='cli_emel'
					size="30" maxlength="100"  disabled="disabled" tabindex="205"/> <span
					id="ACH_EMEL_ERR" class="error"></span></td>
			</tr>
			<tr>
				<td class="titrow">Téléphone</td>
				<td class="tabl0" colspan="3"><input type=text name='cli_telephone'
					size="30" maxlength="100" disabled="disabled" tabindex="206"/> <span
					id="ACH_TELEPHONE_ERR" class="error"></span></td>
			</tr>
			 <tr>
				<td class="titrow" >Mode Paiement</td>
				<td class="tabl0" colspan="3">
					<select name='obj_type_achat' id='obj_type_achat' disabled="disabled" tabindex="207"></select>
				</td>
				</tr>
			<tr>
				<td class="titrow">Type pièce</td>
				<td class="tabl0">
				 si chèque
				 <select name='cli_type_piece'
					id='cli_type_piece_achat' disabled="disabled" tabindex="208"></select>
				</td>
				<td class="titrow">Numéro pièce</td>
				<td class="tabl0"><input type=text name='cli_piece_indetite'
					size="20" maxlength="50" disabled="disabled" tabindex="209"/></td>
			</tr>
		</table>
		<br />

		<table width=100% class=fiche>
			<tr>
				<td width=50% align=center><input type=button value="Valider"
					onclick="ValideAcheteur(this.form)"
					onkeypress="ValideAcheteur(this.form)"
					disabled="disabled" name=buttonValideAcheteur tabindex="220"></td>
				<td width=50% align=center><input type=button value="Reset" name="buttonResetAcheteur"
					onclick="ResetAcheteur(this.form)" tabindex="221"></td>
			</tr>
		</table>
		</form>

		</fieldset>
		</td>
	</tr>
</table>
</div>
