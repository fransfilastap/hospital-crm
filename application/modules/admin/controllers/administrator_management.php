<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Administrator_Management extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library( array("auth","template","menu","grocery_CRUD","Breadcrumb"));
		$this->load->model("m_layanan");
	 /* Standard Libraries of codeigniter are required */
        $this->breadcrumb = new Breadcrumb();
        $this->breadcrumb->add( array( "link"=>"#","label"=> "Control Panel" ) );
        $this->breadcrumb->add( array("link"=>site_url("admin/administrator_Management"), "label"=>"Manajemen Pengguna") );
        /* ------------------ */ 
     /* to grant access to the controller. */
        $this->controller = "Administrator_Management";
        $this->grant_access( $this->controller , $this->session->userdata("current_admin_role") );

	}

	public function index()
	{
		if( $this->auth->_is_admin_logged_in() )
		{
			$crud = new grocery_CRUD();
			$crud->set_theme('twitter-bootstrap');
			$crud->set_table('admin');
			$crud->unset_export();
			$crud->unset_print();

			$crud->columns('name','username','password','role');

			$crud->unset_read();
			$crud->set_subject('Pengguna');

			$crud->add_action("Ganti Password",'',"","",array($this,'_password'));
			//add fields
			$crud->add_fields(
				'name',
				'username',
				'password',
				//'email',
				'role');

			$crud->edit_fields(
				'name',
				'username',
				//'password',
				//'email',
				'role');

			$crud->field_type('admin_id','hidden','');
			$crud->field_type('password','password','');

			$crud->callback_add_field('password',array($this,'_add_default_password_value'));
			$crud->callback_edit_field('password',array($this,'_add_default_password_value'));

			$current_role = $this->session->userdata("current_admin_role");
			if( strtolower( $current_role ) == strtolower( "superuser" ) )
			{
				$crud->set_model('custom_query_model');
				$crud->basic_model->set_query_str('SELECT * FROM admin WHERE role != "superuser"'); //Query text here
				$crud->change_field_type('role','enum', array('superuser','admin','dokter'));
			}

			$crud->display_as('name','Nama ');
			$crud->display_as('Username','Username  ');
			$crud->display_as('Password','Password  ');
			$crud->display_as('email','email ');
			$crud->display_as('role','Peran  ');
			
			$crud->set_rules('admin_id','admin_id','required|xss_clean');
			$crud->set_rules('username','username','required|xss_clean');
			$crud->set_rules('name','name','required|xss_clean');
			$crud->set_rules('password','password','required|xss_clean');
			$crud->set_rules('email','email','required|valid_email|xss_clean');
			$crud->set_rules('role','role','required|xss_clean');
			
			$crud->callback_before_insert(array($this,'_before_insert'));
			$crud->callback_before_update(array($this,'_before_insert'));



			$output = $crud->render();
			$output->menus = $this->menu->get_menus( 'Pengguna'  );

			$this->output($output);

		}
		else
		{
			redirect("admin/login");
		}
	}

	function _add_default_password_value(){
        $return = '<input type="password" name="password" value="" /> ';
        return $return;
	}

	function _password($value,$row){
		if( $this->auth->_is_admin_logged_in() )
		{

			return site_url("admin/administrator_management/change_password")."/".$row->admin_id;
		}
		else
		{
			redirect("admin/login");
		}

	}

	function _before_insert($post_array){
		
		if( $this->auth->_is_admin_logged_in() )
		{
			$post_array['password']=md5($post_array['password']);
			return $post_array;
		}

		return $post_array;

	}


	function change_password( $id )
	{

		if( $this->auth->_is_admin_logged_in() )
		{

			$output->page_title='Ubah Password Pengguna';
			$output->description='';
			$this->breadcrumb->add( array("link"=>"#","label"=>"Ubah Password") );
			$output->admin_id = $id;
			$output->menus = $this->menu->get_menus( 'Pengguna'  );
			$output->breadcrumb = $this->breadcrumb->render();
		
			$this->template->display("manajemen_pengguna/change_password",$output);
		}
		else
		{
			redirect("admin/login");
		}

	}

	function do_change_password()
	{
		if( $this->auth->_is_admin_logged_in() )
		{

			$this->load->library("form_validation");
			$this->form_validation->set_rules("pasien_id","pasien_id","trim|required|xss_clean");
			$this->form_validation->set_rules("new_password","new_password"	,"trim|required|xss_clean");

			if( $this->form_validation->run() == FALSE )
			{
				echo validation_errors();
			}
			else
			{
				$data['password'] 	= 	md5( $this->input->post("new_password") );
				$id 						=	$this->input->post("pasien_id");

				if( $this->m_layanan->update( "admin",$data,"admin_id", $id) )
				{
					redirect("admin/administrator_management");
				}	
				else
				{
					redirect("admin/administrator_management/change_password/".$id);
				}	
			}
			
		}
		else
		{
			redirect("admin/login");
		}
	}

	private function output($output){
		if( $this->auth->_is_admin_logged_in() )
		{
			$output->title = "Manajemen Administrator | Admin";
			$output->page_title='Manajemen Pengguna';
			$output->description='Atur Pengguna Sistem';
			$output->breadcrumb= $this->breadcrumb->render();
			$output->menus = $this->menu->get_menus( 'Akun Administrator'  );
			$this->template->display("content",$output);
		}
		else
		{
			redirect("admin/login");
		}
	}
}