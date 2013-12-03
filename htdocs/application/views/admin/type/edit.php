<article class="module width_full">
	<header><h3><?=lang('type.dialog.edittitle');?></h3></header>
	<form name="type-form" id="type-form" method="post">
		<div class="module_content">
			<fieldset class="width_3_quarter">
				<legend><b><?=lang('type.tab.dialog.legend');?></b></legend>
				<div class="fieldset_content">
					<div class="overauto">
						<label><?=lang('type.cod');?><span class="fieldreq">*</span></label>
						<input type="text" name="type[code]" id="txt_typecode" validate="required:true" value="<?php if(isset($type)) echo $type->code ?>" autofocus />
					</div>
					<div class="overauto">
						<label><?=lang('type.name');?><span class="fieldreq">*</span></label>
						<input type="text" name="type[name]" id="txt_typename" validate="required:true" value="<?php if(isset($type)) echo $type->name ?>" />
					</div>
				</div>
			</fieldset>

<?/*	<div class="Clear"></div>*/?>
	
		</div>

		<footer style="height:40px">
			<div class="submit_link">
			<?php if(isset($type)){?>
				<input type="hidden" name="type[id]" value="<?= $type->id?>" />
			<?}?>
				<input onclick="savetype()" value="<?= lang('dialog.save');?>" type="button" />&nbsp;&nbsp;
				<input onclick="closeformtype()" value="<?= lang('dialog.cancel');?>" type="button" />
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
	$('#type-form').validate();
});

	function savetype()
	{
		$('#type-form').submit();
	}

	function closeformtype()
	{
		/*$('#dialog_typeedit').dialog('close');*/
		$('#id-tab-8').click();
	}	

	$('#type-form').submit(function() 
	{
		if(!$('#type-form').valid())
		{
			return false;
		}
		
		$.ajax({
			type: "post",
			url: "<?=base_url()?>admin/type/ajaxsave" ,
			dataType: "json",
			data: $('#type-form').serialize(),
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
					
					$('#id-tab-8').click();
/*					$('#dialog_typeedit').dialog('close');
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