<div class="form90per" id="forgotPanel">
	<h3 class="titlefront"><?= lang('front.forgotpass.title')?></h3>
	<?/*<div class="breadcrumbs"><?= implode(' > ', $breads);?></div>*/?>
	<div class="form90per" id="forgotbox">
		<p><?=lang('front.forgotpass.text1');?></p>
		<br />
		<p><?=lang('front.forgotpass.text2');?></p>
	</div>
	<form name="forgotpass_form" id="forgotpass_form" method="post">
		<div align="center">
		  <div id="forgotcontainer" style="width: 65%">
			<div class="form100per formtext">
				<fieldset class="ui-corner-all">
					<div class="fila" style="text-align:center">
						<div class="col" style="width:100px"><?=lang('front.forgotpass.label');?>:<span class="fieldreq">*</span></div>
						<div class="col" style="width:250px">
							<input type="text" name="user[username]" id="txt_forgotemail" value="" validate="required:true, email:true" />
						</div>
						<div class="col" style="width:150px; margin-left:15px;">
							<input onclick="saveformpages()" value="<?= lang('front.forgotpass.submit');?>" type="button" />
						</div>
					</div>
				</fieldset>
			</div>
		  </div>
	</div>
	</form>
</div>

<script type="text/javascript">
	$(document).ready(function()
	{
		$( "input:submit").button();
		$( "input:button").button();
		$.metadata.setType("attr", "validate");
		$("#forgotpass_form").validate();
	});
	
	//FUNCTIONS OUTSIDE THE DOCUMENT.READY	
	
	function saveformpages()
	{
		$('#forgotpass_form').submit();
	}

	$('#forgotpass_form').submit(function() 
	{
		if(!$('#forgotpass_form').valid())
		{
			return false;
		}
		/*
		$.ajax({
			type: "post",
			url: "<?=base_url()?>front/user/register" ,
			dataType: "json",
			data: $('#forgotpass_form').serialize(),
			async: false,
			success: function(data) {
				if(data.success)
				{
					$().toastmessage('showToast', {
						text     : '<?= lang('shop.saved');?>',
						no_sticky : true,
						position : 'middle-center',
						type     : 'success',
						closeText: ''
					});
					window.location = data.successpage;
				}				
			}
		}); 
		return false;
		*/
	});
</script>