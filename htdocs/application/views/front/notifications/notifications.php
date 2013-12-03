<div id="contentnotifications" class="frame100per">
	<div id="contentleft_notifications" class="frame60per">
		<div id="panel_notifications" class="pa1 Border3px ui-corner-all-gift overflow degrade BgTransp90per shadow" style="height:600px;z-index:20;">
			<div class="frame100per pa2000" >
				<div class="frame70per" >
					<h2 class="Celestial pa0010">Your Recent Notification</h2>
				</div>
				<div class="frame30per" >

				</div>
			</div>
			<div id="leftside" class="frame100per">
				<h3 class="Celestial pa0010">Older</h3>
			<!-- CONTENT-->
							<table cellpadding="4" cellspacing="0" border="0" class="display" id="notifications_table">
								<thead>
									<tr>
										<th style="width: 20%"><b></b></th>
										<th style="width: 80%"><b></b></th>
									</tr>
								</thead>
								<tbody>
									<?if(isset($notifications)){?>
										<?foreach ($notifications as $notification){?>
										<tr>
											<td class="TextAlignCenter">
											<a name = "seccion_notification_<?=$notification['id']?>"></a>
											<?if(isset($notification['avatar'])){?>
												<img src="<?=base_url().$notification['avatar']?>" width="60px">
											<? }else{?>
												<img src="<?=base_url()?>images/no_picture.jpg" width="60px">
											<? }?>
											</td>
											<td class="TextAlignLeft">
												<p>
													<span class="Celestial"><?=$notification['name']?> </span><b><?=$notification['firstnamefrom']?> <?=$notification['lastnamefrom']?></b> <?=$notification['message']?>.
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
													You do not have notifications.
												</p>
											</td>
										</tr>
									<?}?>
								</tbody>
							</table>
		
			<!-- END CONTENT-->
			</div>
		</div>		
	</div>
<!--Matches-->	
	<div id="contentrightnotifications" class="frame40per" style="height:950px">
		<div class="ma1000 pa2022 Border3330 ui-corner-right-gift overflow BgCelestial font13px18px shadow" style="z-index:2;height:900px" >
			<div id="RightContentMatchesView">
				<div id="FormMatches" class="formsignup">



				</div>

			</div>

		</div>
	</div>
<!--Matches-->

</div>

<script type="text/javascript">

function setHeight() {
//    var mydiv = document.getElementById("contentright_addflights");
    var mydiv = document.getElementById("contentrightnotifications");
    var setdiv = document.getElementById("panel_notifications");
	
    var curr_height = parseInt(mydiv.style.height);
/*alert(curr_height);
alert(mydiv.style.height);
*/
    setdiv.style.height = curr_height +"px";
}
	
$(document).ready(function(){
		
	$( "input:submit").button();
	$( "input:button").button();

/*	$.metadata.setType("attr", "validate");
	$("#signupsmalluser_form").validate();
*/
	$('#notifications_table').styleTable({
		tr_hover_bgcolor: '#BCD4EC'
	});

	setHeight();
});
	
</script>
