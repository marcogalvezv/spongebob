<style type="text/css">
.ui-widget p { margin: 0px !important; padding: 5px 0px; }
</style>
<section id="login">
	<div class="container">
	  <div class="row">
		<div class="span9">
		  <h1 class="headingmain"><span><?=lang('front.page.user.register.title');?></span></h1>
		  <div id="contentdiv" align="center">
			<div class="ui-widget">
				<? 	$message = $this->session->flashdata('message');
					if(!empty($message)){
				?>
				<div style="padding: 0 .7em;" class="ui-state-error ui-corner-all"> 
					<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-alert"></span> 
					<strong>Error:</strong> <?= $message?></p>
				</div>
				<br />
				<?}?>
			</div>
		  </div>
		  <section class="newcustomer">
			<h2 class="heading2"><?=lang('front.page.user.register.client.title');?></h2>
			<div class="loginbox">
			  <h4 class="heading4"><?=lang('front.page.user.register.client.iam');?></h4>
				<div id="signupBox">
					<form name="userregister_form" id="userregister_form" class="cmxform" method="post" action="<?= base_url()?>user/register">
						<fieldset id="body">
						<div class="control-group">
							<label class="control-label"><?=lang('front.layout.header.register.name');?>:</label>
							<div class="controls">
							  <input type="text" maxlength="25" name="profile[firstname]" id="profile_firstname" class="span3" title="<?=lang('front.layout.header.register.name.title');?>" placeholder="<?=lang('front.layout.header.register.name.placeholder');?>" required autofocus />
							</div>
						</div>
						<div class="control-group">
							<label class="control-label"><?=lang('front.layout.header.register.last');?>:</label>
							<div class="controls">
							  <input type="text" maxlength="25" name="profile[lastname]" id="profile_lastname" class="span3" title="<?=lang('front.layout.header.register.last.title');?>" placeholder="<?=lang('front.layout.header.register.last.placeholder');?>" required />
							</div>
						</div>
						<div class="control-group">
							<label class="control-label"><?=lang('front.layout.header.register.email');?>:</label>
							<div class="controls">
							  <input type="text" name="user[username]" id="user_username" class="span3" title="<?=lang('front.layout.header.register.email.title');?>" placeholder="<?=lang('front.layout.header.register.email.placeholder');?>" required />
							</div>
						</div>
						<div class="control-group">
							<label class="control-label"><?=lang('front.layout.header.register.pass');?>:</label>
							<div class="controls">
								<input class="password" type="password" name="user[password]" id="user_password" class="span3" title="<?=lang('front.layout.header.register.pass.title');?>" placeholder="<?=lang('front.layout.header.register.pass.placeholder');?>" required />
								<div class="password-meter">
									<div class="password-meter-message">
										&nbsp;
									</div>
								</div>
							</div>
						</div>
						<div class="control-group">
							<div class="controls">
								<label for="termsok"><input id="termsok" checked="checked" name="termsok" tabindex="4" type="checkbox" title="<?=lang('front.layout.header.register.accept.title');?>" required />&nbsp;&nbsp;<?=lang('front.layout.header.register.accept');?> <a href="<?=base_url()?>terminos" target="_blank" class="normallink"><?=lang('front.layout.header.register.terms');?></a></label>							  
								<label for="termsok" generated="true" class="error"></label>
							</div>
						</div>
						<br />
						<button type="submit" id="signup" value="<?=lang('front.layout.header.register.button');?>" class="btn btn-success"><?=lang('front.layout.header.register.button');?></button>
						</fieldset>
					</form>
				</div>
			</div>
		  </section>
		</div>
		
		<!-- Sidebar Start-->
		<div class="span3">
		  <aside>
			<div class="sidewidt">
				<?/*
			  <h1 class="heading1"><span>Account</span></h1>
			  <ul class="nav nav-list categories">
				<li>
				  <a href="#">Login / Register</a>
				</li>
				<li>
				  <a href="#">Forgotten Password</a>
				</li>
				<li>
				  <a href="#">My Account</a>
				</li>
				<li>
				  <a href="#">Wish List</a>
				</li>
				<li><a href="#">Order History</a>
				</li>
				<li><a href="#">Downloads</a>
				</li>
				<li><a href="#">Returns</a>
				</li>
				<li>
				  <a href="#"> Transactions</a>
				</li>
				<li>
				  <a href="category.html">Newsletter</a>
				</li>
			  </ul>
			  */?>
			</div>
		  </aside>
		</div>
		<!-- Sidebar End-->
	  </div>
	</div>
</section>
<script type="text/javascript">
//	var validateUsername;
//	var validateCaptcha;
	
$(document).ready(function(){

	$( "input:submit").button();
	$( "input:button").button();

	$("#userregister_form").validate();
	
	$('#userregister_form').submit(function() 
	{
		$("#user_password").valid();
		if(!$('#userregister_form').valid())
		{
			return false;
		}
		
	});
});
	
</script>