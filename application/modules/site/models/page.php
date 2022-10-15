<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class page extends CI_Model
{

	private $_suffix = "RS. DR. AK GANI";
	private $_divider = " | ";

	function __construct(){
		parent::__construct();
	}

	function set_page_title( $page_title = "Home" ){

		return $page_title.$this->_divider.$this->_suffix;

	}

	function breadcrumbs(){
		
	}

}