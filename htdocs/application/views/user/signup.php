<script type="text/javascript" src="<?= base_url()?>js/jquery/jquery.innerfade.js"></script>
<div id="contenthome" class="frame100per">
	<div id="contentleft" class="frame50per">
		<div class="pa1" >
			<div id="titlePanel" >
				<h2 class="Celestial pa0010">Social Hub</h2>
				<div class="Line"></div>
			</div>
			<div id="leftside" class="ma1000">
		
			</div>
		</div>
		
	</div>
	<div id="contentright" class="frame50per">
	<?php
	$message = $this->session->flashdata('message');
	if(!empty($message)){?>
	<div id="errordiv" class="ui-widget" style="margin-top: 10px;">
		<div style="padding: 0 .7em;" class="ui-state-error ui-corner-all"> 
			<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-alert"></span> 
			<strong>Error:</strong> <span id="errormsg"><?= $message?><span></p>
		</div>
		<br />
	</div>
	<?}?>
		<div id="RightContainer" class="pa1000">
			<div id="RightContentView">
				<div id="FormSignUpPass" class="formsignup">
					<form name="signupuser_form" id="signupuser_form" method="post" action="<?= base_url()?>user/signup">
						<h1 class="Celestial">Sign Up</h1><br/>
						<div class="fila">
							<div class="col Celestial" style="width:150px"><b>Username</b><span class="fieldreq">*</span></div>
							<div class="col" style="width:300px">
								<input type="text" name="user[username]" id="txt_signupusername" class="textbox" validate="required:true" value="" style="width:280px" />
								<span id="validateHomeUsername"></span>
							</div>
						</div>
						<div class="fila">
							<div class="col Celestial" style="width:150px"><b>Email</b><span class="fieldreq">*</span></div>
							<div class="col" style="width:300px"><input type="text" name="profile[email]" id="txt_signupemail" class="textbox" validate="required:true, email:true" value="" style="width:280px" /></div>
						</div>
						<div class="fila">
							<div class="col Celestial" style="width:150px"><b>Password</b><span class="fieldreq">*</span></div>
							<div class="col" style="width:300px"><input type="password" name="user[password]" id="txt_signuppassword" class="textbox" validate="required:true, minlength: 6" value="" style="width:280px" /></div>
						</div>
						<div class="fila">
							<div class="col Celestial" style="width:150px"><b>Re-enter Password</b><span class="fieldreq">*</span></div>
							<div class="col" style="width:300px"><input type="password" id="txt_signuprepassword" class="textbox" validate="required:true, minlength: 6, equalTo: '#txt_signuppassword'" value="" style="width:280px" /></div>
						</div>
<?/*						<div class="fila">
							<div class="col Celestial" style="width:150px"><b>Verification Code</b><span class="fieldreq">*</span></div>
							<div class="col" style="width:150px"><input type="text" id="txt_signupcaptcha" class="textbox" validate="required:true" value="" style="width:140px" /></div>
							<div class="col" style="width:150px"><img src="<?=base_url()?>images/VerificationCode.jpg" /></div>
						</div>
*/?>
						<div class="fila">
						<div class="col Celestial" style="width:150px"><b>Verification Code</b>:<span class="fieldreq">*</span></div>
						<div class="col" style="width:250px;0">
							<img id="siimage" align="left" style="padding-right: 5px; border: 0" src="/testsecurimage/show/sid/<?php echo md5(time()) ?>" />
							<div class="fila">
								<div class="col" style="width:50%; text-align:right">
								<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="19" height="19" id="SecurImage_as3" align="middle">
									<param name="allowScriptAccess" value="sameDomain" />
									<param name="allowFullScreen" value="false" />
									<param name="movie" value="<?= base_url()?>securimage/securimage_play.swf?audio=<?= base_url()?>testsecurimage/play/bgColor1/#777/bgColor2/#fff/iconColor/#000/roundedCorner/5" />
									<param name="quality" value="high" />
								
									<param name="bgcolor" value="#ffffff" />
									<embed src="<?= base_url()?>securimage/securimage_play.swf?audio=<?= base_url()?>testsecurimage/play/bgColor1/#777/bgColor2/#fff/iconColor/#000/roundedCorner/5" quality="high" bgcolor="#ffffff" width="19" height="19" name="SecurImage_as3" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
								</object>
								</div>
								<div class="col" style="width:50%; text-align:left">
									<a tabindex="-1" style="border-style: none" href="#" title="Refresh Image" onclick="document.getElementById('siimage').src = '/testsecurimage/show/sid/' + Math.random(); captchaReload(); return false"><img style="margin-top:5px" src="<?= base_url()?>images/refresh.gif" alt="Reload Image" border="0" onclick="this.blur()" align="bottom" /></a>
								</div>
							</div>
							<input type="text" name="captcha" id="txt_captcha" size="12" value="" validate="required: true" />
							<span id="validateCaptcha"></span>
						</div>
						<?/*<div class="col Red Bold" style="width:150px;"><br/><br/><br/>(Case Sensitive)</div>*/?>
					</div>
						<div class="fila">
							<div class="col" style="width:140px; float:right; margin-right:6px;" >
								<input id="usertype" name="profile[type]" type="hidden" value="member"/>
								<input type="submit" id="submit_signup" value="Sign Up" class="FloatRight"/>
							</div>
							<div class="col" style="width:150px; float:right;" >
								<script>
									window.fbAsyncInit = function() {
									FB.init({
										appId      : '197158077038691',
										status     : true, 
										cookie     : true,
										xfbml      : true
									});
									};
									(function(d){
										var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
										js = d.createElement('script'); js.id = id; js.async = true;
										js.src = "//connect.facebook.net/en_US/all.js";
										d.getElementsByTagName('head')[0].appendChild(js);
									}(document));
								</script>
								<div class="fb-login-button">Login with Facebook</div>
							</div>
						</div>
					</form>
				</div>

			</div>

		</div>
	</div>
</div>

<script type="text/javascript">
	var validateUsername;
	var validateCaptcha;
	
$(document).ready(function(){
	$( "input:submit").button();
	$( "input:button").button();

	$.metadata.setType("attr", "validate");
	$("#signupuser_form").validate();
	
	var captchacheckresult = false;
	$.validator.addMethod("captchacheck", function(value) {
		$.ajax({
			type: "post",
			url: base_url+"testsecurimage/captchacheck",
			dataType: "json",
			data: {
				'code': value
			},
			success: function(response) {
				//alert(response);
				if (response == true){ 
					captchacheckresult = true;
				} else {
					captchacheckresult = false;
				}
			}
		}); // End ajax method
		return captchacheckresult;
	}, 'The captcha is invalid, please try again or reload');
	
	//validate username events
	validateUsername = $('#validateHomeUsername');
	$('#txt_signupusername').keyup(function () {
		validusername(this);
	});        
	$('#txt_signupusername').blur(function () {
		validusername(this);
	});
	$('#txt_signupusername').change(function () {
		validusername(this);
	});

	//validate captcha events
	validateCaptcha = $('#validateCaptcha');
	$('#txt_captcha').keyup(function () {
		validcaptcha(this);
	});        
	$('#txt_captcha').blur(function () {
		validcaptcha(this);
	});
	$('#txt_captcha').change(function () {
		validcaptcha(this);
	});
	
});

	function captchaReload()
	{
		validateCaptcha.removeClass('success');
		validateCaptcha.addClass('error').html('Invalid captcha, please try again or reload');
	}
	
	function saveformpages()
	{
		$('#signupuser_form').submit();
	}
	
	function validusername(object)
	{
		// cache the 'this' instance as we need access to it within a setTimeout, where 'this' is set to 'window'
		var t = object; 
		
		// only run the check if the username has actually changed - also means we skip meta keys
		if ((object.value != '')&&(object.value != null)) {
			if (object.value != object.lastValue) {
				
				// the timeout logic means the ajax doesn't fire with *every* key press, i.e. if the user holds down
				// a particular key, it will only fire when the release the key.
								
				if (object.timer) clearTimeout(object.timer);
				
				// show our holding text in the validation message space
				validateUsername.removeClass('error').html('<img src="/images/ajax-loader.gif" height="16" width="16" /> checking availability...');
				
				// fire an ajax request in 1/5 of a second
				object.timer = setTimeout(function () {
					/*
					$.ajax({
						url: 'ajax-validation.php',
						data: 'action=check_username&username=' + t.value,
						dataType: 'json',
						type: 'post',
						success: function (j) {
							// put the 'msg' field from the $resp array from check_username (php code) in to the validation message
							validateUsername.html(j.msg);
						}
					});
					*/
					$.ajax({
						type: "post",
						url: base_url+"user/usernamecheck",
						dataType: "json",
						data: {
							'username': t.value
						},
						success: function(response) {
							var HTMLmsg = '';
							validateUsername.removeClass('error');
							validateUsername.removeClass('success');
							if (response == true){ 
								//HTMLmsg = '<span class="error">the username is NOT available</span>';
								
								validateUsername.addClass('error').html('the user is NOT available');
							} else {
								validateUsername.addClass('success').html('the user is available');
							}
							//validateUsername.html(HTMLmsg);
						}
					}); // End ajax method					
					
				}, 200);
				
				// copy the latest value to avoid sending requests when we don't need to
				object.lastValue = object.value;
			}
		}else{
			validateUsername.removeClass('error');
			validateUsername.removeClass('success');
			validateUsername.addClass('error').html('');
			validateUsername.addClass('success').html('');
		}
	}

	function validcaptcha(object)
	{
		// cache the 'this' instance as we need access to it within a setTimeout, where 'this' is set to 'window'
		var t = object; 
		
		// only run the check if the username has actually changed - also means we skip meta keys
		if ((object.value != '')&&(object.value != null)) {
			if (object.value != object.lastValue) {
				
				// the timeout logic means the ajax doesn't fire with *every* key press, i.e. if the user holds down
				// a particular key, it will only fire when the release the key.
								
				if (object.timer) clearTimeout(object.timer);
				
				// show our holding text in the validation message space
				validateCaptcha.removeClass('error').html('<img src="/images/ajax-loader.gif" height="16" width="16" /> checking captcha...');
				
				// fire an ajax request in 1/5 of a second
				object.timer = setTimeout(function () {
					/*
					$.ajax({
						url: 'ajax-validation.php',
						data: 'action=check_username&username=' + t.value,
						dataType: 'json',
						type: 'post',
						success: function (j) {
							// put the 'msg' field from the $resp array from check_username (php code) in to the validation message
							validateCaptcha.html(j.msg);
						}
					});
					*/
					
					$.ajax({
						type: "post",
						url: base_url+"testsecurimage/captchacheck",
						dataType: "json",
						data: {
							'code': t.value
						},
						success: function(response) {
							//alert(response);
							if (response == true){ 
								captchacheckresult = true;
							} else {
								captchacheckresult = false;
							}
							var HTMLmsg = '';
							validateCaptcha.removeClass('error');
							validateCaptcha.removeClass('success');
							if (response == true){
								validateCaptcha.addClass('success').html('The captcha is valid');
							} else {
								validateCaptcha.addClass('error').html('Invalid captcha, please try again or reload');
							}
							//validateCaptcha.html(HTMLmsg);						
						}
					}); // End ajax method				
				}, 200);
				
				// copy the latest value to avoid sending requests when we don't need to
				object.lastValue = object.value;
			}
		}else{
			validateCaptcha.removeClass('error');
			validateCaptcha.removeClass('success');
			validateCaptcha.addClass('error').html('');
			validateCaptcha.addClass('success').html('');
		}
	}


	$('#signupuser_form').submit(function() 
	{
		var object = $('#txt_signupusername');
	    validusername(object);

		var captchaobject = $('#txt_captcha');
	    validcaptcha(captchaobject);

		if(!validateUsername.hasClass('success'))
		{
			//alert('username invalid');
			return false;
		}
		if(!validateCaptcha.hasClass('success'))
		{
			//alert('catpcha invalid');
			return false;
		}

		if(!$('#signupuser_form').valid())
		{
			return false;
		}
		
/*		$.ajax({
			type: "post",
			url: "<?=base_url()?>user/register" ,
			dataType: "json",
			data: $('#signupuser_form').serialize(),
			async: false,
			success: function(data) {
				if(data.success)
				{
					$().toastmessage('showToast', {
						text     : '<?= lang('shop.saved');?>',
						no_sticky : true,
						position : 'middle-center',
						type     : 'success',
						closeText: ''
					});
					window.location = data.successpage;
				}				
			}
		}); 
		return false;
*/		
	});
	
</script>
