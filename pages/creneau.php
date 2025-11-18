<script>
	var idRamdom = "<?= $idRamdom ?>";
	var anneeBav = '<?= $infAppli['numero_bav'] ?>';

	var dateJ1 = "<?= date("Y-m-d", $infAppli['date_j1']) ?>";
	var dateJ2 = "<?= date("Y-m-d", $infAppli['date_j2']) ?>";
</script>
<script src="JS/creneau.js"></script>
<br />
<h3 class="titreFiche">Gestion des créneaux de dépôts.</h3>
<br />
<form action="#" name="formCreneau">
	Début du créneau :&nbsp;<input
		type="datetime-local"
		id="debut"
		name="debut"
		value="<?= date("Y-m-d", $infAppli['date_j1']) ?> 17:00"
		min="<?= date("Y-m-d", $infAppli['date_j1']) ?> 16:00"
		max="<?= date("Y-m-d", $infAppli['date_j2']) ?> 19:00" />
	&nbsp;<div class="onMobile" ></div>jusqu'à&nbsp;
	<input
		type="datetime-local"
		id="fin"
		name="fin"
		value="<?= date("Y-m-d", $infAppli['date_j1']) ?> 17:30"
		min="<?= date("Y-m-d", $infAppli['date_j1']) ?> 16:00"
		max="<?= date("Y-m-d", $infAppli['date_j2']) ?> 19:00" />
		&nbsp;&nbsp;
	<input type=button value="Ajouter" onclick="addCreneau(document.formCreneau)" />
</form>
<hr/>
<div id="creneaux" ></div>
<div id="creneauxClass" >...</div>