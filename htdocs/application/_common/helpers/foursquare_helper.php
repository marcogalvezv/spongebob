<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function Foursquare()
{
	require_once("foursquare/FoursquareAPI.class.php");
	//$location = array_key_exists("location",$_GET) ? $_GET['location'] : "Montreal, QC";
	error_reporting(E_STRICT);
	// Set your client key and secret
	$client_key = "MKR1RW4XGOKSPJQBWZXHV5CVBX1KG10Y11TG4UBKKFN0NTOW";
	$client_secret = "KLDI2V0ZLDOY4ZX5ALHHPS2VICWXC02EVNGSUPTXX4XQTTTC";

	
	// Create your event:
	try
	{
		// Load the Foursquare API library
		$foursquare = new FoursquareAPI($client_key,$client_secret,$redirect_uri='', $version='v2', $language='es');
		
	}catch( Exception $e ){
		// application-specific error handling goes here:
		$response = $e->GetMessage();
		$error = true;
	}
	
	//echo "<pre>";
	//print_r($response);
	//echo "</pre>";	
	
    if ( $error )
    {
		$res = "EventBrite API Error: " . $response;
        return $res;
    }
    else
    {
        return $foursquare;
    }	
}

?>