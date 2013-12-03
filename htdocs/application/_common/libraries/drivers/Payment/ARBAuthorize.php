<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
/**
 * ARBAuthorize.net Payment Driver
 *
 ****************************************************************************
 * @author: 	Carlos Alcala <carlos.alcala@upandrunningsoftware.com>		*
 * @date: 		09.23.2010													*
 * @version: 	v1.0														*
 ****************************************************************************
 */

class Payment_ARBAuthorize_Driver implements Payment_Driver
{
	// Array containing any response codes set from the gateway
	private $response        = Null;
	
	private $transaction     = False;

    const USE_PRODUCTION_SERVER  = 0;
    const USE_DEVELOPMENT_SERVER = 1;

    const EXCEPTION_CURL = 10;

    private $login;
    private $transkey;
    private $test;

    private $params  = array();
    private $success = false;
    private $error   = true;

    private $ch;
    private $xml;
    private $resultCode;
    private $code;
    private $text;
	private $status;
    private $subscrId;
	
	// Fields required to do a transaction
	private $required_fields = array
	(
		'amount'			=> FALSE,
		'cardNumber'        => FALSE,
		'expirationDate'    => FALSE,
		'firstName'         => FALSE,
		'lastName'          => FALSE,
		'address'           => TRUE,
		'city'              => TRUE,
		'state'             => TRUE,
		'zip'				=> TRUE,
		'customerEmail'     => FALSE,
		'interval_length'   => FALSE,
		'startDate'         => FALSE,
		'trialOccurrences'  => TRUE,
		'trialAmount'       => TRUE,
	);
	

    public function __construct($config)
    {
		$login = $config['auth_net_login_id'];
		$transkey = $config['auth_net_tran_key'];		
		
        $login    = trim($login);
        $transkey = trim($transkey);
        if (empty($login) || empty($transkey))
        {
            throw new Exception('You have not configured your ' . __CLASS__ . '() login credentials properly.');
        }

        $this->login    = trim($login);
        $this->transkey = trim($transkey);
        //$this->test     = (bool) $test;
		$this->test    	= (bool) $config['test_mode'];

        $subdomain = ($this->test) ? 'apitest' : 'api';
        $this->url = 'https://' . $subdomain . '.authorize.net/xml/v1/request.api';
		
		//BASIC SETTINGS
        $this->params['operation']  = 'CREATE';
		$this->params['refID']  = 'RecipeRx';
		$this->params['subscrName'] = 'RecipeRx';

		//CREDIT CARD INFORMATION
		$this->params['cardNumber'] = '';
		$this->params['expirationDate'] = '';
		$this->params['amount'] = 0.00;
		
		//BANK ACCOUNT INFORMATION
		$this->params['accountType'] = '';
		$this->params['routingNumber'] = '';
		$this->params['accountNumber'] = '';
		$this->params['nameOnAccount'] = '';
		$this->params['bankName'] = '';
		
		//ORDER INFO
		$this->params['orderInvoiceNumber'] = '';
		$this->params['orderDescription'] = '';

		//CUSTOMER INFO
		$this->params['customerId'] = '';
		$this->params['customerEmail'] = '';
		$this->params['customerPhoneNumber'] = '';
		$this->params['customerFaxNumber'] = '';

		//BILLING INFORMATION
		$this->params['firstName'] = '';
		$this->params['lastName'] = '';
		$this->params['company']  = '';
		$this->params['address']  = '';
		$this->params['city']  = '';
		$this->params['state']  = '';
		$this->params['zip']  = '';
		//SHIPPING INFORMATION
		$this->params['shipFirstName']  = '';
		$this->params['shipLastName']  = '';
		$this->params['shipCompany']  = '';
		$this->params['shipAddress']  = '';
		$this->params['shipCity']  = '';
		$this->params['shipState']  = '';
		$this->params['shipZip']  = '';
		
		
		$this->params['interval_length']  = 1;
        $this->params['interval_unit']    = 'months';
        $this->params['startDate']        = date("Y-m-d", strtotime("+ 1 month"));
        $this->params['totalOccurrences'] = 9999;
        $this->params['trialOccurrences'] = 0;
        $this->params['trialAmount']      = 0.00;
    }
	
	public function set_fields($fields)
	{
		foreach ((array) $fields as $key => $value)
		{
			$this->setParameter($key, $value);
			if (array_key_exists($key, $this->required_fields) and !empty($value)) $this->required_fields[$key] = TRUE;
		}
	}
	
    public function setParameter($field = '', $value = null)
    {
        $field = (is_string($field)) ? trim($field) : $field;
        $value = (is_string($value)) ? trim($value) : $value;
        if (!is_string($field))
        {
            throw new Exception('setParameter() arg 1 must be a string or integer: ' . gettype($field) . ' given.');
        }
        if (!is_string($value) && !is_numeric($value) && !is_bool($value))
        {
            throw new Exception('setParameter() arg 2 must be a string, integer, or boolean value: ' . gettype($value) . ' given.');
        }
        if (empty($field))
        {
            throw new Exception('setParameter() requires a parameter field to be named.');
        }
        if ($value === '')
        {
            throw new Exception('setParameter() requires a parameter value to be assigned: $field');
        }
        $this->params[$field] = $value;
    }
	
	
	
    public function checkfields($type)
    {
		$check = true;
		
		switch($type){
			case 'CREATE': $check = true;
				break;
			case 'UPDATE': $check = true;
				break;
			case 'CANCEL': $check = false;
				break;
			case 'STATUS': $check = false;
				break;
			default: $check = true;
				break;
		}
		if(!$check) {
			return true;
		}
		
		// Check for required fields
		if (in_array(FALSE, $this->required_fields))
		{
			$fields = array();
			foreach ($this->required_fields as $key => $field)
			{
				if (!$field) $fields[] = $key;
			}
			show_error('payment.required: '.implode(', ', $fields));
			//throw new Exception('payment.required: Missing fields required ' . implode(', ', $fields));
			return false;
		}
		return true;
	}	
		
	public function process()
    {
		$type = $this->params['operation'];
		// Check for required fields
		if (!$this->checkfields($type))
			return false;
		
		switch($type){
			case 'CREATE': $this->createAccount();
				break;
			case 'UPDATE': $this->updateAccount();
				break;
			case 'CANCEL': $this->cancelAccount();
				break;
			case 'STATUS': $this->statusAccount();
				break;
			default: $this->createAccount();
				break;
		}
		
		
        $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_URL, $this->url);
        curl_setopt($this->ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, Array('Content-Type: text/xml'));
        curl_setopt($this->ch, CURLOPT_HEADER, 0);
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $this->xml);
        curl_setopt($this->ch, CURLOPT_POST, 1);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, 0);
        $this->response = curl_exec($this->ch);
        if($this->response)
        {
            $this->parseResults();
            if ($this->resultCode === 'Ok')
            {
                $this->success = true;
				$this->transaction = TRUE;
                $this->error   = false;
            }
            else
            {
                $this->success = false;
                $this->transaction = FALSE;
				$this->error   = true;
            }
            curl_close($this->ch);
            unset($this->ch);
            return $this->transaction;
        }
		show_error('ARB.payment.connection: ' . curl_error($this->ch) . ' (' . curl_errno($this->ch) . ')');
        //throw new Exception('Connection error: ' . curl_error($this->ch) . ' (' . curl_errno($this->ch) . ')', self::EXCEPTION_CURL);
    }
	
	public function statusAccount()
    {
		
        $this->xml = "<?xml version='1.0' encoding='utf-8'?>
                      <ARBGetSubscriptionStatusRequest xmlns='AnetApi/xml/v1/schema/AnetApiSchema.xsd'>
                          <merchantAuthentication>
                              <name>" . $this->login . "</name>
                              <transactionKey>" . $this->transkey . "</transactionKey>
                          </merchantAuthentication>
						  <refId>" . $this->params['refID'] ."</refId>
                          <subscriptionId>" . $this->params['subscrId'] . "</subscriptionId>
                      </ARBGetSubscriptionStatusRequest>";
		
    }
	

	//public function create()
    public function createAccount($echeck = false)
    {

        $this->xml = "<?xml version='1.0' encoding='utf-8'?>
                      <ARBCreateSubscriptionRequest xmlns='AnetApi/xml/v1/schema/AnetApiSchema.xsd'>
                          <merchantAuthentication>
                              <name>" . $this->login . "</name>
                              <transactionKey>" . $this->transkey . "</transactionKey>
                          </merchantAuthentication>
                          <refId>" . $this->params['refID'] ."</refId>
                          <subscription>
                              <name>". $this->params['subscrName'] ."</name>
                              <paymentSchedule>
                                  <interval>
                                      <length>". $this->params['interval_length'] ."</length>
                                      <unit>". $this->params['interval_unit'] ."</unit>
                                  </interval>
                                  <startDate>" . $this->params['startDate'] . "</startDate>
                                  <totalOccurrences>". $this->params['totalOccurrences'] . "</totalOccurrences>
                                  <trialOccurrences>". $this->params['trialOccurrences'] . "</trialOccurrences>
                              </paymentSchedule>
                              <amount>". $this->params['amount'] ."</amount>
                              <trialAmount>" . $this->params['trialAmount'] . "</trialAmount>
                              <payment>";
        if ($echeck)
        {
            $this->xml .= "
                                  <bankAccount>
                                      <accountType>". $this->params['accountType'] ."</accountType>
                                      <routingNumber>". $this->params['routingNumber'] ."</routingNumber>
                                      <accountNumber>". $this->params['accountNumber'] ."</accountNumber>
                                      <nameOnAccount>". $this->params['nameOnAccount'] ."</nameOnAccount>
                                      <bankName>". $this->params['bankName'] ."</bankName>
                                  </bankAccount>";
        }
        else
        {
            $this->xml .= "
                                  <creditCard>
                                      <cardNumber>" . $this->params['cardNumber'] . "</cardNumber>
                                      <expirationDate>" . $this->params['expirationDate'] . "</expirationDate>
                                  </creditCard>";
        }

        $this->xml .= "
                              </payment>
                              <order>
                                  <invoiceNumber>" . $this->params['orderInvoiceNumber'] . "</invoiceNumber>
                                  <description>" . $this->params['orderDescription'] . "</description>
                              </order>
                              <customer>
                                  <id>" . $this->params['customerId'] . "</id>
                                  <email>" . $this->params['customerEmail'] . "</email>
                                  <phoneNumber>" . $this->params['customerPhoneNumber'] . "</phoneNumber>
                                  <faxNumber>" . $this->params['customerFaxNumber'] . "</faxNumber>
                              </customer>
                              <billTo>
                                  <firstName>". $this->params['firstName'] . "</firstName>
                                  <lastName>" . $this->params['lastName'] . "</lastName>
                                  <company>" . $this->params['company'] . "</company>
                                  <address>" . $this->params['address'] . "</address>
                                  <city>" . $this->params['city'] . "</city>
                                  <state>" . $this->params['state'] . "</state>
                                  <zip>" . $this->params['zip'] . "</zip>
                              </billTo>
                              <shipTo>
                                  <firstName>". $this->params['shipFirstName'] . "</firstName>
                                  <lastName>" . $this->params['shipLastName'] . "</lastName>
                                  <company>" . $this->params['shipCompany'] . "</company>
                                  <address>" . $this->params['shipAddress'] . "</address>
                                  <city>" . $this->params['shipCity'] . "</city>
                                  <state>" . $this->params['shipState'] . "</state>
                                  <zip>" . $this->params['shipZip'] . "</zip>
                              </shipTo>
                          </subscription>
                      </ARBCreateSubscriptionRequest>";
        
		//$this->process();
    }

    public function updateAccount()
    {
		
        $this->xml = "<?xml version='1.0' encoding='utf-8'?>
                      <ARBUpdateSubscriptionRequest xmlns='AnetApi/xml/v1/schema/AnetApiSchema.xsd'>
                          <merchantAuthentication>
                              <name>" . $this->login . "</name>
                              <transactionKey>" . $this->transkey . "</transactionKey>
                          </merchantAuthentication>
                          <refId>" . $this->params['refID'] ."</refId>
                          <subscriptionId>" . $this->params['subscrId'] . "</subscriptionId>
                          <subscription>
                              <name>". $this->params['subscrName'] ."</name>
                              <paymentSchedule>
                                  <startDate>" . $this->params['startDate'] . "</startDate>
                              </paymentSchedule>
                              <amount>". $this->params['amount'] ."</amount>
                              <trialAmount>" . $this->params['trialAmount'] . "</trialAmount>							  
                              <payment>
                                  <creditCard>
                                      <cardNumber>" . $this->params['cardNumber'] . "</cardNumber>
                                      <expirationDate>" . $this->params['expirationDate'] . "</expirationDate>
                                  </creditCard>
                              </payment>
                              <order>
                                  <invoiceNumber>" . $this->params['orderInvoiceNumber'] . "</invoiceNumber>
                                  <description>" . $this->params['orderDescription'] . "</description>
                              </order>
                              <customer>
                                  <id>" . $this->params['customerId'] . "</id>
                                  <email>" . $this->params['customerEmail'] . "</email>
                                  <phoneNumber>" . $this->params['customerPhoneNumber'] . "</phoneNumber>
                                  <faxNumber>" . $this->params['customerFaxNumber'] . "</faxNumber>
                              </customer>
                              <billTo>
                                  <firstName>". $this->params['firstName'] . "</firstName>
                                  <lastName>" . $this->params['lastName'] . "</lastName>
                                  <company>" . $this->params['company'] . "</company>
                                  <address>" . $this->params['address'] . "</address>
                                  <city>" . $this->params['city'] . "</city>
                                  <state>" . $this->params['state'] . "</state>
                                  <zip>" . $this->params['zip'] . "</zip>
                              </billTo>
                              <shipTo>
                                  <firstName>". $this->params['shipFirstName'] . "</firstName>
                                  <lastName>" . $this->params['shipLastName'] . "</lastName>
                                  <company>" . $this->params['shipCompany'] . "</company>
                                  <address>" . $this->params['shipAddress'] . "</address>
                                  <city>" . $this->params['shipCity'] . "</city>
                                  <state>" . $this->params['shipState'] . "</state>
                                  <zip>" . $this->params['shipZip'] . "</zip>
                              </shipTo>
                          </subscription>
                      </ARBUpdateSubscriptionRequest>";
        
		//$this->process();
    }

    public function cancelAccount()
    {
		
        $this->xml = "<?xml version='1.0' encoding='utf-8'?>
                      <ARBCancelSubscriptionRequest xmlns='AnetApi/xml/v1/schema/AnetApiSchema.xsd'>
                          <merchantAuthentication>
                              <name>" . $this->login . "</name>
                              <transactionKey>" . $this->transkey . "</transactionKey>
                          </merchantAuthentication>
                          <refId>" . $this->params['refID'] ."</refId>
                          <subscriptionId>" . $this->params['subscrId'] . "</subscriptionId>
                      </ARBCancelSubscriptionRequest>";
        
		//$this->process();
    }

    private function parseResults()
    {
        $response = str_replace('xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd"', '', $this->response);
        $xml = new SimpleXMLElement($response);
		/*
		echo "<pre>";
		print_r($xml);
		echo "</pre>";
		*/
        $this->resultCode = (string) $xml->messages->resultCode;
        $this->code       = (string) $xml->messages->message->code;
        $this->text       = (string) $xml->messages->message->text;
		$this->status  	  = (string) $xml->Status;
        $this->subscrId   = (string) $xml->subscriptionId;
    }
	
	
    public function __destruct()
    {
        if (isset($this->ch))
        {
            curl_close($this->ch);
        }
    }

    public function __toString()
    {
		
        if (!$this->params)
        {
            return (string) $this;
        }
        $output  = '';
        $output .= '<table summary="Authnet Results" id="authnet">' . "\n";
        $output .= '<tr>' . "\n\t\t" . '<th colspan="2"><b>Outgoing Parameters</b></th>' . "\n" . '</tr>' . "\n";
        foreach ($this->params as $key => $value)
        {
            $output .= "\t" . '<tr>' . "\n\t\t" . '<td><b>' . $key . '</b></td>';
            $output .= '<td>' . $value . '</td>' . "\n" . '</tr>' . "\n";
        }
        $output .= '</table>' . "\n";
        if (!empty($this->xml))
        {
            $output .= 'XML: ';
            $output .= htmlentities($this->xml);
        }
        return $output;
    }

    public function success()
    {
        return $this->success;
    }

    public function isError()
    {
        return $this->error;
    }

    public function getResponse()
    {
        return strip_tags($this->text);
    }

    public function getResponseCode()
    {
        return $this->code;
    }

    public function subscription()
    {
		$subscription = array();
		
		$subscription['login'] = $this->login;
		$subscription['transkey'] = $this->transkey;
		$subscription['test'] = $this->test;
		$subscription['url'] = $this->url;
		$subscription['resultCode'] = $this->resultCode;
		$subscription['code'] = $this->code;
		$subscription['text'] = $this->text;
		$subscription['sid'] = $this->subscrId;
		$subscription['success'] = $this->success;
		$subscription['status'] = $this->status;
		$subscription['error'] = $this->error;
        
		return $subscription;
    }
}// End Payment_ARBAuthorize_Driver Class

?>