<script type="text/javascript" src="<?= base_url()?>js/slides.min.jquery.js"></script>

<div id="fb-root"></div>
<script>
	(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1&appId=524342177594799";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
</script>

<div id="social">
	<ul>	
		<li>
			<div class="fb-like" data-href="http://www.facebook.com/PidamosAlgo" data-send="false" data-layout="box_count" data-width="150" data-show-faces="false"></div>
		</li>
		<li>
			<a href="https://twitter.com/share" class="twitter-share-button" data-via="PidamosAlgo" data-lang="es" data-count="vertical">Twittear</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		</li>
		<li>
			<script src="//platform.linkedin.com/in.js" type="text/javascript"></script>
			<script type="IN/Share" data-url="http://www.pidamosalgo.com/" data-counter="top"></script>
		</li>
		<li>
			<!-- Place this tag where you want the +1 button to render. -->
			<div class="g-plusone" data-size="tall" data-href="http://www.pidamosalgo.com/"></div>

			<!-- Place this tag after the last +1 button tag. -->
			<script type="text/javascript">
			window.___gcfg = {lang: 'es-419'};

			(function() {
			var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
			po.src = 'https://apis.google.com/js/plusone.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
			})();
			</script>
		</li>
	</ul>
</div> <!-- end of logo -->

<div id="logo">
	<img src="<?= base_url()?>images/logos/logo_pidamos.png" />
</div> <!-- end of logo -->

<div class="searchbox" title="Buscar por Tipo de Comida Pizza, Hamburguesa, Broster, Carne, Pasta, Pollo, Cerdo, Pescado, Comida Boliviana, Italiana, Mexicana, Argentina, China, Brasilera...">
	<form class="form-wrapper" action="<?= base_url()?>home/index">
		<input type="text" id="search" class="defaultText defaultTextActive" title="Buscar por Pollo, Carnes, Pizza, Pastas, Tacos, Comida China, Mexicana, Italiana..." />
		<input type="submit" value="BUSCAR" id="submit">
	</form>		
</div>
<div id="slider">
	<!-- BANNERS PLAYER-->
		<div id="wraperSlides">
			<div id="slides">
				<div class="slides_container">
					<div class="slide">
						<a href="<?=base_url()?>" title="The title" target="_blank"><img src="<?=base_url()?>images/slides/slide_1.jpg" width="670" height="300" alt="Slide 1"></a>
					</div>
					<div class="slide">
						<a href="<?=base_url()?>" title="The title" target="_blank"><img src="<?=base_url()?>images/slides/slide_2.jpg" width="670" height="300" alt="Slide 2"></a>
					</div>
					<div class="slide">
						<a href="<?=base_url()?>" title="The title" target="_blank"><img src="<?=base_url()?>images/slides/slide_3.jpg" width="670" height="300" alt="Slide 3"></a>
					</div>
					<div class="slide">
						<a href="<?=base_url()?>" title="The title" target="_blank"><img src="<?=base_url()?>images/slides/slide_4.jpg" width="670" height="300" alt="Slide 4"></a>
					</div>
					<div class="slide">
						<a href="<?=base_url()?>" title="The title" target="_blank"><img src="<?=base_url()?>images/slides/slide_5.jpg" width="670" height="300" alt="Slide 5"></a>
					</div>
					<div class="slide">
						<a href="<?=base_url()?>" title="The title" target="_blank"><img src="<?=base_url()?>images/slides/slide_6.jpg" width="670" height="300" alt="Slide 6"></a>
					</div>
					<div class="slide">
						<a href="<?=base_url()?>" title="The title" target="_blank"><img src="<?=base_url()?>images/slides/slide_7.jpg" width="670" height="300" alt="Slide 7"></a>
					</div>
				</div>
				<a href="#" class="prev"><img src="<?=base_url()?>images/slides/img/arrow-prev.png" width="24" height="43" alt="Arrow Prev"></a>
				<a href="#" class="next"><img src="<?=base_url()?>images/slides/img/arrow-next.png" width="24" height="43" alt="Arrow Next"></a>
			</div>
			<img src="<?=base_url()?>images/slides/img/example-frame.png" width="700" height="300" alt="Frame Slides" id="frame">
		</div>
	<!-- END BANNERS PLAYER-->
</div>
<div id="dialog_message" title="Suscripcion" style="display:none;">
	<h2 id="dialog_title"></h2>
	<p style="text-align:left;">
		<span id="dialog_text">Se ha suscrito exitosamente a nuestro servicio, este atento para recibir ofertas.</span>
	</p>
</div>
<script language="javascript">
<!--
$(function(){
    $(".defaultText").focus(function(srcc)
    {
        if ($(this).val() == $(this)[0].title)
        {
            $(this).removeClass("defaultTextActive");
            $(this).val("");
        }
    });
    
    $(".defaultText").blur(function()
    {
        if ($(this).val() == "")
        {
            $(this).addClass("defaultTextActive");
            $(this).val($(this)[0].title);
        }
    });
    
    $(".defaultText").blur();

	$(".searchbox").tipTip({edgeOffset: 10, defaultPosition: "right"});
});
//-->
		$(function(){
			$('#slides').slides({
				preload: true,
				preloadImage: "<?= base_url()?>images/loader.gif",
				play: 5000,
				pause: 2500,
				hoverPause: true,
				animationStart: function(current){
					$('.caption').animate({
						bottom:-35
					},100);
					if (window.console && console.log) {
						// example return of current slide number
						console.log('animationStart on slide: ', current);
					};
				},
				animationComplete: function(current){
					$('.caption').animate({
						bottom:0
					},200);
					if (window.console && console.log) {
						// example return of current slide number
						console.log('animationComplete on slide: ', current);
					};
				},
				slidesLoaded: function() {
					$('.caption').animate({
						bottom:0
					},200);
				}
			});
		});
</script>
