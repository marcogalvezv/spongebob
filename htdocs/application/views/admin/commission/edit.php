<article class="module width_full">
	<header><h3><?=lang('commission.edittitle');?></h3></header>
	<form name="commission-form" id="commission-form" method="post">
		<div class="module_content">
			<fieldset class="width_3_quarter">
				<legend><b><?=lang('commission.legend');?></b></legend>
				<div class="fieldset_content">
					<div class="overauto">
						<label><?=lang('commission.name');?><span class="fieldreq">*</span></label>
						<input type="text" name="commission[name]" id="txt_commissionname" validate="required:true" value="<?php if(isset($commission)) echo $commission->name ?>" autofocus />
					</div>
					<div class="overauto">
						<label><?=lang('commission.percent');?><span class="fieldreq">*</span></label>
						<input type="number" min="1" max="100" name="commission[percent]" id="txt_commissionpercent" validate="required:true" value="<?php if(isset($commission)) echo $commission->percent ?>" />
					</div>
				</div>
			</fieldset>

<?/*	<div class="Clear"></div>*/?>
	
		</div>

		<footer style="height:40px">
			<div class="submit_link">
			<?php if(isset($commission)){?>
				<input type="hidden" name="commission[id]" value="<?= $commission->id?>" />
			<?}?>
				<input onclick="savecommission()" value="<?= lang('dialog.save');?>" type="button" />&nbsp;&nbsp;
				<input onclick="closeformcommission()" value="<?= lang('dialog.cancel');?>" type="button" />
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
	$('#commission-form').validate();
});

	function savecommission()
	{
		$('#commission-form').submit();
	}

	function closeformcommission()
	{
		/*$('#dialog_commissionedit').dialog('close');*/
		$('#id-tab-9').click();
	}	

	$('#commission-form').submit(function() 
	{
		if(!$('#commission-form').valid())
		{
			return false;
		}
		
		$.ajax({
			type: "post",
			url: "<?=base_url()?>admin/commission/ajaxsave" ,
			dataType: "json",
			data: $('#commission-form').serialize(),
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
					
					$('#id-tab-9').click();
/*					$('#dialog_commissionedit').dialog('close');
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