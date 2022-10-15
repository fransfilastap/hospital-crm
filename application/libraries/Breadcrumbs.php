<?php

Class Breadcrumbs{

	private var $home_text;
	private var $home_link;
	private var $separator;
	private var $crumbs = array();
	private var $bread ="";

	public function __construct()
	{
		$this->home_text = "Home";
		$this->home_link = site_url("admin");
		$this->separator = "&raquo;";
	}

	public function add_crumbs($crumb_text,$crumb_link)
	{
		$in_crumbs = false;

		//check wether this crumb is already in crumbs

		foreach ($this->crumbs as $crumb) {
			
			if( $crumb['crumb'] == $crumb_text ){
				$in_crumbs = true;
			}

			if( $crumb['link'] == $crumb_link )
			{
				$in_crumbs = true;
			}
		}

		if($in_crumbs == false){
            $this->crumbs[] = array('crumb'=>$this_crumb,'link'=>$this_link);
        }
	}

	public function build_bread()
	{
		$sandwich = $this->crumbs;
        $slices = array();
        $slices[] = '<a href="' . $this->home_link . '"''>' . $this->home_text . '</a>';
        foreach($sandwich as $slice){
            if (isset($slice['link']) && $slice['link'] != '') {
                $slices[] = '<a href="' . $slice['link'] . '">' . $slice['crumb'] . '</a>';
            } else {
                $slices[] = $slice['crumb'];
            }    
        }
        $this->bread = join($this->seperator, $slices);
	}

	public function get_breadcrumbs()
	{
		if( isset($this->bread) && $this->bread != '' )
		{
			return $this->bread;
		}

		$this->build_bread();
		return $this->bread();

	}

}