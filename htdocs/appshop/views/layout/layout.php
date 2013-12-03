<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<?php include_title(); ?>
<?php include_stylesheets(); ?>
<?php include_metas(); ?>
<?php include_links(); ?>
<?php include_javascripts(); ?>

<script type="text/javascript">base_url = '<?php echo base_url();?>';</script>
</head>
<body>
<!--Main Wrapper Section Starts here-->
<div id="MainWraper" class="BgBeforLogin">
  <div id="MainContainer">
    <div id="Wraper">
      <div id="Header">
      </div>
      <!--Middle Content Starts here-->
      <div id="MiddleWraper">
        <!--MiddleContainer Section Starts here-->
        <div class="MiddleContent">
			<!-- MAIN BODY CONTENT -->
			<div class="content">
				<?php echo $content; ?>
			</div>
			<!-- END MAIN BODY CONTENT -->  
        </div>
      </div>
      <div class="Footer">
        <div class="FooterlinksLinks">
          <ul>
            <li><a href="<?= base_url()?>" id="selected">Inicio</a><span>|</span></li>
			<li><a href="<?= base_url()?>page/historia">Historia</a><span>|</span></li>
			<li><a href="<?= base_url()?>page/acerca">Acerca de</a><span>|</span></li>
			<li><a href="<?= base_url()?>page/terminos">Terminos de Uso</a><span>|</span></li>
			<li><a href="<?= base_url()?>page/privacidad">Privacidad</a><span>|</span></li>
            <li><a href="<?= base_url()?>contacto">Contactenos</a></li>
          </ul>
          <p>&copy; 2011 Bellart. All rights reserved.</p>
        </div>
        <div class="Footeremail">E-mail: <a href="#">info [at] academiabellart.com</a></div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
