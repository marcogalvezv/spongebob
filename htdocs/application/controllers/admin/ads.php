<?php 
class Ads extends Membership {

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
		$this->load->model('countrymodel','mcountry');
        $this->load->model('adsmodel', 'mads');
        $this->load->model('badgeearnedmodel', 'mbadgeearned');
	
	}
	

	function index()
	{
		get_layout()->enabled(false);
		
		$badges = $this->mads->getBadgeList();
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
/*		$series = array();

		$data = array(7.0, 9.0, 9.0, 14.0, 18.0, 21.0, 25.0);
		$series[] = array("name"=>"Badge 1", "data"=>$data);

		$data = array(0.0, 7.0, 5.0, 11.0, 17.0, 22.0, 24.0);
		$series[] = array("name"=>"Badge 2", "data"=>$data);

/*		$data = array(1.0, 6.0, 3.0, 8.0, 13.0, 17.0, 18.0);
		$series[] = array("name"=>"Badge 3", "data"=>$data);

		$data = array(3.0, 4.0, 5.0, 8.0, 11.0, 15.0, 17.0);
		$series[] = array("name"=>"Badge 4", "data"=>$data);
*/
		$json = json_encode($series);
//echo $json;
		$this->load->view('admin/ads/view',compact('dates','json'));
//		$this->load->view('admin/badges/view');
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
        $table = 'v_ads';
        $columns = array('title','position','startdate','duration','filename','status','fullname','id');
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
		$ads = $this->mads->getById($id);
		$countries = $this->mcountry->getCountryList()->result();
/*echo "<pre>";
print_r($countries);
echo "</pre>";
/*		if(isset($news->date_time)){
			$news->date_time = date('Y-m-d',strtotime($news->date_time));
		}*/
		
		if($id < 1)
			$this->load->view('admin/advertisement/edit', compact('countries'));
		else
			$this->load->view('admin/advertisement/edit', compact('ads','countries'));
	}
	

	function ajaxsave()
	{
		get_layout()->enabled(false);
		if ($_POST) 
		{
			$ads = $this->input->post("ads", true);
			
			$saved = $this->mads->save($ads);
			
			if(!isset($ads['id'])) $last_id = $this->db->insert_id();
			else $last_id = $ads['id'];
			
			if($ads['filename']) {
				list($item1,$item2,$item3, $item4) = split('/', $ads['filename']);
				$locationImage = "./upload/images/ads/".$item4;
				$locationImageBase = "/upload/images/ads/".$item4;
			}
			
			if(strpos($ads['filename'], "temp/ads") > 0)
			{//Move image from temp folder//
				//Move temp images//
				if(!is_dir("./upload/images/ads/")) mkdir("./upload/images/ads/", 0777, 1); // Create directory
				if (copy(".".$ads['filename'], $locationImage)) {
					unlink(".".$ads['filename']);
				}
				
				//Update logo location//
				$ads['id'] = $last_id;
				$ads['filename'] = $locationImageBase;
				$saved = $this->mads->save($ads);
			}
			
			if ($saved){
				$success = TRUE;
				$message = "Success: ads record saved successfully.";
			} else {
				$success = FALSE;
				$message = "ERR002: Something went wrong on the record ads save process. Please contact support center.";    
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
			$ads = $this->mads->getById($id);
			
			if(isset($ads->filename)) {
					unlink(".".$ads->filename);
			}
			
			$req = $this->mads->deleteById($id);
			
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