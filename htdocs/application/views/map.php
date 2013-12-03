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
	var myLatLng = new google.maps.LatLng(-17.383324,-66.146282);
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

//jQuery document
$(function(){
	initialize();
});
</script>
<div id="map_canvas"></div>
<div id="controlbox">
		<div id="logocontrol">
			<a href="<?= base_url()?>"><img src="<?= base_url()?>images/logos/logo.png" width="150" height="100" /></a>
		</div>
	<h3>CENTRO DE CONTROL DEL MAPA</h3>
</div>