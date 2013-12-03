<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
 
/**
 * Payment processing class for CodeIgniter
 *
 * A class to simplify the processing of payments using many payment processors like: 
 * ARBAuthorize
 * Authorize
 * Googlecheckout
 * Moneybookers
 * Paymentech
 * Paypal
 * Paypalpro
 * Trident
 * Trustcommerce
 * Yourpay
 *
 * This does NOT do everything but is a good start to processing payments using CodeIgniter.
 *
 *
 * @library		Payment
 * @author		Carlos Alcala
 * @email		carlos@online.com.bo
 * @copyright	Copyright (c) 2011, Synapse Online Software
 * @link		http://www.online.com.bo
 * @since		Version 2.0
 * @filesource
 */
class Payment {
	
	// Configuration
	protected $settings = array
	(
		// The driver string
		'driver'      => NULL,
		// Test mode is set to true by default
		'test_mode'   => TRUE,
	);

	protected $driver = NULL;
   
	/**
	 * Sets the payment processing fields.
	 * The driver will translate these into the specific format for the provider.
	 * Standard fields are (Providers may have additional or different fields):
	 *
	 * card_num
	 * exp_date
	 * cvv
	 * description
	 * amount
	 * tax
	 * shipping
	 * first_name
	 * last_name
	 * company
	 * address
	 * city
	 * state
	 * zip
	 * email
	 * phone
	 * fax
	 * ship_to_first_name
	 * ship_to_last_name
	 * ship_to_company
	 * ship_to_address
	 * ship_to_city
	 * ship_to_state
	 * ship_to_zip
	 *
	 * @param  array  the driver string
	 */
	public function __construct($settings = array())
	{
		$this->CI =& get_instance();
		
		//LOAD PAYMENT DRIVER CLASS
		require_once('drivers/Payment.php');
		
		//LOAD PAYMENT CONFIG
		//$this->CI->config->load('payment');
		
		if (empty($settings))
		{
			// Load the default group
			$settings = $this->CI->config->item('default_payment');
		}
		elseif (is_string($settings))
		{
			$this->settings['driver'] = $settings;
		}

		// Merge the default config with the passed config
		is_array($settings) AND $this->settings = array_merge($this->settings, $settings);

		// Set driver name
		//$driver = ucfirst($this->settings['driver']);
		$driverClass = 'Payment_'.ucfirst($this->settings['driver']).'_Driver';


		// Get the driver specific settings
		$this->settings = array_merge($this->settings, $this->CI->config->item($this->settings['driver']));
		
		// Load the driver
		$this->driver = $this->driverload($driverClass, $this->settings);
		/*
		echo "<pre>";
		print_r($this->settings);
		print_r($this->driver);
		echo "</pre>";
		*/
	}
	
	function driverload($driverClassName, $config){
		
		$filePathName = APPPATH."_common/libraries/drivers/Payment/".$config['driver'].EXT; 
		if(file_exists($filePathName))
		{
			require_once $filePathName;
		}
		else
		{
			show_error("$filePathName doesn't exist");		
		}
		if(class_exists($driverClassName, true))
		{
			$driver = new $driverClassName($config);
			if($driver instanceof Payment_Driver)
			{
				return $driver;
			}
		}
		else
		{
			show_error("$driverClassName in $filePathName doesn't exist");		
		}
	}
	
	/**
	 * Sets the credit card processing fields
	 *
	 * @param  string  field name
	 * @param  string  value
	 */
	public function __set($name, $val)
	{
		$this->driver->set_fields(array($name => $val));
	}

	/**
	 * Bulk setting of payment processing fields.
	 *
	 * @param   array   array of values to set
	 * @return  object  this object
	 */
	public function set_fields($fields)
	{
		$this->driver->set_fields((array) $fields);

		return $this;
	}

	/**
	 * Runs the transaction
	 *
	 * @return  TRUE|string  TRUE on successful payment, an error string on failure
	 */
	public function process()
	{
		//SET TO TRUE WHILE GETTING GREEN LIGHT FROM CUSTOMER
		return $this->driver->process();
		//return TRUE;
	}	
	/*
	public function create()
	{
		//SET TO TRUE WHILE GETTING GREEN LIGHT FROM CUSTOMER
		return $this->driver->create();
		//return TRUE;
	}	
	*/
	public function success()
	{
		//SET TO TRUE WHILE GETTING GREEN LIGHT FROM CUSTOMER
		return $this->driver->success();
		//return TRUE;
	}	
	
	public function subscription()
	{
		//SET TO TRUE WHILE GETTING GREEN LIGHT FROM CUSTOMER
		return $this->driver->subscription();
		//return TRUE;
	}

}
?>