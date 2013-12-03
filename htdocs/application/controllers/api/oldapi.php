<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller
{

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
        $this->load->model("profilemodel","mprofile");
    }

    function index()
    {
		$this->load->view('home');
    }

	function ajaxedit()
	{
		if($_POST)
		{
			get_layout()->enabled(false);
			$id = $this->input->post('id');

			if($id > 0)
			{
				$profile = $this->mprofile->getByID($id);
				//$data['profile'] = $profile;
			}
			else
			{
				sendResponse(400, 'Invalid code');
				return false;
			}

//			$this->load->view('admin/airports/edit', $data);
			// Return unlock code, encoded with JSON
			$result = array(
				"profile" => $profile,
			);
			sendResponse(200, json_encode($result));
			return true;
		}
		sendResponse(400, 'Invalid request');
		return false;
	}
	

	function ajaxsave()
	{
		get_layout()->enabled(false);
		if ($_POST) 
		{
			$profile = $this->input->post("profile", true);
						
			$saved = $this->mprofile->save($profile);
			
			if ($saved){
				$success = TRUE;
				$message = "profile record saved successfully.";
			} else {
				$success = FALSE;
				$message = "Something went wrong on the record profile save process. Please contact support center.";    
			}
			$json = array(
				'success' => $success,
				'message' => $message
			  );
			//echo json_encode($json);
			sendResponse(200, json_encode($json));
			return true;
		}
		sendResponse(400, 'Invalid request');
		return false;
    }
		
	
	function ajaxdelete()
	{
		get_layout()->enabled(false);
		if ($_POST) 
		{
			$id = $this->input->post('id');
			$req = $this->mprofile->deleteById($id);
			
			if ($req){
				$success = TRUE;
				$message = "profile record deleted successfully.";
			} else {
				$success = FALSE;
				$message = "Something went wrong on profile record delete. Please contact support center.";    
			}
			$json = array(
				'success' => $success,
				'message' => $message
			  );
			//echo json_encode($json);
			sendResponse(200, json_encode($json));
			return true;
		}
		sendResponse(400, 'Invalid request');
		return false;
    }
	
/*----HELPER-----*/
// Helper method to get a string description for an HTTP status code
// From http://www.gen-x-design.com/archives/create-a-rest-api-with-php/ 
function getStatusCodeMessage($status)
{
    // these could be stored in a .ini file and loaded
    // via parse_ini_file()... however, this will suffice
    // for an example
    $codes = Array(
        100 => 'Continue',
        101 => 'Switching Protocols',
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        306 => '(Unused)',
        307 => 'Temporary Redirect',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Requested Range Not Satisfiable',
        417 => 'Expectation Failed',
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported'
    );
 
    return (isset($codes[$status])) ? $codes[$status] : '';
}
 
// Helper method to send a HTTP response code/message
function sendResponse($status = 200, $body = '', $content_type = 'text/html')
{
    $status_header = 'HTTP/1.1 ' . $status . ' ' . getStatusCodeMessage($status);
    header($status_header);
    header('Content-type: ' . $content_type);
    echo $body;
}
/*----END HELPER-----*/

function redeem() {
 
    // Check for required parameters
    if (isset($_POST["rw_app_id"]) && isset($_POST["code"]) && isset($_POST["device_id"])) {
 
        // Put parameters into local variables
        $rw_app_id = $_POST["rw_app_id"];
        $code = $_POST["code"];
        $device_id = $_POST["device_id"];
 
        // Look up code in database
        $user_id = 0;
        $stmt = $this->db->prepare('SELECT id, unlock_code, uses_remaining FROM rw_promo_code WHERE rw_app_id=? AND code=?');
        $stmt->bind_param("is", $rw_app_id, $code);
        $stmt->execute();
        $stmt->bind_result($id, $unlock_code, $uses_remaining);
        while ($stmt->fetch()) {
            break;
        }
        $stmt->close();
 
        // Bail if code doesn't exist
        if ($id <= 0) {
            sendResponse(400, 'Invalid code');
            return false;
        }
 
        // Bail if code already used		
        if ($uses_remaining <= 0) {
            sendResponse(403, 'Code already used');
            return false;
        }	
 
        // Check to see if this device already redeemed	
        $stmt = $this->db->prepare('SELECT id FROM rw_promo_code_redeemed WHERE device_id=? AND rw_promo_code_id=?');
        $stmt->bind_param("si", $device_id, $id);
        $stmt->execute();
        $stmt->bind_result($redeemed_id);
        while ($stmt->fetch()) {
            break;
        }
        $stmt->close();
 
        // Bail if code already redeemed
        if ($redeemed_id > 0) {
            sendResponse(403, 'Code already used');
            return false;
        }
 
        // Add tracking of redemption
        $stmt = $this->db->prepare("INSERT INTO rw_promo_code_redeemed (rw_promo_code_id, device_id) VALUES (?, ?)");
        $stmt->bind_param("is", $id, $device_id);
        $stmt->execute();
        $stmt->close();
 
        // Decrement use of code
        $this->db->query("UPDATE rw_promo_code SET uses_remaining=uses_remaining-1 WHERE id=$id");
        $this->db->commit();
 
        // Return unlock code, encoded with JSON
        $result = array(
            "unlock_code" => $unlock_code,
        );
        sendResponse(200, json_encode($result));
        return true;
    }
    sendResponse(400, 'Invalid request');
    return false;
 
}
}
