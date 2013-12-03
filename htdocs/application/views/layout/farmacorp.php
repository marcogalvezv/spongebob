<?
$lang = $this->session->userdata('language');
$city = $this->session->userdata('city');
$search = $this->session->userdata('search');

if((strpos($_SERVER['SERVER_NAME'], 'pidamosalgo.synapse.com.bo')) !== FALSE){
	//LOCAL TESTING
	$FacebookAppID = "351206094976717";
} else {
	//BETA/PRODUCTION
	$FacebookAppID = "524342177594799";
}

if(!isset($currency)) $currency = "Bs";

$user = $this->Systemmodel->user();
$uid = $this->session->userdata('uid');

if(isset($uid) && $uid > 0){
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

	<style type="text/css">
		.scrollable{max-height:550px; overflow:auto;}
	</style>
	
	<script type="text/javascript">base_url = '<?php echo base_url();?>';</script>
	
	<?php include_title(); ?>
	<?php include_stylesheets(); ?>
	<?php include_metas(); ?>
	<?php include_links(); ?>
	<?php include_javascripts(); ?>
	
	<style>
	#headerlinktext{
		position: relative;
		width: 370px;
	}

	#headerlinktext span {
		color: #FFFFFF;
		font-family: verdana;
		font-size: 20px;
		font-weight: bold;
		top: 10px;
		position: relative;
	}
	
	#logo_nav_small2{
		width: 350px;
	}
	
	#header_fixed_options2{
		padding-top: 7px;
		width: 350px;
	}
	</style>


<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

<!-- fav and touch icons -->
	<link rel="icon" href="<?=base_url()?>images/favicon.ico" type="image/ico">
</head>
<body>
<div id="fb-root"></div>
<script>
		var uid;
		var accessToken;
		
		var name;
		var username;

		window.fbAsyncInit = function() {
			FB.init({
			  appId      : '<?= $FacebookAppID;?>', // App ID
			  channelUrl : '<?=base_url()?>channel.html', // Channel File
			  scope      : 'email,offline_access,user_birthday,publish_stream,user_location,user_work_history,user_about_me,user_hometown', // check login status
			  status     : true, // check login status
			  cookie     : true, // enable cookies to allow the server to access the session
			  xfbml      : true,  // parse XFBML
			  oauth      : true
			});
		};
		// Load the SDK Asynchronously
		(function(d){
		 var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
		 if (d.getElementById(id)) {return;}
		 js = d.createElement('script'); js.id = id; js.async = true;
		 js.src = "//connect.facebook.net/en_US/all.js";
		 ref.parentNode.insertBefore(js, ref);
		}(document));
</script>
<!-- Header Start -->
<header>
  <!-- Sticky Navbar Start -->
  <div class="navbar navbar-fixed-top shadow" id="main-nav">
    <div class="container">
		<div id="logo_nav_small2" class="pull-left">
			<a id="headerlink" href="<?=base_url()?>"><img  id="logoheader" src="<?=base_url()?>images/logos/logo_pidamosalgo_sinbubble_blacknwhite.png" alt="PidamosAlgo.com" title="PidamosAlgo.com"></a>
		</div>
<!--PROFILE USER-->
	<?if($showlogged){?>
	  <div id="header_fixed_options2" class="pull-right">
        <ul class="nav pull-right left-tablet">
		  <li class="dropdown hover">
            <a href="#"><i class="icon-map-marker icon-white"></i> <?=ucwords(str_replace('-', ' ', $city))?></a>
          </li>
          <li class="dropdown hover">
            <a data-toggle="" id="dropdown-toggle2" href="#">
				<?
				//echo "<pre>";
				//print_r($this->userdata());
				//echo "<pre>";
				//print_r($this->Systemmodel->profile());
				//echo "</pre>";
				?>
				<?if($showlogged){?>
					<img id="fbimg" src="<?= $avatar;?>" width="25px" />
					<span id="fbname"><?= (isset($profile->firstname))?$profile->firstname:"";?></span>
				<?}?>
				<b class="caret"></b>
			</a>
            <ul class="dropdown-menu currency">
				<li><a href="<?= base_url()?>farmacorp/dashboard/profile"><i class="icon-pencil"></i> <?=lang('front.layout.header.user.profile');?></a></li>
				<li class="divider"></li>
				<li><a href="<?= base_url()?>farmacorp/user/logout"><i class="icon-lock"></i> <?=lang('front.layout.header.user.close');?></a></li>
            </ul>
          </li>
        </ul>
      </div>
	  <?}else{?>
	  <!-- HIDE/SHOW THE NAVIGATION FOR USER LOGGED/UNLOGGED -->	  
	  <div id="header_fixed_options2" class="pull-right">        
        <ul class="nav pull-right left-tablet">
          <li class="dropdown hover">
            <a data-toggle="" class="dropdown-toggle" href="#"><i class="icon-lock icon-white"></i> <?=lang('front.layout.header.login.title');?><b class="caret"></b></a>
            <ul class="dropdown-menu currency">
              <li>
				<div id="loginBox">
					<form name="login_form" id="login_form" class="cmxform" method="post" action="<?= base_url()?>farmacorp/user/login">
						<fieldset id="body">
							<label for="mainLoginEmail"><?=lang('front.layout.header.login.user');?></label>
							<input type="text" name="user[username]" id="mainLoginEmail" title="<?=lang('front.layout.header.login.user.title');?>" placeholder="<?=lang('front.layout.header.login.user.placeholder');?>" required autofocus/>
							<label for="mainLoginPassword"><?=lang('front.layout.header.login.pass');?></label>
							<input type="password" name="user[password]" id="mainLoginPassword" title="<?=lang('front.layout.header.login.pass.title');?>" required />							
							<button type="submit" id="login" value="<?=lang('front.layout.header.login.button');?>" class="btn btn-success"><?=lang('front.layout.header.login.button');?></button>
						</fieldset>
					</form>
				</div>
			  </li>
              <li class="divider"></li>
            </ul>
          </li>
        </ul>
      </div>
	  <?}?>
	  <!--END hide/show navigation for logged/unlogged users -->
    </div><!--Container End -->
  </div>
  <!--Sticky Navbar End -->
  <? if(isset($show_header_menu) && $show_header_menu === TRUE){?>
  <div class="header-white">
    <div id="categorymenufarma">
      <div class="container">
        <nav class="subnav frame80per">
          <ul class="nav-pills categorymenu">
			<? if($user->gid == 5 || $user->gid == 6){?>
            <li>
				<a class="active" href="<?=base_url()?>farmacorp/dashboard/profile">Inicio</a>
            </li>
            <li>
				<a href="<?=base_url()?>farmacorp/dashboard/activate">Activacion</a>
            </li>
			<? if($user->gid == 6){?>
			<li>
				<a href="<?=base_url()?>farmacorp/dashboard/revert">Reversion</a>
            </li>
			<?}?>
            <li><a href="#">Reportes</a>
              <div>
                <ul class="arrow">
                  <li><a href="<?= base_url()?>farmacorp/report/inactive">Reporte de Creditos por Activar</a></li>
                  <li><a href="<?= base_url()?>farmacorp/report/credits">Reporte de Creditos Activos</a></li>
				  <? if($user->gid == 6){?>
				  <li><a href="<?= base_url()?>farmacorp/report/reverts">Reporte de Reversiones</a></li>
				  <?}?>
                  <li><a href="<?= base_url()?>farmacorp/report/all">Reporte Completo</a></li>
                </ul>
              </div>
            </li>
            <li><a href="#">Sistema</a>
              <div>
                <ul class="arrow">
                  <li><a href="<?= base_url()?>farmacorp/dashboard/profile">Perfil</a></li>
                  <li><a href="<?= base_url()?>farmacorp/user/logout">Salir</a></li>
                </ul>
              </div>
            </li>
			<?}?>
          </ul>
        </nav>
		<div class="dealerLogo frame20per" style="text-align:right">
			<img src="<?=base_url()?>images/logos/logo_farmacorp_menu.png" alt="FarmaCorp" class="center" height="40px" />
		</div>
      </div>
    </div>
  </div>
  <?} //IF show_header_menu?>
</header>
<!-- Header End -->

<div id="maincontainer">
	<div class="container shadow BgWhite pa1">
		<?php echo $content; ?>
	</div>
</div>

<!-- Footer -->
<footer id="footer">
  <section class="footersocial">
    <div class="container">
      <div class="row">
        <div class="span6 aboutus">
          <h2><?=lang('front.layout.footer.who.title');?></h2>
			<div class="quienessomos">
				<a href="#">
					<img src="<?=base_url()?>images/logos/pidamosalgo_sinbubble.png" alt="PidamosAlgo" />
				</a>
				<p></p>
				<p>"<?=lang('front.layout.footer.who.slogan');?>"</p>

				<p><span class="grey"><b><?=lang('front.layout.footer.who.ourmission');?>:</b> <i>"<?=lang('front.layout.footer.who.mission');?>"</i></span></p>
				<p><span class="grey"><b><?=lang('front.layout.footer.who.ourvision');?>:</b> <i>"<?=lang('front.layout.footer.who.vision');?>"</i></span></p>
			</div>
		</div>
		<div class="span6 contact">
          <h2><?=lang('front.layout.footer.contact.title');?></h2>
          <ul>
            <li class="phone"> +591 44010304, +591 44666679</li>
            <li class="mobile"> +591 75990505, +591 70784027</li>
            <li class="email"> info@pidamosalgo.com</li>
          </ul>
		  <div id="mapCanvas"></div>
        </div>
      </div>
    </div>
  </section>
  <section class="footerlinks">
    <div class="container">
      <div class="shipingstrip">
        <div class="fl">
          <div class="control-group">
            <form class="form-horizontal" id="subscribeform" action="" method="post" >
              <div class="">
                <div class="input-prepend">
                  <span class="add-on"><i class="icon-envelope icon-w"></i></span>
                  <input type="text" placeholder="<?=lang('front.layout.footer.subscribe.placeholder');?>" id="email_field" name="email" >
                  <button id="subscribebutton" type="submit" class="btn btn-success" value="Subscribe"><?=lang('front.layout.footer.subscribe.button');?></button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="fr">
          <div class="shipping"><?=lang('front.layout.footer.social.title');?></div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="info">
        <ul>
          <li><a href="<?=base_url()?>privacidad"><?=lang('front.layout.footer.links.privacy');?></a>
          </li>
          <li><a href="<?=base_url()?>terminos"><?=lang('front.layout.footer.links.terms');?></a>
          </li>
          <li><a href="<?=base_url()?>acerca"><?=lang('front.layout.footer.links.about');?></a>
          </li>
          <li><a href="<?=base_url()?>inversores"><?=lang('front.layout.footer.links.investors');?></a>
          </li>
          <li><a href="http://blog.pidamosalgo.com">Blog</a>
          </li>
        </ul>
      </div>
      <div id="footersocial">
        <a href="http://facebook.com/PidamosAlgo" title="Facebook" class="facebook">Facebook</a>
        <a href="http://twitter.com/PidamosAlgo" title="Twitter" class="twitter">Twitter</a>
        <a href="http://www.linkedin.com/company/pidamosalgo" title="Linkedin" class="linkedin">Linkedin</a>
        <a href="http://blog.pidamosalgo.com/feed" title="rss" class="rss">rss</a>
        <a href="https://plus.google.com/104080258068798419598" title="Googleplus" class="googleplus">Googleplus</a>
        <a href="skype:pidamosalgo?call" title="Skype" class="skype">Skype</a>
        <?/*<a href="#" title="Flickr" class="flickr">Flickr</a>*/?>
      </div>
    </div>
  </section>
  <section class="copyrightbottom">
    <div class="container">
      <div class="row">
        <div class="span6"><?=lang('front.layout.footer.copyright.images');?>.</div>
        <div class="span6 textright"> &copy; Copyright <?= date('Y')?> PidamosAlgo&trade;. <?=lang('front.layout.footer.copyright.reserved');?>.</div>
      </div>
    </div>
  </section>
  <a id="gotop" href="#">Back to top</a>
</footer>

<div id="dialog_message" title="Suscripcion" style="display:none;">
	<h2 id="dialog_title"></h2>
	<p style="text-align:left;">
		<span id="dialog_text">Se ha suscrito exitosamente a nuestro servicio, este atento para recibir ofertas.</span>
	</p>
</div>
<!-- /maincontainer -->

<!--DIALOG CART DELETE-->
<div id="dialog_confirm_cartfront" title="<?=lang('front.common.confirmation');?>" style="display:none">
	<p>
		<span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
		<?=lang('front.page.cart.dialog.delete.text');?>
	</p>
</div>
<!--DIALOG CART VERIFY-->
<div id="dialog_confirm_cartverifyfront" title="<?=lang('front.common.confirmation');?>" style="display:none">
	<p>
		<span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
		<?=lang('front.page.cart.dialog.verify.text');?>
	</p>
</div>

<!-- javascript
    ================================================== -->

<script type="text/javascript">

  var _gaq = _gaq || [];
  <?if((strpos($_SERVER['SERVER_NAME'], 'beta.pidamosalgo.com')) !== FALSE){?>
  _gaq.push(['_setAccount', 'UA-37254286-1']);
  <?}else{?>
  _gaq.push(['_setAccount', 'UA-34386977-1']);
  <?}?>
  _gaq.push(['_trackPageview']);
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<script type="text/javascript">

function subscribe_submit() {

	email = $('#email_field').val();
	
	if(email == 'Suscribirse a nuestras Noticias' || email == '') {
		displaymessage('Favor ingresar un email valido!', false);
		return false;
	}

	if(!validateEmail(email)) {
		displaymessage('Favor ingresar un email valido!', false);
		return false;
	}

	$.post(base_url + 'landing/ajax_subscribe', $('#subscribeform').serialize(), subscribe_result, 'json');
	$('#loading').fadeIn('fast');
	return false;
}

function subscribe_result(data) {
	$('#loading').hide();
	if (data.success) {
		//display_message(data.error);
		displaymessage(data.message, true);
	} else {
		//display_message(data.info, 'info');
		displaymessage(data.message, false);
	}
}

function displaymessage(msg, state) {

	if(state == true) {
		$( "#dialog_title" ).html( 'Suscripcion Exitosa' );
	} else {
		$( "#dialog_title" ).html( 'Atencion!' );
	}
	
	$( "#dialog_text" ).html( msg );
	$( "#dialog_message" ).dialog( "open" );
	
	return false;
}

$(document).ready(function() {

	//header logo hover effect
	$("#headerlink").hover(function () {
		$('img#logoheader').attr("src", base_url + "images/logos/logo_pidamosalgo_sinbubble_color.png");
	}, function () {
		$('img#logoheader').attr("src", base_url + "images/logos/logo_pidamosalgo_sinbubble_blacknwhite.png");
	});
	
	$( "#dialog_message" ).dialog({
		resizable: false,
		autoOpen: false,
		width: 600,
		modal:true,
		buttons:{
			"Ok": function() {
				$( this ).dialog( "close" );
			}
		},
        open: function() {
            $('.ui-dialog-buttonset').find('button').removeClass('ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only');
			$('.ui-dialog-buttonset').find('button').addClass('btn btn-success');
        }
	});
	
	$('#subscribebutton').click(function() {
		subscribe_submit();
		return false;
	});
	
	$('#subscribeform').submit(function() {
		return false;
	});
	
	$("#login_form").validate();	


	$('#login_form').submit(function() 
	{
		if(!$('#login_form').valid())
		{
			return false;
		}
		
	});

	//Google Maps API Code
	//Footer Maps init
	var myLatlng = new google.maps.LatLng(-17.38318,-66.145443);
	var myOptions = {
		zoom: 15,
		disableDefaultUI: true,
		center: myLatlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	}
	var map = new google.maps.Map(document.getElementById("mapCanvas"), myOptions);

	//PidamosAlgo
	var image = base_url+'images/maps/icons/logo64x50.png';
	var myLatLng = new google.maps.LatLng(-17.38318,-66.145443);
	var beachMarker = new google.maps.Marker({
		position: myLatLng,
		map: map,
		center: myLatLng,
		icon: image
	});

});//end document ready

</script> 
</body>
</html>