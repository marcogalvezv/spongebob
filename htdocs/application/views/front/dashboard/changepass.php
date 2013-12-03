<div class="form90per" id="changepassPanel" style="padding: 0px 10px;">
	<h3 style="color:red"><?= lang('dashboard.changepass.title')?></h3>
	<div class="form100per" id="changepassword">
		<div class="fila" align="left">
			<div style="padding: 10px 0px;">
				<div id="changepassbox" class="ui-widget">
					<div style="padding: 0 .7em;" class="ui-state-highlight ui-corner-all"> 
						<p>
						<span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>
						<strong><?=lang('dashboard.changepass.text');?></strong>
						<span id="sendmsg"></span>
						</p>
					</div>
				</div>
			</div>
		</div>
		<form name="savepassword_form" id="savepassword_form" method="post">
			<div align="center">
			  <div id="pagesleft" style="width: 60%">
				<div id="pagesheader" class="form100per formtext">
					<fieldset class="ui-corner-all">
						<div class="fila">
							<div class="col" style="width:200px"><?=lang('dashboard.changepass.current');?>:<span class="fieldreq">*</span></div>
							<div class="col" style="width:250px">
								<input type="password" name="password" id="txt_current" value="" validate="required:true" />
								<br />
								<span id="validatePassword"></span>
							</div>
						</div>
						<div class="fila">
							<div class="col" style="width:200px"><?=lang('dashboard.changepass.newpass');?>:<span class="fieldreq">*</span></div>
							<div class="col" style="width:250px">
								<input type="password" name="user[password]" id="txt_password" value="" validate="required: true, minlength: 5" />
								<br />
								<span class="inputhint"><?=lang('dashboard.changepass.passhint');?></span>
							</div>
						</div>
						<div class="fila">
							<div class="col" style="width:200px"><?=lang('dashboard.changepass.repass');?>:<span class="fieldreq">*</span></div>
							<div class="col" style="width:250px">
								<input type="password" name="repassword" id="txt_repassword" value="" validate="required: true, equalTo: '#txt_password'" />
							</div>
						</div>
					</fieldset>
				</div>

				<div class="fila" style="height:80px;">
				<div class="col" style="width:100%; text-align:right; margin-top:10px;">
					<input type="hidden" name="user[id]" id="hidden_uid" value="" />
					<input onclick="savepassword()" value="<?= lang('dashboard.changepass.save');?>" type="button" />
				</div>
				</div>
				
			  </div>
			</div>
		</form>
	</div>
</div>

<script type="text/javascript">
	var validatePassword;
	$(document).ready(function()
	{
		validatePassword = $('#validatePassword');
		$('#changepassbox').hide();
		$( "input:submit").button();
		$( "input:button").button();
		$.metadata.setType("attr", "validate");
		$("#savepassword_form").validate();
        $('#txt_current').keyup(function () {
			validpassword($('#txt_current'));
        });        
		$('#txt_current').blur(function () {
            validpassword($('#txt_current'));
        });
		$('#txt_current').change(function () {
            validpassword($('#txt_current'));
        });
				
		
		
	});//END DOCUMENT
	
	//FUNCTIONS OUTSIDE THE DOCUMENT.READY	
	
	function savepassword()
	{
		$('#savepassword_form').submit();
	}
	
	
	function validpassword(object)
	{
		// cache the 'this' instance as we need access to it within a setTimeout, where 'this' is set to 'window'
		var t = object;
		//alert(object.val());
		//alert(t.val());
		//alert($('txt_current').val());
		// only run the check if the username has actually changed - also means we skip meta keys
			
			// the timeout logic means the ajax doesn't fire with *every* key press, i.e. if the user holds down
			// a particular key, it will only fire when the release the key.
							
			if (object.timer) clearTimeout(object.timer);
			
			// show our holding text in the validation message space
			validatePassword.removeClass('error').html('<img src="/images/ajax-loader.gif" height="16" width="16" /> checking availability...');
			
			// fire an ajax request in 1/5 of a second
			object.timer = setTimeout(function () {
				$.ajax({
					type: "post",
					url: base_url+"front/user/passwordcheck",
					dataType: "json",
					data: {
						'password': object.val()
					},
					success: function(response) {
						var HTMLmsg = '';
						validatePassword.removeClass('error');
						validatePassword.removeClass('success');
						if (response == false){							
							validatePassword.addClass('error').html('the current password is NOT correct');
						} else {
							validatePassword.addClass('success').html('the current password is correct');
						}
						//validatePassword.html(HTMLmsg);
					}
				}); // End ajax method					
				
			}, 200);
	}	

	$('#savepassword_form').submit(function() 
	{
		$('#changepassbox').hide();
		var object = $('#txt_current');
	    validpassword(object);
		
		if(!validatePassword.hasClass('success'))
		{
			//alert('username invalid');
			return false;
		}
		if(!$('#savepassword_form').valid())
		{
			return false;
		}
		
		$.ajax({
			type: "post",
			url: "<?=base_url()?>front/user/savepassword" ,
			dataType: "json",
			data: $('#savepassword_form').serialize(),
			async: false,
			success: function(data) {
				if(data.success)
				{
					validatePassword.removeClass('success');
					$('#changepassbox').show();
				}				
			}
		}); 
		return false;		
	});
</script>