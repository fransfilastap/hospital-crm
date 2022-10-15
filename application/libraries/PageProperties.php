<?php 

class PageProperties {

	private  $title;
	private  $meta;
	private  $description;
	private  $small_description;


	public function __construct( $title="", $description="", $description="",$small_description="",$meta="" )
	{
		$this->title = $title;
		$this->description = $description;
		$this->small_description = $small_description;
		$this->meta = $meta;
	}

	public function set_title($title)
	{
		$this->title = $title;
	}

	public function set_description($desc)
	{
		$this->description = $desc;
	}

	public function set_small_description($s_description)
	{
		$this->small_description = $s_description;
	}

	public function set_meta($meta)
	{
		$this->meta = $meta;
	}

	public function get_title()
	{
		return $this->title;
	}

	public function get_description()
	{
		return $this->description;
	}

	public function get_small_description()
	{
		return $this->small_description;
	}

	public function get_meta()
	{
		return $this->meta;
	}

}