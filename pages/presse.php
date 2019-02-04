<?$idRamdom = rand(1000, 9999);?>
<script>
	var idFaq = '<?=$GET_id?>';
	// pour rendre le champ nom du client unique
	var idRamdom = "<?=$idRamdom?>";
</script>

<script src="JS/presse.js" type="text/javascript"></script>

<h3 class="titreFiche">LA BOURSE AUX VELOS DANS LA PRESSE</h3>

Recherche : <input type=text name='search_<?=rand(1, 100)?>' size="20"
 maxlength="100" onkeyup="search(this.value)" />
<hr />

<!-- SHOW Q & A -->
<div id="actus"></div>

<? if ($infAppli['ADMIN']) { ?>
<!-- SHOW FORM TO SUBMIT QUESTION -->
<fieldset class=fiche>
	<legend class=titreFiche>Deposer une article de pressse</legend>
	<form method="POST" name="formPresse" onsubmit="return submitPresse(this)">
        <input type=hidden name="act_numero_bav" value="<?=$_COOKIE['NUMERO_BAV']?>"/>
		<div class="row">
			<div class="col-sm-12 col-xs-12">
				<div class="form-group">
					<label for="question" class="titrow  col-sm-2">* Titre</label>
					<div class="col-sm-6">
						<textarea name="faq_question" style='width:100%' rows=5 id='edit_act' contenteditable='true' required></textarea>
						<script>
							CKEDITOR.config.enterMode = CKEDITOR.ENTER_BR;
							CKEDITOR.config.shiftEnterMode = CKEDITOR.ENTER_P;
                            
                            myconfig = CKEDITOR.config;
                            myconfig.toolbarGroups = [
								{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
								{ name: 'paragraph',   groups: [ 'blocks', 'align' ] }
                            ];
                            CKEDITOR.replace("edit_act",myconfig);
						</script>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-xs-12">
				<div class="form-group">
					<label for="question" class="titrow  col-sm-2">* Article</label>
					<div class="col-sm-6">
						<textarea name="faq_question" style='width:100%' rows=5 id='edit_act_article' contenteditable='true' required></textarea>
						<script>
							CKEDITOR.replace("edit_act_article");
							
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
		</div>
	</form>
</fieldset>
<?}?>