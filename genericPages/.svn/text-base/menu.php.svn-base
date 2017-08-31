<?php
$affich=false;
$tabConfig=XMLToArray('config/config_coteG.xml');
if (isset($tabConfig['APPLETS']['APPLET'])) {?>
<table cellspacing="0" cellpadding="1" width="100%" border=0>
		<?php if (!isset($tabConfig['APPLETS']['APPLET']['value'])) {?>
		  <?php foreach($tabConfig['APPLETS']['APPLET'] as $val) {
		  if ($val['value']) {
		  	$affich=true;?>
			<tr>
					<td>
				  <?try {
	  				$include=return_bloc($val['value'],"coteG");
	  				if ($val['@attributes']['titre']) {
                        switch ($val['@attributes']['titre']) {
                          case "[hr]" : $texte="<hr/>";break;
                          default : $texte=$val['@attributes']['titre'];
                        }?>
  				    <center>
  				    <div class="TITRE_COTE" ><?=utf8_decode($texte)?></div>
	  				</center>
	  				<?php }
                    include $include;
  				}	
			  	catch ( ErrorException $e ) {
				  	echo $val;
				}?>
				<br/>
				</td>
			</tr>
		<?php }
		  }?>
		<?php }
		else { // une seule applet 
		if ($tabConfig['APPLETS']['APPLET']['value']) {
		$affich=true;?>
		<tr>
				<td>
				<?
				try {
				  $include=return_bloc($tabConfig['APPLETS']['APPLET']['value'],"coteG");
		  	      if ($tabConfig['APPLETS']['APPLET']['@attributes']['titre']) {?>
  				    	<center>
                        <div class="TITRE_COTE" ><?=$tabConfig['APPLETS']['APPLET']['@attributes']['titre']?></div>
                       	</center>
	  				<?php }
				  
				  include $include;
				}
				catch ( ErrorException $e ) {
					echo $val;
				}?>
				<br/>
				</td>
		</tr>
		<?php }
		}?>
</table>
  <script>
  	<?php if ($affich) {?>
	function affCacheCoteG() {
	  	valCookies=GetCookie('coteG');
	  	if (!valCookies) {
			enableDisplaySave('coteG');
	  	}
	}
	<?php }
	else {?>
	  function affCacheCoteG() {
		  if (	getElement('cacheCoteG')) {
		  	getElement('cacheCoteG').innerHTML="";
		  }
	  }
		  disabledDisplaySave('coteG');
	<?php }?>
</script>
		<? }
else {?>
  <script>
  function affCacheCoteG() {	
  	getElement('cacheCoteG').innerHTML="";
  }
  disabledDisplaySave('coteG');
  </script>
<?php }?>