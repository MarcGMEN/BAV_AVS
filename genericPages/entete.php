<script src="JS/entete.js" type="text/javascript"></script>

<div class="BH_CADRE" cellspacing="0" cellpadding="0">
	<div class="row"  style='background-color:#0bd;height:30px;vertical-align: middle;'>
		<div class="col-xs-4 col-sm-1 col-md-1">
			<a href="https://www.facebook.com/events/1924975591261118" target="_blank"><img src="Images/iconeFacebook.png" height=20px/></a>
			&nbsp;&nbsp;
			<a href="https://www.instagram.com/bourse.aux.1000.velos/"  target="_blank"><img src="Images/iconeInstagram.png" height=20px/></a> 
		</div>
		<div class="col-xs-8 col-sm-9 col-md-9 maskMobile">
			<?php if ($infAppli['ADMIN']) {
				include './genericPages/menuTABLE.php';
			}?>
		</div>
		<div class="col-xs-2 col-sm-2 col-md-2 maskMobile">
			#bourseaux1000velos&nbsp;#atlantiqueVeloSport
		</div>
	</div>
	<div class="row">
		<div class="col-xs-2 col-sm-1 col-md-1">
				<div class="menuMobile "   onclick="menuSel()">
					&boxh;&boxh;&boxh;&boxh;<br/>
					<b>Menu</b><br/>
					&boxh;&boxh;&boxh;&boxh;<br/>
					<!-- <i class="fas fa-bars"  aria-hidden="true" style="font-size:36px" onclick="menuSel()"></i> -->
					<!-- <img src="Images/menuBars.png" height=100 width=100>  -->
					<!-- <div style="font-size:0.5em;color:black" >
						&boxh;&boxh;&boxh;&boxh;<br/>
						&boxh;&boxh;&boxh;&boxh;<br/>
						&boxh;&boxh;&boxh;&boxh;
					</div> -->
				</div>
				<div class="maskMobile" >
					<img src="Images/BAV_2020.png" id="cycleBAV" class=link onclick="location.href='index.php'" />
					<!-- <img src="Images/cycleBAV.png" id="cycleBAV" class=link onclick="location.href='index.php'" /> -->
					<p style="font-size:0.7em" id=timeRestant></p>
				</div>
			
		</div>
		<div class="col-xs-8 col-sm-10 col-md-10">
			<div class="TITRE_FENETRE_PRINCIPALE">
				<? $titreFen = retraitAccent($infAppli['titre']); 
				// 20eme 
				echo str_replace('20eme','<img src="./Images/20eme.png" alt="20eme" height="40px">', $titreFen);
				?>
			</div>
			<div>
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
			</div>
		</div>
		<div class="col-xs-2 col-sm-1 col-md-1">
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
		</div>
	</div>
</div>
