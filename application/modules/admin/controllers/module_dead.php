<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Module_dead extends MX_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library("Auth");
		$this->load->library( array("template","menu"));
	}

	public function index()
	{
		if( $this->auth->_is_admin_logged_in() )
		{
			$output->page_title='Module Tidak Dapat Diakses';
			$output->description='';
			$output->breadcrumb='';
			$output->menus = $this->menu->get_menus( 'Back Office', 'Data Pencairan Bonus'  );
			$this->template->display("module_not_accessible",$output);
		} 
		else
		{
			redirect("admin/login");
		}
	}

}