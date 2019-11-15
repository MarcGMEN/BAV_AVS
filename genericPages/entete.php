<script src="JS/entete.js" type="text/javascript"></script>

<table class="BH_CADRE" cellspacing="0" cellpadding="0">
	<tr height="100%">
		<td width="12%">
			<div class="row">
				<div class="col-sm-6 col-md-6 col-xs-6 menuMobile">
					<i class="fas fa-bars" style="font-size:36px" onclick="menuSel()"></i>
				</div>
				<div class="col-sm-12 col-md-12 col-xs-6 maskMobile">
					<img src="Images/cycleBAV.png" id="cycleBAV" class=link onclick="location.href='index.php'" />
					<p style="font-size:0.7em" id=timeRestant></p>
				</div>
			</div>
		</td>
		<td width="73%">
			<div class="TITRE_FENETRE_PRINCIPALE">
				<?= $infAppli['titre']; ?>
			</div>
			<?php if ($infAppli['ADMIN']) {
				include './genericPages/menuTABLE.php';
			} ?>
		</td>
		<td width="15%">
			<!--<span style="float: left; display:none" id="theMenu">
				<i class="fas fa-bars fa-3x" onclick="inverseDisplay('divMenu')"></i>
				<div style="position:absolute; display:none" id='divMenu'>
					<div class="MENU">
						<div style='text-algin: center'>Menu</div>
						<hr />
						<div class="link" onclick='goTo("parametre.php")'>Parametres</A></div>

					</div>
				</div>
			</span>-->
			<div style="float: left">
				<img src="Images/logoAVS.png" id="logoAVS" height='120pt'>
			</div>
			<div class="link" style="position:absolute; float: right; vertical-align:middle; font-size: 0.5em" onclick="alertModalPass();"><?= $_COOKIE['NUMERO_BAV']; ?>&nbsp;<span id="connex"></span>
			</div>
		</td>
	</tr>
</table>
<table class="BH_CADRE" cellspacing="0" cellpadding="0">
	<tr>
		<th class="tdMenu">
			<?php include './genericPages/navigation.php'; ?>
		</th>
		<td class="tdSearch" id="tdSearch" style="display:none">
			<form name="enteteFormFiche" action="#" onsubmit='return search(document.enteteFormFiche.inputSearch.value)'>
				<input type="text" name="numeroFiche" size="8" maxlength="50" title="Saisisez le numéro de fiche" placeholder="N° fiche" id="inputSearch" onsubmit='search(this.value)' style='background-color:LIGHTGREEN;font-weight: bold' />
				<i id="loupe" class="fas fa-search link " onclick="search(document.enteteFormFiche.inputSearch.value)"></i>
			</form>
		</td>
	</tr>
</table>