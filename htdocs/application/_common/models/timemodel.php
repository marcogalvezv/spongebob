<?php
require_once(@realpath(dirname(__FILE__)).'/basemodel'.EXT);
class Timemodel extends Basemodel{

protected $_table_name = "time";
	
	function getTimeList()
	{
		$this->db->select($this->_table_name.'.*');
		$this->db->from($this->_table_name);
		$this->db->order_by($this->_table_name.'.id');
		$result = $this->db->get()->result_array();
		
		$sql = $this->db->last_query();
		//echo "<pre>";
		//print_r($sql);
		//echo "</pre>";
		return $result;
	}

	function getTimesByIdRestList($idrest = 0)
	{
		$result = null;

		$sql = "SELECT t.id, TIME_FORMAT(t.hour_ini,'%H:%i') AS hour_ini, TIME_FORMAT(t.hour_end,'%H:%i') AS hour_end, s.day";
		$sql .=" FROM ".$this->_table_name." t, shift s";
		$sql .=" WHERE t.id = s.idtime";
		$sql .=" AND s.idrest = '{$idrest}'";
		$sql .=" AND s.status = 1";
		$sql .=" ORDER BY s.day, t.id";

/*		echo "<pre>";
		print_r($sql);
		echo "</pre>";
*/
		$query = $this->db->query($sql);

		if ($query->num_rows() > 0)
		{
			$result = $query->result_array();
		}
		return $result;
	}

}