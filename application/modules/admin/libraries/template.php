<?php 
class Template {
protected $_ci;
function __construct (){

	$this->_ci=&get_instance();
	
	
}

function display ($template,$data=null,$isPlain=false){
$data->isPlain = $isPlain;
$data->content=$this->_ci->load->view($template,$data,true);
$this->_ci->load->view('template',$data);
}

}