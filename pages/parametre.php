<script>
	function initPage() {

		getElement("par_numero_bav").focus();
	}
	
	function unloadPage() {
		
	}
</script>

<form name="parametreForm" method="POST" action="Actions/AParametre.php" >
<fieldset class=fiche>
	<legend class=titreFiche>Parametre</legend>
	<table width=100%  cellpadding=2 cellspacing=2 >
		<tr>
			<td class="titrow" width=8%>Numero BAV <span title="Obligatoire">*<span></td>
			<td class="tabl0" width=25%>
			<input type=text name="par_numero_bav" id="par_numero_bav" size=4 maxlength="10" tabindex=<?=$tabindex++?> 
						placeholder="numéro BAV (année)" onkeyup="setStartSaisie(true);" />
					<span id="PAR_NUMERO_BAV" class="error"></span>
			</td>
			<td class="titrow" width=8%></td>
			<td class="tabl0" width=25% >
			</td>
			<td class="titrow" width=8%></td>
			<td class="tabl0" width=25% >
			</td>
		</tr>
		<tr>
			<td class="titrow" >Titre <span title="Obligatoire">*<span></td>
			<td class="tabl0" >
			<input type=text name="par_titre" size=70 maxlength="100" tabindex=<?=$tabindex++?> 
						placeholder="titre BAV" onkeyup="setStartSaisie(true);" />
					<span id="PAR_TITRE" class="error"></span>
			</td>
		</tr>
	</table>
	<br />

	<table width=100% class=fiche>
		<tr>
			<td width=50% align=center><input type=button value="Valider"
				onclick="Valide(this.form)"
				onkeypress="Valide(this.form)" 
				name=buttonValideAcheteur tabindex=<?=$tabindex++?> >
			</td>
		</tr>
	</table>
</form>
