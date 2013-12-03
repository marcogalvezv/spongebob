<?php
//require_once(@realpath(dirname(__FILE__)).'/basemodel'.EXT);
class Mailsentmodel extends Basemodel
{	
	protected $_table_name = "mail_sent";
	
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->load->database();
	}
	
	public function saveMailsent(array $mailsent){
			/*$data = array(
			   'name' => $country['name'] ,
			   'fullname' => $country['fullname'] ,
			   'prefix' => $country['prefix'] ,
			   'currency' => $country['currency'] 
			);*/

		return $this->db->insert('mail_sent', $mailsent);
	}

}
