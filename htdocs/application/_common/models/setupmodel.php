<?php
//require_once(@realpath(dirname(__FILE__)).'/basemodel'.EXT);
class Setupmodel extends Basemodel
{	
protected $_table_name = "setup";
	
	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->load->database();
	}

}
