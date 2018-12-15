<h3>FOIRE AUX QUESTIONS</h3>

<p style="padding-bottom : 15px;"><span class="label label-success">ASTUCE AVS</span> Poser votre question en utilisant le <a href="#formulaire">formulaire</a> en bas de la page. Nous vous répondrons dans les meilleurs délais</p>

<!-- SHOW SUBMISSION CONFIRMATION MESSAGE IF SET -->		
	<?php if($this->session->flashdata('message')) : ?>
		<div id="confirmation"><?php echo $this->session->flashdata('message'); ?></div>
	<?php endif; ?>

	<p><?php 
		if ($this->session->userdata('logged_in'))
		{
			echo anchor('admin/viewquestions', 'Gérer les question FAQ', array('class' => 'btn btn-primary'));
		}
		?>
	</p>

<!-- SHOW Q & A -->			
			<?php foreach ($faq as $row) : ?>
				<dl>
 					<dt>Q.&nbsp;<?php echo nl2br($row->question); ?></dt>
  					<dd><?php echo nl2br($row->response); ?></dd>
				</dl>
			<?php endforeach; ?>


<!-- SHOW FORM TO SUBMIT QUESTION -->
		<div id="subtitle"><h3>POSER VOTRE QUESTION</h3> <a name="formulaire"></a> </div>

			<p>Utiliser le formulaire ci-dessous pour poser votre question. Nous vous répondrons dans les meilleurs délais :</p>

			
	<?php echo validation_errors(); ?>

	<?php echo form_open('welcome/faq', 'class="form-horizontal"'); ?>
	
  <div class="form-group">
    <label for="name" class="col-sm-2 control-label">*Nom</label>
    <div class="col-sm-6">
      <input type="text" name="name" class="form-control" id="name" placeholder="" value="<?php echo $this->input->post('name'); ?>"/>
    </div>
  </div>

  <div class="form-group">
    <label for="email" class="col-sm-2 control-label">*Mail</label>
    <div class="col-sm-6">
      <input type="email" name="email" class="form-control" id="email" placeholder="" value="<?php echo $this->input->post('email'); ?>"/>
    </div>
  </div>

  <div class="form-group">
    <label for="question" class="col-sm-2 control-label">*Question</label>
    <div class="col-sm-6">
      <textarea name="question" class="form-control" id="email" placeholder="" value=""><?php echo $this->input->post('question'); ?></textarea>
    </div>
  </div>


  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" name="submit" value="submit" class="btn btn-success">Envoyer</button>
    </div>
  </div>
<?php echo form_close(); ?>


				
* champs obligatoires (votre adresse mail ne sera pas affiché)


			<?php
/*
				require_once(APPPATH.'libraries/recaptchalib.php');
				$publickey = "6LcmX8wSAAAAAAomk1aCWooMEkw0FHrbzf7xiKsY"; // you got this from the signup page
			echo '
  					<tr>
  						<th>Saissisez les mots :</th>
  						<td><?php // echo recaptcha_get_html($publickey); ?></td>

  					</tr>
  							';

*/

  			?>
 
			
		
