<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/* load the MX_Loader class */
require APPPATH."third_party/MX/Controller.php";

class MY_Controller extends MX_Controller {


	protected $controller;

	public function __construct()
	{
		parent::__construct();
		$this->load->library("session");
		$this->load->model("m_module");
	}

	protected function grant_access()
	{
		
		if( $this->session->userdata("current_admin_role") != "superuser" )
		{
			if( $this->m_module->is_active($this->controller) ){
				if( $this->m_module->is_granted( $this->controller, $this->session->userdata("current_admin_role") ) == FALSE )
				{
					redirect("admin/module_dead");
				}
			}
			else{
				redirect("admin/module_dead");
			}
		} 
	}
}