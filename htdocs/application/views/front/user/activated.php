<div class="form90per" id="activatePanel">
	<h3 style="color:red"><?= lang('front.activate.title')?></h3>
	<div class="form100per" id="loginbox1">
		<p><?=lang('front.activate.text');?></p>
			<form action="<?= base_url()?>front/user/login" name="login_form" id="login_form" method="post">
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

	$('#login_form').submit(function() 
	{
		if(!$('#login_form').valid())
		{
			return false;
		}
	});
</script>