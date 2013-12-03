    <script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <script>
      function initialize() {
        
		var mapOptions = {
          zoom: 15,
          center: new google.maps.LatLng(-17.383283,-66.160238),
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }
//	  mapTypeId: google.maps.MapTypeId.HYBRID (muestra una mezcla de vistas normales y de satélite)
        var map = new google.maps.Map(document.getElementById('map_canvas'),
                                      mapOptions);

		//PidamosAlgo
        var image = '<?= base_url()?>images/maps/icons/logo64x50.png';
        var myLatLng = new google.maps.LatLng(-17.38318,-66.145443);
        var beachMarker = new google.maps.Marker({
            position: myLatLng,
            map: map,
			center: myLatLng,
            icon: image
        });

		//Burguer King
        var image = '<?= base_url()?>images/maps/icons/fastfood.png';
        var myLatLng = new google.maps.LatLng(-17.383283,-66.160238);
        var beachMarker = new google.maps.Marker({
            position: myLatLng,
            map: map,
			center: myLatLng,
            icon: image
        });
      }
    </script>

    <style type="text/css">
    #map_canvas {
      width: 960px;
      height: 300px;
    }
    </style>

<div id="mapbox" title="">
	<div id="googlemapbox">
		<a href="<?= base_url()?>home/map" target="_blank">Ver Mapa Completo <img src="<?= base_url()?>images/icons/google_maps_icon.png" width="64" height="64"></a>
		<div id="map_canvas"></div>	
	</div>
</div>
<div class="searchbox" title="Buscar por Tipo de Comida: Carne, Pollo, Pescado, Pastas, Pizzas, etc. o por Nacionalidad: Boliviana, Italiana, Mexicana, Argentina, China, Brasilera...">
	<form class="searchform">
		SEARCH
	</form>		
</div>
<div class="content">
	<div class="c1">
	LEFT
	</div>
	<div class="c2">
	RIGHT
	</div>
	<div class="clear"></div>
</div>
<div id="dialog_message" title="Suscripcion" style="display:none;">
	<h2 id="dialog_title"></h2>
	<p style="text-align:left;">
		<span id="dialog_text">Se ha suscrito exitosamente a nuestro servicio, este atento para recibir ofertas.</span>
	</p>
</div>
<script language="javascript">
<!--
$(function(){
    $(".defaultText").focus(function(srcc)
    {
        if ($(this).val() == $(this)[0].title)
        {
            $(this).removeClass("defaultTextActive");
            $(this).val("");
        }
    });
    
    $(".defaultText").blur(function()
    {
        if ($(this).val() == "")
        {
            $(this).addClass("defaultTextActive");
            $(this).val($(this)[0].title);
        }
    });
    
    $(".defaultText").blur();

	$(".searchbox").tipTip({edgeOffset: 10, defaultPosition: "right"});
	
	initialize();
});
//-->
</script>
