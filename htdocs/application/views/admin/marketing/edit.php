<form name="mailinglist-form" id="mailinglist-form" method="post">
<div align="center">
	<div id="mailinglistheader" class="formdialog80per formtext">
		<fieldset class="ui-corner-all">
			<legend class="ui-corner-all"><b><?=lang('mailinglist.legmailing');?></b></legend>
			<div class="fila">
				<div class="col" style="width:150px"><b><?=lang('mailinglist.firstname');?><span class="fieldreq">*</span></b></div>
				<div class="col" style="width:250px">
					<input type="text" name="customer[firstname]" id="txt_mailingcontact" validate="required:true" value="<?php if(isset($customer)) echo $customer->firstname ?>" />
				</div>
			</div>
			
			<div class="fila">
				<div class="col" style="width:150px"><b><?=lang('mailinglist.lastname');?><span class="fieldreq">*</span></b></div>
				<div class="col" style="width:250px">
					<input type="text" name="customer[lastname]" id="txt_mailingcontact" validate="required:true" value="<?php if(isset($customer)) echo $customer->lastname ?>" />
				</div>
			</div>

			<div class="fila">
				<div class="col" style="width:150px"><b><?=lang('mailinglist.email');?><span class="fieldreq">*</span></b></div>
				<div class="col" style="width:250px">
					<input type="text" name="customer[email]" id="txt_mailingemail" validate="required:true, email:true" value="<?php if(isset($customer)) echo $customer->email ?>" />
				</div>
			</div>

			<div class="fila">
				<div class="col" style="width:150px"><b><?=lang('mailinglist.phone');?><span class="fieldreq">*</span></b></div>
				<div class="col" style="width:250px">
					<input type="text" name="customer[phone]" id="txt_mailingphone" validate="required:true, phone:true" value="<?php if(isset($customer)) echo $customer->phone ?>" />
				</div>
			</div>
			
			
			<div class="fila">
				<div class="col" style="width:150px"><b><?=lang('mailinglist.address');?><span class="fieldreq">*</span></b></div>
				<div class="col" style="width:250px; height: 100px;">
					<textarea style="width:250px;" rows="5" cols="35" name="customer[address1]" id="txt_customeraddress" validate="required:true" value=""><?php if(isset($customer)) echo $customer->address1 ?></textarea>
				</div>
			</div>			
			<div class="fila">
				<div class="col" style="width:150px"><?= lang('shop.country');?></div>
				<div class="col" style="width:250px" class="textbox" align="left">
				<select name="customer[country]" id="cb_country" style="width:250px">
				<?php foreach($countries as $country){?>
					<option value="<?= $country->name?>" <? if($country->name == $customer->country){echo "selected='selected'";}?>><?= $country->fullname?></option>
				<?}?>
				</select>
				</div>
			</div>			
			<div class="fila">
				<div class="col" style="width:150px"><b></b></div>
				<div class="col" style="width:250px">
					<input type="checkbox" name="customer[unsubscribed]" id="check_mailingsubscribe" value="1" <?php if(isset($customer) && ($customer->unsubscribed == 1)) echo "checked='true'" ?> />
					<label for="check_mailingsubscribe"><?=lang('mailinglist.unsubscribe');?></label>
				</div>					
			</div>
		</fieldset>
	</div><!--/mailinglistheader-->

	<div id="orderdetail" class="formdialog100per">
		<fieldset class="ui-corner-all">
			<legend class="ui-corner-all"><b><?=lang('mailinglist.shipadds');?></b></legend>
			<div id="containertable" style="width: 100%; height: 130px; overflow:auto;">
				<table id="tablemailingshipping" border="0" cellpadding="4" cellspacing="0" align="center" width ="99%">
					<thead>
						<th style="width: 25%"><b><?= lang('mailinglist.titname');?></b></th>
						<th style="width: 40%"><b><?= lang('mailinglist.titaddress');?></b></th>
						<th style="width: 15%"><b><?= lang('mailinglist.titcountry');?></b></th>
						<th style="width: 20%"><b><?= lang('mailinglist.titpostal');?></b></th>
					</thead>
					<tbody>
					<?
					if (isset($shipping) && is_array($shipping) && count($shipping) > 0){
						foreach($shipping as $ship){
					?>
						<tr>
							<td align="left"><?= $ship['firstname'].' '.$ship['lastname']?></td>
							<td align="left"><?= $ship['address1'].' '.$ship['address2']?></td>
							<td align="left"><?= $ship['country']?></td>
							<td align="left"><?= $ship['zip']?></td>
						</tr>
						<?}?>
					<?}?>
					</tbody>
				</table>
			</div>
		</fieldset>
	</div><!--/orderdetail-->

	<div class="fila" align="left">
	<div class="col" style="width:100%; text-align:center;" align="center">
		<input type='hidden' name='customer[id]' value="<?= isset($customer)?$customer->id:"";?>" />
		<input onclick="saveformcustomer()" value="<?= lang('mailinglist.butsave');?>" type="button" />&nbsp;&nbsp;
		<input onclick="closeformcustomer()" value="<?= lang('mailinglist.butcancel');?>" type="button" />
	</div>
	</div>

</div><!--/center-->
</form>

<!--SCRIPTS REC-->
<script type="text/javascript">
$(document).ready(function()
{
	$("input:button").button();

	var editorName = 'ckeditornewsletter_';
	if (CKEDITOR.instances[editorName]) {
		CKEDITOR.remove(CKEDITOR.instances[editorName]);
	}
	
	editorName = 'txt_customeraddress';
	if (CKEDITOR.instances[editorName]) {
		CKEDITOR.remove(CKEDITOR.instances[editorName]);
	}
		
	$.validator.addMethod("phone", function(ph, element) {
		if (ph == null) {
			return false;
		}
		var stripped = ph.replace(/[\s()+-]|ext\.?/gi, "");
		// 10 is the minimum number of numbers required
		return ((/\d{10,}/i).test(stripped));
	}, '<?= lang('mailinglist.validPhone')?>');
	
	
	$.metadata.setType("attr", "validate");
	$('#mailinglist-form').validate();
});

	$('#mailinglist-form').submit(function() 
	{
		if(!$('#mailinglist-form').valid())
		{
			return false;
		}
		
		$.ajax({
			type: "post",
			url: "<?=base_url()?>admin/marketing/ajaxsave" ,
			dataType: "json",
			data: $('#mailinglist-form').serialize(),
			success: function(data) {
				if(data.success)
				{
					$().toastmessage('showToast', {
						text     : '<?= lang('shop.saved');?>',
						no_sticky   : true,
						position : 'middle-center',
						type     : 'success',
						closeText: ''
					});
					$('#dialog_mailingedit').dialog('close');
					oAdminTableMailing.fnDraw();
				}
			}
		}); 
		return false;		
	});	
	
	$('#tablemailingshipping').styleTable({
		th_bgcolor: '#ededed',
		th_color: '#000000',
		th_border_color: '#aaaaaa',
		tr_odd_bgcolor: '#ECF6FC',
		tr_even_bgcolor: '#ffffff',
		tr_border_color: '#ffffff',
		tr_hover_bgcolor: '#BCD4EC'
	});

	$( "#dialog_mailingedit" ).attr( "title", "<?= lang('mailinglist.titdialognew');?><?php if(isset($customer)) echo $customer->firstname." ".$customer->lastname ?>");
</script>