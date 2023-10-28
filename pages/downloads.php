<script type="text/javascript">
	function initPage() { };

	function supprimerFichier(file) {
		if (confirm("Suppression du fichier " + file)) {
			x_delete_file(file, display_reload);
		}
	}

	function display_reload(val) {
		location.reload();
	}
</script>
<h3 class="titreFiche">Downloads</h3>

<form action="Actions/downloadFile.php" method="post"
	enctype="multipart/form-data" name=fileForm>
	<div class="row fiche ">
		<div class="col-sm-6 col-md-6 col-xs-12 btnAction">
			<input type="file" id="file" name="file" required />
		</div>
		<div class="col-sm-6 col-md-6 col-xs-12 btnAction">
			<button>Importer</button>
		</div>
	</div>
</form>

<fieldset class=fiche>
	<legend class="titreFiche">Les fichiers</legend>
	<div class="row " style="border: 2px solid;">
		<?
		$path = "./downloads";
		if ($handle = opendir('./downloads')) {
			$files = array();
			while ($files[] = readdir($handle));
			sort($files);
			closedir($handle);
			foreach ($files as $entry) {
				//while (false !== ($entry = readdir($handle))) {
				if ($entry && $entry != "." && $entry != "..") {
					$fullName = "$path/$entry"; ?>
					<div class="col-xs-12 col-sm-6 col-md-6 tabl1">
						<div class="col-xs-12 col-sm-6 col-md-6">
							<span title="Supprimer"
								onclick="supprimerFichier('<?= $fullName ?>')" class="link"
								style="font-size:1.5em">&nbsp;❌&nbsp;</span>
							<a target="_blank" href="<?= $fullName ?>">
								<?= $fullName ?>
							</A>
							<br />
							<? //print_r(stat($fullName))?>
							Taille :
							<?= stat($fullName)['size'] / 1000 ?> ko<br />
							Date :
							<?= date('d/m/Y', stat($fullName)['mtime']) ?><br />

						</div>
						<div class="col-xs-12 col-sm-6 col-md-6">
							<? //mime_content_type($fullName)?>
							<object data="<?= $fullName ?>"
								type="<?= mime_content_type($fullName) ?>" height="100" width="200">
								<param name="filename" value="<?= $fullName ?>" />
							</object>
						</div>
					</div>
				<? }
			}
			//closedir($handle);
		} ?>
	</div>
</fieldset>