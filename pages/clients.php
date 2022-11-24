<script src="JS/clients.js" type="text/javascript"></script>

<h2> Recherche des clients  <span id='totalFull'></span></h2>
<h3>Nb : <span id=total></span>
	(Vendeurs : <span id=totalVendeur></span>; Acheteurs : <span id=totalAcheteur></span>;
	Vendeurs-Acheteurs : <span id=totalVendeurEtAcheteur></span>; En attente : <span id=totalAbsent></span>) </h3>
<table width="100%">
	<tr>
		<td class="tittab" width=35% colspan="2">
			<span id='cli_nom' onclick="triColonne('cli_nom')" class="sortable">Nom - Prenom&nbsp;&nbsp;&nbsp;</span>
			<!--Tous <input type="checkbox" value="1" name="all" onchange="findClients(this.checked ? 1 : 0)" />-->
			<input type=text name='cli_nom_<?= rand(1, 100) ?>' placeholder="Tapez au moins les 2 premières lettres"size="20" class="autocomplete" maxlength="100" onkeyup="selectColonne(this.value)" />
		</td>
		<td class="tittab maskmobile" width=35%>
			<span id='cli_emel' onclick="triColonne('cli_emel')" class="sortable">Emel&nbsp;&nbsp;&nbsp;</span>
		</td>
		<td class="tittab maskmobile" width=15%>
			<span id='cli_telephone' onclick="triColonne('cli_telephone')" class="sortable">Telephone&nbsp;&nbsp;&nbsp;</span>
		</td>

		<th class="tittab " width=2%>
			<span id="CONFIRME" onclick="triColonne('CONFIRME')" class="sortable">C&nbsp;</span>
		</th>

		<th class="tittab " width=2%>
			<span id="STOCK" onclick="triColonne('STOCK')" class="sortable">D&nbsp;</span>
		</th>

		<th class="tittab" width=2%>
			<span id="VENDU" onclick="triColonne('VENDU')" class="sortable">V&nbsp;</span>
		</th>
		<th class="tittab" width=2%>
			<span id="PAYE" onclick="triColonne('PAYE')" class="sortable">P&nbsp;</span>
		</th>

		<th class="tittab" width=2%>
			<span id="RENDU" onclick="triColonne('RENDU')" class="sortable">R&nbsp;</span>
		</th>
		<th class="tittab" width=2%>
			<span id="ACHAT" onclick="triColonne('ACHAT')" class="sortable">A&nbsp;</span>
		</th>
	
	</tr>
</table>
<div id=clients></div>