<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class kunjungan_poli extends MY_Controller
{
	private $breadcrumb;
	public function __construct(){
		parent::__construct();
		$this->load->library( array( "template" , "auth" , "menu" , "grocery_CRUD","breadcrumb" ) );
		$this->load->model( array("m_layanan") );
		$this->breadcrumb = new Breadcrumb();
		$this->breadcrumb->add( array("link"=>'#',"label"=>"Layanan") );
		$this->breadcrumb->add( array("link"=>site_url("admin/kunjungan_poli"),"label"=>"Kunjungan Poli") );


		     /* to grant access to the controller. */
        $this->controller = "kunjungan_poli";
        $this->grant_access( $this->controller , $this->session->userdata("current_admin_role") );

	}

	public function index(){

		if( $this->auth->_is_admin_logged_in() ){
			$output = new stdClass();
			$data['polikliniks']		=	$this->m_layanan->getAll("Poliklinik");
			$output->output 		= $this->load->view("kunjungan/kunjungan_poli_reg_list",$data,TRUE);
			$output->breadcrumb 	= $this->breadcrumb->render();
			$this->output( $output,TRUE );		
		}
		else{
			redirect("admin/login");
		}

	}

	public function lists(){
		if( $this->auth->_is_admin_logged_in() ){
			$d1 = $this->input->post("date1",TRUE);
			$d2 = $this->input->post("date2",TRUE);
			$poli = $this->input->post("poli",TRUE);

			$this->m_layanan->get_kunjungan_beta($d1,$d2,$poli);	
		}
		else{
			redirect("admin/login");
		}
	}

	public function getnourut(){

		$id_poli = $this->input->post("id_poli",TRUE);
		$data['no_urut'] = $this->m_layanan->generateNoUrut( date("Y-m-d"),$id_poli );
		echo json_encode( $data );
	}

	public function registrasi(){
		if( $this->auth->_is_admin_logged_in() ){
			$output = new stdClass();

			$data['pasiens']			=	$this->m_layanan->getAll("pasien");
			$data['polikliniks']		=	$this->m_layanan->getAll("Poliklinik");

			$template = '<div class="alert #type#>
								<button class="close" data-dismiss="alert"></button>
								'.$this->session->flashdata("notification").'
							</div>';

			$data['notification'] = ( strlen( $this->session->flashdata('notification') ) > 0 ? $template : "" );


			$code = random_string("numeric",5);

			/*while ( $this->m_layanan->is_confcode_useable( $code ) == FALSE ) {
					$code = random_string("numeric",5);
			}	*/

			$data['kode_konfirmasi']	=	$code;


			//mengambil output
			$output->output 		= $this->load->view("kunjungan/kunjungan_add",$data,TRUE);

			$this->breadcrumb->add( array("link"=>site_url("admin/kunjungan_poli/registrasi"),"label"=>"Registrasi") );
			$output->breadcrumb = $this->breadcrumb->render();
			$this->output( $output,TRUE );		
		}
		else{
			redirect("admin/login");
		}		
	}


	public function proses_registrasi(){
		if( $this->auth->_is_admin_logged_in() ){
			
			$this->load->library("form_validation");

			$form_rules = array(
									array(
										'field' => 	'nomor_urut',
										'label' =>	'nomor_urut',
										'rules'	=>	'xss_clean'
									),
									array(
										'field' => 	'pasien',
										'label' =>	'pasien',
										'rules'	=>	'required|xss_clean'
									),
									array(
										'field' => 	'poliklinik',
										'label' =>	'poliklinik',
										'rules'	=>	'required|xss_clean'
									),
									array(
										'field' => 	'tanggal_kunjungan',
										'label' =>	'tanggal_kunjungan',
										'rules'	=>	'required|xss_clean'
									),
									array(
										'field' => 	'kode_konfirmasi',
										'label' =>	'kode_konfirmasi',
										'rules'	=>	'xss_clean'
									),
								);

			$this->form_validation->set_rules( $form_rules );

			if( $this->form_validation->run() != FALSE ){

				$kunjungan_poli['id_pasien'] 			=	$this->input->post("pasien",TRUE);
				$kunjungan_poli['id_poli'] 				=	$this->input->post("poliklinik",TRUE);
				$kunjungan_poli['no_urut'] 				=	$this->m_layanan->generateNoUrut( date("Y-m-d") , $kunjungan_poli['id_poli'] );
				$kunjungan_poli['tanggal_kunjungan'] 	=	$this->input->post("tanggal_kunjungan",TRUE);
				$kunjungan_poli['confirmation'] 		=	$this->input->post("kode_konfirmasi",TRUE);
				$kunjungan_poli['isConfirmed'] 			=	1;
				$data['read']							=	"true";
				$data['notified']						=	"true";

				$kunjgn = array("id_pasien"=>$kunjungan_poli['id_pasien'],
															 "id_poli"  => $kunjungan_poli['id_poli'],
															 "tanggal_kunjungan" => $kunjungan_poli['tanggal_kunjungan']
														);


				if( $this->m_layanan->getOne("kunjungan_poli",$kunjgn)  ){
					$this->session->set_flashdata("notification","Pasien telah mendaftar hari ini");
				}else{
					if( $this->m_layanan->insert( "kunjungan_poli", $kunjungan_poli ) ) {
						$this->session->set_flashdata("notification","Berhasil disimpan, ".anchor(site_url("admin/kunjungan_poli/registrasi"), "Daftar lagi?", "title='Registrasi ulang'"));
					}		
					else{
						$this->session->set_flashdata("notification","Data gagal disimpan");
					}
				}

			}
			else
			{
				$this->session->set_flashdata("notification",validation_errors());
			}
			
			redirect("admin/kunjungan_poli/registrasi");
		}
		else{
			redirect("admin/login");
		}
		
	}

	function delete($id)
	{
		if( $this->auth->_is_admin_logged_in() )
		{	
			$data = array();

			if( $this->m_layanan->delete("kunjungan_poli", array("id_kunjungan" => $id ) )){

				$data['msg']	=	"Data telah dihapus";

				echo json_encode( $data );
			}
			else{
				$data['msg']	=	"Data tidak dapat dihapus :(";

				echo json_encode( $data );
			}
		}
		else
		{
			$data['msg'] = "Anda tidak boleh melakukan akses ini!";

			echo json_encode( $data );
		}
	}

	function edit($id){
		
		if( $this->auth->_is_admin_logged_in() ){
			
			$output = new stdClass();

			$kunjungan_poli				=	$this->m_layanan->getOne( "kunjungan_poli", array("id_kunjungan"=> $id)  );

			$data['pasiens']			=	$this->m_layanan->getAll("pasien");
			$data['polikliniks']		=	$this->m_layanan->getAll("Poliklinik");
			$data['id_pasien']			=	$kunjungan_poli[0]->id_pasien;
			$data['id_poli']			=	$kunjungan_poli[0]->id_poli;
			$data['nomor_urut']			=	$kunjungan_poli[0]->no_urut;
			$data["tanggal_kunjungan"]	=	$kunjungan_poli[0]->tanggal_kunjungan;
			$data['id_kunjungan']		=	$kunjungan_poli[0]->id_kunjungan;

			$template = '<div class="alert #type#>
								<button class="close" data-dismiss="alert"></button>
								'.$this->session->flashdata("notification").'
							</div>';

			$data['notification'] = ( strlen( $this->session->flashdata('notification') ) > 0 ? $template : "" );

			$data['kode_konfirmasi']	=	$kunjungan_poli[0]->confirmation;


			//mengambil output
			$output->output 		= $this->load->view("kunjungan/kunjungan_edit",$data,TRUE);

			$this->breadcrumb->add( array("link"=>site_url("admin/kunjungan_poli/registrasi"),"label"=>"Registrasi") );
			$output->breadcrumb = $this->breadcrumb->render();
			$this->output( $output,TRUE );		
		}
		else{
			redirect("admin/login");
		}		
	}

	public function proses_edit(){
		
		if( $this->auth->_is_admin_logged_in() ){
			
			$this->load->library("form_validation");

			$form_rules = array(
									array(
										'field' => 	'nomor_urut',
										'label' =>	'nomor_urut',
										'rules'	=>	'xss_clean'
									),
									array(
										'field' => 	'pasien',
										'label' =>	'pasien',
										'rules'	=>	'required|xss_clean'
									),
									array(
										'field' => 	'poliklinik',
										'label' =>	'poliklinik',
										'rules'	=>	'required|xss_clean'
									),
									array(
										'field' => 	'tanggal_kunjungan',
										'label' =>	'tanggal_kunjungan',
										'rules'	=>	'required|xss_clean'
									),
									array(
										'field' => 	'kode_konfirmasi',
										'label' =>	'kode_konfirmasi',
										'rules'	=>	'xss_clean'
									),
								);

			$this->form_validation->set_rules( $form_rules );

			if( $this->form_validation->run() != FALSE ){

				$kunjungan_poli['id_pasien'] 			=	$this->input->post("pasien",TRUE);
				$kunjungan_poli['id_poli'] 				=	$this->input->post("poliklinik",TRUE);
				$kunjungan_poli['no_urut'] 				=	$this->m_layanan->generateNoUrut( date("Y-m-d") , $kunjungan_poli['id_poli'] );
				$kunjungan_poli['tanggal_kunjungan'] 	=	$this->input->post("tanggal_kunjungan",TRUE);
				$kunjungan_poli['confirmation'] 		=	$this->input->post("kode_konfirmasi",TRUE);
				$kunjungan_poli['isConfirmed'] 			=	1;

				if( $this->m_layanan->insert( "kunjungan_poli", $kunjungan_poli ) ) {
					$this->session->set_flashdata("notification","Berhasil disimpan, ".anchor(site_url("admin/kunjungan_poli/registrasi"), "Daftar lagi?", "title='Registrasi ulang'"));
				}		
				else{
					$this->session->set_flashdata("notification","Data gagal disimpan");
				}

			}
			else
			{
				$this->session->set_flashdata("notification",validation_errors());
			}
			
			redirect("admin/kunjungan_poli/registrasi");
		}
		else{
			redirect("admin/login");
		}		
	}


	public function konfirmasi(){
		if( $this->auth->_is_admin_logged_in() )
		{

			$data["isConfirmed"] = 1;
			$id_kunjungan = $this->input->post("id",TRUE);

			if( $this->m_layanan->update("kunjungan_poli",$data,"id_kunjungan",$id_kunjungan) ){
				echo json_encode( array("status"=>"success","message"=>"Antrian telah dikonfimasi!") );
			}
			else{
				echo json_encode( array("status"=>"fail","message"=>"Antrian gagal dikonfimasi!") );
			}

		}
		else{
			echo json_encode( array("status"=>"fail","message"=>"session time out!") );
		}		
	}

	public function done(){
		if( $this->auth->_is_admin_logged_in() )
		{

			$data["isDone"] = 1;
			$id_kunjungan = $this->input->post("id",TRUE);

			if( $this->m_layanan->update("kunjungan_poli",$data,"id_kunjungan",$id_kunjungan) ){
				echo json_encode( array("status"=>"success","message"=>"Antrian selesai!") );
			}
			else{
				echo json_encode( array("status"=>"fail","message"=>"Gagal menandai selesai!") );
			}

		}
		else{
			echo json_encode( array("status"=>"fail","message"=>"session time out!") );
		}		
	}


	public function get_notification(){
		if( $this->auth->_is_admin_logged_in() )
		{

		}
		else{
			
		}
	}

	public function set_notified(){
		if( $this->auth->_is_admin_logged_in() )
		{

		}
		else{
			
		}		
	}


	private function output($output,$isPlain=false){
		if( $this->auth->_is_admin_logged_in() )
		{
			$output->title = "Data Poli klinik | Admin";
			$output->page_title='Data Kunjungan Poliklinik';
			$output->description='Kelola Data Kunjungan Poliklinik';
			$output->menus = $this->menu->get_menus( 'Kunjungan Poli'  );
			$this->template->display("content",$output,$isPlain);
		}
		else{
			redirect( site_url("admin/login") );
		}
	}
}