<div class="contentform">

	<div class="form80per" id="statsPanel">
		<div class="frame100per">
			<div id="containerStats" style="width: 800px; height: 400px; margin: 0 auto"></div>

		</div>
	</div>
	<div class="form100per" id="statsDataPanel">

		<form name="admin_stats_form" id="admin_stats_form" method="post">
						<div class="frame100per pa1000">
			<?if(($option==1)||($option==2)){?>
							<div class="frame15per ma1">
								<table cellpadding="4" cellspacing="0" border="0" class="display" id="stats_table" width="90%">
									<thead>
										<tr>
											<th style="width: 15%" class="TextAlignLeft"><b><?= lang('stats.table.stats.date');?></b></th>
											<th style="width: 35%" class="TextAlignRight"><b><?= lang('stats.filter.signups');?></b></th>
										</tr>
									</thead>
									<tbody>
										<?if(isset($adsGraphSingUpsResults)){
											foreach($adsGraphSingUpsResults as $statsResults){?>
										<tr>
											<td class="TextAlignLeft"><?= $statsResults->cdate?></td>
											<td class="TextAlignRight"><?= $statsResults->qty?></td>
										</tr>
											<?}?>
										<?}else{?>
										<tr>
											<td><?= lang('datatable.EmptyTable');?></td>
											<td></td>
										</tr>
										<?}?>
									</tbody>
									<tfoot>
										<tr>
											<th class="TextAlignLeft"><?= lang('stats.table.stats.date');?></th>
											<th class="TextAlignRight"><?= lang('stats.filter.signups');?></th>
										</tr>
									</tfoot>
								</table>
							</div>
			<?}
			if(($option==1)||($option==3)){?>
							<div class="frame15per ma1">
								<table cellpadding="4" cellspacing="0" border="0" class="display" id="signinstats_table" width="90%">
									<thead>
										<tr>
											<th style="width: 15%" class="TextAlignLeft"><b><?= lang('stats.table.stats.date');?></b></th>
											<th style="width: 35%" class="TextAlignRight"><b><?= lang('stats.table.stats.signin');?></b></th>
										</tr>
									</thead>
									<tbody>
										<?if(!empty($adsGraphSingInResults)){
											foreach($adsGraphSingInResults as $signinResults){?>
										<tr>
											<td class="TextAlignLeft"><?= $signinResults->cdate?></td>
											<td class="TextAlignRight"><?= $signinResults->qty?></td>
										</tr>
											<?}?>
										<?}else{?>
										<tr>
											<td><?= lang('datatable.EmptyTable');?></td>
											<td></td>
										</tr>
										<?}?>
									</tbody>
									<tfoot>
										<tr>
											<th class="TextAlignLeft"><?= lang('stats.table.stats.date');?></th>
											<th class="TextAlignRight"><?= lang('stats.table.stats.signin');?></th>
										</tr>
									</tfoot>
								</table>
							</div>
			<?}
			if(($option==1)||($option==4)){?>
							<div class="frame15per ma1">
								<table cellpadding="4" cellspacing="0" border="0" class="display" id="flightsstats_table" width="90%">
									<thead>
										<tr>
											<th style="width: 15%" class="TextAlignLeft"><b><?= lang('stats.table.stats.date');?></b></th>
											<th style="width: 35%" class="TextAlignRight"><b><?= lang('stats.table.stats.flights');?></b></th>
										</tr>
									</thead>
									<tbody>
										<?if(!empty($adsGraphFlightsResults)){
											foreach($adsGraphFlightsResults as $flightsResults){?>
										<tr>
											<td class="TextAlignLeft"><?= $flightsResults->cdate?></td>
											<td class="TextAlignRight"><?= $flightsResults->qty?></td>
										</tr>
											<?}?>
										<?}else{?>
										<tr>
											<td><?= lang('datatable.EmptyTable');?></td>
											<td></td>
										</tr>
										<?}?>
									</tbody>
									<tfoot>
										<tr>
											<th class="TextAlignLeft"><?= lang('stats.table.stats.date');?></th>
											<th class="TextAlignRight"><?= lang('stats.table.stats.flights');?></th>
										</tr>
									</tfoot>
								</table>
							</div>
			<?}
			if(($option==1)||($option==5)){?>
							<div class="frame15per ma1">
								<table cellpadding="4" cellspacing="0" border="0" class="display" id="friendshipstats_table" width="90%">
									<thead>
										<tr>
											<th style="width: 15%" class="TextAlignLeft"><b><?= lang('stats.table.stats.date');?></b></th>
											<th style="width: 35%" class="TextAlignRight"><b><?= lang('stats.table.stats.friendships');?></b></th>
										</tr>
									</thead>
									<tbody>
										<?if(!empty($adsGraphNewFriendsResults)){
											foreach($adsGraphNewFriendsResults as $friendsResults){?>
										<tr>
											<td class="TextAlignLeft"><?= $friendsResults->cdate?></td>
											<td class="TextAlignRight"><?= $friendsResults->qty?></td>
										</tr>
											<?}?>
										<?}else{?>
										<tr>
											<td><?= lang('datatable.EmptyTable');?></td>
											<td></td>
										</tr>
										<?}?>
									</tbody>
									<tfoot>
										<tr>
											<th class="TextAlignLeft"><?= lang('stats.table.stats.date');?></th>
											<th class="TextAlignRight"><?= lang('stats.table.stats.friendships');?></th>
										</tr>
									</tfoot>
								</table>
							</div>
			<?}
			if(($option==1)||($option==6)){?>
							<div class="frame15per ma1">
								<table cellpadding="4" cellspacing="0" border="0" class="display" id="mailssenttats_table" width="90%">
									<thead>
										<tr>
											<th style="width: 15%" class="TextAlignLeft"><b><?= lang('stats.table.stats.date');?></b></th>
											<th style="width: 35%" class="TextAlignRight"><b><?= lang('stats.table.stats.mailssent');?></b></th>
										</tr>
									</thead>
									<tbody>
										<?if(!empty($adsGraphMailsSentResults)){
											foreach($adsGraphMailsSentResults as $mailsResults){?>
										<tr>
											<td class="TextAlignLeft"><?= $mailsResults->cdate?></td>
											<td class="TextAlignRight"><?= $mailsResults->qty?></td>
										</tr>
											<?}?>
										<?}else{?>
										<tr>
											<td><?= lang('datatable.EmptyTable');?></td>
											<td></td>
										</tr>
										<?}?>
									</tbody>
									<tfoot>
										<tr>
											<th class="TextAlignLeft"><?= lang('stats.table.stats.date');?></th>
											<th class="TextAlignRight"><?= lang('stats.table.stats.mailssent');?></th>
										</tr>
									</tfoot>
								</table>
							</div>
			<?}
			if(($option==1)||($option==7)){?>
							<div class="frame15per ma1">
								<table cellpadding="4" cellspacing="0" border="0" class="display" id="checkinstats_table" width="90%">
									<thead>
										<tr>
											<th style="width: 15%" class="TextAlignLeft"><b><?= lang('stats.table.stats.date');?></b></th>
											<th style="width: 35%" class="TextAlignRight"><b><?= lang('stats.table.stats.checkins');?></b></th>
										</tr>
									</thead>
									<tbody>
										<?if(!empty($adsGraphCheckinsResults)){
											foreach($adsGraphCheckinsResults as $checkinResults){?>
										<tr>
											<td class="TextAlignLeft"><?= $checkinResults->cdate?></td>
											<td class="TextAlignRight"><?= $checkinResults->qty?></td>
										</tr>
											<?}?>
										<?}else{?>
										<tr>
											<td><?= lang('datatable.EmptyTable');?></td>
											<td></td>
										</tr>
										<?}?>
									</tbody>
									<tfoot>
										<tr>
											<th class="TextAlignLeft"><?= lang('stats.table.stats.date');?></th>
											<th class="TextAlignRight"><?= lang('stats.table.stats.checkins');?></th>
										</tr>
									</tfoot>
								</table>
							</div>
			<?}?>
						</div>
						<div class="clear"></div>
		</form>
	</div>

</div>

<script type="text/javascript">
var dates = {
<?php
$arr = '';
	if(isset($dates)){
		foreach($dates as $key => $values){
			$arr .= "'" . $key . "'" .   " : " . "'" . $values . "'" . ",";
		}
		$arr =  substr_replace($arr, '', -1);
	}
echo $arr;
?>
};
var str_json = <?php echo $json?>;
//alert(dates[0]);

$(document).ready(function()
{
	$.metadata.setType("attr", "validate");

	$("input:button").button();

				chart = new Highcharts.Chart({
					chart: {
						renderTo: 'containerStats',
						defaultSeriesType: 'line',
						marginRight: 130,
						marginBottom: 70
					},
					title: {
						text:"<?=$titleChart?>",
						x: -20 //center
					},
					subtitle: {
						text: 'Source: FlySocial.com',
						x: -20
					},
					xAxis: {
						categories: dates,
						labels: {
							rotation: -45,
							align: 'right'/*
							style: {
								font: 'normal 13px Verdana, sans-serif'
								}
*/							}
						},
					yAxis: {
						title: {
							text: 'Quantity of Sign Ups'
						},
						plotLines: [{
							value: 0,
							width: 1,
							color: '#808080'
						}]
					},
					tooltip: {
						formatter: function() {
				                return '<b>'+ this.series.name +'</b><br/>'+
								this.x +': <b>'+ this.y +'</b> ';
						}
					},
					legend: {
						layout: 'vertical',
						align: 'right',
						verticalAlign: 'top',
						x: -10,
						y: 100,
						borderWidth: 0
					},
					series: str_json
				});
	$('#stats_table').styleTable({
		tr_hover_bgcolor: '#BCD4EC'
	});
	$('#signinstats_table').styleTable({
		tr_hover_bgcolor: '#BCD4EC'
	});
	$('#flightsstats_table').styleTable({
		tr_hover_bgcolor: '#BCD4EC'
	});
	$('#friendshipstats_table').styleTable({
		tr_hover_bgcolor: '#BCD4EC'
	});
	$('#mailssenttats_table').styleTable({
		tr_hover_bgcolor: '#BCD4EC'
	});
	$('#checkinstats_table').styleTable({
		tr_hover_bgcolor: '#BCD4EC'
	});
});
</script>