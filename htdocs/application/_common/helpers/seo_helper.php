<?php
/**
 * Limpiar todos los acentos por sus equivalentes sin ellos
 *
 * @param $string
 *  string la cadena a sanear
 *
 * @return $string
 *  string saneada
 */
function clean_string($string)
{
 
    $string = trim($string);
 
    $string = str_replace(
        array('�', '�', '�', '�', '�', '�', '�', '�', '�'),
        array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
        $string
    );
 
    $string = str_replace(
        array('�', '�', '�', '�', '�', '�', '�', '�'),
        array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
        $string
    );
 
    $string = str_replace(
        array('�', '�', '�', '�', '�', '�', '�', '�'),
        array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
        $string
    );
 
    $string = str_replace(
        array('�', '�', '�', '�', '�', '�', '�', '�'),
        array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
        $string
    );
 
    $string = str_replace(
        array('�', '�', '�', '�', '�', '�', '�', '�'),
        array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
        $string
    );
 
    $string = str_replace(
        array('�', '�', '�', '�'),
        array('n', 'N', 'c', 'C',),
        $string
    );
 
    //Esta parte se encarga de eliminar cualquier caracter extra�o
    $string = str_replace(
        array("\\", "�", "�", "-", "~",
             "#", "@", "|", "!", "\"",
             "�", "$", "%", "&", "/",
             "(", ")", "?", "'", "�",
             "�", "[", "^", "`", "]",
             "+", "}", "{", "�", "�",
             ">", "<", ";", ",", ":",
             ".", " "),
        '',
        $string
    );
 
 
    return $string;
}
function limpiar_acento($s)
{
	$s = preg_replace("/[����]/","a",$s);
	$s = preg_replace("/[����]/","A",$s);
	$s = preg_replace("/[���]/","I",$s);
	$s = preg_replace("/[���]/","i",$s);
	$s = preg_replace("/[���]/","e",$s);
	$s = preg_replace("/[���]/","E",$s);
	$s = preg_replace("/[�����]/","o",$s);
	$s = preg_replace("/[����]/","O",$s);
	$s = preg_replace("/[���]/","u",$s);
	$s = preg_replace("/[���]/","U",$s);
	$s = str_replace("�","c",$s);
	$s = str_replace("�","C",$s);
	$s = str_replace("�","n",$s);
	$s = str_replace("�","N",$s);

	return $s;
}

function seo_url($string) {
        //clean string
        $string = limpiar_acento($string);
        //Unwanted:  {UPPERCASE} ; / ? : @ & = + $ , . ! ~ * ' ( )
        $string = strtolower($string);
        //Strip any unwanted characters
        $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
        //Clean multiple dashes or whitespaces
        $string = preg_replace("/[\s-]+/", " ", $string);
        //Convert whitespaces and underscore to dash
        $string = preg_replace("/[\s_]/", "-", $string);
        return $string;
}


?>