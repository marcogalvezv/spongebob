<div class="form90per" id="registerClientPanel">
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
	<h3 style="color:red"><?= lang('front.register.client.title')?></h3>
	<div class="form90per" id="textbox">
		<p><?=lang('front.register.client.text');?></p>
	</div>
	<form name="registerclient_form" id="registerclient_form" method="post">
		<div align="center">
			<div id="pagesheader" class="form100per formtext">
				<fieldset class="ui-corner-all" style="padding:15px">
					<div class="fila">
						<div class="col" style="width:250px"><?=lang('front.register.client.firstname');?>:<span class="fieldreq">*</span></div>
						<div class="col" style="width:200px">
							<input type="text" name="customer[firstname]" id="txt_firstname" value="" validate="required:true" />
						</div>
					</div>
					<div class="fila">
						<div class="col" style="width:250px"><?=lang('front.register.client.lastname');?>:<span class="fieldreq">*</span></div>
						<div class="col" style="width:200px">
							<input type="text" name="customer[lastname]" id="txt_lastname" value="" validate="required:true" />
						</div>
					</div>
					<div class="fila">
						<div class="col" style="width:250px"><?=lang('front.register.client.email');?>:<span class="fieldreq">*</span></div>
						<div class="col" style="width:200px">
							<input type="text" name="customer[email]" id="txt_username" value="" validate="required:true, email:true" />
							<span id="validateUsername"></span>
						</div>
					</div>
					<div class="fila">
						<div class="col" style="width:250px"><?=lang('front.register.client.password');?>:<span class="fieldreq">*</span></div>
						<div class="col" style="width:200px">
							<input type="password" name="user[password]" id="txt_password" value="" validate="required: true, minlength: 6" />
						</div>
					</div>
					<div class="fila">
						<div class="col" style="width:250px"><?=lang('front.register.client.repassword');?>:<span class="fieldreq">*</span></div>
						<div class="col" style="width:200px">
							<input type="password" name="confirm_password" id="txt_repassword" value="" validate="required: true, minlength: 6, equalTo: '#txt_password'" />
						</div>
					</div>
					<div class="fila">
						<div class="col" style="width:250px"><?= lang('front.register.client.origincountry');?></div>
						<div class="col" style="width:250px" class="textbox" align="left">
						<select name="customer[country_origin]" id="cb_country" style="width:250px">
						<?php foreach($countries as $country){?>
							<?if($country->name != 'AU'){?>
							<option value="<?= $country->name?>"><?= $country->fullname?></option>
							<?}?>
						<?}?>
						</select>
						</div>
					</div>
					<div class="fila">
						<div class="col" style="width:250px"><?=lang('front.register.client.mobile');?>:<span class="fieldreq">*</span></div>
						<div class="col" style="width:200px">
							<input type="text" name="customer[mobile]" id="txt_cellphone" value="" validate="required:true" />
						</div>
					</div>					
					<div class="fila">
						<div class="col" style="width:250px"><?=lang('front.register.client.phone');?>:<span class="fieldreq">*</span></div>
						<div class="col" style="width:200px">
							<input type="text" name="customer[phone]" id="txt_phone" value="" validate="required:true" />
						</div>
					</div>
					<div class="fila">
						<div class="col" style="width:250px"><?=lang('front.register.client.address1');?>:<span class="fieldreq">*</span></div>
						<div class="col" style="width:200px">
							<textarea id="txtarea_address" name="customer[address1]" cols="60" rows="2" validate="required:true" ></textarea>
						</div>
					</div>
					<div class="fila">
						<div class="col" style="width:250px"><?=lang('front.register.client.address2');?>:<span class="fieldreq">*</span></div>
						<div class="col" style="width:200px">
							<input type="text" name="customer[address2]" id="txt_address2" value="" validate="required:true" />
						</div>
					</div>
					<div class="fila">
						<div class="col" style="width:250px"><?=lang('front.register.client.citystate');?>:<span class="fieldreq">*</span></div>
						<div class="col" style="width:200px">
							<input type="text" name="customer[citystate]" id="txt_city" value="" validate="required:true" />
						</div>
					</div>
					<div class="fila">
						<div class="col" style="width:250px"><?=lang('front.register.client.zip');?>:<span class="fieldreq">*</span></div>
						<div class="col" style="width:200px">
							<input type="text" name="customer[zip]" id="txt_zip" value="" validate="required:true" />
						</div>
					</div>
					<div class="fila">
						<div class="col" style="width:250px"><?= lang('front.register.client.country');?></div>
						<div class="col" style="width:250px" class="textbox" align="left">
						<select name="customer[country]" id="cb_country" style="width:250px">
						<?php foreach($countries as $country){?>
							<option value="<?= $country->name?>"><?= $country->fullname?></option>
						<?}?>
						</select>
						</div>
					</div>	
					<div class="clear"></div>
					<br /><br />
					<hr />
					<br /><br />
					<div class="fila">
						<div class="col" style="width:250px"><?=lang('front.register.client.captcha');?>:<span class="fieldreq">*</span></div>
						<div class="col" style="width:250px; text-align:center">
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
						<div class="col Red Bold" style="width:250px; margin-left:10px;height:100px;"><br/><br/><br/>(<?=lang('front.register.client.casesensitive');?>)</div>
					</div>
				</fieldset>
				<div class="fila" align="left">
				<div class="col" style="width:100%; text-align:center;" align="center">
					<input type="hidden" name="type" value="customer" />
					<input onclick="saveformpages()" value="<?= lang('front.register.client.save');?>" type="button" />
				</div>
				</div>
			</div>	
		</div>
	</form>
</div><!--/center-->

<script type="text/javascript">
	var validateUsername;
	var validateCaptcha;
	$(document).ready(function()
	{
		$( "input:submit").button();
		$( "input:button").button();
		$.metadata.setType("attr", "validate");
		$("#registerclient_form").validate();

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
		validateUsername = $('#validateUsername');
        $('#txt_username').keyup(function () {
            validusername(this);
        });        
		$('#txt_username').blur(function () {
            validusername(this);
        });
		$('#txt_username').change(function () {
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
		
		
	});//END DOCUMENT
		
	
	//FUNCTIONS OUTSIDE THE DOCUMENT.READY	
	
	function captchaReload()
	{
		validateCaptcha.removeClass('success');
		validateCaptcha.addClass('error').html('Invalid captcha, please try again or reload');
	}
	
	function saveformpages()
	{
		$('#registerclient_form').submit();
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
						url: base_url+"front/user/usernamecheck",
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
								
								validateUsername.addClass('error').html('the email is NOT available');
							} else {
								validateUsername.addClass('success').html('the email is available');
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

	$('#registerclient_form').submit(function() 
	{
		var object = $('#txt_username');
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
		if(!$('#registerclient_form').valid())
		{
			return false;
		}
		/*
		$.ajax({
			type: "post",
			url: "<?=base_url()?>front/user/register" ,
			dataType: "json",
			data: $('#registerclient_form').serialize(),
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