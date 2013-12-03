<?
$avatar = ($profile)?$profile->avatar:"";

//facebook avatar
if (strpos($avatar,'http://graph.facebook.com') !== FALSE) {
	$avatar = str_replace('20', '250', $avatar);
} 
//gravatar
else 
{
	$email = ($profile)?$profile->email:"";
	$default = ""; // link to your default avatar
	$size = 250; // size in pixels squared
	$gravatar = "http://www.gravatar.com/avatar.php?gravatar_id=" . md5($email) . "&default=" . urlencode($default) . "&size=" . $size;
	$avatar = $gravatar;
}

$lang = $this->session->userdata('language');

?>
<style type="text/css">
#map img { max-width: none; !important }
#avatar { width: 250px; !important }
.thumbnail {text-align: left; width: 250px; !important}
.error { width: 200px; padding-left: 20px; !important }
.ui-widget p { margin: 0px !important; padding: 5px 0px; }
.buttonFB{ top: 5px; position:relative;}
</style>
<section id="login">
	<div class="container">
      <div class="row">
        <div class="span9">
          <h1 class="headingmain"><span><?=lang('front.page.user.profile.title');?></span></h1>
          <div>
			<div id="successwidget" class="ui-widget" style="display:none">
				<div style="margin-top: 20px; padding: 0 .7em;" class="ui-state-highlight ui-corner-all">
					<p>
					<span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>
					<span id="successtext"><strong>Correcto!</strong> Sample ui-state-highlight style.</span>
					</p>
				</div>
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
          <br>
		  <form accept-charset="UTF-8" class="form-horizontal" name="form_profile" id="form_profile" method="post" class="cmxform">
            <div class="user-card panel shadow">
			<h1 class="heading3"><?=lang('front.page.user.profile.personal.title');?></h1>
			<div class="registerboxdiv">
				<fieldset>
					<div class="control-group">
						<label class="control-label"><span class="red">*</span> <?=lang('front.page.user.profile.personal.avatar.label');?>:</label>
						<div class="controls">
							<div class="thumbnail">
								<a data-content="<?=lang('front.page.user.profile.personal.avatar.popover.content');?>" rel="popover" href="#" data-original-title="<?=lang('front.page.user.profile.personal.avatar.popover.title');?>">
									<img id="avatar" alt="Avatar" src="<?= $avatar;?>">
								</a>
								<input type="hidden" name="profile[avatar]" value="<?= ($profile)?$profile->avatar:"";?>" />
							</div>
						</div>
					</div>
					<div class="control-group">
					  <label class="control-label"><span class="red">*</span> <?=lang('front.page.user.profile.personal.firstname.label');?>:</label>
					  <div class="controls">
						<input type="text" id="profile_firstname" class="input-xlarge" name="profile[firstname]" value="<?php if($profile) echo $profile->firstname; ?>" placeholder="<?=lang('front.page.user.profile.personal.firstname.placeholder');?>" title="<?=lang('front.page.user.profile.personal.firstname.title');?>" required />
					  </div>
					</div>
					<div class="control-group">
					  <label class="control-label"><span class="red">*</span> <?=lang('front.page.user.profile.personal.lastname.label');?>:</label>
					  <div class="controls">
						<input type="text" id="profile_lastname" class="input-xlarge" name="profile[lastname]" value="<?php if($profile) echo $profile->lastname; ?>" placeholder="<?=lang('front.page.user.profile.personal.lastname.placeholder');?>" title="<?=lang('front.page.user.profile.personal.lastname.title');?>" required />
					  </div>
					</div>
					<div class="control-group">
					  <label class="control-label"><span class="red">*</span> <?=lang('front.page.user.profile.personal.email.label');?>:</label>
					  <div class="controls">
						<input type="text" id="profile_email" class="input-xlarge" name="profile[email]" value="<?php if($profile) echo $profile->email; ?>" placeholder="<?=lang('front.page.user.profile.personal.email.placeholder');?>" title="<?=lang('front.page.user.profile.personal.email.title');?>" required email="true" />
					  </div>
					</div>
					<div class="control-group">
					  <label class="control-label"><span class="red">*</span> <?=lang('front.page.user.profile.address.city.label');?>:</label>
					  <div class="controls">
						<select id="profile_selectcity" class="span3" name="profile[idcity]">
							<option value="1">Cochabamba:</option>
							<option value="2">Santa Cruz</option>
							<option value="3">La Paz</option>
						</select>
					  </div>
					</div>
					<div class="control-group">
					  <label class="control-label"><span class="red">*</span> <?=lang('front.page.user.profile.personal.document.label');?>:</label>
					  <div class="controls">
						<input type="text" id="profile_document" class="input-xlarge" name="profile[document]" value="<?php if($profile) echo $profile->document; ?>" placeholder="<?=lang('front.page.user.profile.personal.document.placeholder');?>" title="<?=lang('front.page.user.profile.personal.document.title');?>" required />
					  </div>
					</div>
					<div class="control-group">
					  <label for="select01" class="control-label">
						<span class="red">*</span><?=lang('front.page.user.profile.personal.typedoc.label');?>:</label>
					  <div class="controls">
						<select id="select01" name="profile[typedoc]" class="span3">
						  <option value="ci"><?=lang('front.page.user.profile.personal.typedoc.option.ci');?></option>
						  <option value="pass"><?=lang('front.page.user.profile.personal.typedoc.option.pass');?></option>
						</select>
					  </div>
					</div>
					<div class="control-group">
					  <div class="controls">
						<div class="pull-right">
						  <label class="checkbox inline">
						  <button type="submit" id="submitprofile" class="btn btn-success" value="<?=lang('front.page.user.profile.personal.button.save');?>" ><?=lang('front.page.user.profile.personal.button.save');?></button>
						</div>
						<div class="pull-right">
							<a class="buttonFB" href="javascript:void(0)" onclick="displayupdateFBDialog()"><img src="<?= base_url()?>images/elements/buttons/facebook_update_<?= $lang?>.png" /></a>
						</div>
					  </div>
					</div>
				</fieldset>
            </div>
			</div>
			</form>
			<form accept-charset="UTF-8" class="form-horizontal" name="form_address" id="form_address" method="post" class="cmxform">
			<div class="user-card panel shadow">
			<h1 class="heading3"><?=lang('front.page.user.profile.address.title');?></h1>
			<div>
				<div id="successwidget2" class="ui-widget" style="display:none">
					<div style="margin-top: 20px; padding: 0 .7em;" class="ui-state-highlight ui-corner-all">
						<p>
						<span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>
						<span id="successtext2"><strong>Correcto!</strong> Sample ui-state-highlight style.</span>
						</p>
					</div>
				</div>
				<div id="errorwidget2" class="ui-widget" style="display:none">
					<div style="padding: 0 .7em;" class="ui-state-error ui-corner-all">
						<p>
						<span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-alert"></span>
						<span id="errortext2"><strong>Alerta:</strong> Sample ui-state-error style.</span>
						</p>
					</div>
				</div>
			</div>
			<br />
            <div class="registerboxdiv">
				<div class="control-group">
                  <label class="control-label"><?=lang('front.page.user.profile.address.picker.label');?>:</label>
                  <div class="controls">
					<input type="text" id="addresspicker_map" class="input-xlarge" style="width:500px;" placeholder="<?=lang('front.page.user.profile.address.address1.placeholder');?>" title="<?=lang('front.page.user.profile.address.address1.title');?>" />
                  </div>
                </div>
				<div class="control-group">
                  <label class="control-label"> <?=lang('front.page.user.profile.address.picker.map');?></label>
                  <div class="controls" style="width:700px">
					<div>
						<?/*
						<div class='input2'>
							<label><?=lang('front.page.user.profile.address.picker.address');?> : 	</label> <input id="addresspicker_map" />   <br/>
							<label><?=lang('front.page.user.profile.address.picker.locality');?>: 	</label> <input id="locality" disabled=disabled> <br/>
							<label><?=lang('front.page.user.profile.address.picker.district');?>: 	</label> <input id="administrative_area_level_2" disabled=disabled> <br/>
							<label><?=lang('front.page.user.profile.address.picker.state');?>: 	</label> <input id="administrative_area_level_1" disabled=disabled> <br/>
							<label><?=lang('front.page.user.profile.address.picker.country');?>:  	</label> <input id="country" disabled=disabled> <br/>
							<label><?=lang('front.page.user.profile.address.picker.postal');?>: 	</label> <input id="postal_code" disabled=disabled> <br/>
							<label><?=lang('front.page.user.profile.address.picker.latitude');?>:   </label> <input id="lat" disabled=disabled> <br/>
							<label><?=lang('front.page.user.profile.address.picker.longitude');?>:  </label> <input id="lng" disabled=disabled> <br/>
						</div>
						*/?>
						<div id="mapthumbnail" class="thumbnail">
							<div id="map"></div>
							<div id="legend"><?=lang('front.page.user.profile.address.picker.tip');?></div>
						</div>
						
					</div>
                  </div>
                </div>
				<div class="control-group">
                  <label class="control-label"><span class="red">*</span> <?=lang('front.page.user.profile.address.latitude.label');?>:</label>
                  <div class="controls">
					<input type="text" readonly="true" id="address_lat" class="input-xlarge" name="address[lat]" value="<?php if($address) echo $address->lat; ?>" placeholder="<?=lang('front.page.user.profile.address.latitude.placeholder');?>" title="<?=lang('front.page.user.profile.address.latitude.title');?>" required />
                  </div>
                </div>
				<div class="control-group">
                  <label class="control-label"><span class="red">*</span> <?=lang('front.page.user.profile.address.longitude.label');?>:</label>
                  <div class="controls">
					<input type="text" readonly="true" id="address_lng" class="input-xlarge" name="address[lng]" value="<?php if($address) echo $address->lng; ?>" placeholder="<?=lang('front.page.user.profile.address.longitude.placeholder');?>" title="<?=lang('front.page.user.profile.address.longitude.title');?>" required />
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label"><span class="red">*</span> <?=lang('front.page.user.profile.address.address1.label');?>:</label>
                  <div class="controls">
                    <input type="text" id="address_address1" class="input-xlarge" name="address[address1]" value="<?php if($address) echo $address->address1; ?>" placeholder="<?=lang('front.page.user.profile.address.address1.placeholder');?>" title="<?=lang('front.page.user.profile.address.address1.title');?>" required />
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label"><?=lang('front.page.user.profile.address.address2.label');?>:</label>
                  <div class="controls">
                    <input type="text" id="address_address2" class="input-xlarge" name="address[address2]" value="<?php if($address) echo $address->address2; ?>" placeholder="<?=lang('front.page.user.profile.address.address2.placeholder');?>" title="<?=lang('front.page.user.profile.address.address2.title');?>" />
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label"><span class="red">*</span> <?=lang('front.page.user.profile.address.city.label');?>:</label>
                  <div class="controls">
                    <select id="select01" class="span3" name="address[idcity]">
						<option value="1">Cochabamba:</option>
						<option value="2">Santa Cruz</option>
						<option value="3">La Paz</option>
                    </select>
                  </div>
                </div>
				<div class="control-group">
                  <label class="control-label"><span class="red">*</span> <?=lang('front.page.user.profile.address.state.label');?>:</label>
                  <div class="controls">
                    <input type="text" id="address_state" class="input-xlarge" name="address[state]" value="<?php if($address) echo $address->state; ?>" placeholder="<?=lang('front.page.user.profile.address.state.placeholder');?>" title="<?=lang('front.page.user.profile.address.state.title');?>" required />
                  </div>
                </div>
				<div class="control-group">
                  <label class="control-label"><span class="red">*</span> <?=lang('front.page.user.profile.address.zip.label');?>:</label>
                  <div class="controls">
                    <input type="text" id="address_zip" class="input-xlarge" name="address[zip]" value="<?php if($address) echo $address->zip; ?>" placeholder="<?=lang('front.page.user.profile.address.zip.placeholder');?>" title="<?=lang('front.page.user.profile.address.zip.title');?>" required />
                  </div>
                </div>
				<div class="control-group">
                  <label class="control-label"><span class="red">*</span> <?=lang('front.page.user.profile.address.phone.label');?>:</label>
                  <div class="controls">
                    <input type="text" id="address_phone" class="input-xlarge" name="address[phone]" value="<?php if($address) echo $address->phone; ?>" placeholder="<?=lang('front.page.user.profile.address.phone.placeholder');?>" title="<?=lang('front.page.user.profile.address.phone.title');?>" required />
                  </div>
                </div>
				<div class="control-group">
				  <div class="controls">
					<div class="pull-right">
					  <label class="checkbox inline">
					  <button type="submit" id="submitaddress" class="btn btn-success" value="<?=lang('front.page.user.profile.address.button.save');?>" ><?=lang('front.page.user.profile.address.button.save');?></button>
					  <?if(isset($address->id)){?>
					  <input type="hidden" name="address[id]" value="<?= ($address)?$address->id:"";?>" />
					  <?}?>
					</div>
				  </div>
				</div>
            </div>
			</div>
			</form>
			<form accept-charset="UTF-8" class="form-horizontal" name="form_password" id="form_password" method="post" class="cmxform">
			<div class="user-card panel shadow">
            <h1 class="heading3"><?=lang('front.page.user.profile.password.title');?></h1>
			<div>
				<div id="successwidget3" class="ui-widget" style="display:none">
					<div style="margin-top: 20px; padding: 0 .7em;" class="ui-state-highlight ui-corner-all">
						<p>
						<span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>
						<span id="successtext3"><strong>Correcto!</strong> Sample ui-state-highlight style.</span>
						</p>
					</div>
				</div>
				<div id="errorwidget3" class="ui-widget" style="display:none">
					<div style="padding: 0 .7em;" class="ui-state-error ui-corner-all">
						<p>
						<span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-alert"></span>
						<span id="errortext3"><strong>Alerta:</strong> Sample ui-state-error style.</span>
						</p>
					</div>
				</div>
			</div>
			<br />
            <div class="registerboxdiv">
              <fieldset>
                <div class="control-group">
                  <label  class="control-label"><span class="red">*</span><?=lang('front.page.user.profile.password.pass1.label');?>:</label>
                  <div class="controls">
                    <input type="password" id="password_pass1" class="input-xlarge" name="password" value="" title="<?=lang('front.page.user.profile.password.pass1.title');?>" required />
                  </div>
                </div>
                <div class="control-group">
                  <label  class="control-label"><span class="red">*</span><?=lang('front.page.user.profile.password.pass2.label');?>:</label>
                  <div class="controls">
                    <input type="password" id="password_pass2" class="input-xlarge" name="confirm_password" value="" title="<?=lang('front.page.user.profile.password.pass2.title');?>" required equalTo="#password_pass1" />
                  </div>
                </div>
				<div class="control-group">
				  <div class="controls">
					<div class="pull-right">
					  <label class="checkbox inline">
					  <button type="submit" id="submitpassword" class="btn btn-success" value="<?=lang('front.page.user.profile.password.button.save');?>" ><?=lang('front.page.user.profile.password.button.save');?></button>
					</div>
				  </div>
				</div>
              </fieldset>
            </div>
			</div>
			</form>
			<?/*
			<form accept-charset="UTF-8" class="form-horizontal" name="form_subscribe" id="form_subscribe" method="post" class="cmxform">
			<h3 class="heading3">Newsletter</h3>
			<div class="registerboxdiv">
			  <fieldset>
				<div class="control-group">
				  <label class="control-label">Subscribe:</label>
				  <div class="controls">
					<label class="checkbox inline">
					  <input type="checkbox" value="option1" >
					  Yes </label>
					<label class="checkbox inline">
					  <input type="checkbox" value="option2" >
					  No </label>
				  </div>
				</div>
			  </fieldset>
			</div>
			</form>
			
			<form accept-charset="UTF-8" class="form-horizontal" name="form_subscribe" id="form_subscribe" method="post" class="cmxform">
				<div class="pull-right">
				<label class="checkbox inline">
				<input type="checkbox" value="option2" >
				</label>
				I have read and agree to the <a href="#" >Privacy Policy</a>
				&nbsp;
				<input type="Submit" class="btn btn-success" value="Continue">
				</div>
			</form>
			*/?>
			
        </div>
        
        <!-- Sidebar Start-->
        <div class="span3">
          <aside>
            <div class="sidewidt">
              <?/*<h1 class="heading1"><span>Account</span></h1>*/?>
              <ul class="nav nav-list categories">
				<?/*
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
				*/?>
              </ul>
            </div>
          </aside>
        </div>
        <!-- Sidebar End-->
      </div>
    </div>
  </section>

<!--DIALOG DETAIL ITEM TO CART-->
<div id="dialog_updateFB" title="<?=lang('front.page.user.profile.updateFB.dialog.title');?>" style="display:none;">
      <div class="row">
        <div class="span10" id="form_menucart_content">
		<h1><?=lang('front.page.user.profile.updateFB.dialog.title');?></h1>
		<p><?=lang('front.page.user.profile.updateFB.dialog.text');?>:</p>
        </div>
      </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
	
	$("#form_profile").validate();
	$("#form_address").validate();
	$("#form_password").validate();
	
	$('#submitprofile').click(function() {
		saveprofile();
		return false;
	});
	
	$('#form_profile').submit(function() {
		return false;
	});
	
	$('#submitaddress').click(function() {
		saveaddress();
		return false;
	});
	
	$('#form_address').submit(function() {
		return false;
	});
	
	$('#submitpassword').click(function() {
		savepassword();
		return false;
	});
	
	$('#form_password').submit(function() {
		return false;
	});
	
	//Google Maps API Code
	//Footer Maps init
	/*
	var myLatlng = new google.maps.LatLng(-17.38318,-66.145443);
	var myOptions = {
		zoom: 15,
		center: myLatlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	}
	var custommap = new google.maps.Map(document.getElementById("map"), myOptions);

	
	//PidamosAlgo
	var image = base_url+'images/maps/icons/logo64x50.png';
	var myLatLng = new google.maps.LatLng(-17.38318,-66.145443);
	var customMarker = new google.maps.Marker({
		position: myLatLng,
		map: custommap,
		center: myLatLng,
		icon: image
	});
	*/	

	var addresspicker = $( "#addresspicker" ).addresspicker();
	var addresspickerMap = $( "#addresspicker_map" ).addresspicker({
		regionBias: "fr",
		mapOptions: {
			zoom: 15, 
			<?php if($address){?>
			center:new google.maps.LatLng(<?= $address->lat;?>,<?= $address->lng;?>),
			<?}else{?>
			center:new google.maps.LatLng(<?= $regcity->lat?>,<?= $regcity->lng?>),
			<?}?>
			scrollwheel: false,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		},
		elements: {
			map:      "#map",
			lat:      "#address_lat",
			lng:      "#address_lng",
			locality: '#address_state',
			administrative_area_level_2: '#address_state',
			administrative_area_level_1: '#administrative_area_level_1',
			country:  '#country',
			postal_code: '#address_zip'
		}
	});
	var gmarker = addresspickerMap.addresspicker( "marker");
	gmarker.setVisible(true);
	addresspickerMap.addresspicker( "updatePosition");

});
	


function saveprofile()
{
	if(!$("#form_profile").valid()){
		return false;
	}

	$.ajax({
		type: "post",
		url: "<?=base_url()?>member/dashboard/ajaxupdateprofile" ,
		dataType: "json",
		data: $('#form_profile').serialize(),
		success: function(data) {
			if(data.success){
				//alert(data.message);
				$('#successtext').text('<?=lang('front.page.user.profile.save.success');?>');
				$('#errorwidget').hide();
				$('#successwidget').show();
			} else {
				//alert(data.message);
				$('#errortext').text('<?=lang('front.page.user.profile.save.fail');?>');
				$('#errorwidget').show();
				$('#successwidget').hide();
			}
		}
	});
}

function saveaddress()
{
	if(!$("#form_address").valid()){
		return false;
	}

	$.ajax({
		type: "post",
		url: "<?=base_url()?>member/dashboard/ajaxupdateaddress" ,
		dataType: "json",
		data: $('#form_address').serialize(),
		success: function(data) {
			if(data.success){
				//alert(data.message);
				$('#successtext2').text('<?=lang('front.page.user.profile.address.save.success');?>');
				$('#errorwidget2').hide();
				$('#successwidget2').show();
			} else {
				//alert(data.message);
				$('#errortext2').text('<?=lang('front.page.user.profile.address.save.fail');?>');
				$('#errorwidget2').show();
				$('#successwidget2').hide();
			}
		}
	});
}

function savepassword()
{
	if(!$("#form_password").valid()){
		return false;
	}

	$.ajax({
		type: "post",
		url: "<?=base_url()?>member/dashboard/ajaxupdatepassword" ,
		dataType: "json",
		data: $('#form_password').serialize(),
		success: function(data) {
			if(data.success){
				//alert(data.message);
				$('#successtext3').text("<?=lang('front.page.user.profile.password.save.success');?>");
				$('#errorwidget3').hide();
				$('#successwidget3').show();
			} else {
				//alert(data.message);
				$('#errortext3').text("<?=lang('front.page.user.profile.password.save.fail');?>");
				$('#errorwidget3').show();
				$('#successwidget3').hide();
			}
		}
	});
}

function displayupdateFBDialog()
{
	$( "#dialog_updateFB" ).dialog({
		resizable: false,
		height:'auto',
		width: 'auto',
		modal: true,
		buttons: {
			"<?=lang('front.page.user.profile.updateFB.dialog.button.ok');?>": function() {
				$( this ).dialog( "close" );
			},
			"<?=lang('front.page.user.profile.updateFB.dialog.button.cancel');?>": function() {
				$( this ).dialog( "close" );
			}
		}
	});
};
</script>
