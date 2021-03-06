<?
date_default_timezone_set('America/La_Paz');
?>
<!DOCTYPE html>
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en" class="ie ie9"> <!--<![endif]-->
<head>
    <meta content="text/html; charset=utf-8" http-equiv="content-type"/>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    
    <!-- Mobile Specific Metas
    +++++++++++++++++++++++++++ -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <link rel="shortcut icon" href="<?= base_url()?>images/front/favicon.ico">
	
    <!-- Styles
    +++++++++++++ -->	
	<link href='http://fonts.googleapis.com/css?family=Oxygen:400,300,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	
	<?/*
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>css/front/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>css/front/bootstrap-responsive.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>css/front/theme.css">
	*/?>
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>css/front/colors/color-default.css" id="theme_color">
    <!-- Scripts
    +++++++++++++ -->
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script src="http://code.jquery.com/ui/1.8.2/jquery-ui.js" type="text/javascript"></script>
    <?/*
	<script type="text/javascript" src="<?= base_url()?>js/front/jquery.onebyone.min.js" ></script>
	<script type="text/javascript" src="<?= base_url()?>js/front/theme.js"></script>
	*/?>
	
	<script type="text/javascript">base_url = '<?php echo base_url();?>';</script>
	<?php include_title(); ?>
	<?php include_stylesheets(); ?>
	<?php include_metas(); ?>
	<?php include_links(); ?>
	<?php include_javascripts(); ?>
</head>

<body>
	<!-- H E A D E R -->
	<header>
        <div class="header_wrapper container">
            <a href="index.html" class="logo"><img src="<?= base_url()?>images/front/logo.png" alt=""  width="222" height="43" class="logo_def"><img src="<?= base_url()?>images/front/retina/logo.png" alt="" width="222" height="43" class="logo_retina"></a>
            <div class="slogan"><span>Lorem ipsum dolor sit amet egestas call us toll free +1 800 1313 666</span><hr></div>
            <nav>
                <ul class="menu">
                    <li class="current-menu-parent"><a href="javascript:void(0)">Home</a>
                        <ul class="sub-menu">
                            <li class="current-menu-item"><a href="index.html">Layout1</a></li>
                            <li><a href="home2.html">Layout2</a></li>
                            <li><a href="home3.html">Layout3</a></li>
                        </ul>
                    </li>
                    <li><a href="about.html">About</a></li>
                    <li><a href="javascript:void(0)">Features</a>
                        <ul class="sub-menu">
                            <li><a href="typography.html">Typography</a></li>
                            <li><a href="shortcodes.html">Shortcodes</a></li>
                        </ul>
                    </li>
                    <li><a href="javascript:void(0)">Portfolio</a>
                        <ul class="sub-menu">
                            <li><a href="portfolio1.html">1 Column</a></li>
                            <li><a href="portfolio2.html">2 Columns</a></li>
                            <li><a href="portfolio3.html">3 Columns</a></li>
                            <li><a href="portfolio4.html">4 Columns</a></li>
                            <li><a href="portfolio_post.html">Portfolio post</a></li>
                        </ul>
                    </li>
                    <li><a href="javascript:void(0)">Blog</a>
                        <ul class="sub-menu">
                            <li><a href="blog_full.html">Full width</a></li>
                            <li><a href="blogpost_full.html">Blog post</a></li>
                            <li><a href="javascript:void(0)">With sidebar</a>
                                <ul class="sub-menu">
                                    <li><a href="blog_left.html">Left sidebar</a></li>
                                    <li><a href="blog_right.html">Right sidebar</a></li>
                                    <li><a href="blogpost_sidebar.html">Blog post</a></li>
                                </ul>
                          </li>
                        </ul>
                    </li>
                    <li><a href="javascript:void(0)">Contacts</a>
                        <ul class="sub-menu">
                            <li><a href="contact_full.html">Full width</a></li>
                            <li><a href="contact_sidebar.html">With sidebar</a></li>
                        </ul>
                    </li>                
                </ul><!-- .menu -->
            </nav>
            <nav class="mobile_header">
                <select id="mobile_select"></select>
            </nav>
        </div><!-- .header_wrapper -->
      <div class="clear"></div>
	</header>
    <!-- C O N T E N T -->
    <div class="content_wrapper">
		<?= $content;?>
    </div><!-- .content_wrapper -->
    <div class="pre_footer">
    	<div class="container">
            <aside id="footer_bar" class="row">
            	<div class="span3">
                    <div class="sidepanel widget_about">
	                	<h4 class="sidebar_header">About Us</h4>
                        <img src="<?= base_url()?>images/front/pictures/pic_about_ltl.jpg" width="88" height="88" class="alignleft"/>
                        <p>Verenam operibus furiam est conclusoque sponte rotfundo filia puella sed esse more!</p>
                        <p>Defuncta ait est se in de eget vero quo accumsan in fuerat verenam operibus furiam est conclusoque sponte rotfundo filia puella sed esse more este functa ait est se in de eget vero quo!</p>
                        <p>Accumsan in fuerat est amet consensit cellula filia navem auditum ait. Ingens ferro conparuit de me missam ne velocitate renovasti dolorum Reflexio mihi.</p>
                        <span class="signature">Tom Edison, Company Owner</span>
                    </div>
                </div>
            	<div class="span3">
                    <div class="sidepanel widget_posts">
                        <h4 class="sidebar_header">Featured Posts</h4>
                        <ul class="recent_posts">
                            <li>
                                <div class="img_wrapper">
                                    <img src="<?= base_url()?>images/front/pictures/featured_widget1.jpg" width="88" height="88" class="alignleft"/>
                                </div>
                                <div class="recent_posts_content">
                                    <span class="post_date">25 april 2019</span>
                                    <p>Quisque ut nisl et neque ndilt mollis duis iaculis gravida.</p>
                                    <span class="read_more"><a href="#">Read more...</a></span>
                                </div>
                            </li>
                            <li>
                                <div class="img_wrapper">
                                    <img src="<?= base_url()?>images/front/pictures/featured_widget2.jpg" width="88" height="88" class="alignleft"/>
                                </div>
                                <div class="recent_posts_content">
                                    <span class="post_date">15 april 2019</span>
                                    <p>Quisque ut nisl et neque ndilt mollis duis iaculis gravida.</p>
                                    <span class="read_more"><a href="#">Read more...</a></span>
                                </div>
                            </li>
                        </ul>
                    </div><!-- .sidepanel -->
                </div>
            	<div class="span3">
                    <div class="sidepanel widget_recent_entries">
                        <h4 class="sidebar_header">Flickr Photostream</h4>
                        <div class="widget_flickr">
                            <script src="http://www.flickr.com/badge_code_v2.gne?count=9&display=latest&size=s&layout=x&source=user&user=92335820@N08"></script>
                        </div>
                    </div><!-- .widget_recent_entries -->
                </div>
            	<div class="span3">
                    <div class="sidepanel widget_twitter">
                       	<h4 class="sidebar_header">Latest Tweets</h4>
                        <ul class="twitter_list tweet_1057"></ul>
                        <script>
                            $(document).ready(function(){
                                $('.tweet_1057').tweet({
                                  avatar_size: 0,
                                  count: 3,
                                  username: "themedev",
                                  template: "{text}"
                                });
                            });										
                        </script>
                    </div><!-- .widget_twitter -->
                </div>            	
            </aside>
        </div>
    </div>
    <footer>
    	<div class="footer_wrapper container">
            <a href="index.html" class="logo"><img src="<?= base_url()?>images/front/logo_footer.png" alt=""  width="222" height="43" class="logo_def"><img src="<?= base_url()?>images/front/retina/logo_footer.png" alt="" width="222" height="43" class="logo_retina"></a>
            <div class="copyright">&copy; <?= date('Y')?> SoliciTaxi. All Rights Reserved.</div>
            <nav>
                <ul class="menu">
                    <li class="current-menu-parent"><a href="index.html">Home</a></li>
                    <li><a href="about.html">About</a></li>
                    <li><a href="typography.html">Features</a></li>
                    <li><a href="portfolio1.html">Portfolio</a></li>
                    <li><a href="blog_full.html">Blog</a></li>
                    <li><a href="contact_full.html">Contacts</a></li>                
                </ul><!-- .menu -->
            </nav>       
            <div class="footer_tools">
                <ul class="footer_socials main_socials">
                    <li><a href="#" class="ico_social-facebook" title="Facebook"></a></li>
                    <li><a href="#" class="ico_social-twitter" title="Twitter"></a></li>
                    <li><a href="#" class="ico_social-flickr" title="Flickr"></a></li>
                    <li><a href="#" class="ico_social-vimeo" title="Vimeo"></a></li>
                    <li><a href="#" class="ico_social-tumbler" title="Tumblr"></a></li>
                    <li><a href="#" class="ico_social-delicious" title="Delicious"></a></li>
                </ul>            
            	<div class="footer_search">
                    <form name="search_form" method="get" action="" class="search_form">
                        <input type="submit" name="submit_search" value="" title="" class="btn_search">
                        <input type="text" name="search_field" value="Search the Site..." title="Search the Site..." class="field_search">                        
                    </form>                
                </div>
                <div class="clear"></div>                
            </div>
        </div>
	</footer>
</body>
</html>