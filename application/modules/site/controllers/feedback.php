<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class feedback extends MY_Controller
{

	public function __construct(){
		parent::__construct();
		$this->load->model( array("site_model","m_layanan") );
		$this->load->library( array("breadcrumb") );

		$this->breadcrumb = new Breadcrumb();
		$this->breadcrumb->add( array("link"=>'#',"label"=>"Services") );
		$this->breadcrumb->add( array("link"=>site_url("site/feedback"),"label"=>"Kritik & Saran") );
	}


	public function index(){

		$content_view = $this->load->view("feedback",null ,TRUE);

		$data = array( "title" => "Kritik & Saran | Rumah Sakit dr. AK Gani Palembang",
						"content" => $content_view,
						"breadcrumb" => $this->breadcrumb->render(),
					 );

		$this->_output( $data );

	}

	public function submit(){


		$this->load->library("form_validation");


		$form_rules = array(

									array(
										'field' => 	'email',
										'label' =>	'email',
										'rules'	=>	'trim|required|valid_email|xss_clean'
									),
									array(
										'field' => 	'subject',
										'label' =>	'subject',
										'rules'	=>	'xss_clean'
									),
									array(
										'field'	=>	'message',
										'label'	=>	'message',
										'rules'	=>	'required|xss_clean'
									),	
									array(
										'field'	=>	'type',
										'label'	=>	'type',
										'rules'	=>	'required|xss_clean'
									),

			);

		$this->form_validation->set_rules( $form_rules );

		if( $this->form_validation->run() != FALSE ){

			$data['email']		=	$this->input->post("email",TRUE);
			$data['perihal']	=	$this->input->post("subject",TRUE);
			$data['isi']		=	$this->input->post("message",TRUE);
			$data['type']		=	$this->input->post("type",TRUE);
			$data['via']		=	"web";
			$data['time']		=	date("Y-m-d");


			if( $this->m_layanan->insert( "kritik_saran",$data ) ) {
				$json_data["status"]	=	"success";
				$json_data["message"]	=	'								<div class="alert alert-success">
									<button class="close" data-dismiss="alert"></button>
									<strong>Terima kasih atas kritik/sarannya!</strong> .
								</div>';
					
			}		
			else{
				$json_data["status"]	=	"fail";
				$json_data["message"]	=	'								<div class="alert alert-error">
									<button class="close" data-dismiss="alert"></button>
									<strong>Gagal menyimpan data jadwal.!</strong> 
								</div>';
			}

		}
		else
		{
			$json_data["status"]	=	"fail";
			$json_data["message"]	=	validation_errors();
		}
			
		echo json_encode( $json_data );

	}

	private function _output( $output_data )
	{	$output_data['menus']		=	$this->_build_menu();
		//$output_data['categories']	=	$this->site_model->get_all_category();
		$this->load->view("template",$output_data);
	}

	private function _build_menu(){

		$menus = array();

		$roots = $this->site_model->get_root_menu();
		$i = 0;
		foreach ($roots as $key => $root) {
			$menus[$i]["menu_name"] = $root->menu_title;
			$menus[$i]["menu_link"] = $root->menu_content;
			
			if( $root->child_count > 0 ){
				$menus[$i]["child"] = $this->site_model->get_child_menu( $root->menu_id );
				
			}
			$i++;
		}

		return $menus;

	}

}
