<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class m_pasien extends CI_Model
{
	private $table_name =  "pasien";
	private $pk_head	=	"PAS";
	private $pk_length	=	5;

	####################################################################################################
	public function __construct()
	{
		parent::__construct();
	}

	####################################################################################################
	public function _insert( array $data_array )
	{
		if( $this->_check_email( $data_array['pasien_email'] ) OR $this->_check_phone( $data_array['pasien_phone_number'] OR $this->_check_nik( $this->_check_nik( $data_array['pasien_nik'] ) ) ) )
		{
			return false;
		}
		
		return $this->db->insert( $this->table_name , $data_array );

	}


	####################################################################################################
	public function _update(array $data,$id)
	{
		$this->db->where( $id );
		return $this->db->update( $this->table_name , $data );
	}

	####################################################################################################

	public function _delete($id)
	{
		$this->db->delete( $this->table_name , $id );
	}

	####################################################################################################
	public function _check_pasien_id( $id )
	{

		$this->db->select("*");
		$this->db->from( $this->table_name );
		$this->db->where( "pasien_id", $id );

		$query = $this->db->get();

		return ( $query->num_rows() > 0 );

	}

	####################################################################################################
	public function _check_nik( $data )
	{
		$this->db->select("*");
		$this->db->from( $this->table_name );
		$this->db->where( "pasien_nik", $data );

		$query = $this->db->get();

		return ( $query->num_rows() > 0 );
	}

	####################################################################################################
	public function _check_email( $data )
	{
		$this->db->select("*");
		$this->db->from( $this->table_name );
		$this->db->where( "pasien_email", $data );

		$query = $this->db->get();

		return ( $query->num_rows() > 0 );
	}

	####################################################################################################
	public function _check_phone( $data )
	{
		$this->db->select("*");
		$this->db->from( $this->table_name );
		$this->db->where( "pasien_phone_number", $data );

		$query = $this->db->get();


		return ( $query->num_rows() > 0 );
	}

	####################################################################################################
	/**
	 * @param <b>Username </b> : pasien's email or pasien's id
	 * @param <b>Password </b> : password
	 *
	 */
	public function _check_pasien( $username, $password )
	{
		$query = $this->db->query( "SELECT *
									FROM `pasiens`
									WHERE (`pasien_username` = '".$username."' OR `pasien_email` = '".$username."')
											AND `pasien_password` = '".$password."'");

		if( $query->num_rows() > 0 )
		{
			$row = $query->row();

			if( $row->pasien_status == "aktif" )
			{
				$this->db->query( "UPDATE `pasiens` SET pasien_last_login = NOW() WHERE pasien_id = '".$row->pasien_id."'" );
				return 1;
			}
			elseif ( $row->pasien_status == "tidak aktif" ) {
				return 0;
			}
		}

		return -1;
	}

	####################################################################################################
	public function _check_email_before_update($email,$id)
	{
		$this->db->select("*");
		$this->db->from( $this->table_name );
		$this->db->where( "pasien_email", $email );
		$this->db->where( "( pasien_username != '".$id."' AND pasien_email != '".$id."')");		

		$query = $this->db->get();


		return ( $query->num_rows() > 0 );
	}
	
	####################################################################################################

	/*public function _check_referal_link( $referal_link, $id){
		$this->db->select();
		$this->db->from( $this->table_name );
		$this->db->where("pasien_url",$referal_link);
		$this->db->where( "( pasien_username != '".$id."' AND pasien_email != '".$id."')");

		$query = $this->db->get();

		return ( $query->num_rows() > 0 );
	}
	*/
	###################################################################################################
	public function _check_phone_before_update($phone,$id)
	{
		$this->db->select("*");
		$this->db->from( $this->table_name );
		$this->db->where( "pasien_phone_number", $phone );
		$this->db->where( "( pasien_username != '".$id."' AND pasien_email != '".$id."')");		

		$query = $this->db->get();


		return ( $query->num_rows() > 0 );
	}
	
	####################################################################################################

	public function _check_nik_before_update($nik,$id)
	{
		$this->db->select("*");
		$this->db->from( $this->table_name );
		$this->db->where( "pasien_nik", $nik );
		$this->db->where( "( pasien_username != '".$id."' AND pasien_email != '".$id."')");			

		$query = $this->db->get();


		return ( $query->num_rows() > 0 );
	}


	####################################################################################################

	public function generatPasienID(){

		$this->db->select_max("id_pasien");
		$this->db->from( "pasien" );

		$query  =		$this->db->get();

		$last_pk =	$query->result();

		//mencari number terakhir
		$max 	=	(int) substr($last_pk[0]->id_pasien, strlen( $this->pk_head ), $this->pk_length );

		//next number will be
		$max++;

		
		//generate new id
		$newID = $this->pk_head . sprintf("%0".$this->pk_length."s", $max);

		return $newID;	

	}
	##########################################################################################
	# get pasien by email or his/her id
	public function _get_pasien( $pasien_id , $fields="*" )
	{
		$this->db->select( $fields );
		$this->db->from( $this->table_name );
		$this->db->where('id_pasien', $pasien_id);		
		//$this->db->or_where('pasien_email', $pasien_id);

		return $this->db->get()->result();
	}

	public function _update_pasien( $id, array $data )
	{
		$this->db->where("id_pasien", $id);
		$this->db->or_where("username",$id);
		return $this->db->update( $this->table_name , $data );
	}

	####################################################################################################
	/**
	 * @param new_password
	 * @param old_password
	 * @param $id
	 * @return integer 0 = change success, 1 = old password is wrong , -1 = failed to change password
	 */
	public function _change_password( $new_password, $old_password , $id )
	{
		if( $this->_check_pasien( $id , $old_password ) == 1 )
		{
			return ( $this->_update_pasien( $id , array('password'=>$new_password) ) ? 0 : -1 );
		}

		return 1;
	}

	/*
	public function _current_bonus( $id ,$formated=false)
	{
		$sql = "";

		if( $formated ){
			$sql = "SELECT CONCAT('Rp. ',FORMAT(bonus,2)) as bonus,CONCAT('Rp. ',FORMAT(deposit,2)) as 
						deposit from pasien_wallets where wallet_id = ( SELECT wallet_id FROM pasiens WHERE pasien_id =  
							'".$id."' or pasien_username =  '".$id."' or pasien_email =  '".$id."'  )";
		}else{
			$sql = "SELECT bonus,deposit from pasien_wallets where wallet_id = ( SELECT wallet_id FROM pasiens WHERE pasien_id =  
							'".$id."' or pasien_username =  '".$id."' or pasien_email =  '".$id."'  )";
		}
		$query = $this->db->query($sql);
		return $query->row();
	}

	public function get_transaction( $id ){

		$sql = "SELECT t.transaction_ref_code AS code, t2.id AS t_id,m.pasien_username, m.pasien_email, t2.transaction_type AS t_type, CONCAT('Rp. ', FORMAT(transaction_amount,2)) AS amount,
				CASE t.transaction_status WHEN 0 THEN 'Pending' WHEN 1 THEN 'Selesai' END AS t_status , transaction_time AS t_time
				FROM transactions t LEFT JOIN transaction_types t2 ON t2.id = t.transaction_type LEFT JOIN pasiens m ON t.pasien_id = m.pasien_id
				WHERE t.pasien_id = '".$id."' OR m.pasien_username = '".$id."' OR m.pasien_email = '".$id."' ORDER BY t_time DESC";

		$query = $this->db->query( $sql );

		return $query->result();

	}
	*/


}