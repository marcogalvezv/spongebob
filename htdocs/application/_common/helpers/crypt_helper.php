<?php

//const SALT_LENGTH = 10;

/**
 * Extract salt from the hashed password
 *
 **/
function extract_salt($hashedstring) 
{
	return substr($hashedstring, 0, SALT_LENGTH);
}

/**
 * Hashes the string
 *
 **/
function hashstring($string, $salt = NULL) 
{
	if ($salt === NULL) { $salt = salt(); }
	return $salt . hashsha1($salt . $string);
}


/**
 * Generates a random uniq sequence.
 *
 **/
function uniqseq() 
{
	return md5(uniqid(rand(), true));
}

/**
 * Generates a random salt value.
 *
 **/
function salt() 
{
	return substr(uniqseq(), 0, SALT_LENGTH);
}

/**
 * Hashing function
 *
 **/
function hashsha1($str) 
{
	return sha1($str);
}

?>