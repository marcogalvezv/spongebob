<?php
function moveUp($input,$index) {
	$new_array = $input;

	if((count($new_array)>$index) && ($index>0)){
			 array_splice($new_array, $index-1, 0, $input[$index]);
			 array_splice($new_array, $index+1, 1);
		 }

	return $new_array;
}

function moveDown($input,$index) {
	$new_array = $input;

	if(count($new_array)>$index) {
			 array_splice($new_array, $index+2, 0, $input[$index]);
			 array_splice($new_array, $index, 1);
		 }

	return $new_array;
}
function array_insert2(&$array, $insert, $position) {
	if (is_object($insert)) {
		$insert = array($insert);
	}
	array_splice($array, $position, 0, $insert);
}

function array_insert(&$array, $insert, $position){
	if(!is_numeric($position)) 
		return false;

	if($position = count($array)){
		$array = array_merge($array, array($insert));
	} else {
		$head = array_slice($array, 0, $position);
		$insert = array($insert);
		$tail = array_slice($array, $position);
		$array = array_merge($head, $insert, $tail);
	}
	return true;
}

/* ONLY FOR PHP v5.3.x
function sortArrayMultiFieldsClosure($data, $field, $desc = false)
{
	if(!is_array($field)) $field = array($field);
		//ASCENDING SORT
		if(!$desc) 
		{
			usort($data, function($a, $b) use($field) {
				$retval = 0;				
				foreach($field as $fieldname) {
					if($retval == 0) $retval = strnatcmp($a[$fieldname],$b[$fieldname]);
				}
				return $retval;
			});
		} 
		else
		{
			usort($data, function($a, $b) use($field) {
				$retval = 0;				
				foreach($field as $fieldname) {
					if($retval == 0) $retval = strnatcmp($b[$fieldname],$a[$fieldname]);
				}
				return $retval;
			});
		}
	return $data;
}
*/

function sortArrayMultiFieldsCustom($data, $fields, $desc = false)
{
	//Error checking, if it's a non-sortable list or $fields is empty
	if( count( $fields ) == 0 or count( $data ) <= 1 ) return $data;

	if( !is_array( $fields ) ) $fields = array( $fields );
		$code = "\$retval = strnatcmp(\$a['$fields[0]'], \$b['$fields[0]']);";

	for( $i=1;$i<count($fields);$i++ )
		$code .= "if( !\$retval ) \$retval = strnatcmp(\$a['$fields[$i]'], \$b['$fields[$i]']);";
	
	$code .= "return \$retval;";
	//echo $code;
	if(!$desc) 
	{
		//ASCENDING SORT
		usort($data, create_function('$a,$b', $code));
	} 
	elseif($desc) 
	{
		//DESCENDING SORT
		usort($data, create_function('$b,$a', $code));
	}
	//usort( $data, create_function( '$a,$b', $code ) );
	
	return $data;
}

function orderBy($data, $field, $desc = false) 
{
	$codeASC = "return strnatcmp(\$a['$field'], \$b['$field']);";
	$codeDESC = "return strnatcmp(\$b['$field'], \$a['$field']);";
	
	if(!$desc) 
	{
		//ASCENDING SORT
		usort($data, create_function('$a,$b', $codeASC));
	} 
	elseif($desc) 
	{
		//DESCENDING SORT
		usort($data, create_function('$a,$b', $codeDESC));
	}
	return $data; 
}

function object_2_array($result) 
{ 
    $array = array(); 
    foreach ($result as $key=>$value) 
    {
       # if $value is an array then
        if (is_array($value))
        { 
            #you are feeding an array to object_2_array function it could potentially be a perpetual loop. 
            $array[$key]=object_2_array($value); 
        } else { 
			# if $value is an object then 
			if (is_object($value)) 
			{
				$array[$key]=object_2_array($value); 
			} else { 
				$array[$key]=$value; 
			}
        }
    }
    return $array;
}

?>