<div id="contentprofile" class="frame100per">
	<div id="contentright_profile" class="frame100per">
		<div class="ma1000 pa2022 Border3330 ui-corner-right-gift overflow BgCelestial BgTransp90per font13px18px shadow" style="z-index:1;" >
			<div id="RightContentProfile">


				<div class="frame100per" id="profile_stranger">
					<?if($own){?>
					<div class="frame95per">
						<a href="<?=base_url()?>member/dashboard/settings" class="FloatRight">Settings</a>
					</div>
					<?}?>
					<div class="frame60per" id="LeftContentStranger">

							<div class="frame100per">
								<div class="frame20per alignRight pa1000">
									<?if(isset($profile->avatar)){?>
										<img src="<?=base_url().$profile->avatar?>" width="80%">
									<? }else{?>
										<img src="<?=base_url()?>images/no_picture.jpg" width="80%">
									<? }?>

								</div>
								<div class="frame80per FloatRight">
									<div class="pa1001">
										<h2 class="Black"><?=$profile->firstname?> <?=$profile->lastname?></h2>
										<p class="Gray1 pa1000" style="font-size:1.2em">Last Checked in at <a href="#"><?= $checkin->airport?></a></p>
										<div class="pa10">
											<a href="#" class="ma0100"><img title="facebook" src="<?=base_url()?>images/elements/icons/facebook.png"></a>
											<a href="#" class="ma0100"><img title="twitter" src="<?=base_url()?>images/elements/icons/twitter.png"></a>
											<a href="#" class="ma0100"><img title="linkedin" src="<?=base_url()?>images/elements/icons/foursquare.png"></a>
											<a href="#" class="ma0100"><img title="foursquare" src="<?=base_url()?>images/elements/icons/linkedin.png"></a>
										</div>
									</div>
								</div>
							</div>
							<div class="frame100per" style="font-size:1.2em">
								<div class="fila">
									<div class="colsingle frame20per TextAlignRight Black Bold">Age:</div>
									<div class="colsingle frame75per TextAlignLeft Celestial pa0001"><?=$age?></div>
								</div>
								<div class="fila">
									<div class="colsingle frame20per TextAlignRight Black Bold">Sex:</div>
									<div class="colsingle frame75per TextAlignLeft Celestial pa0001"><?=$profile->gender?></div>
								</div>
								<div class="fila">
									<div class="colsingle frame20per TextAlignRight Black Bold">I'm from:</div>
									<div class="colsingle frame75per TextAlignLeft Celestial pa0001"><?=$country->fullname?></div>
								</div>
								<div class="fila">
									<div class="colsingle frame20per TextAlignRight Black Bold">Status:</div>
									<div class="colsingle frame75per TextAlignLeft Celestial pa0001"><?=$profile->status?></div>
								</div>
								<div class="fila">
									<div class="colsingle frame20per TextAlignRight Black Bold">Ocupation:</div>
									<div class="colsingle frame75per TextAlignLeft Celestial pa0001"><?=$profile->occupation?></div>
								</div>
								<div class="fila">
									<div class="colsingle frame20per TextAlignRight Black Bold">Bio:</div>
									<div class="colsingle frame75per TextAlignLeft Celestial pa0001"><?=$profile->bio?></div>
								</div>
							</div>
							<div class="frame100per pa10">
								<div class="pa10">
									<p style="font-size:1.5em" class="Celestial"><b>Check-in's</b></p>
								</div>
								<div class="frame100per" style="font-size:1.2em">
									<h6 class="TextAlignLeft ui-state-default pa1x">Recently</h6>
									<table cellpadding="4" cellspacing="0" border="0" class="display" id="check_table">
										<thead>
											<tr>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td><p class="pa1000">Peth International Airport T3</p><p class="Italic Gray1 pa0010" style="font-size:0.8em">Sun Oct 8 2001 6:20 PM</p></td>
											</tr>
											<tr>
												<td><p class="pa1000">Peth International Airport T3</p><p class="Italic Gray1 pa0010" style="font-size:0.8em">Sun Oct 8 2001 6:20 PM</p></td>
											</tr>
											<tr>
												<td><p class="pa1000">Peth International Airport T3</p><p class="Italic Gray1 pa0010" style="font-size:0.8em">Sun Oct 8 2001 6:20 PM</p></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>

					</div>
					<div class="frame40per" id="RightContentStranger">
						<div class="frame90per pa0001">
							<?if(! $own){?>
							<a href="#">
								<div class="BgImgGrayBottom Border2px ui-corner-all-gift ma10 pa10 TextAlignCenter">
									<h5>Add as Friends</h5>
								</div>
							</a>
							<?}else{ ?>
							<a href="<?=base_url()?>member/dashboard/findfriends">
								<div class="BgImgGrayBottom Border2px ui-corner-all-gift ma10 pa10 TextAlignCenter">
									<h5>Find Friends</h5>
								</div>
							</a>
							<?}?>
							<div class="Border2px ui-corner-all-gift BgImgGrayBottom TextAlignCenter ma10 frame100per">
								<div class="widget-header-panel ui-corner-top-gift overflow ma0010">
									<b class="FloatLeft ui-dialog-title">Badges </b>
									<?if(!empty($badgeearned)){?>
										<a href="<?=base_url()?>member/dashboard/badges<?if(!$own) echo("/".$uid);?>" class="FloatRight pa01">
											See all
										</a>
									<?}?>
								</div>
									<?php 
										$con = 0;
										if(!empty($badgeearned)) 
											foreach($badgeearned as $badge)
											{
												$con++;
												if($con > 9) break;?>

												<div class="frame3columns ma0010">
													<img src="<?=base_url().$badge->filename?>" width="70%"><br/>
														<?=$badge->name?>
												</div>
									<?php }?>
									<div id="dialog_error_airpodts" class="TextAlignLeft frame90per pa01" <?if(!empty($badgeearned)) echo"style='display:none'";?>>
										<p>
											<span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
											You don't have badges
										</p>
									</div>

							</div>
							<div class="Border2px ui-corner-all-gift ma0010 BgImgGrayBottom TextAlignCenter frame100per">
								<div class=" widget-header-panel ui-corner-top-gift overflow">
									<b class="FloatLeft ui-dialog-title">
										Attending Events
									</b>
									<?if($own){?>
										<a href="<?=base_url()?>member/events" class="FloatRight pa01">
											See all
										</a>
									<?}?>
								</div>
								<?if(!empty($events)){?>
								<div class="frame100per pa0010">
									<table cellpadding="4" cellspacing="0" border="0" class="display pa1" id="attending_table">
										<thead>
											<tr>
												<th width="7%"></th>
												<th width="63%"></th>
												<th width="30%"></th>
											</tr>
										</thead>
										<tbody style="font-size:0.7em">
										<?php 
											$con = 0;
												foreach($events as $event){
													$con++;
													if($con > 3) break;?>

											<tr>
												<td  class="alignRight">
													<img  src="<?=base_url().$event->image?>" width="50px">
												</td>
												<td class="TextAlignLeft alignTop">
													<?=$event->name?>
												</td>
												<td class="italic Gray1 alignTop">
													<?=date_format(date_create($event->date_ini), "M d, H:i")?>
												</td>
											</tr>
										<?php }?>
										</tbody>
									</table>
								</div>
								<?}?>
								<div id="dialog_error_events" class="TextAlignLeft frame90per pa1101" <?if(!empty($events)) echo"style='display:none'";?>>
								<p>
									<span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
										You have not yet registered events
								</p>
								</div>
							</div>
							<div class="Border2px ui-corner-all-gift BgImgGrayBottom TextAlignCenter frame100per">
								<div class=" widget-header-panel ui-corner-top-gift overflow ma0010">
									<b class="FloatLeft ui-dialog-title">
										Friends(<?=$count /*count($friends)*/?>)
									</b>
									<?if(!empty($friends)){?>
										<a href="<?=base_url()?>member/dashboard/myfriends<?if(!$own) echo("/".$uid);?>" class="FloatRight pa01">
											See all
										</a>
									<?}?>
								</div>
								<?php $con = 0;
									if($count != "0"){//if(!empty($friends))
										foreach($friends as $friend)
										{
											$con++;
											if($con > 4) break;?>
											<div class="frame4columns pa0010">
												<? if((isset($friend->avatar))&&(! empty($friend->avatar))){?>
													<img src="<?=base_url().$friend->avatar?>" width="70%">
												<? }else{?>
													<img src="<?=base_url()?>images/no_picture.jpg" width="70%">
												<? }?>
												</div>
											<?}?>
									<?}?>
									<div id="dialog_error_friends" class="TextAlignLeft frame90per pa01" <?if(!empty($friends) && $count > 0) echo"style='display:none'";?>>
										<p>
											<span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
											You have not yet registered friends
										</p>
									</div>
								
							</div>
						</div>
					</div>
				</div>

				
			</div>

		</div>
	</div>

</div>

<script type="text/javascript">

/*function setHeight() {
//    var mydiv = document.getElementById("contentright_addflights");
    var mydiv = document.getElementById("contentrightmatches");
    var setdiv = document.getElementById("panel_myflights");
	
    var curr_height = parseInt(mydiv.style.height);
/*alert(curr_height);
alert(mydiv.style.height);
*/
/*    setdiv.style.height = curr_height +"px";
}
	*/
$(document).ready(function(){
		
	$( "input:submit").button();
	$( "input:button").button();

/*	$('#tabs_myflights').tabs();
	$('#tabs_matches').tabs();
*/
		var icons = {
			header: "ui-icon-circle-arrow-e",
			headerSelected: "ui-icon-circle-arrow-s"
		};
		$( "#accordion_menu_member" ).accordion({
			icons: icons
		});
		$( "#accordion_menu_share_find" ).accordion({
			icons: icons
		});
/*		$( "#toggle" ).button().toggle(function() {
			$( "#accordion_menu_member" ).accordion( "option", "icons", false );
		}, function() {
			$( "#accordion_menu_member" ).accordion( "option", "icons", icons );
		});*/


	$.metadata.setType("attr", "validate");
	$("#signupsmalluser_form").validate();

	$('#check_table').styleTable({
		tr_hover_bgcolor: '#BCD4EC'
	});

	$('#attending_table').styleTable({
		tr_hover_bgcolor: '#BCD4EC',
	});

    ofrontTableMyFlights = $('#myflights_table').dataTable({
        'bServerSide'    : true,
        'bAutoWidth'     : false,
		"bJQueryUI": true,
        'sPaginationType': 'full_numbers',
        'sAjaxSource': '<?=base_url()?>flights/listener',
        'aoColumns' : [
            { 'sName': 'v_myflights.date_out'},
            { 'sName': 'v_myflights.code'},
            { 'sName': 'v_myflights.coutname'},
            { 'sName': 'v_myflights.cinname'},
            { 'sName': 'v_myflights.matches'},
            { 'sName': 'v_myflights.id',"bSortable": false, 'bSearchable': false }
        ],
        'fnServerData': function(sSource, aoData, fnCallback){
            $.ajax({
                'dataType': 'json',
                'type': 'POST',
                'url': sSource,
                'data': aoData,
                'success': fnCallback
            });
        },
		"oLanguage": {
			"sProcessing": "<?= lang('datatable.Processing');?>",
			"sLengthMenu": "<?= lang('datatable.LengthMenu');?>",
			"sSearch": "<?= lang('datatable.Search');?>",
			"sZeroRecords": "<?= lang('datatable.ZeroRecords');?>",
			"sEmptyTable": "<?= lang('datatable.EmptyTable');?>",
			"sInfo": "<?= lang('datatable.Info');?>",
			"sInfoEmpty": "<?= lang('datatable.InfoEmpty');?>",
			"sInfoFiltered": "<?= lang('datatable.InfoFiltered');?>",
			"oPaginate": {
				"sFirst":    "<?= lang('datatable.First');?>",
				"sPrevious": "<?= lang('datatable.Previous');?>",
				"sNext":     "<?= lang('datatable.Next');?>",
				"sLast":     "<?= lang('datatable.Last');?>"
			}
		},
		"aoColumnDefs": [ 
			{ "sClass": "TextAlignLeft", "aTargets": [ 0,1,2,3 ] },
			{ "sClass": "TextAlignRight", "aTargets": [ 4 ] }
		]
    });
	$('#myflights_table').styleTable({
		tr_hover_bgcolor: '#BCD4EC'
	});

	$("#btn_addflight").live("click", function () {
			$("#contentrightmatches").hide('fast');
			$("#contentright_addflights").show('fast');
	});
	$("#lk_closeAddFlight").live("click", function () {
//			$("#contentright_addflights").hide('slow');
			$("#contentright_addflights").hide('fast');
	});
	$("#lk_closeMatches").live("click", function () {
//			$("#contentright_addflights").hide('slow');
			$("#contentrightmatches").hide('fast');
	});

	//setHeight();
});

	function saveformpages()
	{
		$('#signupsmalluser_form').submit();
	}

	$('#signupsmalluser_form').submit(function() 
	{
		if(!$('#signupsmalluser_form').valid())
		{
			return false;
		}
		
/*		$.ajax({
			type: "post",
			url: "<?=base_url()?>user/register" ,
			dataType: "json",
			data: $('#signupsmalluser_form').serialize(),
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
