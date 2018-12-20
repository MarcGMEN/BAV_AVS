<script>
	var idClient = '<?=$GET_id?>';
	// pour rendre le champ nom du client unique
	<? $idRamdom = rand(1000, 9999);?>
	var idRamdom = "<?=$idRamdom?>";
</script>

<script src="JS/client.js" type="text/javascript"></script>

<!-- <div id=lesFiches style="visibility: hidden;" />-->
<fieldset class=client>
	<legend class=titreFiche>Le client</legend>
	<form name="clientForm" method="POST" action="#" onsubmit="return submitForm(this)">
		<input type=hidden name=cli_id />

		<table width=100% cellpadding=2 cellspacing=2>
			<tr>
			<tr>
				<td class="titrow" width="10%">Emel <span title="Obligatoire">*<span></td>
				<td class="tabInput" width=40%>
					<input type=email name='cli_emel' id="cli_emel" size="50" maxlength="100" tabindex=<?=$tabindex++?>
					placeholder="aaaa.bbbb@ccc.dd" required onkeyup="keyUpMel()"
					onblur='x_return_oneClientByMel(this.value, display_client)'
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
					<select name='cli_taux_com' tabindex=<?=$tabindex++?>></select>%
				</td>
				<td class="titrow">Tarif Depot</td>
				<td class="tabInput">
					<select name='cli_prix_depot' tabindex=<?=$tabindex++?>></select>&#8364;
				</td>
			</tr>
		</table>
		<br />
		<table width=100% class=fiche>
			<tr>
				<td width=33% align=center>
					<button name="buttonValideFiche" tabindex=<?=$tabindex++?> disabled >Enregristrer
					</button>
				</td>
				<td width=33% align=center>
					<input type=button value="Reset" onclick="this.form.reset()">
				</td>
			</tr>
		</table>
	</form>
</fieldset>

<table width="100%">
	<tr>
		<td class="tittab" width=10%>
			<span id='obj_numero' onclick="triColonne('obj_numero')" class="sortable">Numero&nbsp;&nbsp;&nbsp;</span></td>
		<td class="tittab" width=20%>
			<span id='obj_type' onclick="triColonne('obj_type')" class="sortable">Type&nbsp;&nbsp;&nbsp;</span>
			&nbsp;</td>
		<td class="tittab" width=20%>
			<span id='obj_public' onclick="triColonne('obj_public')" class="sortable">Public&nbsp;&nbsp;&nbsp;</span>
			&nbsp;</td>
		<td class="tittab" width=20%>
			<span id='obj_marque' onclick="triColonne('obj_marque')" class="sortable">Marque&nbsp;&nbsp;&nbsp;</span></td>
		<td class="tittab" width=10%>
			<span class="sortable" id='obj_prix_vente' onclick="triColonne('obj_prix_vente')">Prix vente&nbsp;&nbsp;&nbsp;</span></td>
		<td class="tittab" width=10%>
			<span class="sortable" id='obj_comission' onclick="triColonne('obj_comission')">Commission&nbsp;&nbsp;&nbsp;</span></td>
		<td class="tittab" width=5%>
			<span id='obj_etat' onclick="triColonne('obj_etat')" class="sortable">Etat&nbsp;&nbsp;&nbsp;</span>
		</td>
	</tr>
</table>
<div id=fiches></div>