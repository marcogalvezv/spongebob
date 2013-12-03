<?php
//require_once(@realpath(dirname(__FILE__)).'/basemodel'.EXT);
class Languagemodel extends Basemodel{

protected $_table_name = "language";
//protected $_project_status = array(0=>"",1=>"",2=>"",3=>"",4=>"",);
	
	function getLanguageList()
	{
		$this->db->from($this->_table_name);
		$this->db->order_by($this->_table_name.'.id');
		return $this->db->get();
	}
	
	function getLanguageListArray($orderby = 'desc')
	{
		//$this->db->select($this->_table_name.'.short');
		$this->db->from($this->_table_name);
		$this->db->order_by($this->_table_name.'.id', $orderby);
		return $this->db->get()->result_array();
	}
	
	function getLanguageListISO()
	{
		$countries = $this->getLanguageListArray();
		$list = array();;
		if(isset($countries)){
			foreach($countries as $country)
				$list[] = $country['short'];
		}
		$this->db->from('language_iso');
		$this->db->where_not_in('language_iso.short', $list);
		$this->db->order_by('language_iso.nameen');
		return $this->db->get();
	}
}