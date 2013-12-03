<!-- Start App Info -->
<div id="app_info">
	<!-- Start Logo -->
	<a href="#home" class="logo" style="text-align:center;">
		<img src="<?= base_url()?>images/logo.png" alt="Fluid App" style="width: 50%; height:50%; text-align:left;" />
	</a>
	<!-- End Logo -->
	<span class="tagline">Solicita Taxi de forma rapida y segura desde tu Smarthphone</span>
	<p>
		SoliciTaxi es la primera aplicacion para realizar reservas y solicitar taxi en Bolivia de forma rapida y segura.
		Tan solo un par de clicks y ya podras pedir un taxi desde donde te encuentres para ir a tu destino.
		Podras elegir entre los taxis mas cercanos a tu posicion y verificando el perfil y rating positivo del taxista que elijas para tu seguridad.
	</p>
	
	<div class="buttons_down" style="text-align:center; position:relative; clear:both; width:100%" align="center">
		<a href="#" class="large_button" id="apple">
			<span class="icon"></span>
			<em>Descargar para</em> iPhone
		</a>
	</div>
	
	<div class="price centered"> <!-- Alignments options: right_align, left_align, centered -->
		<p><b>Gratis !!!</b> <br />por tiempo limitado</p>
	</div>
		
	<div class="buttons">
		<p>Y muy pronto...</p>
		<a href="#" class="large_button" id="android">
			<span class="icon"></span>
			<em>Descargar para</em> Android
		</a>
		<a href="#" class="large_button" id="windows">
			<span class="icon"></span>
			<em>Descargar para</em> Windows
		</a>
	</div>

</div>
<!-- End App Info -->		

<!-- Start Pages -->
<div id="pages">
	<div class="top_shadow"></div>
	
	<!-- Start Home -->
	<div id="home" class="page">
		
		<div id="slider">

			<div class="slide" data-effect-out="slide">
				
				<div class="background iphone-black">
					<img src="<?= base_url()?>images/slider/iphone-back.jpg" alt="" />
				</div>
				
				<div class="foreground iphone-black">
					<img src="<?= base_url()?>images/slider/iphone-front.jpg" alt="" />
				</div>
				
			</div>
			
			<div class="slide" data-effect-in="slide">
				
				<div class="background iphone-white">
					<img src="<?= base_url()?>images/slider/iphone-back.jpg" alt="" />
				</div>
				
				<div class="foreground iphone-white">
					<iframe src="http://player.vimeo.com/video/40738306?title=0&amp;byline=0&amp;portrait=0" width="230" height="345" frameborder="0"></iframe>
				</div>
				
			</div>
			<?/*
			<div class="slide">
				
				<div class="background blackberry">
					<img src="<?= base_url()?>images/slider/blackberry-back.jpg" alt="" />
				</div>
				
				<div class="foreground blackberry">
					<img src="<?= base_url()?>images/slider/blackberry-front.jpg" alt="" />
				</div>
				
			</div>
			*/?>
			<div class="slide">
				
				<div class="background android">
					<img src="<?= base_url()?>images/slider/android-back.jpg" alt="" />
				</div>
				
				<div class="foreground android">
					<img src="<?= base_url()?>images/slider/android-back.jpg" alt="" />
				</div>
				
			</div>
			
			<div class="slide">
				
				<div class="background ipad-black">
					<iframe src="http://player.vimeo.com/video/40603475?title=0&amp;byline=0&amp;portrait=0" width="352" height="468" frameborder="0"></iframe>
				</div>
										
			</div>

			<div class="slide">
				
				<div class="background ipad-white">
					<img src="<?= base_url()?>images/slider/ipad.jpg" alt="" />
				</div>
										
			</div>
			
		</div>
	
	</div>
	<!-- End Home -->
	
	<!-- Start Team -->
	<div id="team" class="page">
		
		<h1>Team</h1>
		
		<div class="about_us content_box">
			<div class="one_half">
				<h2>Acerca de Nosotros</h2>
				<p>Somos un equipo de jovenes ingenieros, developers, economistas, abogados  emprendedores e innovadores entusiastas de la tecnolog&iacute;a y de las aplicaciones moviles en servicio de la sociedad y los nativos digitales.</p>
			</div>

			<div class="one_half column_last">
				<img src="<?= base_url()?>images/logo.png" alt="" style="width:65%;"/>
			</div>
		</div>
		
		<div class="team_members">
			<div class="person one_half">
				<img src="http://graph.facebook.com/carlotes/picture?width=90&amp;height=90">
				<h3>Carlos Alcala</h3>
				<span>Software Engineer, Web/API/Mobile Developer</span>
				<a href="http://about.me/carlosalcala">about.me/carlosalcala</a>
				<ul class="social">
					<li class="facebook"><a href="http://www.facebook.com/carlotes">Facebook</a></li>
					<li class="twitter"><a href="https://twitter.com/carlosalcala">Twitter</a></li>				
				</ul>
			</div>
			<div class="person one_half column_last">
				<img src="<?= base_url()?>images/about-team_2.png" alt="" />
				<h3>Freddy Maldonado</h3>
				<span>iOS Developer (iPhone/iPad)</span>
				<a href="http://www.fmtopapps.com/">www.fmtopapps.com</a>
				<ul class="social">
					<li class="facebook"><a href="">Facebook</a></li>
					<li class="twitter"><a href="">Twitter</a></li>
				</ul>
			</div>
			<div class="person one_half">
				<img src="<?= base_url()?>images/about-team_3.png" alt="" />
				<h3>Luis Rodriguez</h3>
				<span>Software Engineer, Web Developer</span>
				<a href="#">http://website.com</a>
				<ul class="social">
					<li class="facebook"><a href="">Facebook</a></li>
					<li class="twitter"><a href="">Twitter</a></li>
				</ul>
			</div>
			<div class="person one_half column_last">
				<img src="<?= base_url()?>images/about-team_4.png" alt="" />
				<h3>Jaime Pe&ntilde;a</h3>
				<span>Abogado</span>
				<a href="#">http://website.com</a>
				<ul class="social">
					<li class="facebook"><a href="">Facebook</a></li>
					<li class="twitter"><a href="">Twitter</a></li>
				</ul>
			</div>
			<div class="person one_half column_last">
				<img src="<?= base_url()?>images/about-team_4.png" alt="" />
				<h3>Elio Montes</h3>
				<span>Economista</span>
				<a href="#">http://website.com</a>
				<ul class="social">
					<li class="facebook"><a href="">Facebook</a></li>
					<li class="twitter"><a href="">Twitter</a></li>
				</ul>
			</div>
		</div>
		
	</div>
	<!-- End Team -->
		
	<!-- Start Features -->
	<div id="features" class="page">
		
		<h1>Features</h1>
		
		<div class="feature_list content_box">
			<div class="one_half">
				<h2 class="icon chart">Measure Stuff</h2>
				<p>Donec sed odio dui. Nullam id dolor id nibh ultricies vehicula ut id elit. Donec sed odio dui. Nullam id dolor. Nulla vitae elit libero, a pharetra augue. Nullam quis</p>
			</div>

			<div class="one_half column_last">
				<h2 class="icon cart">Buy Things</h2>
				<p>Donec sed odio dui. Nullam id dolor id nibh ultricies vehicula ut id elit. Donec sed odio dui. Nullam id dolor. Nulla vitae elit libero, a pharetra augue. Nullam quis</p>
			</div>

			<div class="one_half">
				<h2 class="icon pencil">Write Things Down</h2>
				<p>Donec sed odio dui. Nullam id dolor id nibh ultricies vehicula ut id elit. Donec sed odio dui. Nullam id dolor. Nulla vitae elit libero, a pharetra augue. Nullam quis</p>
			</div>

			<div class="one_half column_last">
				<h2 class="icon graph">Check Stats</h2>
				<p>Donec sed odio dui. Nullam id dolor id nibh ultricies vehicula ut id elit. Donec sed odio dui. Nullam id dolor. Nulla vitae elit libero, a pharetra augue. Nullam quis</p>
			</div>

			<div class="one_half">
				<h2 class="icon briefcase">Get Stuff Done</h2>
				<p>Donec sed odio dui. Nullam id dolor id nibh ultricies vehicula ut id elit. Donec sed odio dui. Nullam id dolor. Nulla vitae elit libero, a pharetra augue. Nullam quis</p>
			</div>

			<div class="one_half column_last">
				<h2 class="icon help">Help &amp; Support</h2>
				<p>Donec sed odio dui. Nullam id dolor id nibh ultricies vehicula ut id elit. Donec sed odio dui. Nullam id dolor. Nulla vitae elit libero, a pharetra augue. Nullam quis</p>
			</div>
		</div>
		
	</div>
	<!-- End Features -->		
	
	<!-- Start Screenshots -->
	<div id="screenshots" class="page">
		
		<h1>Screenshots</h1>
		
		<p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
		
		<div class="screenshot_grid content_box">
			
			<div class="one_third">
				<a href="<?= base_url()?>images/screenshots/screen_1.jpg" class="fancybox" rel="group" title="Screenshot 1"><img src="<?= base_url()?>images/screenshots/screen_1.jpg" alt="" /></a>
			</div>

			<div class="one_third">
				<a href="<?= base_url()?>images/screenshots/screen_2.jpg" class="fancybox" rel="group" title="Screenshot 2"><img src="<?= base_url()?>images/screenshots/screen_2.jpg" alt="" /></a>
			</div>
			
			<div class="one_third column_last">
				<a href="<?= base_url()?>images/screenshots/screen_3.jpg" class="fancybox" rel="group" title="Screenshot 3"><img src="<?= base_url()?>images/screenshots/screen_3.jpg" alt="" /></a>
			</div>
			
			<div class="one_third">
				<a href="<?= base_url()?>images/screenshots/screen_4.jpg" class="fancybox" rel="group" title="Screenshot 4"><img src="<?= base_url()?>images/screenshots/screen_4.jpg" alt="" /></a>
			</div>

			<div class="one_third">
				<a href="<?= base_url()?>images/screenshots/screen_5.jpg" class="fancybox" rel="group" title="Screenshot 5"><img src="<?= base_url()?>images/screenshots/screen_5.jpg" alt="" /></a>
			</div>
			
			<div class="one_third column_last">
				<a href="<?= base_url()?>images/screenshots/screen_6.jpg" class="fancybox" rel="group" title="Screenshot 6"><img src="<?= base_url()?>images/screenshots/screen_6.jpg" alt="" /></a>
			</div>
			
			<div class="one_third">
				<a href="<?= base_url()?>images/screenshots/screen_7.jpg" class="fancybox" rel="group" title="Screenshot 7"><img src="<?= base_url()?>images/screenshots/screen_7.jpg" alt="" /></a>
			</div>

			<div class="one_third">
				<a href="<?= base_url()?>images/screenshots/screen_8.jpg" class="fancybox" rel="group" title="Screenshot 8"><img src="<?= base_url()?>images/screenshots/screen_8.jpg" alt="" /></a>
			</div>
			
			<div class="one_third column_last">
				<a href="<?= base_url()?>images/screenshots/screen_9.jpg" class="fancybox" rel="group" title="Screenshot 9"><img src="<?= base_url()?>images/screenshots/screen_9.jpg" alt="" /></a>
			</div>
			
		</div>
		
	</div>
	<!-- End Screenshots -->
				
	<!-- Start Updates -->
	<div id="updates" class="page">
		
		<h1>Updates</h1>
		
		<div class="releases">
			<article class="release">
				<h2>Version 1.0.2</h2>
				<span class="date">Released on March 13th, 2012</span>
				<ul>
					<li class="new"><span><b>New</b></span> Full iOS 5.1 compatibility</li>
					<li class="fix"><span><b>Fix</b></span> Push notifications update &amp; fixes</li>
					<li class="new"><span><b>New</b></span> Added dashboard refresh button</li>
					<li class="fix"><span><b>fix</b></span> Various UI enhancements</li>
				</ul>
			</article>
			
			<article class="release">
				<h2>Version 1.0.1</h2>
				<span class="date">Released on January 10th, 2012</span>
				<ul>
					<li class="new"><span><b>New</b></span> Full iOS 5 compatibility</li>
					<li class="fix"><span><b>Fix</b></span> Push notifications update &amp; fixes</li>
					<li class="new"><span><b>New</b></span> Added dashboard refresh button</li>
					<li class="fix"><span><b>fix</b></span> Various UI enhancements</li>
				</ul>
			</article>
			
			<article class="release">
				<h2>Version 1.0</h2>
				<span class="date">Released on January 1st, 2012</span>
				<ul>
					<li class="new"><span><b>New</b></span> Initial release for iOS and Android</li>
				</ul>
			</article>
		</div>
		
	</div>
	<!-- End Updates -->
			
	<!-- Start Press -->
	<div id="press" class="page">
		
		<h1>Press</h1>
		
		<div class="press_mentions">
			<ul>
				<li>
					<div class="logo">
						<img src="<?= base_url()?>images/dark-press.png" alt="" />
					</div>
					<div class="details">
						<p>"The best mobile app website you’ve ever seen!"</p>
						<address>
							Jane Doe
							<a href="#">http://website.com &#x2192;</a>
						</address>
					</div>
				</li>	
				<li>
					<div class="logo">
						<img src="<?= base_url()?>images/dark-press.png" alt="" />
					</div>
					<div class="details">
						<p>"Cras mattis consectetur purus sit amet fermentum."</p>
						<address>
							Jane Doe
							<a href="#">http://website.com &#x2192;</a>
						</address>
					</div>
				</li>
				<li>
					<div class="logo">
						<img src="<?= base_url()?>images/dark-press.png" alt="" />
					</div>
					<div class="details">
						<p>"Etiam porta sem malesuada magna mollis euismod. Nullam quis risus eget urna mollis ornare vel eu leo."</p>
						<address>
							Jane Doe
							<a href="#">http://website.com &#x2192;</a>
						</address>
					</div>
				</li>
				<li>
					<div class="logo">
						<img src="<?= base_url()?>images/dark-press.png" alt="" />
					</div>
					<div class="details">
						<p>"Vivamus sagittis vel augue rutrum faucibus dolor."</p>
						<address>
							Jane Doe
							<a href="#">http://website.com &#x2192;</a>
						</address>
					</div>
				</li>
				<li>
					<div class="logo">
						<img src="<?= base_url()?>images/dark-press.png" alt="" />
					</div>
					<div class="details">
						<p>"Maecenas faucibus mollis interdum."</p>
						<address>
							Jane Doe
							<a href="#">http://website.com &#x2192;</a>
						</address>
					</div>
				</li>
			</ul>
		</div>
		
	</div>
	<!-- End Press -->
	
	<!-- Start Start Contact -->
	<div id="contact" class="page">
		
		<h1>Contact</h1>
		
		<p>For general questions, bug reports or press inquires please fill out the form below.</p>
		
		<div id="contact_form">
			
			<div class="validation">
				<p>Oops! Please correct the highlighted fields...</p>
			</div>

			<div class="success">
				<p>Thanks! I'll get back to you shortly.</p>
			</div>
		
			<form action="javascript:;" method="post">
				<div class="row">
					<p class="left">
						<label for="name">Name*</label>
						<input type="text" name="name" id="name" value="" />
					</p>
					<p class="right">
						<label for="email">Email*</label>
						<input type="text" name="email" id="email" value="" />
					</p>
				</div>
			
				<div class="row">
					<p class="left">
						<label for="website">Website</label>
						<input type="text" name="website" id="website" value="" />
					</p>
					<p class="right">
						<label for="subject">Subject</label>
						<input type="text" name="subject" id="subject" value="" />
					</p>
				</div>
			
				<p>
					<label for="message" class="textarea">Message</label>
					<textarea class="text" name="message" id="message"></textarea>
				</p>
			
				<input type="submit" class="button white" value="Send &#x2192;" />
			</form>
		
		</div>
		
	</div>
	<!-- End Start Contact -->
	
	<!-- Start Styles -->
	<div id="styles" class="page">
		
		<h1>Styles</h1>
		
		<div class="full">
			<h1>h1. Nullam id dolor id nibh ultricies.</h1>
			<h2>h2. Nullam id dolor id nibh ultricies.</h2>
			<h3>h3. Nullam id dolor id nibh ultricies.</h3>
			<h4>h4. Nullam id dolor id nibh ultricies.</h4>
			<h5>h5. Nullam id dolor id nibh ultricies.</h5>
			<h6>h6. Nullam id dolor id nibh ultricies.</h6>
		</div>
		
		<h2>Blockquotes</h2>
		
		<div class="one_half">
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
		</div>

		<div class="one_half column_last">
			<blockquote>
			  <p>This is a blockquote style example. It's cool.</p>
			  <cite>Some Dude, Some Website</cite>
			</blockquote>
		</div>
		
		<div class="full">
		
			<h2>Small Buttons</h2>
		
			<a href="#" class="button black">Black</a>
			<a href="#" class="button white">White</a>
			<a href="#" class="button gray">Gray</a>
			<a href="#" class="button orange">Orange</a>
			<a href="#" class="button blue">Blue</a>
			<a href="#" class="button green">Green</a>
			<a href="#" class="button pink">Pink</a>			
			<a href="#" class="button purple">Purple</a>
		
		</div>
		
		<div class="full">
			
			<h2>Large Buttons</h2>

			<a href="#" class="large_button" id="apple">
				<span class="icon"></span>
				<em>Download now for</em> iPhone
			</a>
			<a href="#" class="large_button" id="android">
				<span class="icon"></span>
				<em>Download now for</em> Android
			</a>
			<a href="#" class="large_button" id="windows">
				<span class="icon"></span>
				<em>Download now for</em> Windows
			</a>
			<a href="#" class="large_button" id="blackberry">
				<span class="icon"></span>
				<em>Download now for</em> Blackberry
			</a>
			
		</div>
		
		<h2>Columns</h2>
		
		<div class="one_half">
			<p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sed diam eget risus varius blandit sit amet non magna. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
		</div>
		
		<div class="one_half column_last">
			<p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sed diam eget risus varius blandit sit amet non magna. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
		</div>
		
		<div class="one_third">
			<p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sed diam eget risus varius blandit sit amet non magna.</p>
		</div>
		
		<div class="one_third">
			<p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sed diam eget risus varius blandit sit amet non magna.</p>
		</div>
		
		<div class="one_third column_last">
			<p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sed diam eget risus varius blandit sit amet non magna.</p>
		</div>
		
		<div class="one_third">
			<p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
		</div>
		
		<div class="two_thirds column_last">
			<p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Maecenas faucibus mollis interdum. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Curabitur blandit tempus porttitor. Donec sed odio dui. Morbi leo risus, porta ac consectetur ac, vestibulum.</p>
		</div>
		
		<h2>Tabs</h2>
		
		<div class="tabs">
			<ul class="nav">
				<li><a href="javascript:;" class="tab_1">Tab 1</a></li>
				<li><a href="javascript:;" class="tab_2">Tab 2</a></li>
				<li><a href="javascript:;" class="tab_3">Tab 3</a></li>
			</ul>
			<div id="tab_1" class="pane">
				<p>Proin elit arcu, rutrum commodo, vehicula tempus, commodo a, risus. Curabitur nec arcu. Donec sollicitudin mi sit amet mauris. Nam elementum quam ullamcorper ante. Etiam aliquet massa et lorem. Mauris dapibus lacus auctor risus. Aenean tempor ullamcorper leo. Vivamus sed magna quis ligula eleifend adipiscing. Duis orci. Aliquam sodales tortor vitae ipsum. Aliquam nulla. Duis aliquam molestie erat. Ut et mauris vel pede varius sollicitudin. Sed ut dolor nec orci tincidunt interdum. Phasellus ipsum. Nunc tristique tempus lectus.</p>
			</div>
			<div id="tab_2" class="pane">
				<p>Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc. Duis scelerisque molestie turpis. Sed fringilla, massa eget luctus malesuada, metus eros molestie lectus, ut tempus eros massa ut dolor. Aenean aliquet fringilla sem. Suspendisse sed ligula in ligula suscipit aliquam. Praesent in eros vestibulum mi adipiscing adipiscing. Morbi facilisis. Curabitur ornare consequat nunc. Aenean vel metus. Ut posuere viverra nulla. Aliquam erat volutpat. Pellentesque convallis. Maecenas feugiat, tellus pellentesque pretium posuere, felis lorem euismod felis, eu ornare leo nisi vel felis. Mauris consectetur tortor et purus.</p>
			</div>
			<div id="tab_3" class="pane">
					<p>Mauris eleifend est et turpis. Duis id erat. Suspendisse potenti. Aliquam vulputate, pede vel vehicula accumsan, mi neque rutrum erat, eu congue orci lorem eget lorem. Vestibulum non ante. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce sodales. Quisque eu urna vel enim commodo pellentesque. Praesent eu risus hendrerit ligula tempus pretium. Curabitur lorem enim, pretium nec, feugiat nec, luctus a, lacus.</p>
				<p>Duis cursus. Maecenas ligula eros, blandit nec, pharetra at, semper at, magna. Nullam ac lacus. Nulla facilisi. Praesent viverra justo vitae neque. Praesent blandit adipiscing velit. Suspendisse potenti. Donec mattis, pede vel pharetra blandit, magna ligula faucibus eros, id euismod lacus dolor eget odio. Nam scelerisque. Donec non libero sed nulla mattis commodo. Ut sagittis. Donec nisi lectus, feugiat porttitor, tempor ac, tempor vitae, pede. Aenean vehicula velit eu tellus interdum rutrum. Maecenas commodo. Pellentesque nec elit. Fusce in lacus. Vivamus a libero vitae lectus hendrerit hendrerit.</p>
			</div>
		</div>
		
		<h2>Toggle Lists</h2>
		
		<div class="toggle_list">
			<ul>
				<li class="opened"> <!-- Use class "opened" to expand a toggle on page load -->
					<div class="title">
						<h3><span>Q.</span> What are the requirements for using this app?</h3>
						<a href="javascript:;" class="toggle_link" data-open_text="+" data-close_text="-"></a>
					</div>
					<div class="content">
						<p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>

						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
					</div>
				</li>
				<li>
					<div class="title">
						<h3><span>Q.</span> How does it work?</h3>
						<a href="javascript:;" class="toggle_link" data-open_text="+" data-close_text="-"></a>
					</div>
					<div class="content">
						<p>Donec ullamcorper nulla non metus auctor fringilla. Maecenas sed diam eget risus varius blandit sit amet non magna. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
					</div>
				</li>
				<li>
					<div class="title">
						<h3><span>Q.</span> How much does it cost?</h3>
						<a href="javascript:;" class="toggle_link" data-open_text="+" data-close_text="-"></a>
					</div>
					<div class="content">
						<p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>

						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
					</div>
				</li>
			</ul>
		</div>
		
		<h2>Lightbox Images</h2>
		
		<div class="one_third">
			<a href="<?= base_url()?>images/screenshots/screen_1.jpg" rel="screenshots" class="fancybox" title=""><img src="<?= base_url()?>images/screenshots/screen_1.jpg" alt="" /></a>
		</div>
		<div class="one_third">
			<a href="<?= base_url()?>images/screenshots/screen_2.jpg" rel="screenshots" class="fancybox" title=""><img src="<?= base_url()?>images/screenshots/screen_2.jpg" alt="" /></a>
		</div>
		<div class="one_third column_last">
			<a href="<?= base_url()?>images/screenshots/screen_3.jpg" rel="screenshots" class="fancybox" title=""><img src="<?= base_url()?>images/screenshots/screen_3.jpg" alt="" /></a>
		</div>
		
		<div class="full">
		
			<h2>Tooltips</h2>
		
			<p>Cras justo odio, dapibus ac <a href="javascript:;" rel="tipsy" title="Example Tooltip">facilisis</a> in, egestas eget quam. Donec ullamcorper nulla non metus auctor fringilla. Nullam quis risus eget urna <a href="javascript:;" rel="tipsy" title="An even longer tooltip! <br/> With more stuff!">mollis ornare</a> vel eu leo.</p>
		
		</div>
		
	</div>
	<!-- End Styles -->
	
	<div class="bottom_shadow"></div>
</div>
<!-- End Pages -->

<div class="clear"></div>