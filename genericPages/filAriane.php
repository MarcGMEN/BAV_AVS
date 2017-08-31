<?php if (isset($CFG_FIL_ARIANE) && $CFG_FIL_ARIANE == 'oui') {?>
<div class="login" ><small>
<?
$suite="";
for ($i = 0; $i < sizeof($TAB_filAriane); $i++) {
	foreach ($TAB_filAriane[$i] as $key => $val) {
		if ($i == (sizeof($TAB_filAriane)-1)) {?>
			&nbsp;<?=$suite?>&nbsp;<?=$key?>
		<?php }
		else {?>
			&nbsp;<?=$suite?>&nbsp;<A HREF="<?=$val?>"><?=$key?></A>	
			<?$suite="&gt";?>
		<?php }?>
		<?php }?>
<?php }?>
</small>
</div>
<?php }?>

