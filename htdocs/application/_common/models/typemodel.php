<?php
//require_once(@realpath(dirname(__FILE__)).'/basemodel'.EXT);
class Typemodel extends Basemodel
{	
protected $_table_name = "type";

	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->load->database();
	}
	
	function getTypeList()
	{
		$this->db->from($this->_table_name);
		$this->db->order_by($this->_table_name.'.id');
		return $this->db->get()->result_array();
	}

}
