<div class="form90per" id="loginPanel">
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
	<h3 style="color:red"><?= lang('front.login.title')?></h3>
	<div class="fila">
		<div class="col" style="width:50%">
			<div class="form90per" id="loginbox1">
				<h4 style="color:blue"><?= lang('front.login.title1')?></h4>
				<p><?=lang('front.login.text1');?></p>
			</div>
			<form name="login_form" id="login_form" method="post">
				<div align="center">
				  <div id="pagesleft" class="formdialog100per">
					<div id="pagesheader" class="form100per formtext">
						<fieldset class="ui-corner-all">
							<div class="fila">
								<div class="col" style="width:150px"><?=lang('front.login.email');?>:<span class="fieldreq">*</span></div>
								<div class="col" style="width:250px">
									<input type="text" name="user[username]" id="txt_username" value="" validate="required:true" />
								</div>
							</div>
							<div class="fila">
								<div class="col" style="width:150px"><?=lang('front.login.pass');?>:<span class="fieldreq">*</span></div>
								<div class="col" style="width:250px">
									<input type="password" name="user[password]" id="txt_password" value="" validate="required:true" />
								</div>
							</div>
						</fieldset>
					</div>

					<div class="fila" style="height:80px;">
					<div class="col" style="width:50%; text-align:left;">
						<span class="fieldreq"><?=lang('front.login.help');?></span><br />
						<a href="<?= base_url()?>front/user/forgot"><?= lang('front.login.forgot');?></a>
					</div>
					<div class="col" style="width:50%; text-align:right; margin-top:10px;">
						<input onclick="login()" value="<?= lang('front.login.button1');?>" type="button" />
					</div>
					</div>
					
				  </div>
			</div>
			</form>
		</div>
		<div class="col" style="width:50%">
			<div class="form100per" id="loginrightPanel">
				<div class="form90per" id="loginbox2">
					<h4 style="color:blue"><?= lang('front.login.title2')?></h4>
					<p><?=lang('front.login.text2');?></p>
					<div align="center">
						<div id="pagesleft" class="formdialog100per">
							<div class="fila" align="left">
							<div class="col" style="width:100%; text-align:right;">
								<input onclick="register('client');" value="<?= lang('front.login.button2');?>" type="button" />
							</div>
							</div>
						</div>
					</div>
				</div>				
				<div class="form90per" id="loginbox3">
					<h4 style="color:blue"><?= lang('front.login.title3')?></h4>
					<p><?=lang('front.login.text3');?></p>
					<div align="center">
						<div id="pagesleft" class="formdialog100per">
							<div class="fila" align="left">
							<div class="col" style="width:100%; text-align:right;">
								<input onclick="register('org');" value="<?= lang('front.login.button3');?>" type="button" />
							</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function()
	{
		$( "input:submit").button();
		$( "input:button").button();
		$.metadata.setType("attr", "validate");
		$("#login_form").validate();
	});
	
	//FUNCTIONS OUTSIDE THE DOCUMENT.READY	
	
	function login()
	{
		$('#login_form').submit();
	}
	
	function register(type)
	{
		if(type == "client"){
			window.location = base_url + 'front/user/register';
		} else {
			window.location = base_url + 'front/user/corporate';
		}	
	}	

	$('#login_form').submit(function() 
	{
		if(!$('#login_form').valid())
		{
			return false;
		}
		/*
		$.ajax({
			type: "post",
			url: "<?=base_url()?>front/user/login" ,
			dataType: "json",
			data: $('#login_form').serialize(),
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