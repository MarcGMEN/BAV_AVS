<?php $tail = (int) 100 / 3;?>
<table width="100%" id="tabStat">
	<tr>
    	<td width="<?=$tail?>%">
	    	<!-- fiche etat cofirme -->
		    A valider : <span id="CONFIRME" class='link' onclick='goTo("stock.php","obj_etat","CONFIRME",null)'>...</span>
		</td>
		<td width="<?=$tail?>%">
			<!-- fiche etat valide -->
			Stock : <span id="STOCK" class='link' onclick='goTo("stock.php","obj_etat","STOCK",null)'>...</span>
		</td>
	    <td width="<?=$tail?>%">
			Vendu : <span id="VENDU" class='link' onclick='goTo("stock.php","obj_etat","VENDU",null)'>...</span>
			<small><span id="statVendu" >...</span></small>
		</td>
    </tr>
    <tr>
		<td width="<?=$tail?>%">
			Init : <span id="INIT" class='link' onclick='goTo("stock.php","obj_etat","INIT",null)'>...</span>
		</td>
		<td width="<?=$tail?>%">
			<!-- fiche etat modif prix -->
			Modif prix : <A href="index.php?page=modif" method="POST">
			<span id="modifPrix">...</span></A>
		</td>
			<td width="<?=$tail?>%">
				Rendu : <span id="RENDU" class='link' onclick='goTo("stock.php","obj_etat","RENDU",null)'>...</span>
	    		&nbsp;&nbsp;<small><span id="statRetour">...</span></small>
		</td>
	</tr>
</table>
