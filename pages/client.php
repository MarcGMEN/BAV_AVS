
<script>
	function initPage() {
		x_return_list_typePiece(display_list_typePiece);
		x_return_list_taux_commision(display_list_taux_com);
		x_return_list_prix_depot(display_list_prix_depot);
		x_return_client(<?=$_GET['cli_id']?>, display_client);

		x_return_fiches(tri,sens,selection,<?=$_GET['cli_id']?>,display_fiches);
		
	}
	
	function unloadPage() {
	} 

	function display_list_typePiece(val) {
		var select = getElement("cli_type_piece");
		for(index in val) {
		    select.options[select.options.length] = new Option(val[index], val[index]);
		}
	}

	function display_list_taux_com(val) {
		var select = getElement("cli_taux_com");
		for(index in val) {
		    select.options[select.options.length] = new Option(val[index], index);
		}
	}
	function display_list_prix_depot(val) {
		var select = getElement("cli_prix_depot");
		for(index in val) {
		    select.options[select.options.length] = new Option(val[index], index);
		}
	}


	// ***********************************************************
	// ***********************************************************
	// *****CLIENT
	// ***********************************************************
	// ***********************************************************
	
	
	function ValideClient(laForm) {
		var tab_fiche = new Array();
		var insert=true;

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

	function display_client(val) {
		display_formulaire(val,document.clientForm);
	}

	// ***********************************************************
	// ***********************************************************
	// *****FiCHES
	// ***********************************************************
	// ***********************************************************
	

	var tri="obj_numero";
	var sens="asc";
	var selection="*";
	var tabSel =new Array();
	
	function display_fiches(val) {

		var total = 0;
		var repr="<table width='100%'>";
		for (index in val) {
			repr+="<tr class='tabl0 link' onclick='location.href=\"index.php?page=fiche.php&numeroFiche="+val[index]['obj_numero']+"&action=visu\"'>";
			repr+="<td width=10% align=center>";
			repr+=val[index]['obj_numero'];
			repr+="</td>";
			repr+="<td width=20% >";
			repr+=val[index]['obj_type'];
			repr+="</td>";
			repr+="<td width=20% >";
			repr+=val[index]['obj_public'];
			repr+="</td>";
			repr+="<td width=20% >";
			repr+=val[index]['obj_marque'];
			repr+="</td>";
			repr+="<td width=10% >";
			repr+=val[index]['obj_prix_vente'];
			repr+="</td>";
			repr+="<td width=10% >";
			repr+=val[index]['obj_comission'];
			repr+="</td>";
			repr+="<td width=5% >";
			repr+=val[index]['obj_etat'];
			repr+="</td>";
			repr+="</tr>";

			total=total+1;
		}
		repr+="</table>";

		getElement('fiches').innerHTML=repr;

				if (sens=="asc") { classSort="sortUp";} else {classSort="sortDown";}
		getElement(tri).className=classSort;
	}

	function triColonne(col) {
		if (col==tri) {
			if (sens=="asc") {
				sens="desc";
			} 
			else {
				sens="asc";
			}
		}
		else {
			sens="asc";
		}
		getElement(tri).className="sortable";

		x_return_fiches(tri,sens,selection,<?=$_GET['cli_id']?>,display_fiches);

		tri=col;
	}
</script>
<!-- <div id=lesFiches style="visibility: hidden;" />-->
<fieldset class=fiche><legend class=titreFiche>Le client</legend>
<form name="clientForm" method="POST" action="Actions/AClient.php" onsubmit="return ValideClient(this)">
	 <input type=hidden name=numero_bav value="<?=$_COOKIE['NUMERO_BAV']?>"/>
	 <input type=hidden name=cli_id /> 
	 <input	type=hidden name=action value="client" /> 
<table width=90% align=center cellpadding=2 cellspacing=2>
	<tr>
		<td class="titrow" width=25%>Nom</td>
		<td class="tabl0" width=25%><input type=text
			name='cli_nom'  size="20"
			maxlength="100"/> <span id="VEN_NOM_ERR" class="error"></span>
		</td>
		<td class="titrow" width=25%>Prénom</td>
		<td class="tabl0" width=25%><input type=text name='cli_prenom'
			 size="20" maxlength="100"  /> <span
			id="VEN_PRENOM_ERR" class="error"></span></td>
	</tr>
	<tr>
		<td class="titrow">Adresse</td>
		<td class="tabl0" colspan="3"><textarea name="cli_adresse" rows="2"
			cols="50"  ></textarea></td>
	</tr>
	<tr>
		<td class="titrow">Code postal</td>
		<td class="tabl0"><input type=text name='cli_codePostal' size="10"
			maxlength="10"  /></td>
		<td class="titrow">Ville</td>
		<td class="tabl0"><input type=text name='cli_ville' size="20"
			maxlength="100" /></td>
	</tr>
	<tr>
		<td class="titrow">Emel</td>
		<td class="tabl0" colspan="3"><input type=text name='cli_emel'
			size="30" maxlength="100" tabindex=105  /> <span
			id="VEN_EMEL_ERR" class="error"></span></td>
	</tr>
	<tr>
		<td class="titrow">Téléphone</td>
		<td class="tabl0" colspan="3"><input type=text name='cli_telephone'
			size="30" maxlength="100"  /> <span
			id="VEN_TELEPHONE_ERR" class="error"></span></td>
	</tr>
	<tr>
		<td class="titrow">Type pièce</td>
		<td class="tabl0"><select name='cli_type_piece'
			id='cli_type_piece'  ></select>
		</td>
		<td class="titrow">Numéro pièce</td>
		<td class="tabl0"><input type=text name='cli_piece_indetite'
			size="20" maxlength="50"  /></td>
	</tr>
	<tr>
		<td class="titrow">Taux commission</td>
		<td class="tabl0"% ><select name='cli_taux_com' id='cli_taux_com' ></select>%</td>
		<td class="titrow">Tarif Dépôt</td>
		<td class="tabl0"><select name='cli_prix_depot' id='cli_prix_depot' ></select>&#8364;</td>
	</tr>
</table>
<br />
<table width=100% class=fiche>
	<tr>
		<td width=33% align=center>
			<input type=button value="Valider"
				onclick="ValideClient(this.form)"
				onkeypress="ValideClient(this.form)" 
				name=buttonValideVendeur>
		</td>
		<td width=33% align=center>
			<input type=button value="Reset"onclick="this.form.reset()"	>
		</td>
	</tr>
</table>
</form>
</fieldset>

<table width="100%">
<tr>
<td class="tittab" width=10% >
<span id='obj_numero' onclick="triColonne('obj_numero')" class="sortable">Numero&nbsp;&nbsp;&nbsp;</span></td>
<td class="tittab" width=20% >
<span id='obj_type' onclick="triColonne('obj_type')" class="sortable">Type&nbsp;&nbsp;&nbsp;</span> 
&nbsp;</td>
<td class="tittab" width=20% >
<span id='obj_public'  onclick="triColonne('obj_public')" class="sortable">Public&nbsp;&nbsp;&nbsp;</span> 
&nbsp;</td>
<td class="tittab" width=20% >
<span id='obj_marque' onclick="triColonne('obj_marque')" class="sortable">Marque&nbsp;&nbsp;&nbsp;</span></td>
<td class="tittab" width=10% >
<span class="sortable" id='obj_prix_vente' onclick="triColonne('obj_prix_vente')">Prix vente&nbsp;&nbsp;&nbsp;</span></td>
<td class="tittab" width=10% >
<span class="sortable" id='obj_comission' onclick="triColonne('obj_comission')">Commission&nbsp;&nbsp;&nbsp;</span></td>
<td class="tittab" width=5%>
<span id='obj_etat' onclick="triColonne('obj_etat')" class="sortable">Etat&nbsp;&nbsp;&nbsp;</span> 
</td>
</tr>
</table>
<div id=fiches></div>
