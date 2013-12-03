<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * MY_Exceptions
 *
 * Extends the exceptions library.
 *
 * @author Simon Emms <simon@testpeople.co.uk>
 * @since 05-May-2011
 */
class MY_Exceptions extends CI_Exceptions {


public function __construct(){
    parent::__construct();
}


    /**
     * Show 404
     *
     * Changed the behaviour of the 404 error page so
     * that it displays the 404 page.
     *
     * @param string $page
     * @param bool $log_error
     */
    function show_404($page = ''){ // error page logic
		redirect('errores/error404');
		header("HTTP/1.1 404 Not Found");
		//$heading = "404 Page Not Found";
		//$message = "The page you requested was not found ";
		////$email = "";
		////$data['email'] = $email;
		//$CI =& get_instance();
		//$CI->load->view('errores/error404');

	}
	
		
	//function show_405($page = '')
	//{
	//	header("HTTP/1.1 404 Not Found");
	//	$heading = "404 Page Not Found";
	//	$message = "The page you requested was not found ";
	//	$CI =& get_instance();
	//	$CI->load->helper("layout");
	//	get_layout()->set_layout('layout/pidamosalgo');
	//	
	//	//THEME
	//	get_layout()->add_stylesheets('style');
	//	get_layout()->add_stylesheets('frames');
	//	get_layout()->add_javascripts('libs/modernizr-2.5.3.min');
	//	
	//	get_layout()->set_title("PidamosAlgo No se encontro la pagina");
    //
	//	$email = $CI->config->item('email_from_address');
	//	$data['error'] = "";
	//	$data['email'] = $email;
	//	
	//	$CI->load->view('errores/error404', $data);
	//}


}
?>