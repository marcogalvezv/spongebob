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
            <span><i class="icon-table"></i> Reservas</span>
        </div>
        <div class="mws-panel-body no-padding">
            <table class="mws-table" id="v_bookingtable">
                <thead>
                <tr>

                    <th "width: 5%">ID</th>
                    <th "width: 15%">NOMBRE</th>
                    <th "width: 15%">DIRECCION</th>
                    <th "width: 10%">DESTINO</th>
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
                <input onclick="v_userprofile_editclient()" value="<?= lang('users.tab.add');?>" type="button" class="btn"/>
                <input onclick="blockusers()" value="<?= lang('users.tab.block');?>" type="button" class="btn"/>
                <input onclick="approveusers()" value="<?= lang('users.tab.approve');?>" type="button" class="btn"/>
            </div>
        </footer>
    </form>
</div>

<script>

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
                { 'sName': 'fulldestination' },
                { 'sName': 'idtaxi' },
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
        getLocations();
    });

function getLocations()
{
    var locations;
    $.getJSON('<?= base_url()?>radiotaxi/booking/getFirtsFiveAdress', function(data) {


        initialize(data);
    });
}
    var map
    function initialize(data) {
        var locations = data
        var myLatlng = new google.maps.LatLng(-17.3830370000,-66.1453570000);
        var mapOptions = {
            zoom: 7,
            center: myLatlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        map = new google.maps.Map(document.getElementById('map-canvas'),
                mapOptions);
        var iconBase = '<?= base_url();?>images/admin/mapicons/';
        for (i = 0; i < locations.length; i++) {
            //alert ('lat'+locations[i]['addlat']+ ',lng'+ locations[i]['addlng']);
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i]['addlat'], locations[i]['addlng']),
                map: map,
                icon: iconBase + 'taxiMapIcon@2x.png'
            });
            var origin = new google.maps.LatLng(locations[i]['addlat'], locations[i]['addlng']);
            var dest = new google.maps.LatLng(locations[i]['destlat'], locations[i]['destlng']);
            calcRoute(origin,dest);
        }
    }

    function calcRoute(ori,dest) {
        var directionsDisplay = new google.maps.DirectionsRenderer();
        directionsDisplay.setMap(map);
        var directionsService = new google.maps.DirectionsService();
        //var selectedMode = document.getElementById('mode').value;
        var request = {
            origin: ori,
            destination: dest,
            travelMode: google.maps.TravelMode.DRIVING
        };
        directionsService.route(request, function(response, status) {
            if (status == google.maps.DirectionsStatus.OK) {
                directionsDisplay.setDirections(response);
            }
        });
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


