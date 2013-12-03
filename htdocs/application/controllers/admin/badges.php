<?php 
class Badges extends Membership {

	function __construct()
	{
		parent::__construct();
		$this->load->helper("layout");
		
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
/*        $this->load->model('faqmodel', 'mfaq');
        $this->load->model('newsmodel', 'mnews');*/
        $this->load->model('badgemodel', 'mbadge');
        $this->load->model('badgeearnedmodel', 'mbadgeearned');
        $this->load->model('systemmodel', 'msystem');
	
	}
	

	function index()
	{
		get_layout()->enabled(false);
		
		$badges = $this->mbadge->getBadgeList();
/*echo "<pre>";
print_r($v_badge);
echo "</pre>";
*/
		$series = array();
		
		$dates = array('2011-11-01', '2011-11-02', '2011-11-03', '2011-11-04', '2011-11-05', '2011-11-06', '2011-11-07');
		$cant = sizeof($dates);
		
		foreach($badges as $badge){
			
			$data = array();
			$i = 0;
			while($i <= sizeof($dates)-1){
				if($i == sizeof($dates)-1)
					$cant = $this->mbadgeearned->getBadgeEarnedCount($badge['id'],$dates[$i],$dates[$i],1);
				else
					$cant = $this->mbadgeearned->getBadgeEarnedCount($badge['id'],$dates[$i],$dates[$i+1],1);
					

				$data[] = (int)$cant[0]['cant'];
				$i++;
			}
			$series[] = array("name"=>$badge['name'], "data"=>$data);
		}

/*echo "<pre>";
print_r($series);
echo "</pre>";
*/		
		$json = json_encode($series);
//echo $json;
		$this->load->view('admin/badges/view',compact('dates','json'));
	}	
	
	function listenerstats() 
	{
        $table = 'v_badge_stats';
        $columns = array('cod','name','date_earned','badge_earned'/*,'id'*/);
//        $index = 'id';
        $index = 'date_earned';
		get_layout()->enabled(false);
		$this->load->model('datatablemodel','mdatatable');
        $data['result'] = $this->mdatatable->generate($table, $columns, $index);

        echo $data['result'];
    }

	function listenermanager() 
	{
        $table = 'v_badge';
        $columns = array('cod','name','filename','message','question','status','id');
        $index = 'id';
		get_layout()->enabled(false);
		$this->load->model('datatablemodel','mdatatable');
        $data['result'] = $this->mdatatable->generate($table, $columns, $index);

        echo $data['result'];
    }

	function ajaxedit()
	{
		get_layout()->enabled(false);
		$id = $this->input->post('id');
		$badge = $this->mbadge->getById($id);
/*		if(isset($news->date_time)){
			$news->date_time = date('Y-m-d',strtotime($news->date_time));
		}*/
		
		if($id < 1)
			$this->load->view('admin/badges/edit');
		else
			$this->load->view('admin/badges/edit', compact('badge'));
	}
	

	function ajaxsave()
	{
		get_layout()->enabled(false);
		if ($_POST) 
		{
			$badge = $this->input->post("badge", true);
			
			$saved = $this->mbadge->save($badge);
			
			if(!isset($badge['id'])) $last_id = $this->db->insert_id();
			else $last_id = $badge['id'];
			
			if($badge['filename']) {
				list($item1,$item2,$item3, $item4) = split('/', $badge['filename']);
				$locationImage = "./upload/images/badge/".$item4;
				$locationImageBase = "/upload/images/badge/".$item4;
			}
			
			if(strpos($badge['filename'], "temp/badge") > 0)
			{//Move image from temp folder//
				//Move temp images//
				if(!is_dir("./upload/images/badge/")) mkdir("./upload/images/badge/", 0777, 1); // Create directory
				if (copy(".".$badge['filename'], $locationImage)) {
					unlink(".".$badge['filename']);
				}
				
				//Update logo location//
				$badge['id'] = $last_id;
				$badge['filename'] = $locationImageBase;
				$saved = $this->mbadge->save($badge);
			}
			
			if ($saved){
				$success = TRUE;
				$message = "Success: Badge record saved successfully.";
			} else {
				$success = FALSE;
				$message = "ERR002: Something went wrong on the record badge save process. Please contact support center.";    
			}
			$json = array(
				'success' => $success,
				'message' => $message
			  );
			echo json_encode($json);
		}
    }
		
	
	function ajaxdelete()
	{
		get_layout()->enabled(false);
		if ($_POST) 
		{
			$id = $this->input->post('id');
			$badge = $this->mbadge->getById($id);
			
			if(isset($badge->filename)) {
					unlink(".".$badge->filename);
			}
			
			$req = $this->mbadge->deleteById($id);
			
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

	function getbadgestas()
	{
		get_layout()->enabled(false);
		
		if ($_POST)
		{
			//$category = $this->input->post('category');
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
			
			$titleChart = "Badges Earned: {$from} PDT to {$to} PDT";
/*echo "<pre>";
print_r($RangeOfDates);
echo "</pre>";
*/
			
			$badgesGraphResults = $this->mbadge->getStatsAmountsList($from, $to, $groupby);
/*echo "<pre>";
print_r($badgesGraphResults);
echo "</pre>";
*/
			$dates = $this->mbadge->getDatesBetween($from, $to, $groupby);
			
/*echo "<pre>";
print_r($dates);
echo "</pre>";
*/
			$seriesaux = array();
			foreach($badgesGraphResults as $badgesResults){
				$data = array();
				foreach($dates as $date){
					if($badgesResults->date_earned == $date)
						$data[]= (int)$badgesResults->badge_earned;
					else
						$data[] = 0;
					
				}
						
				if(!isset($seriesaux[$badgesResults->name])){
					$seriesaux[$badgesResults->name] = array("name"=>$badgesResults->name, "data"=>$data);
				}else{
					$array1 = $seriesaux[$badgesResults->name]['data'];
					$array2 = $data;
					
					$a = 0;
					while($a <= sizeof($array1)-1){
						if($array1[$a] == 0) $array1[$a] = (int)$array2[$a];
						$a++;
					}
					
					$seriesaux[$badgesResults->name] = array("name"=>$badgesResults->name, "data"=>$array1);
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
			$dates = $this->mbadge->getDatesMonth($dates); //Clicks Results//
			
//echo $json;
			$this->load->view('admin/badges/stats', compact('json','dates','titleChart','badgesGraphResults'));
		}
	}
}

/* End of file site.php */
/* Location: ./application/controllers/admin/site.php */