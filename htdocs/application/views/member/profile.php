<?
$avatar = ($profile)?$profile->avatar:"";

//facebook avatar
if (strpos($avatar,'http://graph.facebook.com') !== FALSE) {
	$avatar = str_replace('20', '135', $avatar);
}
//gravatar
else 
{
	$email = ($profile)?$profile->email:"";
	$default = ""; // link to your default avatar
	$size = 135; // size in pixels squared
	$gravatar = "http://www.gravatar.com/avatar.php?gravatar_id=" . md5($email) . "&default=" . urlencode($default) . "&size=" . $size;
	$avatar = $gravatar;
}

$lang = $this->session->userdata('language');

?>
  <section id="userpanel">
    <div class="container">
      <div class="row">
        <div class="span9">
			<h1 class="headingmain"><span><?=lang('front.page.user.dashboard.account.title');?></span></h1>
			<div class="user-card panel shadow">
				<div class="row">
					<div class="span2 user-avatar">
						<div>
							<img class="avatar-border" id="useravatar" alt="<?=lang('front.page.user.dashboard.account.avatar');?>" src="<?= $avatar;?>">
						</div>
						<div>
							<a class="btn btn-info btn-profile" href="#"><i class="icon-bookmark icon-white"></i><?=lang('front.page.user.dashboard.account.button.follow');?></a>
						</div>
						<div>
							<a class="btn btn-primary btn-profile" href="#"><i class="icon-plus-sign icon-white"></i><?=lang('front.page.user.dashboard.account.button.friend');?></a>
						</div>
						<div>
							<a class="btn btn-profile" href="#"><i class="icon-comment icon-white"></i><?=lang('front.page.user.dashboard.account.button.message');?></a>
						</div>
					</div>
					<div class="user-info span5">
						<h1 class="user-title"><?= $profile->firstname ." ".$profile->lastname; ?></h1>
						<div class="rowuser span5">
							<h4 class="user-roles"><?= $profile->email; ?></h4>
							<p class="user-bio"><?= $usercity->name; ?></p>
							<hr />
						</div>
						<div class="clearfix"></div>
						<div class="user-credit">
							<div class="rowuser span5">
								<h1 class="credit-title"><?= number_format($balance, 2);?> Bs</h1>
								<div>
									<a class="btn btn-success btn-profile" href="javascript:void(0)" onclick="loadcredit()"><i class="icon-shopping-cart icon-white"></i><?=lang('front.page.user.dashboard.account.button.credit');?></a>
								</div>
								<p class="credit-tip"><?=lang('front.page.user.dashboard.account.tipcredit');?></p>
							</div>
							<div class="clearfix"></div>
						 </div>
						 <div class="clearfix"></div>
					</div>
					<div class="user-info-right span">
					
					</div>
				</div>
				<div class="profile-share pull-right">
					<span>
						<a class="fb_button fb_button_medium" href="#">
							<span class="fb_button_text"><?=lang('front.page.user.dashboard.account.share');?></span>
						</a>
					</span>
					<span>
						<a class="tw_button tw_button_medium" href="#">
							<span class="tw_button_text"><?=lang('front.page.user.dashboard.account.share');?></span>
						</a>
					</span>
				</div>
			</div>
		  
		  <?/*
			<h3 class="heading3">My Accounts</h3>
			<div class="myaccountbox">
			<ul>
			<li>
			<a href="#"> Edit your account information</a>
			</li>
			<li>
			<a href="#"> Change your password</a>
			</li>
			<li>
			<a href="#">Modify your address book entries</a>
			</li>
			<li>
			<a href="#">Modify your wish list</a>
			</li>
			</ul>
			</div>
			<h3 class="heading3">My Orders</h3>
			<div class="myaccountbox">
			<ul>
			<li>
			<a href="#"> View your order history</a>
			</li>
			<li>
			<a href="#"> Downloads</a>
			</li>
			<li>
			<a href="#">Your Reward Points</a>
			</li>
			<li>
			<a href="#">View your return requests</a>
			</li>
			<li>
			<a href="#">Your Transactions</a>
			</li>
			</ul>
			</div>
			<h3 class="heading3">Newsletter</h3>
			<div class="myaccountbox">
			<ul>
			<li>
			<a href="#"> Subscribe</a>
			<a href="#"> unsubscribe to newsletter</a>
			</li>
			</ul>
			</div>
		  */?>
        </div>
        
        <!-- Sidebar Start-->
        <div class="span3">
          <?/*
			<aside>
			<div class="sidewidt">
			  <h1 class="heading1"><span>Account</span></h1>
			  <ul class="nav nav-list categories">
				<li>
				  <a href="#"> My Account</a>
				</li>
				<li>
				  <a href="#">Edit Account</a>
				</li>
				<li>
				  <a href="#">Password</a>
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
				<li>
				  <a href="category.html">Logout</a>
				</li>
			  </ul>
			</div>
			</aside>
		  */?>
        </div>
        <!-- Sidebar End-->
      </div>
    </div>
  </section>

<!--DIALOG MENU EMPTY-->
<div id="dialog_load_credit" title="<?=lang('front.page.user.dashboard.dialog.credit.title');?>" style="display:none;">
      <div class="row">
        <div class="span6" id="form_credit_content">
			<form accept-charset="UTF-8" class="form-horizontal" name="form_credit" id="form_credit" method="post" class="cmxform">
					<input type="hidden" name="credit[uid]" value="<?=$profile->uid?>" />
				<fieldset>
					<div class="control-group">
						<label for="creditidcity_dialog" class="control-label"><?=lang('front.page.user.dashboard.dialog.credit.amount.label');?> <span class="required email">*</span></label>
						<div class="controls">
							<select id="creditamount" class="span3" name="credit[amount]" title="<?=lang('front.page.user.dashboard.dialog.credit.amount.title');?>" required>
							  <option value="50">50</option>
							  <option value="100">100</option>
							  <option value="200">200</option>
							  <option value="300">300</option>
							  <option value="400">400</option>
							  <option value="500">500</option>
							</select>
						</div>
					</div>
				</fieldset>
			</form>
        </div>
      </div>
</div>

<div id="dialog_credit_token" title="<?=lang('front.page.user.dashboard.dialog.credit.title');?>" style="display:none;">
      <div class="row">
		<div id="dialogstatus">
			<div id="successwidget" class="ui-widget" style="display:block">
				<div style="margin-top: 20px; padding: 0 .7em;" class="ui-state-highlight ui-corner-all">
					<p>
					<span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>
					<span id="successtext"><strong>Correcto!</strong> Sample ui-state-highlight style.</span>
					</p>
				</div>
			</div>
			<div id="tokencontent" style="display:block">
					<p><?=lang('front.page.user.dashboard.dialog.credit.debitnote');?>:</p>
					<h1 id="debitnote">PA-0000000001</h1>
					<p><?=lang('front.page.user.dashboard.dialog.credit.debitnote.payment');?></p>
					<p><?=lang('front.page.user.dashboard.dialog.credit.debitnote.tip');?></p>
			</div>
			<div id="errorwidget" class="ui-widget" style="display:none">
				<div style="padding: 0 .7em;" class="ui-state-error ui-corner-all">
					<p>
					<span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-alert"></span>
					<span id="errortext"><strong>Alerta:</strong> Sample ui-state-error style.</span>
					</p>
				</div>
			</div>
		</div>
      </div>
</div>

<script type="text/javascript">
$( "#dialog_credit_token" ).dialog({
	autoOpen: false,
	resizable: false,
	height:'auto',
	width:'auto',
	modal: true,
	buttons: {
		"<?=lang('front.common.ok');?>": function() {			
			$( this ).dialog( "close" );
			$( "#dialog_load_credit" ).dialog("close");
		}
	}
});

$( "#dialog_load_credit" ).dialog({
	autoOpen: false,
	resizable: false,
	height:'auto',
	width:'auto',
	modal: true,
	buttons: {
		"<?=lang('front.page.user.dashboard.dialog.credit.button.save');?>": function() {
		
			if(!$("#form_credit").valid()){
				return false;
			}
			
			$.ajax({
				type: "post",
				url: "<?=base_url()?>member/dashboard/ajaxaddcredit" ,
				dataType: "json",
				data: $('#form_credit').serialize(),
				success: function(data) {
					if(data.success){
					
						
						$("#dialogstatus").show();
												
						$('#successtext').text(data.message);
						$('#debitnote').text(data.debitnote);
						$('#errorwidget').hide();
						$('#successwidget').show();
						//$( this ).dialog("close");
						showdebitnote();
					}
				}
			});
		},
		"<?=lang('front.common.cancel');?>": function() {
			$( this ).dialog( "close" );
		}
	}
});

function loadcredit()
{
	$("#dialog_load_credit").dialog('open');
	$("#form_credit").validate();
};

function showdebitnote()
{
	$("#dialog_credit_token").dialog('open');
};
	
$(document).ready(function() {

});//end document ready
		
</script>