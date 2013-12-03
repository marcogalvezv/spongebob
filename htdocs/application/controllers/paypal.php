<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paypal extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		
		$this->load->add_package_path(DOMAINSPATH.'application/_common/');
		$this->load->helper("array");
		$this->load->helper('cookie');
		
		get_layout()->add_stylesheets('jquery-ui');
		get_layout()->set_layout("layout/base");
		
		/*
		$this->load->model('Usermodel', 'user');
		$this->load->model("inventorymodel","minventory");
		$this->load->model("Customermodel","customer");
		$this->load->model("ordersmodel","morders");
		$this->load->model("myordersmodel","mmyorders");
		$this->load->model("donationsmodel","mdonations");
	
		$this->load->model("orderdetailmodel","morderdetail");
		
		$this->load->model("cartdetailmodel","mcartdetail");
		$this->load->model("shippingmodel","mshipping");
		$this->load->model("cartprojectmodel","mcartproject");
		$this->load->model("projectmodel","mproject");
		*/
        

		$language = $this->session->userdata('language');
		if(empty($language)){
			$language = 'en';
		}
		
		//SET LANGUAGE ON SESSION
		$this->session->set_userdata('language',$language);
		//SET LANGUAGES
		if(file_exists($_SERVER['DOCUMENT_ROOT']."/application/language/$language/front_lang.php")){
			$this->lang->load('front',$language);
		}else{
			$this->lang->load('front','en');
		}
    }
	
	
	function payment() {
		$this->session->set_userdata('paypal_token', FALSE);
        $this->load->library('payment');
		
		get_layout()->enabled(false);
		if ($_POST)
		{
			echo "<pre>";
			print_r($_POST);
			echo "</pre>";
			
			$payment = $this->input->post('payment');

			//DO PAYMENT
			
			$this->payment->AMT = number_format($payment['total'], 2);
			
			$this->session->set_userdata('paypal_amount',number_format($payment['total'], 2));
			
			//$this->payment->CU = $payment['total'];
		
			//echo "<pre>";
			//print_r($this->payment);
			//echo "</pre>";
			
			$status = $this->payment->process();
				
			if ($status === TRUE)
			{
				echo "sucess";
				 // Report successful transaction
			}
			else
			{
				echo "error: " . $status;
				
			}
			
			$subscription = $this->payment->subscription();
			echo "<pre>TEST";
			print_r($subscription);
			echo "</pre>";
		}

    }

    function done()
    {
		$this->load->library('payment');
		get_layout()->set_layout("layout/base");

		$url = base_url().$_SERVER["REQUEST_URI"];
        $url = parse_url($url);
		
		
		echo "<pre>";
		print_r($url);
		echo "</pre>";
		
		
        ////I'm expecting variables so if they aren't there send them to the homepage
        if (!array_key_exists('query',$url))
        {
             //redirect('/');
			 exit;
        }
		
        $query = $url['query'];
        parse_str($query,$_GET); //add to $_GET global array
		
		echo "<pre>";
		print_r($_GET);
		echo "</pre>";
		
		
		$token = $this->input->get('token', TRUE);
		$payerID = $this->input->get('PayerID', TRUE);
		$amount = $this->session->userdata('paypal_amount');
		
		$this->payment->PAYERID = $payerID;
		$this->payment->TOKEN = $token;
		$this->payment->AMT = $amount;
		
		
		$status = $this->payment->process();
			
		if ($status === TRUE)
		{
			echo "sucess";
			 // Report successful transaction
		}
		else
		{
			echo "error: " . $status;
			
		}
		
		$subscription = $this->payment->subscription();
		echo "<pre>TEST";
		print_r($subscription);
		echo "</pre>";
		
		$data['token'] = $token;
		$data['payerID'] = $payerID;
		$data['continue'] = base_url();

		$this->load->view('paypal/done', $data);
		
	}
	
	
	//function done()
	//{	
	//	get_layout()->set_layout("layout/base");
    //
	//	$url = base_url().$_SERVER["REQUEST_URI"];
	//	$url = parse_url($url);
	//	
	//	/*
	//	echo "<pre>";
	//	print_r($url);
	//	echo "</pre>";
	//	*/
	//	
    //    //I'm expecting variables so if they aren't there send them to the homepage
    //    if (!array_key_exists('query',$url))
    //    {
    //         //redirect('/');
	//		 exit;
    //    }
    //    $query = $url['query'];
    //    parse_str($query,$_GET); //add to $_GET global array
	//	
	//	echo "<pre>";
	//	print_r($_GET);
	//	echo "</pre>";
	//	
	//	
	//	$token = $this->input->get('token', TRUE);
	//	$payerID = $this->input->get('PayerID', TRUE);
	//	
    //    $this->load->library('payment');
	//	
	//	$set_checkout = $this->session->userdata('set_checkout');
	//	/*echo "<pre>";
	//	print_r($set_checkout);
	//	echo "</pre>";
	//	*/
	//	if($set_checkout['type'] == 'cart')
	//	{
	//		$this->payment->AMT = $set_checkout['totals']['total'];//"255.99";
	//	}else if($set_checkout['type'] == 'donation')
	//	{
	//		$this->payment->AMT = $set_checkout['total'];//"255.99";
	//	}
	//	
	//	$this->payment->PAYERID = $payerID;
	//	$this->payment->TOKEN = $token;
	//	/*
	//	echo "<pre>";
	//	print_r($this->payment);
	//	echo "</pre>";
	//	*/
	//	$status = $this->payment->process();
	//		
	//	if ($status === TRUE)
	//	{
	//		//echo "sucess";
	//		 // Report successful transaction
	//		$subscription = $this->payment->subscription();
	//		/*echo "<pre>";
	//		print_r($subscription);
	//		echo "</pre>";
	//		*/
	//		$data['token'] = $token;
	//		$data['payerID'] = $payerID;
	//		$data['continue'] = base_url();
	//		
	//		if($set_checkout['type'] == 'cart') 
	//		{
	//			/* /// UPDATE CUSTOMER DUMMY /// */	
	//			$user = $this->Systemmodel->user();
	//			//		$customerobj = $this->Systemmodel->customer($uid);
	//			
	//			$cart_detail_project = $this->mcartdetail->getCartDetailProjectViewList($set_checkout['uid'],'0','uid');
    //
	//			if($user->username == 'dummy'){
	//				$customer = array();
	//				$customer['uid'] = $set_checkout['uid'];
	//				$customer['firstname'] = $subscription['response']['FIRSTNAME'];
	//				$customer['lastname'] = $subscription['response']['LASTNAME'];
	//				$customer['email'] = $subscription['response']['EMAIL'];
	//				$customer['phone'] = '111-111-1111';//$subscription[''];
	//				$customer['address1'] = $subscription['response']['SHIPTOSTREET'];
	//				$customer['citystate'] = $subscription['response']['SHIPTOCITY'].', '.$subscription['response']['SHIPTOSTATE'];
	//				$customer['zip'] = $subscription['response']['SHIPTOZIP'];
	//				$customer['country'] = $subscription['response']['SHIPTOCOUNTRYCODE'];
	//				$customer['country_origin'] = $subscription['response']['COUNTRYCODE'];
	//				$customer['unsubscribed'] = 0;
    //
	//				$idcus = $this->customer->save($customer);
	//				
	//				$username = explode('@',$subscription['response']['EMAIL']);
	//				
	//				$user_data = array('id'=>$set_checkout['uid'],'gid'=>5,'username'=>$subscription['response']['EMAIL'],'password'=>$username[0]);
	//				$user = $this->user->save($user_data);
	//				//UPDATE PASSWORD AND SAVE
	//				$user = $this->user->updatepassword($user_data);
	//				/* //////////SAVE TOKEN & PAYERID IN ORDERS */
	//				// GENERATION ORDERS & ORDER_DETAIL
	//				$orders = array();
	//				$orders['uid'] = $set_checkout['uid'];
	//				$orders['number'] = 1;
	//				$orders['tx_code'] = 'txt64';
	//				$orders['date'] = date("Y-m-d H:i:s");
	//				$orders['contact'] = $customer['firstname'].' '.$customer['lastname'];
	//				$orders['email'] = $customer['email'];
	//				$orders['phone'] = $customer['phone'];
	//				//$orders['mobile'] = $customer['mobile'];
	//				$orders['status'] = 0;
	//				//$orders['addressbillto'] = $customer[''];
	//				$orders['addressshipto'] = $subscription['response']['SHIPTONAME'].", ".$subscription['response']['SHIPTOSTREET'].", ".$subscription['response']['SHIPTOCITY']." ".$subscription['response']['SHIPTOSTATE'].", ".$subscription['response']['SHIPTOCOUNTRYCODE'].".";;//$customer->address1;
	//				$orders['notes'] = $set_checkout['notes'];
	//				$orders['total'] = $set_checkout['totals']['totalcart'];
    //
	//				$orders['tax'] = $set_checkout['totals']['taxtotal'];
	//				//$orders['company'] = $customer[''];
	//				//$orders['url'] = $customer[''];
	//				$orders['token'] = $token;
	//				$orders['payerid'] = $payerID;
	//				
	//				$id = $this->morders->save($orders);
	//				$last_id = $id;
	//				$data['idorders'] = $last_id;
	//				$myorders = array('uid'=>$set_checkout['uid'],'idorder'=>$last_id);
	//				$id = $this->mmyorders->save($myorders);
	//			}else{
	//				$customer = $this->Systemmodel->customer($set_checkout['uid']);
	//				$shippingcurrent = $this->mshipping->getById($set_checkout['shippingaddress']);
    //
	//				/* //////////SAVE TKEN & PAYERID IN ORDERS */
	//				// GENERAR ORDERS Y ORDER_DETAIL
	//				$orders = array();
	//				$orders['uid'] = $set_checkout['uid'];
	//				$orders['number'] = 1;
	//				$orders['tx_code'] = 'txt64';
	//				$orders['date'] = date("Y-m-d H:i:s");
	//				$orders['contact'] = $customer->firstname.' '.$customer->lastname;
	//				$orders['email'] = $customer->email;
	//				$orders['phone'] = $customer->phone;
	//				$orders['mobile'] = $customer->mobile;
	//				$orders['status'] = 0;
	//				//$orders['addressbillto'] = $customer[''];
	//				$orders['addressshipto'] = $shippingcurrent->address1.", ".$shippingcurrent->city.", ".$shippingcurrent->country.".";;//$customer->address1;
	//				$orders['notes'] = $set_checkout['notes'];
	//				$orders['total'] = $set_checkout['totals']['totalcart'];
    //
	//				$orders['tax'] = $set_checkout['totals']['taxtotal'];
	//				//$orders['company'] = $customer[''];
	//				//$orders['url'] = $customer[''];
	//				$orders['token'] = $token;
	//				$orders['payerid'] = $payerID;
	//				
	//				$id = $this->morders->save($orders);
	//				$last_id = $id;
	//				$data['idorders'] = $last_id;
	//				$myorders = array('uid'=>$set_checkout['uid'],'idorder'=>$last_id);
	//				$id = $this->mmyorders->save($myorders);
	//			}
	//			
	//			/* //////////SAVE ORDER_DETAIL */
	//			if((isset($cart_detail_project)) && (!empty($cart_detail_project))){
	//				//$set_checkout['totals']['total'] = 0;
	//				//$totalDonation = 0;
	//				foreach($cart_detail_project as $cart_detail){
	//					if($cart_detail['carttype'] == 'PRODUCT'){
	//						$order_detail = array();
	//						$order_detail['idord'] = $last_id;
	//						$order_detail['idprod'] = $cart_detail['idprod'];
	//						$order_detail['idshop'] = $cart_detail['idshop'];//quitar campo?, ya existe idprod
	//						$order_detail['qty'] = $cart_detail['quantity'];
	//						$order_detail['unit_price'] = $cart_detail['unitpriceaud'];
	//						//$order_detail['tax'] = $cart_detail['servicefee'] + ($cart_detail['subtotalaud'] * $cart_detail['commission'] / 100);
	//						$order_detail['total'] = $cart_detail['subtotalaud'];//round(($cart_detail['unitprice'] * $cart_detail['quantity']),2);
	//						//$set_checkout['totals']['total'] += $order_detail['total'];
	//						$order_detail['currency'] = 'AUD';//$cart_detail['currency'];//quitar campo? todo esta en AUD
	//						
	//						$req = $this->morderdetail->save($order_detail);
    //
	//						$inventory = $this->minventory->getByID_forUpdate($cart_detail['idprod']);
	//						if($inventory['quantity'] >= $cart_detail['quantity']){
	//							$inventory['quantity'] -= $cart_detail['quantity'];
	//							$req = $this->minventory->save($inventory);
	//						}
	//					}else if($cart_detail['carttype'] == 'PROJECT'){
	//						$donations = array();
	//						$donations['idproj'] = $cart_detail['idprod'];
	//						$donations['uid'] = $set_checkout['uid'];
	//						$donations['name'] = 'donation';
	//						$donations['date_charge '] = date("Y-m-d H:i:s");
	//						$donations['donation'] = $cart_detail['unitpriceaud'];
	//						$donations['token'] = $token;
	//						$donations['payerid'] = $payerID;
	//						
	//						$req = $this->mdonations->save($donations);
    //
	//						if($req){
	//							$project = $this->mproject->getProjectWithDonationsById($cart_detail['idprod']);
	//							if(isset($project)){
	//								if(($project->amount_required-$project->amount_funded-$project->donation) <= 0){
	//									$values = array('id'=>$cart_detail['idprod'],'status'=>'CLOSED');
	//									$req = $this->mproject->updateProject($values,'status');
	//								}
	//							}
	//						}
	//					}
	//				}
	//			}
	//			/*$values = array('id'=>$last_id,'total'=>$set_checkout['totals']['total']);
	//			$req = $this->morders->updateOrder($values);*/
	//			/* //////////END SAVE TOKEN & PAYERID IN ORDERS */
	//			if(isset($set_checkout['cart'])){
	//				$cart = $set_checkout['cart'];
	//				foreach($cart as $idcart){
	//					if($idcart > 0){
	//						$values = array('id'=>(int)$idcart,'status'=>1);
	//						$req = $this->mcartdetail->updateCart($values,'status');
	//					}else{
	//						$values = array('id'=>((int)$idcart * (-1)),'status'=>1);
	//						$req = $this->mcartproject->updateCartProject($values,'status');
	//					}
	//				}
	//			}
    //
    //
	//		} else if($set_checkout['type'] == 'donation') {
	//			$totalDonation = 0;
	//			
	//			$donations = array();
	//			$donations['idproj'] = $set_checkout['idproj'];
	//			$donations['uid'] = $set_checkout['uid'];
	//			$donations['name'] = $set_checkout['type'];
	//			$donations['date_charge '] = date("Y-m-d H:i:s");
	//			$donations['donation'] = $set_checkout['total'];
	//			$donations['token'] = $token;
	//			$donations['payerid'] = $payerID;
	//			
	//			$req = $this->mdonations->save($donations);
	//			$data['idorders'] = $req;
	//			
	//			if($req){
	//				$project = $this->mproject->getProjectWithDonationsById($cart_detail['idprod']);
	//				if(isset($project)){
	//					if(($project->amount_required-$project->amount_funded-$project->donation) <= 0){
	//						$values = array('id'=>$cart_detail['idprod'],'status'=>'CLOSED');
	//						$req = $this->mproject->updateProject($values,'status');
	//					}
	//				}
	//			}
	//			
	//			
	//			$username = explode('@',$subscription['response']['EMAIL']);
	//			
	//			$user_data = array('id'=>$set_checkout['uid'],'gid'=>5,'username'=>$subscription['response']['EMAIL'],'password'=>$username[0]);
	//			$user = $this->user->save($user_data);
	//			//UPDATE PASSWORD AND SAVE
	//			$user = $this->user->updatepassword($user_data);
    //
	//			$data['continue'] = base_url()."front/project/allprojects";
	//		
	//		}
	//		/* /// UPDATE CUSTOMER DUMMY /// */	
	//		if($user->username == 'dummy')
	//			$this->Systemmodel->logout();
	//		
	//		$this->load->view('paypal/done', $data);
	//	}
	//	else
	//	{
	//		/*
	//		echo "error: ";
	//		echo "<pre>";
	//		print_r($status);
	//		echo "</pre>";
	//		*/
	//		//echo "error: " . $status;
	//		
	//		$this->error(); // not verified
	//	}
    //}
	
    function error()
    {
		$url = base_url().$_SERVER["REQUEST_URI"];
        $url = parse_url($url);
		
		echo "<pre>";
		print_r($url);
		echo "</pre>";
		
        //I'm expecting variables so if they aren't there send them to the homepage
        if (!array_key_exists('query',$url))
        {
             //redirect('/');
			 exit;
        }
        $query = $url['query'];
        parse_str($query,$_GET); //add to $_GET global array
		
		echo "<pre>ERROR";
		print_r($_GET);
		echo "</pre>";
		
		$error = $this->input->get('error', TRUE);

		$data['error'] = $error;
		$data['continue'] = base_url();
		$this->load->view('paypal/error', $data);
    }
	
    function cancel()
    {
		get_layout()->set_layout("layout/base");

		$url = base_url().$_SERVER["REQUEST_URI"];
        $url = parse_url($url);
		
		echo "<pre>";
		print_r($url);
		echo "</pre>";
		
        //I'm expecting variables so if they aren't there send them to the homepage
        if (!array_key_exists('query',$url))
        {
             //redirect('/');
			 exit;
        }
        $query = $url['query'];
        parse_str($query,$_GET); //add to $_GET global array

		echo "<pre>CANCEL";
		print_r($_GET);
		echo "</pre>";
		
		$token = $this->input->get('token', TRUE);
		$payerID = $this->input->get('PayerID', TRUE);

		$data['token'] = $token;
		$data['payerID'] = $payerID;
		$data['continue'] = base_url();
		$this->load->view('paypal/cancel', $data);
    }
}

