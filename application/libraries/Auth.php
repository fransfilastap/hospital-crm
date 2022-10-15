<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth
{
	####################################################################################################
	public function __construct()
	{
		$this->_ci = & get_instance();
		$this->_ci->load->library('session');
		$this->_ci->load->model( array( "m_pasien","m_admin" ) );
		$this->_ci->load->helper( array("security","captcha","string") );
	}

	####################################################################################################
	public function _create_captcha()
	{
		$vals = array(
			'word' => random_string('alnum', 5),
    		'img_path' => './captcha/',
    		'img_url' => base_url('captcha').'/',
    		'font_path' => './path/to/fonts/texb.ttf',
    		'img_width' => '150',
    		'img_height' => 30,
    		'expiration' => 7200
    	);

		$cap = create_captcha($vals);

		// prepare the data to insert in captcha table
		$data = array(
    			'captcha_time' => $cap['time'],
    			'ip_address' => $this->_ci->input->ip_address(),
    			'word' => $cap['word']
    	);

    	$this->_ci->session->set_flashdata( 'captcha_word' , $cap['word'] );

		return $cap['image'];
	}

	####################################################################################################
	public function _is_pasien_logged_in()
	{
		$username 	=	$this->_ci->session->userdata("current_pasien_username");
		$password	=	$this->_ci->session->userdata("current_pasien_password");

		//echo $this->_ci->m_pasien->_check_pasien( $username , $password );
		return ( $this->_ci->m_pasien->_check_pasien( $username , $password ) == 1);
	}

	####################################################################################################
	public function _is_admin_logged_in()
	{
		$username 	=	$this->_ci->session->userdata("current_admin_username");
		$password	=	$this->_ci->session->userdata("current_admin_password");

		return ( $this->_ci->m_admin->_check_superuser( $username , $password ) );
	}


	####################################################################################################
	public function login( $username , $password , $type="pasien" ) 
	{	
		$is_true = -1;

		if( $type == "pasien" )
		{
			$is_true = $this->_ci->m_pasien->_check_pasien( $username , $password );
		}
		//if role is admin
		elseif( $type == "admin" )
		{
			$is_true = $this->_ci->m_admin->_check_superuser( $username , $password );
		}
		
		return $is_true;

	}

	
	####################################################################################################
	public function logout( $type = "pasien" )
	{
		$this->_ci->session->sess_destroy();
		
		if( strtolower($type) == "pasien" )
		{
			redirect("pasien/login");
		}
		if( strtolower($type) == "admin" )
		{
			redirect("admin/login");
		}
	}

	####################################################################################################
	public function _is_captcha_right( $word )
	{
		return (  strcasecmp($this->_ci->session->flashdata('captcha_word'), $word) == 0 );
	}





}