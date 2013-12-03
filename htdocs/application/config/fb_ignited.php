<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * --- Facebook Ignited ---
 * 
 * fb_appid		is the app id you recieved from dev panel
 * fb_secret	is the secret you recieved from dev panel
 * fb_canvas 	the value you put in 'Canvas Page' field in dev panel or the address of your app.
 *				See example below the config.
 * fb_apptype	set to either 'iframe' or 'connect' based on what platform your app is
 * 				is running on. 
 * fb_auth		is the default authentications, '' is basic authentication
 * fb_upload	tells the SDK whether or not file uploads are enabled on your server.
 */
$config['fb_appid']		= '524342177594799';
$config['fb_secret']	= 'bf9abf6702ec7e2fb16685d1e76d48e3';
$config['fb_canvas']	= 'http://pidamosalgo.synapse.com.bo/fblogin/login';
$config['fb_apptype']	= 'connect';
$config['fb_auth']		= '';
$config['fb_upload']	= false;

/**
 * --- fb_canvas examples ---
 * iframe		your-facebook-namespace 
 * connect		www.your-connect-domain.com/subfolder/
 */