<?

$lang = $this->session->userdata('language');

?>
<style type="text/css">
#map img { max-width: none; !important }
.thumbnail {text-align: left; width: 250px; !important}
.error { width: 200px; padding-left: 20px; !important }
.ui-widget p { margin: 0px !important; padding: 5px 0px; }
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

<script type="text/javascript">
$(document).ready(function() {
	
	$("#form_address").validate();
	
	$('#submitaddress').click(function() {
		saveaddress();
		return false;
	});
	
	$('#form_address').submit(function() {
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
				goUrl('<?= $_SERVER['HTTP_REFERER']?>');
			} else {
				//alert(data.message);
				$('#errortext2').text('<?=lang('front.page.user.profile.address.save.fail');?>');
				$('#errorwidget2').show();
				$('#successwidget2').hide();
			}
		}
	});
}

</script>
