<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class ekonsultasi extends MY_Controller{

	function __construct(){
		parent::__construct();
		$this->load->library( array( "template" , "auth" , "menu" , "grocery_CRUD","Breadcrumb" ) );
		$this->load->model( array("m_layanan") );
		$this->breadcrumb = new Breadcrumb();
		$this->breadcrumb->add( array("link"=>'#',"label"=>"Layanan") );
		$this->breadcrumb->add( array("link"=>site_url("admin/ekonsultasi"),"label"=>"e-Konsultasi") );


		$this->controller = "ekonsultasi";
		$this->grant_access();

	}

	function index(){


		if( $this->auth->_is_admin_logged_in() ){
			$output = new stdClass();
			$output->output = $this->load->view("ekonsultasi/lists",null,TRUE);
			$output->breadcrumb = $this->breadcrumb->render();
			$this->output( $output,TRUE );	

		}else{
			redirect( site_url("admin/login") );
		}

	}

	function reply_page($id){
		
		if( $this->auth->_is_admin_logged_in() ){
			$output = new stdClass();

			$this->set_read($id);

			$data['ekonsultasi'] = $this->m_layanan->getOne("konsultasi",array("id"=>$id));

			$output->output = $this->load->view("ekonsultasi/reply_page",$data,TRUE);
			$this->breadcrumb->add( array("link"=>site_url("admin/ekonsultasi/reply_page/".$id),"label"=>"Jawab") );
			$output->breadcrumb = $this->breadcrumb->render();
			$this->output( $output,TRUE );	

		}else{
			redirect( site_url("admin/login") );
		}		
	}

	function reply(){

		if( $this->auth->_is_admin_logged_in() ){

			$this->load->library("form_validation");
			
			$form_rules = array(
									array(
										'field' => 	'id',
										'label' =>	'id',
										'rules'	=>	'xss_clean'
									),
									array(
										'field' => 	'jawaban',
										'label' =>	'jawaban',
										'rules'	=>	'xss_clean'
									),	
							);	

			$this->form_validation->set_rules( $form_rules );

			if( $this->form_validation->run() != FALSE ){

				$id 					=	$this->input->post("id",TRUE);
				$data['jawaban'] 		=	$this->input->post("jawaban",TRUE);
				$data['id_dokter']		=	$this->session->userdata("current_dokter_id");
				$data['tampilkan']		=	1;
				$data['read']			=	"true";
				$data['Notification']	=	"hide";


				if( $this->m_layanan->update( "konsultasi",$data,"id",$id) ) {
					$json_data["status"]	=	"success";
					$json_data["message"]	=	'								<div class="alert alert-success">
									<button class="close" data-dismiss="alert"></button>
									<strong>Berhasil!</strong> jawaban telah ditambahkan.
								</div>';
					
				}		
				else{
					$json_data["status"]	=	"fail";
					$json_data["message"]	=	'								<div class="alert alert-error">
									<button class="close" data-dismiss="alert"></button>
									<strong>Error!</strong> Tidak dapat menambahkan jawaban.
								</div>';
				}

			}
			else
			{
				$json_data["status"]	=	"fail";
				$json_data["message"]	=	validation_errors();
			}
			
			echo json_encode( $json_data );

		}else{
			redirect( site_url("admin/login") );
		}

	}

	function lists(){
		
		if( $this->auth->_is_admin_logged_in() ){

			$this->m_layanan->getQuestions( $this->input->post("status",TRUE) );	

		}else{
			redirect( site_url("admin/login") );
		}
	}

	function get($id){

		if( $this->auth->_is_admin_logged_in() ){

			$data['ekonsultasi'] = $this->m_layanan->getOne( 'konsultasi', array('id'=> $id ) );
			$modal = $this->load->view("ekonsultasi/reply",$data,TRUE);
			echo $modal;

		}else{
			redirect( site_url("admin/login") );
		}
	}


	function set_visibility(){
		if( $this->auth->_is_admin_logged_in() ){
			
			$json_data = array();


			$data['tampilkan'] 	= $this->input->post("tmpl",TRUE);
			$id 				= $this->input->post("id",TRUE);

			echo $data['tampilkan'];

			if( $this->m_layanan->update( "konsultasi",$data,"id", $id)) {
				$json_data["status"]	=	"success";
				$json_data["message"]	=	'konsultasi ditampilkan';
					
			}		
			else{
				$json_data["status"]	=	"fail";
				$json_data["message"]	=	"Gagal menyimpan data jadwal";
			}

			echo json_encode( $json_data );

		}else{
			redirect( site_url("admin/login") );
		}
	}


	function delete( $id ){

		if( $this->auth->_is_admin_logged_in() ){

			if( $this->m_layanan->delete( 'konsultasi' , array('id'=>$id) ) ) {
				$json_data["status"]	=	"success";
				$json_data["message"]	=	'data berhasil dihapus';
					
			}		
			else{
				$json_data["status"]	=	"fail";
				$json_data["message"]	=	"Gagal menyimpan data jadwal";
			}

		}else{
			redirect("admin/login");
		}

	}


	public function get_push_notification(){
		
		if( $this->auth->_is_admin_logged_in() )
		{

			$data = $this->m_layanan->push_notification_konsultasi();

			echo json_encode( $data );

		}
		else{
			echo "Session time out!";
		}		
	}

	public function get_unread_question(){
		
		if( $this->auth->_is_admin_logged_in() )
		{

			$data = $this->m_layanan->unread_questions();

			echo json_encode( $data );

		}
		else{
			echo "Session time out!";
		}		
	}


	function set_read($id){
		if( $this->auth->_is_admin_logged_in() )
		{

			$this->m_layanan->update( "konsultasi",array("read"=>"true"),"id", $id);

		} 
		else{
			echo "Session time out!";
		}		
	}	

	function set_notified($id){
		if( $this->auth->_is_admin_logged_in() )
		{

			$this->m_layanan->update( "konsultasi",array("Notification"=>"notified"),"id", $id);

		} 
		else{
			echo "Session time out!";
		}		
	}

	function set_appended($id){
		if( $this->auth->_is_admin_logged_in() )
		{

			$this->m_layanan->update( "konsultasi",array("Notification"=>"bar"),"id", $id);

		} 
		else{
			echo "Session time out!";
		}		
	}

	private function output($output,$isPlain=false){
		if( $this->auth->_is_admin_logged_in() )
		{
			$output->title = "e-Konsultasi | Admin";
			$output->page_title='e-Konsultasi';
			$output->description='Daftar Pertanyaan Konsultasi Online';
			$output->menus = $this->menu->get_menus( 'e-Konsultasi'  );
			$this->template->display("content",$output,$isPlain);
		}
		else{
			redirect( site_url("admin/login") );
		}
	}
}