<?php

class jadwal_dokter extends MY_Controller{

	public function __construct(){
		parent::__construct();

		$this->load->library( array( "template" , "auth" , "menu" , "grocery_CRUD","Breadcrumb" ) );
		$this->load->model( array("m_layanan") );
		$this->breadcrumb = new Breadcrumb();
		$this->breadcrumb->add( array("link"=>'#',"label"=>"Layanan") );
		$this->breadcrumb->add( array("link"=>site_url("admin/jadwal_dokter"),"label"=>"Jadwal Dokter") );

		     /* to grant access to the controller. */
        $this->controller = "jadwal_dokter";
        $this->grant_access( $this->controller , $this->session->userdata("current_admin_role") );
	}

	public function index(){
		if( $this->auth->_is_admin_logged_in() ){
			$output = new stdClass();
			//$data['polikliniks']		=	$this->m_layanan->getAll("Poliklinik");
			$output->output 		= $this->load->view("jadwal_dokter/jadwal_list",null,TRUE);
			$output->breadcrumb 	= $this->breadcrumb->render();
			$this->output( $output,TRUE );		
		}
		else{
			redirect("admin/login");
		}
	}

	public function edit($id){
		if( $this->auth->_is_admin_logged_in() ){
			$output = new stdClass();
			$data['id_dokter']		=	$id;
			$data['list_hari']		=	$this->m_layanan->getAll("waktu_jadwal");
			$output->output 		= $this->load->view("jadwal_dokter/jadwal_edit",$data,TRUE);
			$this->breadcrumb->add( array("link"=>site_url("admin/jadwal_dokter/edit/$id"),"label"=>"Edit Jadwal") );
			$output->breadcrumb 	= $this->breadcrumb->render();
			$this->output( $output,TRUE );		
		}
		else{
			redirect("admin/login");
		}
	}

	public function simpan(){

		if( $this->auth->_is_admin_logged_in() ){

			$this->load->library("form_validation");

			$form_rules = array(
									array(
										'field' => 	'hari',
										'label' =>	'hari',
										'rules'	=>	'required|xss_clean'
									),
									array(
										'field' => 	'jam_mulai',
										'label' =>	'jam_mulai',
										'rules'	=>	'required|xss_clean'
									),
									array(
										'field' => 	'jam_akhir',
										'label' =>	'jam_mulai',
										'rules'	=>	'required|xss_clean'
									),
									array(
										'field' => 	'id_dokter',
										'label' =>	'id_dokter',
										'rules'	=>	'required|xss_clean'
									),


								);

			$this->form_validation->set_rules( $form_rules );

			$json_data = array();

			if( $this->form_validation->run() != FALSE ){

				$data = array();

				$jadwal['id_waktu'] 		=	$this->input->post("hari",TRUE);
				$jadwal['waktu_mulai'] 		=	$this->input->post("jam_mulai",TRUE);
				$jadwal['waktu_akhir']		=	$this->input->post("jam_akhir",TRUE);
				$jadwal['id_dokter']		=	$this->input->post("id_dokter",TRUE);


				if( $this->m_layanan->insert( "jadwal_dokter", $jadwal ) ) {
					$json_data["status"]	=	"success";
					$json_data["message"]	=	"Data jadwal telah disimpan";
					
				}		
				else{
					$json_data["status"]	=	"fail";
					$json_data["message"]	=	"Gagal menyimpan data jadwal";
				}

			}
			else
			{
				$json_data["status"]	=	"fail";
				$json_data["message"]	=	validation_errors();
			}
			
			echo json_encode( $json_data );
		}
		else{
			redirect("admin/login");
		}
	}

	public function editnian(){
		
		if( $this->auth->_is_admin_logged_in() ){

			$this->load->library("form_validation");

			$form_rules = array(
									array(
										'field' => 	'hari_edit',
										'label' =>	'hari_edit',
										'rules'	=>	'required|xss_clean'
									),
									array(
										'field' => 	'jam_mulai',
										'label' =>	'jam_mulai',
										'rules'	=>	'required|xss_clean'
									),
									array(
										'field' => 	'jam_akhir',
										'label' =>	'jam_mulai',
										'rules'	=>	'required|xss_clean'
									),
									array(
										'field'	=>	'id_dokter_edit',
										'label'	=>	'id_dokter_edit',
										'rules'	=>	'required|xss_clean'

									),
									array(
										'field'	=>	'id_waktu_current',
										'label'	=>	'id_waktu_current',
										'rules'	=>	'required|xss_clean'

									)

								);

			$this->form_validation->set_rules( $form_rules );

			$json_data = array();

			if( $this->form_validation->run() != FALSE ){

				$data = array();

				$jadwal['id_waktu'] 		=	$this->input->post("hari_edit",TRUE);
				$jadwal['waktu_mulai'] 		=	$this->input->post("jam_mulai",TRUE);
				$jadwal['waktu_akhir']		=	$this->input->post("jam_akhir",TRUE);
				
				$id_dokter					=	$this->input->post("id_dokter_edit",TRUE);
				$id_waktu_current			=	$this->input->post("id_waktu_current",TRUE);

				if( $this->m_layanan->update_jadwal_nian( $jadwal, $id_waktu_current , $id_dokter ) ) {
					$json_data["status"]	=	"success";
					$json_data["message"]	=	"Data jadwal telah disimpan";
					
				}		
				else{
					$json_data["status"]	=	"fail";
					$json_data["message"]	=	"Gagal menyimpan data jadwal";
				}

			}
			else
			{
				$json_data["status"]	=	"fail";
				$json_data["message"]	=	validation_errors();
			}
			
			echo json_encode( $json_data );
		}
		else{
			redirect("admin/login");
		}
	}


	public function delete($id_dokter,$id_waktu){
		if( $this->auth->_is_admin_logged_in() )
		{	
			$data = array();

			if( $this->m_layanan->delete("jadwal_dokter", array("id_waktu" => $id_waktu,"id_dokter" => $id_dokter ) )){

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


	public function get_jadwal(){
		$id_dokter 	= 	$this->input->post("id_dokter",TRUE);
		$id_waktu 	=	$this->input->post("id_waktu",TRUE);
		$this->m_layanan->getJadwal($id_dokter,$id_waktu);
	}

	public function lists(){
		$this->m_layanan->getjadwaldokter();	
	}

	public function lists_dokter(){
		$id = $this->input->post("id_dokter");
		$this->m_layanan->getJadwalByDokter($id);
	}

	private function output($output,$isPlain=false){
		if( $this->auth->_is_admin_logged_in() )
		{
			$output->title = "Jadwal Dokter | Admin";
			$output->page_title='Jadwal Dokter';
			$output->description='Data jadwal dokter';
			$output->menus = $this->menu->get_menus( 'Jadwal Dokter'  );
			$this->template->display("content",$output,$isPlain);
		}
		else{
			redirect( site_url("admin/login") );
		}
	}
}