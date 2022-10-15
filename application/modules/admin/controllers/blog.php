<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Blog extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library( array( "template" , "auth" , "menu" , "grocery_CRUD","Breadcrumb" ) );
		$this->load->helper("post_date");
	 /* Standard Libraries of codeigniter are required */
        $this->load->database();
        $this->load->model( array("m_admin","util_model") );
     /* to grant access to the controller. */
        $this->controller = "blog";
        $this->grant_access();
        
        $this->breadcrumb = new Breadcrumb();
        $this->breadcrumb->add( array("link"=>'#',"label"=>"Web Portal") );
		$this->breadcrumb->add( array("link"=>site_url("admin/blog"),"label"=>"Posting") );
	}

	function index()
	{	
		if( $this->auth->_is_admin_logged_in() )
		{
			$crud = new grocery_CRUD();

			$crud->set_theme('twitter-bootstrap');

			$crud->unset_export();
			$crud->unset_print();
			$crud->unset_read();
			$crud->set_table('posts');
			
			//$crud->set_model('custom_query_model');
			//$crud->basic_model->set_query_str('SELECT blog_id,blog_title,blog_content,blog_status,blog_date,blog_status,
			//									category_name,category FROM blog b LEFT JOIN 
			//									categories c ON c.id_category = category WHERE b.blog_type = "post"'); //Query text here

			$crud->columns('blog_title','blog_content','blog_date','category','blog_status');

			$crud->callback_column('blog_content',array($this,'_short_post'));
			$crud->callback_column('blog_date',array($this,'_format_post_date'));
			
			$crud->display_as("blog_title","Judul Posting");
			$crud->display_as('blog_content','Isi');
			$crud->display_as('blog_status','Publish');
			$crud->display_as('blog_feature_image','Cover Posting');
			$crud->display_as('blog_date','Waktu Post');

			$crud->set_subject('Posting');
			
			//add fields
			$crud->add_fields('blog_author','blog_date','blog_title','blog_content','blog_feature_image','category','blog_status');

			$crud->edit_fields('blog_title','blog_content','blog_feature_image','category','blog_status');

			$crud->set_field_upload('blog_feature_image','upload/blog_cover');

			$crud->field_type("blog_author","hidden",$this->session->userdata("current_admin_username"));
			$crud->field_type('blog_date','hidden','');

			$raw = $this->util_model->get_categories();
			$cat = array();

			foreach ($raw as $key => $row) {
				$cat[$row->id_category]	 = $row->category_name;
			}

			$crud->field_type("category","dropdown",$cat);

			$crud->callback_before_insert(array($this,'_before_insert'));
			//$crud->callback_before_update(array($this,'_before_update'));
			$crud->callback_after_upload( array($this,'_callback_after_upload') );

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
			$output->title = "Posting | Admin";
			$output->page_title='Posting';
			$output->description='Tambah Tulisan';
			$output->breadcrumb= $this->breadcrumb->render();
			$output->menus=$this->menu->get_menus( 'Posting'  );
			$this->template->display("content",$output);
		}

	}

	function _before_insert($post_array){
		if( $this->auth->_is_admin_logged_in() )
		{
			$post_array['blog_date']	=	date("Y-m-d");
			return $post_array;
		}

		return $post_array;
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