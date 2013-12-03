<div class="contentform">
	<?/*$status = array(0=>lang('orders.shipped'),1=>lang('orders.fulfilment'),2=>lang('orders.backorder'))*/?>
	<div class="navigationpanel ui-corner-all">
		<div class="ui-widget-header-navigation-panel ui-corner-top">
		</div>
		<a href="javascript:void(0);" id="showPagesPanel"><?= lang('admin.pages');?></a><br />
		<a href="javascript:void(0);" id="showLanguagesPanel"><?= lang('admin.languages');?></a><br />
	</div>
	<div id="formLanguageView" class="form60per" style="display:none;">
		<h3><?= lang('admin.languages');?></h3>
		<form name="languagesList_form" id="languagesList_form" method="post">
					<div class="formlanguagegrid ui-corner-all pa1" style="border:1px solid #b1b1b1;">

						<table cellpadding="4" cellspacing="0" border="0" class="display" id="languages_table">
							<thead>
								<tr>
									<th style="width: 20%"><b><?= lang('language.short');?></b></th>
									<th style="width: 60%"><b><?= lang('language.name');?></b></th>
									<th style="width: 10%"><b><?= lang('shop.actions');?></b></th>
									<th>idlan</th>
					            </tr>
							</thead>
							<tbody>
								<tr>
									<td>loading...</td>
								</tr>
							</tbody>
							<tfoot>
								<tr>
									<th class="TextAlignLeft"><?= lang('language.short');?></th>
									<th class="TextAlignLeft"><?= lang('language.name');?></th>
									<th><?= lang('shop.actions');?></th>
									<th>idlan</th>
					            </tr>
							</tfoot>
						</table>

						<div class="fila" align="left">
						<div class="form20per FloatLeft ma1000 pa1000">
							<input onclick="language_viewedit(-1)" value="<?= lang('language.addlanguage');?>" type="button" />
						</div>
						</div>
					</div><!--/Grid-->					
		</form>
	</div><!--/formShopView!-->
	
	<div id="formPagesView" class="form80per">
		<h3><?= lang('admin.pages');?></h3>
		
		<form name="pagesList_form" id="pagesList_form" method="post">
		<div class="fila" >
			<div class="col" style="width:100px;padding-left:15px;"><?= lang('language.name');?>:</div>
			<div class="col" style="width:580px" class="textbox" align="left">
			<select id="cb_language" name="cb_language" style="width:350px" onChange="showPages(this.value)" >
				<option value="%" selected='selected'><?= lang('language.selectlanguagefilter');?></option>
			<?/*php
			for($i=0; $i<sizeof($language);$i++)
			{
				echo "<option value='".$language[$i]->id."'>".$language[$i]->short." - ".$language[$i]->name."</option>\n";
			}*/
			?>
			</select>
			</div>
		</div>
		
					<div class="formpagesgrid ui-corner-all pa1" style="border:1px solid #b1b1b1;">

						<table cellpadding="4" cellspacing="0" border="0" class="display" id="pages_table">
							<thead>
								<tr>
									<th style="width: 35%"><b><?= lang('pages.title');?></b></th>
									<th><b>idpag</b></th>
									<th style="width: 35%"><b><?= lang('pages.uri');?></b></th>
									<th style="width: 20%"><b><?= lang('language.name');?></b></th>
									<th>idlan</th>
									<th style="width: 10%"><b><?= lang('shop.actions');?></b></th>
					            </tr>
							</thead>
							<tbody>
								<tr>
									<td>loading..</td>
								</tr>
							</tbody>
							<tfoot>
								<tr>
									<th class="TextAlignLeft"><?= lang('pages.title');?></th>
									<th>idpag</th>
									<th class="TextAlignLeft"><?= lang('pages.uri');?></th>
									<th class="TextAlignLeft"><?= lang('language.name');?></th>
									<th>idlan</th>
									<th><?= lang('shop.actions');?></th>
					            </tr>
							</tfoot>
						</table>

						<div class="fila" align="left">
						<div class="form20per FloatLeft ma1000 pa1000">
							<input onclick="pages_viewedit(-1)" value="<?= lang('pages.addpage');?>" type="button" />
						</div>
						</div>
					</div><!--/Grid-->					
		</form>
	</div><!--/formPagesView!-->
	
</div><!--/contentform!-->

<!--DIALOG EDIT!-->
		<div id="dialog_cmseditadmin" title="<?= lang('shop.titdialognewedit');?>" style="display:none; overflow:hidden;">
		</div><!--/dialog!-->
<!--/DIALOG EDIT!-->

<!--DIALOG CONFIRMATION!-->
<div id="dialog_confirm_cmsadmin" title="<?= lang('shop.confirmation');?>" style="display:none;">
	<p>
		<span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
		<?= lang('shop.msgofdelete');?>
	</p>
</div>
<!--DIALOG CONFIRMATION PAGES!-->
<div id="dialog_confirm_cmsadminpages" title="<?= lang('shop.confirmation');?>" style="display:none;">
	<p>
		<span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
		<?= lang('shop.msgofdeletelanpages');?>
	</p>
</div>

<script type="text/javascript">
$(document).ready(function(){
    oAdminTableLanguage = $('#languages_table').dataTable({
        'bServerSide'    : true,
        'bAutoWidth'     : false,
		"bJQueryUI": true,
        'sPaginationType': 'full_numbers',
        'sAjaxSource': '/admin/language/listener',
        'aoColumns' : [
            { 'sName': 'short'},
            { 'sName': 'name'},
            { 'sName': 'id',"bSortable": false, 'bSearchable': false },
            { 'sName': 'idlan',"bSortable": false, 'bSearchable': false }
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
			{ "sClass": "TextAlignRight", "aTargets": [ ] }
		],
		"fnFooterCallback": function ( nRow, aaData, iStart, iEnd, aiDisplay ) {
			var selPagesForm=document.getElementById('cb_language');
			for(i=1;i<selPagesForm.options.length;i++){
				selPagesForm.options[i] = null;
			}
		/* Calculate the total market share for all browsers in this table (ie inc. outside
			 * the pagination)
			 */
//			var iTotalMarket = 0;
			for ( var i=0 ; i<aaData.length ; i++ )
			{
				var option2 = new Option(aaData[i][0]+" - "+aaData[i][1],aaData[i][3],"","");

				selPagesForm[i+1] = option2;
//				iTotalMarket += aaData[i][4]*1;
			}
		}
    });
	oAdminTableLanguage.fnSetColumnVis (3, false );//hide column 1 (begin 0)
	
    oAdminTablePages = $('#pages_table').dataTable({
        'bServerSide'    : true,
        'bAutoWidth'     : false,
		"bJQueryUI": true,
        'sPaginationType': 'full_numbers',
        'sAjaxSource': '/admin/pages/listener',
        'aoColumns' : [
            { 'sName': 'title'},
            { 'sName': 'idpag'},
            { 'sName': 'uri'},
            { 'sName': 'lanname'},
            { 'sName': 'idlan'},
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
			{ "sClass": "TextAlignLeft", "aTargets": [ 0,1,2 ] },
			{ "sClass": "TextAlignRight", "aTargets": [ ] }
		]
    });	
	oAdminTablePages.fnSetColumnVis (1, false );//hide column 1 (begin 0)
	oAdminTablePages.fnSetColumnVis (4, false );//hide column 3 (begin 0)

	$("input:button").button();

	$('#languages_table').styleTable({
		tr_hover_bgcolor: '#BCD4EC'
	});
	$('#pages_table').styleTable({
		tr_hover_bgcolor: '#BCD4EC'
	});

	$("#showLanguagesPanel").live("click", function () {
		//$("#formLanguageView").hide("fast");
		$("#formPagesView").hide("fast");

		$("#formLanguageView").show("fast");
	});
	$("#showPagesPanel").live("click", function () {
		$("#formLanguageView").hide("fast");
		//$("#formPagesView").hide("fast");
		
		oAdminTablePages.fnDraw();

		$("#formPagesView").show("fast");
	});
	
});

	function showPages(idLanguage){
		//config DataTable
		oAdminTablePages.fnFilter( idLanguage, 4 );
		//Refresh DataTable
		//oAdminTableProject.fnDraw();
	}
</script>