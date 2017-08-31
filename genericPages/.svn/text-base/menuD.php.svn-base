<?php
$affich=false;
$tabConfig=XMLToArray('config/config_coteD.xml');
if (isset($tabConfig['APPLETS']['APPLET'])) {?>
<table cellspacing="0" cellpadding="1" width="100%" border=0>
		<?php if (!isset($tabConfig['APPLETS']['APPLET']['value'])) {?>
		  <?php foreach($tabConfig['APPLETS']['APPLET'] as $val) {
		  if ($val['value']) {
		  	$affich=true;?>
			<tr>
					<td>
				  <?try {
	  				$include=return_bloc($val['value'],"coteD");
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
				  $include=return_bloc($tabConfig['APPLETS']['APPLET']['value'],"coteD");
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
	function affCacheCoteD() {
	  	valCookies=GetCookie('coteD');
	  	if (!valCookies) {
			enableDisplaySave('coteD');
	  	}
	}
	<?php }
	else {?>
	function affCacheCoteD() {
		if (	getElement('cacheCoteD')) {
	  	getElement('cacheCoteD').innerHTML="";
		}
	  	
	  }
	  disabledDisplaySave('coteD');
	<?php }?>
</script>
		<? }
else {?>
  <script>
  function affCacheCoteD() {	
  	getElement('cacheCoteD').innerHTML="";
  }
  disabledDisplaySave('coteD');
  </script>
<?php }?>