<?php
class Newslettermodel extends Basemodel{

protected $_table_name = "newsletter";

	public function delete_newsletter_sent($data) {
		foreach ($data as $id => $row){
			$this->delete_newsletter($id);
		}
		return ($this->db->affected_rows() > 0) ? true : false;
  	}
	
	public function delete_newsletter($id) {
		$id = (int)$id;
		$this->db->where('idnewsletter', $id);
		$this->db->delete('newsletter_sent');
		return ($this->db->affected_rows() > 0) ? true : false;
  	}
	
	public function delete_newsletter_by_member($id) {
		$id = (int)$id;
		$this->db->where('uid', $id);
		$this->db->delete('newsletter_sent');
		return ($this->db->affected_rows() > 0) ? true : false;
  	}
	
	public function update_newsletter_sent($id) {
		$id = (int)$id;
		$data['sent'] = 1;
		$data['sentdate'] = date('Y-m-d');
		$this->db->where('idnewsletter', $id);
		$this->db->update('newsletter_sent',$data);
		return ($this->db->affected_rows() > 0) ? true : false;
  	}
		
	public function update_newsletter_sent_by_user($idnewsletter, $uid) {
		$idnewsletter = (int)$idnewsletter;
		$uid = (int)$uid;
		
		$data = array();
		$data['sent'] = 1;
		$data['sentdate'] = date('Y-m-d');
		
		$this->db->where('idnewsletter', $idnewsletter);
		$this->db->where('uid', $uid);
		$this->db->update('newsletter_sent',$data);
		
		return ($this->db->affected_rows() > 0) ? true : false;
  	}
	
	public function save_newsletter_by_members($id, $members){
		$id = (int)$id;
		if(isset($members) && is_array($members) && count($members) > 0){
			foreach($members as $member){
				$row['idnewsletter'] = $id;
				$row['uid'] = $member['id'];
				$relation = 'newsletter_sent';	    
				$this->db->insert($relation, $row);
			}
		}
		return ($this->db->affected_rows() > 0) ? true : false;
	}
	
	function get_newsletter_members($limit = 1000)
	{
		$this->db->select("newsletter_sent.idnewsletter");
		$this->db->select("newsletter_sent.uid");
		$this->db->select("profile.email");
		$this->db->from("newsletter_sent");
		$this->db->join("profile","newsletter_sent.uid = profile.uid", "left");
		$this->db->where("newsletter_sent.sent !=",'1');
		//$this->db->order_by($this->_table_name.'.id');
		$this->db->limit($limit);
		
		$sql = $this->db->last_query();	
		echo $sql;
		
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
				$res['idnewsletter'] = $row->idnewsletter;
				$res['uid'] = $row->uid;
				$res['email'] = $row->email;
				$res2[] = $res;
			}
			return $res2;
		}
		return false;
	}
	

	function send_bulk_email($newsletter, $emails)
	{
		$data = array();
		$data['title'] = $newsletter['title'];
		$data['content'] = $newsletter['content'];
		$subject = "FlySocial: {$newsletter['title']}";
		//GET EMAIL CONTENT FROM DATABASE
		$message = $this->load->view('email/profile/template', $data, true);
		
		$from = $this->config->item('email_from_address');
		//SEND COPY EMAILS
		$Cc = "";
		$Bcc = "";
		
		if(isset($emails) && is_array($emails) && count($emails) > 0){
			foreach($emails as $email){		
				$to = $email;
				//SEND EMAIL
				$res = send_email($to, $from, $subject, $message);
				if($res !== TRUE) break;
			}
		}		
		return $res;
	}
	
	function send_newsletter_email($newsletter, $email)
	{	
		$data = array();
		$data['title'] = $newsletter['title'];
		$data['content'] = $newsletter['content'];
		$subject = "FlySocial: {$newsletter['title']}";
		//GET EMAIL CONTENT FROM DATABASE
		$message = $this->load->view('email/manage/template', $data, TRUE);
		
		$from = $this->config->item('email_from_address');
        $to = $email;
		
		//SEND COPY EMAILS
		$Cc = "";
		$Bcc = "";
		//SEND EMAIL
		$res = send_email($to, $from, $subject, $message);
		return $res;
	}		
	function getMailList($uidto = 0, $uid = 0, $state = 1){
		$sql = "SELECT m.*, ms.uid AS uid_friend, ms.state, p.id AS idprofile, p.firstname, p.lastname, p.avatar";
		$sql .= " FROM ".$this->_table_name." m";

		if($uidto != 0)
			$sql .= " JOIN `newsletter_sent` ms ON m.id = ms.idnewsletter AND ms.uid = ".$uidto;
		else
			$sql .= " JOIN `newsletter_sent` ms ON m.id = ms.idnewsletter";

		$sql .= " JOIN `profile` p ON m.uid = p.uid";

		if($state >= 0)
			$sql .= " WHERE ms.state >= ".$state;
		else
			$sql .= " WHERE ms.state = ".$state;
		
		if($uid != 0)
			$sql .= " AND m.uid = ".$uid;

		$sql .= " ORDER BY m.id DESC";

		
		$query = $this->db->query($sql);
		
		if ($query->num_rows() > 0)
		{
			return $query->result();
		}
		return null;
	}

	function getSentMailList($uidto = 0, $uid = 0, $state = 1){
		$sql = "SELECT m.*, ms.uid AS uid_friend, ms.state, p.id AS idprofile, p.firstname, p.lastname, p.avatar";
		$sql .= " FROM ".$this->_table_name." m";

		if($uidto != 0)
			$sql .= " JOIN `newsletter_sent` ms ON m.id = ms.idnewsletter AND ms.uid = ".$uidto;
		else
			$sql .= " JOIN `newsletter_sent` ms ON m.id = ms.idnewsletter";

		$sql .= " JOIN `profile` p ON ms.uid = p.uid";

		if($state >= 0)
			$sql .= " WHERE ms.state >= ".$state;
		else
			$sql .= " WHERE ms.state = ".$state;
		
		if($uid != 0)
			$sql .= " AND m.uid = ".$uid;

		$sql .= " ORDER BY m.id DESC";

		
		$query = $this->db->query($sql);
		
		if ($query->num_rows() > 0)
		{
			return $query->result();
		}
		return null;
	}
}