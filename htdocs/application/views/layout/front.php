<?
date_default_timezone_set('America/La_Paz');
$lang = $this->session->userdata('language');

/*
if((strpos($_SERVER['SERVER_NAME'], 'solicitaxi.synapse.com.bo')) !== FALSE){
	//LOCAL TESTING
	$FacebookAppID = "351206094976717";
} else {
	//BETA/PRODUCTION
	$FacebookAppID = "524342177594799";
}

if(!isset($currency)) $currency = "Bs";

$user = $this->Systemmodel->user();
$uid = $this->session->userdata('uid');
$profile = $this->Systemmodel->profile();


if(isset($uid) && $uid > 0){
	//if profile does not exists even when the UID is set to session we logout completely
	if(!$profile){
		redirect('/user/logout');
	}
	$showunlogged = true;
	$showlogged = true;
} else {
	$showunlogged = false;
	$showlogged = false;
}

//avatar display settings
$profile = $this->Systemmodel->profile();
$avatar = ($profile)?$profile->avatar:"";

//facebook avatar
if (strpos($avatar,'http://graph.facebook.com') !== FALSE) {
	//$avatar = str_replace('20', '250', $avatar);
} 
//gravatar
else 
{
	$email = ($profile)?$profile->email:"";
	$default = ""; // link to your default avatar
	$size = 20; // size in pixels squared
	$gravatar = "http://www.gravatar.com/avatar.php?gravatar_id=" . md5($email) . "&default=" . urlencode($default) . "&size=" . $size;
	$avatar = $gravatar;
}

//echo "<pre>";
//print_r($uid);
//echo "<pre>";
//print_r($this->Systemmodel->profile());
//echo "</pre>";
*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<script type="text/javascript">base_url = '<?php echo base_url();?>';</script>

	<?php include_title(); ?>
	<?php include_stylesheets(); ?>
	<?php include_metas(); ?>
	<?php include_links(); ?>
	<?php include_javascripts(); ?>
	
	<!-- css -->
	<link rel="stylesheet" type="text/css" href="/js/fancybox/jquery.fancybox-1.3.4.css" />
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Nothing+You+Could+Do|Quicksand:400,700,300">
	
	<!-- Favicons -->
	<link rel="shortcut icon" href="<?= base_url()?>images/favicon.ico" />
	<link rel="apple-touch-icon" href="<?= base_url()?>images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?= base_url()?>images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?= base_url()?>images/apple-touch-icon-114x114.png">
	
</head>
<body>
	<!-- Start Wrapper -->
	<div id="page_wrapper">
		
	<!-- Start Header -->
	<header>
		<div class="container">
			<!-- Start Social Icons -->
			<aside>
				<ul class="social">
					<li class="facebook"><a href="http://facebook.com/SoliciTaxi">Facebook</a></li>
					<li class="twitter"><a href="http://twitter.com/SoliciTaxi">Twitter</a></li>
					<li class="email"><a href="" title="info@solicitaxi.com">Email</a></li>
					<li class="rss"><a href="" title="Actualizaciones">RSS</a></li>
					<!-- More Social Icons:
					<li class="dribbble"><a href="">Dribbble</a></li>
					<li class="google"><a href="">Google</a></li>
					<li class="flickr"><a href="">Flickr</a></li>
					-->
				</ul>
			</aside>
			<!-- End Social Icons -->
			
			<!-- Start Navigation -->
			<nav>
				<ul>
					<li><a href="#home">Inicio</a></li>
					<li><a href="#team">Equipo</a></li>
					<li><a href="#features">Caracteristicas</a></li>
					<li><a href="#screenshots">Galeria</a></li>
					<li><a href="#updates">Updates</a></li>
					<li><a href="#press">Noticias</a></li>
					<li><a href="#contact">Contacto</a></li>
					<li><a href="#styles">Styles</a></li>
				</ul>
				<span class="arrow"></span>
			</nav>
			<!-- End Navigation -->
		</div>
	</header>
	<!-- End Header -->
	
	<section class="container">
		<?echo $content;?>
	</section>
	
	<!-- Start Footer -->
	<footer class="container">
		<p>SoliciTaxi &copy; <?= date('Y')?>. Todos los Derechos Reservados.</p>
	</footer>
	<!-- End Footer -->
	
	</div>
	<!-- End Wrapper -->

</body>
</html>