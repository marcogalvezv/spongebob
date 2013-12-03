<?php
	function getdays($year, $month, $first_day = 0)
	{
		$day_names = array();
		for($n=0,$t=(3+$first_day)*86400; $n<7; $n++,$t+=86400) #enero 4, 1970
			$day_names[$n] = ucfirst(gmstrftime('%A',$t)); #%A completo
			
		return $day_names;
	}
	
	function getcalendar($year, $month, $first_day = 0)
	{
		$weeks = array();
		$week = array();
		
		$first_of_month = gmmktime(0,0,0,$month,1,$year); 
		
		list($month, $year, $month_name, $weekday) = explode(',',gmstrftime('%m,%Y,%B,%w',$first_of_month)); 
		$weekday = ($weekday + 7 - $first_day) % 7; 

		$i=0;
		if($weekday > 0) {
			for($i= 1;$i<=$weekday;$i++) {#empty days
				$week[] = ''; 
			}
		}
		for($day=1,$days_in_month=gmdate('t',$first_of_month); $day<=$days_in_month; $day++,$weekday++){
			if($weekday == 7){ 
				$weeks[] = $week;
				$week = array();
				$weekday = 0;
			} 
			$week[] = $day; 
		}
		if($weekday != 7) {
			//echo $weekday;
			//echo (7-$weekday);
			for($j=$weekday;$j < 7;$j++) {#empty days
				$week[] = '';
			}
			$weeks[] = $week;
		}
		return $weeks; 
	}
	function getDatesBetween($strDateFrom, $strDateTo, $groupby)
	{
		if(isset($strDateFrom)&&isset($strDateTo)){
			date_default_timezone_set('America/Los_Angeles');
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
	function getDatetime()
	{
		$fecha = date("Y") ."-". date("m") ."-". date("d");
		$fecha.= " ";
		$fecha.= date("H") .":". date("i") .":". date("s");

		return($fecha);
	}
?>