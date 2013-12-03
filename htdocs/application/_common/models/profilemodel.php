<?php
//require_once(@realpath(dirname(__FILE__)).'/basemodel'.EXT);
class Profilemodel extends Basemodel
{	
protected $_table_name = "profile";	

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->load->database();
	}

/*	public function getByID($id) {
		$query = $this->db->query("SELECT * FROM profile WHERE id = ?", $id);
		return (array)$this->_singleRow($query);
	}
*/
	public function getMembers($filterby = false)
	{
		$this->db->select('profile.*');
		$this->db->from('profile');
		$this->db->join('user','user.id = profile.uid', 'left');
		$this->db->where('user.gid', 2);
		$this->db->order_by('uid', 'DESC');
		$query = $this->db->get();

		$res = array();
		if ($query->num_rows() > 0)
		{
			$result = $query->result_array();
			$res = array();
			foreach($result as $row) {
				$res[] = $row;
			}
		}
		return $res;
	}

    public function getDrivers()
    {
        $this->db->select('profile.*');
        $this->db->from('profile');
        $this->db->join('user','user.id = profile.uid', 'left');
        $this->db->where('user.gid', 4);
        $this->db->order_by('uid', 'DESC');
        $query = $this->db->get();

        $res = array();
        if ($query->num_rows() > 0)
        {
            $result = $query->result_array();
            $res = array();
            foreach($result as $row) {
                $res[] = $row;
            }
        }
        log_message("debug","*********Data:".print_r($res,true));
        return $res;
    }


    public function deleteProfilesByFreeUserID($uid) {
		$this->db->select('profile.id');
		$this->db->from('profile');
		$this->db->join('user','user.id = profile.uid', 'left');
		$this->db->where('profile.uid', $uid);
		$this->db->where('profile.email', '');
		$query = $this->db->get();
		
		if ($query->num_rows() > 0)
		{
			$result = $query->result();
			foreach($result as $row)
			{
				/*
				echo "<pre>";	
				print_r($row->id);
				echo "</pre>";
				*/
				$this->db->where('id', $row->id);
				$this->db->delete('profile');
			}
		}
  	}
	
  /**
   * Stores the profile image name
   * @param Int $profile_id
   * @param String $image_name
   * @return Int 1 on success, 0 if it is not possible to save the image name, -1 on error
   */  
	function save_profile_image_name ($profile_id, $image_name) {
    try{
			$this->db->where('id', $profile_id);
			$result = $this->db->update('profile', array('avatar' => $image_name));
		  if ($result){
		  	return 1;
		  } else {
		    return 0;
		  }  
		} catch (Exception $e) {
			return -1;
		}
	}
	function getAge($uid)
	{
		$sql = "select year(curdate()) - year(birthdate) + if(date_format(curdate(), '%m-%d') > date_format(birthdate, '%m-%d'), 0, -1) as age from profile where uid = ".$uid;
		$query = $this->db->query($sql);
		return 	$query->row();
	}	
	function setProfile($uid, $values)
	{
		$sql = "update profile set ".$values." where uid = ".$uid;
		$this->db->query($sql);
		return $sql;
	}
}
