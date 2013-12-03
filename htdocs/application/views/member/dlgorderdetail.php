<style>
	#dlgdeliveryorderdetailtable_length select {width: auto !important;}
</style>
<!--DIALOG CONTENT DETAIL ITEM TO CART-->
    <div class="row">
        <div class="span6" id="form_orderdealer_content">
			<form accept-charset="UTF-8" class="form-horizontal cmxform" name="form_orderdealer" id="form_orderdealer" method="post" action="<?= base_url()?>order/ajaxaddorderdealer">
				<fieldset>
					<div class="control-group">
						<label for="idord_order_dealer_dialog" class="control-label"><?=lang('front.page.delivery.dialog.orderdealer.orden');?> </label>
						<div class="controls">
							<input type="text" id="idord_order_dealer_dialog" class="size20 bold" value="<?=$vorder->cod?>" READONLY>
							<input type="hidden" name="order_dealer[idorder]" value="<?=$vorder->id?>">
						</div>
					</div>
					<div class="control-group">
						<label for="codetaxi_order_dealer_dialog" class="control-label"><?=lang('front.page.delivery.dialog.orderdealer.codetaxi');?> <span class="required">*</span></label>
						<div class="controls">
							<input type="text" id="codetaxi_order_dealer_dialog" name="order_dealer[code_taxi]" value="1" maxlength="5" title="Ingresa el C&oacute;digo de Movil" placeholder="Ingresa el C&oacute;digo de Movil" required>
						</div>
					</div>
					<div class="control-group">
						<label for="price" class="control-label"><?=lang('front.page.delivery.dialog.orderdealer.price');?> <span class="required">*</span></label>
						<div class="controls">
							<input type="text" id="price" name="order_dealer[price]" value="1" maxlength="3" OnKeyUp="valNumber(this);" onBlur="setValidNumber(this);" title="Ingresa un precio valido, 1 - 100" required number="true" min="1" max="100">
						</div>
					</div>
					<div class="control-group">
						<label for="price" class="control-label">Tiempo Aprox. Minutos<span class="required">*</span></label>
						<div class="controls">
							<input type="text" id="price" name="order_dealer[trans_time]" value="30" maxlength="2" OnKeyUp="valNumber(this);" onBlur="setValidNumber(this);" title="Ingresa un tiempo valido, 1 - 120 minutos" required number="true" min="1" max="120">
						</div>
					</div>
					<div class="control-group">
						<label for="obs_order_dealer_dialog" class="control-label"><?=lang('front.page.delivery.dialog.orderdealer.obs');?> <span class="dialogSubMessage"></span></label>
						<div class="controls">
							<textarea rows="2" cols="40" id="obs_order_dealer_dialog" name="order_dealer[obs]"></textarea>
						</div>
					</div>
				</fieldset>
			</form>
        </div>

          <div id="step_3" class="pa1 ma1000">
<?/*			<h1 class="titlecolor"><?=lang('front.page.checkout.step3.title');?></h1>*/?>
			  <div class="cart-info row ma0010"><!--cart begin-->
				<table cellpadding="2" cellspacing="0" border="0" class="display table table-striped table-bordered" id="dlgdeliveryorderdetailtable">
					<thead>
					  <tr>
						<th class="image" style="width:5%"><?=lang('front.page.cart.table.image');?></th>
						<th class="name" style="width:10%"><?=lang('front.page.cart.table.menu');?></th>
						<th class="model" style="width:15%"><?=lang('front.page.cart.table.product');?></th>
						<th class="quantity TextAlignRight" style="width:5%"><?=lang('front.page.cart.table.qty');?></th>
						<th class="price TextAlignRight" style="width:10%"><?=lang('front.page.cart.table.price');?></th>
						<th class="price TextAlignRight" style="width:10%"><?=lang('front.page.cart.table.extraprice');?></th>
						<th class="total TextAlignRight" style="width:15%"><?=lang('front.page.cart.table.total');?></th>
					  </tr>
					</thead>
					<tbody>
						<tr>
							<td><?= lang('datatable.loading');?></td>
						</tr>
					</tbody>
<?/*					<tfoot>
						<tr>
							<th><?=lang('front.page.cart.table.image');?></th>
							<th><?=lang('front.page.cart.table.menu');?></th>
							<th><?=lang('front.page.cart.table.product');?></th>
							<th><?=lang('front.page.cart.table.qty');?></th>
							<th><?=lang('front.page.cart.table.price');?></th>
							<th><?=lang('front.page.cart.table.extraprice');?></th>
							<th><?=lang('front.page.cart.table.total');?></th>
						</tr>
					</tfoot>*/?>
				</table>
			  </div>
			  <div class="row">
				<div class="pull-right">
				  <div class="span4 pull-right">
					<table class="table table-striped table-bordered ">
					  <?/*<tr>
						<td><span class="extra bold">Sub-Total :</span></td>
						<td><span class="bold"><?= $currency?> <?= number_format ($subtotal, 2)?></span></td>
					  </tr>*/?>
					  <tr>
						<td><span class="extra bold totalamout">Total :</span></td>
						<td class="TextAlignRight"><span class="bold totalamout"><?= $currency?></span><span class="bold totalamout" id="totaltable">0.00</span></td>
					  </tr>
					</table>
<?/*					<input  onClick="changeStep(4);" type="button" value="<?=lang('front.page.checkout.button.continue');?>" class="btn btn-success pull-right">
					<input type="button" value="<?=lang('front.page.cart.continue');?>" class="btn btn-success pull-right mr10" onclick="goUrl('restaurant/<?=$city?>/<?= $rest?>');">*/?>
				  </div>
				</div>
			  </div> <!--end cart-->
          </div>
	</div>

<script language="javascript" type="text/javascript">
$(document).ready(function(){

    oFrontDlgTableDeliveryOrderDetail = $('#dlgdeliveryorderdetailtable').dataTable({
        'bServerSide'   : true,
        'bAutoWidth'    : true,
        'sPaginationType': 'full_numbers',
		"bFilter": false,
        'sAjaxSource': '<?=base_url()?>delivery/orderdetail/listener/<?=$vorder->id?>',
        'aoColumns' : [
            { 'sName': 'v_order_detail.image',"bSortable": false, 'bSearchable': false },
            { 'sName': 'v_order_detail.menuname'},
            { 'sName': 'v_order_detail.name'},
            { 'sName': 'v_order_detail.quantity'},
            { 'sName': 'v_order_detail.purchase_price'},
            { 'sName': 'v_order_detail.extra_price'},
            { 'sName': 'v_order_detail.subtotal'},
            { 'sName': 'v_order_detail.id',"bSortable": false, 'bSearchable': false },
            { 'sName': 'v_order_detail.idorder',"bSortable": false, 'bSearchable': false }
        ],
		"aaSorting": [[1, 'asc']],
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
			{ "sClass": "TextAlignLeft", "aTargets": [ 1,2 ] },
			{ "sClass": "TextAlignRight", "aTargets": [ 3,4,5,6 ] },
			{ "bSearchable": false, "bVisible": false, "aTargets": [ 7,8 ] }
		],
		"fnFooterCallback": function ( nRow, aaData, iStart, iEnd, aiDisplay ) {

			var iTotalCart = 0;
			
			for ( var i=0 ; i<aaData.length ; i++ )
			{
				iTotalCart += (aaData[i][6]*1);
			}
			
			if(aaData.length > 0){
				/* put information of restaurant and client */
				/*document.getElementById("totaltable").value = aaData[0][6];*/
				jQuery("#totaltable").html(iTotalCart);
			}else{
				/* put empty information  */
				/*document.getElementById("totaltable").value = '';*/
				jQuery("#totaltable").html();
			}
		}

    });

 
	

});

</script>
