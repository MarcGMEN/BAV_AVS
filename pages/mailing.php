<?php require_once 'Functions/mailing_functions.php';?>
<script>
	
	function initPage() {
		//x_return_countMailing(display_count);

// 		x_return_countMailingEnvoye(display_countE);

// 		x_return_countMailingAEnvoyer(display_countAE);
// 		x_return_countMailingErreur(display_countER);
		
	}

	function refresh() {
		x_return_countMailingEnvoye(display_countE);
		x_return_countMailingErreur(display_countER);
		x_return_countMailingAEnvoyer(display_countAE);
//		setTimeout("refresh()", 2000);
	}
	
	function unloadPage() {
		
	} 

	function display_texteMailing(val) {
		document.mailingForm.texteMail.innerHTML=val;
		getElement('renduMailing').innerHTML=document.mailingForm.texteMail.value;
	}
	
	function display_count(val) {
		getElement('total').innerHTML=val;
	}

	function display_countE(val) {
		getElement('totalE').innerHTML=val;
	}
	function display_countER(val) {
		getElement('totalER').innerHTML=val;
	}
	

	function display_countAE(val) {
		getElement('totalAE').innerHTML=val;
	}

	function ValideForm(laForm) {
		if (confirm("Envoi du mailing ?? ")) {
			x_actionMailing(laForm.texteMail.value,laForm.nbMail.value,display_finActionMailing);

		}
	} 

	function testMailing(laForm) {
		document.mailingForm.buttonTest.value="En cours";
		if (confirm("test du mailing à "+laForm.testEMel.value+" ? ")) {
// 			document.mailingForm.lAction.value="testEMel";
// 			document.mailingForm.submit();
			x_envoiMailing(laForm.texteMail.value,laForm.testEMel.value,display_finAction);
		}
	} 

	function display_finActionMailing(val) {
		if (val != "" ) {
			alert(val);
			location.reload();
			document.mailingForm.goMailing.value="Go";
		}
		else {
			refresh(); 
			var delai = Math.floor((Math.random() * 10) + 5); 
			document.mailingForm.goMailing.value="Go dans "+delai+" sec";
			setTimeout("x_actionMailing(document.mailingForm.texteMail.value,document.mailingForm.nbMail.value,display_finActionMailing);", delai*1000);
		}
		
	}

	function display_finAction(val) {
		if (val != "" ) {
			alert(val);
		}
		document.mailingForm.buttonTest.value="Test";
		document.mailingForm.buttonInit.value='init Mailing';
		refresh(); 
	}
	function initMailing() {
		document.mailingForm.buttonInit.value='en Cours';
		x_initMailing(display_finAction);
	}
</script>

<table width='100%'>
	<tr>
		<td>
			<h2>
				Nb Total d'adresse : <?=get_countMail ()?>
			</h2>
		</td>
		<td>
			<h2>
				Nb a envoyer : <span id=totalAE><?=get_countMailAEnvoyer ()?></span>
			</h2>
		</td>
		<td>
			<h2>
				Nb en Erreur : <span id=totalER><?=get_countMailEnErreur()?></span>
			</h2>
		</td>
		<td>
			<h2>
				Nb d'envoi : <span id=totalE><?=get_countMailEnvoye()?></span>
			</h2>
		</td>
	</tr>
</table>
<form name="mailingForm" method="POST" action="Actions/AMailing.php">
	<input type=button value="init Mailing" name="buttonInit"
			onclick="this.value='en Cours';initMailing(display_finAction)" />
	<input type="hidden" name="lAction" value="" />
	<fieldset >
		<legend>Message</legend>
			<table width=100%" >
				<tr>
					<td width=50%  style="vertical-align: top">
						<textarea rows="20" cols="80" name="texteMail"><?=file_get_contents("html/texteBAV.html")?>
						</textarea>
					</td>
					<td width=1% >
						<input type=button onclick="getElement('renduMailing').innerHTML=document.mailingForm.texteMail.value" class="link" value="Visu&nbsp;-&gt;" />
					</td>
					<td width=50%  style="vertical-align: top">
						<div id="renduMailing" style="border: 1px solid black; heigth:100%; background-color: WHITE">
						&nbsp;
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<input type=text value="marc.garces@free.fr" name="testEMel"/>
						<input type=button value="Test" name="buttonTest" onclick="testMailing(this.form)" />
					</td>
					<td></td>
					<td align="center" >
						Nb de mail par envoi<input type=text value="1" name="nbMail" size=2 maxlength="2"/>
						<input type=button value="Go" name="goMailing" onclick="ValideForm(this.form)" />
					</td>
				</tr>
			</table>
			<br/>
			
	</fieldset>
</form>
