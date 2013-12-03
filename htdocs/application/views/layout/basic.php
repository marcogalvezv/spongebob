<?
$lang = $this->session->userdata('language');

//echo "<pre>";
//print_r($lang);
//echo "</pre>";

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="iso-8859-1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- styles -->
	<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css' />
	<link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css' />
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,800,700,300' rel='stylesheet' type='text/css'>
	<script src="http://maps.googleapis.com/maps/api/js?amp;key=AIzaSyBHU2q81-hmoEP5UQ0W5qriGM4HYwasY0Y&amp;sensor=false" type="text/javascript" ></script>

	<script type="text/javascript">base_url = '<?php echo base_url();?>';</script>
	
	<?php include_title(); ?>
	<?php include_stylesheets(); ?>
	<?php include_metas(); ?>
	<?php include_links(); ?>
	<?php include_javascripts(); ?>

<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

<!-- fav and touch icons -->
	<link rel="icon" href="<?=base_url()?>images/favicon.ico" type="image/ico">

</head>
<body>
<!-- Header Start -->
<header>
</header>
<!-- Header End -->
<div id="maincontainer">
	<?php echo $content; ?>
</div>

<!-- Footer -->
<footer id="footer">
</footer>
<!-- /maincontainer -->
<!-- javascript
    ================================================== -->

</body>
</html>