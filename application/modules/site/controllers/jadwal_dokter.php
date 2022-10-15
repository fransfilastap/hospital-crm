<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class jadwal_dokter extends MY_Controller
{

	public function __construct(){
		parent::__construct();
		$this->load->model( array("site_model") );
		$this->load->library( array("breadcrumb") );

		$this->breadcrumb = new Breadcrumb();
		$this->breadcrumb->add( array("link"=>'#',"label"=>"Services") );
		$this->breadcrumb->add( array("link"=>site_url("site/jadwal_dokter"),"label"=>"Jadwal Dokter") );
	}


	public function index(){

		$content_view = $this->load->view("jadwal",array("jadwals"=>$this->site_model->get_jadwal()) ,TRUE);

		$data = array( "title" => "Rumah Sakit dr. AK Gani Palembang",
						"content" => $content_view,
						"breadcrumb" => $this->breadcrumb->render(),
					 );

		$this->_output( $data );

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