<!-- LIST -->
<style>
div.DTTT_container {
    float: left; !important
}
.clear{
	padding-top:20px;
}
</style>
<div id="reportsView" class="form100per">
<div class="formpaymentgrid ui-corner-all pa1" style="border:1px solid #b1b1b1;">
<?if(isset($mrkResults) && count($mrkResults) > 0){?>
<table id="table2" border="0" cellpadding="4" cellspacing="1" align="center" width ="100%" class="display">
<thead>
  <tr style="background-image:url(/css/ui/images/ui-bg_glass_75_e6e6e6_1x400.png)">
    <th><b>Period</b></th>
    <?if($country == 'all' || $country == 'australia'){?>
	<th><b>Fees Australia</b></th>
	<?}?>
	<?if($country == 'all' || $country == 'overseas'){?>
    <th><b>Fees Overseas</b></th>
	<?}?>
	<?if($country == 'all' || $country == 'australia'){?>
    <th><b>Commission Australia</b></th>
	<?}?>
	<?if($country == 'all' || $country == 'overseas'){?>
    <th><b>Commission Overseas</b></th>
	<?}?>
    <th><b>Total</b></th>
  </tr>
</thead>
<tbody>	
	<?php
	   for($i=0; $i<=sizeof($mrkResults)-1; $i++){
	?>
    <tr>
        <td align="center"><?= $mrkResults[$i]->dates?></td>
		<?if($country == 'all' || $country == 'australia'){?>
        <td align="center"><? if($mrkResults[$i]->fees_aus != ""){ echo "$".$mrkResults[$i]->fees_aus; }?></td>
		<?}?>
		<?if($country == 'all' || $country == 'overseas'){?>
		<td align="center"><? if($mrkResults[$i]->fees_overseas != ""){ echo "$".$mrkResults[$i]->fees_overseas; }?></td>
		<?}?>
		<?if($country == 'all' || $country == 'australia'){?>
		<td align="center"><? if($mrkResults[$i]->comis_aus != ""){ echo "$".$mrkResults[$i]->comis_aus; }?></td>
        <?}?>
		<?if($country == 'all' || $country == 'overseas'){?>
		<td align="center"><? if($mrkResults[$i]->comis_overseas != ""){ echo "$".$mrkResults[$i]->comis_overseas; }?></td>
		<?}?>
		<?if($country == 'all'){?>
		<td align="center"><b>$<?= ($mrkResults[$i]->fees_aus + $mrkResults[$i]->fees_overseas + $mrkResults[$i]->comis_aus + $mrkResults[$i]->comis_overseas)?></td>
		<?}elseif($country == 'overseas'){?>
        <td align="center"><b>$<?= ($mrkResults[$i]->fees_overseas + $mrkResults[$i]->comis_overseas)?></td>
		<?}elseif($country == 'australia'){?>
        <td align="center"><b>$<?= ($mrkResults[$i]->fees_aus + $mrkResults[$i]->comis_aus)?></td>
		<?}?>
    </tr>
    <?php } ?>
<?if(isset($totalResults) && count($totalResults) > 0){?>
	<tr style="background-image:url(/css/ui/images/ui-bg_glass_75_e6e6e6_1x400.png)">
		<td align="center"><b>TOTALS</b></td>
		<?if($country == 'all' || $country == 'australia'){?>
		<td align="center"><b><? if($totalResults[0]->total_fees_aus != ""){ echo "$".$totalResults[0]->total_fees_aus; }?></td>
		<?}?>
		<?if($country == 'all' || $country == 'overseas'){?>
		<td align="center"><b><? if($totalResults[0]->total_fees_overseas != ""){ echo "$".$totalResults[0]->total_fees_overseas; }?></td>
		<?}?>
		<?if($country == 'all' || $country == 'australia'){?>
		<td align="center"><b><? if($totalResults[0]->total_comis_aus != ""){ echo "$".$totalResults[0]->total_comis_aus; }?></td>
		<?}?>
		<?if($country == 'all' || $country == 'overseas'){?>
		<td align="center"><b><? if($totalResults[0]->total_comis_overseas != ""){ echo "$".$totalResults[0]->total_comis_overseas; }?></td>
		<?}?>		
		<?if($country == 'all'){?>
		<td align="center"><b>$<?= ($totalResults[0]->total_fees_aus + $totalResults[0]->total_fees_overseas + $totalResults[0]->total_comis_aus + $totalResults[0]->total_comis_overseas)?></td>
		<?}elseif($country == 'overseas'){?>
        <td align="center"><b>$<?= ($totalResults[0]->total_fees_overseas + $totalResults[0]->total_comis_overseas)?></td>
		<?}elseif($country == 'australia'){?>
        <td align="center"><b>$<?= ($totalResults[0]->total_fees_aus + $totalResults[0]->total_comis_aus)?></td>
		<?}?>
	</tr>
<?}?>
</tbody>
</table>
</div>
</div>
<div class="clear"></div>
<div style="padding: 10px">
<form action="<?= base_url()?>admin/reports/exportexcel" method="post" id="exportform">  
	<div align="left">
		<?/*<a style="padding: 5px; border: 1px solid #000" href="javascript:void(0)" class="excelbutton"><?= lang('marketing.excel')?> <img src="<?= base_url()?>images/export_to_excel.gif" /></a>*/?>
		<input class="excelbutton" value="<?= lang('marketing.excel')?>" type="button" />
	</div>	
	<input type="hidden" id="exceldata" name="exceldata" />  
</form>
</div>
<?}else{?>
<p><b>There is no results for the current criteria</b></p>
</div>
</div>
<?}?>
<script type="text/javascript">
$(document).ready(function()
{
	$("input:button").button();
	
	$(".excelbutton").click(function(event) {
		$("#exceldata").val( $("<div>").append( $("#table2").eq(0).clone()).html());  
		$("#exportform").submit();
	});
	/*
	$('#table2').dataTable( {
		"bPaginate": false,
		"bLengthChange": false,
		"bFilter": false,
		"bSort": false,
		"bInfo": false,
		"bAutoWidth": false,
		"bJQueryUI": false,
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
			},
		}
	});
	*/
});	
</script>