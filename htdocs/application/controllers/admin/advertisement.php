<?php 
class Advertisement extends Membership {

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
		
        $this->load->model('usermodel', 'muser');
        $this->load->model('settingsmodel', 'msettings');
        $this->load->model('adsmodel', 'mads');
        $this->load->model('systemmodel', 'msystem');
	}
	

	function index()
	{
		get_layout()->enabled(false);
		$this->load->view('admin/advertisement/view');
	}	
	
	function getadsstats()
	{
		get_layout()->enabled(false);
		
		if ($_POST)
		{
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
			
			$titleChart = "Click & Impressions from: {$from} to {$to}";
/*echo "<pre>";
print_r($RangeOfDates);
echo "</pre>";
*/
			
			$adsGraphClicksResults = $this->mads->getStatsClicksList($from, $to, $groupby);
			$adsGraphImpressionsResults = $this->mads->getStatsImpressionsList($from, $to, $groupby);
/*echo "<pre>";
print_r($adsGraphClicksResults);
print_r($adsGraphImpressionsResults);
echo "</pre>";
*/
			$dates = getDatesBetween($from, $to, $groupby);
			
/*echo "<pre>";
print_r($dates);
echo "</pre>";
*/
			$seriesaux = array();
			foreach($adsGraphClicksResults as $adsResults){
				$data = array();
				foreach($dates as $date){
					if($adsResults->cdate == $date)
						$data[]= (int)$adsResults->clicks;
					else
						$data[] = 0;
					
				}
						
				if(!isset($seriesaux['Clicks'])){
					$seriesaux['Clicks'] = array("name"=>'Clicks', "data"=>$data);
				}else{
					$array1 = $seriesaux['Clicks']['data'];
					$array2 = $data;
					
					$a = 0;
					while($a <= sizeof($array1)-1){
						if($array1[$a] == 0) $array1[$a] = (int)$array2[$a];
						$a++;
					}
					
					$seriesaux['Clicks'] = array("name"=>'Clicks', "data"=>$array1);
				}
			}
			foreach($adsGraphImpressionsResults as $adsIResults){
				$data = array();
				foreach($dates as $date){
					if($adsIResults->cdate == $date)
						$data[]= (int)$adsIResults->impressions;
					else
						$data[] = 0;
					
				}
						
				if(!isset($seriesaux['Impressions'])){
					$seriesaux['Impressions'] = array("name"=>'Impressions', "data"=>$data);
				}else{
					$array1 = $seriesaux['Impressions']['data'];
					$array2 = $data;
					
					$a = 0;
					while($a <= sizeof($array1)-1){
						if($array1[$a] == 0) $array1[$a] = (int)$array2[$a];
						$a++;
					}
					
					$seriesaux['Impressions'] = array("name"=>'Impressions', "data"=>$array1);
				}
			}
			
			
			
			$series = array();
			foreach($seriesaux as $serieaux){
				$series[] = $serieaux;
			}
/*echo "<pre>";
print_r($series);
echo "</pre>";
*/
			$json = json_encode($series);

			if ($groupby == 3)
			$dates = $this->mads->getDatesMonth($dates);
			
//echo $json;
			$this->load->view('admin/advertisement/stats', compact('json','dates','titleChart','adsGraphClicksResults','adsGraphImpressionsResults'));
		}
	}
}

/* End of file site.php */
/* Location: ./application/controllers/admin/site.php */