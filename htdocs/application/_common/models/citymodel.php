<?php
//require_once(@realpath(dirname(__FILE__)).'/basemodel'.EXT);
class Citymodel extends Basemodel{

protected $_table_name = "city";
	
	function getCityList()
	{
		$this->db->from($this->_table_name);
		$this->db->order_by($this->_table_name.'.name');
		return $this->db->get();
	}

}
