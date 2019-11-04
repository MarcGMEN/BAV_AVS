<?$idRamdom = rand(1000, 9999);?>
<script>
	var idFaq = '<?=$GET_id?>';
	// pour rendre le champ nom du client unique
	var idRamdom = "<?=$idRamdom?>";
</script>

// test push en ssh key

<script src="JS/faq.js" type="text/javascript"></script>

<h3 class="titreFiche">FOIRE AUX QUESTIONS</h3>

<? if (!$infAppli['ADMIN']) { ?>
<div class="alert alert-success"><span class="label label-success">ASTUCE AVS</span>
	Poser votre question en utilisant le <a class="link" href="#formulaire">formulaire</a> en bas de la page. Nous vous répondrons dans
	les meilleurs délais</div>
<? }?>


Recherche : <input type=text name='search_<?=rand(1, 100)?>' size="20"
 maxlength="100" onkeyup="search(this.value)" />
<hr />

<!-- SHOW Q & A -->
<div id="faqs"></div>

<? if (!$infAppli['ADMIN']) { ?>
<!-- SHOW FORM TO SUBMIT QUESTION -->
<fieldset class=fiche>
	<legend class=titreFiche>Poser votre question</legend>
	<a name="formulaire"></a>
	<p>Utiliser le formulaire ci-dessous pour poser votre question. Nous vous répondrons dans les meilleurs délais :</p>

	<form method="POST" name="formFaq" onsubmit="return submitFAQ(this)">
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
						<textarea name="faq_question" style='width:100%' rows=5 id='edit_faq' contenteditable='true' required></textarea>
						<script>
							CKEDITOR.config.toolbarGroups = [
								{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
								{ name: 'paragraph',   groups: [ 'blocks', 'align' ] }
							];
							CKEDITOR.config.enterMode = CKEDITOR.ENTER_BR;
							CKEDITOR.config.shiftEnterMode = CKEDITOR.ENTER_P;
							
							CKEDITOR.replace("edit_faq", CKEDITOR.config);
							
                            
						</script>
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
<?}?>