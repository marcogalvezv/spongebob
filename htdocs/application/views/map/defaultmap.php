<style>
    #map-canvas {
        background: #000066;
        margin: 0;
        padding: 0;
        height: 800px;
        width: 1000px;
    }
</style>


<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span><i class="icon-table"></i>Mapa</span>
    </div>
    <div id="map-canvas"></div>
</div>
<div class="mws-panel grid_8">
    <form name="admin_members_form" id="admin_members_form" method="post" class="mws-form">
        <div class="mws-panel-header">
            <span><i class="icon-table"></i>Solicitudes</span>
        </div>
        <div class="mws-panel-body no-padding">
            <table class="mws-table" id="v_bookingtable">
                <thead>
                <tr>

                    <th "width: 5%">ID</th>
                    <th "width: 15%">NOMBRE</th>
                    <th "width: 15%">DIRECCION</th>
                    <th "width: 10%">ESTADO</th>
                    <th "width: 10%">TAXI</th>
                    <th "width: 10%">OPCIONES</th>


                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><?= lang('datatable.loading');?></td>
                </tr>
                </tbody>
            </table>
        </div>
        <footer style="height:40px">
            <div class="mws-button-row">
                <input onclick="v_booking_edit()" value="Nueva Solicitud" type="button" class="btn"/>

            </div>
        </footer>
    </form>
</div>

<script>

    var clientMarkersArray = new Array();
    var taxiMarkersArray = new Array();

    $(document).ready(function(){
        oAdminTableUsers = $('#v_bookingtable').dataTable({
            'bServerSide'    : true,
            'bAutoWidth'     : false,
            // "bJQueryUI": true,
            'sPaginationType': 'full_numbers',
            'sAjaxSource': '<?= base_url()?>radiotaxi/booking/listener',
            'aoColumns' : [
                { 'sName': 'selected'},
                { 'sName': 'fullname'},
                { 'sName': 'fulladdress' },
                { 'sName': 'status' },
                { 'sName': 'number' },
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
            }

        });

        var defaultMap = initializeMap();
        clientMarkersArray = drawActiveClientMarkers(defaultMap);
        console.log('obtained array');
        console.log(clientMarkersArray);
        taxiMarkersArray = drawActiveTaxiMarkers(defaultMap);
        //reloadMarkers(defaultMap);

    });

    function drawActiveClientMarkers(mapToDraw)
    {
        $.getJSON('<?= base_url()?>radiotaxi/booking/getActiveBookingClients', function(data) {
            var clientLocations = data;
            clientMarkersArray =  drawMarkerList(mapToDraw, clientLocations, 'icon-dex-littleguy.png');
        });
    }

    function drawActiveTaxiMarkers(mapToDraw)
    {
        $.getJSON('<?= base_url()?>radiotaxi/taxi/getActiveTaxis', function(data) {
            var taxiLocations = data;
            taxiMarkersArray = drawMarkerList(mapToDraw, taxiLocations,'taxi.png');
        });
    }
    function drawMarkerList(mapToDraw, list, icon)
    {
        var markerArray = new Array();
        if (list)
        for (i = 0; i < list.length; i++) {
            //alert ('lat'+list[i]['lat']+ ',lng'+ list[i]['lng']);
            var iconBase = '<?= base_url();?>images/admin/mapicons/';
            var newMarker = new google.maps.Marker({
                position: new google.maps.LatLng(list[i]['lat'], list[i]['lng']),
                icon: iconBase + icon,
                draggable:true,
                map: mapToDraw
            });
            markerArray.push(newMarker);
        }
        console.log('returned array: ');
        console.log(markerArray);
        return markerArray;
    }

    function initializeMap()
    {
        var myLatlng = new google.maps.LatLng(-17.3830370000,-66.1453570000);
        var mapOptions = {
            zoom: 13,
            center: myLatlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        var map = new google.maps.Map(document.getElementById('map-canvas'),
            mapOptions);
        return map;
    }

    function reloadMarkers(mapToDraw)
    {
        setInterval(function(){
            console.log('trying to clean');
            //alert('array to clean: '. taxiMarkersArray);
            cleanMarkers(clientMarkersArray);
            cleanMarkers(taxiMarkersArray);
            clientMarkersArray = drawActiveClientMarkers(mapToDraw);
            taxiMarkersArray = drawActiveTaxiMarkers(mapToDraw);
        },3000);

    }

    function cleanMarkers(markersArray)
    {
        console.log(markersArray);
      if (markersArray !== undefined)
      {
          for (var i = 0; i < markersArray.length; i++ ) {
              markersArray[i].setMap(null);
          }
        markersArray = [];
      }
    }

    function cleanMarker(marker)
    {
        marker.setMap(null);
    }

    function v_booking_edit(iduser){
        //alert('trying to edit');
        $.ajax({
            type: "post",
            url: "<?=base_url()?>radiotaxi/booking/ajaxedit",
            dataType: "html",
            data: { 'id' : iduser, 'rnd': new Date().getTime() },
            async: false,
            success: function(data) {
                //$('#ajaxLoadAni').fadeOut('slow');
                $("#tabcontent").html(data);
            }
        });
    }
</script>


