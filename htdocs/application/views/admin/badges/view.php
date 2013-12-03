<div class="contentform">
	<div class="navigationpanel ui-corner-all">
		<div class="ui-widget-header-navigation-panel ui-corner-all">
		</div>
		<a href="javascript:void(0);" id="showBadgeManagerPanel"><?= lang('badges.tab.title');?></a><br />
		<a href="javascript:void(0);" id="showBadgeStatsPanel"><?= lang('badges.tab.stats');?></a><br />
	</div>
	
	<div class="form80per" id="badgemanagerPanel">
		<h3><?= lang('badges.tab.title');?></h3>
						
		<form name="admin_badge_form" id="admin_badge_form" method="post">
						<div class="frame100per pa1000">
							<div class="divCenter" style="width:90%;">
								<table cellpadding="4" cellspacing="0" border="0" class="display" id="badgesmanagertable">
									<thead>
										<tr>
											<th style="width: 10%"><b><?= lang('badges.tab.cod');?></b></th>
											<th style="width: 10%"><b><?= lang('badges.tab.image');?></b></th>
											<th style="width: 15%"><b><?= lang('badges.tab.badgename');?></b></th>
											<th style="width: 20%"><b><?= lang('badges.tab.message');?></b></th>
											<th style="width: 10%"><b><?= lang('badges.tab.status');?></b></th>
											<th style="width: 20%"><b><?= lang('badges.tab.question');?></b></th>
											<th style="width: 10%" ><b><?= lang('badges.tab.actions');?></b></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><?= lang('datatable.loading');?></td>
										</tr>
									</tbody>
									<tfoot>
										<tr>
											<th class="TextAlignLeft"><?= lang('badges.tab.cod');?></th>
											<th class="TextAlignLeft"><?= lang('badges.tab.image');?></th>
											<th class="TextAlignLeft"><?= lang('badges.tab.badgename');?></th>
											<th class="TextAlignLeft"><?= lang('badges.tab.message');?></th>
											<th class="TextAlignLeft"><?= lang('badges.tab.status');?></th>
											<th class="TextAlignLeft"><?= lang('badges.tab.question');?></th>
											<th class="TextAlignLeft"><?= lang('badges.tab.actions');?></th>
										</tr>
									</tfoot>
								</table>
								<div class="fila" align="left">
									<div class="form15per FloatLeft ma1000 pa1000">
										<input onclick="v_badge_edit(-1)" value="<?= lang('badges.tab.add');?>" type="button" />
									</div>
								</div>
							</div>
						</div>
						<div class="clear"></div>
		</form>
	</div>

	<div class="form80per" id="badgestatsPanel" style="display:none">
		<h3><?= lang('badges.tab.title');?></h3>
		<form name="filter_badge_form" id="filter_badge_form" method="post">

						<div class="ui-corner-all pa1 divCenter" style="border:10px solid #e6f0fb;height:40px;width:750px;">
							<div class="fila">
								<div class="col" style="width:130px">
									<select name="filterbadgestats[this]" id="cb_filterbadgesthis" style="width:100px" onChange=configFilterBy(value)>
										<option value='1' selected='selected'>This day</option>
										<option value='2'>This Week</option>
										<option value='3'>This Month</option>
										<option value='4'>This year</option>
										<option value='5'>Custom</option>
									</select>
								</div>
                                <div class="col" style="width:150px; display:none" id="sdateDivBadge">from  <input type="text" name="filterbadgestats[from]" id="txt_fromdatebadge" style="width:80px" readonly="readonly" /></div>
                                <div class="col" style="width:150px; display:none" id="edateDivBadge">to  <input type="text" name="filterbadgestats[to]" id="txt_todatebadge" style="width:80px" readonly="readonly" /></div>
								<div class="col" style="width:130px">
									<select name="filterbadgestats[by]" id="cb_filterbadgesby" style="width:100px" >
										<option value='1' selected='selected'>By day</option>
									</select>
								</div>
								<div class="col" style="width:130px">
									<input onclick="filterSearchBagdes()" value="<?= lang('stats.filter.search');?>" type="button" />
								</div>
							</div>
						</div>
		</form>
						<div class="frame100per">
                            <div id="graphContent" style="width:880px" align="center"></div>

						</div>
						
	</div>

</div>

<!--DIALOG EDIT!-->
<div id="dialog_badgeedit" title="<?= lang('badges.editdialog.title');?>" style="display:none;">
</div>

<!--DIALOG CONFIRMATION!-->
<div id="dialog_confirm_badge" title="<?= lang('dialog.confirmation');?>" style="display:none;">
	<p>
		<span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
		<?= lang('dialog.msgofdelete');?>
	</p>
</div>

<!--DIALOG ERROR!-->
<div id="dialog_error_badge" title="<?= lang('badges.tab.errordelete');?>" style="display:none;">
	<p>
		<span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
		<?= lang('badges.tab.dialog.msgoferrordelete');?>
	</p>
</div>

<script type="text/javascript">
//var arrThis = new Array();arrThis[0] = '[Select]';arrThis[1] = 'This day';arrThis[2] = 'This week';arrThis[3] = 'This Month';arrThis[4] = 'This year';arrThis[5] = 'Custom';
var arrBy = new Array();arrBy[1] = 'By day';arrBy[2] = 'By week';arrBy[3] = 'By Month';arrBy[4] = 'By year';
var filterThis = document.getElementById("cb_filterbadgesthis");
var filterBy = document.getElementById("cb_filterbadgesby");

/*function configFilterThis(){
	if(filterThis.options){
		for (m=filterThis.options.length-1;m>0;m--)
			filterThis.options[m]=null
	}
	for(var i=0;i<arrThis.length;i++){ 
		filterThis.options[i] = new Option(arrThis[i],i);
	}
};*/
function configFilterBy(valThis){
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
//configFilterThis();

	$.metadata.setType("attr", "validate");

	$("input:button").button();

				
	$("#showBadgeStatsPanel").live("click", function () {
		$("#badgemanagerPanel").hide("fast");
		$("#badgestatsPanel").show("fast");
	});
	
	$("#showBadgeManagerPanel").live("click", function () {
		$("#badgestatsPanel").hide("fast");
		$("#badgemanagerPanel").show("fast");
	});
	
    oAdminTableBadges = $('#badgesmanagertable').dataTable({
        'bServerSide'    : true,
        'bAutoWidth'     : false,
		"bJQueryUI": true,
        'sPaginationType': 'full_numbers',
        'sAjaxSource': '/admin/badges/listenermanager',
        'aoColumns' : [
            { 'sName': 'cod'},
            { 'sName': 'filename' },
            { 'sName': 'name'},
			{ 'sName': 'message' },
			{ 'sName': 'status'},
			{ 'sName': 'question' },
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
			{ "sClass": "TextAlignLeft", "aTargets": [ 0,1,2,3,4,5 ] },
			{ "sClass": "TextAlignCenter", "aTargets": [  ] },
			{ "sClass": "TextAlignRight", "aTargets": [ ] }
		]
    });
	$('#badgesmanagertable').styleTable({
		tr_hover_bgcolor: '#BCD4EC'
	});

	$("#cb_filterbadgesthis").change(function () {
    	var selected = $("#cb_filterbadgesthis").val();
		if(selected == "5")
		{
			$("#sdateDivBadge").show('fast');
			$("#edateDivBadge").show('fast');
			$("#sdateDivBadge").val("");
			$("#edateDivBadge").val("");
			showDates = true;
		}
		else
		{
			$("#sdateDivBadge").hide('fast');
			$("#edateDivBadge").hide('fast');
//			$("#eGroupbyDiv").hide('fast');
			showDates = false;
		}	
	});
	
	$("#txt_fromdatebadge").datepicker({dateFormat: 'yy-mm-dd'});
	$("#txt_todatebadge").datepicker({dateFormat: 'yy-mm-dd'});
});

function v_badge_refresh()
{
	oAdminTableBadgesStats.fnDraw();
}

</script>