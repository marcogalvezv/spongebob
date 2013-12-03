<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8"/>

	<?php include_title(); ?>
	<?php include_stylesheets(); ?>
	<?php include_metas(); ?>
	<?php include_links(); ?>
	<?php include_javascripts(); ?>
	
	<script type="text/javascript">base_url = '<?php echo base_url();?>';</script>

	<!--[if lt IE 9]>
	<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<script type="text/javascript">
		$(document).ready(function() 
		{ 
			$(".tablesorter").tablesorter(); 
		});

		$(document).ready(function() {

			//When page loads...
			$(".tab_content").hide(); //Hide all content
			$("ul.tabs li:first").addClass("active").show(); //Activate first tab
			$(".tab_content:first").show(); //Show first tab content

			//On Click Event
			$("ul.tabs li").click(function() {

				$("ul.tabs li").removeClass("active"); //Remove any "active" class
				$(this).addClass("active"); //Add "active" class to selected tab
				$(".tab_content").hide(); //Hide all tab content

				var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
				$(activeTab).fadeIn(); //Fade in the active ID content
				return false;
			});

		});
    </script>
    <script type="text/javascript">
		$(function(){
			$('.column').equalHeight();
		});
	</script>

</head>


<body>
<!--ajax Loader-->
<?/*<div id="ajaxLoadAni">
	<div id="ajaxBox">
		<img src="<?= base_url()?>images/ajax-loader.gif" alt="Loading..." />
	</div>
</div>
*/?>
	<header id="header">
		<hgroup>
			<?php if($this->Systemmodel->user()){?>
				<h1 class="site_title"><a href="<?= base_url()?>admin/dashboard">Admin Backend</a></h1>
				<h2 class="section_title">Dashboard</h2>
				<div class="btn_view_site"><a class="logout_user" href="<?= base_url()?>admin/user/logout" title="Logout">Logout</a></div>
			<?}else{?>
				<h1 class="site_title"><a href="<?= base_url()?>admin/user/login">Admin Backend</a></h1>
				<h2 class="section_title">Inicio</h2>
				<div class="btn_view_site"><a class="logout_user" href="<?= base_url()?>admin/user/login" title="Iniciar">Iniciar</a></div>
			<?}?>
			
		</hgroup>
	</header> <!-- end of header bar -->
	<?php if($this->Systemmodel->user()){?>
	<section id="secondary_bar">
		<div class="user">
			<p>
				<?= $this->Systemmodel->user()->username; ?> (<a href="<?= base_url()?>admin/notifications">3 Messages</a>)
			</p>
		</div>
		<div class="breadcrumbs_container">
			<article class="breadcrumbs"><a href="<?= base_url()?>admin/dashboard">Admin Backend</a> <div class="breadcrumb_divider"></div> <a class="current">Dashboard</a></article>
		</div>
	</section><!-- end of secondary bar -->
	<?}?>
	
	<div id="contentView">
		<?php echo $content; ?>
	</div>
</body>
</html>