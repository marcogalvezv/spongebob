<div class="contentform">
	<div class="navigationpanel ui-corner-all">
		<div class="ui-widget-header-navigation-panel ui-corner-all">
		</div>
        <a href="javascript:void(0);" id="showSendMailPanel"><?= lang('manage.tab.sendmail');?></a><br />
        <a href="javascript:void(0);" id="showReportAbusePanel"><?= lang('manage.tab.reportabuse');?></a><br />
	</div>
	<div id="ManageView" class="form85per">
		<div id="errordiv" class="ui-widget" style="margin-top: 10px; display:none;">
			<div style="padding: 0 .7em;" class="ui-state-error ui-corner-all"> 
				<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-alert"></span> 
				<strong>Error:</strong> <span id="errormsg"><span></p>
			</div>
			<br />
		</div>
		<div id="successbox" class="ui-widget" style="display:none;">
			<div style="padding: 0 .7em;" class="ui-state-highlight ui-corner-all"> 
				<p>
				<span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>
				<strong>Success:</strong> <span id="successmsg"><span></p>
				</p>
			</div>
		</div>
		<div class="form100per formtext" id="sendmailPanel">
			<h3><?= lang('manage.tab.sendmail.title');?></h3>
			<form name="sendmail-form" id="sendmail-form" method="post" autocomplete="off">
				<div class="fila">
					<div class="col" style="width:100px"><b><?= lang('manage.tab.sendmail.subject');?>: <span class="fieldreq">*</span></b></div>
					<div class="col" style="width:300px">
						<input type="text" style="width:300px" name="newsletter[title]" id="txt_newslettertitle" validate="required:true" value="<?php if(isset($newsletter->title)) echo $newsletter->title ?>" />
					</div>
				</div>
				<div class="fila">
					<div class="col" style="width:20%"><b><?= lang('manage.tab.sendmail.body');?>: <span class="fieldreq">*</span></b></div>
					<div class="col" style="width:100%">
						<textarea id="ckeditor_sendmail" class="ckeditor_sendmail_class" validate="required:true" name="newsletter[content]" cols="80" rows="5"><?php if(isset($newsletter->content)){ echo $newsletter->content; } ?></textarea>
					</div>
					<div class="col" style="width:100%">
						<label for="ckeditor_sendmail" class="error" style="display:none"><?=lang('manage.tab.reportabuse.validcontent');?></label>
					</div>
				</div>
				<div class="fila">
					<div class="col" style="width:100%">
						<br /><br />
						<input type="hidden" name="newsletter[type]" id="hidden_manage" value="0" />
						<input onclick="sendemailsubmit()" id="EmailSubmitButton" value="<?= lang('manage.tab.sendmail.send');?>" type="button" />
					</div>
				</div>
			</form>		
		</div>
		<div class="form100per formtext" id="reportabusepanel" style="display:none">
			<h3><?= lang('manage.tab.reportabuse.title');?></h3>
			<form name="reportabuse-form" id="reportabuse-form" method="post" autocomplete="off">
				<div class="fila">
					<div class="col" style="width:100px"><b><?= lang('manage.tab.sendmail.subject');?>: <span class="fieldreq">*</span></b></div>
					<div class="col" style="width:300px">
						<input type="text" style="width:300px" name="newsletter[title]" id="txt_newslettertitle" validate="required:true" value="" />
					</div>
				</div>
				<div class="fila">
					<div class="col" style="width:20%"><b><?= lang('manage.tab.sendmail.body');?><span class="fieldreq">*</span></b></div>
					<div class="col" style="width:100%">
						<textarea id="ckeditor_reportabuse" class="ckeditor_reportabuse_class" validate="required:true" name="newsletter[content]" cols="80" rows="5"></textarea>
					</div>
					<div class="col" style="width:100%">
						<label for="ckeditor_reportabuse" class="error" style="display:none"><?=lang('manage.tab.reportabuse.validcontent');?></label>
					</div>
				</div>
				<div class="fila">
					<div class="col" style="width:100%">
						<br /><br />
						<input type="hidden" name="newsletter[type]" id="hidden_manage" value="1" />
						<input onclick="reportabusesubmit()" id="ReportAbuseSubmitButton" value="<?= lang('manage.tab.sendmail.send');?>" type="button" />
					</div>
				</div>
			</form>		
		</div>
	</div>
</div><!--/contentform!-->

<script type="text/javascript">

	$(document).ready(function()
	{
		var editorName = 'ckeditor_sendmail';
		if (CKEDITOR.instances[editorName]) {
			CKEDITOR.remove(CKEDITOR.instances[editorName]);
		}	
		
		editorName = 'ckeditor_reportabuse';
		if (CKEDITOR.instances[editorName]) {
			CKEDITOR.remove(CKEDITOR.instances[editorName]);
		}
		
		$("#ckeditor_sendmail").ckeditor(ckconfig);
		$("#ckeditor_reportabuse").ckeditor(ckconfig);
		
		$.metadata.setType("attr", "validate");
		$('#sendmail-form').validate();
		$('#reportabuse-form').validate();

		$("input:button").button();
		
		$("#showSendMailPanel").live("click", function () {
			$("#reportabusepanel").hide("fast");
			$("#sendmailPanel").show("fast");
		});
		
		$("#showReportAbusePanel").live("click", function () {
			$("#sendmailPanel").hide("fast");
			$("#reportabusepanel").show("fast");
		});
	});

	
	/*
	***********************
	* SENDMAIL
	***********************
	*/

	function sendemailsubmit()
	{
		$('#sendmail-form').submit();
	}

	$('#sendmail-form').submit(function() 
	{
		if(!$('#sendmail-form').valid())
		{
			return false;
		}
		
		$.ajax({
			type: "post",
			url: "<?=base_url()?>admin/manage/ajaxsave" ,
			dataType: "json",
			data: $('#sendmail-form').serialize(),
			success: function(data) {
				if(data.success)
				{
					$().toastmessage('showToast', {
						text     : '<?= lang('manage.tab.reportabuse.saved');?>',
						no_sticky   : true,
						position : 'middle-center',
						type     : 'success',
						closeText: ''
					});
					
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
	
	/*
	***********************
	* REPORT ABUSE
	***********************
	*/
	function reportabusesubmit()
	{
		$('#reportabuse-form').submit();
	}

	$('#reportabuse-form').submit(function() 
	{
		if(!$('#reportabuse-form').valid())
		{
			return false;
		}
		
		$.ajax({
			type: "post",
			url: "<?=base_url()?>admin/manage/ajaxsave" ,
			dataType: "json",
			data: $('#reportabuse-form').serialize(),
			success: function(data) {
				if(data.success)
				{
					$().toastmessage('showToast', {
						text     : '<?= lang('manage.tab.reportabuse.saved');?>',
						no_sticky   : true,
						position : 'middle-center',
						type     : 'success',
						closeText: ''
					});
					
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