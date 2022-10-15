<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class ekonsultasi extends MY_Controller
{

	public function __construct(){
		parent::__construct();
		$this->load->model( array("site_model","m_layanan") );
		$this->load->library( array("breadcrumb","pagination") );

		$this->breadcrumb = new Breadcrumb();
		$this->breadcrumb->add( array("link"=>'#',"label"=>"Services") );
		$this->breadcrumb->add( array("link"=>site_url("site/ekonsultasi"),"label"=>"E-Konsultasi") );
	}

	public function index(){
		
		$data['last_asks']	=	$this->site_model->get_all_ask(10,0);

		$content_view = $this->load->view("ekonsultasi_add",$data ,TRUE);

		$data = array( "title" => "E-Konsultasi | Rumah Sakit dr. AK Gani Palembang",
						"content" => $content_view,
						"breadcrumb" => $this->breadcrumb->render(),
					 );

		$this->_output( $data );
	}

	public function lists($pg=""){
		
		$this->breadcrumb->add( array("link"=>site_url("ekonsultasi/list"),"label"=>"List") );
		
		$config = array();
        $config["base_url"] = base_url("list/");
        $config["total_rows"] = $this->site_model->count_data("konsultasi");
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
    	$config["num_links"] = round($choice);
 
        $this->pagination->initialize($config);
 
        $pg = isset( $pg ) ? $pg : 0;
        $data["asks"] = $this->site_model->get_all_ask(5, $pg);
        $data["links"] = $this->pagination->create_links();
        $data['title'] = "Daftar E-Konsultasi";

        $page['breadcrumb']	=	$this->breadcrumb->render();
		$page['content']	=	$this->load->view("ekonsultasi_list",$data,true);

		$this->_output($page);
	}

	public function read($id){

		if( isset($id ) ){

			$data['ask'] =	$this->site_model->get_ask($id);

			if( count($data['ask']) <= 0 )
				redirect("site");

			$this->breadcrumb->add( array("link"=>"#","label"=>ucfirst("baca")) );
			$this->breadcrumb->add( array("link"=>"#","label"=>$id) );
			
	        $data['last_asks'] = $this->site_model->get_all_ask(5,0);
			$page['title']		=	$data['ask']->content." | e-Konsultasi";

			$page['breadcrumb'] = 	$this->breadcrumb->render();
			$page['content']	=	$this->load->view("ekonsultasi_read",$data,true);

			$this->_output($page);

		}else{
			redirect("");
		}

	}

	public function save_ask(){

			$this->load->library("form_validation");
			
			$form_rules = array(
									array(
										'field' => 	'nama',
										'label' =>	'nama',
										'rules'	=>	'required|xss_clean'
									),
									array(
										'field' => 	'email',
										'label' =>	'email',
										'rules'	=>	'xss_clean|email|required'
									),	
									array(
										'field' => 	'topik',
										'label' =>	'topik',
										'rules'	=>	'xss_clean'
									),	
									array(
										'field' => 	'pertanyaan',
										'label' =>	'pertanyaan',
										'rules'	=>	'xss_clean|required'
									),	
							);	

			$this->form_validation->set_rules( $form_rules );

			if( $this->form_validation->run() != FALSE ){

				$data['title']	=	$this->input->post("topik",TRUE);
				$data['content']	=	$this->input->post("pertanyaan",TRUE);
				$data['author']	=	$this->input->post("nama",TRUE);
				$data['email']	=	$this->input->post("email",TRUE);


				if( $this->m_layanan->insert( "konsultasi",$data) ) {
					$json_data["status"]	=	"success";
					$json_data["message"]	=	'								<div class="alert alert-success">
									<button class="close" data-dismiss="alert"></button>
									<strong>Pertanyaan anda telah kami tampung!</strong> .
								</div>';
					
				}		
				else{
					$json_data["status"]	=	"fail";
					$json_data["message"]	=	'								<div class="alert alert-error">
									<button class="close" data-dismiss="alert"></button>
									<strong>Tidak dapat menyampaikan pertanyaan anda.!</strong> 
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