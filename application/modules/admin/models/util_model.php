<?php  if ( ! defined('BASEPATH')) exit('No direct script access superuserowed');

class Util_Model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function get_categories(){

		$query = $this->db->query("SELECT * FROM categories");

		return $query->result();
	}


}