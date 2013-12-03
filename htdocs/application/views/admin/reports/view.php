<style>
div.ui-datepicker{
	font-size:10px;
}
.odd{
	text-align:center; !important
}
.even{
	text-align:center; !important
}
</style>

<link rel="stylesheet" type="text/css"  href="/js/extras/TableTools/media/css/TableTools.css" media=""/>

<div class="contentform">
	<div class="navigationpanel ui-corner-all">
		<div class="ui-widget-header-navigation-panel ui-corner-all">
		</div>
		<a href="javascript:void(0);"><?= lang('reports.incomereport')?></a>
	</div>
    <div class="form70per" id="statisticPanel">
		<h3><?= lang('reports.incomereport')?></h3>
		<form name="adminreports-form" id="adminreports-form" method="post" autocomplete="off">  
        	<fieldset class="formshopgrid ui-corner-all pa1">
			<legend class="ui-corner-all"><b><?= lang('reports.filterby')?></b></legend>
				<div class="fila">
					<div class="col" style="width:200px"><?= lang('marketing.period')?>
						<select name="reports[period]" id="cb_period" validate="required:true">
							<option value="" selected="selected"><?= lang('marketing.select')?></option>
							<option value="1"><?= lang('marketing.yesterday')?></option>
							<option value="2"><?= lang('marketing.today')?></option>
							<option value="3"><?= lang('marketing.custom')?></option>
						</select>
					</div>
					<div class="col" style="width:200px; display:none" id="sdateDiv"><?= lang('marketing.from')?>  <input type="text" name="reports[datefrom]" id="txt_fromdate" style="width:100px" readonly="readonly" value="<?= date("Y-m-d", strtotime(date('m').'/01/'.date('Y').' 00:00:00'))?>" /></div>
					<div class="col" style="width:200px; display:none" id="eDateDiv"><?= lang('marketing.to')?>  <input type="text" name="reports[dateto]" id="txt_todate" style="width:100px" readonly="readonly" value="<?= date("Y-m-d")?>" /></div>
					<div class="col" style="width:50px"><input id="doReportSearch" value="<?= lang('marketing.go')?>" type="button" /></div>
				</div>
				<div class="fila">
					<label for="cb_period" class="error" style="display:none"><?= lang('reports.validperiod')?></label>
				</div>	
				<div class="fila">
					<div class="col" style="width:300px"><?= lang('reports.country')?>&nbsp;&nbsp;&nbsp;&nbsp; 
						<input type="radio" name="reports[country]" value="all" checked="checked" />  <?= lang('reports.all')?>&nbsp;&nbsp;
						<input type="radio" name="reports[country]" value="australia" />  <?= lang('reports.australia')?>&nbsp;&nbsp;
						<input type="radio" name="reports[country]" value="overseas" /> <?= lang('reports.overseas')?>
					</div>
				</div>
			</fieldset>
			<br />
			<br />
		</form>
		<div id="graphContent" style="width:880px" align="center"></div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function()
{
	$.metadata.setType("attr", "validate");
	$.validator.addMethod("englishDate", function(value, element) { 
    	return Date.parseExact(value, "yyyy/M/d");
	});
	$("#marketingListStat-form").validate({
	   rules : {
		  txt_fromdate : { englishDate : true },
		  txt_todate : { englishDate : true }
	   }
	});
	$("#cb_period").change(function () {
    	var selected = $("#cb_period").val();
		if(selected == "3")
		{	
			$("#sdateDiv").show('fast');
			$("#eDateDiv").show('fast');
			//$("#eGroupbyDiv").show('fast');
			$("#sdateDiv").val("");
			$("#edateDiv").val("");
			//$("#eGroupbyDiv").val("");
			showDates = true;
		}
		else
		{
			$("#sdateDiv").hide('fast');
			$("#eDateDiv").hide('fast');
			//$("#eGroupbyDiv").hide('fast');
			showDates = false;
		}	
	});
	
	$("input:button").button();
	$("#txt_fromdate").datepicker({dateFormat: 'yy-mm-dd'});
	$("#txt_todate").datepicker({dateFormat: 'yy-mm-dd'});
});
</script>