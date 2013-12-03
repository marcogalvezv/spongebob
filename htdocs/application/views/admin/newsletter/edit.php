<div id="errordiv" class="ui-widget" style="margin-top: 10px;">
	<div style="padding: 0 .7em;" class="ui-state-error ui-corner-all"> 
		<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-alert"></span> 
		<strong>Error:</strong> <span id="errormsg"><span></p>
	</div>
	<br />
</div>
<h3><?=lang('newsletter.sendnewsletters');?></h3>
<form name="sendnewsletter-form" id="sendnewsletter-form" method="post" autocomplete="off">
	<div class="fila">
		<div class="col" style="width:20%"><b><?=lang('newsletter.title');?><span class="fieldreq">*</span></b></div>
		<div class="col" style="width:80%">
			<input type="text" style="width:300px" name="newsletter[title]" id="txt_newslettertitle" validate="required:true" value="<?php if(isset($newsletter->title)) echo $newsletter->title ?>" />
		</div>
	</div>
	<div class="fila">
		<div class="col" style="width:100%">
			<textarea id="ckeditornewsletter_" class="ckeditorlongdesc1" name="newsletter[content]" cols="80" rows="5"><?php if(isset($newsletter->content)){ echo $newsletter->content; } ?></textarea>
		</div>
		<div class="col" style="width:100%">
			<label for="ckeditornewsletter_" class="error" style="display:none"><?=lang('newsletter.validcontent');?></label>
		</div>
	</div>
	<fieldset class="ui-corner-all">
		<legend class="ui-corner-all"><b><?=lang('newsletter.send');?></b></legend>
		<div class="fila">
			<div class="col" style="width:4%">
				<input style="text-align:center; margin-left:10px" type="checkbox" name="newsletter[sendafter]" id="txt_newslettertitle" value="1" <?php if(isset($newsletter->sendafter) && $newsletter->sendafter == 1){ echo "checked='true'";} ?> />
			</div>
			<div class="col" style="width:95%"><b><?=lang('newsletter.after');?></b></div>
		</div>				
		<div class="fila">
			<div class="col" style="width:28%; margin-left:10px"><b><?=lang('newsletter.sendall');?></b></div>
			<div class="col" style="width:70%">
				<select name="countries[]" style="width:300px" id="txt_newslettercountries" multiple="true" size="7">
					<option value="all" selected>All Countries</option>
					<?php foreach($countries as $country){ ?>
						<option value="<?= $country->name?>"><?= $country->fullname;?></option>
					<?}?>
				</select>
			</div>
		</div>
	</fieldset>
	<div class="fila">
		<div class="col" style="width:35%"></div>
		<div class="col" style="width:65%">
			<br /><br />
			<input onclick="saveformnewsletter()" id="NewsletterSubmitButton" value="<?= lang('marketing.save')?>" type="button" />&nbsp;&nbsp;
			<input onclick="closeformnewsletter()" id="NewsletterCloseAdd" value="<?= lang('marketing.cancel')?>" type="button" />
		</div>
	</div>
	<?php if(isset($newsletter->id)) echo "<input type='hidden' name='newsletter[id]' value='".$newsletter->id."' />"; ?>
</form>

<!--SCRIPTS REC-->
<script type="text/javascript">
var sendtext = '<?= lang('newsletter.sendtext');?>';
var senttext = '<?= lang('newsletter.senttext');?>';


$(document).ready(function()
{
	$('#errordiv').hide();
	var editorName = 'ckeditornewsletter_';
	if (CKEDITOR.instances[editorName]) {
		CKEDITOR.remove(CKEDITOR.instances[editorName]);
	}	
	
	editorName = 'ckeditorfaq_';
	if (CKEDITOR.instances[editorName]) {
		CKEDITOR.remove(CKEDITOR.instances[editorName]);
	}
	
	$("#ckeditornewsletter_").ckeditor(ckconfig);
	
	$.metadata.setType("attr", "validate");	
	$('#sendnewsletter-form').validate();
});

	function saveformnewsletter()
	{
		$('#sendnewsletter-form').submit();
	}

	$('#sendnewsletter-form').submit(function() 
	{
		if(!$('#sendnewsletter-form').valid())
		{
			return false;
		}
		$("#combo_newslettersent").empty();
		
		
		$.ajax({
			type: "post",
			url: "<?=base_url()?>admin/marketing/ajaxnewslettersave" ,
			dataType: "json",
			data: $('#sendnewsletter-form').serialize(),
			success: function(data) {
				if(data.success)
				{
					var options = '';
					$.each(data.emails, function(i,item){
						options += '<option value="' + i + '">' + item + '</option>';
					});
					$("#combo_newslettersent").append(options);
					
					$().toastmessage('showToast', {
						text     : '<?= lang('shop.saved');?>',
						no_sticky   : true,
						position : 'middle-center',
						type     : 'success',
						closeText: ''
					});
					$('#SendNewsletterPanel').fadeOut('slow');
					if(data.send) {
						$('#sendmsg').text(senttext);
						$('#NewsletterSentPanel').fadeIn('fast');
					} else {
						//$('#sendmsg').text(sendtext);
						$("#showNewsletterPanel").click();
					}
					
				} else {
					$().toastmessage('showToast', {
						text     : 'ERROR <br /> See error details...',
						no_sticky   : false,
						position : 'middle-center',
						type     : 'error',
						closeText: ''
					});
					$('#errormsg').text(data.message);
					$('#errordiv').show();
				}
			}
		}); 
		return false;		
	});	

	function closeformnewsletter()
	{
		$('#SendNewsletterPanel').fadeOut('slow');
		//$("#SendNewsletterPanel").empty();
		$("#showNewsletterPanel").click();
	}
	
	$('#tablemailingshipping').styleTable({
		th_bgcolor: '#ededed',
		th_color: '#000000',
		th_border_color: '#aaaaaa',
		tr_odd_bgcolor: '#ECF6FC',
		tr_even_bgcolor: '#ffffff',
		tr_border_color: '#ffffff',
		tr_hover_bgcolor: '#BCD4EC'
	});

	$("input:button").button();

</script>