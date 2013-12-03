<?
date_default_timezone_set('America/La_Paz');
?>

<!DOCTYPE HTML>
<head>

<!--###  Define Charset ###-->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!--###  Page Title ###-->
<title> SoliciTaxi | Registrate para descargar nuestra aplicacion beta</title>

<!--### Description and Keyword ###-->
<meta name="keywords" content=""/>
<meta name="description" content=""/>

<!--### Stylesheet and Bootstrap ###-->
<?/*
<link rel="stylesheet" href="/css/landing/bootstrap.min.css" />
<link rel="stylesheet" href="/css/landing/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="/css/landing/styles.css" />
<link rel="stylesheet" href="/css/landing/styles-layout2.css" />
<link rel="stylesheet" href="/css/landing/lightbox.css" />
*/?>

<!--### Favicon ###-->
<link rel="shortcut icon" href="<?= base_url()?>images/favicon.ico" type="image/x-icon" />

<!--### Google Fonts ###-->

<link href="http://fonts.googleapis.com/css?family=Oleo+Script" rel="stylesheet" type="text/css">
<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>

<!--### Javascript Library ###-->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

<?/*
<script type="text/javascript" src="/js/landing/jquery.backstretch.min.js"></script>
<script type="text/javascript" src="/js/landing/slides.min.jquery.js"></script>
<script type="text/javascript" src="/js/landing/jquery.tipTip.minified.js"></script>
<script type="text/javascript" src="/js/landing/main.js"></script>
<script type="text/javascript" src="/js/landing/main2.js"></script>
<script type="text/javascript" src="/js/landing/organictabs.jquery.js"></script>
<script type="text/javascript" src="/js/landing/lightbox.js"></script>
*/?>

<script type="text/javascript">base_url = '<?php echo base_url();?>';</script>
<?php //include_title(); ?>
<?php include_metas(); ?>
<?php include_links(); ?>
<?php include_stylesheets(); ?>
<?php include_javascripts(); ?>


</head>

<body>

<div class="main"><!--### Main Container ###-->


	<!--### Header - Fixed Top Bar ###-->


	<!--###  Top Line ###-->
	<div class="top-nav2"></div>

	<!--###  Logo and Button ###-->
	<div class="top-nav">  
		<div class="wrapper" id="headerlogos">
			<div class="pull-left">
				<img class="logo" src="<?= base_url()?>images/landing/logo3.png" alt="" />
			</div>
			<div class="pull-right">
				<img class="logo2" src="<?= base_url()?>images/landing/logo.png" alt="" />
			</div>
		</div>
	</div>

	<!--### Header - Arrow ###-->
	<div class="wrapper"><div class="top-arrow">  </div></div>


	<!--### Main Content ###-->
	<div class="main-content">
		<div class="wrapper">
			<div class="main-hand"><img src="<?= base_url()?>images/landing/layout2/main-hand.png" alt="" /></div>
			<div class="main-c1">
				<!--### Title ###-->
				<br /><br /><br />
				<h1 class="title">SoliciTaxi&trade;</h1>

				<!--### Subtitle ###-->
				<h2 style="font-size:20px;font-weight:bold"> El mejor dise&ntilde;o &#38; funcionalidad ... <br /><br /> SoliciTaxi&trade; es todo lo que necesitas para llegar a tu destino y a tus clientes</h2>

				<!--### Buttons ###-->
				<div class="buttons"> 
					<div class="button2"> <a href="#" id="popi2"> <img src="<?= base_url()?>images/landing/buttons/icon2.png" alt=""> Pruebalo</a> </div>
					<?/*<div class="button2 bt2s"> <a href="#" id="popi2"> <img src="<?= base_url()?>images/landing/buttons/icon3.png" alt=""> Suscribete</a> </div>*/?>
				</div>
			</div>	  
		</div>
	</div><!--### END  Main Content ###-->

<!--###   Features Section ###-->
<div class="content-wrap">
<?= $content;?> 
</div>

 <!--### Button - Footer ###-->
<div class="foo-button">
	<div class="wrapper">
		<h1 class="title"> UNETE A SOLICITAXI ! </h1>
		<h2 style="font-size:20px;font-weight:bold"> No importa si eres un usuario, empresa, taxista, no pierdas el tiempo...<br/><br/> Registrate Ahora! </h2>
		<div class="button-foo"> <a id="popi3" href="#">  Descargar </a> </div>
	</div>

</div>

 <!--### Footer ###-->

<div class="footer"> 
<div class="wrapper">
<div class="social"> <a href="http://www.facebook.com/SoliciTaxi" target="_blank" class="facebook"> </a> <a href="http://www.twitter.com/SoliciTaxi" target="_blank" class="twitter"> </a></div>

	<div class="copy"> 
	<img class="logobottom" src="<?= base_url()?>images/landing/logo2.png" alt="" /> 
	<p>
	&#169; Copyright <?= date('Y')?>. Todos los derechos Reservados
	</p>
	</div>
</div>
</div>

<!--### Contact Form Section ###-->

<div class="wrap" id="overlay_form" >
	<a href="#" id="close" ></a>
	<h1>Suscribete para poder descargar SoliciTaxi&trade; App</h1>
	<div class="divider2"> </div>
	<br />
	<div id="successwidget" class="ui-widget" style="display:none">
		<div style="margin-top: 20px; padding: 0 .7em;" class="ui-state-highlight ui-corner-all">
			<p>
			<span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>
			<span id="successtext"><strong>Success!</strong> Sample ui-state-highlight style.</span>
			</p>
		</div>
	</div>
	<div id="errorwidget" class="ui-widget" style="display:none">
		<div style="padding: 0 .7em;" class="ui-state-error ui-corner-all">
			<p>
			<span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-alert"></span>
			<span id="errortext"><strong>Error:</strong> Sample ui-state-error style.</span>
			</p>
		</div>
	</div>
	<form id="subscribeform" class="form-contact" method="post">
		<table>
		<tr>
			<td><label class="name" for="name"> </label></td>
			<td><input type="text" id="name" name="subscription[name]" placeholder="Nombre" title="Ingresar su nombre" required /></td>
		</tr>
		<tr>
			<td><label class="email" for="email"> </label></td>
			<td><input type="text" id="email" name="subscription[email]" placeholder="Email" title="Ingresar un email valido" required email="true"/></td>
		</tr>
		<tr>
			<td><label class="message" for="message"> </label></td>
			<td><textarea id="message" name="subscription[message]" rows="3" cols="20"></textarea></td>
		</tr>
		<tr>
			<td></td>
			<td><em id="loadtext" style="display:none">registrando...</em><input type="submit" class="submit" value="Registrarme" id="send" /></td>
		</tr>
		</table>
	</form>
</div>
<div id="popi-bg"></div> 
		
<!--### Pattern ###-->
<div class="pattern"></div>

</div><!--### END Main Container ###-->
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-38553956-1']);
  _gaq.push(['_setDomainName', 'solicitaxi.com']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</body>
</html>