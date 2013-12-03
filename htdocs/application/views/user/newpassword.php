<div class="flashcontent">
	<p class="flash" id="success"><span class="flash_inner">Password updated successfully</span></p>
</div>
<div id="newpassword">
<div id="wrapper_results">
	<div id="newpasswordloaderbox" class="loader" style="display:none">
		<img src="<?=base_url()?>images/ajax-loader-big.gif" />Updating...
	</div>	
</div>
<div id="newpasswordcontent">
	<form action="" class="cmxform" id="newpasswordform">
		<div class="AccountInfoContainer">
		  <div class="AccountInfoTitle">New Password Form</div>
		  <div class="SelectType">
			<div class="AccountInfo">
			  <ul>
				<li>
				  <label>Current Password :</label>
				  <input type="password" name="current_password" id="user_currentpassword" value="" validate="required:true, passwordcheck: true">
				</li>
				<li>
				  <label>Password :</label>
				  <input type="password" name="user[password]" id="user_newpassword" value="" validate="required:true">
				</li>
				<li>
				  <label>Confirm Password :</label>
				  <input type="password" name="newpassword2" id="user_newpassword2" value="" validate='required:true, equalTo: "#user_newpassword"'>
				</li>
			  </ul>
			</div>
		  </div>
		</div>
		<div class="ButtonSection">
			<input type="hidden" id="uid" name="user[id]" value="<?= $uid ?>" />
			<div class="Button"><a href="javascript:void(0)" id="submitlink"><img src="<?=base_url()?>images/submit.jpg" alt="" width="85" height="41" border="0" /></a></div>
		</div>
	</form>
</fieldset>
</div>
</div>
<script type="text/javascript">
	// Flash
	$('#success, #error').click(function() {
		$(this).hide('fast');
	});
	$.metadata.setType("attr", "validate");
    $(document).ready(function(){
		$('#success, #error').hide();
		var passwordcheckresult = true;
		
		$.validator.addMethod("passwordcheck", function(value) {
			$.ajax({
				type: "post",
				url: "<?=base_url()?>user/password_check",
				dataType: "json",
				data: {
					'password': value
				},
				success: function(response) {
					if (response == true){ 
						passwordcheckresult = true;
					} else {
						/*
						var errors = {};
						errors[element.name] =  response;
						validator.showErrors(errors);
						*/
						passwordcheckresult = false;
					}
				}
			}); // End ajax method
			return passwordcheckresult;
		}, 'Please enter the current password');

		$("#newpasswordform").validate();		
		$('#statusmsg').hide();
 	});
	
	$('#submitlink').click(function() {
		$('#newpasswordform').submit();
	});

	$('#newpasswordform').submit(function() {
		if(!$('#newpasswordform').valid())
		{
			return false;
		}
		//$('#newpasswordcontent').fadeOut();
		$('#newpasswordloaderbox').fadeIn('normal');

		$.ajax({
				type: "post",
				url: "<?=base_url()?>user/savepassword",
				dataType: "json",
				data: $("#newpasswordform").serialize(),
				success: function(data) {
					//alert(data);
					var sHTML = '';
					if(data.success){
						//alert(data.message);
						$('#newpasswordloaderbox').fadeOut('normal');
						$('#success').fadeIn();
					} else {
						sHTML = '<span class="error">'+data.message+'</span>';
						$('#statusmsg').html(sHTML);
					}
				}
		}); // End ajax method
		return false;  
	});	
	
</script>
