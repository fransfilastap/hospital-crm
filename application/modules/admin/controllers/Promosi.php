<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Promosi extends MY_Controller{

	private $breadcrumb;

	public function __construct(){
		parent::__construct();
		$this->load->library( array( "template" , "auth" , "menu" , "grocery_CRUD","Breadcrumb" ) );
		$this->load->helper("post_date");
		$this->load->model( array("m_layanan") );
		$this->breadcrumb = new Breadcrumb();
		$this->breadcrumb->add( array("link"=>'#',"label"=>"Layanan") );
		$this->breadcrumb->add( array("link"=>site_url("admin/promosi"),"label"=>"Promosi") );

		     /* to grant access to the controller. */
        $this->controller = "Promosi";
        $this->grant_access( $this->controller , $this->session->userdata("current_admin_role") );
	}

	public function index(){

		if( $this->auth->_is_admin_logged_in() ){
			$output = new stdClass();
			$data['promos'] = $this->m_layanan->get_promo_list();
			$output->output = $this->load->view("promosi/promosi_main",$data,TRUE);
			$output->breadcrumb = $this->breadcrumb->render();
			$this->output( $output,TRUE );		
		}
		else{
			redirect("admin/login");
		}

	}

	public function add(){

		if( $this->auth->_is_admin_logged_in() ){

			$template = '<div class="alert #type#>
								<button class="close" data-dismiss="alert"></button>
								'.$this->session->flashdata("notification").'
							</div>';


			$output = new stdClass();
			$data['notification'] = ( strlen( $this->session->flashdata('notification') ) > 0 ? $template : "" );
			$output->output = $this->load->view("promosi/promosi_add",$data,TRUE);
			//put breadcrumb
			$this->breadcrumb->add( array("link"=>site_url("admin/promosi/add"),"label"=>"Add") );
			$output->breadcrumb = $this->breadcrumb->render();
			$this->output( $output,TRUE );	
			
		}
		else{
			redirect("admin/login");
		}

	}

	public function process_add(){

		if( $this->auth->_is_admin_logged_in() ){

			$this->load->library("form_validation");

			$form_rules = array(
									array(
										'field' => 	'judul_promosi',
										'label' =>	'judul_promosi',
										'rules'	=>	'required|xss_clean'
									),
									array(
										'field' => 	'isi_promosi',
										'label' =>	'Isi Promosi',
										'rules'	=>	'required|xss_clean'
									),
									array(
										'field' => 	'web_promosi',
										'label' =>	'web_Promosi',
										'rules'	=>	'required|xss_clean'
									),

								);

			$this->form_validation->set_rules( $form_rules );

			if( $this->form_validation->run() != FALSE ){

				$data = array();

				$promosi['judul_promosi'] 	=	$this->input->post("judul_promosi",TRUE);
				$promosi['sms_promosi'] 	=	$this->input->post("isi_promosi",TRUE);
				$promosi['web_promosi'] 	=	$this->input->post("web_promosi",TRUE);
				$promosi['tgl_promosi']		=	date("Y-m-d");

				if( $this->m_layanan->insert( "promosi", $promosi ) ) {
					$this->session->set_flashdata("notification","promosi berhasil disimpan, ".anchor("#", "sebar promosi sekarang?", "title='Sebar promosi'"));
				}		
				else{
					$this->session->set_flashdata("notification","Data promosi gagal disimpan");
				}

			}
			else
			{
				$this->session->set_flashdata("notification",validation_errors());
			}
			
			redirect("admin/promosi/add");
		}
		else{
			redirect("admin/login");
		}

	}


	public function edit($id){

		if( $this->auth->_is_admin_logged_in() ){

			$template 				=	'<div class="alert #type#>
										<button class="close" data-dismiss="alert"></button>
										'.$this->session->flashdata("notification").'
										</div>';

			$output 				= 	new stdClass();
			$data['promosi']		=	$this->m_layanan->getOne('promosi',array('id_promosi' => intval( $id )));
			$data['id']				=	intval($id);
			$data['notification'] 	= 	( strlen( $this->session->flashdata('notification') ) > 0 ? $template : "" );
			$output->output 		= 	$this->load->view("promosi/promosi_edit",$data,TRUE);
			
			//put breadcrumb
			$this->breadcrumb->add( array("link"=>site_url("admin/promosi/edit/".$id),"label"=>"Edit") );


			$output->breadcrumb 	= $this->breadcrumb->render();
			

			$this->output( $output,TRUE );	
			
		}
		else{
			redirect("admin/login");
		}

	}	

	public function process_edit(){

		if( $this->auth->_is_admin_logged_in() ){

			$this->load->library("form_validation");

			$form_rules = array(
									array(
										'field' => 	'judul_promosi',
										'label' =>	'judul_promosi',
										'rules'	=>	'required|xss_clean'
									),
									array(
										'field' => 	'id_promosi',
										'label' =>	'id_promosi',
										'rules'	=>	'required|xss_clean'
									),
									array(
										'field' => 	'isi_promosi',
										'label' =>	'Isi Promosi',
										'rules'	=>	'required|xss_clean'
									),
									array(
										'field' => 	'web_promosi',
										'label' =>	'web_Promosi',
										'rules'	=>	'required|xss_clean'
									),


								);

			$this->form_validation->set_rules( $form_rules );

			if( $this->form_validation->run() != FALSE ){

				$data = array();

				$promosi['judul_promosi'] 	=	$this->input->post("judul_promosi",TRUE);
				$promosi['sms_promosi'] 	=	$this->input->post("isi_promosi",TRUE);
				$promosi['web_promosi']		=	$this->input->post("web_promosi",TRUE);
				$id 						=	$this->input->post("id_promosi",TRUE);

				if( $this->m_layanan->update( "promosi", $promosi,"id_promosi",$id ) ) {
					$this->session->set_flashdata("notification","promosi berhasil disimpan, ".anchor("#", "sebar promosi sekarang?", "title='Sebar promosi'"));
				}		
				else{
					$this->session->set_flashdata("notification","Data promosi gagal disimpan");
				}

			}
			else
			{
				$this->session->set_flashdata("notification",validation_errors());
			}
			
			redirect("admin/promosi/add");
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

			if( $this->m_layanan->delete("promosi", array("id_promosi" => $id ) )){

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

	function publish_preview($id)
	{
		if( $this->auth->_is_admin_logged_in() )
		{	
			$output = new stdClass();
			
			$data['promosi'] 		= $this->m_layanan->getOne( 'promosi', array('id_promosi'=> $id)  );
			$data['polikliniks']	= $this->m_layanan->getAll('poliklinik');
			
			$output->output = $this->load->view("promosi/send_promosi",$data,TRUE);
			
			$this->breadcrumb->add( array("link"=>site_url("admin/promosi/publish_preview/".$id),"label"=>"Pratinjau Publikasi") );
			$output->breadcrumb = $this->breadcrumb->render();
			
			$this->output( $output,TRUE );	
		}
		else
		{
			redirect("admin/login");
		}
	}	

	function publish(){
		
		if( $this->auth->_is_admin_logged_in() )
		{	
			$this->load->library("form_validation");

			$form_rules = array(
									
									array(
										'field' => 'pake_poli',
										'label' => 'pake_poli',
										'rules' => 'xss_clean'
									),
									

									array(
										'field' => 'pake_umur',
										'label' => 'pake_umur',
										'rules' => 'xss_clean'
									),


									array(
										'field' => 	'poliklinik',
										'label' =>	'poliklinik',
										'rules'	=>	'xss_clean'
									),
									array(
										'field' => 	'id_promosi',
										'label' =>	'id_promosi',
										'rules'	=>	'required|xss_clean'
									),
									array(
										'field' => 	'gender',
										'label' =>	'gender',
										'rules'	=>	'xss_clean'
									),

									array(
										'field' => 	'kategori_umur',
										'label' =>	'kategori_umur',
										'rules'	=>	'xss_clean'
									),

									array(
										'field' => 	'umur_1',
										'label' =>	'umur_1',
										'rules'	=>	'numeric|xss_clean'
									),	

									array(
										'field' => 	'umur_2',
										'label' =>	'umur_2',
										'rules'	=>	'numeric|xss_clean'
									),	


								);

			$this->form_validation->set_rules( $form_rules );

			if( $this->form_validation->run() != FALSE ){

				$pake_umur				=	$this->input->post("pake_umur",TRUE);
				$pake_poli				=	$this->input->post("pake_poli",TRUE);

				$data['poli'] 			= 	$this->input->post("poliklinik",TRUE);
				$data['jenis_kelamin']	=	$this->input->post("gender",TRUE);
				$data['kategori_umur']	=	$this->input->post("kategori_umur",TRUE);
				$data['umur_1']	 		=	$this->input->post("umur_1",TRUE);
				$data['umur_2'] 		=	$this->input->post("umur_2",TRUE);
				$data['id_promosi']		=	$this->input->post("id_promosi",TRUE);
				
				if( $pake_poli != FALSE && $pake_umur != FALSE ){
					
					if( $data['jenis_kelamin'] == "A" )
					{
						echo "6";
						$this->m_layanan->insert_target_promosi($data, 6 );
					}	
					else{
						echo "2";
						$this->m_layanan->insert_target_promosi($data, 2 );
					}
						

				}
				else if( $pake_poli == FALSE && $pake_umur != FALSE ){
					
					if( $data['jenis_kelamin'] == 'A' )
					{
						echo "3";
						$this->m_layanan->insert_target_promosi($data, 3 );
					}	
					else{
						echo "8";
						$this->m_layanan->insert_target_promosi($data, 8 );
					}
						

				}
				else if( $pake_poli != FALSE && $pake_umur == FALSE ){
					
					if( $data['jenis_kelamin'] == 'A' ){
						echo "5";
						$this->m_layanan->insert_target_promosi($data, 5 );
					}
					else{
						echo "7";
						$this->m_layanan->insert_target_promosi($data, 7 );
					}
						

				}
				else if( $pake_poli == FALSE && $pake_umur == FALSE ){
					
					if( $data['jenis_kelamin'] == "A" ){
						echo "1";
						$this->m_layanan->insert_target_promosi($data, 1 );
					}	
					else{
						echo "4";
						$this->m_layanan->insert_target_promosi($data, 4 );
					}
						

				}
				else{
					echo "1 ke 2";
					$this->m_layanan->insert_target_promosi($data, 1 );
				}


			}else{
				echo validation_errors();
			}
		}
		else
		{
			redirect("admin/login");
		}
	}

	private function output($output,$isPlain=false){
		if( $this->auth->_is_admin_logged_in() )
		{
			$output->title = "Data Promosi | Admin";
			$output->page_title='Data Promosi';
			$output->description='Promosi';
			$output->menus = $this->menu->get_menus( 'Promosi'  );
			$this->template->display("content",$output,$isPlain);
		}
		else{
			redirect( site_url("admin/login") );
		}
	}
}