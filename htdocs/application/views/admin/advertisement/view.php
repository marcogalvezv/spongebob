<div class="contentform">
	<div class="navigationpanel ui-corner-all">
		<div class="ui-widget-header-navigation-panel ui-corner-all">
		</div>
		<a href="javascript:void(0);" id="showAdsManagerPanel"><?= lang('ads.tab.title');?></a><br />
		<a href="javascript:void(0);" id="showAdsStatsPanel"><?= lang('ads.tab.stats');?></a><br />
	</div>

	<div class="form80per" id="adsmanagerPanel">
		<h3><?= lang('ads.tab.title');?></h3>
						
		<form name="admin_ads_form" id="admin_ads_form" method="post">
						<div class="frame100per pa1000">
							<div class="divCenter" style="width:90%;">
								<table cellpadding="4" cellspacing="0" border="0" class="display" id="adsmanagertable">
									<thead>
										<tr>
											<th style="width: 20%"><b><?= lang('ads.table.title');?></b></th>
											<th style="width: 10%"><b><?= lang('ads.table.position');?></b></th>
											<th style="width: 10%"><b><?= lang('ads.table.startdate');?></b></th>
											<th style="width: 10%"><b><?= lang('ads.table.duration');?></b></th>
											<th style="width: 10%"><b><?= lang('ads.table.image');?></b></th>
											<th style="width: 10%"><b><?= lang('ads.table.status');?></b></th>
											<th style="width: 20%"><b><?= lang('ads.table.country');?></b></th>
											<th style="width: 10%" ><b><?= lang('ads.table.actions');?></b></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><?= lang('datatable.loading');?></td>
										</tr>
									</tbody>
									<tfoot>
										<tr>
											<th class="TextAlignLeft"><?= lang('ads.table.title');?></th>
											<th class="TextAlignLeft"><?= lang('ads.table.position');?></th>
											<th class="TextAlignLeft"><?= lang('ads.table.startdate');?></th>
											<th class="TextAlignLeft"><?= lang('ads.table.duration');?></th>
											<th class="TextAlignLeft"><?= lang('ads.table.image');?></th>
											<th class="TextAlignLeft"><?= lang('ads.table.status');?></th>
											<th class="TextAlignLeft"><?= lang('ads.table.country');?></th>
											<th class="TextAlignLeft"><?= lang('ads.table.actions');?></th>
										</tr>
									</tfoot>
								</table>
								<div class="fila" align="left">
									<div class="form15per FloatLeft ma1000 pa1000">
										<input onclick="v_ads_edit(-1)" value="<?= lang('ads.tab.add');?>" type="button" />
									</div>
								</div>
							</div>
						</div>
						<div class="clear"></div>
		</form>
	</div>

	<div class="form80per" id="adsstatsPanel" style="display:none">
		<h3><?= lang('ads.tab.title');?></h3>
		<form name="filter_ads_form" id="filter_ads_form" method="post">

						<div class="ui-corner-all pa1 divCenter" style="border:10px solid #e6f0fb;height:40px;width:750px;">
							<div class="fila">
								<div class="col" style="width:130px">
									<select name="filteradsstats[this]" id="cb_filteradsthis" style="width:100px" onChange=configFilterAdsBy(value)>
										<option value='1' selected='selected'>This day</option>
										<option value='2'>This Week</option>
										<option value='3'>This Month</option>
										<option value='4'>This year</option>
										<option value='5'>Custom</option>
									</select>
								</div>
                                <div class="col" style="width:150px; display:none" id="sdateDivAds">from  <input type="text" name="filteradsstats[from]" id="txt_fromdateads" style="width:80px" readonly="readonly" /></div>
                                <div class="col" style="width:150px; display:none" id="edateDivAds">to  <input type="text" name="filteradsstats[to]" id="txt_todateads" style="width:80px" readonly="readonly" /></div>
								<div class="col" style="width:130px">
									<select name="filteradsstats[by]" id="cb_filteradsby" style="width:100px" >
										<option value='1' selected='selected'>By day</option>
									</select>
								</div>
								<div class="col" style="width:130px">
									<input onclick="filterSearchAds()" value="<?= lang('stats.filter.search');?>" type="button" />
								</div>
							</div>
						</div>
		</form>
						<div class="frame100per">
                            <div id="graphContentAds" style="width:880px" align="center"></div>

						</div>
						
	</div>
    <div class="Clear"></div>
</div>

<!--DIALOG EDIT!-->
<div id="dialog_adsedit" title="<?= lang('ads.editdialog.title');?>" style="display:none;">
</div>

<!--DIALOG CONFIRMATION!-->
<div id="dialog_confirm_ads" title="<?= lang('dialog.confirmation');?>" style="display:none;">
	<p>
		<span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
		<?= lang('dialog.msgofdelete');?>
	</p>
</div>

<!--DIALOG ERROR!-->
<div id="dialog_error_ads" title="<?= lang('ads.tab.errordelete');?>" style="display:none;">
	<p>
		<span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
		<?= lang('ads.tab.dialog.msgoferrordelete');?>
	</p>
</div>

<script type="text/javascript">
var arrBy = new Array();arrBy[1] = 'By day';arrBy[2] = 'By week';arrBy[3] = 'By Month';arrBy[4] = 'By year';
var filterThis = document.getElementById("cb_filteradsthis");
var filterBy = document.getElementById("cb_filteradsby");

function configFilterAdsBy(valThis){
	if(filterBy.options){
		for (m=filterBy.options.length-1;m>=0;m--)
			filterBy.options[m]=null
	}
	
	if(valThis>1){
		for(var i=1;i<valThis;i++){ 
			filterBy.options[i-1] = new Option(arrBy[i],i);
		}
	}else{
		filterBy.options[0] = new Option(arrBy[1],1);
	}
};

$(document).ready(function()
{
	$.metadata.setType("attr", "validate");

	$("input:button").button();

				
	$("#showAdsManagerPanel").live("click", function () {
		$("#adsstatsPanel").hide("fast");
		$("#adsmanagerPanel").show("fast");
	});
	
	$("#showAdsStatsPanel").live("click", function () {
		$("#adsmanagerPanel").hide("fast");
		$("#adsstatsPanel").show("fast");
	});
	
    oAdminTableAds = $('#adsmanagertable').dataTable({
        'bServerSide'    : true,
        'bAutoWidth'     : false,
		"bJQueryUI": true,
        'sPaginationType': 'full_numbers',
        'sAjaxSource': '/admin/ads/listenermanager',
        'aoColumns' : [
            { 'sName': 'title'},
            { 'sName': 'position'},
            { 'sName': 'startdate' },
			{ 'sName': 'duration' },
			{ 'sName': 'filename'},
			{ 'sName': 'status'},
			{ 'sName': 'fullname'},
            { 'sName': 'id',"bSortable": false, 'bSearchable': false }
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
			{ "sClass": "TextAlignLeft", "aTargets": [ 0,1,5,6 ] },
			{ "sClass": "TextAlignCenter", "aTargets": [ 4,7 ] },
			{ "sClass": "TextAlignRight", "aTargets": [ 2,3 ] }
		]
    });
	$('#adsmanagertable').styleTable({
		tr_hover_bgcolor: '#BCD4EC'
	});

    oAdminTableAdsStats = $('#adsstatstable').dataTable({
        'bServerSide'    : true,
        'bAutoWidth'     : false,
		"bJQueryUI": true,
        'sPaginationType': 'full_numbers',
        'sAjaxSource': '/admin/ads/listenerstats',
        'aoColumns' : [
            { 'sName': 'cod'},
            { 'sName': 'name'},
            { 'sName': 'date_earned'},
			{ 'sName': 'badge_earned'}/*,
            { 'sName': 'id',"bSortable": false, 'bSearchable': false }*/
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
			{ "sClass": "TextAlignLeft", "aTargets": [ 0,1 ] },
			{ "sClass": "TextAlignCenter", "aTargets": [ 3 ] },
			{ "sClass": "TextAlignRight", "aTargets": [ 2 ] }
		]
    });
	$('#adsstatstable').styleTable({
		tr_hover_bgcolor: '#BCD4EC'
	});

	$("#cb_filteradsthis").change(function () {
    	var selected = $("#cb_filteradsthis").val();
		if(selected == "5")
		{
			$("#sdateDivAds").show('fast');
			$("#edateDivAds").show('fast');
			$("#sdateDivAds").val("");
			$("#edateDivAds").val("");
			showDates = true;
		}
		else
		{
			$("#sdateDivAds").hide('fast');
			$("#edateDivAds").hide('fast');
			showDates = false;
		}	
	});
	
	$("#txt_fromdateads").datepicker({dateFormat: 'yy-mm-dd'});
	$("#txt_todateads").datepicker({dateFormat: 'yy-mm-dd'});
});

function ads_refresh()
{
	oAdminTableAdsStats.fnDraw();
}

</script>