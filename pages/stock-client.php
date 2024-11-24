<script>
	var tri = "obj_marque";
	var sens = "asc";
	var tabSel = {};
	if (BAV_ENCOURS) {
		tabSel['obj_etat'] = 'STOCK';
	} else {
		tabSel['obj_etat'] = 'CONFIRME';
	}
	// tabSel['obj_etat'] = 'RENDU';
	var vueParc = "<?= $infAppli['vue_parc'] ?>";
</script>
<script src="JS/stock-client.js"></script>

<h3>Liste des vélos disponibles triés par marque.</h3>
Cliquez sur l'icone google <img src='https://www.we-do-it-better.fr/wp-content/uploads/2019/04/googlesearch.png' height='20px'/> pour visualer le vélo.
<br />
<div class='row alert alert-info'>
	<div class='col-md-3 col-sm-3 col-xs-12'>
		Recherche des vélos avec un prix compris :
		<input type=radio name="range"
			onclick="searchRange(0,10000)" checked>Tous
	</div>
	<div class='col-md-9 col-sm-9 col-xs-12 maskMobile'>
		<input type=radio name="range"
			onclick="searchRange(0,100)";>de 0 &euro; à 100 &euro;&nbsp;
			<input type=radio name="range"
			onclick="searchRange(100,400)";>de 100 &euro; à 400 &euro;&nbsp;
			<input type=radio name="range"
			onclick="searchRange(400,800)";>de 400 &euro; à 800 &euro;&nbsp;
			<input type=radio name="range"
			onclick="searchRange(800,10000)";>plud de 800 &euro;&nbsp;
	</div>
	<div class='col-md-9 col-sm-9 col-xs-12 onMobile'>
		<input type=radio name="range"
			onclick="searchRange(0,100)";>< 100&euro;
			<input type=radio name="range"
			onclick="searchRange(100,400)";>100&euro; à 400&euro;
			<input type=radio name="range"
			onclick="searchRange(400,800)";>400&euro; à 800&euro;
			<input type=radio name="range"
			onclick="searchRange(800,10000)";>> 800&euro;
	</div>

	<div class='col-md-8 col-sm-8 col-xs-8'>
		Critères : <input type=text class="autocomplete" name='search_<?= rand(1, 100) ?>' size="10" maxlength="100" onkeyup="search(this.value)" style='width:70%'
			id=searchAll
			placeholder="Recherche avec plusieurs mots possible." />
	</div>
	<div class='col-md-4 col-sm-4 col-xs-4'>
		Nb <span id=total></span>
	</div>
</div>
<div id=fiches></div>