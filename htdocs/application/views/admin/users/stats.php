<style>
.fg-toolbar{
	height:20px;
}
#userstats_table_filter{
	display:none;
}
#userstats_table_length{
	display:none;
}
</style>
<div class="fila" align="center">
	<div class="col" style="width:48%">
		<fieldset class="ui-corner-all">
			<legend class="ui-corner-all"><b><?=lang('users.tab.dialog.legend.avatar');?></b></legend>
			<div class="fila">
				<div class="col" style="width:auto; text-align: center;">
					<div id="imgContentsUserAdmin">
						<?php if(isset($profile->avatar)){?>
						<img src="<?= $profile->avatar?>" border="1" />
						<?}else{?>
						<img src="<?= base_url()?>images/no-image.jpg" border="1" />
						<?}?>
						<br />
					</div>
				</div>
			</div>
		</fieldset>
		<fieldset class="ui-corner-all">
			<legend class="ui-corner-all"><b><?=lang('users.stats.dialog.legend');?></b></legend>
			<div class="frame100per">
				<table cellpadding="4" cellspacing="0" border="0" class="display" id="userstats_table">
					<thead>
						<tr>
							<th width="10%"><b>No.</b></th>
							<th width="50%"><b><?= lang('users.stats.dialog.item');?></b></th>
							<th width="40%"><b><?= lang('users.stats.dialog.value');?></b></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td align="left">1</td>
							<td align="left"><?= lang('users.stats.dialog.profile_views');?></td>
							<td align="right"><?= $user_stats['profile_views']?></td>
						</tr>
						<tr>
							<td align="left">2</td>
							<td align="left"><?= lang('users.stats.dialog.total_friends');?></td>
							<td align="right"><?= $user_stats['total_friends']?></td>
						</tr>
						<tr>
							<td align="left">3</td>
							<td align="left"><?= lang('users.stats.dialog.last_update');?></td>
							<td align="right"><?= $user_stats['last_update']?></td>
						</tr>
						<tr>
							<td align="left">4</td>
							<td align="left"><?= lang('users.stats.dialog.joined');?></td>
							<td align="right"><?= $user_stats['joined']?></td>
						</tr>
						<tr>
							<td align="left">5</td>
							<td align="left"><?= lang('users.stats.dialog.joined_ip');?></td>
							<td align="right"><?= $user_stats['joined_ip']?></td>
						</tr>
						<tr>
							<td align="left">6</td>
							<td align="left"><?= lang('users.stats.dialog.last_login');?></td>
							<td align="right"><?= $user_stats['last_login']?></td>
						</tr>
						<tr>
							<td align="left">7</td>
							<td align="left"><?= lang('users.stats.dialog.last_login_ip');?></td>
							<td align="right"><?= $user_stats['last_login_ip']?></td>
						</tr>
						<tr>
							<td align="left">8</td>
							<td align="left"><?= lang('users.stats.dialog.total_flights');?></td>
							<td align="right"><?= $user_stats['total_flights']?></td>
						</tr>
						<tr>
							<td align="left">9</td>
							<td align="left"><?= lang('users.stats.dialog.current_flights');?></td>
							<td align="right"><?= $user_stats['current_flights']?></td>
						</tr>
						<tr>
							<td align="left">10</td>
							<td align="left"><?= lang('users.stats.dialog.social_networks');?></td>
							<td align="right"><?= $user_stats['social_networks']?></td>
						</tr>
						<tr>
							<td align="left">11</td>
							<td align="left"><?= lang('users.stats.dialog.joined_events');?></td>
							<td align="right"><?= $user_stats['joined_events']?></td>
						</tr>
						<tr>
							<td align="left">12</td>
							<td align="left"><?= lang('users.stats.dialog.total_checkins');?></td>
							<td align="right"><?= $user_stats['total_checkins']?></td>
						</tr>
						<tr>
							<td align="left">13</td>
							<td align="left"><?= lang('users.stats.dialog.total_badges');?></td>
							<td align="right"><?= $user_stats['total_badges']?></td>
						</tr>
						<tr>
							<td align="left">14</td>
							<td align="left"><?= lang('users.stats.dialog.total_miles');?></td>
							<td align="right"><?= $user_stats['total_miles']?></td>
						</tr>
						<tr>
							<td align="left">15</td>
							<td align="left"><?= lang('users.stats.dialog.total_pm');?></td>
							<td align="right"><?= $user_stats['total_pm']?></td>
						</tr>
						<tr>
							<td align="left">16</td>
							<td align="left"><?= lang('users.stats.dialog.total_wall_posts');?></td>
							<td align="right"><?= $user_stats['total_wall_posts']?></td>
						</tr>
						<tr>
							<td align="left">17</td>
							<td align="left"><?= lang('users.stats.dialog.total_event_posts');?></td>
							<td align="right"><?= $user_stats['total_event_posts']?></td>
						</tr>
						<tr>
							<td align="left">18</td>
							<td align="left"><?= lang('users.stats.dialog.total_tickets');?></td>
							<td align="right"><?= $user_stats['total_tickets']?></td>
						</tr>
						<tr>
							<td align="left">19</td>
							<td align="left"><?= lang('users.stats.dialog.total_hotel_bookings');?></td>
							<td align="right"><?= $user_stats['total_hotel_bookings']?></td>
						</tr>
						<tr>
							<td align="left">20</td>
							<td align="left"><?= lang('users.stats.dialog.total_car_rentals');?></td>
							<td align="right"><?= $user_stats['total_car_rentals']?></td>
						</tr>
						<?/*
						<tr>
							<td align="left">21</td>
							<td align="left"><?= lang('users.stats.dialog.profile_describes_you');?></td>
							<td align="right"><?= $user_stats['profile_describes_you']?></td>
						</tr>
						*/?>
					</tbody>
					<tfoot>
						<tr>
							<th><b>No.</b></th>
							<th><b><?= lang('users.stats.dialog.item');?></b></th>
							<th><b><?= lang('users.stats.dialog.value');?></b></th>
						</tr>
					</tfoot>
				</table>
			</div>
		</fieldset>
	</div>
	<div class="col" style="width:48%; margin:0px 0px 0px 15px">
		<fieldset class="ui-corner-all">
			<legend class="ui-corner-all"><b><?=lang('users.tab.dialog.legend.social');?></b></legend>
				<?php if(!empty($usersocial) && isset($usersocial[1])) {?>
				<div class="fila">
					<div class="col" style="width:50px">
						<img title="Facebook" src="<?= base_url()?>images/social/FaceBook_48x48.png" />
					</div>
					<div class="col" style="width:250px; margin:20px 10px;" class="textbox" align="left">
					
					</div>
				</div>
				<?}?>
				<?php if(!empty($usersocial) && isset($usersocial[2])) {?>
				<div class="fila">
					<div class="col" style="width:50px">
						<img title="Twitter" src="<?= base_url()?>images/social/Twitter_48x48.png" />
					</div>
					<div class="col" style="width:250px; margin:20px 10px;" class="textbox" align="left">
					
					</div>
				</div>
				<?}?>
				<?php if(!empty($usersocial) && isset($usersocial[3])) {?>
				<div class="fila">
					<div class="col" style="width:50px">
						<img title="LinkedIn" src="<?= base_url()?>images/social/LinkedInBlue_48x48.png" />
					</div>
					<div class="col" style="width:250px; margin:20px 10px;" class="textbox" align="left">
					
					</div>
				</div>
				<?}?>
		</fieldset>
		<fieldset class="ui-corner-all">
			<legend class="ui-corner-all"><b><?=lang('users.tab.dialog.legend.selfdesc');?></b></legend>
				<div class="fila">
					<div class="col" style="width:50px">
						<img title="user" src="<?= base_url()?>images/user/Male-User-Warning48.png" />
					</div>
					<div class="col" style="width:250px; margin:5px 10px;" class="textbox" align="left">
						<h4><b><?=lang('users.tab.dialog.legend.whatbest');?></b></h4>
						<p style="text-align:justify; text-decoration: italic">
						<?= $user_stats['profile_describes_you']?>
						</p>
					</div>
				</div>
		</fieldset>
	</div>
	<div class="Clear"></div>
	
	<div class="fila" align="left">
		<div class="col" style="width:100%; text-align:left;">
			<input onclick="closedialog()" value="<?= lang('users.tab.dialog.close');?>" type="button" />
		</div>
	</div>
</div>

<!--SCRIPTS REC-->

<script type="text/javascript">

	
function closedialog()
{
	$('#dialog_userstats').dialog('close');
}

$(document).ready(function(){
	$("input:button").button();

	$('#userstats_table').styleTable({
		tr_hover_bgcolor: '#BCD4EC'
	});
});

</script>

<script type="text/javascript">
	<?/*$( "#dialog_mailingedit" ).attr( "title", "<?= lang('users.tab.titdialognew');?><?php if(isset($customer)) echo $customer->firstname." ".$customer->lastname ?>");*/?>
</script>