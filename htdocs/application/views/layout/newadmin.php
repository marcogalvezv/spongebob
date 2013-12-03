<?
$lang = $this->session->userdata('language');



?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <!-- Viewport Metatag -->
    <meta name="viewport" content="width=device-width,initial-scale=1.0">

    <!-- To load the layout as library /-->
    <?php include_title(); ?>
    <?php include_stylesheets(); ?>
    <?php include_metas(); ?>
    <?php include_links(); ?>
    <?php include_javascripts(); ?>

    <script type="text/javascript">base_url = '<?php echo base_url();?>';</script>


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

