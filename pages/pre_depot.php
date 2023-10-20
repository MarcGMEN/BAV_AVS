<? $idRamdom = rand(1000, 9999); ?>
<script>
	var idRamdom = "<?= $idRamdom ?>";
</script>
<script src="JS/pre_depot.js" type="text/javascript"></script>

<h3 class="titreFiche">Pré-dépôt en ligne</h3>

<? if ($infAppli['CLIENT'] || $GET_modePage=="createTEST") { ?>
	<div class='alert alert-info' id="informations">
		<p>Avant de venir déposer votre vélo les à La Soucoupe, nous vous conseillons de remplir la fiche dépôt.</p>
		<div class="maskmobile">
		<p>- Soit en vous identfiant avec le formulaire ci-dessous et enusite saisir vos pré-dépôts directement sur le site de la Bourse.</p>
		<ul>
			<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Il n'est pas nécéssaire de connaitre le prix de vente, <i>vous pourrez le renseigner le jour du dépôt.</i></li>
			<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Vous accèderez au dépôt le vendredi à la Soucoupe via des files prioritaires.</li>
			<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Vous pouvez également modifier votre compte.</li>
			<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Vous recevez un mail directement lorsque votre vélo est vendu.</b></li>
			<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cette fiche dépôt devra être <b>imprimée par vous</b> pour vous rendre à la Bourse, une par dépôt.</li>
		</ul>
		<p>- Soit en téléchargeant, puis en imprimant la fiche dépôt à remplir que vous trouverez ici
			<A href="downloads/Fiche_BAV_2023.pdf" target="_blank"> <img class="link url" src="Images/pdf.png" height='30px' alt="téléchargement de la fiche" title="téléchargement de la fiche"></A>
			<small><i>Attention aux droits d'ouvertures des popUp, en fonction de votre navigateur.</i></small>
		</p>
		</div>
		<p>- Si vous souhaitez déposer plus de 15 vélos, contactez nous pour mettre en place un procédure spéciale.
			<a href="mailto:bourse1000velos@avs44.com">bourse1000velos@avs44.com</a>
		</p>
		<div class='alert alert-warning'>
		<h3> Attention , nouvelle Procédure </h3>
		<h4> Vous devez d'abord vous pré-enregistrer avec votre e-mail, puis vous recevrez un mail avec votre code d'accès. <br/>Ensuite dans le partie connexion saisissez votre e-mail et le code d'accès pour accèder à la gestion de votre compte. </h4>
		</div>
	</div>
<? } else { ?>
	<h3> Accès à votre compte </h3>
<? } ?>
<div class="row" id="connexions">
	<div class="col-sm-12 col-md-12 col-xs-12 ">
		<? if ($infAppli['CLIENT']  || $GET_modePage=="createTEST") { ?>
			<div class="col-sm-5 col-md-5 col-xs-12 alert alert-info" id='div_first_connexion'>
				<div class="col-sm-12 col-md-12 col-xs-12 ">
					<h4>Pré-enregistrement<h4>
				</div>

				<form name="firstAccesForm" method="POST" onsubmit="return submitFormFA(this)" action="#">
					<div class="col-sm-12 col-md-12 col-xs-12 ">
						Pour votre premier pré-dépôt il faut vous enregistrer,
					</div>
					<div class="col-sm-9 col-md-9 col-xs-12">
						<input type='email' width=10% size=30 maxlength="80" name='new_email_depot' required placeholder="Saisissez votre e-mail" />
					</div>
					<div class="col-sm-3 col-md-3 col-xs-12">
						<input type='submit' value="S'enregrister" />
					</div>
				</form>
			</div>
			<div class="col-sm-1 col-md-1 col-xs-12 alert alert-warning maskmobile" style='text-align: center;'>
				==>
			</div>
		<? } ?>
		<div class="col-sm-6 col-md-6 col-xs-12 alert alert-info" id='div_connexion'>
			<div class="col-sm-12 col-md-12 col-xs-12 ">
				<h4>Connexion<h4>
			</div>
			<form name="accesForm" method="POST" onsubmit="return submitFormConnex(this)" action="">
				<div class="col-sm-5 col-md-4 col-xs-12">
					Vous êtes déjà enregister<br/>
					<input type='email' size=30 maxlength="80" required name='email_depot' placeholder="Saisissez votre e-mail" />
					<p class="link" onclick='renvoiCode(document.accesForm)'>Code d'accès oublié</p>
				</div>
				<div class="col-sm-5 col-md-5 col-xs-12">
					Code d'accès<br/><input type='password'  autocomplete='current-password' name='pass_depot' required placeholder="Le code d'accès" />
					<p><small>(Reçu par mail lors de l'enregistrement)</small></p>
				</div>
				<div class="col-sm-2 col-md-2 col-xs-12">
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
				Vos coordonnées pour vous enregister à la <?= $infAppli['titre'] ?>
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