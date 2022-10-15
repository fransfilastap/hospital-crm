<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class m_admin extends CI_Model
{
		

	public function __construct()
	{
		parent::__construct();
		$this->table_name = "admin";
		$this->load->database();
	}

	// for login purpose
	public function _check_superuser( $username, $password )
	{
		$query = $this->db->query("SELECT * 
									FROM  `admin` 
									WHERE  `username` =  '".$username."'
									AND  `password` =  '".$password."'
									LIMIT 0 , 1");

		if( $query->num_rows() > 0 )
		{
			return true;
		}
		return false;
	}

	##########################################################################################
	# get admin by email or his/her id
	public function _get_admin( $username, $fields="*" )
	{
		$this->db->select( $fields );
		$this->db->from( $this->table_name );
		$this->db->where("username",$username);

		return $this->db->get()->result();
	}

	public function _change_password( $new_password, $old_password , $id )
	{
		if( $this->_check_admin( $id , $old_password ) == 1 )
		{
			
			$this->db->where("admin_id",$id);
			return ( $this->db->update("admin",array("password"=>$new_password)) ? 0 : -1 );
		}

		return 1;
	}

	public function _check_admin( $id, $password )
	{
		$query = $this->db->query("SELECT * 
									FROM  `admin` 
									WHERE  `admin_id` =  '".$id."'
									AND  `password` =  '".$password."'
									LIMIT 0 , 1");

		if( $query->num_rows() > 0 )
		{
			return true;
		}
		return false;
	}


	public function _update($id,array $data){

		$this->db->where("admin_id",$id);
		return $this->db->update("admin",$data);

	}


}