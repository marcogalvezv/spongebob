<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Testqr extends CI_Controller 
{

	function __construct()
	{
		parent::__construct();
		
		$this->load->add_package_path(DOMAINSPATH.'application/_common/');		

    }
    
    function index() {
	
		$config['cacheable']	= false; //boolean, the default is true
		$config['cachedir']		= DOMAINSPATH.'cache/'; //string, the default is application/cache/
		$config['errorlog']		= DOMAINSPATH.'logs/'; //string, the default is application/logs/
		$config['quality']		= true; //boolean, the default is true
		$this->load->library('ciqrcode', $config);
		
		$params['data'] = 'This is a text to encode become QR Code';
		$params['level'] = 'H';
		$params['size'] = 5;
		$params['savename'] = DOMAINSPATH.'upload/images/qrcodes/test.png';
		$this->ciqrcode->generate($params);
		
		echo '<img src="'.base_url().'upload/images/qrcodes/test.png" />';
    }
}
?>