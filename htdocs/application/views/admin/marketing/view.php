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

<div class="contentform">
	<div class="navigationpanel ui-corner-all">
		<div class="ui-widget-header-navigation-panel ui-corner-all">
		</div>
		<a href="javascript:void(0);" id="showNewsletterPanel"><?= lang('marketing.shownews');?></a><br />
		<a href="javascript:void(0);" id="showMailingPanel"><?= lang('marketing.showmailinglist');?></a><br />
	</div>
	<div class="form80per" id="newsletterPanel">
		<h3><?= lang('marketing.shownews');?></h3>
		<form name="newsletterList-form" id="newsletterList-form" method="post">
        	<div class="formshopgrid ui-corner-all pa1" style="border:1px solid #b1b1b1;">
						<table border="0" cellpadding="4" cellspacing="0" align="center" width ="98%" class="display" id="newsletter_table">
							<thead>
								<tr>
									<th><b><?= lang('newsletter.coltitle');?></b></th>
									<th><b><?= lang('newsletter.inidate');?></b></th>
									<th><b><?= lang('newsletter.enddate');?></b></th>
									<th><b><?= lang('orders.actions');?></b></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><?= lang('marketing.loading');?>..</td>
								</tr>
							</tbody>
                            <tfoot>
								<tr>
									<th class="TextAlignLeft"><b><?= lang('newsletter.coltitle');?></b></th>
									<th class="TextAlignLeft"><b><?= lang('newsletter.inidate');?></b></th>
									<th class="TextAlignLeft"><b><?= lang('newsletter.enddate');?></b></th>
                                    <th><b><?= lang('orders.actions');?></b></th>
					            </tr>
							</tfoot>
						</table>
                    </div>
					<br /><br />

					<div class="fila" align="left">
					<div class="col" style="width:50px" align="left">
						<input onclick="newsletteredit(false)" value="<?= lang('newsletter.additem');?>" type="button" />
					</div>
					</div>
		</form>
	</div>
	
    <div class="form80per" id="SendNewsletterPanel" style="display:none">
    </div>
	<div class="form80per" id="NewsletterSentPanel" style="display:none">
		<h3><?= lang('newsletter.formtitle');?></h3>
		<div class="fila" align="left">
			<div style="padding: 10px 0px; width: 60%;">
				<div id="statusdiv" class="ui-widget">
					<div style="padding: 0 .7em;" class="ui-state-highlight ui-corner-all"> 
						<p>
						<span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>
						<strong><?= lang('newsletter.donetitle');?></strong>
						<span id="sendmsg"></span>
						</p>
					</div>
				</div>
			</div>
		</div>
		<div class="fila">
			<div class="col" style="width:100%">
				<select name="newslettersent[]" style="width:300px" id="combo_newslettersent" multiple="true" size="15">

				</select>
			</div>
		</div>
		<div class="fila" align="left">
			<div class="col" style="padding:10px 0px; text-align:center">
				<input onclick="closenewslettersent()" id="NewsletterSentSubmit" value="OK" type="button" />
			</div>
		</div>
	</div>
    
    <div class="form80per" id="mailingPanel" style="display:none">
		<h3><?= lang('mailinglist.formtitle');?></h3>
		<form name="mailinglistview-form" id="mailinglistview-form" method="post">
        	<div class="formshopgrid ui-corner-all pa1" style="border:1px solid #b1b1b1;">
				<table border="0" cellpadding="4" cellspacing="0" align="center" width="98%" class="display" id="mailing_table">
					<thead>
						<tr>
							<th><b><?= lang('mailinglist.colname');?></b></th>
							<th><b><?= lang('mailinglist.colemail');?></b></th>
							<th><b><?= lang('mailinglist.colcountry');?></b></th>
							<th><b><?= lang('mailinglist.colsubscribed');?></b></th>
							<th><b><?= lang('orders.actions');?></b></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?= lang('marketing.loading');?>..</td>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<th class="TextAlignLeft"><b><?= lang('mailinglist.colname');?></b></th>
							<th class="TextAlignLeft"><b><?= lang('mailinglist.colemail');?></b></th>
							<th class="TextAlignLeft"><b><?= lang('mailinglist.colcountry');?></b></th>
							<th><b><?= lang('mailinglist.colsubscribed');?></b></th>
							<th><b><?= lang('orders.actions');?></b></th>
						</tr>
					</tfoot>
				</table>
			</div>
		</form>
	</div>
    
</div>
<!--DIALOG ADD/EDIT -->
<div id="dialog_mailingedit" title="<?= lang('marketing.addedit')?>" style="display:none"></div>
<!--/dialog!-->
<!--DIALOG CONFIRMATION!-->
<div id="dialog-confirm" title="<?= lang('shop.confirmation');?>" style="display:none">
	<p>
		<span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
		<?= lang('shop.msgofdelete');?>
	</p>
</div>

<div id="dialog-confirm-newsletter" title="<?= lang('newsletter.confirmation');?>" style="display:none">
	<p>
		<span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
		<?= lang('newsletter.msgofdelete');?>
	</p>
</div>
<script type="text/javascript">
function saveformcustomer()
{
	$('#mailinglist-form').submit();
}

function closeformcustomer()
{
	$('#dialog_mailingedit').dialog('close');
}

function closenewslettersent()
{
	$('#SendNewsletterPanel').fadeOut('slow');
	//$("#SendNewsletterPanel").empty();
	$("#showNewsletterPanel").click();
}

$(document).ready(function()
{
	var editorName = 'ckeditornewsletter_';
	if (CKEDITOR.instances[editorName]) {
		CKEDITOR.remove(CKEDITOR.instances[editorName]);
	}

	$('#addBanner').click(function(){
		$('#dialog').dialog('open');
	});	

	$('#mailing_table').styleTable({
		tr_hover_bgcolor: '#BCD4EC'
	});
	
	oAdminTableNewsletter = $('#newsletter_table').dataTable({
        'bServerSide'    : true,
        'bAutoWidth'     : false,
		"bJQueryUI": true,
        'sPaginationType': 'full_numbers',
        'sAjaxSource': '/admin/marketing/listener',
        /*'aaSorting': [ [0,'asc'] ],*/
		'aoColumns' : [
            { 'sName': 'title'},
            { 'sName': 'ini_date'},
            { 'sName': 'end_date'},
            { 'sName': 'id', 'bSearchable': false, 'bSortable': false }
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
			{ "sClass": "TextAlignLeft", "aTargets": [ 0,1,2 ] }
		]
    });

	oAdminTableMailing = $('#mailing_table').dataTable({
        'bServerSide'    : true,
        'bAutoWidth'     : false,
		"bJQueryUI": true,
        'sPaginationType': 'full_numbers',
        'sAjaxSource': '/admin/marketing/listenerMailing',
        /*'aaSorting': [ [0,'asc'] ],*/
		'aoColumns' : [
            { 'sName': 'name', 'bSearchable': true, 'bSortable': true},
            { 'sName': 'email', 'bSearchable': true, 'bSortable': true},
            { 'sName': 'country', 'bSearchable': true, 'bSortable': true},
			{ 'sName': 'subscribed', 'bSearchable': true, 'bSortable': true},
			{ 'sName': 'id', 'bSearchable': false, 'bSortable': false }
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
			{ "sClass": "TextAlignLeft", "aTargets": [ 0,1,2 ] }
		]		
    });

	$("input:button").button();

	$("#showNewsletterPanel").live("click", function () {
		$("#mailingPanel").hide("fast");
		$("#SendNewsletterPanel").hide("fast");
		$("#NewsletterSentPanel").hide("fast");		
		$("#newsletterPanel").show("fast");
		oAdminTableNewsletter.fnDraw();
	});
	
	$("#showMailingPanel").live("click", function () {
		$("#newsletterPanel").hide("fast");
		$("#SendNewsletterPanel").hide("fast");
		$("#NewsletterSentPanel").hide("fast");
		$("#mailingPanel").show("fast");
		oAdminTableMailing.fnDraw();
	});	
	
	$("#addNewsletter").live("click", function () {
		$("#newsletterPanel").hide("fast");
		$("#mailingPanel").hide("fast");
		//$("#SendNewsletterPanel").show("fast");
	});

	$('#newsletter_table').styleTable({
		tr_hover_bgcolor: '#BCD4EC'
	});
});
</script>