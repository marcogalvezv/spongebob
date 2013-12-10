<style>
    #map-canvas-booking {
        background: #000066;
        margin: 0;
        padding: 0;
        height: 500px;
        width: 500px;
    }
</style>
<article class="module width_full">
<header><h3>Editar Solicitud</h3></header>

<div id="dialog_addressTaxi" title="<?= lang('users.tab.dialog.title');?>" style="display:none; overflow:hidden;">
    <div class="mws-panel grid_8">
        <form name="admin_members_form" id="admin_members_form" method="post" class="mws-form">
            <div class="mws-panel-header">
                <span><i class="icon-table"></i>Direcciones</span>
            </div>
            <div class="mws-panel-body no-padding">
                <table class="mws-table" id="v_addresstaxi">
                    <thead>
                    <tr>
                        <th "width: 5%"><?= lang('users.tab.select');?></th>
                        <th "width: 15%">Numero</th>
                        <th "width: 15%">Placa</th>
                        <th "width: 15%">Color</th>
                        <th "width: 30%">Estado</th>
                        <th "width: 15%">Descripcion</th>
                        <th "width: 18%">Conductor</th>
                        <th "width: 18%">Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><?= lang('datatable.loading');?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div><!--/dialog!-->



<div id="dialog_addressSearch" title="<?= lang('users.tab.dialog.title');?>" style="display:none; overflow:hidden;">
    <div class="mws-panel grid_8">
        <form name="admin_members_form" id="admin_members_form" method="post" class="mws-form">
            <div class="mws-panel-header">
                <span><i class="icon-table"></i>Direcciones</span>
            </div>
            <div class="mws-panel-body no-padding">
                <table class="mws-table" id="v_addressbooking">
                    <thead>
                    <tr>
                        <th "width: 5%"><?= lang('users.tab.select');?></th>
                        <th "width: 15%">Nombre</th>
                        <th "width: 15%">Latitud</th>
                        <th "width: 15%">Longitud</th>
                        <th "width: 30%">Descripcion</th>
                        <th "width: 15%">Telefono</th>
                        <th "width: 18%">Opciones</th>

                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><?= lang('datatable.loading');?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div><!--/dialog!-->

<div class="mws-panel grid_8 mws-collapsible">
    <div class="mws-panel-header">
        <span><i class="icon-ok"></i>Solicitud </span>
    </div>
    <div class="mws-panel-inner-wrap">
        <div class="mws-panel-body no-padding">
            <form id="booking-form" class="mws-form" action="form_elements.html">
                <div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>
                <fieldset class="mws-form-inline">
                    <legend>Cliente</legend>
                    <div class="mws-form-cols">
                        <div class="mws-form-col-4-8">
                            <div class="mws-form-row">
                                <label class="mws-form-label"><?= lang('users.tab.dialog.phone'); ?></label>


                                <div class="mws-form-item">
                                    <input type="text" name="address[phone]" class="required small"
                                           id="txt_phone" title="<?= lang('dialog.fieldrequired'); ?>"
                                           value="<?php if (isset($address)) {
                                               $numberString = ($address->phone > 0) ? $address->phone : 'Sin - Numero';
                                               echo $numberString;
                                           } ?>" required/>
                                </div>

                            </div>
                            <div class="mws-form-row">
                                <label class="mws-form-label"><?= lang('users.tab.dialog.firstname'); ?></label>

                                <div class="mws-form-item">
                                    <input type="text" name="profileclient[firstname]" class="required small"
                                           id="txt_firstname" title="<?= lang('dialog.fieldrequired'); ?>"
                                           value="<?php if (isset($profileclient)) echo $profileclient->firstname . " " . $profileclient->lastname ?>"
                                           required/>
                                </div>
                            </div>
                            <div class="mws-form-row">
                                <label class="mws-form-label">Latitud</label>

                                <div class="mws-form-item">
                                    <input type="text" name="address[lat]" class="required small" id="txt_latitude"
                                           title="<?= lang('dialog.fieldrequired'); ?>"
                                           value="<?php if (isset($address)) echo $address->lat ?>" required/>
                                </div>
                            </div>
                            <div class="mws-form-row">
                                <label class="mws-form-label">Longitud</label>

                                <div class="mws-form-item">
                                    <input type="text" name="address[lng]" class="required small" id="txt_longitude"
                                           title="<?= lang('dialog.fieldrequired'); ?>"
                                           value="<?php if (isset($address)) echo $address->lng ?>" required/>
                                </div>
                            </div>
                            <div class="mws-form-row">
                                <label class="mws-form-label">Descripcion</label>

                                <div class="mws-form-item">
                                    <textarea rows="" cols="" class="small"
                                              id="txtDescription"><?php if (isset($address)) echo $address->address1 ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="mws-form-col-4-8">

                            <div class="mws-form-row">
                                <div id="map-canvas-booking"></div>
                            </div>
                            <div class="mws-form-row">
                                <div class="mws-form-col-6-6">
                                    <div class="mws-form-item">
                                        <input class="btn " value="Buscar" type="button"
                                               onclick="openSearchDireccion()">
                                    </div>
                                </div>
                                <div class="mws-form-col-6-6">
                                    <div class="mws-form-item">
                                        <input class="btn " value="Agregar" type="button"
                                               onclick="openSearchDireccion()">
                                    </div>
                                </div>
                            </div>
                        </div>

                </fieldset>
                <fieldset class="mws-form-inline">
                    <legend>Taxi</legend>
                    <div class="mws-form-row">
                        <div class="mws-form-cols">
                            <div class="mws-form-col-4-8">
                                <div class="mws-form-row">
                                    <label class="mws-form-label">Numero de Movil</label>

                                    <div class="mws-form-item">
                                        <input type="text" name="taxi[number]" class="required small"
                                               id="txt_number"
                                               title="<?= lang('dialog.fieldrequired'); ?>"
                                               value="<?php if (isset($taxi)) echo $taxi->number ?>" required/>
                                    </div>
                                </div>
                                <div class="mws-form-row">
                                    <label class="mws-form-label">Placa</label>

                                    <div class="mws-form-item">
                                        <input type="text" name="taxi[plate]" class="required small"
                                               id="txt_taxiplate"
                                               title="<?= lang('dialog.fieldrequired'); ?>"
                                               value="<?php if (isset($taxi)) echo $taxi->plate ?>" required/>
                                    </div>
                                </div>
                                <div class="mws-form-row">
                                    <label class="mws-form-label">Color</label>

                                    <div class="mws-form-item">
                                        <input type="text" name="taxi[taxicolor]" class="required small"
                                               id="txt_taxicolor"
                                               title="<?= lang('dialog.fieldrequired'); ?>"
                                               value="<?php if (isset($taxi)) echo $taxi->taxicolor ?>" required/>
                                    </div>
                                </div>
                                <div class="mws-form-row">
                                    <label class="mws-form-label"><?= lang('users.tab.dialog.firstname'); ?>
                                        Conductor</label>

                                    <div class="mws-form-item">
                                        <input type="text" name="profiledriver[name]" class="required small"
                                               id="txt_drivername" title="<?= lang('dialog.fieldrequired'); ?>"
                                               value="<?php if
                                               (isset($profiledriver)
                                               ) echo $profiledriver->firstname . " " . $profiledriver->lastname ?>"
                                               required/>
                                    </div>
                                </div>


                            </div>
                            <div class="mws-form-col-4-8">
                                <div class="mws-form-row">
                                        <span class="thumbnail"><img
                                                src="<?php if (isset($taxi)) echo base_url().$taxi->taxiphoto ?>" alt=""
                                                id="sp_taxiphoto"></span>
                                </div>
                                <div class="mws-form-row">
                                        <span class="thumbnail"><img
                                                src="<?php if (isset($profiledriver)) echo base_url().$profiledriver->avatar ?>"
                                                alt="" id="sp_driveravatar"></span>
                                </div>
                                <div class="mws-form-row">
                                    <div class="mws-form-col-6-6">
                                        <div class="mws-form-item">
                                            <input class="btn " value="Buscar" type="button"
                                                   onclick="openSearchTaxi()">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <div class="mws-form-row">
                    <label class="mws-form-label">Estado de la Reserva</label>

                    <div class="mws-form-item">
                        <select name="booking[status]" class="required small" id="cb_status"
                                title="<?= lang('dialog.fieldrequired'); ?>">
                            <option value="1" <? if (isset($booking) && ($booking->status == 1)) {
                                echo "selected='selected'";
                            }?>><?= "Sin asignar"; ?></option>
                            <option value="2" <? if (isset($booking) && ($booking->status == 2)) {
                                echo "selected='selected'";
                            }?>><?= "Taxi Asignado"; ?></option>
                            <option value="3" <? if (isset($booking) && ($booking->status == 3)) {
                                echo "selected='selected'";
                            }?>><?= "Esperando pasajero"; ?></option>
                            <option value="4" <? if (isset($booking) && ($booking->status == 4)) {
                                echo "selected='selected'";
                            }?>><?= "En Progreso"; ?></option>
                            <option value="5" <? if (isset($booking) && ($booking->status == 5)) {
                                echo "selected='selected'";
                            }?>><?= "Terminada"; ?></option>
                            <option value="6" <? if (isset($booking) && ($booking->status == 6)) {
                                echo "selected='selected'";
                            }?>><?= "Cancelada"; ?></option>
                        </select>
                    </div>
                </div>
                <div class="mws-button-row">
                        <input type='hidden' name='booking[id]' value="<? if (isset($booking)) { echo $booking->id; }?>"/>
                        <input type='hidden' name='address[id]' value="<? if (isset($address)) { echo $address->id; } ?>" id="addressId"/>
                        <input type='hidden' name='taxi[id]' value="<? if (isset($taxi)) { echo $taxi->id; } ?>" id="taxiId"/>
                    <input class="btn btn-danger" value="<?= lang('users.tab.dialog.save'); ?>" type="button"
                           onclick="save()">
                </div>

            </form>
        </div>
    </div>
</div>

</article>


<script type="text/javascript">

var editBookingTaxiMarkers = new Array();
var marker;
var boookingMap;
$(document).ready(function () {
    initializeSearchAddress();
    initializeSearchTaxi();
    // Validation
    if ($.validator) {
        $("#booking-form").validate({
            rules: {
                spinner: {
                    required: true,
                    max: 5
                }
            },
            invalidHandler: function (form, validator) {
                var errors = validator.numberOfInvalids();
                if (errors) {
                    var message = errors == 1 ? 'Un campo no fue llenado, el campo fue resaltado' : errors + ' campos no fueron llenados . Fueron Resaltados';
                    $("#mws-validate-error").html(message).show();
                } else {
                    $("#mws-validate-error").hide();
                }
            }
        });
    }



    boookingMap = initializeBookingMap();


    <?php if (isset($address)) {
        //drawing client marker
        echo "marker = drawMarker(boookingMap, true,". $address->lat . ", " .$address->lng. ", 'icon-dex-littleguy.png', true, '". $profileclient->firstname ." ".$profileclient->lastname."' );";
        echo "drawAssignedTaxiMarker(boookingMap,". $booking->idtaxi.");";
        echo "reloadAssignedTaxiMarker(boookingMap, ".$booking->idtaxi.");";
    }
    else{
        //drawing client marker
        echo "marker = drawMarker(boookingMap, true, -17.3830370000 , -66.1453570000 , 'icon-dex-littleguy.png', true, '');";
        echo "drawTaxiMarkersBooking(boookingMap);";
       echo "reloadTaxiMarkersBooking(boookingMap);";
    }?>


});

function initializeBookingMap() {
    var myLatlng = new google.maps.LatLng(-17.3830370000, -66.1453570000);
    var mapOptions = {
        zoom: 16,
        center: myLatlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    var map = new google.maps.Map(document.getElementById('map-canvas-booking'),
        mapOptions);
    return map;
}

function drawAssignedTaxiMarker(mapToDraw, taxiId) {
    var taxiUrl = 'radiotaxi/taxi/getTaxi/' + taxiId;
    console.log(taxiUrl);

    $.getJSON('<?= base_url()?>' + taxiUrl, function (data) {
        var taxiLocation = data;
        console.log('edit booking taxis to draw');
        console.log(taxiLocation);
        console.log('edit booking drawing marker');
        var taxiMarker = drawMarker(mapToDraw, false, taxiLocation['lat'], taxiLocation['lng'], 'taxi.png', false, 'Movil:' + taxiLocation['number']);
        editBookingTaxiMarkers.push(taxiMarker);
    });
}


function drawTaxiMarkersBooking(mapToDraw) {
    var taxiUrl = 'radiotaxi/taxi/getActiveTaxis';
    console.log(taxiUrl);

    $.getJSON('<?= base_url()?>' + taxiUrl, function (data) {
        var taxiLocations = data;
        console.log('edit booking taxis to draw');
        console.log(taxiLocations);
        for (i = 0; i < taxiLocations.length; i++) {
            console.log('edit booking drawing marker');
            var taxiMarker = drawMarker(mapToDraw, false, taxiLocations[i]['lat'], taxiLocations[i]['lng'], 'taxi.png', false, 'Movil:' + taxiLocations[i]['number']);
            editBookingTaxiMarkers.push(taxiMarker);
        }
    });
}

function reloadTaxiMarkersBooking(mapToDraw) {
    setInterval(function () {
        console.log('trying to clean');
        cleanMarkers(editBookingTaxiMarkers);
        drawTaxiMarkersBooking(mapToDraw);
    }, 3000);
}

function reloadAssignedTaxiMarker(mapToDraw, idTaxi) {
    setInterval(function () {
        console.log('trying to clean');
        cleanMarkers(editBookingTaxiMarkers);
        drawAssignedTaxiMarker(mapToDraw, idTaxi);
    }, 3000);
}

function drawMarker(mapToDraw, dragable, lat, lng, icon, moveMap, title) {
    var iconBase = '<?= base_url();?>images/admin/mapicons/';
    var newMarker = new google.maps.Marker({
        position: new google.maps.LatLng(lat, lng),
        icon: iconBase + icon,
        draggable: dragable,
        title: title,
        map: mapToDraw
    });
    console.log('Moving Map?');
    console.log(moveMap);
    if (moveMap)
        mapToDraw.setCenter(new google.maps.LatLng(lat, lng));

    console.log('returned marker ');
    console.log(newMarker);
    return newMarker;
}


function populateClientFields(address,boookingMap) {
    cleanMarker(marker);
    marker = drawMarker(boookingMap, false, address.lat , address.lng , 'icon-dex-littleguy.png', true, address.fullname);
    $("#addressId").val(address.id);
    $("#txt_phone").val(address.phone);
    $("#txt_firstname").val(address.fullname);
    $("#txt_latitude").val(address.lat);
    $("#txt_longitude").val(address.lng);
    $("#txtDescription").val(address.fulladdress);
}

function populateTaxiFields(taxilist) {
    $("#taxiId").val(taxilist.id);
    $("#txt_number").val(taxilist.number);
    $("#txt_taxiplate").val(taxilist.plate);
    $("#txt_taxicolor").val(taxilist.taxicolor);
    $("#txt_drivername").val(taxilist.fullname);
    $("#sp_taxiphoto").attr('src', '<? echo base_url()?>' + taxilist.taxiphoto);
    $("#sp_driveravatar").attr('src', '<? echo base_url()?>' + taxilist.avatar);
}
function closeformuser() {
    $('#dialog_useredit').dialog('close');
}

//cancel submmit
$("#users-form").submit(function () {
    return false;
});

function openSearchTaxi(){
    $( "#dialog_addressTaxi" ).dialog({
        resizable: true,
        height:600,
        width:1000,
        modal: true,
        buttons: {
            Cancel: function() {
                $( this ).dialog( "close" );
            }
        }
    });
}

function openSearchDireccion(){
    $( "#dialog_addressSearch" ).dialog({
        resizable: true,
        height:600,
        width:1000,
        modal: true,
        buttons: {
            Cancel: function() {
                $( this ).dialog( "close" );
            }
        }
    });
}
function v_addressbooking_select(id)
{
    $( "#dialog_addressSearch" ).dialog("close");
    $.getJSON('<?= base_url()?>/radiotaxi/address/getAddress/'+id , function (data) {
        populateClientFields(data[0],boookingMap);
    });

}

function v_addresstaxi_select(id){
    $( "#dialog_addressTaxi" ).dialog("close");
    $.getJSON('<?= base_url()?>/radiotaxi/taxi/getTaxiWithDriver/'+id , function (data) {
        populateTaxiFields(data[0]);
    });
}

function initializeSearchAddress(){
    {
        oAdminTableUsers = $('#v_addressbooking').dataTable({
            'bServerSide'    : true,
            'bAutoWidth'     : false,
            'iDisplayLength' : 5,
            'sPaginationType': 'full_numbers',
            'sAjaxSource': '<?= base_url()?>radiotaxi/address/listenereditbooking',
            'aoColumns' : [
                { 'sName': 'selected'},
                { 'sName': 'fullname'},
                { 'sName': 'lat'},
                { 'sName': 'lng'},
                { 'sName': 'fulladdress'},
                { 'sName': 'phone'},
                { 'sName': 'id',"bSortable": false, "bSearchable": false }
            ],
            'fnServerData': function(sSource, aoData, fnCallback){
                $.ajax({
                    'dataType': 'json',
                    'type': 'POST',
                    'url': sSource,
                    'data': aoData,
                    'success': fnCallback,
                    'error': function (xml, textStatus, errorThrown) {
                        alert(xml.status + "||" + xml.responseText);
                    }
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
            }

        });
    }

}

function initializeSearchTaxi(){
    {
        oAdminTableUsers = $('#v_addresstaxi').dataTable({
            'bServerSide'    : true,
            'bAutoWidth'     : false,
            'iDisplayLength' : 5,
            'sPaginationType': 'full_numbers',
            'sAjaxSource': '<?= base_url()?>radiotaxi/taxi/listenereditbooking',
            'aoColumns' : [
                { 'sName': 'selected'},
                { 'sName': 'number'},
                { 'sName': 'plate'},
                { 'sName': 'taxicolor'},
                { 'sName': 'status'},
                { 'sName': 'description'},
                { 'sName': 'fullname'},
                { 'sName': 'id',"bSortable": false, "bSearchable": false }
            ],
            'fnServerData': function(sSource, aoData, fnCallback){
                $.ajax({
                    'dataType': 'json',
                    'type': 'POST',
                    'url': sSource,
                    'data': aoData,
                    'success': fnCallback,
                    'error': function (xml, textStatus, errorThrown) {
                        alert(xml.status + "||" + xml.responseText);
                    }
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
            }

        });
    }

}
function save() {
    if (!$('#booking-form').valid()) {
        return false;
    }
    $.ajax({
        type: "post",
        url: "<?=base_url()?>radiotaxi/booking/ajaxsave",
        dataType: "json",
        data: $('#booking-form').serialize(),
        success: function (data) {
            if (data.success) {
                $().toastmessage('showToast', {
                    text: '<?= lang('users.tab.dialog.saved');?>',
                    no_sticky: true,
                    position: 'middle-center',
                    type: 'success',
                    closeText: ''
                });
                //$('#dialog_useredit').dialog('close');
                oAdminTableUsers.fnDraw();

                $('#successmsg').text(data.message);
                $('#successbox').show();
                var tviewurl1 = '<?=base_url()?>admin/defaultmap';
                //SET TAB STATUS ON SESSION
                settabsession('home');
                loadtabcontentnum(tviewurl1, 1);

            } else {
                $('#errormsg').text(data.message);
                $('#errordiv').show();
            }
        }
    });
    return false;
}


</script>