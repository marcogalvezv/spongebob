<?php
//require_once(@realpath(dirname(__FILE__)).'/basemodel'.EXT);
class Settingsmodel extends Basemodel{

protected $_table_name = "settings";
	
	function getSettingsList()
	{
		$this->db->from($this->_table_name);
		$this->db->order_by($this->_table_name.'.id');
		return $this->db->get();
	}
}