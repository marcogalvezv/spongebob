<style>
.fg-toolbar{
	height:25px;
}
</style>
<?/*		<h4 class="alert_warning">A Warning Alert</h4>
		<div id="errordiv" style="display:none;">		
			<h4 class="alert_error"><span id="errormsg"><span></h4>
		</div>
		<div id="successbox" style="display:none;">
			<h4 class="alert_success"><span id="successmsg"><span></h4>
		</div>
	*/?>
<article class="module width_full"><!--contentform-->
<?/*		<div id="errordiv" class="ui-widget" style="margin-top: 10px; display:none;">
			<div style="padding: 0 .7em;" class="ui-state-error ui-corner-all"> 
				<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-alert"></span> 
				<strong>Error:</strong> <span id="errormsg"><span></p>
			</div>
			<br />
		</div>
		<div id="successbox" class="ui-widget" style="display:none;">
			<div style="padding: 0 .7em;" class="ui-state-highlight ui-corner-all"> 
				<p>
				<span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>
				<strong>Success:</strong> <span id="successmsg"><span></p>
				</p>
			</div>
		</div>
*/?>
		<header><h3><?= lang('type.title');?></h3></header>
		<form name="admin_type_form" id="admin_type_form" method="post">
				<div class="module_content">
						<table cellpadding="4" cellspacing="0" border="0" class="display" id="typetable">
							<thead>
								<tr>
									<th style="width: 5%"><b><?= lang('type.cod');?></b></th>
									<th style="width: 15%"><b><?= lang('type.name');?></b></th>
									<th style="width: 15%" ><b><?= lang('common.table.actions');?></b></th>
					            </tr>
							</thead>
							<tbody>
								<tr>
									<td>loading..</td>
								</tr>
							</tbody>
<?/*							<tfoot>
								<tr>
								
									<th class="TextAlignLeft"><?= lang('type.cod');?></th>
									<th class="TextAlignLeft"><?= lang('type.name');?></th>
									<th class="TextAlignLeft"><?= lang('common.table.actions');?></th>
					            </tr>
							</tfoot>*/?>
						</table>
				</div>
			<footer style="height:40px">
				<div class="submit_link">
					<input onclick="type_edit(0)" value="<?= lang('common.button.add');?>" type="button" />
				</div>
			</footer>
		</form>

</article><!-- end of contentform article -->

<!--DIALOG ADD!-->
<div id="dialog_typeadd" title="<?= lang('type.dialog.addtitle');?>" style="display:none; overflow:hidden;">
</div><!--/dialog!-->

<!--DIALOG EDIT!-->
<div id="dialog_typeedit" title="<?= lang('type.dialog.edittitle');?>" style="display:none; overflow:hidden;">
</div><!--/dialog!-->

<!--DIALOG CONFIRMATION!-->
<div id="dialog_confirm_type" title="<?= lang('common.dialog.confirmation');?>" style="display:none;">
	<p>
		<span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
		<?= lang('common.dialog.msgofdelete');?>
	</p>
</div>

<!--DIALOG ERROR!-->
<div id="dialog_error_type" title="<?= lang('common.dialog.errordelete');?>" style="display:none;">
	<p>
		<span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
		<?= lang('common.dialog.msgoferrordelete');?>
	</p>
</div>

<script type="text/javascript">

$(document).ready(function(){
    oAdminTableType = $('#typetable').dataTable({
        'bServerSide'    : true,
        'bAutoWidth'     : false,
		"bJQueryUI": true,
        'sPaginationType': 'full_numbers',
        'sAjaxSource': '<?= base_url()?>admin/type/listener',
        'aoColumns' : [
            { 'sName': 'code'},
            { 'sName': 'name'},
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
			{ "sClass": "TextAlignLeft", "aTargets": [ 0,1 ] },
			{ "sClass": "TextAlignRight", "aTargets": [  ] }
		]
    });

	$("input:button").button();

	$('#typetable').styleTable({
		tr_hover_bgcolor: '#BCD4EC'
	});
});

</script>
