<?php 

class TemplateRender
{
	private $_CI;
	private $stylesheet_sources = array();
	private $script_sources = array();
	private $scripts = array();
	private $stylesheets = array();

	public function __construct()
	{
		$this->_CI = &get_instance();
		$this->_CI->load->library("menu");
	}


	public function add_script_sources( $script_source )
	{
		$in_scripts = false;

		foreach ($this->script_sources as $key => $src) {
			
			if( $src == $script_source ){
				$in_scripts = true;
			}
		}

		if($in_scripts == false){
            $this->script_sources[] = '<script type="text/javascript" src="'.$script_source.'"></script>';
        }
	}

	public function add_script( $script )
	{	
		$in_scripts = false;

		foreach ($this->scripts as $key => $src) {
			
			if( $src == $script ){
				$in_scripts = true;
			}
		}

		if($in_scripts == false){
            $this->scripts[] = '<script type="text/javascript" >'.$script.'</script>';
        }
	}

	public function add_stylesheet_sources( $stylesheet )
	{
		$in_stylesheet = false;

		foreach ($this->stylesheet_sources as $key => $style) {
			
			if( $style == $stylesheet ){
				$in_stylesheet = true;
			}
		}

		if($in_stylesheet == false){
            $this->stylesheet_sources[] = '<link href="'.$stylesheet.'" rel="stylesheet" />';
        }
	}

	public function render( $target, $target_data, $page,$parent_menu="dashboard",$sub_menu) 
	{

		$s_data['title'] 				=	 $page->get_title();
		$s_data['description']		=	 $page->get_description();
		$s_data['small_description']	=	 $page->get_small_description();
		$s_data['meta']				=	 $page->get_meta();
		$s_data['menus']				=	$this->_CI->menu->get_menus($parent_menu,$sub_menu);
		$s_data['stylesheets']	= join('',$this->stylesheet_sources);
		$s_data['scripts']	= join('',$this->scripts);
		$s_data['script_sources'] = join('',$this->script_sources);

		$s_data['content'] = $this->_CI->load->view($target,$target_data,TRUE);
		$this->_CI->load->view("template",$s_data);
	}
}




/* */
