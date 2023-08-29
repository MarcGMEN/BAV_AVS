<script src="JS/entete.js" type="text/javascript"></script>

<table class="BH_CADRE" cellspacing="0" cellpadding="0">
	<tr height="100%">
		<td width="12%">
			<div class="row">
				<div class="col-sm-6 col-md-6 col-xs-6 menuMobile " style='text-align: left; border:1px solid blue' onclick="menuSel()">

						<br/><b>Menu</b><br/><br/>
					<!-- <i class="fas fa-bars"  aria-hidden="true" style="font-size:36px" onclick="menuSel()"></i> -->
					<!-- <img src="Images/menuBars.png" height=100 width=100>  -->
					<!-- <div style="font-size:0.5em;color:black" >
						&boxh;&boxh;&boxh;&boxh;<br/>
						&boxh;&boxh;&boxh;&boxh;<br/>
						&boxh;&boxh;&boxh;&boxh;
					</div> -->
				</div>
				<div class="col-sm-12 col-md-12 col-xs-6 maskMobile" >
					<img src="Images/BAV_2020.png" id="cycleBAV" class=link onclick="location.href='index.php'" />
					<!-- <img src="Images/cycleBAV.png" id="cycleBAV" class=link onclick="location.href='index.php'" /> -->
					<p style="font-size:0.7em" id=timeRestant></p>
				</div>
				
			</div>
		</td>
		<td width="78%">
			<div class="TITRE_FENETRE_PRINCIPALE">
				<?= retraitAccent($infAppli['titre']) ?>
			</div>
			<?php if ($infAppli['ADMIN']) {
				include './genericPages/menuTABLE.php';
			}?>
		</td>
		<td width="10%">
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
				<img src="Images/logoAVS.png" id="logoAVS" height='80pt'>
			</div>
			<div class="link" style="position:absolute; float: right; vertical-align:middle; font-size: 0.5em" onclick="alertModalPass();">
				<?= $infAppli['numero_bav']; ?>&nbsp;<span id="connex">
				</span>
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
			<form class="maskMobile" name="enteteFormFiche" action="#" onsubmit='return searchFiche(document.enteteFormFiche.inputSearch.value)'>
				<input type="text" name="numeroFiche" size="8" maxlength="20" title="Saisisez le numéro de fiche" placeholder="N° fiche" id="inputSearch" onsubmit='search(this.value)' style='background-color:LIGHTGREEN;font-weight: bold' />
				<i id="loupe" class="fas fa-search link loupe" onclick="searchFiche(document.enteteFormFiche.inputSearch.value)"></i>
			</form>
		</td>
	</tr>
</table>