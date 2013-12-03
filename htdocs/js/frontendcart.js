
$(document).ready(function() {
  
  //Google Maps API Code
  //Footer Maps init
  var myLatlng = new google.maps.LatLng(-17.38318,-66.145443);
    var myOptions = {
      zoom: 15,
      disableDefaultUI: true,
      center: myLatlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    var map = new google.maps.Map(document.getElementById("mapCanvas"), myOptions);
  
		//PidamosAlgo
        var image = base_url+'images/maps/icons/logo64x50.png';
        var myLatLng = new google.maps.LatLng(-17.38318,-66.145443);
        var beachMarker = new google.maps.Marker({
            position: myLatLng,
            map: map,
			center: myLatLng,
            icon: image
        });
   
    //Footer Bottom Go To Top Button Functionality
    $('.topButton').click(function(){
	    $('html, body').animate({scrollTop:0}, 'slow');
	     
	    return false;
    });
});