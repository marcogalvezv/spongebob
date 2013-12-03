<div id="contenthome" class="frame100per">
	<div id="contentleft_mail" class="frame25per" style="z-index:9;">
		<div id="panel_mail" class="pa1 Border3px ui-corner-all-gift overflow degrade BgTransp90per font13px18px shadow" style="heidght:600px">
			<div class="frame100per Border1 ui-corner-all-gift pa1000 TextAlignCenter">
				<h3 class="Black pa0010">Account</h3>
			</div>
			<div class="frame100per TextAlignCenter pa20 Border0010">
				<input type="button" id="btn_compose" value="COMPOSE" onClick=v_email_edit(-1) />
			</div>
			<div class="frame100per" id="menumail" style="font-size:1.2em">
				<div class="frame100per ma2000">
					<div id="accordion_menu_mail">
						<h3><a href="javascript:void(0)" onClick=changeMenuMember("<?=base_url()?>member/mail")>Inbox</a></h3><div></div>
						<h3><a href="javascript:void(0)" onClick=changeMenuMember("<?=base_url()?>member/mail/sentmail")>Sent Mail</a></h3><div></div>
					</div>
				</div>
			</div>
		</div>
	</div>	
	<div id="contentright_mail" class="frame75per">
		<div class="ma1000 pa2022 Border3330 ui-corner-right-gift overflow BgCelestial BgTransp90per shadow">
			<div class="frame100per">
			<? if($option == "account"){?>
				<h4 class="Blue">Inbox</h4>
			<?} if($option == "compose"){?>
				<h4 class="Blue">Compose</h4>
			<?} if($option == "answer"){?>
				<h4 class="Blue">Answer</h4>
			<?} if($option == "events"){?>
				<h4 class="Blue">Events</h4>
			<?} if($option == "flights"){?>
				<h4 class="Blue">Flights</h4>
			<?} if($option == "sentmail"){?>
				<h4 class="Blue">Sent Mail</h4>
			<?}?>
				<br>
			</div>
			
			<div class="frame95per">

			<!--`LIST MAIL-->
			
			<?/*if($option != "compose" && $option != "answer" && $option != "reader"){*/?>
			<?if($option == "account"){?>
			<form name="inboxmail_form" id="inboxmail_form" method="post" >
				<div class="frame95per pa1 ui-corner-top-gift overflow BgImgGrayBottom">
					<div class="frame10per ma0100" style="padding:0.6ex 0">
						<input type="checkbox" name="select_allmails" value="1"> Select All
					</div>
					<input onClick=v_email_delete_bulk() type="button" value="Delete" class="ma0100">
					<!--<select class="ma0100" style="width:30%;">
						<option>Group1</option>
						<option>Group2</option>
						<option>Group2</option>
						<option>Group2</option>
					</select>
					<input type="button" value="Move to" class="ma0100">-->
				</div>
				<div class="frame100per" id="mail_list">
					<table cellpadding="4" cellspacing="0" border="0" class="mail_table frame100per ma0">
						<thead>
							<tr>
								<th width="10%" class="TextAlignLeft ui-state-default pa1x">Select</th>
								<th width="20%" class="TextAlignLeft ui-state-default pa1x">Sender<span class="css_right ui-icon ui-icon-carat-2-n-s FloatRight"></span></th>
								<th width="55%" class="TextAlignLeft ui-state-default pa1x">Content<span class="css_right ui-icon ui-icon-carat-2-n-s FloatRight"></span></th>
								<th width="15%" class="TextAlignLeft ui-state-default pa1x">Date<span class="css_right ui-icon ui-icon-carat-2-n-s FloatRight"></span></th>
							</tr>
						</thead>
						<tbody style="font-size:0.9em">
							<?if(isset($mails)){?>
								<?foreach($mails as $mail){?>
									<tr>
										<td class="pa01x">
											<input type="checkbox" class="input_checkbox_mails" name="deletemail[]" value="<? echo $mail->id?>"/>
											<?if($mail->state == 0){?>
												<img src="<?=base_url()?>images/elements/icons/mail-close.png" title="Received">
											<?}else{?>
												<img src="<?=base_url()?>images/elements/icons/mail-open.png"  title="Readed">
											<?}?>
											
											<?if($mail->type == 1){?>
												<img src="<?=base_url()?>images/elements/icons/mail-public.png" title="Public">
											<?}?>
										</td>
										<td class="Blue" onClick=v_email_edit('<?=$mail->id?>') style="cursor: pointer;	cursor: hand;">
											<?if(isset($mail->avatar)){?>
												<img src="<?=base_url().$mail->avatar?>" width="20px">
											<?}else{?>
												<img src="<?=base_url()?>images/no_picture.jpg" width="20px">
											<?}?>
											
											<?if($mail->state == 0) echo "<b>";?>
												<?=$mail->firstname." ".$mail->lastname?>
											<?if($mail->state == 0) echo "</b>";?>
										</td>
										<td onClick=v_email_edit('<?=$mail->id?>') style="cursor: pointer;	cursor: hand;">
											<?if($mail->state == 0) echo "<b>";?>
												<span class="Blue"><?=$mail->title?></span>
											<?if($mail->state == 0) echo "</b>";?>
											<br>
											<?if($mail->state == 0) echo "<span class='Black'>"; else echo "<span class='Gray1'>";?>
												<?if((strlen($mail->content)>0)&&strlen($mail->content)>70){
													echo substr($mail->content,0,70)."...";
												}elseif((strlen($mail->content)>0)&&strlen($mail->content)<70){
													echo substr($mail->content,0,70);
												}?>
											</span>
										</td>
										<td onClick=v_email_edit('<?=$mail->id?>') style="cursor: pointer;	cursor: hand;">
											<?if($mail->state == 0) echo "<span class='Black'>"; else echo "<span class='Gray1'>";?>
												<?=date_format(date_create($mail->ini_date), "M d, H:i")?>
											</span>
										</td>
									</tr>
								<?}?>
							<?}?>
						</tbody>
					</table>
				</div>
			
			</form>
			<?}?>
			
			<!--END MAIL-->

			<!--SENT MAIL-->
			
			<?if($option == "sentmail"){?>
			

				<div class="frame95per pa1 ui-corner-top-gift overflow BgImgGrayBottom">
					<div class="frame10per ma0100" style="padding:0.6ex 0">
						<input type="checkbox" name="select_allmails" value="1"> Select All
					</div>
					<input type="button" value="Delete" class="ma0100">
					<!--<select class="ma0100" style="width:30%;">
						<option>Group1</option>
						<option>Group2</option>
						<option>Group2</option>
						<option>Group2</option>
					</select>
					<input type="button" value="Move to" class="ma0100">-->
				</div>
				<div class="frame100per" id="mail_list">
					<table cellpadding="4" cellspacing="0" border="0" class="mail_table frame100per ma0">
						<thead>
							<tr>
								<th width="10%" class="TextAlignLeft ui-state-default pa1x">Select</th>
								<th width="20%" class="TextAlignLeft ui-state-default pa1x">To<span class="css_right ui-icon ui-icon-carat-2-n-s FloatRight"></span></th>
								<th width="55%" class="TextAlignLeft ui-state-default pa1x">Content<span class="css_right ui-icon ui-icon-carat-2-n-s FloatRight"></span></th>
								<th width="15%" class="TextAlignLeft ui-state-default pa1x">Date<span class="css_right ui-icon ui-icon-carat-2-n-s FloatRight"></span></th>
							</tr>
						</thead>
						<tbody style="font-size:0.9em">
							<?if(isset($mails)){?>
								<?foreach($mails as $mail){?>
									<tr onClick=v_email_edit('<?=$mail->id?>') style="cursor: pointer;	cursor: hand;">
										<td class="pa01x">
											<input type="checkbox" name="selectmail[]" />
											<?/*if($mail->state == 0){?>
												<img src="<?=base_url()?>images/elements/icons/mail-close.png" title="Received">
											<?}else{?>
												<img src="<?=base_url()?>images/elements/icons/mail-open.png"  title="Readed">
											<?}?>
											
											<?if($mail->type == 1){?>
												<img src="<?=base_url()?>images/elements/icons/mail-public.png" title="Public">
											<?}*/?>
										</td>
										<td class="Blue">
											<?if(isset($mail->avatar)){?>
												<img src="<?=base_url().$mail->avatar?>" width="20px">
											<?}else{?>
												<img src="<?=base_url()?>images/no_picture.jpg" width="20px">
											<?}?>
											
											<?if($mail->state == 0) echo "<b>";?>
												<?=$mail->firstname." ".$mail->lastname?>
											<?if($mail->state == 0) echo "</b>";?>
										</td>
										<td>
											<?if($mail->state == 0) echo "<b>";?>
												<span class="Blue"><?=$mail->title?></span>
											<?if($mail->state == 0) echo "</b>";?>
											<br>
											<?if($mail->state == 0) echo "<span class='Black'>"; else echo "<span class='Gray1'>";?>
												<?if((strlen($mail->content)>0)&&strlen($mail->content)>70){
													echo substr($mail->content,0,70)."...";
												}elseif((strlen($mail->content)>0)&&strlen($mail->content)<70){
													echo substr($mail->content,0,70);
												}?>
											</span>
										</td>
										<td>
											<?if($mail->state == 0) echo "<span class='Black'>"; else echo "<span class='Gray1'>";?>
												<?=date_format(date_create($mail->ini_date), "M d, H:i")?>
											</span>
										</td>
									</tr>
								<?}?>
							<?}?>
						</tbody>
					</table>
				</div>
			
			
			<?}?>
			
			<!--END MAIL-->
			
			
			<!--COMPOSE-->

				<?if($option == "compose"){?>
			
				<div class="frame80per" id="mail_lis">
					<div class="Border2px pa1 ui-corner-all-gift overflow BgImgGrayBottom">
					<form name="sendmail_form" id="sendmail_form" method="post" <?/*action="<?= base_url()?>flights/add"*/?>>
						<div class="frame100per">
							<div class="fila">
								<div class="col" style="width:10px"></div>
								<div class="col frame15per Blue Bold">Send Option:</div>
								<div class="col frame40per">
									<select id="compose_option" name="compose[option]" style="width:100%;" onChange="settingSubject(this.value)">
										<option value="0" selected='selected'>Send To</option>
										<option value="1">Send to My Friends</option>
										<!--<option value="2">Send to My Matches</option>-->
										<option value="3">Send to Public(all Members)</option>
									</select>
								</div>
								<div class="col frame40per pa1001">
									<input name="compose[sendemail]" type="checkbox" name="select_senttomails" value="1"> Also send to emails
								</div>
							</div>
							<div class="fila" id="div_compose_to" style="display:block;">
								<div class="col" style="width:10px"></div>
								<div class="col frame15per Blue Bold">To:</div>
								<div class="col frame80per">
									<input id="input-users" name="compose[to]" type="text" style="width:100%" validate="required:true">
								</div>
							</div>
							<div class="fila">
								<div class="col" style="width:10px"></div>
								<div class="col frame15per Blue Bold">Subject:</div>
								<div class="col frame80per">
									<input name="compose[subject]" type="text" style="width:100%" validate="required:true" value="<?php if(isset($mail)) echo $mail['title'] ?>">
								</div>
							</div>
						</div>
						<div class="frame100per ma1000">
							<div>
								<textarea name="compose[content]" class="frame100per" style="height:200px" validate="required:true"><?php if(isset($mail)) echo $mail['content'] ?></textarea>
							</div>
							<div class="overflow pa10 frame100per">
								<div class="frame100per alignRight">
									<!--<input type="button" value="Delete"/>-->
									<input onclick="mail_save()" type="button" value="Send" class="ma01"/>
								</div>
							</div>
						</div>
					</form>
					</div>
				</div>
			
				<?}?>
				
			<!--END COMPOSE-->
			
			<!--READER-->

				<?if($option == "reader"){?>
			
				<div class="frame80per" id="mail_lis">
					<div class="Border2px pa1 ui-corner-all-gift overflow BgImgGrayBottom">
					<!--<form name="sendmail_form" id="sendmail_form" method="post" >-->
						<div class="frame100per">
							<div class="fila" id="div_compose_to" style="display:block;">
								<div class="col" style="width:10px"></div>
								<div class="col frame15per Blue Bold">Sender:</div>
								<div class="col frame80per">
									<?php if(isset($profile)) echo $profile->firstname." ".$profile->lastname ?>
								</div>
							</div>
							<div class="fila">
								<div class="col" style="width:10px"></div>
								<div class="col frame15per Blue Bold">Subject:</div>
								<div class="col frame80per">
									<h6><?php if(isset($mail)) echo $mail->title ?></h6>
								</div>
							</div>
						</div>
						<div class="frame100per ma1000">
							<div class="fila">
								<?php if(isset($mail)) echo $mail->content ?>
							</div>
							<div class="overflow pa10 frame100per">
								<div class="frame100per alignRight">
									<input  onclick="v_email_delete('<?php if(isset($mail)) echo $mail->id; else echo '-1'; ?>')" type="button" value="Delete"/>
									<input onclick="v_email_close()" type="button" value="Close" class="ma01"/>
								</div>
							</div>
						</div>
					<!--</form>-->
					</div>
				</div>
			
				<?}?>
				
			<!--END READER-->
			
			
			<!-- ANSWER-->
						<?if($option == "answer"){?>

				<div class="frame100per" id="mail ma1000">
					<div class="Border2px pa1 ui-corner-all-gift overflow BgImgGrayBottom">
							<div class="frame100per ">
								<div class="frame80per">
									<p><b>name, event</b> usernmae@flysocial.com</p>
									<p class="Gray1">Oct 27, 12:50 p.m.</p>
								</div>
								<div class="frame20per">
									<a href=""><div class="Border2px pa10x ui-corner-top-gift frame45per TextAlignCenter overflow BgImgGrayBottom">
									<img src="<?=base_url()?>images/elements/icons/trash.gif">Delete</div></a>
									<a href=""><div class="FloatRight Border2px pa10x ui-corner-top-gift TextAlignCenter frame45per overflow BgImgGrayBottom">
										<img src="<?=base_url()?>images/elements/icons/respond.png">Replay</div></a>
								</div>
							</div>
							<textarea class="frame100per" style="height:400px">text of test</textarea>

							
						<?}?>
							
							
					</div>
				</div>
			</div>
			
			
			
		</div>
	</div>
</div>

<!--DIALOG CONFIRMATION!-->
<div id="dialog_confirm_mail" title="<?= lang('dialog.confirmation');?>" style="display:none;">
	<p>
		<span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
		<?= lang('dialog.msgofdelete');?>
	</p>
</div>

<script type="text/javascript">
function setHeight_events() {
//    var mydiv = document.getElementById("contentright_addflights");
    var mydiv = document.getElementById("contentright_mail");
    var setdiv = document.getElementById("panel_mail");
	
    var curr_height = parseInt(mydiv.style.height);
/*alert(curr_height);
alert(mydiv.style.height);
*/
    setdiv.style.height = curr_height +"px";
}
	
$(document).ready(function(){
		
	$( "input:submit").button();
	$( "input:button").button();
	
	var icons = {
		header: "ui-icon-circle-arrow-e",
		headerSelected: "ui-icon-circle-arrow-s"
	};
	<? if($option == "account"||$option == "compose" ||$option == "answer" ||$option == "reader"){?>
		var optionmenu = 0;
	<?} if($option == "events"){?>
		var optionmenu = 2	;
	<?} if($option == "flights"){?>
		var optionmenu = 3	;
	<?} if($option == "sentmail"){?>
		var optionmenu = 4	;
	<?}?>
	$( "#accordion_menu_mail" ).accordion({
		icons: icons,
		active: optionmenu
	}); 
	
	$.metadata.setType("attr", "validate");
	$("#sendmail_form").validate();

	$('.mail_table').styleTable({
		tr_hover_bgcolor: '#BCD4EC'
	});

//	setHeight_events();

	$("#input-users").tokenInput("<?=base_url()?>member/mail/ajaxlistFriend", {
		theme: "facebook"
	});
	
	<?if($option == "compose"){?>
		settingSubject(document.getElementById("compose_option").value);
	<?}?>

    $('.input_checkbox_mails').click(function(e) {
//		var option = $(this).val();
		var option = $(this);
		if(option.is(':checked')) {
//      alert("aqui");
			//$('#using_pregenerated_keys_checkbox').attr('checked', false);
			option.attr('value', '1');
		} else {
//      alert("aqui NO");
			option.attr('value', '0');
		}
    });
});

	function mail_save()
	{
		$('#sendmail_form').submit();
	}

	$('#sendmail_form').submit(function() 
	{
		if(!$('#sendmail_form').valid())
		{
			return false;
		}
		
		$.ajax({
			type: "post",
			url: "<?=base_url()?>member/mail/ajaxsave" ,
			dataType: "json",
			data: $('#sendmail_form').serialize(),
			async: false,
			success: function(data) {
				if(data.success)
				{
					$().toastmessage('showToast', {
						text     : 'SENT',
						no_sticky : true,
						position : 'middle-center',
						type     : 'success',
						closeText: ''
					});
					window.location = "/member/mail";
				}				
			}
		}); 
		return false;
		
	});


function v_email_edit(id)
{
	if(id < 0){
		window.location = "<?=base_url()?>member/mail/compose";
	}else{
		window.location = "<?=base_url()?>member/mail/inbox/"+id;
	}
}

//DELETE
function v_email_delete(id)
{
	if(id > 0)
	{
		$( "#dialog_confirm_mail" ).dialog( "destroy" );

		$( "#dialog_confirm_mail" ).dialog({
			resizable: false,
			height:180,
			modal: true,
			buttons: {
				"<?= lang('dialog.delete');?>": function() {
					$( this ).dialog( "close" );

					$.ajax({
						type: "post",
						url: "<?=base_url()?>member/mail/ajaxdelete" ,
						dataType: "json",
						data: { id: id, rnd: new Date().getTime() },
						success: function(data) {
							$().toastmessage('showToast', {
								text     : '<?= lang('dialog.deleted');?>',
								no_sticky   : true,
								position : 'middle-center',
								type     : 'success',
								closeText: ''
							});
							window.location = "<?=base_url()?>member/mail";
							//oAdminTableAds.fnDraw();
						}
					});

				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
	}
};

//DELETE BULK
function v_email_delete_bulk()
{
		$( "#dialog_confirm_mail" ).dialog( "destroy" );

		$( "#dialog_confirm_mail" ).dialog({
			resizable: false,
			height:180,
			modal: true,
			buttons: {
				"<?= lang('dialog.delete');?>": function() {
					$( this ).dialog( "close" );

					$.ajax({
						type: "post",
						url: "<?=base_url()?>member/mail/ajaxdeletebulk" ,
						dataType: "json",
						data: $('#inboxmail_form').serialize(),
						async: false,
						success: function(data) {
							$().toastmessage('showToast', {
								text     : '<?= lang('dialog.deleted');?>',
								no_sticky   : true,
								position : 'middle-center',
								type     : 'success',
								closeText: ''
							});
							window.location = "<?=base_url()?>member/mail";
							//oAdminTableAds.fnDraw();
						}
					});

				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
};

function v_email_close()
{
	window.location = "<?= base_url()?>member/mail";
	//history.go(-1);
};

function settingSubject(value)
{
	if(value == 0)
	{
		$("#div_compose_to").show("fast");
		document.getElementById("input-users").value = '';
	}else{
		$("#div_compose_to").hide("fast");
		document.getElementById("input-users").value = '0';
	}
};

</script>

