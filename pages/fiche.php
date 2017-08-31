
<script>
	function initPage() {

		x_return_list_type(display_list_fiche);
		x_return_list_public(display_list_public);

		x_return_list_typePiece(display_list_typePiece);
		x_return_list_typeAchat(display_list_typeAchat);
		
		x_return_list_taux_commision(display_list_taux_com);
		x_return_list_prix_depot(display_list_prix_depot);

		<?php if ($GET_action == "visu") { ?>
			x_verifNumeroFiche(<?=$GET_numeroFiche?>,display_fiche);
		<?php }?>
	}
	
	
	function unloadPage() {
		
	} 
	
	var prixVente=0;	
	function display_fiche(val) {
		display_formulaire(val,document.ficheForm);

		getElement("obj_date_depot_FR").innerHTML=val['obj_date_depot_FR'];
		// si le prix 1 OK, alors possible saisie 2
		
		prixVente=val['obj_prix_1'];
		if (val['obj_prix_1']!= null && val['obj_prix_1'] != "0.00") {
			prixVente=val['obj_prix_1'];
			document.ficheForm.obj_prix_2.disabled=false;
		}
		if (val['obj_prix_2'] != null && val['obj_prix_2'] != "0.00") {
			prixVente=val['obj_prix_2'];
			document.ficheForm.obj_prix_1.style.textDecoration='line-through';
			document.ficheForm.obj_prix_3.disabled=false;
		}
		if (val['obj_prix_3'] != null  && val['obj_prix_3'] != "0.00") {
			prixVente=val['obj_prix_3'];
			document.ficheForm.obj_prix_1.style.textDecoration='line-through';
			document.ficheForm.obj_prix_2.style.textDecoration='line-through';
		}

		document.ficheForm.buttonSupprimeFiche.disabled=false;

		if (val['obj_id_vendeur'] !=null && val['obj_id_vendeur'] != 0) {
			x_return_client(val['obj_id_vendeur'], display_vendeur);

			if (val['obj_id_acheteur'] != null && val['obj_id_acheteur'] != 0) {
				x_return_client(val['obj_id_acheteur'], display_acheteur);

				document.ficheForm.obj_type.disabled="disabled";
				document.ficheForm.obj_public.disabled="disabled";
				document.ficheForm.obj_taille.disabled="disabled";
				document.ficheForm.obj_marque.disabled="disabled";
				document.ficheForm.obj_modele.disabled="disabled";
				document.ficheForm.obj_couleur.disabled="disabled";
				document.ficheForm.obj_marque.disabled="disabled";
				document.ficheForm.obj_description.disabled="disabled";
				document.ficheForm.obj_prix_1.disabled="disabled";
				document.ficheForm.obj_prix_2.disabled="disabled";
				document.ficheForm.obj_prix_3.disabled="disabled";

				document.acheteurForm.obj_type_achat.value=val['obj_type_achat'];
				

				getElement("date_vente").innerHTML=" vendu ("+val['obj_type_achat']+") le "+val['obj_date_vente_FR'];
				document.ficheForm.buttonValideFiche.disabled="disabled";
				document.vendeurForm.buttonResetVendeur.disabled="disabled";
				document.vendeurForm.buttonRetourVendeur.disabled="disabled";
				
			}
			else {

				if (val['obj_date_retour'] == null) {
					document.acheteurForm.cli_prenom.disabled=false;

					document.acheteurForm.cli_adresse.disabled=false;
					document.acheteurForm.cli_codePostal.disabled=false;
					document.acheteurForm.cli_ville.disabled=false;
					document.acheteurForm.cli_emel.disabled=false;
					document.acheteurForm.cli_telephone.disabled=false;
	
					document.acheteurForm.cli_type_piece.disabled=false;
					document.acheteurForm.cli_piece_indetite.disabled=false;

					document.acheteurForm.obj_type_achat.disabled=false;

					document.acheteurForm.buttonValideAcheteur.disabled=false;
					document.acheteurForm.elements.namedItem('cli_nom_'+idRamdomAcheteur).disabled=false;
				}
				else {
					document.ficheForm.obj_type.disabled="disabled";
					document.ficheForm.obj_public.disabled="disabled";
					document.ficheForm.obj_marque.disabled="disabled";
					document.ficheForm.obj_modele.disabled="disabled";
					document.ficheForm.obj_couleur.disabled="disabled";
					document.ficheForm.obj_marque.disabled="disabled";
					document.ficheForm.obj_description.disabled="disabled";
					document.ficheForm.obj_prix_1.disabled="disabled";
					document.ficheForm.obj_prix_2.disabled="disabled";
					document.ficheForm.obj_prix_3.disabled="disabled";
					
					document.ficheForm.buttonValideFiche.disabled="disabled";
					document.vendeurForm.buttonRetourVendeur.disabled="disabled";
					document.acheteurForm.buttonResetAcheteur.disabled="disabled";

					document.vendeurForm.buttonResetVendeur.value="Reset Retour";
					document.vendeurForm.buttonResetVendeur.onclick=function () { ResetRetourVendeur(this.form) };
					
					getElement("date_vente").innerHTML=" retour au vendeur le :"+val['obj_date_retour_FR'];
				}
			}
		}
		else {
			document.ficheForm.obj_prix_depot.value=0;
			document.ficheForm.obj_comission.value=0;
			
			getElement("obj_prix_depot").innerHTML=document.ficheForm.obj_prix_depot.value+" &#8364;";
			getElement("obj_comission").innerHTML=document.ficheForm.obj_comission.value+" &#8364;";

			document.vendeurForm.cli_prenom.disabled=false;

			document.vendeurForm.cli_adresse.disabled=false;
			document.vendeurForm.cli_codePostal.disabled=false;
			document.vendeurForm.cli_ville.disabled=false;
			document.vendeurForm.cli_emel.disabled=false;
			document.vendeurForm.cli_telephone.disabled=false;

			document.vendeurForm.cli_type_piece.disabled=false;
			document.vendeurForm.cli_piece_indetite.disabled=false;

			document.vendeurForm.cli_taux_com.disabled=false;
			document.vendeurForm.cli_prix_depot.disabled=false;

			document.vendeurForm.buttonValideVendeur.disabled=false;
			document.vendeurForm.elements.namedItem('cli_nom_'+idRamdomVendeur).disabled=false;
		}
		
	}

	

	function display_list_fiche(val) {
		var select = getElement("obj_type");
		for(index in val) {
			    select.options[select.options.length] = new Option(val[index], val[index]);
		}
	}
	function display_list_public(val) {
		var select = getElement("obj_public");
		for(index in val) {
			    select.options[select.options.length] = new Option(val[index], val[index]);
		}
	}
	function display_list_typePiece(val) {
		var select = getElement("cli_type_piece_vente");
		for(index in val) {
		    select.options[select.options.length] = new Option(val[index], val[index]);
		}
		var select = getElement("cli_type_piece_achat");
		for(index in val) {
		    select.options[select.options.length] = new Option(val[index], val[index]);
		}
		
	}
	function display_list_typeAchat(val) {
		var select = getElement("obj_type_achat");
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
//	function display_marque(val) {
//		autoCompletion(val,'obj_marque');
//	}
//	

	// validation de la fiche
	function ValideFiche(laForm) {
		var tab_fiche = new Array();
		var insert=true;
		
		if (laForm.obj_marque.value == "") {
			 getElement('OBJ_MARQUE_ERR').innerHTML="Champ obligatoire";
			 insert=false;
		}
		else {
			getElement('OBJ_MARQUE_ERR').innerHTML="";
		}

		var numcheck = /^[0-9]+([\,\.][0-9]+)?$/g;

		if (laForm.obj_prix_1.value == "" || laForm.obj_prix_1.value == "0.00"
			|| parseInt(laForm.obj_prix_1.value) == "0") {
			 getElement('OBJ_PRIX_1_ERR').innerHTML="Champ obligatoire";
			 insert=false;
		}
		else if (!numcheck.test(laForm.obj_prix_1.value) ){
			getElement('OBJ_PRIX_1_ERR').innerHTML="Valeur décimale";				
		}
		else {
			getElement('OBJ_PRIX_1_ERR').innerHTML="";
		}
		
		if (insert) {
			laForm.submit();
			return true;
		}
		return false;
		
	}

	function SupprimerFiche(laForm) {
		if (confirm("Suppresion de la fiche "+document.ficheForm.obj_numero.value+" ?")) {
			document.ficheForm.action.value="ficheSupprimer";
			document.ficheForm.submit();
		}
	}

	// ***********************************************************
	// ***********************************************************
	// *****VENDEUR
	// ***********************************************************
	// ***********************************************************
	
	<?php $idRamdomVendeur=rand(1000,9999);?>
	var idRamdomVendeur="<?=$idRamdomVendeur?>";


	// validation de la fiche
	function ValideVendeur(laForm) {
		var tab_fiche = new Array();
		var insert=true;

		laForm.cli_nom.value=laForm.elements.namedItem('cli_nom_'+idRamdomVendeur).value;
		if (laForm.cli_nom.value == "") {
			 getElement('VEN_NOM_ERR').innerHTML="Champ obligatoire";
			 insert=false;
		}
		else {
			getElement('VEN_NOM_ERR').innerHTML="";
		}
		
		if (laForm.cli_prenom.value == "") {
			 getElement('VEN_PRENOM_ERR').innerHTML="Champ obligatoire";
			 insert=false;
		}
		else {
			getElement('VEN_PRENOM_ERR').innerHTML="";
		}

		if (laForm.cli_telephone.value == "" && laForm.cli_emel.value == "") {
			 getElement('VEN_TELEPHONE_ERR').innerHTML="Champ obligatoire ou  mel";
			 getElement('VEN_EMEL_ERR').innerHTML="Champ obligatoire ou telephone";
			 insert=false;
		}
		else {
			 getElement('VEN_TELEPHONE_ERR').innerHTML="";
			 getElement('VEN_EMEL_ERR').innerHTML="";
		}
		
		
		if (insert) {
			laForm.submit();
			return true;
		}
		return false;
		
	}

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

	<?php $idRamdomAcheteur=rand(10000,99999);?>
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
</script>
<h3 class=fiche><? if ($GET_action=="new") {?> Création de la fiche <?=$GET_numeroFiche?>
	<?}
	else {?> Mise à jour de la fiche <?=$GET_numeroFiche?> le <span
	id='obj_date_depot_FR'>...</span> <?php }?></h3>

<!-- <div id=lesFiches style="visibility: hidden;" />-->

<form name="ficheForm" method="POST" action="Actions/AFiche.php" onsubmit="return ValideFiche(this)">
	<input type=hidden name=obj_numero value='<?=$GET_numeroFiche?>' />
	<input type=hidden name=obj_numero_bav value="<?=$_COOKIE['NUMERO_BAV']?>"/>
	<input type=hidden name=action value='<?=$GET_action?>' />

<fieldset class=fiche><legend class=titreFiche>Le dépôt &nbsp;<span
	onclick="inverseDisplay('divDepot')"><img id="iconedivDepot"
	src="Images/iconeMoins.png"></img></span></legend>
<div id="divDepot" style="visibility: visible;">
<table width=90% align=center cellpadding=2 cellspacing=2>
	<tr>
		<td class="titrow" width=13%>Type</td>
		<td class="tabl0" width=20%><select name='obj_type' id='obj_type'
			tabindex="1"></select></td>
		<td class="titrow" width=13%>Public</td>
		<td class="tabl0" width=20% ><select name='obj_public'
			id='obj_public' tabindex="2"></select></td>
		<td class="titrow" width=13%>Taille</td>
		<td class="tabl0" width=20% ><input type=text name="obj_taille"
				size=20 maxlength="20" tabindex="3" /></td>
	</tr>
	<tr>
				<td class="titrow" width=13%>Marque</td>
				<td class="tabl0" width=20%><input type=text name="obj_marque"
					size=30 maxlength="100" tabindex="4" />
					<span id="OBJ_MARQUE_ERR" class="error"></span>
				</td>
				<td class="titrow" width=13%>Modèle</td>
				<td class="tabl0" width=20% id="OBJ_MODELE"><input type=text
					name="obj_modele" size=30 maxlength="100" tabindex="5" /> <span
					id="OBJ_MODELE_ERR" class="error"></span></td>
				<td class="titrow" width=13%>Couleur</td>
				<td class="tabl0" width=20% id="OBJ_COULEUR"><input type=text
					name="obj_couleur" size=20 maxlength="20" tabindex="6" /> <span
					id="OBJ_COULEUR_ERR" class="error"></span></td>
	</tr>
	<tr>
		<td class="titrow" width=20%>Description</td>
		<td class="tabl0" width=30% colspan=7><textarea rows="5" cols="100"
			tabindex="6" name="obj_description"></textarea></td>
	</tr>
	<tr>
		<td class="titrow" >Prix de vente</td>
		<td class="tabl0" ><input type=text name="obj_prix_1" size=5
			maxlength="10" tabindex="8" title="Prix origine" /> <span
			id="OBJ_PRIX_1_ERR" class="error"></span></td>
		<td class="tabl0" colspan=2><input type=text name="obj_prix_2" size=5
			maxlength="10" disabled="disabled" title="Prix deuxieme choix" tabindex="9" /> <span
			id="OBJ_PRIX_2_ERR" class="error"></span></td>
		<td class="tabl0" colspan=2><input type=text name="obj_prix_3" size=5
			maxlength="10" disabled="disabled" title="Prix troisieme choix"  tabindex="10"/> <span
			id="OBJ_PRIX_3_ERR" class="error"></span></td>
	</tr>
	<tr>
		<td class="titrow" >Tarif Dépot</td>
		<td class="tabl0" colspan=2 >
			<span id="obj_prix_depot"></span>
			<input type=hidden size=5 name="obj_prix_depot" /></td>
		<td class="titrow" >Commission</td>
		<td class="tabl0" colspan=2 ">
			<span id="obj_comission"></span>
			<input type=hidden size=5 name="obj_comission" />
		</td>
	</tr>
	<tr>
		<td class="tittab" width=100% colspan=6><big>PRIX VENTE <span
			id="prix_vente"></span>&nbsp <span id="date_vente"></span></big></td>
	</tr>

</table>
<br />
<table width=100% class=fiche>
	<tr>
		<td width=33% align=center><input type=button value="Valider"
			name="buttonValideFiche" onclick="ValideFiche(this.form)"
			onkeypress="ValideFiche(this.form)" tabindex="20"></td>

		<td width=33% align=center><input type=button value="Supprimer"
			name="buttonSupprimeFiche" onclick="SupprimerFiche(this.form)"
			onkeypress="SupprimerFiche(this.form)" tabindex="21"
			disabled="disabled"></td>

		<td width=33% align=center><input type=button value="Reset"
			onclick="resetFiche(this.form)" tabindex="22"></td>
	</tr>
</table>
</div>
</fieldset>
</form>
<table width=100%>
	<tr>
		<!--  ********************************************************************************************* -->
		<!--  ********************************************************************************************* -->
		<!--  ********************************************************************************************* -->
		<!--  ********************************************************************************************* -->
		<!--  ********************************************************************************************* -->
		<!--  ********************************************************************************************* -->
		<!--  ********************************************************************************************* -->
		<!--  ********************************************************************************************* -->
		<td width=50% valign="top">
		<fieldset class=fiche><legend class=titreFiche>Le vendeur &nbsp;<span
			onclick="inverseDisplay('divVendeur')"><img id="iconedivVendeur"
			src="Images/iconeMoins.png"></img></span> </legend>
		<div id="divVendeur" style="visibility: visible;">
		<form name="vendeurForm" method="POST" action="Actions/AFiche.php"
			onsubmit="return ValideVendeur(this)"><input type=hidden
			name=obj_numero value='<?=$GET_numeroFiche?>' /> <input type=hidden
			name=obj_numero_bav value="<?=$_COOKIE['NUMERO_BAV']?>"/><input type=hidden name=cli_id /> <input
			type=hidden name=action value="vendeur" /> <input type=hidden
			name=cli_nom />
		<table width=90% align=center cellpadding=2 cellspacing=2>

			<tr>
				<td class="titrow" width=25%>Nom</td>
				<td class="tabl0" width=25%><input type=text
					name='cli_nom_<?=$idRamdomVendeur?>' tabindex="100" size="20"
					maxlength="100"
					onkeyup="x_return_client_completion(this.value,display_vendeur_completion)"
					disabled="disabled" /> <span id="VEN_NOM_ERR" class="error"></span>
				<div id="autoCompletionVendeur" style="position: absolute"
					class="info"></div>
				</td>
				<td class="titrow" width=25%>Prénom</td>
				<td class="tabl0" width=25%><input type=text name='cli_prenom'
					tabindex="101" size="20" maxlength="100" disabled="disabled" /> <span
					id="VEN_PRENOM_ERR" class="error"></span></td>
			</tr>
			<tr>
				<td class="titrow">Adresse</td>
				<td class="tabl0" colspan="3"><textarea name="cli_adresse" rows="2"
					cols="50" tabindex=102 disabled="disabled"></textarea></td>
			</tr>
			<tr>
				<td class="titrow">Code postal</td>
				<td class="tabl0"><input type=text name='cli_codePostal' size="10"
					maxlength="10" tabindex=103 disabled="disabled" /></td>
				<td class="titrow">Ville</td>
				<td class="tabl0"><input type=text name='cli_ville' size="20"
					maxlength="100" tabindex=104 disabled="disabled" /></td>
			</tr>
			<tr>
				<td class="titrow">Emel</td>
				<td class="tabl0" colspan="3"><input type=text name='cli_emel'
					size="30" maxlength="100" tabindex=105 disabled="disabled" /> <span
					id="VEN_EMEL_ERR" class="error"></span></td>
			</tr>
			<tr>
				<td class="titrow">Téléphone</td>
				<td class="tabl0" colspan="3"><input type=text name='cli_telephone'
					size="30" maxlength="100" tabindex=106 disabled="disabled" /> <span
					id="VEN_TELEPHONE_ERR" class="error"></span></td>
			</tr>
			<tr>
				<td class="titrow">Type pièce</td>
				<td class="tabl0"><select name='cli_type_piece'
					id='cli_type_piece_vente' tabindex=107 disabled="disabled"></select>
				</td>
				<td class="titrow">Numéro pièce</td>
				<td class="tabl0"><input type=text name='cli_piece_indetite'
					size="20" maxlength="50" tabindex=108 disabled="disabled" /></td>
			</tr>
			<tr>
				<td class="titrow">Taux commission</td>
				<td class="tabl0"% ><select name='cli_taux_com' id='cli_taux_com'
					tabindex=109 disabled="disabled"></select>%</td>
				<td class="titrow">Tarif Dépôt</td>
				<td class="tabl0"><select name='cli_prix_depot' id='cli_prix_depot'
					tabindex=110 disabled="disabled"></select>&#8364;</td>
			</tr>

		</table>
		<br />

		<table width=100% class=fiche>
			<tr>
				<td width=33% align=center><input type=button value="Valider"
					onclick="ValideVendeur(this.form)"
					onkeypress="ValideVendeur(this.form)" tabindex=111
					disabled="disabled" name=buttonValideVendeur></td>
				<td width=33% align=center><input type=button value="Reset"
					name="buttonResetVendeur" onclick="ResetVendeur(this.form)"
					tabindex=112></td>
				<td width=33% align=center><input type=button value="Retour"
					name="buttonRetourVendeur" onclick="RetourVendeur(this.form)"
					tabindex=113></td>

			</tr>
		</table>
		</form>
		</div>
		</fieldset>
		</td>
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
