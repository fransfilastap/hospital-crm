<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Polikliniks extends MY_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->library( array( "template" , "auth" , "menu" , "grocery_CRUD", "Breadcrumb" ) );
		$this->load->helper("post_date");
		$this->load->model( array("m_layanan") );

		$this->breadcrumb = new Breadcrumb();
		$this->breadcrumb->add( array("link"=>'#',"label"=>"Master Data") );
		$this->breadcrumb->add( array("link"=>site_url("admin/polikliniks"),"label"=>"Data Poliklinik") );

		     /* to grant access to the controller. */
        $this->controller = "polikliniks";
        $this->grant_access( $this->controller , $this->session->userdata("current_admin_role") );
	}

	public function index(){

		if( $this->auth->_is_admin_logged_in() ){
			
			$crud = new grocery_CRUD();

			$crud->set_theme('twitter-bootstrap');
			$crud->set_table('poliklinik');
			$crud->unset_export();
			$crud->unset_print();
			$crud->unset_read();

			$crud->columns('id_poliklinik','nama_poliklinik','deskripsi');

			$crud->display_as("id_poliklinik","ID Poliklinik");
			$crud->display_as('nama_poliklinik','Nama Poli');
			$crud->display_as('deskripsi','Deskripsi');

			$crud->set_subject('Poliklinik');
			
			//add fields
			$crud->add_fields("id_poliklinik",'nama_poliklinik','deskripsi');
			
			$crud->field_type("id_poliklinik","hidden",'');

			$crud->callback_before_insert(array($this,'_before_insert'));


	       	$output = $crud->render();
			
	     
	        $this->output($output);  			
		}
		else{
			redirect("admin/login");
		}

	}


	public function _before_insert( $post_array ){
		$post_array["id_poliklinik"] = $this->m_layanan->generatePoliID();

		return $post_array;
	}


	private function output($output){
		if( $this->auth->_is_admin_logged_in() )
		{
			$output->title = "Data Poli klinik | Admin";
			$output->page_title='Data Poliklinik';
			$output->description='Kelola Data Poliklinik';
			$output->breadcrumb=$this->breadcrumb->render();
			$output->menus = $this->menu->get_menus( 'Poliklinik'  );
			$this->template->display("content",$output);
		}
		else{
			redirect( site_url("admin/login") );
		}
	}
}