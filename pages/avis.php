<script>
	var idRamdom = "<?= $idRamdom ?>";
	var anneeBav = '<?= $infAppli['numero_bav'] ?>';
</script>
<script src="JS/avis.js"></script>
<br/>
<? if ($infAppli['bav_en_cours'] || $infAppli['ADMIN']) { ?>
<h3 class="titreFiche">Laissez votre avis sur la Bourse aux 1000 vélos</h3>
<form method="post" action="#">
	<div class="row">
		<div class="col-sm-12 col-md-12 col-xs-12">
			<label for="etoiles" onmouseover="inverseStar(null);">Note :</label>
			<? for ($i = 1; $i <= 5; $i++) { ?>
				<!--onmouseover="inverseStar(this);"-->

				<span title='<?= $i ?> point<?= ($i > 1 ? 's' : '') ?>' id="<?= $i ?>pt"
					class=link0
					onclick='inverseStar(this)'
					style='font-size:2em;color: GREY;'>★</span>

			<? } ?>
			<input type='hidden' id="note" value='0' />&nbsp;&nbsp;&nbsp;
			<button type="button" onclick='valideStar(this.form)'>Voter</button>
		</div>
		<div class="col-sm-12 col-md-12 col-xs-12">
			<label for="commentaire">Commentaire :</label><br />
			<textarea name="commentaire" id="commentaire" rows="4" cols="150" required placeholder="Un commentaire (facultatif)"></textarea><br><br>
		</div>
		
	</div>
</form>
<? }?>
<h3 class="titreFiche">Les avis</h3>
<div id=avisCount></div>
<hr/>
<div id=avis></div>