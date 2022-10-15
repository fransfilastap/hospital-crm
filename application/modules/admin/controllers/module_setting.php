<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Module_Setting extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library( array("auth","template","menu","grocery_CRUD","Breadcrumb") );
		$this->load->model( "m_module" );

		$this->breadcrumb = new Breadcrumb();
		$this->breadcrumb->add( array( "link"=>"#","label"=> "Control Panel" ) );
		$this->breadcrumb->add( array( "link"=>site_url("admin/module_setting"),"label"=> "Pengaturan Modul" ) );

		if( strtolower( $this->session->userdata("current_admin_role") ) != "superuser" )
			redirect("admin/module_dead");
	}

	public function index()
	{

		if( $this->auth->_is_admin_logged_in() )
		{

			$crud = new grocery_CRUD();
			$crud->set_theme('twitter-bootstrap');
			$crud->set_table('modules');

			$crud->columns('module_name','module_controller','access','module_mode');
			$crud->unset_read();
			$crud->unset_export();
			$crud->unset_print();

			$crud->add_fields(
				'module_name',
				'module_controller',
				'access',
				'module_mode'
			);

			$crud->edit_fields(
				'module_name',
				'module_controller',
				'access',
				'module_mode');

			$crud->field_type('module_id','hidden','');
			$crud->set_subject("Informasi Modul");

			$crud->display_as("module_controller","Controller");
			$crud->display_as("access","Akses");
			$crud->display_as("module_name","Module");
			$crud->set_rules('module_controller','module_controller','trim|xss_clean');
			$crud->set_rules('module_name','module_name','required|xss_clean');
			$crud->set_rules('access','access','required|xss_clean');
			$crud->set_rules('module_id','module_id','required|xss_clean');						

			$output = $crud->render();
			$output->title = "Pengaturan Modul | Admin";
			$output->page_title='Pengaturan Modul';
			$output->description='';
			$output->breadcrumb= $this->breadcrumb->render();

			$output->menus = $this->menu->get_menus( 'Akses'  );
			$this->template->display("content",$output);
		}
		else
		{
			redirect("admin/login");
		}

	}
}