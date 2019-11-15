<script src="JS/parametre.js" type="text/javascript"></script>
<style>
	input[type=date],
	input[type=email],
	input[type=number],
	input[type=text],
	select {

		width: 15%;
	}
</style>

<div id="parametres">
	<h3 class="tittab1">Liste des parametres
		<span class="tittab1" style='align-content: right'>
			<button height="100%" onclick="modeCreation()">
				<span class="fas fa-plus-square"></span>&nbsp;Creation<br />
			</button>
		</span>
	</h3>
	<div id="tab_parametres">
	</div>
</div>
<div id="parametre" style="display:none">
	<form name="parametreForm" method="POST" action="" onsubmit='return valider(document.parametreForm)'>
		<fieldset class=fiche>
			<legend class=titreFiche>Parametre<small>
					<div id="modeParametre"></div>
				</small></legend>
			<table width=100% cellpadding=2 cellspacing=2 style="border:1px solid black">
				<tr>
					<td class="titrow">Actif </td>
					<td class="tabInput">
						<input type=checkbox name="par_actif" tabindex=<?= $tabindex++ ?> onchange="setStartSaisie(true);" />
					</td>
				</tr>
				<tr>
					<td class="titrow" width=15%>Numero BAV <span title="Obligatoire">*<span></td>
					<td class="tabInput" width=35%>
						<input type=text name="par_numero_bav" id="par_numero_bav" size=10 maxlength=10 tabindex="<?= $tabindex++ ?>" placeholder="numéro BAV (année)" onkeyup="setStartSaisie(true);" required />
					</td>
				</tr>
				<tr>
					<td class="titrow">Titre <span title="Obligatoire">*<span></td>
					<td class="tabInput">
						<input type='text' name="par_titre" size=70 maxlength="100" tabindex=<?= $tabindex++ ?> placeholder="titre BAV" onkeyup="setStartSaisie(true);" required style="width:80%" />
					</td>
				</tr>
				<tr>
					<td class="titrow">Taux <span title="Obligatoire">*<span></td>
					<td class="tabInput">
						<input type=number name="par_taux_1" style="width:20%'" tabindex=<?= $tabindex++ ?> placeholder="Taux 1" onkeyup="setStartSaisie(true);" required min=1 max=100 value="10"/>%
						<span id="PAR_TAUX_1" class="error"></span>
						&nbsp;&nbsp;
						<input type=number name="par_taux_2" style="width:20%'" tabindex=<?= $tabindex++ ?> placeholder="Taux 2" onkeyup="setStartSaisie(true);" min=0 max=100 value="5"/>%
						&nbsp;&nbsp;
						<input type=number name="par_taux_3" style="width:20%'" tabindex=<?= $tabindex++ ?> placeholder="Taux 3" onkeyup="setStartSaisie(true);" min=0 max=100 value="0"/>%
					</td>
				</tr>
				<tr>
					<td class="titrow">Depot <span title="Obligatoire">*<span></td>
					<td class="tabInput">
						<input type=number name="par_prix_depot_1" tabindex=<?= $tabindex++ ?> placeholder="00.0" onkeyup="setStartSaisie(true);" required min=1 max=10 size=2 value="3.00"/>&#8364;
						&nbsp;&nbsp;
						<input type=number name="par_prix_depot_2" tabindex=<?= $tabindex++ ?> placeholder="00.0" onkeyup="setStartSaisie(true);" min=0 max=10 size=2 value="1.00"/>&#8364;
						&nbsp;&nbsp;
						<input type=number name="par_prix_depot_3" tabindex=<?= $tabindex++ ?> placeholder="00.0" onkeyup="setStartSaisie(true);" min=0 max=10 size=2 value="0.00"/>&#8364;
					</td>
				</tr>
				<tr>
					<td class="titrow">Nb modif en parallele <span title="Obligatoire">*<span></td>
					<td class="tabInput">
						<input type=number name="par_nb_modif" tabindex=<?= $tabindex++ ?> placeholder="entre 0 et 10" onkeyup="setStartSaisie(true);" required min=0 max=10 size=2 />
					</td>
				</tr>
				<tr>
					<td class="titrow">Dates BAV <span title="Obligatoire">*<span></td>
					<td class="tabInput">
						<input type=date name="par_date_debut_depot" tabindex=<?= $tabindex++ ?> onkeyup="setStartSaisie(true);" required max="2030-12-31" />
						<span class="titrow">Début dépot</span>
						<br />
						<input type=date name="par_date_debut_vente" tabindex=<?= $tabindex++ ?> onkeyup="setStartSaisie(true); " required max="2030-12-31" />
						<span class="titrow">Début vente</span>
						<br />
						<input type=date name="par_date_fin_bav" tabindex=<?= $tabindex++ ?> onkeyup="setStartSaisie(true);" required max="2030-12-31" />
						<span class="titrow">Fin BAV</span>
					</td>
				</tr>
				<tr>
					<td class="titrow">Date Client <span title="Obligatoire">*<span></td>
					<td class="tabInput">
						<input type=date name="par_client_date_debut" size=15 maxlength="15" tabindex=<?= $tabindex++ ?> onkeyup="setStartSaisie(true);" required max="2030-12-31" />
						&nbsp;au&nbsp;
						<input type=date name="par_client_date_fin" tabindex=<?= $tabindex++ ?> onkeyup="setStartSaisie(true);" required max="2030-12-31" />
					</td>
				</tr>
				<tr>
					<td class="titrow">IPs Admin <span title="Obligatoire">*<span></td>
					<td class="tabInput">
						<input type=text name="par_admin_id_mac" style="width:80%" 
						size=50 maxlength="600" tabindex=<?= $tabindex++ ?> placeholder="Adresse ips pour accés admin, séparé d'une virgule" onkeyup="setStartSaisie(true);" required value="localhost, 127:0:0:1, ::1" />
					</td>
				</tr>
				<tr>
					<td class="titrow">Nb etiquette par page A4 </td>
					<td class="tabInput">
						<input type=number name="par_nb_eti_page" tabindex=<?= $tabindex++ ?> placeholder="entre 1 et 20" onkeyup="setStartSaisie(true);" min=1 max=20 size=2 value="5" />
					</td>
				</tr>
				<tr>
					<td class="titrow">Numéro de base pour les fiches infos</td>
					<td class="tabInput">
						<input type=number name="par_numero_base_info" tabindex=<?= $tabindex++ ?> placeholder="entre 1 et 2000" onkeyup="setStartSaisie(true);" min=1 max=2000 size=4 value="700" />
					</td>
				</tr>

			</table>
			<br />

			<table width=100% class=fiche>
				<tr>
					<td width=33% align=center>
						<button name=buttonValideAcheteur tabindex=<?= $tabindex++ ?>>Valider</button>
					</td>
					<td width=33% align=center>
						<input type=button value="Supprimer" onclick="supprimer()" tabindex=<?= $tabindex++ ?>>
					</td>
					<td width=33% align=center>
						<input type=button value="Fermer" onclick="fermerCRUD()" onkeypress="fermerCRUD()" tabindex=<?= $tabindex++ ?>>
					</td>
				</tr>
			</table>
	</form>
</div>