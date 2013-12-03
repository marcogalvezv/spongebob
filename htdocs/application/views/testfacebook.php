<?php
	$fb_user = array();
	$fb_user = fb_getuser();
/*	echo "<pre>";
	print_r($fb_user);
	echo "</pre>";
*/
//DEV SERVER
/*	define('YOUR_APP_ID', '136529336473327');
	define('YOUR_APP_SECRET', 'a3aff9cab059674b8fc375c33e883313');

//LOCAL SERVER
	define('YOUR_APP_ID', '380991335258763');
	define('YOUR_APP_SECRET', 'e47350a283d223f7ec86c76153153b70');
*/
//	$url = urlencode("http://dev.flysocial.com/home");
	$url = urlencode("http://flysocial.synapse.com.bo/home");
	
?>
<script type="text/javascript">
	
	function logoutFB(url){
		$.ajax({
				type: "post",
				url: "<?=base_url()?>user/logout",
				dataType: "json",
				data: { 'id' : '1', 'rnd': new Date().getTime() },
				async: false,
				success: function(data) {
					//$("#content_notifications").html(data);
				}
			});
		window.location=url;
	};

	function publishFB(){
		$.ajax({
				type: "post",
//				url: "<?=base_url()?>facebookapi/publish",
				url: "<?=base_url()?>facebookapi/message",
				dataType: "json",
				data: { 'id' : '1', 'rnd': new Date().getTime() },
				async: false,
				success: function(data) {
					//$("#content_notifications").html(data);
//					if(data.success){
						alert('POSTED');
						$().toastmessage('showToast', {
							text     : 'POSTED',
							no_sticky   : true,
							position : 'middle-center',
							type     : 'success',
							closeText: ''
						});
//					}
				}
			});
		return false;
	};

	function streamPublish(name, description, hrefTitle, hrefLink, userPrompt){        
		FB.ui({ method : 'feed', 
				message: userPrompt,
				link   :  hrefLink,
				caption:  hrefTitle,
				picture: 'http://flysocial.synapse.com.bo/images/logos/logo.png'
	   });
	   //http://developers.facebook.com/docs/reference/dialogs/feed/

	};
	function publishStream(){
		streamPublish("Stream Publish", 'Ejemplo de publicación con FlySocial.com. Yo veo esta publicación correcta y es realizada con javascript!', 'Registrado por flysocial.synapse.com.bo', 'http://flysocial.synapse.com.bo', "API Facebook Application from SDK");
	};
	
	function newInvite(){
		 var receiverUserIds = FB.ui({ 
				method : 'apprequests',
				message: 'Come on man checkout my applications. visit http://dev.flysocial.com',
		 },
		 function(receiverUserIds) {
				  console.log("IDS : " + receiverUserIds.request_ids);
				}
		 );
		 //http://developers.facebook.com/docs/reference/dialogs/requests/
	};
</script>

<div>
					<div style="float:right; font-size:15px; padding-right:5px;" class="frame70per TextAlignRight ma1000">

								<?php if (!isset($fb_user['user'])){ ?>
									<div class="fb-login-button">Login with Facebook</div>
									<div id="fb-root"></div>
									<script>
										window.fbAsyncInit = function() {
											FB.init({
												appId      : '<?= YOUR_APP_ID ?>',
												status     : true, 
												cookie     : true,
												xfbml      : true
											});

											FB.Event.subscribe('auth.login', function(response) {
											window.location.reload();
											});
										};

										(function(d){
											var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
											js = d.createElement('script'); js.id = id; js.async = true;
											js.src = "//connect.facebook.net/en_US/all.js";
											d.getElementsByTagName('head')[0].appendChild(js);
										}(document));
									</script>
								<?php } else { ?>
									<div id="fb-root"></div>
										<script type="text/javascript" src="http://connect.facebook.net/en_US/all.js"></script>
										<script type="text/javascript">
										   FB.init({
											 appId  : '<?= YOUR_APP_ID ?>',
											 status : true, // check login status
											 cookie : true, // enable cookies to allow the server to access the session
											 xfbml  : true  // parse XFBML
										   });
										   
										</script>
									Welcome <?= $fb_user['user_profile']['name'] ?> 
									<br />
									<a href="javascript:void(0);" onClick="logoutFB('<?= $fb_user['logoutUrl']?>')">Logout</a>
									<br/>
									<a href="javascript:void(0);" onclick="publishFB();">Publish using Facebook</a>
									<br />
									<a href="#" onclick="newInvite(); return false;">Invite Friends</a>
								<?php } ?>
					</div>
					
					<?if($this->Systemmodel->user()){?>
					<div style="float:right; font-size:15px; padding-right:5px;" class="frame70per TextAlignRight ma1000">
						<p class="White">
						<?if($this->Systemmodel->user()->gid == 2){?>
							<?php
								if($this->Systemmodel->user()->username != 'dummy'){
									$uid = $this->Systemmodel->uid();
									$profile = $this->Systemmodel->profile($uid);
							?>
									<p class="White"><?= lang('front.welcome');?> <span class="Hellow"><?php echo $profile->firstname." ".$profile->lastname; ?></span></p>
								<?}else{?>
									<?= lang('front.welcome');?>
								<?}?>
						<?}else{
								if($this->Systemmodel->user()->username != 'dummy'){?>
									<p class="White"><?= lang('front.welcome');?> <span class="Hellow"><?php echo $this->Systemmodel->user()->username; ?></span></p>
								<?/*}else{?>
									<?= lang('front.welcome');?>
								<?*/}?>
						<?}?>
						</p>
					</div>
					<?}?>
</div>
