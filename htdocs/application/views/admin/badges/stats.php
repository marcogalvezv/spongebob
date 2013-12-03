<div class="contentform">

	<div class="form80per" id="badgestatsPanel">
		<div class="frame100per">
			<div id="containerBadgeStats" style="width: 800px; height: 400px; margin: 0 auto"></div>

		</div>
						
		<form name="admin_badgestats_form" id="admin_badgestats_form" method="post">
						<div class="frame100per pa1000">
							<div class="divCenter" style="width:90%;">
								<table cellpadding="4" cellspacing="0" border="0" class="display" id="badgesstats_table">
									<thead>
										<tr>
											<th style="width: 15%" class="TextAlignLeft"><b><?= lang('badges.tab.cod');?></b></th>
											<th style="width: 35%" class="TextAlignLeft"><b><?= lang('badges.tab.badgename');?></b></th>
											<th style="width: 20%" class="TextAlignRight"><b><?= lang('badges.tab.date_asign');?></b></th>
											<th style="width: 15%" class="TextAlignRight"><b><?= lang('badges.tab.earned');?></b></th>
										</tr>
									</thead>
									<tbody>
										<?if(!empty($badgesGraphResults)){
											foreach($badgesGraphResults as $badgesResults){?>
										<tr>
											<td class="TextAlignLeft"><?= $badgesResults->cod?></td>
											<td class="TextAlignLeft"><?= $badgesResults->name?></td>
											<td class="TextAlignRight"><?= $badgesResults->date_earned?></td>
											<td class="TextAlignRight"><?= $badgesResults->badge_earned?></td>
										</tr>
											<?}?>
										<?}else{?>
										<tr>
											<td></td>
											<td><?= lang('datatable.EmptyTable');?></td>
											<td></td>
											<td></td>
										</tr>
										<?}?>
									</tbody>
									<tfoot>
										<tr>
											<th class="TextAlignLeft"><?= lang('badges.tab.cod');?></th>
											<th class="TextAlignLeft"><?= lang('badges.tab.badgename');?></th>
											<th class="TextAlignRight"><?= lang('badges.tab.date_asign');?></th>
											<th class="TextAlignRight"><?= lang('badges.tab.earned');?></th>
										</tr>
									</tfoot>
								</table>
							</div>
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
						renderTo: 'containerBadgeStats',
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
							text: 'Number of Badges'
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
								this.x +': '+ this.y +' badge(s)';
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
	$('#badgesstats_table').styleTable({
		tr_hover_bgcolor: '#BCD4EC'
	});
});
</script>