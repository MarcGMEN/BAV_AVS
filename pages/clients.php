<script src="JS/clients.js" type="text/javascript"></script>

<br/>
<h4 class="titreFiche">Recherche des clients  <span id='totalFull'></span></h4>
<h5>Nb : <span id=total></span>
	(V [<span id=totalVendeur title='Vendeur'>..</span>]&nbsp;&nbsp;&nbsp;A [<span id=totalAcheteur  title='Acheteur'>..</span>]&nbsp;&nbsp;&nbsp;V-A [<span id=totalVendeurEtAcheteur  title='Vendeur-Acheteur'>..</span>]&nbsp;&nbsp;&nbsp;Att [<span id=totalAbsent  title='En Attente dépôt'></span>]) </h5>
<table width="100%">
	<tr>
		<td class="tittab" width=33% >
			<span id='cli_nom' onclick="triColonne('cli_nom')" class="sortable">Nom - Prenom&nbsp;&nbsp;&nbsp;</span>
			Tous <input type="checkbox" value="1" name="all" onchange="findClients(this.checked ? 1 : 0)" />
			<br/><input type=text name='cli_nom_<?= rand(1, 100) ?>' placeholder="Tapez au moins les 2 premières lettres" size="20" class="autocomplete" maxlength="100" onkeyup="selectColonne(this.value)" style='width: 50%';/>
		</td>
		<td class="tittab maskmobile" width=26%>
			<span id='cli_emel' onclick="triColonne('cli_emel')" class="sortable">Emel&nbsp;&nbsp;&nbsp;</span>
		</td>
		<td class="tittab maskmobile" width=12%>
			<span id='cli_telephone' onclick="triColonne('cli_telephone')" class="sortable">Telephone&nbsp;&nbsp;&nbsp;</span>
		</td>

		<th class="tittab " width=4%>
			<span id="1" onclick="triColonne('1')" class="sortable" title="Total">T&nbsp;&nbsp;</span>
		</th>
		<th class="tittab " width=4%>
			<span id="CONFIRME" onclick="triColonne('CONFIRME')" class="sortable"  title="Confirmé">C&nbsp;&nbsp;</span>
		</th>

		<th class="tittab " width=4%>
			<span id="STOCK" onclick="triColonne('STOCK')" class="sortable"  title="En stock">D&nbsp;&nbsp;</span>
		</th>

		<th class="tittab" width=4%>
			<span id="VENDU" onclick="triColonne('VENDU')" class="sortable" title="Vendu">V&nbsp;&nbsp;</span>
		</th>
		<th class="tittab" width=4%>
			<span id="PAYE" onclick="triColonne('PAYE')" class="sortable" title="Payé">P&nbsp;&nbsp;</span>
		</th>

		<th class="tittab" width=4%>
			<span id="RENDU" onclick="triColonne('RENDU')" class="sortable" title="Rendu">R&nbsp;&nbsp;</span>
		</th>
		<th class="tittab" width=4%>
			<span id="ACHAT" onclick="triColonne('ACHAT')" class="sortable" title="Acheté">A&nbsp;&nbsp;</span>
		</th>
	
	</tr>
</table>
<div id=clients></div>