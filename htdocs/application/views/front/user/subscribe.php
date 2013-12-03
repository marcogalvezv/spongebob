<div class="form90per" id="registerOrgPanel">
	<h3 style="color:red"><?= lang('front.register.subscribe.title')?></h3>
	<div class="form90per" id="textbox">
		<p><?=lang('front.register.subscribe.text');?></p>
	</div>
	<form name="subscribe_form" id="subscribe_form" method="post">
		<div align="center">
		  <div id="pagesleft" style="width: 60%">
			<div id="pagesheader" class="form100per formtext">
				<fieldset class="ui-corner-all">
					<div class="fila">
						<div class="col" style="width:200px"><?=lang('front.register.subscribe.firstname');?>:<span class="fieldreq">*</span></div>
						<div class="col" style="width:250px">
							<input type="text" name="subscribe[firstname]" id="txt_firstname" value="" validate="required:true" />
						</div>
					</div>
					<div class="fila">
						<div class="col" style="width:200px"><?=lang('front.register.subscribe.lastname');?>:<span class="fieldreq">*</span></div>
						<div class="col" style="width:250px">
							<input type="text" name="subscribe[lastname]" id="txt_lastname" value="" validate="required:true" />
						</div>
					</div>
					<div class="fila">
						<div class="col" style="width:200px"><?=lang('front.register.subscribe.email');?>:<span class="fieldreq">*</span></div>
						<div class="col" style="width:250px">
							<input type="text" name="subscribe[email]" id="txt_email" value="<?= isset($email)?$email:""?>" validate="required:true" />
							<span id="validateEmail"></span>
						</div>
					</div>
					<div class="fila">
						<div class="col" style="width:200px"><?= lang('front.register.subscribe.country');?></div>
						<div class="col" style="width:250px" class="textbox" align="left">
						<select name="subscribe[country]" id="cb_country" style="width:250px">
						<?php foreach($countries as $country){?>
							<option value="<?= $country->name?>"><?= $country->fullname?></option>
						<?}?>
						</select>
						</div>
					</div>
				</fieldset>
			</div>

			<div class="fila" align="left">
			<div class="col" style="width:100%; text-align:center;" align="center">
				<input onclick="subscribe()" value="<?= lang('front.register.subscribe.save');?>" type="button" />
			</div>
			</div>
			
		  </div><!--/formDialog60per-->
	</div><!--/center-->
	</form>
</div><!--/center-->

<script type="text/javascript">
	var validateEmail;
	$(document).ready(function()
	{
		$( "input:submit").button();
		$( "input:button").button();
		$.metadata.setType("attr", "validate");
		$("#subscribe_form").validate();
		
		validateEmail = $('#validateEmail');
        $('#txt_email').keyup(function () {
            validemail($('#txt_email'));
        });        
		$('#txt_email').blur(function () {
            validemail($('#txt_email'));
        });
		$('#txt_email').change(function () {
            validemail($('#txt_email'));
        });
	});
	
	//FUNCTIONS OUTSIDE THE DOCUMENT.READY	
		
	function validemail(object)
	{
		// cache the 'this' instance as we need access to it within a setTimeout, where 'this' is set to 'window'
		var t = object;
		
		// only run the check if the username has actually changed - also means we skip meta keys
		//if (object.value != object.lastValue) {
			
			// the timeout logic means the ajax doesn't fire with *every* key press, i.e. if the user holds down
			// a particular key, it will only fire when the release the key.
							
			if (object.timer) clearTimeout(object.timer);
			
			// show our holding text in the validation message space
			validateEmail.removeClass('error').html('<img src="/images/ajax-loader.gif" height="16" width="16" /> checking availability...');
			
			// fire an ajax request in 1/5 of a second
			object.timer = setTimeout(function () {
				$.ajax({
					type: "post",
					url: base_url+"front/user/customeremailcheck",
					dataType: "json",
					data: {
						'email': t.val()
					},
					success: function(response) {
						var HTMLmsg = '';
						validateEmail.removeClass('error');
						validateEmail.removeClass('success');
						if (response == true){ 							
							validateEmail.addClass('error').html('the email is already registered. Please try another.');
						} else {
							validateEmail.addClass('success').html('the email is available');
						}
						//validateEmail.html(HTMLmsg);
					}
				}); // End ajax method					
				
			}, 200);
			
			// copy the latest value to avoid sending requests when we don't need to
			//object.lastValue = object.value;
	}
	
	function subscribe()
	{
		$('#subscribe_form').submit();
	}

	$('#subscribe_form').submit(function() 
	{
	    validemail($('#txt_email'));
		
		if(!validateEmail.hasClass('success'))
		{
			//alert('username invalid');
			return false;
		}
		if(!$('#subscribe_form').valid())
		{
			return false;
		}
		
		$.ajax({
			type: "post",
			url: "<?=base_url()?>front/user/savesubscribe" ,
			dataType: "json",
			data: $('#subscribe_form').serialize(),
			async: false,
			success: function(data) {
				if(data.success){
					window.location = data.successlink;
				} else {
					alert(data.message);
				}
			}
		}); 
		return false;		
	});
</script>