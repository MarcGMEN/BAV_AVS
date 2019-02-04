<div class="alert alert-info">
	<p><b>INSTRUCTIONS</b> : Renseignez le numéro de vélo figurant sur votre reçu vendeur pour savoir si votre vélo a été vendu <br /> <em>Dernière mise à jour : <?php echo $mise_a_jour; ?></em></p>
	<ul>
		<li>Consultez les horaires d'ouverture dans la rubrique PROGRAMME <?php echo anchor('welcome/bav', 'ici'); ?> (fermeture de la Bourse aux Vélos 19h le dimanche)</li>
		<li>Contactez nous à tout moment au 06 46 58 06 61</li>
	</ul>

</div>


	<p><?php 
		if ($this->session->userdata('logged_in'))
		{
			echo anchor('admin/saisir_ventes', 'Gérer les ventes', array('class' => 'btn btn-primary'));
		}
		?>
	</p>

<?php 
	echo validation_errors();

	echo $this->session->flashdata('message');

	echo form_open('welcome/ventes', 'class="navbar-form" role="search"'); ?>

    <div class="form-group">
	    <input type="text" class="form-control" name="numero_velo" placeholder="numéro de vélo" value="<?php echo $this->input->post('numero_velo'); ?>">
    </div>
    <button type="submit" name="submit" class="btn btn-default">Vérifier</button>
</form>