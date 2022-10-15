<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class feedback extends MY_Controller{

	function __construct(){
		parent::__construct();
		$this->load->library( array( "template" , "auth" , "menu" , "grocery_CRUD","Breadcrumb" ) );
		$this->load->model( array("m_layanan") );
		$this->breadcrumb = new Breadcrumb();
		$this->breadcrumb->add( array("link"=>'#',"label"=>"Layanan") );
		$this->breadcrumb->add( array("link"=>site_url("admin/feedback"),"label"=>"Kritik & Saran") );


		     /* to grant access to the controller. */
        $this->controller = "feedback";
        $this->grant_access( $this->controller , $this->session->userdata("current_admin_role") );
	}

	function index(){
		
		if( $this->auth->_is_admin_logged_in() ){
			$output = new stdClass();
			//$data['promos'] = $this->m_layanan->get_promo_list();
			$output->output = $this->load->view("kritik_saran/list",null,TRUE);
			$output->breadcrumb = $this->breadcrumb->render();
			$this->output( $output,TRUE );		
		}
		else{
			redirect("admin/login");
		}

	}

	function detail($id){

		if( $this->auth->_is_admin_logged_in() ){
			
			$data['feedback'] = $this->m_layanan->getOne( 'kritik_saran', array('id_feedback'=> $id ) );
			$modal = $this->load->view("kritik_saran/detail",$data,TRUE);
			echo $modal;
		}
		else{
			redirect("admin/login");
		}		

	}

	function lists(){

		if( $this->auth->_is_admin_logged_in() ){

			$d1 = $this->input->post("date1",TRUE);
			$d2 = $this->input->post("date2",TRUE);
			$jenis = $this->input->post("jenis",TRUE);

			$this->m_layanan->getFeedback($d1,$d2,$jenis);	
		}
		else{
			redirect("admin/login");
		}

	}

	function report(){
		
		if( $this->auth->_is_admin_logged_in() ){

			echo "reportnya belum dibikin";
		}
		else{
			redirect("admin/login");
		}
	}

	private function output($output,$isPlain=false){
		if( $this->auth->_is_admin_logged_in() )
		{
			$output->title = "Data Kritik & Saran | Admin";
			$output->page_title='Data Kritik & Saran';
			$output->description='feedback';
			$output->menus = $this->menu->get_menus( 'Kritik & Saran'  );
			$this->template->display("content",$output,$isPlain);
		}
		else{
			redirect( site_url("admin/login") );
		}
	}

}