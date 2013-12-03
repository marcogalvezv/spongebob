<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
	<script type="text/javascript" src="<?=base_url()?>js/jquery/jcarousellite_1.0.1.js"></script>
	<script type="text/javascript">
		$(function() {
			$(".DealClass").jCarouselLite({
				btnNext: ".next",
				btnPrev: ".prev",
				auto: 2000,
				speed:5000,
				circular: "True",
				visible:1,
				scroll:1
			});
		});

	</script>
</head>
<body>

<h1>Welcome to CodeIgniter!</h1>

<p>The page you are looking at is being generated dynamically by CodeIgniter.</p>

<p>If you would like to edit this page you'll find it located at:</p>
<code>application/views/welcome_message.php</code>

<p>The corresponding controller for this page is found at:</p>
<code>application/controllers/welcome.php</code>

<p>If you are exploring CodeIgniter for the very first time, you should start by reading the <a href="user_guide/">User Guide</a>.</p>


<p><br />Page rendered in {elapsed_time} seconds</p>
							<div id="sliderViewedItems" class="slider BgWhite">
								<div id="contentRailRecently" class="contentRail">
									<div id="Previous"><a href="#" class="prev"><img src="<?=base_url()?>images/elements/arrows/previous_item.gif" title="previous item" /></a></div>
										<div id="Deal" class="DealClass">
											<ul>
													<li>
														<a href="<?=base_url()?>" title="title">
														<div class="frame100per">
															<div class="imgDeal">
																<img src="/upload/images/slider/cacho_biela_comida.jpg" style="width:680px">
															</div>
														</div>
														</a>
													</li>
													
													<li>
														<a href="<?=base_url()?>" title="title">
														<div class="frame100per">
															<div class="imgDeal">
																<img src="/upload/images/slider/gyros_carnes.jpg" style="width:680px">
															</div>
														</div>
														</a>
													</li>

													<li>
														<a href="<?=base_url()?>" title="title">
														<div class="frame100per">
															<div class="imgDeal">
																<img src="/upload/images/slider/castores_saltenas.jpg" style="width:680px">
															</div>
														</div>
														</a>
													</li>
													
													<li>
														<a href="<?=base_url()?>" title="title">
														<div class="frame100per">
															<div class="imgDeal">
																<img src="/upload/images/slider/chevitos_sandwich.jpg" style="width:680px">
															</div>
														</div>
														</a>
													</li>

													<li>
														<a href="<?=base_url()?>" title="title">
														<div class="frame100per">
															<div class="imgDeal">
																<img src="/upload/images/slider/frutimania.jpg" style="width:680px">
															</div>
														</div>
														</a>
													</li>

													<li>
														<a href="<?=base_url()?>" title="title">
														<div class="frame100per">
															<div class="imgDeal">
																<img src="/upload/images/slider/mosita_salon_de_te_2.jpg" style="width:680px">
															</div>
														</div>
														</a>
													</li>
											</ul>
										</div>
									<div id="Next"><a href="#" class="next"><img src="<?=base_url()?>images/elements/arrows/next_item.gif" title="next item" ></a></div>
								</div>
							</div>

</body>
</html>