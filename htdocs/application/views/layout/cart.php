<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>ShopSimple - A Responsive Html5 Ecommerce Template</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">

<!-- styles -->
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,800,700,300' rel='stylesheet' type='text/css'>

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
<link rel="shortcut icon" href="assets/ico/favicon.ico">
</head>
<body>
<!-- Header Start -->
<header>
  <!-- Sticky Navbar Start -->
  <div class="navbar navbar-fixed-top" id="main-nav">
    <div class="container">
      <button data-target=".nav-collapse" data-toggle="collapse" class="btn btn-navbar" type="button">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      </button>
      <nav class="nav-collapse collapse" style="height:0px">
        <ul class="nav">
          <li class="active"><a href="index.html">Home</a>
          </li>
          <li><a href="myaccount.html">My Account </a>
          </li>
          <li><a href="shopping-cart.html">Shopping Cart</a>
          </li>
          <li><a href="checkout.html">Checkout</a>
          </li>
        </ul>
      </nav>
      <ul class="nav pull-right left-tablet">
        <li class="dropdown hover">
          <a data-toggle="" class="dropdown-toggle" href="#">US Doller <b class="caret"></b></a>
          <ul class="dropdown-menu currency">
            <li><a href="#">US Doller</a>
            </li>
            <li><a href="#">Euro </a>
            </li>
            <li><a href="#">British Pound</a>
            </li>
          </ul>
        </li>
        <li class="dropdown hover">
          <a data-toggle="" class="dropdown-toggle" href="#">English <b class="caret"></b></a>
          <ul class="dropdown-menu language">
            <li><a href="#">English</a>
            </li>
            <li><a href="#">Spanish</a>
            </li>
            <li><a href="#">German</a>
            </li>
          </ul>
        </li>
        <li class="dropdown hover topcart">
          <a  class="dropdown-toggle" href="#">
            <i class="carticon"></i> Shopping Cart <span class="label label-success font14">1 item(s)</span> - $589.50<b class="caret"></b></a>
          <ul class="dropdown-menu topcartopen">
            <li>
              <table>
                <tbody>
                  <tr>
                    <td class="image"><a href="product.html"><img title="product" alt="product" src="images/prodcut-40x40.jpg" height="50" width="50"></a></td>
                    <td class="name"><a href="product.html">MacBook</a></td>
                    <td class="quantity">x&nbsp;1</td>
                    <td class="total">$589.50</td>
                    <td class="remove"><i class="icon-remove"></i></td>
                  </tr>
                  <tr>
                    <td class="image"><a href="product.html"><img title="product" alt="product" src="images/prodcut-40x40.jpg" height="50" width="50"></a></td>
                    <td class="name"><a href="product.html">MacBook</a></td>
                    <td class="quantity">x&nbsp;1</td>
                    <td class="total">$589.50</td>
                    <td class="remove"><i class="icon-remove "></i></td>
                  </tr>
                </tbody>
              </table>
              <table>
                <tbody>
                  <tr>
                    <td class="textright"><b>Sub-Total:</b></td>
                    <td class="textright">$500.00</td>
                  </tr>
                  <tr>
                    <td class="textright"><b>Eco Tax (-2.00):</b></td>
                    <td class="textright">$2.00</td>
                  </tr>
                  <tr>
                    <td class="textright"><b>VAT (17.5%):</b></td>
                    <td class="textright">$87.50</td>
                  </tr>
                  <tr>
                    <td class="textright"><b>Total:</b></td>
                    <td class="textright">$589.50</td>
                  </tr>
                </tbody>
              </table>
              <div class="well pull-right">
                <a href="#" class="btn btn-success">View Cart</a>
                <a href="#" class="btn btn-success">Checkout</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
  <!--Sticky Navbar End -->
  <div class="header-white">
    <div class="container">
      <div class="row">
        <div class="span4">
          <a class="logo" href="index.html"><img src="images/logos/logo160x125.png" alt="PidamosAlgo" title="PidamosAlgo"></a>
        </div>
      </div>
    </div>
  </div>
</header>
<!-- Header End -->

<div id="maincontainer">
<?php echo $content; ?>
</div>

<!-- Footer -->
<footer id="footer">
  <section class="footersocial">
    <div class="container">
      <div class="row">
        <div class="span3 aboutus">
          <h2>About Us </h2>
          <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. <br>
            <br>
            t has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. </p>
        </div>
        <div class="span3 contact">
          <h2>Contact Us </h2>
          <ul>
            <li class="phone"> +123 456 7890, +123 456 7890,<br>
              +123 456 7890</li>
            <li class="mobile"> +123 456 7890, +123 456 7890,<br>
              +123 456 7890</li>
            <li class="email"> test@test.com <br>
              test@test.com</li>
          </ul>
        </div>
        <div class="span3 twitter">
          <h2>Twitter </h2>
          <div id="twitter">
          </div>
        </div>
        <div class="span3 facebook">
          <h2>Facebook </h2>
          <div id="fb-root"></div>
          <script src="http://static.ak.connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php" type="text/javascript"></script>
          <script type="text/javascript">FB.init("");</script>
          <script type="text/javascript">
//<![CDATA[
document.write('<fb:fan profile_id="80655071208" stream="0"	connections="8"	logobar="0" height="190px"	width="250"css="http://pxcreate.com/template/shopsimple/assets/css/fb.css"></fb:fan> ');
//]]>
</script>
        </div>
      </div>
    </div>
  </section>
  <section class="footerlinks">
    <div class="container">
      <div class="shipingstrip">
        <div class="fl">
          <div class="control-group">
            <form class="form-horizontal">
              <div class="">
                <div class="input-prepend">
                  <span class="add-on"><i class="icon-envelope icon-w"></i></span>
                  <input type="text" id="inputIcon" placeholder="Subscribe to Newsletter" >
                  <button type="submit" class="btn btn-success" value="Subscribe">Sign in</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="fr">
          <div class="shipping"> 24 hrs Free Shipping </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="info">
        <ul>
          <li><a href="#">Privacy Policy</a>
          </li>
          <li><a href="#">Terms &amp; Conditions</a>
          </li>
          <li><a href="#">Affiliates</a>
          </li>
          <li><a href="#">Newsletter</a>
          </li>
        </ul>
      </div>
      <div id="footersocial">
        <a href="#" title="Facebook" class="facebook">Facebook</a>
        <a href="#" title="Twitter" class="twitter">Twitter</a>
        <a href="#" title="Linkedin" class="linkedin">Linkedin</a>
        <a href="#" title="rss" class="rss">rss</a>
        <a href="#" title="Googleplus" class="googleplus">Googleplus</a>
        <a href="#" title="Skype" class="skype">Skype</a>
        <a href="#" title="Flickr" class="flickr">Flickr</a>
      </div>
    </div>
  </section>
  <section class="copyrightbottom">
    <div class="container">
      <div class="row">
        <div class="span6"> All images are copyright to their owners. </div>
        <div class="span6 textright"> ShopSimple @ 2012 </div>
      </div>
    </div>
  </section>
  <a id="gotop" href="#">Back to top</a>
</footer>
<!-- /maincontainer -->
<!-- javascript
    ================================================== -->
</body>
</html>