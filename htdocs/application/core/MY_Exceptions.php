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


	}

}
?>