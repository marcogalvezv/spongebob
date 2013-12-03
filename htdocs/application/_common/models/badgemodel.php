<?php
//require_once(@realpath(dirname(__FILE__)).'/basemodel'.EXT);
class Badgemodel extends Basemodel
{	
protected $_table_name = "badge";
protected $arrFormats = array(1=>'%Y-%m-%d',2=>'%Y-%U',3=>'%Y-%m',4=>'%Y');

	private $months = array('01'=>'January','02'=>'February','03'=>'March','04'=>'April','05'=>'May','06'=>'June','07'=>'July','08'=>'August','09'=>'September','10'=>'October','11'=>'November','12'=>'December');
	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->load->database();
	}
	function getBadgeList()
	{
		$this->db->from($this->_table_name);
		$this->db->order_by($this->_table_name.'.id');
		return $this->db->get()->result_array();
	}

	function getStatsAmountsList($from, $to, $groupby)
	{//Get results of amount of badges//
		if(isset($from) && isset($to))
		{
			$command = "SELECT b.id, b.cod, b.name, DATE_FORMAT(be.date_earned,'{$this->arrFormats[$groupby]}') AS date_earned, COUNT(be.id) AS badge_earned";
			$command .= " FROM `badge` b";
			$command .= " JOIN `badge_earned` be ON b.id = be.idbadge";
			
			$command .= " WHERE (be.date_earned >= '".$from."' and be.date_earned <= '".$to."')";
			
			$command .= " GROUP BY b.id, b.cod, b.name, DATE_FORMAT(be.date_earned,'{$this->arrFormats[$groupby]}')";
			$command .= " ORDER BY 4";
			//echo $command;
			$query = $this->db->query($command);

			return $query->result();
		}
	}
	
	function getDatesBetween($strDateFrom, $strDateTo, $groupby)
	{
		if(isset($strDateFrom)&&isset($strDateTo)){
			date_default_timezone_set('America/Los_Angeles');
/*echo $strDateFrom.' ';
echo strftime ('%Y-%U',strtotime($strDateFrom)).' ';
echo $strDateTo.' ';
echo strftime ('%Y-%U',strtotime($strDateTo)).' ';
*/
			$arrDateFrom = explode("-", $strDateFrom);
			$arrDateTo = explode("-", $strDateTo);
			$x = $arrDateFrom[0];//year;
			$y = $arrDateFrom[1];//month;
			$z = $arrDateFrom[2];//day;
			
			$u = $arrDateTo[0];//year;
			$v = $arrDateTo[1];//month;
			$w = $arrDateTo[2];//day;
			
			$gendate = '';
			$dates = array();
			for($i = (int)$x; $i<=(int)$u; $i++){
				
				if($groupby <= 3){
					if(sizeof($dates) > 0) $y = 1;
					
					for($j = (int)$y; $j<=12; $j++){

						if($groupby == 1){
							if(sizeof($dates)> 0) $z = 1;
						
							for($k = (int)$z; $k<=31; $k++){
								$gendate = (string)$i;
								if(strlen((string)$j)==1)
									$gendate .= '-0'.(string)$j;
								else $gendate .= '-'.(string)$j;

								if(strlen((string)$k)==1)
									$gendate .= '-0'.(string)$k;
								else $gendate .= '-'.(string)$k;
								
								if(checkdate($j,$k,$i)===true)
									$dates[] = $gendate;
								else $gendate = '';
								
								if(($i == (int)$u)&&($j==(int)$v)&&($k==(int)$w)) break;
							}
						}elseif($groupby == 2){
							if(sizeof($dates)> 0) $z = 1;
						
							for($k = (int)$z; $k<=31; $k += 7){
								$gendate = (string)$i;
								if(strlen((string)$j)==1)
									$gendate .= '-0'.(string)$j;
								else $gendate .= '-'.(string)$j;

								if(strlen((string)$k)==1)
									$gendate .= '-0'.(string)$k;
								else $gendate .= '-'.(string)$k;
								
								if(checkdate($j,$k,$i)===true){									
									$gendate = strftime ('%Y-%U',strtotime($gendate));
									
									if(empty($dates)){
										$dates[] = $gendate;
									}else{
										if($gendate != $dates[sizeof($dates)-1]){
											$dates[] = $gendate;
										}
									}
								}else $gendate = '';
								
								if(($i == (int)$u)&&($j==(int)$v)&&($k==(int)$w)) break;
							}
						
						}elseif($groupby == 3){
							$gendate = (string)$i;
							if(strlen((string)$j)==1)
								$gendate .= '-0'.(string)$j;
							else $gendate .= '-'.(string)$j;
							
							$dates[] = $gendate;
							
							if(($i == (int)$u)&&($j==(int)$v)) break;
						}
						if(($i == (int)$u)&&($j==(int)$v)) break;
					}
				}else{
					$gendate = (string)$i;
					$dates[] = $gendate;
					
					if(($i == (int)$u)) break;
				}
				
			}
			return $dates;
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
