<?php
function end_form_row($field = "", $alter_error = ""){
	if($field){
		$err = form_error($field);
		if($err){
			if($alter_error && is_array($alter_error)){
				foreach($alter_error as $hint => $alter){
				 if(strpos($err, $hint)!==false){
				  $err = '<span class="error">'.$alter.'</span>';
				  break;
				 }
				}
			}
			return ''.$err.'';
		}
	}
	return '';
}