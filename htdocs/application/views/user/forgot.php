<style type="text/css">
.ui-widget p { margin: 0px !important; padding: 5px 0px; }
</style>
  <section id="forgot" style="padding: 15px 0 25px 0;">
    <div class="container">
      <div class="row">
        <div class="span9">
			<h1 class="headingmain"><span><?=lang('front.page.user.forgot.title');?></span></h1>
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
          <section class="forgotpass">
            <h2 class="heading2"><?=lang('front.page.user.forgot.password.title');?></h2>
            <div class="loginbox">
              <h4 class="heading4"><?=lang('front.page.user.forgot.password.reset.title');?></h4>
			  <form name="forgotuser_form" id="forgotuser_form" method="post" action="<?= base_url()?>user/forgot" class="form-vertical" class="cmxform">
                <fieldset>
                  <div class="control-group">
                    <label  class="control-label"><?=lang('front.page.user.forgot.password.email.label');?>:</label>
                    <div class="controls">
					  <input type="text" name="profile[email]" id="txt_forgotemail" class="span3" value="" style="width:350px" title="<?=lang('front.page.user.forgot.password.email.title');?>" placeholder="<?=lang('front.page.user.forgot.password.email.placeholder');?>" required email="true" />
                    </div>
                  </div>
                  <?/*<a href="#" class="btn btn-success" onclick="document.forgotuser_form.submit()">Recuperar</a>*/?>
				  <button value="<?=lang('front.page.user.forgot.password.button');?>" class="btn btn-success" type="submit" id="forgotbutton"><?=lang('front.page.user.forgot.password.button');?></button>
				  <hr />
				  <p><?=lang('front.page.user.forgot.password.reset.tip1');?></p>
				  <p><?=lang('front.page.user.forgot.password.reset.tip2');?></p>
                </fieldset>
              </form>
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
	  <p></p><p></p>
    </div>
  </section>
  
<script type="text/javascript">
$(document).ready(function(){
	$( "input:submit").button();
	$( "input:button").button();
	$("#forgotuser_form").validate();
});


$('#forgotuser_form').submit(function() 
{
	if(!$('#forgotuser_form').valid())
	{
		return false;
	}
	
});
	
</script>