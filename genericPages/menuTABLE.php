<?php $tail = (int) 100 / 3;?>
<table width="100%">
	<tr>
    	<td width="<?=$tail?>%">
	    	<!-- fiche etat cofirme -->
		    A valider : <span id="CONFIRME">...</span>
		</td>
		<td width="<?=$tail?>%">
			<!-- fiche etat valide -->
			Stock : <span id="STOCK">...</span>
		</td>
	    <td width="<?=$tail?>%">
			Vendu : <span id="VENDU">...</span>
			<small><span id="statVendu">...</span></small>
		</td>
    </tr>
    <tr>
		<td width="<?=$tail?>%">
			Init : <span id="INIT">...</span>
		</td>
		<td width="<?=$tail?>%">
			<!-- fiche etat modif prix -->
			Modif prix : <A href="index.php?page=modif" method="POST">
			<span id="modifPrix">...</span></A>
		</td>
			<td width="<?=$tail?>%">
				Retour : <span id="RENDU">...</span>
	    		&nbsp;&nbsp;<small><span id="statRetour">...</span></small>
		</td>
	</tr>
</table>
