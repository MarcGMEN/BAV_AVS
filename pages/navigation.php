   <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
			<li><?php echo anchor('welcome/index', 'Accueil'); ?></li>
			<li><?php echo anchor('welcome/bav', 'La Bourse'); ?></li>
			<li><?php echo anchor('welcome/venir', 'Venir'); ?></li>
			<li><?php echo anchor("welcome/animations", "Animation"); ?></li>
			<li><?php echo anchor('welcome/reglement', 'Règlement'); ?></li>
			<li><?php echo anchor('welcome/faq', 'F.A.Q.'); ?></li>
			<li><?php echo anchor('welcome/statistiques', 'Statistiques'); ?></li>
			<li><?php echo anchor('welcome/presse', 'Presse'); ?></li>
			<li><?php echo anchor('welcome/ventes', 'Ventes'); ?></li>
			<li><?php echo anchor('welcome/telechargements', 'Téléchargement'); ?></li>
					<?php $attr = array('target'=>'_blank'); ?>
			<li><?php echo anchor('http://www.avs44.com', 'Club VTT', $attr); ?></li>
			<li><?php echo anchor('welcome/contact', 'Contact'); ?><li>

      <?php 
          if ($this->session->userdata('logged_in'))
          {
            $link = anchor('login/logout', 'Déconnexion');
          }
          else
          {
            $link = anchor('login/index', 'Admin');
          }

       ?>

       <li><?php echo $link; ?></li>

          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>