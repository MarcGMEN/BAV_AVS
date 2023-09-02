<script>
	function initPage() {}

	function unloadPage() {}
</script>

<div class="row">
	<div class="col-xs-12 col-sm-6 col-md-6" style="vertical-align:top">
		<fieldset class=fiche>
			<legend class=titreFiche>Comment Venir</legend>
			<p style="vertical-align:middle"><A href="https://www.stran.fr/" target="_blank" alt="www.stran.fr" class="link url">STRAN</A>
				: hélYce, U2
				<img src="Images/stranSoucoupe.png" width=150px height=auto class=link onclick=' alertModalInfo("<img width=100% height=400px src=\"Images/stranSoucoupe.png\" alt=\"plan STRAN\" />")' />
			</p>
			<p>La Soucoupe, avenue Léo Lagrange, 44600 ST NAZAIRE</p>
			<div class="mapouter">
				<div class="gmap_canvas">
					<iframe width="100%" height="300px" id="gmap_canvas" src="https://maps.google.com/maps?q=la soucoupe avenue leo lagrange, saint nazaire, france, &t=&z=14&ie=UTF8&iwloc=&output=embed"
					 frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
					</iframe>
				</div>
				<style>
					.mapouter {
						overflow: hidden;
						height: 300px;
						width: 100%;
					}

					.gmap_canvas {
						background: none !important;
						height: 300px;
						width: 100%;
					}
				</style>
			</div>
		</fieldset>
	</div>
	<div class="col-xs-12 col-sm-6 col-md-6" style="vertical-align:top">
		<fieldset class=fiche>
			<legend class=titreFiche>Contact</legend>
			<p>En cas de question concernant la <b>Bourse aux Vélos</b>,
				veuillez consulter notre
				<span class="link url" onclick='goTo("faq.php",null, null, null)' )>Foire Aux Questions</span>
				<p>Pour toute autre demande, contactez-nous directement :</p>

				<p><span class="label label-info">Email</span>
					<a href='mailto:bourse1000velos@avs44.com' class="url">bourse1000velos@avs44.com</a></p>
				<p><span class="label label-info">Tél</span>
					<span style="font-size: 16px;">06.46.58.06.61</span></p>
				<p><span class="label label-info"><img src="Images/iconeInstagram.png" height="20px"></span>
					<span style="font-size: 16px;"><A href='https://www.instagram.com/bourse.aux.1000.velos/?hl=fr'  target='_blank'>@bourse.aux.1000.velos</A></span></p>
				<p><span class="label label-info"><img src="Images/iconeFacebook.png" height="20px"></span>
					<span style="font-size: 16px;"><A href='https://fb.me/e/2OXOMDsqp' target='_blank'>19eme Bourse aux 1000 vélos</A></span></p>

		</fieldset>
	</div>
</div>