<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
/**
 * Innovata driver interface
 *
 *
 * @package    Innovata
 * @author     Carlos Alcala
 */
interface Flightdata_Driver {

	/**
	 * Sets driver fields and marks reqired fields as TRUE.
	 *
	 * @param  array  array of key => value pairs to set
	 */
	public function set_fields($fields);

	/**
	 * Runs the transaction.
	 *
	 * @return  boolean
	 */
	public function process();
	
	public function success();
	
	public function response();

} // End Innovata Driver Interface