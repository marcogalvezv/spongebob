<?php
//require_once(@realpath(dirname(__FILE__)).'/basemodel'.EXT);
class Newslettersentmodel extends Basemodel
{	
	protected $_table_name = "newsletter_sent";
	
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->load->database();
	}
	
	function saveMailsent(array $mailsent){
		return $this->db->insert($this->_table_name, $mailsent);
	}

	function updateMailsent($data,$field,$value)
	{
//		$this->db->update($this->_table_name, $data, array($field => $value));
		$sql = "UPDATE ".$this->_table_name;
		$sql .= " SET {$field}=".$value;
		$sql .= " WHERE idnewsletter =".$data['idnewsletter'];
		$sql .= " AND uid = ".$data['uid'];
		return $this->db->query($sql);
	}

	function getByMailUsr($idmail,$uid)
	{
		$this->db->where('idnewsletter', $idmail);
		$this->db->where('uid', $uid);
		$this->db->from($this->_table_name);
		
		$query = $this->db->get();

		if ($query->num_rows() > 0)
		{
		   $row = $query->row_array(); 

		   return $row;
		}
		return null;
	}
	function deleteMailsent($idnewsletter,$uid)
	{
//		$this->db->update($this->_table_name, $data, array($field => $value));
		$sql = "DELETE FROM ".$this->_table_name;
		$sql .= " WHERE idnewsletter =".$idnewsletter;
		$sql .= " AND uid = ".$uid;
		return $this->db->query($sql);
	}
}
