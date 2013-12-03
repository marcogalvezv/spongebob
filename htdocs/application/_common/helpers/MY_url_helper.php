<?php
// override redirect to handle ajax-redirect.
if ( !function_exists('redirect'))
{
	function redirect($uri = '', $method = 'location', $http_response_code = 302)
	{
		if ( ! preg_match('#^https?://#i', $uri))
		{
			$uri = site_url($uri);
		}
		load_class('Hooks')->_call_hook('pre_redirect');
		if(!is_ajax_request()){
			switch($method)
			{
				case 'refresh': header("Refresh:0;url=".$uri);
				break;
				default:header("Location: ".$uri, TRUE, $http_response_code);
				break;
			}
		}else{		
			switch($method)
			{
				case 'refresh': 
							echo "<refresh></refresh>";				
				break;
							echo "<redirect>{$uri}</redirect>";				
				break;
			}
		}

		load_class('Hooks')->_call_hook('post_redirect');
		exit;
	}
}

function build_sort_url($field){
	parse_str($_SERVER['QUERY_STRING'], $query);
	if(element("o",$query,"") == $field){
		$query['o'] = "{$field}__desc";
	}else{
		$query['o'] = "{$field}";
	}
	return current_url()."?".http_build_query($query);
}
?>