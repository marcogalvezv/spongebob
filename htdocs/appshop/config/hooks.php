<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/general/hooks.html
|
*/

$hook['display_override'][] = array(
				'class'    => 'Layout',
				'function' => 'execute',
				'filename' => 'Layout.php',
				'filepath' => 'libraries',
				'params'   => array()
);

/*
$hook['post_controller_constructor'][] = array(
				'class'    => '',
				'function' => 'ajax_layout',
				'filename' => 'ajax-layout'.EXT,
				'filepath' => 'hooks',
				'params'   => array()
);
*/
// disable browser cache by default
$hook['post_controller_constructor'][] = array(
                  'class'    => '',
                  'function' => 'disable_browser_cache',
                  'filename' => 'cache-control'.EXT,
                  'filepath' => 'hooks',
                  'params'   => array()
); 



/* End of file hooks.php */
/* Location: ./application/config/hooks.php */