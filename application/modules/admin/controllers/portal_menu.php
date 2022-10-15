<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class portal_menu extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library( array( "template" , "auth" , "menu" ,"breadcrumb") );
		$this->load->model( array("portal_menu_model") );
		$this->breadcrumb = new Breadcrumb();
		$this->breadcrumb->add( array("link"=>'#',"label"=>"Web Portal") );
		$this->breadcrumb->add( array("link"=>site_url("admin/portal_menu"),"label"=>"Portal Menu") );

		     /* to grant access to the controller. */
        $this->controller = "portal_menu";
        $this->grant_access( $this->controller , $this->session->userdata("current_admin_role") );
	}

	function index()
	{
		if( $this->auth->_is_admin_logged_in() )
		{
			$output = new StdClass;
			$output->title = "Portal Menu | Admin CRM RS";
			$output->page_title='Portal Menu';
			$output->description='Atur menu portal';
			$output->breadcrumb = $this->breadcrumb->render();
			$output->menus=$this->menu->get_menus( 'Menu'  );
			$output->portal_menu = $this->portal_menu_model->get_all_menu();
			
			$this->template->display("portal/portal_menu_list",$output);
		}
		else
		{
			redirect("admin/login");
		}
	}

	function add()
	{
		if( $this->auth->_is_admin_logged_in() )
		{
			$output = new StdClass;
			$output->title = "Tambah Menu | Admin CRM RS";
			$output->page_title='Tambah Menu';
			$output->description='Menambah Menu';

			$this->breadcrumb->add( array("link"=>site_url("admin/portal_menu/add/#"),"label"=>"Tambah Menu") );
			$output->breadcrumb=$this->breadcrumb->render();
			$output->menus=$this->menu->get_menus( 'Menu'  );
			$output->portal_menu = $this->portal_menu_model->get_all_menu();
			$output->pages = $this->portal_menu_model->get_page_list();
			$output->categories = $this->portal_menu_model->get_category_list();
			$output->notification = $this->session->flashdata("portal_menu_notif");

			$this->template->display("portal/portal_menu_add",$output);
		}
		else
		{
			redirect("admin/login");
		}
	}

	function save()
	{
		if( $this->auth->_is_admin_logged_in() )
		{

			$data = array();

			$this->load->library("form_validation");

			$form_rules = array(
									array(
										'field' => 	'menu_name',
										'label' =>	'Menu',
										'rules'	=>	'required|xss_clean'
									),
									array(
										'field' => 	'menu_parent',
										'label' =>	'Induk Menu',
										'rules'	=>	'integer'
									),
									array(
										'field' => 'menu_type',
										'label' => 'Jenis Menu',
										'rules' => 'required|xss_clean'
									),
									array(
										'field' => 'menu_status',
										'label' => 'Visibilitas',
										'rules' => 'required|xss_clean'
									),
									array(
										'field' => 'menu_content',
										'label' => 'menu_content',
										'rules' => 'required|xss_clean'
									),

								);

			$this->form_validation->set_rules( $form_rules );

			if( $this->form_validation->run() != FALSE ){

				$data = array();

				$menu['menu_title'] 	=	$this->input->post("menu_name",TRUE);
				$menu['menu_content'] 	=	$this->input->post("menu_content",TRUE);
				$menu['menu_type'] 		=	$this->input->post("menu_type",TRUE);
				$menu['menu_status'] 	=	$this->input->post("menu_status",TRUE);
				$menu['menu_parent'] 	=	$this->input->post("menu_parent",TRUE);		

				if( $this->portal_menu_model->insert_menu( $menu ) ) {

					$data['status'] 	= 	"success";
					$data['messages']	=	"Menu berhasil disimpan";
	
				}		
				else{
					$data['status'] 	= 	"failed";
					$data['messages']	=	"Menu gagal disimpan";
				}

				echo json_encode( $data );

			}
			else
			{
				$this->session->set_flashdata("portal_menu_notif",validation_errors());
				echo json_encode( array("status" => "failed" , "messages" => validation_errors()) );
				redirect("admin/portal_menu/add" );
			}
		}
		else
		{
			redirect("admin/login");
		}
	}

	function edit($id)
	{
		if( $this->auth->_is_admin_logged_in() )
		{
			$output = new StdClass;
			$output->title = "Tambah Menu | Admin CRM RS";
			$output->page_title='Tambah Menu';
			$output->description='Menambah Menu';
			$this->breadcrumb->add( array("link"=>"#","label"=>"Edit") );
			$output->breadcrumb=$this->breadcrumb->render();
			$output->menus=$this->menu->get_menus( 'Menu'  );
			$output->portal_menu = $this->portal_menu_model->get_all_menu();
			$output->pmenu_detail = $this->portal_menu_model->get_detail( $id );
			$output->pages = $this->portal_menu_model->get_page_list();
			$output->categories = $this->portal_menu_model->get_category_list();
			$output->notification = $this->session->flashdata("portal_menu_notif");
			
			$this->template->display("portal/portal_menu_edit",$output);
		}
		else
		{
			redirect("admin/login");
		}
	}

	function process_edit(){
		if( $this->auth->_is_admin_logged_in() )
		{
			$data = array();

			$this->load->library("form_validation");

			$form_rules = array(
									array(
										'field' => 	'menu_name',
										'label' =>	'Menu',
										'rules'	=>	'required|xss_clean'
									),
									array(
										'field' => 	'menu_parent',
										'label' =>	'Induk Menu',
										'rules'	=>	'integer'
									),
									array(
										'field' => 'menu_type',
										'label' => 'Jenis Menu',
										'rules' => 'required|xss_clean'
									),
									array(
										'field' => 'menu_status',
										'label' => 'Visibilitas',
										'rules' => 'required|xss_clean'
									),
									array(
										'field' => 'menu_content',
										'label' => 'menu_content',
										'rules' => 'required|xss_clean'
									),

								);

			$this->form_validation->set_rules( $form_rules );

			if( $this->form_validation->run() != FALSE ){

				$menu['menu_title'] 	=	$this->input->post("menu_name",TRUE);
				$menu['menu_content'] 	=	$this->input->post("menu_content",TRUE);
				$menu['menu_type'] 		=	$this->input->post("menu_type",TRUE);
				$menu['menu_status'] 	=	$this->input->post("menu_status",TRUE);
				$menu['menu_parent'] 	=	$this->input->post("menu_parent",TRUE);	
				$id 					=	$this->input->post("menu_id",TRUE);	

				if( $this->portal_menu_model->update_menu( $menu , $id ) ) {

					$data['status'] 	= 	"success";
					$data['messages']	=	"Menu berhasil disimpan";

					echo json_encode( $data );
				}		
				else{
					$data['status'] 	= 	"failed";
					$data['messages']	=	"Menu gagal disimpan";

					echo json_encode( $data );
				}


			}
			else
			{
				$this->session->set_flashdata("portal_menu_notif",validation_errors());
				echo json_encode( array("status" => "failed" , "messages" => validation_errors()) );
				redirect("admin/portal_menu/add" );
			}
		}
		else
		{
			redirect("admin/login");
		}
	}

	function delete($id)
	{
		if( $this->auth->_is_admin_logged_in() )
		{	
			$data = array();

			if( $this->portal_menu_model->delete_menu( $id ) ){

				$data['msg']	=	"Data telah dihapus";

				echo json_encode( $data );
			}
			else{
				$data['msg']	=	"Data tidak dapat dihapus :(";

				echo json_encode( $data );
			}
		}
		else
		{
			$data['msg'] = "Anda tidak boleh melakukan akses ini!";

			echo json_encode( $data );
		}
	}


	public function update_order($type){
		if( $this->auth->_is_admin_logged_in() )
		{

			$id = $this->input->post("id",TRUE);

			if( $type == "up" ){
				$this->portal_menu_model->order_up($id);
			}
			else{
				$this->portal_menu_model->order_down($id);
			}

		}
		else
		{
			redirect("admin/login");
		}		
	}

	function get_page_list()
	{
		if( $this->auth->_is_admin_logged_in() )
		{
			$output = new StdClass;
			


			$view = $this->load->view("ajax_page_list",$output,TRUE);
			echo $view;
		}
		else
		{
			redirect("admin/login");
		}

	}


}