<?php
function is_ajax_request(){
	return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) 
       && $_SERVER['HTTP_X_REQUESTED_WITH']=="XMLHttpRequest")||
       (isset($_REQUEST['HTTP_X_REQUESTED_WITH']) 
       && $_REQUEST['HTTP_X_REQUESTED_WITH']=="XMLHttpRequest");
}

function begin_javascript(){
	echo '<script type="text/javascript">';
	if(!is_ajax_request()){
		echo 'jQuery(function(){'; /// call script onload even
	}
}

function end_javascript(){
  if(!is_ajax_request()){
    echo '});'; /// call script onload even
  }
  echo '</script>';  
}