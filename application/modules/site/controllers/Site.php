<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Site extends MY_Controller
{


	####################################################################################################
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library( array("auth","pagination","breadcrumb") );
		$this->load->model( array( "site_model" ) );
		$this->load->helper("post_date");
		//$this->config->load('RF_CONFIG');
	}	
	

	####################################################################################################
	private function _output( $output_data )
	{	$output_data['menus']		=	$this->_build_menu();
		$output_data['categories']	=	$this->site_model->get_all_category();
		$this->load->view("template",$output_data);
	}

	####################################################################################################
	private function _build_menu(){

		$menus = array();

		$roots = $this->site_model->get_root_menu();
		$i = 0;
		foreach ($roots as $key => $root) {
			$menus[$i]["menu_name"] = $root->menu_title;
			$menus[$i]["menu_link"] = $root->menu_content;
			
			if( $root->child_count > 0 ){
				$menus[$i]["child"] = $this->site_model->get_child_menu( $root->menu_id );
				
			}
			$i++;
		}

		return $menus;

	}

	

	####################################################################################################
	public function index()
	{
	
		
		$data["last_blogs"] = $this->site_model->get_all_blog(7, 0);
		$data["promotion"] = $this->site_model->get_all_promo(7, 0);
		$data['last_asks']	=	$this->site_model->get_all_ask(7,0);

		$content_view  = $this->load->view("home",$data, TRUE);
		$data = array( "title" => "Rumah Sakit dr. AK Gani Palembang",
						"content" => $content_view,
						"breadcrumb" => ""
					 );

		$this->_output($data);
		
	}


	####################################################################################################
	public function blog($pg="")
	{

		$page['title']		=	"Blog | RS. DR. AK Gani";


		$this->breadcrumb = new Breadcrumb();
		$this->breadcrumb->add( array("link"=>site_url("blog"),"label"=>"blog") );

		$config = array();
        $config["base_url"] = base_url("blog/");
        $config["total_rows"] = $this->site_model->count_data("posts");
        $config["per_page"] = 10;
        $config["uri_segment"] = 2;
        $choice = $config["total_rows"] / $config["per_page"];
    	$config["num_links"] = round($choice);
		$config['full_tag_open'] = '<ul class="pagination pagination-sm">'; 
		$config['full_tag_close'] = '</ul>'; 
		$config['num_tag_open'] = '<li>'; 
		$config['num_tag_close'] = '</li>'; 
		$config['cur_tag_open'] = '<li class="active"><span>'; 
		$config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>'; 
		$config['prev_tag_open'] = '<li>'; 
		$config['prev_tag_close'] = '</li>'; 
		$config['next_tag_open'] = '<li>'; 
		$config['next_tag_close'] = '</li>'; 
		$config['first_link'] = '&laquo;'; 
		$config['prev_link'] = '&lsaquo;'; 
		$config['last_link'] = '&raquo;'; 
		$config['next_link'] = '&rsaquo;'; 
		$config['first_tag_open'] = '<li>'; 
		$config['first_tag_close'] = '</li>'; 
		$config['last_tag_open'] = '<li>'; 
		$config['last_tag_close'] = '</li>';
 
        $this->pagination->initialize($config);
 
        $pg = isset( $pg ) ? $pg : 0;
        $data["blogs"] = $this->site_model->get_all_blog($config['per_page'], $pg);
        $data["links"] = $this->pagination->create_links();


        $data['categories'] = $this->site_model->get_all_category();
        $data['last_blogs'] = $this->site_model->get_all_blog(5,0);

        $page['breadcrumb']	=	$this->breadcrumb->render();
		$page['content']	=	$this->load->view("blog_content",$data,true);

		$this->_output($page);
	}


/**
 * FUNGSI BLOG
 *
 */

	public function category( $id,$pg="" )
	{

		if( isset( $id ) )
		{
			
			$category =  array();

			if( $id == 0 ){

				$cat=  new stdClass();
				$cat->category_name =  "Uncategorized";
				$cat->id_category = 0;

				array_push($category, $cat);

			}else{
				$category = $this->site_model->get_category( $id );
			}

			$page['title']		=	ucfirst($category[0]->category_name)." | RS. DR. AK Gani";

			//$pg = ( trim($pg) == "" ? 0 : $pg );

			$config = array();
	        $config["base_url"] = base_url() . "category/".$id;
	        $config["total_rows"] = $this->site_model->count_blog_by_cat($id);
	        $config["per_page"] = 10;
	        $config["uri_segment"] = 3;
	        $config['full_tag_open'] = '<ul class="pagination pagination-sm">'; 
			$config['full_tag_close'] = '</ul>'; 
			$config['num_tag_open'] = '<li>'; 
			$config['num_tag_close'] = '</li>'; 
			$config['cur_tag_open'] = '<li class="active"><span>'; 
			$config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>'; 
			$config['prev_tag_open'] = '<li>'; 
			$config['prev_tag_close'] = '</li>'; 
			$config['next_tag_open'] = '<li>'; 
			$config['next_tag_close'] = '</li>'; 
			$config['first_link'] = '&laquo;'; 
			$config['prev_link'] = '&lsaquo;'; 
			$config['last_link'] = '&raquo;'; 
			$config['next_link'] = '&rsaquo;'; 
			$config['first_tag_open'] = '<li>'; 
			$config['first_tag_close'] = '</li>'; 
			$config['last_tag_open'] = '<li>'; 
			$config['last_tag_close'] = '</li>';
	 
	        $this->pagination->initialize($config);
	 
	        $pg = ( trim($pg) == "" ? 0 : $pg );
	        $data["blogs"] = $this->site_model->get_blog_by_category($id, $config["per_page"] , $pg );
	        $data["links"] = $this->pagination->create_links();
	        $data['categories'] = $this->site_model->get_all_category();
	        $data['last_blogs'] = $this->site_model->get_all_blog(5,0);

	        $this->breadcrumb->add( array("link"=>"#","label"=>"Kategori") );
	        $this->breadcrumb->add( array("link"=>"#","label"=>$category[0]->category_name) );

			$page['content']	=	$this->load->view("blog_content",$data,true);
			$page['breadcrumb']	=	$this->breadcrumb->render();

			$this->_output($page);
		}
		else
		{
			redirect("blog");
		}

	}

	public function page($id)
	{
		if( isset( $id ) )
		{
			
			$data["page"] = $this->site_model->get_page( $id );

			$page['title']		=	ucfirst($data["page"]->judul_halaman)." | RS. DR. AK Gani";

	        $this->breadcrumb->add( array("link"=>"#","label"=>ucwords("Halaman")) );
			$this->breadcrumb->add( array("link"=>"#","label"=> ucwords($data["page"]->judul_halaman)) );


			$page['content']	=	$this->load->view("page",$data,true);
			$page['breadcrumb']	=	$this->breadcrumb->render();

			$this->_output($page);
		}
		else
		{
			redirect("blog");
		}
	}

	public function read( $id )
	{
		if( isset( $id ) )
		{
			$this->breadcrumb = new Breadcrumb();
			$this->breadcrumb->add( array("link"=>site_url("blog"),"label"=>"blog") );
			$this->breadcrumb->add( array("link"=>"#","label"=>$id) );
			
	        $data['categories'] = 	$this->site_model->get_all_category();
	        $data['blog']		=	$this->site_model->get_post( $id );
	        $data['last_blogs'] = $this->site_model->get_all_blog(5,0);
			$page['title']		=	$data['blog']->blog_title." | Blog";

			$page['breadcrumb'] = 	$this->breadcrumb->render();
			$page['content']	=	$this->load->view("blog_read",$data,true);

			$this->_output($page);
		}
		else
		{
			redirect("blog");
		}
	}


	public function promosi($promosi=""){
		
		if( isset( $promosi ) || trim($promosi) == "" ){

			$page['title']		=	"Blog | RS. DR. AK Gani";


			$this->breadcrumb = new Breadcrumb();
			$this->breadcrumb->add( array("link"=>site_url("promosi"),"label"=>"Promosi") );

			$config = array();
	        $config["base_url"] = base_url("promosi/");
	        $config["total_rows"] = $this->site_model->count_data("promosi");
	        $config["per_page"] = 10;
	        $config["uri_segment"] = 3;
	        $choice = $config["total_rows"] / $config["per_page"];
	    	$config["num_links"] = round($choice);
	 
	        $this->pagination->initialize($config);
	 
	        $pg = isset( $pg ) ? $pg : 0;
	        $data["promotion"] = $this->site_model->get_all_promo(5, $pg);
	        $data["links"] = $this->pagination->create_links();

	        $page['breadcrumb']	=	$this->breadcrumb->render();
			$page['content']	=	$this->load->view("promosi",$data,true);

			$this->_output($page);
		}else{
			redirect("");
		}
	}

	public function read_promosi($promosi=""){
		
		if( isset( $promosi ) || trim($promosi) == "" ){

			$this->breadcrumb = new Breadcrumb();
			$this->breadcrumb->add( array("link"=>site_url('site/promosi'),"label"=>"Promosi") );
			$this->breadcrumb->add( array("link"=>"#","label"=>"Baca Promosi") );
			
	        $data['promosi'] = 	$this->site_model->get_promo($promosi);

			$page['breadcrumb'] = 	$this->breadcrumb->render();
			$page['title']		=	$data['promosi']->judul_promosi;
			$page['content']	=	$this->load->view("promosi_read",$data,true);

			$this->_output($page);
		}else{
			redirect("");
		}
	}

	


}