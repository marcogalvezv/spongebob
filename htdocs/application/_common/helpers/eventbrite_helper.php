<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function event_new($title = "New FlySocial Event", $start_date, $end_date, $privacy = 1, $status = 'draft', $timezone = 'GMT-8')
{
	// load the API Client library
    include_once("eventbrite/Eventbrite.php");
	error_reporting(E_STRICT);

	// Initialize the API client
	//  Eventbrite API / Application key (REQUIRED)
	//   http://www.eventbrite.com/api/key/
	$api_key = 'BLCF55YCCL3ZIUL5SM';
	//  Eventbrite user_key (OPTIONAL, only needed for reading/writing private user data)
	//   http://www.eventbrite.com/userkeyapi
	$user_key = '133001210827972441325';
	
	$start_ts = strtotime($start_date);
	$end_ts = strtotime($end_date);

	//see http://developer.eventbrite.com/doc/events/event_update/ for a
	// description of the available event_update parameters:
	$event_new_params = array(
		'title' => $title,
		//'start_date' => date('Y-m-d H:i:s', time() + (7 * 24 * 60 * 60)), // "YYYY-MM-DD HH:MM:SS"
		//'end_date' => date('Y-m-d H:i:s', time() + (7 * 24 * 60 * 60) + (2 * 60 * 60) ), // "YYYY-MM-DD HH:MM:SS"
		'start_date' => date('Y-m-d H:i:s', $start_ts), // "YYYY-MM-DD HH:MM:SS"
		'end_date' => date('Y-m-d H:i:s', $end_ts), // "YYYY-MM-DD HH:MM:SS"
		'privacy' => $privacy,  // zero for private (not available in search), 1 for public (available in search)
		'status' => $status,  // The event status. Allowed values are “draft”, “live” for new events. If not provided, status will be “draft”, meaning that the event registration page will not be available publicly.
		'timezone' => $timezone
	);

	// initialize the API client
	$eb_client = new Eventbrite(array('app_key'  => $api_key,
									  'user_key' => $user_key));
	
	echo "<pre>";
	print_r($eb_client);
	echo "</pre>";	
	
	$error = false;
	$response = "";
	// Create your event:
	try
	{
		// For more information about the API calls that are available
		// on Eventbrite API clients, see http://developer.eventbrite.com/doc/
		$response = $eb_client->event_new($event_new_params);

	}catch( Exception $e ){
		// application-specific error handling goes here:
		$response = $e->GetMessage();
		$error = true;
	}
	
	echo "<pre>";
	print_r($response);
	echo "</pre>";	
	
    if ( $error )
    {
		$res = "EventBrite API Error: " . $response;
        return $res;
    }
    else
    {
        return $response;
    }	
}

function event_update($eventID, $title = "New FlySocial Event", $start_date, $end_date, $privacy = 1, $timezone = 'GMT-8')
{
	// load the API Client library
    include_once("eventbrite/Eventbrite.php");
	error_reporting(E_STRICT);

	// Initialize the API client
	//  Eventbrite API / Application key (REQUIRED)
	//   http://www.eventbrite.com/api/key/
	$api_key = 'BLCF55YCCL3ZIUL5SM';
	//  Eventbrite user_key (OPTIONAL, only needed for reading/writing private user data)
	//   http://www.eventbrite.com/userkeyapi
	$user_key = '133001210827972441325';
	
	$start_ts = strtotime($start_date);
	$end_ts = strtotime($end_date);

	//see http://developer.eventbrite.com/doc/events/event_update/ for a
	// description of the available event_update parameters:
	$event_update_params = array(
		'event_id' => $eventID,
		'title' => $title,
		//'start_date' => date('Y-m-d H:i:s', time() + (7 * 24 * 60 * 60)), // "YYYY-MM-DD HH:MM:SS"
		//'end_date' => date('Y-m-d H:i:s', time() + (7 * 24 * 60 * 60) + (2 * 60 * 60) ), // "YYYY-MM-DD HH:MM:SS"
		'start_date' => date('Y-m-d H:i:s', $start_ts), // "YYYY-MM-DD HH:MM:SS"
		'end_date' => date('Y-m-d H:i:s', $end_ts), // "YYYY-MM-DD HH:MM:SS"
		'privacy' => $privacy,  // zero for private (not available in search), 1 for public (available in search)
		'timezone' => $timezone
	);

	// initialize the API client
	$eb_client = new Eventbrite(array('app_key'  => $api_key,
									  'user_key' => $user_key));
	
	echo "<pre>";
	print_r($eb_client);
	echo "</pre>";	
	
	$error = false;
	$response = "";
	// Create your event:
	try
	{
		/*
		//COPY EVENT OPERATION
		// For more information about the API calls that are available
		// on Eventbrite API clients, see http://developer.eventbrite.com/doc/
		$copy_event = $eb_client->event_copy(array('event_id'=> $eventID, 'event_name'=> 'copy_event'));
		
		echo "<pre>";
		print_r($copy_event->process->id);
		echo "</pre>";
	
		$event_update_params['event_id'] = $copy_event->process->id;
		*/

		$response = $eb_client->event_update($event_update_params);		

	}catch( Exception $e ){
		// application-specific error handling goes here:
		$response = $e->GetMessage();
		$error = true;
	}
	
	echo "<pre>";
	print_r($response);
	echo "</pre>";	
	
    if ( $error )
    {
		$res = "EventBrite API Error: " . $response;
        return $res;
    }
    else
    {
        return $response;
    }	
}


function ticket_new($eventID, $name, $price = '0.00', $qty = 100, $start_sales, $end_sales, $min = 1, $max = 10)
{
	// load the API Client library
    include_once("eventbrite/Eventbrite.php");
	error_reporting(E_STRICT);

	// Initialize the API client
	//  Eventbrite API / Application key (REQUIRED)
	//   http://www.eventbrite.com/api/key/
	$api_key = 'BLCF55YCCL3ZIUL5SM';
	//  Eventbrite user_key (OPTIONAL, only needed for reading/writing private user data)
	//   http://www.eventbrite.com/userkeyapi
	$user_key = '133001210827972441325';
	
	$start_ts = strtotime($start_sales);
	$end_ts = strtotime($end_sales);

	//see http://developer.eventbrite.com/doc/events/event_update/ for a
	// description of the available event_update parameters:
	$params = array(
		'event_id' => $eventID,
		'name' => $name,
		'price' => $price,
		'quantity' => $qty,
		'start_sales' => date('Y-m-d H:i:s', $start_ts), // "YYYY-MM-DD HH:MM:SS"
		'end_sales' => date('Y-m-d H:i:s', $end_ts), // "YYYY-MM-DD HH:MM:SS"
		'min' => $min,
		'max' => $max
	);

	// initialize the API client
	$eb_client = new Eventbrite(array('app_key'  => $api_key,
									  'user_key' => $user_key));
	
	echo "<pre>";
	print_r($eb_client);
	echo "</pre>";	
	
	$error = false;
	$response = "";
	// Create your event:
	try
	{
		$response = $eb_client->ticket_new($params);		

	}catch( Exception $e ){
		// application-specific error handling goes here:
		$response = $e->GetMessage();
		$error = true;
	}
	
	echo "<pre>";
	print_r($response);
	echo "</pre>";	
	
    if ( $error )
    {
		$res = "EventBrite API Error: " . $response;
        return $res;
    }
    else
    {
        return $response;
    }	
}

function event_list_attendees($eventID)
{
	// load the API Client library
    include_once("eventbrite/Eventbrite.php");
	//error_reporting(E_STRICT);

	// Initialize the API client
	//  Eventbrite API / Application key (REQUIRED)
	//   http://www.eventbrite.com/api/key/
	//  Eventbrite user_key (OPTIONAL, only needed for reading/writing private user data)
	//   http://www.eventbrite.com/userkeyapi
	$authentication_tokens = array('app_key'  => 'BLCF55YCCL3ZIUL5SM',
								   'user_key' => '133001210827972441325');
	
	$eb_client = new Eventbrite( $authentication_tokens );
	
	echo "<pre>";
	print_r($eb_client);
	echo "</pre>";	
	
	$error = false;
	try
	{
		$response = $eb_client->event_list_attendees( array('id'=>$eventID) );

	}catch( Exception $e ){
		// application-specific error handling goes here:
		
		//var_dump($e);
		$response = $e->GetMessage();
		$error = true;
	}
	
	echo "<pre>";
	print_r($response);
	echo "</pre>";	
	
    if ( $error )
    {
		$res = "EventBrite API Error: " . $response;
        return $res;
    }
    else
    {
        return true;
    }	
}

function event_list()
{
	// load the API Client library
    include_once("eventbrite/Eventbrite.php");
	error_reporting(E_STRICT);

	// Initialize the API client
	//  Eventbrite API / Application key (REQUIRED)
	//   http://www.eventbrite.com/api/key/
	//  Eventbrite user_key (OPTIONAL, only needed for reading/writing private user data)
	//   http://www.eventbrite.com/userkeyapi
	$authentication_tokens = array('app_key'  => 'BLCF55YCCL3ZIUL5SM',
								   'user_key' => '133001210827972441325');
	
	$eb_client = new Eventbrite( $authentication_tokens );
	
	$error = false;
	try
	{
		// For more information about the API calls that are available
		// on Eventbrite API clients, see http://developer.eventbrite.com/doc/
		$response = $eb_client->user_list_events();

	}catch( Exception $e ){
		// application-specific error handling goes here:
		$response = $e->GetMessage();
		$error = true;
	}	
	
	echo "<pre>";
	print_r($response);
	echo "</pre>";

	if(!$error && empty($response)){
		// application-specific error handling goes here:
		$response = "There is no events for the current user";
		$error = true;
	}
	
    if ( $error )
    {
		$res = "EventBrite API Error: " . $response;
        return $res;
    }
    else
    {
        return $response;
    }	
}

function event_search($max = 10, $city = "San Francisco", $region = "CA", $country = "US")
{
	// load the API Client library
    include_once("eventbrite/Eventbrite.php");
	error_reporting(E_STRICT);

	// Initialize the API client
	//  Eventbrite API / Application key (REQUIRED)
	//   http://www.eventbrite.com/api/key/
	//  Eventbrite user_key (OPTIONAL, only needed for reading/writing private user data)
	//   http://www.eventbrite.com/userkeyapi
	$authentication_tokens = array('app_key'  => 'BLCF55YCCL3ZIUL5SM',
								   'user_key' => '133001210827972441325');
	
	$eb_client = new Eventbrite( $authentication_tokens );
	// event_search example - http://developer.eventbrite.com/doc/events/event_search/
	
	$search_params = array(
	  'max' => 2,
	  'city' => 'San Francisco',
	  'region' => 'CA',
	  'country' => 'US'
	);
	
	$error = false;
	try
	{
		// For more information about the API calls that are available
		// on Eventbrite API clients, see http://developer.eventbrite.com/doc/
		$response = $eb_client->event_search($search_params);

	}catch( Exception $e ){
		// application-specific error handling goes here:
		$response = $e->GetMessage();
		$error = true;
	}	
	
	echo "<pre>";
	print_r($response);
	echo "</pre>";

	if(!$error && empty($response)){
		// application-specific error handling goes here:
		$response = "There is no events for the current user";
		$error = true;
	}
	
    if ( $error )
    {
		$res = "EventBrite API Error: " . $response;
        return $res;
    }
    else
    {
        return $response;
    }	
}
?>