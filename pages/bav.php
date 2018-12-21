<script>
	function initPage() {}

	function unloadPage() {}
</script>
<h3 class="titreFiche">LA BOURSE</h3>

<p>Après le succès des 14 premières années (70 % de vélos vendus et 6200 visiteurs durant le week-end en 2017), l’AVS
	Saint Nazaire organise en novembre 2018, la 15ème édition de la <b>Bourse aux Vélos</b> de <b>St Nazaire</b>
	(Loire-Atlantique).</p>
<p>Cette manifestation est ouverte à tous, et, toutes sortes de vélos (route, VTT, vélos d’enfant, VTC, cadre,
	tandems…) sont acceptés à condition qu’ils soient en parfait état de fonctionnement.</p>
<p>Le vendeur dépose son vélo qui est exposé pour les deux jours de l’événement, l’organisateur s’occupe de la vente
	et, en cas de vente seulement, une commission est due (frais d’organisation) par le vendeur. Que vous soyez vendeur ou
	à la recherche d’un vélo d’occasion, ce rendez-vous est incontournable pour tous les passionnés de vélo dans l’Ouest !</p>
<p>Entrée gratuite !</span></p>
<p>Tous les membres de l’AVS répondent présent à l’appel pour contribuer à cet évenement annuel. <span class="bold">Convivialité
		et qualité!</span></p>

<ul>
	<li><span class="italic">Consultez les photos des éditions précédentes dans notre galérie : </span><a href="https://photos.google.com/share/AF1QipMh3X5bviVbraxFdOSBTfz0bSKKKC0nE0zYDt4az2mThdoQ91Ms0B1QRBosLllQ6g?key=YzU2ZlBpRERHaGt0QXZJNUhzd3I4Q0J2bDNCeGxR"
		 target="_blank"><span class="glyphicon glyphicon-camera"></span></a></li>
</ul>

<h3 class="titreFiche">NOS STATISTIQUES</h3>

<div class="row">

    <div class="col-sm-6 col-md-6 col-xs-12">
            <p>Statistique de l'année 2017</p>
            <img src="Images/statistiques_2017.jpg"  class="imgBAV" />
    </div>
    <div class="col-sm-6 col-md-6 col-xs-12">
            <p>La première colonne représente le nombre de vélos déposés, la deuxième, le nombre de vélos vendus.</p>
			<img src="Images/statistiques.png"  class="link imgBAV" onclick='
				alertModalInfo("<img width=70% height=auto src=\"Images/statistiques.png\" alt=\"statistique BAV\" />")' />
    </div>
</div>

<h3 class="titreFiche">QUOI VENDRE ?</h3>
<p>Tous les types de vélos sont acceptés : VTT, route, VTC, vélos d’enfants, vélos de ville, tandems, cadres… Les
	accessoires ne sont pas acceptés. <span class="bold">Attention : seuls les vélos en parfait état de fonctionnement
		sont acceptés</span>.</p>
<p>Vous déposez votre vélo, le prix est fixé par le vendeur mais il peut être conseillé par les organisateurs. Le vélo
	est ensuite exposé et vendu par les organisateurs pendant les deux jours de la <b>Bourse aux Vélos</b>.
	A l’issue du week-end, les vendeurs viennent chercher leur chèque en cas de vente ou leur vélo en cas d’invendu.</p>

<?php
	$data = array('date1'=>8, 'date2'=>9, 'date3'=>10, 'mois'=>'novembre', 'annee'=>2019,'URL'=>$CFG_URL);
	$message = makeCorps($data, "reglement.html");
?>
<script>
	var data = "";
	data ="<? foreach ($data as $key => $val) {echo $key."#3D".$val."#2C";}?>";
</script>
<span class="link url" onclick='x_action_makePDFFromHtml(data,"reglement.html", display_openPDF);' )>
	Telecharger le reglement</span>
	
<div class="alert alert-info">
	<p><b>ASTUCE AVS</b> :
		<ul>
			<li>Télécharger et remplir votre fiche d'inscription à l'avance pour gagner du temps :
				<span class="link url" onclick='x_action_makePDF(new Array(), display_openPDF);' )>fiche depot</span>
			</li>
			<li>Télécharger et remplir votre état des lieux (pour les très beaux vélos)
				<span class="link url" onclick=' window.open("downloads/etat_des_lieux.pdf", "_blank");'>
					Etat des lieux</span>

	</p>
</div>

<div class="alert alert-success">
	<form name="bavForm">
	<p><b>ASTUCE AVS</b> : Suivre les ventes en direct pour savoir si votre vélo est vendu, en indiquant ci-dessous votre numéro de dépot :
		<input type="text" name="numeroFiche" size="15" width=10% title="Saisisez le numéro de fiche, ou l'identifiant de la fiche"
						 placeholder="Recherche" id="inputSearchBav" />
		<i class="fas fa-search link" onclick="search(bavForm.inputSearchBav.value)"></i>
		</form>
	</p>
</div>

<div class="alert alert-warning">
	<p><b>DEPUIS 2015</b> : Si la vente est effective,
		le paiement au vendeur pourra être réalisé par correspondance
		<u>pour les personnes habitant à plus de 30 km de St Nazaire</u>.
		Dans ce cas, le vendeur devra faire parvenir à la Bourse aux vélos :
		les 10% (Au moment du dépôt, il devra demander l’adresse de la BAV).
		<br />
		Dans le courrier envoyé, il devra fournir en plus des 10%, une enveloppe
		timbrée à son adresse et le reçu vendeur de couleur. Dès réception,
		le montant de la vente lui sera envoyé.(Transaction souhaitable dans
		la semaine qui suit la Bourse aux vélos). <br />Consultez la
		<span class="link url" onclick=' window.open("downloads/bav_rayon_30_km.pdf", "_blank");'>PAIEMENT PAR CORRESPONDANCE</span>
		pour plus d'informations.</p>
</div>


<h3 class="titreFiche">PROGRAMME</h3>

<h5>Vendredi :</h5>
<ul>
	<li>18h à 21h : uniquement dépôt du matériel « bon plan pour éviter la foule du samedi matin ! »</li>
</ul>


<h5>Samedi :</h5>
<ul>
	<li>8h à 19h : dépôt et vente du matériel</li>
</ul>

<h5>Dimanche :</h5>

<ul>
	<li>8h à 14h : dépôt et vente du matériel</li>
	<li>14h à 19h : vente du matériel</li>
	<li>17h à 19h : restitution des invendus</li>
</ul>

<p>Lieu : <b><span class="link url" onclick='goTo("venir.php",null, null, null)' )>Soucoupe</span>, avenue Léo
		Lagrange, Saint-Nazaire</b></p>

<h3 class="titreFiche">PRINCIPES</h3>
<ul>
	<li>C’est une manifestation ouverte à tous (entrée gratuite) ;</li>
	<li>Nous acceptons toutes sortes de vélos à condition qu’ils soient en parfait état de fonctionnement ;</li>
	<li>Nous prenons seulement 3 euros par vélo exposé pour les deux jours ;</li>
	<li>Nous nous occupons de la vente des vélos sur les deux jours ;</li>
	<li>En cas de vente seulement, une commission est due (frais d’organisation, voir règlement en téléchargement) par le
		vendeur.</li>
</ul>

<p>Grâce à notre expérience, nous sommes à votre disposition afin de vous conseiller sur l’achat des vélos (taille,
	rapport qualité-prix, etc…).</p>