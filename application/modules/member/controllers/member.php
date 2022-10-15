<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author Frans Filasta Pratama
*/

Class pasien extends MX_Controller
{
	private static $ALERT_WARNING = "alert-warning";
	private static $ALERT_FAILED 	= "alert-error";
	private static $ALERT_SUCCESS = "alert-success";



	function __construct()
	{
		parent::__construct();

		$this->load->model( array( "m_pasien","m_bonus","m_pengumuman","mlm_model" ) );
		$this->load->helper( array("mlm_affiliate","string","money") );
		$this->load->library( array( "auth" , "form_validation" , "Auth" ,"session", "pageproperties","templaterender" ) );
		$this->load->database();
		
	}

	####################################################################################################
	public function index()
	{
		redirect("pasien/dashboard");
	}

	####################################################################################################
	function dashboard()
	{
		if( $this->auth->_is_pasien_logged_in() )
		{
			$dashboard_data = array();
			
			$pasien = $this->m_pasien->_get_pasien( $this->session->userdata("current_pasien_username") );

			$dashboard_data['announcements'] 	= 	$this->m_pengumuman->_get_announcement();
			$dashboard_data['bonus']			=	$this->m_pasien->_current_bonus( $pasien[0]->pasien_id);
			$dashboard_data['pasangan']			=	$this->mlm_model->count_pasien_pair( $pasien[0]->pasien_id );

			$dashboard_data['pasangan_detail'] = $this->mlm_model->count_pasien_pair_by_side( $pasien[0]->pasien_id );

    		$this->pageproperties->set_title("pasien Dashboard | SMSBersama.com");
    		$this->pageproperties->set_description("Dashboard");
    		$this->pageproperties->set_small_description("");

    		$this->templaterender->render( "dashboard", $dashboard_data, $this->pageproperties,"dashboard",null); 
		}
		else
		{
			redirect("pasien/login");
		}
		
	}
	
	####################################################################################################
	public function login()
	{
		
		if( $this->auth->_is_pasien_logged_in() )
		{
			redirect("pasien/dashboard");
		}
		else
		{
			$data['captcha'] 	= 	$this->auth->_create_captcha();
			$data['status']		=	$this->session->flashdata("login_status");
			$this->load->view("login",$data);		
		}

	}

	####################################################################################################
	function do_login()
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

		$this->form_validation->set_rules("username","username"		,"trim|required|xss_clean");
		$this->form_validation->set_rules("password","password"		,"trim|required|xss_clean");
		$this->form_validation->set_rules("captcha","captcha"		,"trim|required|xss_clean");

		if( $this->form_validation->run() == FALSE )
		{
			$this->session->set_flashdata("login_status" , str_replace("#message#", $message['warning_field_not_complete'], $template)) ;
					redirect("pasien/login");
			redirect("pasien/login");
		}
		else
		{
			if( $this->auth->_is_captcha_right( $this->input->post("captcha") ) )
			{

				$username = $this->input->post("username");
				$password = md5( $this->input->post("password") );
				$login_result = $this->auth->login( $username , $password );

				if( $login_result == 0 ) #your account is not activated yet
				{
					$this->session->set_flashdata("login_status" , str_replace("#message#", $message['warning_account_not_active'], $template)) ;
					redirect("pasien/login");
				}
				elseif( $login_result == 1 ) #success
				{
					$full_name = $this->m_pasien->_get_pasien( $username , "pasien_name" );
					$this->session->set_userdata( array( "current_pasien_username" => $username , "current_pasien_password" => $password , "current_pasien_name" => $full_name[0]->pasien_name ) );
					


					redirect("pasien/dashboard");
				}
				else #login failed
				{	
					$this->session->set_flashdata("login_status" , str_replace("#message#" , $message['warning_wrong_id_password'], $template)) ;
					redirect("pasien/login");
				}

			}
			else
			{
				$this->session->set_flashdata("login_status" , str_replace("#message#" , $message['warning_wrong_captcha'], $template)) ;
				redirect("pasien/login");
			}
		}
	}

	####################################################################################################
	public function logout()
	{
		$this->auth->logout();
	}

	####################################################################################################
	//handler registrasi pasien
	function register_pasien()
	{
		
			$this->form_validation->set_rules("id_pasien","id_pasien", "xss|required");
			$this->form_validation->set_rules("no_identitas","no_identitas","xss|required");
			$this->form_validation->set_rules("nama_pasien","nama_pasien","xss|required");
			$this->form_validation->set_rules("alamat","alamat","xss|required");
			$this->form_validation->set_rules("provinsi","provinsi","xss");
			$this->form_validation->set_rules("kota","kota","xss");
			$this->form_validation->set_rules("kode_pos","kode_pos","xss");
			$this->form_validation->set_rules("sex","sex","xss|required");
			$this->form_validation->set_rules("tempat_lahir","tempat_lahir","xss|required");
			$this->form_validation->set_rules("tanggal_lahir","tanggal_lahir","xss|required");
			$this->form_validation->set_rules("username","username","xss|required");
			$this->form_validation->set_rules("email","email","xss|required");
			$this->form_validation->set_rules("bank","bank","xss");
			$this->form_validation->set_rules("no_rekening","no_rekening","xss");
			$this->form_validation->set_rules("atas_nama","atas_nama","xss");
			$this->form_validation->set_rules("url_referal","url_referala","xss|required");


		if( $this->form_validation->run() == FALSE )
		{
			$this->session->set_flashdata( "registration_status" , validation_errors() );
			
			redirect('ref/'.$this->input->post("referal"));
		}
		else
		{
			$new_pasien["pasien_nik"] 			=  	$this->input->post("nomor_identitas");
			$new_pasien["pasien_name"]			=	$this->input->post("name");
			$new_pasien["pasien_address"]		=	$this->input->post("alamat");
			$new_pasien["pasien_city"]			=	$this->input->post("kota");
			$new_pasien["pasien_job"]			=	$this->input->post("pekerjaan");
			$new_pasien["pasien_sex"]			=	$this->input->post("sex");
			$new_pasien["pasien_tempat_lahir"]	=	$this->input->post("tempat_lahir");
			$new_pasien["pasien_tanggal_lahir"]	=	$this->input->post("tanggal_lahir");
			$new_pasien["pasien_religion"]		=	$this->input->post("agama");
			$new_pasien["pasien_referal"]		=	strtoupper($this->input->post("referal"));
			$new_pasien["pasien_join_date"]		=	date("y-m-d");
			$new_pasien["pasien_password"]		=	md5( $this->input->post("password") );
			$new_pasien["pasien_email"]			=	$this->input->post("email");
			$new_pasien["pasien_phone_number"]	=	$this->input->post("no_telp");

			
			if( $this->auth->_is_captcha_right( $this->input->post("captcha") ) )
			{
				if( $this->m_pasien->_insert( $new_pasien ) )
				{
					$this->load->view("registration_success");

					// send email
					/*$this->load->library("email");
					$this->email->from('no.reply@rajapulsa.com', 'no-reply');
					$this->email->to( $new_pasien['pasien_email'] );
					$this->email->subject('Informasi Akun CRM RS Community Anda');

					$message = " <p>Harap simpan informasi ini dengan baik. </p> ";
					$message .= "Username : <b>".$new_pasien['pasien_id']."</b></br>";
					$message .= "Password : <b>".$this->input->post("password")."</b></br>";
					$message .= "<p>Untuk menggunakan akun CRM RS Community segera membayar biaya pendaftaran.</p>";
					$message .= "</br> </br> </br> </br> ";
					$message .= "Administrator";

					$this->email->message( $message );

					$this->email->send();

					echo $this->email->print_debugger();
					*/

				}
				else
				{
					$this->session->set_flashdata("registration_status","Terjadi kesalahan saat menambahkan data anda");
					$this->session->set_flashdata("buffered_registration_data", serialize( $new_pasien ) );
					
					if( isset( $new_pasien['pasien_referal'] ) OR strlen( $new_pasien['pasien_referal'] ) > 0 )
					{
						redirect("ref/".$new_pasien['pasien_referal']);
					}
				}

			}
			else
			{
				$this->session->set_flashdata("registration_status","Captcha yang anda masukan salah");
				$this->session->set_flashdata("buffered_registration_data", serialize( $new_pasien ) );
				redirect('registrasi');
			}

		}
	}

	####################################################################################################
	function profil()
	{

		if( $this->auth->_is_pasien_logged_in() )
		{

            
            $fields = "pasien_id,pasien_nik,pasien_name, pasien_address, pasien_province, pasien_city,pasien_postal_code ,
            			 pasien_sex,pasien_tempat_lahir,pasien_tanggal_lahir, pasien_email,pasien_username, pasien_phone_number,pasien_bank, 
            			 pasien_rekening, pasien_atasnama,pasien_url ";

			$pasien_information = $this->m_pasien->_get_pasien( $this->session->userdata("current_pasien_username") , $fields );

			$return_data = array( 
				'notification' 		=> $this->session->flashdata("pasien_update_notification"),
				'profile'			=> $pasien_information[0]
			 );


    		$this->pageproperties->set_title("Biodata pasien | SMSBersama.com");
    		$this->pageproperties->set_description("Biodata Anda");
    		$this->pageproperties->set_small_description("Silakan ubah biodata anda di sini");

    		$this->templaterender->add_script("$('.sex[value=".$pasien_information[0]->pasien_sex."]').prop('checked',true)");
    		$this->templaterender->render( "pasien_profil", $return_data, $this->pageproperties,"Akun Anda","Biodata"); 

		}
		else
		{
			redirect("pasien/login");
		}

	}
	####################################################################################################
	function update_profil()
	{
		if( $this->auth->_is_pasien_logged_in() )
		{
			$this->form_validation->set_rules("id_pasien","id_pasien", "xss|required");
			$this->form_validation->set_rules("no_identitas","no_identitas","xss|required");
			$this->form_validation->set_rules("nama_pasien","nama_pasien","xss|required");
			$this->form_validation->set_rules("alamat","alamat","xss|required");
			$this->form_validation->set_rules("provinsi","provinsi","xss");
			$this->form_validation->set_rules("kota","kota","xss");
			$this->form_validation->set_rules("kode_pos","kode_pos","xss");
			$this->form_validation->set_rules("sex","sex","xss|required");
			$this->form_validation->set_rules("tempat_lahir","tempat_lahir","xss|required");
			$this->form_validation->set_rules("tanggal_lahir","tanggal_lahir","xss|required");
			$this->form_validation->set_rules("username","username","xss|required");
			$this->form_validation->set_rules("email","email","xss|required");
			$this->form_validation->set_rules("bank","bank","xss");
			$this->form_validation->set_rules("no_rekening","no_rekening","xss");
			$this->form_validation->set_rules("atas_nama","atas_nama","xss");
			$this->form_validation->set_rules("url_referal","url_referala","xss|required");

			$this->form_validation->set_rules("nomor_telepon","nomor_telepon","xss|required");

			#NOTIFICATION
			$message  = array(
					'success' 	=> "Data anda telah diperbaharui",
					'fail'		=> "Gagal melakukan pembaharuan terhadap data anda :( , coba lagi",
					'warning_email' => "Maaf email yang anda masukan telah digunakan oleh pasien lain. Harap masukan email lain. ",
					'warning_phone' => "Maaf nomor telepon yang anda masukan telah digunakan oleh pasien lain. Harap masukan nomor telepon lain. ",
					'warning_nik' => "Maaf nomor identitas yang anda masukan telah digunakan oleh pasien lain. Harap masukan nomor identitas lain.",
					'warning_url' => "Maaf URL Referal sudah digunakan pasien lain"
				);

			#TEMPLATE
			$template = '<div class="alert #type#>
								<button class="close" data-dismiss="alert"></button>
								#message#
							</div>';

			if( $this->form_validation->run() == FALSE )
			{
				$this->session->set_flashdata("pasien_update_notification" , str_replace( array("#type#","#message#") 
												, array(pasien::$ALERT_WARNING, validation_errors() ), $template) );
			
				redirect('pasien/profil');
			}
			else
			{
				$updated_pasien["pasien_nik"] 			=  	$this->input->post("no_identitas");
				$updated_pasien["pasien_name"]			=	$this->input->post("nama_pasien");
				$updated_pasien["pasien_address"]		=	$this->input->post("alamat");
				$updated_pasien["pasien_city"]			=	$this->input->post("kota");
				$updated_pasien["pasien_province"]		=	$this->input->post("provinsi");
				$updated_pasien["pasien_postal_code"]	=	$this->input->post("kode_pos");
				
				$updated_pasien["pasien_sex"]			=	$this->input->post("sex");
				$updated_pasien["pasien_tempat_lahir"]	=	$this->input->post("tempat_lahir");
				$updated_pasien["pasien_tanggal_lahir"]	=	$this->input->post("tanggal_lahir");
				$updated_pasien["pasien_email"]			=	$this->input->post("email");
				$updated_pasien["pasien_username"]		=	$this->input->post("username");
				$updated_pasien["pasien_bank"]			=	$this->input->post("bank");
				$updated_pasien["pasien_rekening"]		=	$this->input->post("no_rekening");
				$updated_pasien["pasien_atasnama"]		=	$this->input->post("atas_nama");
				$updated_pasien["pasien_url"]			=	$this->input->post("url_referal");
				$updated_pasien["pasien_phone_number"]	=	$this->input->post("nomor_telepon");


				$id = $this->session->userdata("current_pasien_username");

				if( $this->m_pasien->_check_nik_before_update( $updated_pasien['pasien_nik'] , $id ) ){
					$this->session->set_flashdata("pasien_update_notification" , str_replace( array("#type#","#message#") 
													, array(pasien::$ALERT_WARNING, $message['warning_nik']), $template) );
				}
				elseif( $this->m_pasien->_check_phone_before_update( $updated_pasien['pasien_phone_number'] , $id )  ){
					$this->session->set_flashdata("pasien_update_notification" , str_replace( array("#type#","#message#") 
													, array(pasien::$ALERT_WARNING, $message['warning_phone']), $template) );
				}
				elseif ( $this->m_pasien->_check_email_before_update( $updated_pasien['pasien_email'] , $id ) ) {
					$this->session->set_flashdata("pasien_update_notification" , str_replace( array("#type#","#message#") 
													, array(pasien::$ALERT_WARNING, $message['warning_email']), $template) );
				}
				elseif ( $this->m_pasien->_check_referal_link( $updated_pasien['pasien_url'] , $id ) ) {
					$this->session->set_flashdata("pasien_update_notification" , str_replace( array("#type#","#message#") 
													, array(pasien::$ALERT_WARNING, $message['warning_url']), $template) );
				}
				else
				{
					if( $this->m_pasien->_update_pasien( $this->input->post("id_pasien") , $updated_pasien ) )
					{
						$this->session->set_flashdata("pasien_update_notification" , str_replace( array("#type#","#message#") 
													, array(pasien::$ALERT_SUCCESS, $message['success']), $template) );

						#update username session
						$this->session->set_userdata("current_pasien_username", $updated_pasien['pasien_email']);
					}
					else
					{
						$this->session->set_flashdata("pasien_update_notification" , str_replace( array("#type#","#message#") 
													, array(pasien::$ALERT_FAILED, $message['fail']), $template) );
					}
				}

				redirect("pasien/profil");

			}
		}
		else
		{
			redirect("pasien/login");
		}
	}

	####################################################################################################
	function change_password()
	{
		if( $this->auth->_is_pasien_logged_in() )
		{
			$data['change_password_status'] = $this->session->flashdata("change_password_notification");
			
			$this->pageproperties->set_title("Ubah Password | SMSBersama.com");
    		$this->pageproperties->set_description("Ubah Password");
    		$this->pageproperties->set_small_description("Ubah Password Anda");

    		$this->templaterender->render( "change_password", $data, $this->pageproperties,"Akun Anda","Ubah Password"); 
		}
		else
		{
			redirect("pasien/login");
		}
	}

	####################################################################################################
	function do_change_password()
	{

		if( $this->auth->_is_pasien_logged_in() )
		{
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
													, array(pasien::$ALERT_FAILED, validation_errors()), $template));

				redirect("pasien/change_password");
			}
			else
			{
				$new_password = md5($this->input->post("new_password"));
				$old_password = md5($this->input->post("current_password"));
				
				$change_status = $this->m_pasien->_change_password( $new_password, $old_password , $this->session->userdata("current_pasien_username") );

				if( $change_status == -1 )
				{
					$this->session->set_flashdata("change_password_notification", str_replace( array("#type#","#message#") 
												, array(pasien::$ALERT_FAILED, $message['fail']), $template ));

					redirect("pasien/change_password");
				}
				elseif ( $change_status == 1 ) {
					$this->session->set_flashdata("change_password_notification", str_replace( array("#type#","#message#") 
												, array(pasien::$ALERT_WARNING, $message['warning_oldpassword']), $template ));

					redirect("pasien/change_password");					
				}
				else
				{
					$this->session->set_flashdata("change_password_notification", str_replace( array("#type#","#message#") 
												, array(pasien::$ALERT_SUCCESS, $message['success']), $template ));

					#update new session data with new password;
					$this->session->set_userdata("current_pasien_password", $new_password);
					redirect("pasien/change_password");					
				}
			}
		}
		else
		{
			redirect("pasien/login");
		}
		


	}

	############################################################################################################
	public function affiliate_tree()
	{
		if( $this->auth->_is_pasien_logged_in() )
		{
			
			$pasien = $this->m_pasien->_get_pasien( $this->session->userdata("current_pasien_username") );
			$downline = $this->mlm_model->build_network($pasien[0]->pasien_id, $pasien[0]->pasien_perdana);
			$affiliate_tree = $this->mlm_model->render_affiliate_tree( $downline );
    		
    		echo '	<ul id="network">
                						    <li><a href="#" > <img src="'.site_url("assets/root.png").'">
                						        <ul>
                						        '.$affiliate_tree.'
                						        </ul>
                						        </a>
                						    </li>
                						</ul>';

		}
		else
		{
			redirect("pasien/login");
		}
	}


	###############################################################################################################
	###############################################################################################################
	# 
	# BELUM DISELESAIKAN
	#
	###############################################################################################################
	###############################################################################################################
	public function clients(){

		if( $this->auth->_is_pasien_logged_in() ){

    		$you 	= $this->m_pasien->_get_pasien( $this->session->userdata("current_pasien_username") );
    		$data['pasiens'] = $this->mlm_model->get_network_pasiens( $you[0]->pasien_id );
			$downline = $this->mlm_model->build_network($you[0]->pasien_id, $you[0]->pasien_perdana);
    		
    		$this->templaterender->add_script_sources( base_url("assets/back/uniform/jquery.uniform.min.js") );
    		$this->templaterender->add_script_sources( base_url("assets/back/data-tables/jquery.dataTables.js") );
    		$this->templaterender->add_script_sources( base_url("assets/back/data-tables/DT_bootstrap.js") );
    		$this->pageproperties->set_title("Clients Anda | SMS Bersama");
    		$this->pageproperties->set_description("Orang-orang dalam jaringan Anda");
    		$this->pageproperties->set_small_description("");
    		$this->templaterender->render( "pasien_clients", $data, $this->pageproperties,"Client Anda",null); 

		}
		else{
			redirect("pasien/login");
		}

	}

	public function bonus(){
		if( $this->auth->_is_pasien_logged_in() ){

			$pasien_information = $this->m_pasien->_get_pasien( $this->session->userdata("current_pasien_username") , "wallet_id" );
			$bonus = $this->m_pasien->_current_bonus( $pasien_information[0]->wallet_id);

			$data["bonus"] = $bonus;

    		$this->pageproperties->set_title("Withdraw | SMSBersama.com");
    		$this->pageproperties->set_description("Orang-orang dalam jaringan Anda");
    		$this->pageproperties->set_small_description("");
    		$this->templaterender->render( "withdraw_bonus", $data, $this->pageproperties,"Withdraw Bonus",null); 

		}
		else{
			redirect("pasien/login");
		}
	}

	public function history(){
		if( $this->auth->_is_pasien_logged_in() ){

			$data['transactions'] = $this->m_pasien->get_transaction( $this->session->userdata("current_pasien_username") );

			$this->templaterender->add_script_sources( base_url("assets/back/uniform/jquery.uniform.min.js") );
    		$this->templaterender->add_script_sources( base_url("assets/back/data-tables/jquery.dataTables.js") );
    		$this->templaterender->add_script_sources( base_url("assets/back/data-tables/DT_bootstrap.js") );
			$this->pageproperties->set_title("history Transaksi | SMSBersama.com");
    		$this->pageproperties->set_description("Daftar Transaksi");
    		$this->pageproperties->set_small_description("");
    		$this->templaterender->render( "pasien_transaction_history", $data, $this->pageproperties,"History Transaksi",null); 
    		

		}
		else{
			redirect("pasien/login");
		}	
	}

	public function process_withdraw(){
		if( $this->auth->_is_pasien_logged_in() ){

			$m 	=	$this->m_pasien->_get_pasien( $this->session->userdata("current_pasien_username") , "pasien_id" );

			$this->form_validation->set_rules("jumlah","jumlah", "required|xss|numeric|trim");
			$this->form_validation->set_rules("bonus_type","bonus_type", "required|xss|trim");
			
			if( $this->form_validation->run() == FALSE ){
				echo json_encode( array("status"=>"failed","message"=>"Jumlah transaksi harus berupa angka!") );
			}
			else{
				$data["transaction_amount"] 	= 	$this->input->post("jumlah");
				$data["transaction_type"]		=	$this->input->post("bonus_type"); 
				$data["pasien_id"]				=	$m[0]->pasien_id;
				$data["pasien_trigger"]			=	NULL;
				$data["transaction_time"]		=	date("Y-m-d H:i:s");
				$data["transaction_status"]		=	0;

				$code = random_string("numeric",5);


				while ( $this->mlm_model->is_refcode_useable( $code ) == FALSE ) {
					$code = random_string("numeric",5);
				}

				$data["transaction_ref_code"]	=	$code;

				$json_return = array();
				$is_allowed = false;
				$current_bonus = $this->m_pasien->_current_bonus( $m[0]->pasien_id );

				if( $data['transaction_type'] == 5 ){
					if( intval( $current_bonus->deposit ) >= 50000 ){
						$is_allowed = true;
					}
				}
				elseif ( $data['transaction_type'] == 6 ) {
					if( intval( $current_bonus->bonus ) >= 100000  ){

						$is_allowed = true;
					}
				}

				if( $is_allowed ){
					if( $this->mlm_model->request_withdraw( $data ) ){
						$json_return = array("status"=>"success","message"=>"Permintaan withdraw sedang diproses. Kode transaksi : ".$code);
					}else{
						$json_return = array("status"=>"failed","message"=>"Terjadi kesalahan sistem, silahkan coba beberapa saat lagi");
					}
				}
				else{
					$json_return = array("status"=>"failed","message"=>"Tidak dapat melakukan withdraw".$is_allowed);
				}

				echo json_encode( $json_return );
			}


		}
		else{
			redirect("pasien/login");
		}
	}

	public function deposit(){
		if( $this->auth->_is_pasien_logged_in() ){

    		$this->pageproperties->set_title("Deposit | SMSBersama.com");
    		$this->pageproperties->set_description("Deposit Pulsa");
    		$this->pageproperties->set_small_description("");
    		$this->templaterender->render( "deposit", array(), $this->pageproperties,"Deposit",null); 

		}
		else{
			redirect("pasien/login");
		}
	}

	public function process_deposit(){
		if( $this->auth->_is_pasien_logged_in() ){

			$m 	=	$this->m_pasien->_get_pasien( $this->session->userdata("current_pasien_username") , "pasien_id" );

			$this->form_validation->set_rules("nominal","nominal", "required|xss|numeric|trim");
			$this->form_validation->set_rules("transaction_type","transaction_type", "xss|trim");
			
			if( $this->form_validation->run() == FALSE ){
				echo json_encode( array("status"=>"failed","message"=>"Nominal harus berupa angka!") );
			}
			else{
				$data["transaction_amount"] 	= 	$this->input->post("nominal");
				$data["transaction_type"]		=	( intval( $this->input->post("transaction_type") ) == 4 ) ? intval( $this->input->post("transaction_type") ) : 3; 
				$data["pasien_id"]				=	$m[0]->pasien_id;
				$data["pasien_trigger"]			=	NULL;
				$data["transaction_time"]		=	date("Y-m-d H:i:s");
				$data["transaction_status"]		=	0;

				$code = random_string("numeric",5);


				while ( $this->mlm_model->is_refcode_useable( $code ) == FALSE ) {
					$code = random_string("numeric",5);
				}

				$data["transaction_ref_code"]	=	$code;

				$json_return = array();
				$is_allowed = false;

				if( $data["transaction_type"] == 4 ){

					$current_bonus = $this->m_pasien->_current_bonus( $m[0]->pasien_id );

					if( intval( $current_bonus->deposit ) >= 50000 ){
							$is_allowed = true;
					}
				}
				else{

					if( $data['transaction_amount'] > 50000 ){
						$is_allowed = true;
					}

				}

				if( $is_allowed ){
					if( $this->mlm_model->request_withdraw( $data ) ){
						$json_return = array("status"=>"success","message"=>"Permintaan deposit sedang diproses. Kode transaksi : ".$code);
					}else{
						$json_return = array("status"=>"failed","message"=>"Terjadi kesalahan sistem, silahkan coba beberapa saat lagi");
					}
				}
				else{
					$json_return = array("status"=>"failed","message"=>"Tidak dapat melakukan permintaan deposit".$data['transaction_type']);
				}

				echo json_encode( $json_return );
			}


		}
		else{
			redirect("pasien/login");
		}
	}

	###################################################################################################################
	# 
	#	EA
	#
	###################################################################################################################

		// panduan di edit oleh angga --------------------------------------------->

		public function panduan (){
			if( $this->auth->_is_pasien_logged_in() )
			{
				$panduan = $this->m_pasien->_get_panduan();

				if( count( $panduan ) == 0  )
				{
					$panduan[0] 	=	new StdClass;
					$panduan[0]->isi_panduan = "Kosong";
				}

				$return_data = array( 
					'notification' 		=> $this->session->flashdata("pasien_update_notification"),
					'panduan'			=> $panduan[0]
				 );


    			$this->pageproperties->set_title("Dashboard | SMSBersama.com");
    			$this->pageproperties->set_description("Panduan pasien");
    			$this->pageproperties->set_small_description("Panduan Singkat menjadi pasien CRM RS");

    			$this->templaterender->render( "panduan_view", $return_data, $this->pageproperties,"panduan",null); 

			}
			else
			{
				redirect("pasien/login");
			}

		}







}