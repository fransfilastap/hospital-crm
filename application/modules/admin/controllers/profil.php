<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Profil extends MY_Controller
{
	private static $ALERT_WARNING = "alert-warning";
	private static $ALERT_FAILED 	= "alert-error";
	private static $ALERT_SUCCESS = "alert-success";
	
	public function __construct(){
		parent::__construct();
		$this->load->library( array('auth',"template",'menu','Breadcrumb'));
		//$this->load->model("m_bonus");
		$this->load->model("m_layanan");
		$this->breadcrumb = new Breadcrumb();
		$this->breadcrumb->add( array( "link"=>site_url("admin/profil"),"label"=>"Profil Pengguna" ) );
	}

	public function index(){

		if( $this->auth->_is_admin_logged_in() )
		{
			
			$output = new stdClass();

			$data['profil']			=	$this->m_layanan->getOne("admin",array( "admin_id"=> $this->session->userdata("current_admin_id") ));
			$data['notification']	=	$this->session->flashdata("change_name_notification");
			$data['change_password_notification']	=	$this->session->flashdata("change_password_notification");

			$output->output = $this->load->view("admin/profil/profil",$data,TRUE);
			$output->breadcrumb = $this->breadcrumb->render();
			$this->output( $output,TRUE );	 
		}
		else
		{
			redirect("admin/login");
		}
	}
	public function do_change_password(){
		
		if( $this->auth->_is_admin_logged_in() )
		{
			
			$this->load->library("form_validation");


			$this->form_validation->set_rules("current_password","current_password", "required|xss|trim");
			$this->form_validation->set_rules("new_password","new_password", "required|xss|trim");
			$this->form_validation->set_rules("conf_newpassword","conf_newpassword", "required|xss|trim");

			#NOTIFICATION
			$message  = array(
					'success' 	=> "Password anda telah diperbaharui",
					'warning_oldpassword' => "Password lama yang anda masukan tidak cocok",
					'fail'		=> "Maaf terjadi kesalahan sistem saat mengubah password anda :("
				);

			#TEMPLATE
			$template = '<div class="alert #type#>
								<button class="close" data-dismiss="alert"></button>
								#message#
							</div>';


			if( $this->form_validation->run() == FALSE )
			{
				$this->session->set_flashdata("change_password_notification", str_replace( array("#type#","#message#") 
													, array(Profil::$ALERT_FAILED, validation_errors()), $template));

				redirect("admin/profil");
			}
			else
			{
				$new_password = md5($this->input->post("new_password"));
				$old_password = md5($this->input->post("current_password"));
				
				$change_status = $this->m_admin->_change_password( $new_password, $old_password , $this->session->userdata("current_admin_id") );

				if( $change_status == -1 )
				{
					$this->session->set_flashdata("change_password_notification", str_replace( array("#type#","#message#") 
												, array(pasien::$ALERT_FAILED, $message['fail']), $template ));

					redirect("admin/profil");
				}
				elseif ( $change_status == 1 ) {
					$this->session->set_flashdata("change_password_notification", str_replace( array("#type#","#message#") 
												, array(Profil::$ALERT_WARNING, $message['warning_oldpassword']), $template ));

					redirect("admin/profil");					
				}
				else
				{
					$this->session->set_flashdata("change_password_notification", str_replace( array("#type#","#message#") 
												, array(Profil::$ALERT_SUCCESS, $message['success']), $template ));

					#update new session data with new password;
					$this->session->set_userdata("current_admin_password", $new_password);
					redirect("admin/profil");					
				}
			}
		}
		else
		{
			redirect("pasien/login");
		}
		
	}


	function update_profil(){

		if( $this->auth->_is_admin_logged_in() )
		{
			
			$this->load->library("form_validation");


			$this->form_validation->set_rules("nama","nama", "xss");
			$this->form_validation->set_rules("username","username", "xss");

			#NOTIFICATION
			$message  = array(
					'success' 	=> "Profil anda telah diperbaharui",
					'fail'		=> "Maaf terjadi kesalahan sistem saat mengubah anda :("
				);

			#TEMPLATE
			$template = '<div class="alert #type#>
								<button class="close" data-dismiss="alert"></button>
								#message#
							</div>';


			if( $this->form_validation->run() == FALSE )
			{
				$this->session->set_flashdata("change_password_notification", "");
				$this->session->set_flashdata("change_name_notification", str_replace( array("#type#","#message#") 
													, array(Profil::$ALERT_FAILED, validation_errors()), $template));

				redirect("admin/profil");
			}
			else
			{
				$name = $this->input->post("nama",TRUE);
				$username = $this->input->post("username",TRUE);

				if( $this->m_admin->_update( $this->session->userdata("current_admin_id"), array("name"=>$name ,"username"=>$username ))  )
				{
					$this->session->set_flashdata("change_password_notification", "");
					$this->session->set_flashdata("change_name_notification", str_replace( array("#type#","#message#") 
												, array(Profil::$ALERT_SUCCESS, $message['success']), $template ));

					$this->session->set_userdata( array("current_admin_name"=>$name) );

					redirect("admin/profil");
				}
				else
				{
					$this->session->set_flashdata("change_password_notification", "");
					$this->session->set_flashdata("change_name_notification", str_replace( array("#type#","#message#") 
												, array(Profil::$ALERT_SUCCESS, $message['fail']), $template ));

					#update new session data with new password;
					$this->session->set_userdata("current_admin_password", $new_password);
					redirect("admin/profil");					
				}
			}
		}
		else
		{
			redirect("pasien/login");
		}
	}

	private function output($output,$isPlain=false){
		if( $this->auth->_is_admin_logged_in() )
		{
			$output->title = "Profil Pengguna | Admin";
			$output->page_title='Profil';
			$output->description='Ubah Nama / Password';
			$output->menus = $this->menu->get_menus( ''  );
			$this->template->display("content",$output,$isPlain);
		}
		else{
			redirect( site_url("admin/login") );
		}
	}
}