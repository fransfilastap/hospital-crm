<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Login extends MX_Controller
{
	function __construct (){
		parent :: __construct ();
		$this->load->library('form_validation');
		$this->load->library('auth');
		$this->load->model("m_layanan");
	}
	
	function index ()
	{
		if( $this->auth->_is_admin_logged_in() )
		{
			redirect("admin/dashboard");
		}
		else
		{
			//$data['captcha']=$this->auth->_create_captcha();
			$data['status']		=	$this->session->flashdata("login_status");
			$this->load->view("admin/login",$data);
		}
	}
	function do_login ()
	{

		#NOTIFICATION
		$message  = array(
				'warning_wrong_captcha'		=> "Maaf kode captcha yang anda masukan salah.",
				'warning_wrong_id_password' => "Maaf id/email atau password yang anda masukan tidak cocok ! ",
				'warning_account_not_active' => "Akun anda belum aktif, silahkan membayar uang pendaftaran terlebih dahulu.",
				'warning_field_not_complete' => "Anda tidak melengkapi seluruh field"
			);

		#TEMPLATE
		$template = '<div class="alert alert-warning>
							<button class="close" data-dismiss="alert"></button>
							#message#
						</div>';
		
		$this->form_validation->set_rules('username','Username', 'trim|required|strip_tags');
		$this->form_validation->set_rules('password','Password', 'trim|required');
		//$this->form_validation->set_rules('captcha','capthca', 'trim|required');
		
		if($this->form_validation->run() == false ){
			$this->session->set_flashdata("login_status" , str_replace("#message#" , $message['warning_field_not_complete'], $template)) ;
			redirect("admin/login");
		}
		else 
		{
			//if( $this->auth->_is_captcha_right( $this->input->post("captcha") ) )
			//{

				$username = $this->input->post("username",TRUE);
				$password = md5( $this->input->post("password",TRUE) ) ;
				$login_result = $this->auth->login( $username , $password , "admin" );

				if( $login_result ) #login success
				{
					$admin = $this->m_admin->_get_admin( $username , "username,name, role,admin_id" );
					$this->session->set_userdata( array( "current_admin_id" => $admin[0]->admin_id,"current_admin_username" => $username , "current_admin_password" => $password , "current_admin_name" => $admin[0]->name, "current_admin_role" =>$admin[0]->role  ) );
					
					if( $admin[0]->role == "dokter" ){
						$hasil = $this->m_layanan->getOne("dokter",array("nip_dokter"=>$admin[0]->username));
						$this->session->set_userdata( array("current_dokter_id" => $hasil[0]->id_dokter) );
					}

					redirect("admin/dashboard");
				}
				else #login fail
				{	
					$this->session->set_flashdata("login_status" , str_replace("#message#" , $message['warning_wrong_id_password'], $template)) ;
					redirect("admin/login");
				}

			//}
			//else
			//{
			//	$this->session->set_flashdata("login_status" , str_replace("#message#" , $message['warning_wrong_captcha'], $template)) ;
			//	redirect("admin/login");
			//}
		}
		
	}

	
	function logout(){
		$this->auth->logout("admin");
	}
}