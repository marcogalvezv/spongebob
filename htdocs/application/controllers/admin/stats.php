<?php 
class Stats extends Membership {

	function __construct()
	{
		parent::__construct();
		$this->load->helper("layout");
		$this->load->helper("calendar");
		
		$language = $this->session->userdata('language');
		if(empty($language)){
			$language = 'en';//spanish
		}
		
		//SET LANGUAGE
		$this->session->set_userdata('language',$language);
		
		//SET LANGUAGES
		if(file_exists($_SERVER['DOCUMENT_ROOT']."/application/language/$language/admin_lang.php")){
			$this->lang->load('admin',$language);
		}else{
			$this->lang->load('admin','en');
		}
		
//        $this->load->model('usermodel', 'muser');
//        $this->load->model('settingsmodel', 'msettings');
        $this->load->model('systemmodel', 'msystem');
        $this->load->model('usersocialmodel', 'musersocial');
        $this->load->model('urlreferralmodel', 'murlreferral');
	
	}

	function index()
	{
		get_layout()->enabled(false);
		$this->load->view('admin/stats/view');
	}	

	function listenerurl() 
	{
        $table = 'urlreferral';
        $columns = array('id','hits','url');
        $index = 'id';
		
		get_layout()->enabled(false);
		
		$this->load->model('datatablemodel','mdatatable');
        $data['result'] = $this->mdatatable->generate($table, $columns, $index);

        echo $data['result'];
    }

	function getstats()
	{
		get_layout()->enabled(false);
		
		if ($_POST)
		{
			$option = $this->input->post('option');
			$period = $this->input->post('period');
			$from = $this->input->post('datefrom');
			$to = $this->input->post('dateto');
			$groupby = $this->input->post('groupby');/*1:by day - 2: week - 3:month - 4:year*/

			$RangeOfDates = $this->msystem->getRangeOfDates(); //Ranges of Dates by CURRENT_DATE//

			if($period == 1){
				$from = $RangeOfDates[0]['now'];
				$to = $RangeOfDates[0]['now'];
			}elseif($period == 2){
				$from = $RangeOfDates[0]['dateiniweek'];
				$to = $RangeOfDates[0]['dateendweek'];
			}elseif($period == 3){
				$from = $RangeOfDates[0]['datainimonth'];
				$to = $RangeOfDates[0]['dataendmonth'];
			}elseif($period == 4){
				$from = $RangeOfDates[0]['dateiniyear'];
				$to = $RangeOfDates[0]['dateendyear'];
			}
			
			$titleChart = "Stats from: {$from} to {$to}";
/*echo "<pre>";
print_r($RangeOfDates);
echo "</pre>";
*/
			$dates = getDatesBetween($from, $to, $groupby);

			
			$seriesaux = array();

			if(($option==1)||($option==2)){
/*==========SINGUPS===========*/
			$adsGraphSingUpsResults = $this->musersocial->getStatsSingUpsList($from, $to, $groupby);

			foreach($adsGraphSingUpsResults as $singupsResults){
				$data = array();
				foreach($dates as $date){
					if($singupsResults->cdate == $date)
						$data[]= (int)$singupsResults->qty;
					else
						$data[] = 0;
					
				}
						
				if(!isset($seriesaux['SingUps'])){
					$seriesaux['SingUps'] = array("name"=>'Sing Ups', "data"=>$data);
				}else{
					$array1 = $seriesaux['SingUps']['data'];
					$array2 = $data;
					
					$a = 0;
					while($a <= sizeof($array1)-1){
						if($array1[$a] == 0) $array1[$a] = (int)$array2[$a];
						$a++;
					}
					
					$seriesaux['SingUps'] = array("name"=>'Sing Ups', "data"=>$array1);
				}
			}
			}
			if(($option==1)||($option==3)){
/*==========SING IN===========*/
			$adsGraphSingInResults = $this->musersocial->getStatsSingInList($from, $to, $groupby);
			//$dates = getDatesBetween($from, $to, $groupby);
			
			//$seriesaux = array();
			foreach($adsGraphSingInResults as $singInResults){
				$data = array();
				foreach($dates as $date){
					if($singInResults->cdate == $date)
						$data[]= (int)$singInResults->qty;
					else
						$data[] = 0;
					
				}
						
				if(!isset($seriesaux['Singin'])){
					$seriesaux['Singin'] = array("name"=>'Sing in', "data"=>$data);
				}else{
					$array1 = $seriesaux['Singin']['data'];
					$array2 = $data;
					
					$a = 0;
					while($a <= sizeof($array1)-1){
						if($array1[$a] == 0) $array1[$a] = (int)$array2[$a];
						$a++;
					}
					
					$seriesaux['Singin'] = array("name"=>'Sing in', "data"=>$array1);
				}
			}

			}
			
			if(($option==1)||($option==4)){
/*==========FLIGHTS===========*/
			$adsGraphFlightsResults = $this->musersocial->getStatsFlightsList($from, $to, $groupby);

			foreach($adsGraphFlightsResults as $flightsResults){
				$data = array();
				foreach($dates as $date){
					if($flightsResults->cdate == $date)
						$data[]= (int)$flightsResults->qty;
					else
						$data[] = 0;
					
				}
						
				if(!isset($seriesaux['Flights'])){
					$seriesaux['Flights'] = array("name"=>'Flights', "data"=>$data);
				}else{
					$array1 = $seriesaux['Flights']['data'];
					$array2 = $data;
					
					$a = 0;
					while($a <= sizeof($array1)-1){
						if($array1[$a] == 0) $array1[$a] = (int)$array2[$a];
						$a++;
					}
					
					$seriesaux['Flights'] = array("name"=>'Flights', "data"=>$array1);
				}
			}

			}
			
			if(($option==1)||($option==5)){
/*==========NEW FRIENDS===========*/
			$adsGraphNewFriendsResults = $this->musersocial->getStatsNewFriendsList($from, $to, $groupby);

			foreach($adsGraphNewFriendsResults as $newfriendsResults){
				$data = array();
				foreach($dates as $date){
					if($newfriendsResults->cdate == $date)
						$data[]= (int)$newfriendsResults->qty;
					else
						$data[] = 0;
					
				}
						
				if(!isset($seriesaux['NewFriends'])){
					$seriesaux['NewFriends'] = array("name"=>'New Friends', "data"=>$data);
				}else{
					$array1 = $seriesaux['NewFriends']['data'];
					$array2 = $data;
					
					$a = 0;
					while($a <= sizeof($array1)-1){
						if($array1[$a] == 0) $array1[$a] = (int)$array2[$a];
						$a++;
					}
					
					$seriesaux['NewFriends'] = array("name"=>'New Friends', "data"=>$array1);
				}
			}
			}
			
			if(($option==1)||($option==6)){
/*==========MAIL SENTS===========*/
			$adsGraphMailsSentResults = $this->musersocial->getStatsMailsSentList($from, $to, $groupby);

			foreach($adsGraphMailsSentResults as $newMailsSentResults){
				$data = array();
				foreach($dates as $date){
					if($newMailsSentResults->cdate == $date)
						$data[]= (int)$newMailsSentResults->qty;
					else
						$data[] = 0;
					
				}
						
				if(!isset($seriesaux['MailsSent'])){
					$seriesaux['MailsSent'] = array("name"=>'Mails Sent', "data"=>$data);
				}else{
					$array1 = $seriesaux['MailsSent']['data'];
					$array2 = $data;
					
					$a = 0;
					while($a <= sizeof($array1)-1){
						if($array1[$a] == 0) $array1[$a] = (int)$array2[$a];
						$a++;
					}
					
					$seriesaux['MailsSent'] = array("name"=>'Mails Sent', "data"=>$array1);
				}
			}

			}
			
			if(($option==1)||($option==7)){
/*==========CHECKINS===========*/
			$adsGraphCheckinsResults = $this->musersocial->getCheckinsSentList($from, $to, $groupby);

			foreach($adsGraphCheckinsResults as $checkinsResults){
				$data = array();
				foreach($dates as $date){
					if($checkinsResults->cdate == $date)
						$data[]= (int)$checkinsResults->qty;
					else
						$data[] = 0;
					
				}
						
				if(!isset($seriesaux['checkins'])){
					$seriesaux['checkins'] = array("name"=>'Checkins', "data"=>$data);
				}else{
					$array1 = $seriesaux['checkins']['data'];
					$array2 = $data;
					
					$a = 0;
					while($a <= sizeof($array1)-1){
						if($array1[$a] == 0) $array1[$a] = (int)$array2[$a];
						$a++;
					}
					
					$seriesaux['checkins'] = array("name"=>'Checkins', "data"=>$array1);
				}
			}
			}

			$series = array();
			foreach($seriesaux as $serieaux){
				$series[] = $serieaux;
			}

			$json = json_encode($series);
/*echo "<pre>";
print_r($series);
echo $json;
echo "</pre>";
*/
			if ($groupby == 3)
			$dates = $this->musersocial->getDatesMonth($dates);
			
/*echo "<pre>";
print_r($adsGraphSingUpsResults);
echo "</pre>";
*/
			$this->load->view('admin/stats/stats', compact('json','dates','titleChart','option','adsGraphSingUpsResults','adsGraphSingInResults','adsGraphFlightsResults','adsGraphNewFriendsResults','adsGraphMailsSentResults','adsGraphCheckinsResults'));
		}
	}

	function ajaxdelete()
	{
		get_layout()->enabled(false);
		if ($_POST) 
		{
			$id = $this->input->post('id');
			
			$req = $this->murlreferral->deleteById($id);
			
			if ($req){
				$success = TRUE;
				$message = "Success: news record delete successfully.";
			} else {
				$success = FALSE;
				$message = "ERR003: Something went wrong on news record delete. Please contact support center.";    
			}
			$json = array(
				'success' => $success,
				'message' => $message
			  );
			echo json_encode($json);
		}
    }
	function ajaxdeleteall()
	{
		get_layout()->enabled(false);
		if ($_POST)
		{
			$req = $this->murlreferral->deleteAll();
			
			if ($req){
				$success = TRUE;
				$message = "Success: news record delete successfully.";
			} else {
				$success = FALSE;
				$message = "ERR003: Something went wrong on news record delete. Please contact support center.";    
			}
			$json = array(
				'success' => $success,
				'message' => $message
			  );
			echo json_encode($json);
		}
    }
}

/* End of file site.php */
/* Location: ./application/controllers/admin/site.php */