<?$idRamdom = rand(1000, 9999);?>
<script>
	var idFaq = '<?=$GET_id?>';
	// pour rendre le champ nom du client unique
	var idRamdom = "<?=$idRamdom?>";
	
</script>

<script src="JS/faq.js" type="text/javascript"></script>

<h3>FOIRE AUX QUESTIONS</h3>

<p style="padding-bottom : 15px;"><span class="label label-success">ASTUCE AVS</span>
	Poser votre question en utilisant le <a href="#formulaire">formulaire</a> en bas de la page. Nous vous répondrons dans
	les meilleurs délais</p>


Recherche : <input type=text name='search_<?=rand(1, 100)?>' size="20"
 maxlength="100" onkeyup="search(this.value)" />
<hr />

<!-- SHOW Q & A -->
<div id="faqs"></div>

<!-- SHOW FORM TO SUBMIT QUESTION -->
<fieldset class=fiche>
	<legend class=titreFiche>Poser votre question</legend>
	<a name="formulaire"></a>
	<p>Utiliser le formulaire ci-dessous pour poser votre question. Nous vous répondrons dans les meilleurs délais :</p>

	<form method="POST" onsubmit="return submitFAQ(this)">
		<div class="row">
			<div class="col-sm-12 col-xs-12">
				<div class="form-group">
					<label for="name" class="titrow  col-sm-2">* Nom</label>
					<div class="col-sm-6">
						<input type="text" name="faq_name" required />
					</div>
				</div>
			</div>

			<div class="col-sm-12 col-xs-12">
				<div class="form-group">
					<label for="email" class="titrow  col-sm-2">* Mail</label>
					<div class="col-sm-6">
						<input type="email" name="faq_email"  required />
					</div>
				</div>
			</div>

			<div class="col-sm-12 col-xs-12">
				<div class="form-group">
					<label for="question" class="titrow  col-sm-2">*Question</label>
					<div class="col-sm-6">
						<textarea name="faq_question"  rows=5 cols=100 required></textarea>
					</div>
				</div>
			</div>


			<div class="col-sm-12 col-xs-12">
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" name="submit" value="submit" class="btn btn-success">Envoyer</button>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-xs-12">
				* champs obligatoires (votre adresse mail ne sera pas affiché)
			</div>
		</div>
	</form>
</fieldset>