<?php
//require_once(@realpath(dirname(__FILE__)).'/basemodel'.EXT);
class Membermodel extends Basemodel{

protected $_table_name = "member";
	
	function getMemberList()
	{
		$this->db->from($this->_table_name);
		$this->db->order_by($this->_table_name.'.id');
		return $this->db->get();
	}
	
	public function getMembersListArray($limit = false)
	{
		$this->db->from($this->_table_name);
		$this->db->order_by($this->_table_name.'.id');
		$this->db->limit($limit);
		$query =$this->db->get();

		$sql = $this->db->last_query();	
		//$this->firephp->log('query : ' . $sql);

		$result = $query->row();      
        if ($query->num_rows() > 0)
        {
				$res = $query->result_array();
				//var_dump($res);
				$res2 = array();
        		foreach($res as $key => $val)
        		{
        			$res1 = array();
					foreach($val as $k => $v)
        			{
						//if($k != 'verified' && $k != 'advocacy' && $k != 'logo') $res1[$k] = $v;
						if($k != 'expiration' && $k != 'type' && $k != 'created' && $k != 'updated' && $k != 'uid' )  $res1[$k] = $v;
	        		}
					$res2[] = $res1;	
        		}
        		//var_dump($res2);
        		return $res2;					        								   
		}						
		return false;
	}	
}
