<?php echo $this->session->flashdata('message'); ?>


	<div id="subtitle"><h3>MERCI DE VOUS IDENTIFIER POUR ACCEDER A CETTE PAGE</h3></div>
	
	<?php echo form_open('login/index', 'class="form-horizontal"'); ?>
	
  <div class="form-group">
    <label for="username" class="col-sm-2 control-label">Utilisateur</label>
    <div class="col-sm-4">
      <input type="text" name="username" class="form-control" id="username" placeholder="Utilisateur">
    </div>
  </div>
  <div class="form-group">
    <label for="password" class="col-sm-2 control-label">Mot de passe</label>
    <div class="col-sm-4">
      <input type="password" name="password" class="form-control" id="password" placeholder="Mot de passe">
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" name="submit" value="submit" class="btn btn-default">Connexion</button>
    </div>
  </div>
<?php echo form_close(); ?>