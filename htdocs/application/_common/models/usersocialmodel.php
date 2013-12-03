<?php
class Usersocialmodel extends Basemodel{

protected $_table_name = "usersocial";
protected $arrFormats = array(1=>'%Y-%m-%d',2=>'%Y-%U',3=>'%Y-%m',4=>'%Y');
private $months = array('01'=>'January','02'=>'February','03'=>'March','04'=>'April','05'=>'May','06'=>'June','07'=>'July','08'=>'August','09'=>'September','10'=>'October','11'=>'November','12'=>'December');
	
	public function delete($uid) {
		$uid = (int)$uid;
		$this->db->where('uid', $uid);
		$this->db->delete('usersocial');
		return ($this->db->affected_rows() > 0) ? true : false;
  	}
	
	public function update($uid, $social){
		
		$this->delete($uid);
		
		$uid = (int)$uid;
		if(isset($social) && is_array($social) && count($social) > 0){
			foreach($social as $idsocial){
				$row['uid'] = $uid;
				$row['idsocial'] = $idsocial;
				$relation = 'usersocial';	    
				$this->db->insert($relation, $row);
			}
		}
		return ($this->db->affected_rows() > 0) ? true : false;
	}
	
			
	public function getUserSocial($uid) {
		
		$uid = (int)$uid;
		
		$this->db->select('usersocial.*');
		$this->db->select('social_network.cod');
		$this->db->select('social_network.name');
		$this->db->select('social_network.url');
		$this->db->select('social_network.filename');
		$this->db->from('social_network');
		$this->db->join('usersocial','usersocial.idsocial = social_network.id', 'left');
		$this->db->where('usersocial.uid', $uid);
		//$this->db->order_by('uid', 'DESC');
		$query = $this->db->get();
		
		$res = array();
		if ($query->num_rows() > 0)
		{
			$result = $query->result_array();
			$res = array();
			foreach($result as $row) {
				$res[$row['idsocial']] = $row;
			}
		}
		return $res;
	}	
	
	function getStatsSingUpsList($from, $to, $groupby)
	{
		if(isset($from) && isset($to))
		{
			$command = "SELECT COUNT(u.id) AS qty, DATE_FORMAT(u.created,'{$this->arrFormats[$groupby]}') as cdate";
			$command .= " FROM user u";
			$command .= " WHERE (DATE_FORMAT(u.created,'%Y-%m-%d')>= '".$from."' and DATE_FORMAT(u.created,'%Y-%m-%d')<= '".$to."')";
			$command .= " AND u.status = 1";
			$command .= " GROUP BY DATE_FORMAT(u.created,'{$this->arrFormats[$groupby]}')";
			$command .= " ORDER BY 2";
			//echo $command;
			$query = $this->db->query($command);

			return $query->result();
		}
	}

	function getStatsSingInList($from, $to, $groupby)
	{
		if(isset($from) && isset($to))
		{
			$command = "SELECT COUNT(u.id) AS qty, DATE_FORMAT(u.date,'{$this->arrFormats[$groupby]}') as cdate";
			$command .= " FROM userlogged u";
			$command .= " WHERE (DATE_FORMAT(u.date,'%Y-%m-%d')>= '".$from."' and DATE_FORMAT(u.date,'%Y-%m-%d')<= '".$to."')";
			$command .= " GROUP BY DATE_FORMAT(u.date,'{$this->arrFormats[$groupby]}')";
			$command .= " ORDER BY 2";
			//echo $command;
			$query = $this->db->query($command);

			return $query->result();
		}
	}

	function getStatsFlightsList($from, $to, $groupby)
	{
		if(isset($from) && isset($to))
		{
			$command = "SELECT COUNT(f.id) AS qty, DATE_FORMAT(f.created,'{$this->arrFormats[$groupby]}') as cdate";
			$command .= " FROM flight f";
			$command .= " WHERE (DATE_FORMAT(f.created,'%Y-%m-%d')>= '".$from."' and DATE_FORMAT(f.created,'%Y-%m-%d')<= '".$to."')";
			$command .= " GROUP BY DATE_FORMAT(f.created,'{$this->arrFormats[$groupby]}')";
			$command .= " ORDER BY 2";
			//echo $command;
			$query = $this->db->query($command);

			return $query->result();
		}
	}

	function getStatsNewFriendsList($from, $to, $groupby)
	{
		if(isset($from) && isset($to))
		{
			$command = "SELECT COUNT(f.id) AS qty, DATE_FORMAT(f.created,'{$this->arrFormats[$groupby]}') as cdate";
			$command .= " FROM friend f";
			$command .= " WHERE (DATE_FORMAT(f.created,'%Y-%m-%d')>= '".$from."' and DATE_FORMAT(f.created,'%Y-%m-%d')<= '".$to."')";
			$command .= " GROUP BY DATE_FORMAT(f.created,'{$this->arrFormats[$groupby]}')";
			$command .= " ORDER BY 2";
			//echo $command;
			$query = $this->db->query($command);

			return $query->result();
		}
	}

	function getStatsMailsSentList($from, $to, $groupby)
	{
		if(isset($from) && isset($to))
		{
			$command = "SELECT COUNT(m.id) AS qty, DATE_FORMAT(m.created,'{$this->arrFormats[$groupby]}') as cdate";
			$command .= " FROM mail_sent m";
			$command .= " WHERE (DATE_FORMAT(m.created,'%Y-%m-%d')>= '".$from."' and DATE_FORMAT(m.created,'%Y-%m-%d')<= '".$to."')";
			$command .= " GROUP BY DATE_FORMAT(m.created,'{$this->arrFormats[$groupby]}')";
			$command .= " ORDER BY 2";
			//echo $command;
			$query = $this->db->query($command);

			return $query->result();
		}
	}

	function getCheckinsSentList($from, $to, $groupby)
	{
		if(isset($from) && isset($to))
		{
			$command = "SELECT COUNT(c.id) AS qty, DATE_FORMAT(c.created,'{$this->arrFormats[$groupby]}') as cdate";
			$command .= " FROM checkin c";
			$command .= " WHERE (DATE_FORMAT(c.created,'%Y-%m-%d')>= '".$from."' and DATE_FORMAT(c.created,'%Y-%m-%d')<= '".$to."')";
			$command .= " GROUP BY DATE_FORMAT(c.created,'{$this->arrFormats[$groupby]}')";
			$command .= " ORDER BY 2";
			//echo $command;
			$query = $this->db->query($command);

			return $query->result();
		}
	}

	function getDatesMonth($dates)
	{
		if(isset($dates)){
			foreach($dates as $key => $date){
				$arrDate = explode("-", $date);
				
//				$dates[$key] = substr($this->months[$arrDate[1]],0,3).'-'.$arrDate[0];
				$dates[$key] = substr($this->months[$arrDate[1]],0,3).'-'.$arrDate[0];;
			}
			return $dates;
		}
	}
}