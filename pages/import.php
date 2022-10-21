<script>
	var cli_id = '<?= $GET_id ?>';
</script>
<script src="JS/import.js" type="text/javascript"></script>
<h1>Import gros client</h1>

<form name="clientForm" method="POST" onsubmit="return submitForm()" action="">
	<input type=hidden name="cli_id" />
	<fieldset class=fiche>
		<legend class="titreFiche">Le vendeur <span id="legendVendeur"></span></legend>
		<div class="row">
			<div class="col-sm-6 col-md-6 col-xs-12">
				<span class="titrow  col-md-3 col-sm-3 col-xs-3">Emel <span title="Obligatoire">*</span></span>
				<span class="tabInput col-md-9 col-sm-9 col-xs-9">
					<input type=email name='cli_emel' id="cli_emel" size="50" maxlength="100" tabindex=<?= $tabindex++ ?> placeholder="aaaa.bbbb@ccc.dd" required onkeyup="keyUpMel()" onblur='x_return_oneClientByMel(this.value, display_infoClientVendeurMel)' list='listVendeur' />
					<datalist id="listVendeur"></datalist>
				</span>
			</div>
			<div class="col-sm-6 col-md-6 col-xs-12">
				<span class="titrow  col-md-3 col-sm-3 col-xs-3">Nom et prénom <span title="Obligatoire">*</span></span>
				<span class="tabInput col-md-9 col-sm-9 col-xs-9">
					<input type=text name='cli_nom' tabindex=<?= $tabindex++ ?> size="50" maxlength="100" required>
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
		<div class="row" id=trTauxCom>
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
	<div class="row fiche">
		<div class="col-sm-3 col-md-3 col-xs-6 btnAction" id="tdBtnAction">
			<!-- etat vide pour reconnaitre une action de modif simple -->
			<button name="buttonValideFiche" tabindex=<?= $tabindex++ ?>>Enregistrer
			</button>
		</div>
		<div class="col-sm-3 col-md-3 col-xs-6 btnAction">
			<input type=reset value="Reset" name="buttonResetClient" onclick='getElement("legendVendeur").innerHTML =""' tabindex=<?= $tabindex++ ?>>
		</div>
	</div>
</form>

<hr />
<fieldset class=fiche>
	<legend class="titreFiche">Le Fichier</legend>
	<div class="alert alert-info">
		<b>Format attendu :</b> Type | Public | Pratique | Marque | Modèle | Couleur | Date achat | Prix achat | Taille | Description | Prix
	</div>
	<form action="Actions/importFile.php" method="post" enctype="multipart/form-data" name=fileForm>
		<input type=hidden name="cli_id" required />
		<div class="row fiche ">
			<div class="col-sm-3 col-md-3 col-xs-12 btnAction">
				Base de numerotation
				<input type=number name="base" size=10	 style="width:50%" required  />
			</div>
			<div class="col-sm-3 col-md-3 col-xs-12 btnAction">
				<input type="file" id="file" name="file" accept=".csv, text/csv" required />
			</div>
			<div class="col-sm-3 col-md-3 col-xs-12 btnAction">
				<button>Importer</button>
			</div>
		</div>
	</form>
</fieldset>