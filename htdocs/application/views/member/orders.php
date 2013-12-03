<?php $uid = $this->session->userdata('uid'); ?>
<style>
	#ordermembertable_length select {width: auto !important;}
</style>
  <div class="container">

	<div class="row" id="mapMemberOrders">
		<div style="display:none">
			Modo de Viaje:
			<select id="modemapMemberOrders" onchange="refreshTableOrder();">
			  <option value="WALKING">Caminando</option>
			  <option value="DRIVING">Conduciendo</option>
			  <option value="BICYCLING">En bicicleta</option>
			  <option value="TRANSIT">Transito</option>
			</select>
		</div>
		<div id="mapMemberOrders_canvas" class="collapse in"></div>
		<div id="buttonCollapse">
			<button class="btn btn-success" style="width:100%;height:20px;padding:0;" onClick="changeHeightmapMemberOrders()"><i class="icon-chevron-down icon-white"></i></button>
		</div>
	</div>

    <div class="row">
      <div class="span12">
        <!-- Featured Product-->
        
        <section id="featured">
			<?/*<h1 class="headingfull" style="margin-bottom: 20px; margin-top: 15px;"><span>PANEL DE ADMINISTRACION DE SERVICIO DE TRANSPORTE</span></h1>*/?>

			<div id="errordiv" class="ui-widget" style="margin-top: 10px; display:none;">
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
			
<?/*			<form name="delivery_order_form" id="delivery_order_form" method="post">*/?>
					<div class="formshopgrid Border1px ui-corner-all pa1">
<?/*						<div class="ma0010">
							<a class="btn btn-success active" id="selectStatus1" href="javascript:void(0);" onClick="showOrderStatus('1');">Nuevos</a>
							<a class="btn btn-success" id="selectStatus2" href="javascript:void(0);" onClick="showOrderStatus('2');">Atendidos</a>
						</div>*/?>
						<table cellpadding="2" cellspacing="0" border="0" class="display table table-striped table-bordered" id="ordermembertable">
							<thead>
								<tr>
									<th width="5%"><b>Det</b></th>
									<th width="15%"><b>Orden</b></th>
									<th width="15%"><b>Fecha</b></th>
									<th width="25%"><b>Restaurant</b></th>
									<th width="5%"><b>Cant</b></th>
									<th width="10%"><b>Total</b></th>
									<th width="10%"><b>Trans. Bs.</b></th>
									<th width="10%"><b>Tiempo</b></th>
									<th width="5%" ><b>Estado</b></th>
									<th width="5%" ><b>Acciones</b></th>
									<th width="0%" ><b>branchphone</b></th>
									<th width="0%" ><b>branchlat</b></th>
									<th width="0%" ><b>branchlng</b></th>
									<th width="0%" ><b>branchadrr2</b></th>
									<th width="0%" ><b>branchuri</b></th>
									<th width="0%" ><b>fullname</b></th>
									<th width="0%" ><b>lastname</b></th>
									<th width="0%" ><b>addlat</b></th>
									<th width="0%" ><b>addlng</b></th>
									<th width="0%" ><b>address1</b></th>
									<th width="0%" ><b>address2</b></th>
									<th width="0%" ><b>phone</b></th>
									<th width="0%" ><b>extension</b></th>
									<th width="0%" ><b>mobile</b></th>
									<th width="0%" ><b>avatar</b></th>
									<th width="0%" ><b>code_taxi</b></th>
									<th width="0%" ><b>obs</b></th>
									<th width="0%" ><b>dealerlat</b></th>
									<th width="0%" ><b>dealerlng</b></th>
									<th width="0%" ><b>vouchercod</b></th>
									<th width="0%" ><b>vouchername</b></th>
									<th width="0%" ><b>vouchernit</b></th>
									<th width="0%" ><b>orderdetail</b></th>
									<th width="0%" ><b>idord</b></th>
					            </tr>
							</thead>
							<tbody>
								<tr>
									<td><?= lang('datatable.loading');?></td>
								</tr>
							</tbody>
							<tfoot>
								<tr>
									<th>Det</th>
									<th>Orden</th>
									<th>Fecha</th>
									<th>Restaurant</th>
									<th>Cant</th>
									<th>Total</th>
									<th>Trans. Bs.</th>
									<th>Tiempo</th>
									<th>Estado</th>
									<th>Acciones</th>
									<th>branchphone</th>
									<th>branchlat</th>
									<th>branchlng</th>
									<th>branchadrr2</th>
									<th>branchuri</th>
									<th>fullname</th>
									<th>lastname</th>
									<th>addlat</th>
									<th>addlng</th>
									<th>address1</th>
									<th>address2</th>
									<th>phone</th>
									<th>extension</th>
									<th>mobile</th>
									<th>avatar</th>
									<th>code_taxi</th>
									<th>obs</th>
									<th>dealerlat</th>
									<th>dealerlng</th>
									<th>vouchercod</th>
									<th>vouchername</th>
									<th>vouchernit</th>
									<th>orderdetail</th>
									<th>idord</th>
					            </tr>
							</tfoot>
						</table>

						<div class="fila" align="left">
							<div class="form15per FloatLeft ma1000 pa1000">
<?/*								<input onclick="v_item_edit(-1)" value="Nueva Orden" type="button" />*/?>
								<input class="btn btn-success" onclick="refreshTableOrder()" value="Refrescar Datos" type="button" />
								
							</div>
						</div>
						<div class="clear"></div>
					</div><!--/Grid-->					
<?/*			</form>*/?>

		</section>
        <!-- Latest Product-->
        
        <section id="latest">
		  <?/*<h1 class="headingfull"><span><?=lang('front.page.welcome.restaurant.new.title');?></span></h1>*/?>
        </section>
      </div>
      
    </div>
  </div>

<!--DIALOG DETAIL ITEM TO CART-->
<div id="dialog_confirm_orderdealer" title="Atender Pedido" style="display:none;">
</div>

<!--DIALOG CONFIRMATION!-->
<div id="dialog_confirm_order" title="Confirmaci&oacute;n" style="display:none;">
	<p>
		<span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
		Usted esta seguro de eliminar el registro seleccionado?
	</p>
</div>

<!--DIALOG ERROR!-->
<div id="dialog_error_order" title="Alerta" style="display:none;">
	<p>
		<span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
		No es posible eliminar el registro actual
	</p>
</div>

<script language="javascript" type="text/javascript">
  var directionsService = new google.maps.DirectionsService();
  var mapMemberOrders;
  
    function initializemapMemberOrders(restlat,restlng,clientlat,clientlng) {

		directionsDisplay = new google.maps.DirectionsRenderer();
	
		if((clientlat != '') && (clientlng != '')){
			var mapMemberOrdersOptions = {
			  zoom: 15,
			  center: new google.maps.LatLng(((restlat*1)+(clientlat*1))/2,((restlng*1)+(clientlng*1))/2),
			  mapTypeId: google.maps.MapTypeId.ROADMAP
			}
		}else{
			var mapMemberOrdersOptions = {
			  zoom: 15,
			  center: new google.maps.LatLng(restlat,restlng),
			  mapTypeId: google.maps.MapTypeId.ROADMAP
			}
		}
		
        mapMemberOrders = new google.maps.Map(document.getElementById('mapMemberOrders_canvas'), mapMemberOrdersOptions);
									  
		directionsDisplay.setMap(mapMemberOrders);

		//RESTAURANT PIN
        var image = '<?= base_url()?>images/maps/icons/fastfood.png';
        var myLatLng = new google.maps.LatLng(restlat,restlng);
        var restaurantMarker = new google.maps.Marker({
            position: myLatLng,
            map: mapMemberOrders,
			center: myLatLng,
            icon: image
        });
		
        google.maps.event.addListener(restaurantMarker, 'click', function() {
          infowindow.open(mapRoute,restaurantMarker);
        });
    };

	function calcRoute(restlat,restlng,clientlat,clientlng) {
		var selectedMode = document.getElementById('modemapMemberOrders').value;
		var request = {
			origin: new google.maps.LatLng(restlat,restlng),
			destination: new google.maps.LatLng(clientlat,clientlng),
			// Note that Javascript allows us to access the constant
			// using square brackets and a string value as its
			// "property."
			travelMode: google.maps.TravelMode[selectedMode]
		};
		
		directionsService.route(request, function(response, status) {
		  if (status == google.maps.DirectionsStatus.OK) {
			directionsDisplay.setDirections(response);
		  }
		});
	};

	function changeHeightmapMemberOrders(){
		if(document.getElementById("mapMemberOrders_canvas").style.height == "300px"){
			document.getElementById("mapMemberOrders_canvas").style.height="600px";
			document.getElementById('buttonCollapse').innerHTML = "<button class='btn btn-success' style='width:100%;height:20px;padding:0;' onClick='changeHeightmapMemberOrders()'><i class='icon-chevron-up icon-white'></i></button>";
		}else{
			document.getElementById("mapMemberOrders_canvas").style.height="300px";
			document.getElementById('buttonCollapse').innerHTML = "<button class='btn btn-success' style='width:100%;height:20px;padding:0;' onClick='changeHeightmapMemberOrders()'><i class='icon-chevron-down icon-white'></i></button>";
		}
	};

/*	function resetForm(idform){
		$('#'+idform).each (function(){
		  this.reset();
		});
	};
*/
/* DATATABLE CODE */
var oAdminTableMemberOrder;
 
/* Formating function for row details */
function fnFormatDetails ( nTr )
{
    var aData = oAdminTableMemberOrder.fnGetData( nTr );
    var sOut = '<div class="frame45per ma0100">';
    sOut += '<table class="fullWidthInput" cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
    sOut += '<tr><td><b>Restaurante:</b></td><td>'+aData[3]+'</td></tr>';
    sOut += '<tr><td><b>Direcci&oacute;n:</b></td><td>'+aData[13]+' '+aData[14]+'</td></tr>';
    sOut += '<tr><td><b>Tel&eacute;fono:</b></td><td>'+aData[10]+'</td></tr>';
    sOut += '<tr><td><b>Pedido:</b></td><td><textarea class="fullWidthInput" rows="3" cols="50" DISABLED>'+aData[33]+'</textarea></td></tr>';
    sOut += '</table>';
    sOut += '</div>';
	
    sOut += '<div class="frame50per">';
    sOut += '<table class="fullWidthInput" cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
    sOut += '<tr><td rowspan="5" style="padding-top:10px">'+aData[25]+'</td></tr>';
    sOut += '<tr><td><b>Nombre Completo:</b></td><td>'+aData[16]+'</td></tr>';
    sOut += '<tr><td><b>Direcci&oacute;n:</b></td><td>'+aData[20]+' '+aData[21]+'</td></tr>';
    sOut += '<tr><td><b>Celular:</b></td><td>'+aData[24]+'</td></tr>';
    sOut += '<tr><td><b>Tel&eacute;fono:</b></td><td>'+aData[22]+'</td></tr>';
    sOut += '</table>';
    sOut += '</div>';
     
    return sOut;
}

$(document).ready(function(){

    oAdminTableMemberOrder = $('#ordermembertable').dataTable({
        'bServerSide'   : true,
        'bAutoWidth'    : true,
        'sPaginationType': 'full_numbers',
        'sAjaxSource': '<?=base_url()?>member/order/listener',
        'aoColumns' : [
            { 'sName': 'v_orders.viewdetail',"bSortable": false, 'bSearchable': false },
            { 'sName': 'v_orders.cod'},
            { 'sName': 'v_orders.date_reg'},
            { 'sName': 'v_orders.branchname'},
            { 'sName': 'v_orders.qty_items'},
            { 'sName': 'v_orders.sum_order'},
            { 'sName': 'v_orders.deliveryprice'},
            { 'sName': 'v_orders.deliverytrans_time'},
            { 'sName': 'v_orders.status'},
            { 'sName': 'v_orders.id',"bSortable": false, 'bSearchable': false },
            { 'sName': 'v_orders.branchphone'},
            { 'sName': 'v_orders.branchlat'},
            { 'sName': 'v_orders.branchlng'},
            { 'sName': 'v_orders.branchadrr1'},
            { 'sName': 'v_orders.branchadrr2'},
            { 'sName': 'v_orders.branchuri'},
            { 'sName': 'v_orders.fullname'},
            { 'sName': 'v_orders.lastname'},
            { 'sName': 'v_orders.addlat'},
            { 'sName': 'v_orders.addlng'},
            { 'sName': 'v_orders.address1'},
            { 'sName': 'v_orders.address2'},
            { 'sName': 'v_orders.phone'},
            { 'sName': 'v_orders.extension'},
            { 'sName': 'v_orders.mobile'},
            { 'sName': 'v_orders.avatar'},
            { 'sName': 'v_orders.code_taxi'},
            { 'sName': 'v_orders.obs'},
            { 'sName': 'v_orders.dealerlat'},
            { 'sName': 'v_orders.dealerlng'},
            { 'sName': 'v_orders.vouchercod'},
            { 'sName': 'v_orders.vouchername'},
            { 'sName': 'v_orders.vouchernit'},
            { 'sName': 'v_orders.orderdetail'},
            { 'sName': 'v_orders.idord'}
        ],
		"aaSorting": [[2, 'asc']],
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
			{ "sClass": "TextAlignLeft", "aTargets": [ 1,2,3 ] },
			{ "sClass": "TextAlignRight", "aTargets": [ 4,5,6,7 ] },
			{ "bSearchable": false, "bVisible": false, "aTargets": [ 10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34 ] }
		],
		"fnFooterCallback": function ( nRow, aaData, iStart, iEnd, aiDisplay ) {

			if(aaData.length > 0){
				initializemapMemberOrders(aaData[0][11],aaData[0][12],aaData[0][18],aaData[0][19],aaData[0][16]);
				calcRoute(aaData[0][11],aaData[0][12],aaData[0][18],aaData[0][19]);
			}else{
				<?php if((isset($dealer))&&(!empty($dealer))){?>
					initializemapMemberOrders('<?=$dealer->lat;?>','<?=$dealer->lng;?>','','');
				<?php }else{?>
					initializemapMemberOrders('-17.383283','-66.160238','','');
				<?php }?>
			}
		}

    });

});
	
function refreshTableOrder()
{
    oAdminTableMemberOrder.fnDraw();
};

function v_orders_asignDealer()
{
	<? if(isset($uid) && ($uid > 0)){?>
	
	//$("#dialog_confirm_orderdealer").dialog("destroy");
	var numorder = document.getElementById("numberorder").value;

	if(parseInt(numorder) > 0){
		$.ajax({
			type: "post",
			url: "<?=base_url()?>delivery/order/ajaxloadordtodealer",
			dataType: "html",
			data: { 'id' : numorder, 'rnd': new Date().getTime() },
			async: false,
			success: function(data) {
				$("#dialog_confirm_orderdealer").html(data);

				$("#dialog_confirm_orderdealer").dialog({
					resizable: false,
					height:'auto',
					width:'800',
					modal: true,
					/*title: dialogtitle,*/
					buttons: {
						"<?=lang('front.page.delivery.dialog.orderdealer.save');?>": function() {
							if(!$("#form_orderdealer").valid()){
								return false;
							}
							
							$( this ).dialog( "close" );
							$.ajax({
								type: "post",
								url: "<?=base_url()?>delivery/order/ajaxaddorderdealer" ,
								dataType: "json",
								data: $('#form_orderdealer').serialize(),
								success: function(data) {
									oAdminTableMemberOrder.fnDraw();
									 
									//window.location="<?=base_url()?>cart";
									//loadcartrail('<?= $this->session->userdata('idprofile')?>');
								}
							});
						},
						"<?=strtoupper(lang('front.common.cancel'));?>": function() {
							$( this ).dialog( "close" );
						}
					}
				});
				$("#form_orderdealer").validate();
			}
		});  
		$('#dialog_confirm_orderdealer').dialog('open');
	}
	<? }else{?>
			goUrl('user/login');
	<? }?>
};

function v_orders_asignDealerTable(numorder)
{
	<? if(isset($uid) && ($uid > 0)){?>
	
	//$("#dialog_confirm_orderdealer").dialog("destroy");

	if(parseInt(numorder) > 0){
		$.ajax({
			type: "post",
			url: "<?=base_url()?>delivery/order/ajaxloadordtodealer",
			dataType: "html",
			data: { 'id' : numorder, 'rnd': new Date().getTime() },
			async: false,
			success: function(data) {
				$("#dialog_confirm_orderdealer").html(data);

				$("#dialog_confirm_orderdealer").dialog({
					resizable: false,
					height:'auto',
					width:'800',
					modal: true,
					/*title: dialogtitle,*/
					buttons: {
						"<?=lang('front.page.delivery.dialog.orderdealer.save');?>": function() {
							if(!$("#form_orderdealer").valid()){
								return false;
							}
							
							$( this ).dialog( "close" );
							$.ajax({
								type: "post",
								url: "<?=base_url()?>delivery/order/ajaxaddorderdealer" ,
								dataType: "json",
								data: $('#form_orderdealer').serialize(),
								success: function(data) {
									oAdminTableMemberOrder.fnDraw();
									 
									//window.location="<?=base_url()?>cart";
									//loadcartrail('<?= $this->session->userdata('idprofile')?>');
								}
							});
						},
						"<?=strtoupper(lang('front.common.cancel'));?>": function() {
							$( this ).dialog( "close" );
						}
					}
				});
				$("#form_orderdealer").validate();
			}
		});  
		$('#dialog_confirm_orderdealer').dialog('open');
	}
	<? }else{?>
			goUrl('user/login');
	<? }?>
};

function showOrderStatus(status) {
/*	$.cookie("pidamosorderstatus", status, { expires: 1, path: '/' });*/
	oAdminTableMemberOrder.fnDraw();
	$('#selectStatus1').removeClass('active');
	$('#selectStatus2').removeClass('active');
/*	$('#selectStatus3').removeClass('active');
	$('#selectStatus4').removeClass('active');*/
	$('#selectStatus'+status).addClass('active');
};


</script>
