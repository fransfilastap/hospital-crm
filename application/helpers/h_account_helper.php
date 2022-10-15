<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if( !function_exists( 'current_pasien_name' ) )
{
	function current_pasien_name()
	{
		$ci = &get_instance();
		$ci->load->library('session');
		return ($ci->session->userdata("current_pasien_name"));
	}
}

if( !function_exists( 'current_admin_name' ) )
{
	function current_admin_name()
	{
		$ci = &get_instance();
		$ci->load->library('session');
		return ($ci->session->userdata("current_admin_name"));
	}
}