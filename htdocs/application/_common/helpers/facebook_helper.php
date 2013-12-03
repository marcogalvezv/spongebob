<?php //if (!defined('BASEPATH')) exit('No direct script access allowed');
//DEV SERVER
/*	define('YOUR_APP_ID', '136529336473327');
	define('YOUR_APP_SECRET', 'a3aff9cab059674b8fc375c33e883313');
*/
//LOCAL SERVER
	define('YOUR_APP_ID', '380991335258763');
	define('YOUR_APP_SECRET', 'e47350a283d223f7ec86c76153153b70');
	define('YOUR_URL_DOMAIN', 'http://synapse.synapse.com.bo');
	define('YOUR_APP_NAME', 'flysociallocal');

	require_once 'facebook/facebook.php';
//    include_once("facebook/facebook.php");

function fb_getuser()
{

	// Create our Application instance (replace this with your appId and secret).
	$facebook = new Facebook(array(
	  'appId'  => YOUR_APP_ID,
	  'secret' => YOUR_APP_SECRET,
      'cookie' => true,
	));

    $user            =   null; //facebook user uid
	// Get User ID
	$user = $facebook->getUser();
	
	$result = array();
	// We may or may not have this data based on whether the user is logged in.
	//
	// If we have a $user id here, it means we know the user is logged into
	// Facebook, but we don't know if the access token is valid. An access
	// token is invalid if the user logged out of Facebook.
/*
	if ($user) {
		try {
			// Proceed knowing you have a logged in user who's authenticated.
			$user_profile = $facebook->api('/me');
			$result['user'] = $user;
			$result['user_profile'] = $user_profile;
		} catch (FacebookApiException $e) {
			error_log($e);
//			$user = null;
			$result['error'] = $e;
		}
	}
*/
	// Login or logout url will be needed depending on current user state.
		$loginUrl   = $facebook->getLoginUrl(
				array(
					'scope'         => 'email,offline_access,publish_stream,user_birthday,user_location,user_work_history,user_about_me,user_hometown',
					'redirect_uri'  => 'http://flysocial.synapse.com.bo/home'
				)
		);
		$result['loginUrl'] = $loginUrl;

		$logoutUrl = $facebook->getLogoutUrl();
		$result['logoutUrl'] = $logoutUrl;

	if ($user) {
		try {
			// Proceed knowing you have a logged in user who's authenticated.
			$user_profile = $facebook->api('/me');
			$result['user'] = $user;
			$result['user_profile'] = $user_profile;
		} catch (FacebookApiException $e) {
			error_log($e);
			$user = null;
			$result['user'] = $user;
			$result['error'] = $e;
		}
	}
/*
	if ($user) {
		$logoutUrl = $facebook->getLogoutUrl();
		$result['logoutUrl'] = $logoutUrl;
	} else {
//		$loginUrl = $facebook->getLoginUrl();
		$loginUrl   = $facebook->getLoginUrl(
				array(
					'scope'         => 'email,offline_access,publish_stream,user_birthday,user_location,user_work_history,user_about_me,user_hometown',
					'redirect_uri'  => 'http://flysocial.synapse.com.bo/user/login'
				)
		);
		$result['loginUrl'] = $loginUrl;
	}
*/
	return $result;
}

function fb_publish($message = null, $link = null, $picture = null, $name = null, $desc = null){
	$error = false;
	$response = "";
	
	// Create our Application instance (replace this with your appId and secret).
	$facebook = new Facebook(array(
	  'appId'  => YOUR_APP_ID,
	  'secret' => YOUR_APP_SECRET,
      'cookie' => true,
	));
	
	echo "<pre>";
	print_r($facebook);
	echo "</pre>";
	
	// Get User ID
	$user = $facebook->getUser();
	
	//update user's status using graph api
	//http://developers.facebook.com/docs/reference/dialogs/feed/
	try {
		$response = $facebook->api("/$user/feed", 'post', array(
			'message' => $message, 
			'link'    => $link,
			'picture' => $picture,
			'name'    => $name,
			'description'=> $desc
			)
		);
		$error = false;
		//as $_GET['publish'] is set so remove it by redirecting user to the base url 
	} catch (FacebookApiException $e) {
//			d($e);
		$response = $e->GetMessage();
		$error = true;
	}
		
	echo "<pre>";
	print_r($response);
	echo "</pre>";
	
    if ( $error )
    {
		$res = "Facebook API Error: " . $response;
        return $res;
    }
    else
    {
        return $response;
    }	

}

function fb_message($message = null){
	$error = false;
	$response = "";
	
	// Create our Application instance (replace this with your appId and secret).
	$facebook = new Facebook(array(
	  'appId'  => YOUR_APP_ID,
	  'secret' => YOUR_APP_SECRET,
      'cookie' => true,
	));
	
	echo "<pre>";
	print_r($facebook);
	echo "</pre>";
	
	// Get User ID
	$user = $facebook->getUser();
	
	//update user's status using graph api
	//http://developers.facebook.com/docs/reference/dialogs/feed/
	try {
		$response = $facebook->api("/$user/feed", 'post', array(
			'message' => $message
			)
		);
		$error = false;
		//as $_GET['publish'] is set so remove it by redirecting user to the base url 
	} catch (FacebookApiException $e) {
//			d($e);
		$response = $e->GetMessage();
		$error = true;
	}
		
	echo "<pre>";
	print_r($response);
	echo "</pre>";
	
    if ( $error )
    {
		$res = "Facebook API Error: " . $response;
        return $res;
    }
    else
    {
        return $response;
    }	

}

function fb_invite($message = null, $link = null, $picture = null, $name = null, $desc = null){
	$error = false;
	$response = "";
	
	// Create our Application instance (replace this with your appId and secret).
	$facebook = new Facebook(array(
	  'appId'  => YOUR_APP_ID,
	  'secret' => YOUR_APP_SECRET,
      'cookie' => true,
	));
	
	echo "<pre>";
	print_r($facebook);
	echo "</pre>";
	
	// Get User ID
	$user = $facebook->getUser();
	
	//update user's status using graph api
	//http://developers.facebook.com/docs/reference/dialogs/feed/
	try {
		$response = $facebook->api("/$user/feed", 'post', array(
			'message' => $message, 
			'link'    => $link,
			'picture' => $picture,
			'name'    => $name,
			'description'=> $desc
			)
		);
		$error = false;
		//as $_GET['publish'] is set so remove it by redirecting user to the base url 
	} catch (FacebookApiException $e) {
//			d($e);
		$response = $e->GetMessage();
		$error = true;
	}
		
	echo "<pre>";
	print_r($response);
	echo "</pre>";
	
    if ( $error )
    {
		$res = "Facebook API Error: " . $response;
        return $res;
    }
    else
    {
        return $response;
    }	

}


function fb_destroySession()
{
	// Create our Application instance (replace this with your appId and secret).
	$facebook = new Facebook(array(
	  'appId'  => YOUR_APP_ID,
	  'secret' => YOUR_APP_SECRET,
	));

	// Get User ID
	$user = $facebook->destroySession();
}
?>