<?php $tail = (int) 100 / 3;?>
<table width="100%" id="tabStat">
	<tr>
    	<td width="<?=$tail?>%">
	    	<!-- fiche etat cofirme -->
		    A valider : <span id="CONFIRME" class='link' onclick='goTo("stock.php","obj_etat","CONFIRME",null)' style='font-weight: bold'>...</span>
		</td>
		<td width="<?=$tail?>%">
			<!-- fiche etat valide -->
			Total : <span id="TOTAL" style='font-weight: bold'>...</span>
		</td>
		<td width="<?=$tail?>%">
			Vendu : <span id="VENDU" class='link' onclick='goTo("stock.php","obj_etat","VENDU",null)' style='font-weight: bold'>...</span>
			<small><span id="statVendu" >...</span></small>
		</td>
    </tr>
    <tr>
		<td width="<?=$tail?>%">
			Init : <span id="INIT" class='link' onclick='goTo("stock.php","obj_etat","INIT",null)' style='font-weight: bold'>...</span>
		</td>
		<td width="<?=$tail?>%">
			<!-- fiche etat valide -->
			Stock : <span id="STOCK" class='link' onclick='goTo("stock.php","obj_etat","STOCK",null)' style='font-weight: bold'>...</span>
		</td>
	    <!--<td width="<?=$tail?>%">-->
			<!-- fiche etat modif prix -->
			<!--<s>Modif prix : <span id="modifPrix">...</span></A></s>
		</td>-->
			<td width="<?=$tail?>%">
				Rendu : <span id="RENDU" class='link' onclick='goTo("stock.php","obj_etat","RENDU",null)' style='font-weight: bold'>...</span>
	    		&nbsp;&nbsp;<small><span id="statRendu">...</span></small>
		</td>
	</tr>
</table>
