<?php
//require_once(@realpath(dirname(__FILE__)).'/basemodel'.EXT);
class Mailmodel extends Basemodel
{	
//	protected $_table_name = "mail";
	protected $_table_name = "newsletter";
	
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->load->database();
	}
	
	function getMailList($uidto = 0, $uid = 0){
		$sql = "SELECT m.*, ms.uid AS uid_friend, p.id AS idprofile, p.firstname, p.lastname, p.avatar";
		$sql .= " FROM ".$this->_table_name." m";

		if($uidto != 0)
			$sql .= " JOIN `newsletter_sent` ms ON m.id = ms.idnewsletter AND ms.uid = ".$uidto;
		else
			$sql .= " JOIN `newsletter_sent` ms ON m.id = ms.idnewsletter";

		$sql .= " JOIN `profile` p ON m.uid = p.uid";

		if($uid != 0)
			$sql .= " WHERE m.uid = ".$uid;

		$sql .= " ORDER BY m.id DESC";

		
		$query = $this->db->query($sql);
		
		if ($query->num_rows() > 0)
		{
			return $query->result();
		}
		return null;
	}

	function getSentMailList($uidto = 0, $uid = 0){
		$sql = "SELECT m.*, ms.uid AS uid_friend, p.id AS idprofile, p.firstname, p.lastname, p.avatar";
		$sql .= " FROM ".$this->_table_name." m";

		if($uidto != 0)
			$sql .= " JOIN `newsletter_sent` ms ON m.id = ms.idnewsletter AND ms.uid = ".$uidto;
		else
			$sql .= " JOIN `newsletter_sent` ms ON m.id = ms.idnewsletter";

		$sql .= " JOIN `profile` p ON ms.uid = p.uid";

		if($uid != 0)
			$sql .= " WHERE m.uid = ".$uid;

		$sql .= " ORDER BY m.id DESC";

		
		$query = $this->db->query($sql);
		
		if ($query->num_rows() > 0)
		{
			return $query->result();
		}
		return null;
	}

/*	function getEventMembers($idevent){
		$sql = "select p.avatar from eventinvites e left join profile p on e.uid = p.uid where e.idevent=".$idevent;
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			return $query->result();
		}

	}

	
	function getEventPosts($idevent){
		$sql = "select e.* ,p.firstname, p.avatar from event_post e left join profile p on e.uid = p.uid where e.idevent=".$idevent." order by e.created DESC limit 4";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			return $query->result();
		}

	}

	function setPost($uid, $idevent, $comment){
		$sql = "insert into event_post (content, uid, idevent,created) values('".$comment."',".$uid.",".$idevent.",now())";
		$query = $this->db->query($sql);
	}

	function getEvent($idevent){
		$sql = "SELECT e.*, c.fullname as namecountry";
		$sql .= " FROM `event` e left join `country` c on e.country = c.id";
		$sql .= " where e.id = ".$idevent;
		
		$query = $this->db->query($sql);
		
		if ($query->num_rows() > 0)
		{
			return $query->row();
		}
		return null;
	}			


	function setEventInvite($idevent, $uid, $action)
	{			//action = join, leave
		if($action == "Join")
			$sql = "insert into eventinvites values(".$idevent.", ".$uid.")";
		else
			$sql = "delete from eventinvites where idevent = ".$idevent." and uid = ".$uid;

		$query = $this->db->query($sql);
		
//		if ($query->num_rows() > 0)
//		{
//			return $query->row();
//		}
//		return null;
	}			

	function getEventListNotAttending($uid){

		$sql = "SELECT DISTINCT e.*, ei.*"; 
		$sql .= " FROM event e";
//		$sql .= " LEFT JOIN eventinvites ei ON ei.uid = ". $uid." AND e.id = ei.idevent";
		$sql .= " LEFT OUTER JOIN eventinvites ei ON e.id = ei.idevent";
		$sql .= " WHERE ei.idevent is null";
		$sql .= " AND date_ini > NOW()";
		$sql .= " ORDER BY date_ini ASC";

		$query = $this->db->query($sql);
		
		if ($query->num_rows() > 0)
		{
			return $query->result();
		}
		return null;
	}			

	function getEventListAttending($uid){

		$sql = "SELECT DISTINCT e.*";
		$sql .= " FROM event e";
		$sql .= " LEFT JOIN eventinvites ei ON e.id = ei.idevent";
		$sql .= " WHERE ei.uid = ".$uid;
		$sql .= " AND e.date_ini > NOW()";
		$sql .= " ORDER BY e.date_ini ASC";	
		$query = $this->db->query($sql);
		
		if ($query->num_rows() > 0)
		{
			return $query->result();
		}
		return null;
	}			

	function getEventListAttendingPast($uid){

		$sql = "SELECT DISTINCT e.*";
		$sql .= " FROM event e";
		$sql .= " LEFT JOIN eventinvites ei ON e.id = ei.idevent";
		$sql .= " WHERE ei.uid = ".$uid;
		$sql .= " AND e.date_ini <= now()";
		$sql .= " ORDER BY e.date_ini desc";		
		$query = $this->db->query($sql);
		
		if ($query->num_rows() > 0)
		{
			return $query->result();
		}
		return null;
	}			
*/	

}
