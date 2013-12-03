<script>
      function initializeFull() {
        
		var mapFullOptions = {
          zoom: 15,
          center: new google.maps.LatLng(-17.783466,-63.181607),
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }
//	  mapTypeId: google.maps.MapTypeId.HYBRID (muestra una mezcla de vistas normales y de satélite)
        var mapFull = new google.maps.Map(document.getElementById('mapFull_canvas'),
                                      mapFullOptions);

		//PidamosAlgo
        var image = '<?= base_url()?>images/maps/icons/logo64x50.png';
        var myLatLng = new google.maps.LatLng(-17.783466,-63.181607);
        var beachMarker = new google.maps.Marker({
            position: myLatLng,
            map: mapFull,
			center: myLatLng,
            icon: image
        });

		<?php if((isset($branches)) && (!empty($branches))){
			foreach($branches as $branch){
		?>
			//Burguer King
			var image = '<?= base_url()?>images/maps/icons/fastfood.png';
			var myLatLng = new google.maps.LatLng(<?= $branch['lat']?>,<?= $branch['lng']?>);
			var beachMarker = new google.maps.Marker({
				position: myLatLng,
				map: mapFull,
				center: myLatLng,
				icon: image
			});
		<?php }
		}?>
      };
	  
		$(function(){
			initializeFull();
		});//end document ready
		
		
    </script>

	<div id="mapFull_canvas" class="collapse in" style="width:100%; height: 800px;"></div>

