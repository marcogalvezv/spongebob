<div class="contentform">
	<div class="navigationpanel ui-corner-all">
		<div class="ui-widget-header-navigation-panel ui-corner-all">
		</div>
		<a href="javascript:void(0);" id="showHomeStatsPanel"><?= lang('stats.tab.title');?></a><br />
		<a href="javascript:void(0);" id="showHomeURLsPanel"><?= lang('stats.tab.titleurlrefer');?></a><br />
	</div>
	
	<div class="form80per" id="homeStatsPanel">
		<h3><?= lang('stats.tab.title');?></h3>
		<form name="filter_stats_form" id="filter_stats_form" method="post">
						<div class="ui-corner-all pa1 divCenter" style="border:10px solid #e6f0fb;height:40px;width:830px;">
							<div class="fila">
								<div class="col" style="width:130px">
									<select name="filterstats[option]" id="cb_filterstatsoption" style="width:100px" >
										<option value='1'><?= lang('stats.filter.all');?></option>
										<option value='2'><?= lang('stats.filter.signups');?></option>
										<option value='3'>Sign in</option>
										<option value='4'>flights</option>
										<option value='5'>new friendships</option>
										<option value='6'>mails sent</option>
										<option value='7'>checkins</option>
									</select>
								</div>
								<div class="col" style="width:130px">
									<select name="filterstats[this]" id="cb_filterstatsthis" style="width:100px" onChange=configFilterStatsBy(value)>
										<option value='1' selected='selected'>This day</option>
										<option value='2'>This Week</option>
										<option value='3'>This Month</option>
										<option value='4'>This year</option>
										<option value='5'>Custom</option>
									</select>
								</div>
                                <div class="col" style="width:150px; display:none" id="sdateDivStats">from  <input type="text" name="filterstats[from]" id="txt_fromdatestats" style="width:80px" readonly="readonly" /></div>
                                <div class="col" style="width:150px; display:none" id="edateDivStats">to  <input type="text" name="filterstats[to]" id="txt_todatestats" style="width:80px" readonly="readonly" /></div>
								<div class="col" style="width:130px">
									<select name="filterstats[by]" id="cb_filterstatsby" style="width:100px" >
										<option value='1' selected='selected'>By day</option>
									</select>
								</div>
								<div class="col" style="width:130px">
									<input onclick="filterSearchStats()" value="<?= lang('stats.filter.search');?>" type="button" />
								</div>
							</div>
						</div>
			</form>
						
						<div class="frame100per">
                            <div id="graphContentStats" style="width:880px" align="center"></div>

						</div>
						<div class="clear"></div>
	</div>

    <div class="form80per" id="urlReferPanel" style="display:none">
		<h3><?= lang('stats.tab.titleurlrefer');?></h3>
		<form name="homaUrlRefer_form" id="homaUrlRefer_form" method="post">
        	<div class="ui-corner-all pa1" style="border:1px solid #b1b1b1;">
						<table border="0" cellpadding="4" cellspacing="0" align="center" width ="98%" class="display" id="urlrefer_table">
							<thead>
								<tr>
									<th style="width: 10%"><b><?= lang('stats.url.hits');?></b></th>
									<th style="width: 90%"><b><?= lang('stats.url.referringurl');?></b></th>
									<th style="width: 90%"><b>Actions</b></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><?= lang('datatable.loading');?></td>
								</tr>
							</tbody>
                            <tfoot>
								<tr>
									<th class="TextAlignLeft"><b><?= lang('stats.url.hits');?></b></th>
									<th class="TextAlignLeft"><b><?= lang('stats.url.referringurl');?></b></th>
									<th class="TextAlignLeft"><b>Actions</b></th>
					            </tr>
							</tfoot>
						</table>
                    </div>
					<br /><br />

					<div class="fila" align="left">
					<div class="col" style="width:50px" align="left">
						<input onclick="urlreferral_deleteall()" id="clearUrlList" value="<?= lang('stats.url.clearreferlist');?>" type="button" />
					</div>
					</div>
		</form>
	</div>
    <div class="Clear"></div>
</div>

<!--DIALOG CONFIRMATION!-->
<div id="dialog_confirm_url" title="<?= lang('dialog.confirmation');?>" style="display:none;">
	<p>
		<span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
		<?= lang('dialog.msgofdelete');?>
	</p>
</div>

<script type="text/javascript">
var arrBy = new Array();arrBy[1] = 'By day';arrBy[2] = 'By week';arrBy[3] = 'By Month';arrBy[4] = 'By year';
var filterThis = document.getElementById("cb_filterstatsthis");
var filterBy = document.getElementById("cb_filterstatsby");

function configFilterStatsBy(valThis){
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

	$("#showHomeStatsPanel").live("click", function () {
		$("#urlReferPanel").hide("fast");
		$("#homeStatsPanel").show("fast");
	});
	
	$("#showHomeURLsPanel").live("click", function () {
		$("#homeStatsPanel").hide("fast");
		$("#urlReferPanel").show("fast");
	});
	
    oAdminHomeUrlRefer = $('#urlrefer_table').dataTable({
        'bServerSide'    : true,
        'bAutoWidth'     : false,
		"bJQueryUI": true,
        'sPaginationType': 'full_numbers',
        'sAjaxSource': '<?= base_url()?>admin/stats/listenerurl',
        'aoColumns' : [
            { 'sName': 'hits'},
            { 'sName': 'url'},
            { 'sName': 'id'}
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
			{ "sClass": "TextAlignLeft", "aTargets": [ 0,1,2 ] },
			{ "sClass": "TextAlignRight", "aTargets": [ ] }
		]
    });
	

	$("#cb_filterstatsthis").change(function () {
    	var selected = $("#cb_filterstatsthis").val();
		if(selected == "5")
		{
			$("#sdateDivStats").show('fast');
			$("#edateDivStats").show('fast');
			$("#sdateDivStats").val("");
			$("#edateDivStats").val("");
			showDates = true;
		}
		else
		{
			$("#sdateDivStats").hide('fast');
			$("#edateDivStats").hide('fast');
			showDates = false;
		}	
	});
	
	$("#txt_fromdatestats").datepicker({dateFormat: 'yy-mm-dd'});
	$("#txt_todatestats").datepicker({dateFormat: 'yy-mm-dd'});
});


</script>