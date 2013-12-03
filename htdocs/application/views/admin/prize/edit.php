<article class="module width_full">
	<header><h3><?=lang('prize.dialog.edittitle');?></h3></header>
	<form name="prize-form" id="prize-form" method="post">
		<div class="module_content">
			<fieldset class="width_3_quarter">
				<legend><b><?=lang('prize.tab.dialog.legend');?></b></legend>
				<div class="fieldset_content">
					<div class="overauto">
						<label><?=lang('prize.name');?><span class="fieldreq">*</span></label>
						<input type="text" name="prize[name]" id="txt_prizename" validate="required:true" value="<?php if(isset($prize)) echo $prize->name ?>" />
					</div>
					<div class="overauto">
						<label><?=lang('prize.description');?><span class="fieldreq">*</span></label>
						<input type="text" name="prize[description]" id="txt_prizedescription" validate="required:true" value="<?php if(isset($prize)) echo $prize->description ?>" />
					</div>
					<div class="overauto">
						<label><?=lang('prize.status');?><span class="fieldreq">*</span></label>
						<select name="prize[status]" id="cb_prizestatus">
							<option value="1" <? if(isset($prize) && ($prize->status == 1)){echo "selected='selected'";}?>><?=lang('common.dialog.enable');?></option>
							<option value="0" <? if(isset($prize) && ($prize->status == 0)){echo "selected='selected'";}?>><?=lang('common.dialog.disable');?></option>
						</select>
					</div>
					<div class="overauto">
						<label><?=lang('prize.quantity');?><span class="fieldreq">*</span></label>
						<input type="text" name="prize[quantity]" id="txt_prizequantity" validate="required:true" value="<?php if(isset($prize)) echo $prize->quantity ?>" />
					</div>
				</div>
			</fieldset>

<?/*	<div class="Clear"></div>*/?>
	
		</div>

		<footer style="height:40px">
			<div class="submit_link">
			<?php if(isset($prize)){?>
				<input type="hidden" name="prize[id]" value="<?= $prize->id?>" />
			<?}?>
				<input onclick="saveprize()" value="<?= lang('dialog.save');?>" type="button" />&nbsp;&nbsp;
				<input onclick="closeformprize()" value="<?= lang('dialog.cancel');?>" type="button" />
			</div>
		</footer>
	</form>
</article>

<!--SCRIPTS REC-->

<script type="text/javascript">

$(document).ready(function()
{
	$('#errordiv').hide();
	$('#successbox').hide();
	$("input:button").button();
		
	$.metadata.setType("attr", "validate");
	$('#prize-form').validate();
});

	function saveprize()
	{
		$('#prize-form').submit();
	}

	function closeformprize()
	{
		/*$('#dialog_prizeedit').dialog('close');*/
		$('#id-tab-11').click();
	}	

	$('#prize-form').submit(function() 
	{
		if(!$('#prize-form').valid())
		{
			return false;
		}
		
		$.ajax({
			type: "post",
			url: "<?=base_url()?>admin/prize/ajaxsave" ,
			dataType: "json",
			data: $('#prize-form').serialize(),
			success: function(data) {
				if(data.success)
				{
					$().toastmessage('showToast', {
						text     : '<?= lang('dialog.saved');?>',
						no_sticky   : true,
						position : 'middle-center',
						type     : 'success',
						closeText: ''
					});
					
					$('#id-tab-11').click();
/*					$('#dialog_prizeedit').dialog('close');
					oAdminTableType.fnDraw();
*/
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
</script>