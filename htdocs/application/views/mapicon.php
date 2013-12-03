<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Google Maps JavaScript API v3 Example: Simple Icons</title>
	<style type="text/css">
		html, body {
		  height: 100%;
		  margin: 0;
		  padding: 0;
		}

		#map_canvas {
		  height: 100%;
		}

		@media print {
		  html, body {
			height: auto;
		  }

		  #map_canvas {
			height: 650px;
		  }
		}
	</style>
    <script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <script>
      function initialize() {
        var myLatLng = new google.maps.LatLng(-33.890542, 151.274856);
		var mapOptions = {
          zoom: 10,
          center: myLatLng, //new google.maps.LatLng(-33, 151),
          mapTypeId: google.maps.MapTypeId.HYBRID
        }
        var map = new google.maps.Map(document.getElementById('map_canvas'),
                                      mapOptions);

        var image = '<?= base_url()?>images/maps/icons/fastfood.png';
        
        var beachMarker = new google.maps.Marker({
            position: myLatLng,
            map: map,
			center: myLatLng,
            icon: image
        });
      }
    </script>
  </head>
  <body onload="initialize()">
    <div id="map_canvas"></div>
  </body>
</html>
