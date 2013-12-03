<?php
/**
 * @package  Payment
 *
 * Settings related to the Payment library.
 * This file has settings for each driver.
 * You should copy the 'default' and the specific
 * driver you are working with to your application/config/payment.php file.
 *
 * Options:
 *  driver - default driver to use
 *  test_mode - Turn TEST MODE on or off
 *  curl_settings - Set any custom cURL settings here. These defaults usualy work well.
 *                  see http://us.php.net/manual/en/function.curl-setopt.php for details
 */
$config['default_payment'] = array
(
	'driver'        => 'Paypal',
	'test_mode'     => TRUE,
	'curl_config'   => array(CURLOPT_HEADER         => FALSE,
	                         CURLOPT_RETURNTRANSFER => TRUE,
	                         CURLOPT_SSL_VERIFYPEER => FALSE)
);


/**
 * PayPal Options:
 *  API_UserName - the username to use
 *  API_Password - the password to use
 *  API_Signature - the api signature to use
 *  PAYPALURL - the URL to send commands to the paypal express_checkout
 *  RETURNURL - the URL to send the user to after they login with paypal
 *  CANCELURL - the URL to send the user to if they cancel the paypal transaction
 *  ERRORURL - the URL to send the user to if there is an error on the paypal transaction
 *  CURRENCYCODE - the Currency Code to to the transactions in (What do you want to get paid in?)
 */
$config['Paypal'] = array
(
	'USER'			=> 'info_api1.pidamosalgo.com',
	'PWD'			=> '4TFC544CZHUDAKNP',
	'SIGNATURE'		=> 'AVgclUNbyD8bgu-kNlGGlWFTa3r9Aa1MNMkGq4VcXJBIDEFdFHYi734C',
	'ENDPOINT'		=> 'https://api-3t.paypal.com/nvp',
	'PAYPALURL'  	=> 'https://www.paypal.com/webscr&cmd=_express-checkout&token=',

	// -- sandbox authorization details are generic
	'SANDBOX_USER'		=> 'info_1356233331_biz_api1.pidamosalgo.com',
	'SANDBOX_PWD'		=> '1356233351',
	'SANDBOX_SIGNATURE'	=> 'AGu.hbwMxRXoqDiyy-IJNOnULnvNAljbYfJj2BtbO.vpaGD0NlhGNZRH',
	'SANDBOX_ENDPOINT'	=> 'https://api-3t.sandbox.paypal.com/nvp',
	'SANDBOX_PAYPALURL'	=> 'https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=',
	// -- sandbox authorization details are generic

	// -- URL return settings
	'RETURNURL'		=> 'http://pidamosalgo.synapse.com.bo/paypal/done',
	'CANCELURL'		=> 'http://pidamosalgo.synapse.com.bo/paypal/cancel',
	'ERRORURL'		=> 'http://pidamosalgo.synapse.com.bo/paypal/error',	
	
	// -- VERSION & CURRENCY 
	'VERSION'      => '3.2',
	'CURRENCYCODE' => 'USD',
);

/**
 * PayPalpro Options:
 *  USER      - API user name to use
 *  PWD       - API password to use
 *  SIGNATURE - API signature to use
 *
 *  ENDPOINT  - API url used by live transaction
 *
 *  SANDBOX_USER      - User name used in test mode
 *  SANDBOX_PWD       - Pass word used in test mode
 *  SANDBOX_SIGNATURE - Security signiature used in test mode
 *  SANDBOX_ENDPOINT  - API url used for test mode transaction
 *
 *  VERSION   - API version to use
 *  CURRENCYCODE - can only currently be USD
 *
 */
$config['Paypalpro'] = array
(

	'USER'         => '-your-paypal-api-username',
	'PWD'          => '-your-paypal-api-password',
	'SIGNATURE'    => '-your-paypal-api-security-signiature',
	'ENDPOINT'     => 'https://api-3t.paypal.com/nvp',

	// -- sandbox authorization details are generic
	'SANDBOX_USER'      => 'sdk-three_api1.sdk.com',
	'SANDBOX_PWD'       => 'QFZCWN5HZM8VBG7Q',
	'SANDBOX_SIGNATURE' => 'A.d9eRKfd1yVkRrtmMfCFLTqa6M9AyodL0SJkhYztxUi8W9pCXF6.4NI',
	'SANDBOX_ENDPOINT'  => 'https://api-3t.sandbox.paypal.com/nvp',

	'VERSION'      => '3.2',
	'CURRENCYCODE' => 'USD',

	'curl_config'  => array
	(
		CURLOPT_HEADER         => FALSE,
		CURLOPT_SSL_VERIFYPEER => FALSE,
		CURLOPT_SSL_VERIFYHOST => FALSE,
		CURLOPT_VERBOSE        => TRUE,
		CURLOPT_RETURNTRANSFER => TRUE,
		CURLOPT_POST           => TRUE
	)

);

