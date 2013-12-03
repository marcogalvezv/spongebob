<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
/**
 * Payment driver interface
 *
 *
 * @package    Payment
 * @author     Carlos Alcala
 */
interface Payment_Driver {

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
	
	//public function create();
	
	public function success();
	
	public function subscription();

} // End Payment Driver Interface