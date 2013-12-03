<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<link rel="icon" href="<?=base_url()?>images/favicon.ico" type="image/ico">
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<?php include_title(); ?>
<?php include_stylesheets(); ?>
<?php include_metas(); ?>
<?php include_links(); ?>
<?php include_javascripts(); ?>

<script type="text/javascript">
/*BROWSER CHECK */
$(document).ready(function(){
		
	var version = parseInt($.browser.version);
	
	if ($.browser.msie) {
		//alert("This site is optimized to work with Internet Explorer 9 or Firefox 5, BUT you may find access issues over Windows 7. We recommend you to use the latest version of IE and clean up your brwoser and cookies when using this site.");
	}
	
});

</script>

<script type="text/javascript">base_url = '<?php echo base_url();?>';</script>
</head>
<body>
<?php echo $content; ?>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-34386977-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</body>
</html>