<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_Pengumuman extends CI_Model
{
	private $table_name;

	public function __construct()
	{
		parent::__construct();
		$this->table_name = "announcements";
	}

	public function _get_announcement()
	{

		$query = $this->db->query("SELECT * FROM announcements WHERE `ann_exp_date` >= '".date('Y-m-d')."' ");

		return $query->result();

	}
}