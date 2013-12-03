<div class="contentform">

	<div class="form80per" id="adstatsPanel">
		<div class="frame100per">
			<div id="containerBadgeStats" style="width: 800px; height: 400px; margin: 0 auto"></div>

		</div>
						
		<form name="admin_adstats_form" id="admin_adstats_form" method="post">
						<div class="frame100per pa1000">
							<div class="frame40per ma1">
								<table cellpadding="4" cellspacing="0" border="0" class="display" id="adsClicksstats_table" width="90%">
									<thead>
										<tr>
											<th style="width: 15%" class="TextAlignLeft"><b><?= lang('ads.table.stats.date');?></b></th>
											<th style="width: 35%" class="TextAlignRight"><b><?= lang('ads.table.stats.clicks');?></b></th>
										</tr>
									</thead>
									<tbody>
										<?if(!empty($adsGraphClicksResults)){
											foreach($adsGraphClicksResults as $adsResults){?>
										<tr>
											<td class="TextAlignLeft"><?= $adsResults->cdate?></td>
											<td class="TextAlignRight"><?= $adsResults->clicks?></td>
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
											<th class="TextAlignLeft"><?= lang('ads.table.stats.date');?></th>
											<th class="TextAlignRight"><?= lang('ads.table.stats.clicks');?></th>
										</tr>
									</tfoot>
								</table>
							</div>
							<div class="frame40per ma1">
								<table cellpadding="4" cellspacing="0" border="0" class="display" id="adsImpressionsstats_table" width="90%">
									<thead>
										<tr>
											<th style="width: 15%" class="TextAlignLeft"><b><?= lang('ads.table.stats.date');?></b></th>
											<th style="width: 35%" class="TextAlignRight"><b><?= lang('ads.table.stats.impressions');?></b></th>
										</tr>
									</thead>
									<tbody>
										<?if(!empty($adsGraphImpressionsResults)){
											foreach($adsGraphImpressionsResults as $adsResults){?>
										<tr>
											<td class="TextAlignLeft"><?= $adsResults->cdate?></td>
											<td class="TextAlignRight"><?= $adsResults->impressions?></td>
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
											<th class="TextAlignLeft"><?= lang('ads.table.stats.date');?></th>
											<th class="TextAlignRight"><?= lang('ads.table.stats.impressions');?></th>
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
							text: 'Number of Clicks & Impressions'
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
	$('#adsClicksstats_table').styleTable({
		tr_hover_bgcolor: '#BCD4EC'
	});
	$('#adsImpressionsstats_table').styleTable({
		tr_hover_bgcolor: '#BCD4EC'
	});
});
</script>