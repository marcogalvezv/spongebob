<article class="module width_full">
	<header><h3>Add New User</h3></header>
	<form name="useradd-form" id="useradd-form" method="post">
			<div class="module_content">
				<fieldset>
					<label><?=lang('users.tab.dialog.email');?><span class="fieldreq">*</span></label>
					<input type="text" name="profile[email]" id="txt_email" value=""  autofocus required />

					<label><?=lang('users.tab.dialog.username');?><span class="fieldreq">*</span></label>
					<input type="text" name="user[username]" id="txt_username" value="" required />

					<label><?=lang('users.tab.dialog.password');?><span class="fieldreq">*</span></label>
					<input type="password" name="user[password]" id="txt_password" required />
				</fieldset>
			</div>

			<footer style="height:40px">
				<div class="submit_link">
					<input type="hidden" name="user[gid]" value="2" />
					<input type="hidden" name="profile[idcountry]" value="1" />
					<input type="hidden" name="user[idlevel]" value="1" />
					<input onclick="saveuser()" value="<?= lang('users.tab.dialog.save');?>" type="button" />&nbsp;&nbsp;
					<input onclick="closeformuser()" value="<?= lang('users.tab.dialog.cancel');?>" type="button" />
				</div>
			</footer>
	</form>
</article><!-- end of post new article -->
<!--SCRIPTS REC-->
<script type="text/javascript">
$(document).ready(function()
{
	$('#errordiv').hide();
	$('#successbox').hide();
	$("input:button").button();
	
	$.metadata.setType("attr", "validate");
	$('#useradd-form').validate();
});

	function saveuser()
	{
		$('#useradd-form').submit();
	}
	
	
	function closeformuser()
	{
/*		$('#dialog_useradd').dialog('close');*/
		$('#id-tab-2').click();
	}

	$('#useradd-form').submit(function() 
	{
		if(!$('#useradd-form').valid())
		{
			return false;
		}

		$.ajax({
			type: "post",
			url: "<?=base_url()?>admin/users/ajaxsave" ,
			dataType: "json",
			data: $('#useradd-form').serialize(),
			success: function(data) {
				if(data.success)
				{
					$().toastmessage('showToast', {
						text     : '<?= lang('users.tab.dialog.saved');?>',
						no_sticky   : true,
						position : 'middle-center',
						type     : 'success',
						closeText: ''
					});
//					$('#dialog_useradd').dialog('close');
					$('#id-tab-2').click();
//					oAdminTableUsers.fnDraw();
					
					$('#successmsg').text(data.message);
					$('#successbox').show();
				} else {
					$('#errormsg').text(data.message);
					$('#errordiv').show();
				}
			}
		}); 
		return false;		
	});	

	$("#dialog_useradd" ).attr( "title", "<?= lang('users.tab.dialog.title');?>");
</script>