<? $idRamdom = rand(1000, 9999); ?>
<script>
	var idRamdom = "<?= $idRamdom ?>";
</script>
<script src="JS/pre_depot.js" type="text/javascript"></script>

<div class='alert alert-info' id="informations">
	<p>Avant de venir déposer votre vélo les à La Soucoupe, nous vous conseillons de remplir la fiche dépôt.</p>
	<p>- Soit en saissisant votre demande avec le formulaire ci-dessous qui vous transmettra, après confirmation, la fiche dépot par mel.
		<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Il n'est pas nécéssaire de connaitre le prix de vente, <i>vous pourrez le renseigner le jour du dépôt.</i>
		<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Vous pouvez également modifier votre fiche grace au lien que vous recevrez par mel.
		<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Vous recevez un mel directement lorsque votre vélo est vendu.</b>
		<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cette fiche dépôt devra être imprimée par vous pour vous rendre à la Bourse. Une par vélo et un gain de temps sur place lors du dépôt.
	</p>
	<p>- Soit en téléchargeant, puis en imprimant la fiche dépôt à remplir que vous trouverez ici
		<A href="downloads/Fiche_BAV_2021.pdf" target="_blank"> <img class="link url" src="Images/pdf.png" height='40px' alt="téléchargement de la fiche" title="téléchargement de la fiche"></A>
		<small><i>Attention aux droits d'ouvertures des popUp, en fonction de votre navigateur.</i></small>
	</p>
	<p>- Si vous souhaitez déposer plus de 15 vélos, contactez nous pour mettre en place un procédure spéciale.
		<a href="mailto:bourse1000velos@avs44.com">bourse1000velos@avs44.com</a>
	</p>
	<h2 class='alert alert-warning'> Attention , nouvelle Procédure </h2>
</div>

<div class="row" id="connexions">
	<div class="col-sm-12 col-md-12 col-xs-12 ">
		<div class="col-sm-5 col-md-5 col-xs-12 alert alert-info" id='div_first_connexion'>
			<form name="firstAccesForm" method="POST" onsubmit="return submitFormFA(this)" action="#">

				<div class="col-sm-12 col-md-12 col-xs-12 ">
					Pour votre premier pré-dépôt il faut vous enregistrer,
				</div>
				<div class="col-sm-10 col-md-10 col-xs-12">
					<input type='email' width=10% size=30 maxlength="80" name='new_email_depot' required placeholder="Saisise votre mail" value="dggdg@frfrf.fr"/>
				</div>
				<div class="col-sm-2 col-md-2 col-xs-12">
					<input type='submit' value="S'enregrister" />
				</div>
			</form>
		</div>
		<div class="col-sm-1 col-md-1 col-xs-12 alert alert-warning" style='text-align: center;'>
			OU
		</div>
		<div class="col-sm-6 col-md-6 col-xs-12 alert alert-info" id='div_connexion'>
			<form name="accesForm" method="POST" onsubmit="return submitFormConnex(this)" action="">
				<div class="col-sm-6 col-md-6 col-xs-12">
					Vous vous êtes déjà enregister <input type='email' size=30 maxlength="80" required name='email_depot' placeholder="Saisise votre mail" />
					<p class="link" onclick='renvoiCode(document.accesForm)'>Code d'accès oublié</p>
				</div>
				<div class="col-sm-5 col-md-5 col-xs-12">
					Code d'accès <br /><small>(Reçu par mail lors de l'enregistrement)</small><input type='password' name='pass_depot' required placeholder="Le code d'accès" />
				</div>
				<div class="col-sm-1 col-md-1 col-xs-12">
					<input type='submit' value='Connexion' />
				</div>

			</form>
		</div>
	</div>
</div>

<!-- ###################################################################################### -->
<div class="row" id="input_first_connexion" style="display:none;">
	<form name="formPreSaisie" method="POST" onsubmit="return submitPreSaisie(this)">
		<fieldset class=fiche>
			<legend class="titreFiche" id='legendVendeur'>
				Vos coordonnées pour vous enregister a la <?=$infAppli['titre']?>
			</legend>
			<div class="row">
				<div class="col-sm-6 col-md-6 col-xs-12">
					<span class="titrow  col-md-3 col-sm-3 col-xs-3">Mail <span title="Obligatoire">*</span></span>
					<span class="tabInput col-md-9 col-sm-9 col-xs-9">
						<input type=email name='cli_emel' id="cli_emel" size="50" maxlength="100" tabindex=<?= $tabindex++ ?> placeholder="aaaa.bbbb@ccc.dd" required />
					</span>
				</div>
				<div class="col-sm-6 col-md-6 col-xs-12">
					<span class="titrow  col-md-3 col-sm-3 col-xs-3">Nom et prénom <span title="Obligatoire">*</span></span>
					<span class="tabInput col-md-9 col-sm-9 col-xs-9">
						<input type=text name='cli_nom' tabindex=<?= $tabindex++ ?> size="50" maxlength="100" required />
					</span>
				</div>
				<div class="col-sm-6 col-md-6 col-xs-12">
					<span class="titrow  col-md-3 col-sm-3 col-xs-3">Adresse</span>
					<span class="tabInput col-md-9 col-sm-9 col-xs-9">
						<input type=text name="cli_adresse" size=50 maxlength='100' tabindex=<?= $tabindex++ ?> placeholder="Adresse" />
						<br />
						<input type=text name="cli_adresse1" size=50 maxlength='100' tabindex=<?= $tabindex++ ?> placeholder="Complement adresse" />
						<br />
						<input type=text name="cli_code_postal" size=5 maxlength='10' tabindex=<?= $tabindex++ ?> placeholder="Code postal" />
						<input type=text name="cli_ville" size=40 maxlength='100' tabindex=<?= $tabindex++ ?> placeholder="Ville" />
					</span>
				</div>
				<div class="col-sm-6 col-md-6 col-xs-12">
					<span class="titrow  col-md-3 col-sm-3 col-xs-3">Telephone</span>
					<span class="tabInput col-md-9 col-sm-9 col-xs-9">
						<input type=text name='cli_telephone' size="15" maxlength="15" tabindex=<?= $tabindex++ ?> placeholder="Pour vous joindre durant la bourse" title="Pour vous joindre durant la bourse" />
						<input type=text name='cli_telephone_bis' size="15" maxlength="15" tabindex=<?= $tabindex++ ?> placeholder="autre numéro" title="autre numéro" />
					</span>
				</div>
			</div>

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
					<input type="submit" tabindex=<?= $tabindex++ ?> value="Enregistrer" />
					
				</div>

				<div class="col-sm-3 col-md-3 col-xs-6 btnAction">
					<input type=button value="Annuler" onclick="fermer_PreSaisie()" tabindex=<?= $tabindex++ ?>>
				</div>
			</div>
		</fieldset>
	</form>
</div>