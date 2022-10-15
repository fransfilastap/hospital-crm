<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Pasiens extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library( array("Auth","template",'menu','grocery_CRUD','Breadcrumb'));
		$this->load->helper( array("post_date_helper") );
	 	/* Standard Libraries of codeigniter are required */
        $this->load->database();
        /* ------------------ */ 
		$this->load->model( array('m_pasien','util_model','m_layanan') );

		$this->breadcrumb = new Breadcrumb();
		$this->breadcrumb->add( array("link"=>'#',"label"=>"Master Data") );
		$this->breadcrumb->add( array("link"=>site_url("admin/pasiens"),"label"=>"Data Pasien") );

        /* to grant access to the controller. */
        $this->controller = "pasiens";
        $this->grant_access( $this->controller , $this->session->userdata("current_admin_role") );
	}

	function index()
	{	
		if( $this->auth->_is_admin_logged_in() )
		{

			$crud = new grocery_CRUD();
			$crud->set_theme('twitter-bootstrap');
			$crud->set_table('pasien');

			$crud->columns("id_pasien","no_ktp","nama_pasien","jenis_kelamin",
						"no_telp","alamat");

			$crud->callback_column('nama_pasien',array($this,'_make_url'));
			$crud->unset_read();
			$crud->set_subject('Pasien');


			//add fields
			$crud->add_fields(
				'id_pasien',
				'no_ktp',
				'nama_pasien',
				'jenis_kelamin',
				'no_telp',
				'alamat',
				'tanggal_lahir',
				'tempat_lahir',
				'tanggal_daftar',
				'username',
				'password'
			);

	

			//edit fields
			$crud->edit_fields(
				'no_ktp',
				'nama_pasien',
				'jenis_kelamin',
				'no_telp',
				'alamat',
				'tanggal_lahir',
				'tempat_lahir',
				'username');

			// set display 
			$crud->display_as('id_pasien','ID Pasien ');
			$crud->display_as('no_ktp','No. KTP ');
			$crud->display_as('nama_pasien','Nama');
			$crud->display_as('jenis_kelamin','Gender');
			$crud->display_as('alamat','Alamat ');
			$crud->display_as('tempat_lahir','Tempat Lahir ');
			$crud->display_as('tanggal_lahir','Tanggal Lahir ');
			$crud->display_as('username','Username');
			$crud->display_as('password','Password');
			

			$crud->field_type('id_pasien','hidden','');
			$crud->field_type('tanggal_daftar','hidden','');
			$crud->field_type('password','password','');

			//$crud->field_type('password','password','');
			
			
			//set rules
			$crud->set_rules('no_ktp','no_ktp','required|xss_clean');
			$crud->set_rules('nama_pasien','nama_pasien','required|xss_clean');
			$crud->set_rules('jenis_kelamin','jenis_kelamin','required|xss_clean');
			$crud->set_rules('no_telp','no_telp','required|xss_clean');
			$crud->set_rules('username','username','required|xss_clean');
			$crud->set_rules('password','password','required|xss_clean');
			$crud->set_rules('no_ktp','no_ktp','required|xss_clean');


			$crud->unset_texteditor('alamat');

			log_message('info','Query: '.$this->db->last_query());

			$crud->callback_before_insert(array($this,'_before_insert'));

			$crud->callback_before_update( array($this, '_before_update') );
	       	$crud->add_action("Ubah Password",site_url("assets/key.png"),"","",array($this,'c_password'));
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
			$output->title = "Data Pasien | Admin";
			$output->page_title='Data Pasien';
			$output->description='Kelola Data pasien';
			$output->breadcrumb= $this->breadcrumb->render() ;
			$output->menus = $this->menu->get_menus( 'Data Pasien'  );
			$this->template->display("content",$output);
		}
	}

	function _before_insert($post_array){
		
		$post_array["id_pasien"] = $this->m_pasien->generatPasienID();
		$post_array['tanggal_daftar'] = date("Y-m-d");

		return $post_array;
	}

	function _before_update($post_array)
	{
		$post_array['pasien_password'] = md5( $post_array['pasien_password'] );
		return $post_array;
	}
	

	function _make_url($value, $row=null){
		 return "<a href='".site_url('admin/pasiens/details/'.$row->id_pasien)."'>$value</a>";
	}
	//################################################################ function view #############################################

	function details($id=null){
		
		if($this->auth->_is_admin_logged_in() )
		{
			$output=new stdClass();
			$fields = "*";
			$pasien_information = 	$this->m_pasien->_get_pasien( $id , $fields );
			$history 			=	$this->m_layanan->getOne("kunjungan_poli",array("id_pasien"=>$id));
			
			$output->profile =	$pasien_information[0];
			$output->history = $history;

			$output->title = "Detail pasien | Admin";
			$output->page_title='Detail pasien';
			$output->description='Lihat Detail Informasi pasien';
			$this->breadcrumb->add( array( "link" => '#', "label"=>"Detail" ) );
			$output->breadcrumb= $this->breadcrumb->render() ;
			$output->menus = $this->menu->get_menus( 'Data pasien'  );
		

			$this->template->display("pasien/detail_pasien_view",$output);
		}
		else
		{
			redirect("admin/login");
		}

	}

	function c_password($primary_key, $row){
		
		if( $this->auth->_is_admin_logged_in() )
		{

			return site_url("admin/pasiens/change_password")."/".$row->id_pasien;
		}
		else
		{
			redirect("admin/login");
		}


	}

	function activate($primary_key, $row){
		
		if( $this->auth->_is_admin_logged_in() )
		{

			return site_url("admin/pasiens/change_password")."/".$row->pasien_id;
		}
		else
		{
			redirect("admin/login");
		}


	}

	function change_password( $id )
	{

		if( $this->auth->_is_admin_logged_in() )
		{

			$output->page_title='Ubah Password pasien';
			$output->description='Lahkah recovery password pasien CRM RS';
			$output->breadcrumb='Recovery Password pasien';
			$output->pasien_id = $id;
			$output->menus = $this->menu->get_menus( 'Data pasien'  );
		

			$this->template->display("pasien/change_pasien_password",$output);
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

				if( $this->m_pasien->_update_pasien( $id, $data ) )
				{
					redirect("admin/pasiens");
				}	
				else
				{
					redirect("admin/pasiens/change_password/".$id);
				}	
			}
			
		}
		else
		{
			redirect("admin/login");
		}
	}

	public function affiliate_tree( $pasien_id ){

		if( $this->auth->_is_admin_logged_in() ){
			$pasien = $this->m_pasien->_get_pasien( $pasien_id );

			if( count( $pasien ) > 0 || isset( $pasien ) ){
				$downline = $this->mlm_model->build_network($pasien[0]->pasien_id, $pasien[0]->pasien_perdana);
				$affiliate_tree = $this->mlm_model->render_affiliate_tree( $downline );
    		
    			echo '	<ul id="network">
             			<li><a href="#" > <img src="'.site_url("assets/root.png").'">
                		    <ul>
                		       '.$affiliate_tree.'
                		    </ul>
                	        </a>
                	   </li>
                </ul>';
			}
			else{
				echo "<ul></ul>";
			}

		}
		else{
			redirect("admin");
		}

	}
}