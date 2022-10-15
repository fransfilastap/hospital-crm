<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class m_module extends CI_Model
{
		
	public function __construct()
	{
		parent::__construct();
		$this->table_name = "modules";
		$this->load->database();
	}

	public function _get_module()
	{
		$this->db->select();
		$this->db->from( $this->table_name );
		$query = $this->db->get();

		return $query->result_array();
	}

	public function is_granted( $controller,  $role )
	{
		$query = $this->db->query("SELECT  `access` 
						FROM  `modules` 
						WHERE  `module_controller` =  '".$controller."'");
		
		$row = $query->result();

		if( $query->num_rows() > 0 ){
			if(  strtolower( $role ) == "superuser" || strtolower( $row[0]->access ) == 'all')
			{
				return true;
			}
			
			elseif ( strtolower( $role ) == strtolower( $row[0]->access ) ) {
				return true;
			}

			elseif (strtolower( $role ) == "dokter" &&  strtolower( $row[0]->access ) == "dokter" ) {
				return true;
			}

			return false;
		}
		return true;
	}

	public function is_active( $controller )
	{
		$query = $this->db->query("SELECT  `module_mode` 
						FROM  `modules` 
						WHERE  `module_controller` =  '".$controller."'");
		$row = $query->result();

		return ($row[0]->module_mode == 1);
	}
}