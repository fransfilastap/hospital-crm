<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Category extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library( array( "template" , "auth" , "menu" , "grocery_CRUD","Breadcrumb" ) );


		$this->breadcrumb = new Breadcrumb();
		$this->breadcrumb->add( array("link"=>'#',"label"=>"Web Portal") );
		$this->breadcrumb->add( array("link"=>site_url("admin/category"),"label"=>"Category") );

		$this->controller = "Category";
		$this->grant_access( $this->controller , $this->session->userdata("current_admin_role") );

	}

	function index()
	{	
		if( $this->auth->_is_admin_logged_in() )
		{
			$crud = new grocery_CRUD();

			$crud->set_theme('twitter-bootstrap');
			$crud->set_table('categories');
			$crud->unset_export();
			$crud->unset_print();
			$crud->unset_read();

			$crud->set_relation('category_parent','categories','category_name');

			$crud->columns('category_name','description','category_parent');

			$crud->display_as("category_name","Nama Kategori");
			$crud->display_as('description','Deskrisi');
			$crud->display_as('category_parent','Induk kategori');

			$crud->set_subject('Kategori');
			
			//add fields
			$crud->add_fields('category_name','description','category_parent');
			
			$crud->field_type("category_id","hidden",'');


	       	$output = $crud->render();
			
	     
	        $this->output($output);  
		}
		else
		{
			redirect("admin/login");
		}
		
	}
	
	private function output($output){
		if( $this->auth->_is_admin_logged_in() )
		{
			$output->title = "Kategori Posting";
			$output->page_title='Kategori';
			$output->description='Kelompokan isi blog ke dalam kategori';
			$output->breadcrumb= $this->breadcrumb->render();
			$output->menus=$this->menu->get_menus( 'Kategori Posting'  );
			$this->template->display("content",$output);
		}
	}
}