<script>
	var typeACT ="FAQ";
</script>
<h3 class="titreFiche">FOIRE AUX QUESTIONS</h3>

<? if (!$infAppli['ADMIN']) { ?>
<div class="alert alert-success"><span class="label label-success">ASTUCE AVS</span>
	Poser votre question en utilisant le <a class="link" href="#formulaire">formulaire</a> en bas de la page. Nous vous répondrons dans
	les meilleurs délais</div>
<? }?>

<? include "pages/actuGeneriqueBis.php" ?>