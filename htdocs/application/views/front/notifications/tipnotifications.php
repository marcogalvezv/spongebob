<div id="contenttipnotifications" class="frame95per" >
	<div id="contentleft_tipnotifications" class="frame100per">
		<div id="panel_tipnotifications" class="pa1 Border3px ui-corner-all-gift font13px18px overflow BgImgCelestial shadow" style="font-size:11px">
			<div class="frame100per pa1010" >
				<div class="frame70per" >
					<h5 class="Celestial">Notifications</h5>
				</div>
			</div>
			<div id="leftside" class="frame100per">
			<!-- CONTENT-->
							<table cellpadding="4" cellspacing="0" border="0" class="display" id="tipnotifications_table">
								<thead>
									<tr>
										<th style="width: 13%"><b></b></th>
										<th style="width: 87%"><b></b></th>
									</tr>
								</thead>
								<tbody>
									<?if(isset($notifications)){?>
										<?foreach ($notifications as $notification){?>
										<tr onClick=v_notification_redirect('<?=$notification['id']?>') style="cursor: pointer;	cursor: hand;">
											<td class="TextAlignCenter">
											<?if(isset($notification['avatar'])){?>
												<img src="<?=base_url().$notification['avatar']?>" width="30px">
											<? }else{?>
												<img src="<?=base_url()?>images/no_picture.jpg" width="30px">
											<? }?>
											</td>
											<td class="TextAlignLeft">
												<p>
													<span class="Celestial Bold"><?=$notification['name']?> </span><b><?=$notification['firstnamefrom']?> <?=$notification['lastnamefrom']?></b> <?=$notification['message']?>.
													<br/>
													<span class="Gray"><?=date_format(date_create($notification['created']), "M d, H:i")?></span>
												</p>
											</td>
										</tr>
										<?}?>
									<?}else{?>
										<tr>
											<td class="TextAlignCenter">
											</td>
											<td class="TextAlignLeft">
												<p>
													You do not have recent notifications.
												</p>
											</td>
										</tr>
									<?}?>
								</tbody>
							</table>
		
			<!-- END CONTENT-->
			</div>
			<div id="tiplinks" class="frame100per">
				<h6 class="TextAlignCenter"><a href="<?=base_url()?>member/notifications">See All Notifications</a></h6>
			</div>
		</div>
	</div>

</div>

<script type="text/javascript">
	
$(document).ready(function(){
		
	$( "input:submit").button();
	$( "input:button").button();

/*	$.metadata.setType("attr", "validate");
	$("#signupsmalluser_form").validate();
*/
	$('#tipnotifications_table').styleTable({
		tr_hover_bgcolor: '#BCD4EC'
	});

});
	
function v_notification_redirect(id)
{
	if(id < 0){
		window.location = "<?=base_url()?>member/notifications";
	}else{
		window.location = "<?=base_url()?>member/notifications#seccion_notification_"+id;
	}
}
</script>
