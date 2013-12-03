<?php

class Persistencemodel extends CI_Model 
{
  /**
   * The number of seconds the cookie will be valid
   * @var Int
   */
	var $age;
	
	/**
	 * Class contructor method
	 */
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();

        //setting timezone
        date_default_timezone_set('America/La_Paz');
        
		$this->load->database();
		$this->age = 259200;
  }
 
  /**
   * Inserts a persistnce key in the database
   * @param Array $data containing the uid, ip and unique_id keys
   * @return Int last insert id on success, 0 otherwise on error
   */ 
  function insert_persistence_key ($data) {
		if(!$data['uid'] || !$data['ip'] || !$data['unique_id'] || !$data['time']){
			return false;
		}
		$data['time'] = date('Y-m-d H:i:s', $data['time']);
		try{  
		  $this->db->insert('userpersistence', $data);
		  return $this->db->insert_id();
		} catch (Exception $e) {
			return 0;
		}
  }
  /**
   * Updated a persistence key row in the database
   * @param Int $key_id the row id to be updated
   * @param Array $data containing the uid, ip and unique_id keys
   * @return Bool true on success, false otherwise
   */ 
  function update_persistence_key ($key_id, $data) {
  	if(!$data['uid'] || !$data['ip'] || !$data['unique_id'] || !$data['time']){
  		return false;
		}
		$data['time'] = date('Y-m-d H:i:s', $data['time']);
		try{  
			$this->db->where('id', $key_id);
			$result = $this->db->update('userpersistence', $data);
		  if ($result){
		  	return true;
		  } else {
		    return false;
		  }  
		} catch (Exception $e) {
			return false;
		}
  }
  
  /**
   * Retrieves the persistence key of an user, if it is older than the age, if it is found, the delete_persistence_key is called 
   * and creates a new one for the given data
   * @param Array $data containing the uid, ip and unique_id keys
   * @return Object|Bool, the persistence key data objec if found, 0 if it doesn't exist or an error occurs
   */
  function get_persistence_key ($data) {
  	if(!$data['uid'] || !$data['ip'] || !$data['unique_id'])
		  return 0;
		$time = time() - $this->age;  
		$sql = "SELECT * FROM userpersistence 
		                 WHERE uid = '". $data['uid']."' 
		                   AND ip = '". $data['ip']."' 
		                   AND unique_id = '". $data['unique_id']."' 
		                   AND time > " . $time . "
		                 LIMIT 1";
		/**
		 * @todo The query should not include the time in the where clause, I should get the time and then  compare it
		 * to the value recived in data, whether it is still valid or not a match should be deleted, if is is valid, delte and create a
		 * new one[return true], if not, delete since it will not be used[return false]  
		 */
		try {
		  $query = $this->db->query($sql);
		  if ($query->num_rows() > 0) {
  	    $row = $query->row();
  	    return $row;
		  } else return false;
		} catch (Exception $e) {
			return false;
		}
  }
  
  /**
   * Removes a persistence key from the database, making it unavailable even if the cookie exists on the user's machine
   * @param Int $key_id, the id of the key ot be deleted
   * @return Int, the number of affected(deleted) rows, 0 if no row was affected, -1 on error
   */
  function remove_persistence_key ($key_id) {
  	if(!$key_id || !is_numeric($key_id))
		  return 0;
  	try {
  		$query = $this->db->delete('userpersistence', array('id' => $key_id));
  		return $this->db->affected_rows(); 
  	} catch (Exception $e) {
  		return -1;
  	}
  }
  
  /**
   * Removes all expired persistence key to avoid table overhead. This should be used upon user login.
   * @param Int $uid
   * @return Int, 1 if keys have been delted, 0 if no key was deleted, -1 on error
   */
  function remove_expired_keys ($uid) {
  	if (!$uid)
  	  return 0;
  	$data['uid'] = $uid;
  	$data['time <'] = date('Y-m-d H:i:s', time() - $this->age);
  	try {
  	  $this->db->where($data); 
  	  $this->db->delete('userpersistence', $data);
  	  return $this->db->affected_rows();
  	} catch (Exception $e) {
  		echo 'error';
  		return -1;
  	}
  }
  
  

}

/* End of file persistencemodel.php */
/* Location: ./system/application/models/persistencemodel.php */
