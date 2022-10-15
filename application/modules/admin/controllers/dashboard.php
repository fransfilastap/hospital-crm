<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Dashboard extends MY_Controller
{
	

	function __construct()
	{
		parent::__construct();
		$this->load->library( array('auth',"template",'menu','Breadcrumb'));
		$this->load->model("m_layanan");

		$this->load->helper("post_date_helper");

		$this->breadcrumb = new Breadcrumb();

		//$this->controller = "dashboard";
		//$this->grant_access();

		
	}

	function index()
	{	
		if( $this->auth->_is_admin_logged_in() )
		{
			$output=new stdClass();
			$output->title = "Dashboard | Admin CRM RS";
			$output->page_title='Dashboard';
			$output->description='Laporan Statistik dan Rangkuman Informasi';
			$this->breadcrumb->add( array("link"=>site_url("admin/dashboard"),"label"=>"Dashboard") );

			$start = $this->input->post("start",TRUE);
			$end   = $this->input->post("end",TRUE);


			if( $start == FALSE || $end == FALSE ){
				$start = "2014-06-01";
				$end   = "2014-06-21";
			}

			$data = $this->m_layanan->data_dashboard($start,$end);

			$output->dashboard_js = array(	
											"jquery.flot.js",
											"jquery.flot.categories.js",
											//"jquery.flot.resize.js",
											//"jquery.flot.crosshair.js",
											//"jquery.flot.pie.js",
											//"jquery.flot.stack.js",
											//"jquery.colorhelpers.js",
											//"jquery.colorhelpers.min.js",
											//"jquery.flot.canvas.js",
											//"jquery.flot.canvas.min.js",
											
											//"jquery.flot.categories.min.js",
											
											//"jquery.flot.crosshair.min.js",
											//"jquery.flot.errorbars.js",
											//"jquery.flot.errorbars.min.js",
											//"jquery.flot.fillbetween.js",
											//"jquery.flot.fillbetween.min.js",
											//"jquery.flot.image.js",
											//"jquery.flot.image.min.js",
											
											//"jquery.flot.min.js",
											//"jquery.flot.navigate.js",
											//"jquery.flot.navigate.min.js",
											
											//"jquery.flot.pie.min.js",
											
											//"jquery.flot.resize.min.js",
											//"jquery.flot.selection.js",
											//"jquery.flot.selection.min.js",
											
											//"jquery.flot.stack.min.js",
											//"jquery.flot.symbol.js",
											//"jquery.flot.symbol.min.js",
											//"jquery.flot.threshold.js",
											//"jquery.flot.threshold.min.js",
											//"jquery.flot.time.js",
											//"jquery.flot.time.min.js"
											);
			

			$output->data_dashboard = $data;

			$output->breadcrumb=$this->breadcrumb->render(true);
			$output->menus = $this->menu->get_menus( 'Dashboard');
			$this->template->display("dashboard",$output);
		}
		else
		{
			redirect("admin/login");
		}
	}


	public function refresh(){
		if( $this->auth->_is_admin_logged_in() )
		{

			$start = $this->input->post("start",TRUE);
			$end   = $this->input->post("end",TRUE);

			if( $start == FALSE || $end == FALSE ){
				$start = "2014-06-01";
				$end   = "2014-06-21";
			}

			$data = $this->m_layanan->data_dashboard($start,$end);

			echo $data;
		}
		else
		{
			redirect("admin/login");
		}		
	}

}