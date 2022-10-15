<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Pages extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library( array( "template" , "auth" , "menu" , "grocery_CRUD","Breadcrumb" ) );
		$this->load->helper( array("post_date") );
	 /* Standard Libraries of codeigniter are required */
        $this->load->database();
        $this->load->model("m_admin");

        $this->breadcrumb = new Breadcrumb();
		$this->breadcrumb->add( array("link"=>'#',"label"=>"Web Portal") );
		$this->breadcrumb->add( array("link"=>site_url("admin/pages"),"label"=>"Halaman") );
     /* to grant access to the controller. */
        $this->controller = "page";
        $this->grant_access( $this->controller , $this->session->userdata("current_admin_role") );
	}

	public function _output( $output )
	{
		if( $this->auth->_is_admin_logged_in() )
		{
			$output->title = "Halaman | Admin";
			$output->page_title='Halaman';
			$output->description='Halaman Portal';
			$output->breadcrumb=$this->breadcrumb->render();
			$output->menus=$this->menu->get_menus( 'Halaman'  );
			$this->template->display("content",$output);
		}
	}

	public function index()
	{
		if( $this->auth->_is_admin_logged_in() )
		{
			$crud = new grocery_CRUD();

			//$crud->set_model("custom_query_model");

			$crud->set_theme('twitter-bootstrap');
			$crud->set_table('halaman');
			$crud->unset_export();
			$crud->unset_print();
			$crud->unset_read();

			$crud->columns('judul_halaman','isi_halaman','tanggal_buat','Penulis');
			
			$crud->display_as("judul_halaman","Judul Halaman");
			$crud->display_as('isi_halaman','Isi Halaman');
			$crud->display_as('tanggal_buat','Tanggal');
			$crud->display_as('Penulis','Penulis');

			$crud->set_subject('Halaman');
			
			//add fields
			//$crud->add_fields('blog_author','blog_date','blog_title','blog_content','blog_feature_image','blog_status','blog_type');

			//$crud->edit_fields('blog_title','blog_content','blog_feature_image','blog_status');

			//$crud->set_field_upload('blog_feature_image','upload/blog_cover');

			//$crud->field_type("judul_halaman","text","");
			$crud->field_type("author","hidden",$this->session->userdata("current_admin_username"));
			$crud->field_type('tanggal_buat','hidden',date('Y-m-h'));
			//$crud->field_type("blog_type","hidden","page");


			$crud->callback_before_insert(array($this,'_before_insert'));
			//$crud->callback_before_update(array($this,'_before_update'));
			//$crud->callback_after_upload( array($this,'_callback_after_upload') );

	       	$crud->callback_column('isi_halaman',array($this,'_short_post'));
			$crud->callback_column('tanggal_buat',array($this,'_format_post_date'));

	       	$output = $crud->render();
	     
	        $this->_output($output);  
		}
		else
		{
			redirect("admin/login");
		}
	}

	function _callback_after_upload($uploader_response,$field_info, $files_to_upload)
	{
		if( $this->auth->_is_admin_logged_in() )
		{
			$this->load->library('image_moo');
 
	    	//Is only one file uploaded so it ok to use it with $uploader_response[0].
	    	$file_uploaded = $field_info->upload_path.'/'.$uploader_response[0]->name; 
	    	
	    	$extension  =   strtolower(strrchr($file_uploaded, '.'));
	        $pos        =   strpos($file_uploaded,$extension);
	        $thumb      =   substr($file_uploaded, 0,$pos).'-300x320'.$extension;

	    	$this->image_moo->load($file_uploaded)->resize(620,320)->save($file_uploaded,true);
	    	$this->image_moo->load($file_uploaded)->resize(300,320)->save($thumb,true);
	 
	    	return true;
		}
		else
		{
			redirect("admin/login");
		}
	}

	function _short_post($value,$row)
	{

		$length = 150;
		$final = "";

		if( strlen( $value ) > $length )
		{
			$final = substr( $value , 0 , $length);
		}

		$final = strip_tags( $final );

		return $final;

	}

	function _format_post_date($value,$row)
	{
		return format_date( $value );
	}


}