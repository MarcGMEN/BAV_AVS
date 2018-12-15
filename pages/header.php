<?php echo doctype('xhtml1-trans'); ?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

<head>
<!-- META TAGS -->
	<?php echo meta('Content-type', 'text/html; charset=utf-8', 'equiv'); ?>
	<?php echo meta('description', 'Bourse aux Velos St Nazaire'); ?>
	<?php echo meta('keywords', 'Bourse aux Velos, St Nazaire, AVS'); ?>
	<?php $year = @date('Y'); ?>
<!-- STYLE SHEETS -->

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<!-- VERY IMPORTANT, THE CUSTOM STYLE SHEET MUST COME AFTER THE DEFAULT BOOTSTRAP TO OVERRIDE DEFAULTS !!!!!! -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/custom.css" media="screen" />

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>




<!-- TITLE -->
	<title><?php echo $page_title; ?></title>

<!-- GOOGLE ANALYTICS JAVASCRIPT CODE | DO NOT DELETE -->
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-4095963-3']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>


</head>

<body>

<!-- Note : navigation DIV is self-contained within included file -->
	<?php $this->load->view('navigation'); ?>


<div class="container-fluid bandeau">
	<div class="container">
			<?php echo img('assets/images/bandeauweb.jpg'); ?>
	</div>
</div><!-- end bandeau/header div -->


<!-- start main content ROW, setup 3 columns fluid ?? -->
<div class="container">	

	<div class="row">

		<div class="col-md-9">

		<h3><span class="label label-danger">RETROUVEZ-NOUS</span> La Soucoupe, avenue Léo Lagrange Saint-Nazaire <small><?php echo anchor('welcome/venir', '(localiser)') ?></small></h3>