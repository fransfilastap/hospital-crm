<?php

class Dokters extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->library( array( "template" , "auth" , "menu" , "grocery_CRUD","Breadcrumb" ) );
		$this->load->helper("post_date");

		$this->breadcrumb = new Breadcrumb();
		$this->breadcrumb->add( array("link"=>'#',"label"=>"Master Data") );
		$this->breadcrumb->add( array("link"=>site_url("admin/dokters"),"label"=>"Data Dokter") );
		     /* to grant access to the controller. */
        $this->controller = "Dokters";
        $this->grant_access( $this->controller , $this->session->userdata("current_admin_role") );
	}

	public function index(){

		if( $this->auth->_is_admin_logged_in() ){
			
			$crud = new grocery_CRUD();

			$crud->set_theme('twitter-bootstrap');
			$crud->set_table('dokter');
			$crud->unset_export();
			$crud->unset_print();
			$crud->unset_read();

			$crud->columns('nip_dokter','nama','spesialisasi','no_telp','alamat');

			$crud->display_as("nip_dokter","NIP");
			$crud->display_as('nama','Nama');
			$crud->display_as('spesialisasi','Spesialisasi');
			$crud->display_as('no_telp','No. Telp');

			$crud->set_subject('Data Dokter');
			
			//add fields
			$crud->add_fields('nip_dokter','nama','spesialisasi','no_telp','alamat');
			
			//$crud->field_type("category_id","hidden",'');


	       	$output = $crud->render();
			
	     
	        $this->output($output);  			
		}
		else{
			redirect("admin/login");
		}

	}

	private function output($output){
		if( $this->auth->_is_admin_logged_in() )
		{
			$output->title = "Data Dokter | Admin";
			$output->page_title='Data Dokter';
			$output->description='Kelola Data Dokter';
			$output->breadcrumb=$this->breadcrumb->render() ;
			$output->menus = $this->menu->get_menus( 'Dokter'  );
			$this->template->display("content",$output);
		}
	}
}