<?php
class Continentmodel extends Basemodel{

protected $_table_name = "continent";
	
	function getList()
	{
		$this->db->from($this->_table_name);
		$this->db->order_by($this->_table_name.'.name');
		return $this->db->get();
	}
}