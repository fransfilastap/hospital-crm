<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class smsgateaway extends MY_Controller{


	public function __construct(){
		parent::__construct();
		$this->load->library( array( "template" , "auth" , "menu" , "grocery_CRUD","Breadcrumb" ) );
		$this->load->model( "m_layanan","smsdata" );
		$this->breadcrumb = new Breadcrumb();
		$this->breadcrumb->add( array("link"=>site_url("admin/smsgateaway"),"label"=>"SMS Gateaway") );


		     /* to grant access to the controller. */
        $this->controller = "smsgateaway";
        $this->grant_access( $this->controller , $this->session->userdata("current_admin_role") );
	}

	public function index(){

		if( $this->auth->_is_admin_logged_in() ){
			
			redirect("admin/smsgateaway/inbox");

		}
		else{
			redirect("admin/login");
		}

	}


	public function kirim_sms(){
		
		if( $this->auth->_is_admin_logged_in() )
		{
			$output = new stdClass();
			$data['contacts']		=	$this->smsdata->get_contacts();
			$data['groups']			=	$this->smsdata->getAll("pbk_groups");

			$output->output 		= $this->load->view("sms/send_sms_full",$data,TRUE);
			$output->menus = $this->menu->get_menus( 'Kirim SMS'  );

			$this->breadcrumb->add( array("link"=>'#',"label"=>"Kirim Pesan") );

			$output->breadcrumb 	= $this->breadcrumb->render();
			$this->output( $output,TRUE );	
		} 
		else{
			redirect("admin/login");
		}
	}

	public function proses_kirim(){
		
		if( $this->auth->_is_admin_logged_in() )
		{
			
			$this->load->library("form_validation");
			
			$form_rules = array(
									array(
										'field' => 	'no_telp',
										'label' =>	'no_telp',
										'rules'	=>	'xss_clean|required'
									),
									array(
										'field' => 	'isi_sms',
										'label' =>	'isi_sms',
										'rules'	=>	'xss_clean|required'
									),	
							);	

			$this->form_validation->set_rules( $form_rules );

			if( $this->form_validation->run() != FALSE ){

				$json_data  = array();

				$nomor		=	$this->input->post("no_telp",TRUE);
				$sms		=	$this->input->post("isi_sms",TRUE);

				//potong yg terakhir
				$number = array();
				$array_nomor = 	explode(';', $nomor);

				if( count( $array_nomor ) > 1 ){
					$number 		 =	array_slice( $array_nomor, 0, count( $array_nomor ) - 1 );   ;
				}else{
					$number = $array_nomor;
				}

				if( $this->smsdata->send_sms( $number, $sms ) ){

					$json_data["status"]	=	"success";
					$json_data["message"]	=	'								<div class="alert alert-success">
									<button class="close" data-dismiss="alert"></button>
									<strong>Pesan Terikirim</strong> 
								</div>';

				}else{

					$json_data["status"]	=	"fail";
					$json_data["message"]	=	'								<div class="alert alert-error">
									<button class="close" data-dismiss="alert"></button>
									<strong>Error!</strong> Tidak dapat menirim pesan.
								</div>';

				}


			}
			else
			{
				$json_data["status"]	=	"fail";
				$json_data["message"]	=	validation_errors();
			}
			
			echo json_encode( $json_data );

		} 
		else{
			redirect("admin/login");
		}


	}

	public function proses_kirim_group(){
		if( $this->auth->_is_admin_logged_in() )
		{
			
			$this->load->library("form_validation");
			
			$form_rules = array(
									array(
										'field' => 	'group',
										'label' =>	'group',
										'rules'	=>	'xss_clean|required'
									),
									array(
										'field' => 	'isi_sms',
										'label' =>	'isi_sms',
										'rules'	=>	'xss_clean|required'
									),	
							);	

			$this->form_validation->set_rules( $form_rules );

			if( $this->form_validation->run() != FALSE ){

				$json_data  = array();

				$group		=	$this->input->post("group",TRUE);
				$sms		=	$this->input->post("isi_sms",TRUE);

				//potong yg terakhir
				$numbers 	=	$this->smsdata->get_contacts($group);
				$nomor 		=	array();

				foreach ($numbers as $key => $number) {
					array_push($nomor, $number->Number);
				}


				if( $this->smsdata->send_sms( $nomor, $sms ) ){

					$json_data["status"]	=	"success";
					$json_data["message"]	=	'								<div class="alert alert-success">
									<button class="close" data-dismiss="alert"></button>
									<strong>Pesan Terikirim</strong> 
								</div>';

				}else{

					$json_data["status"]	=	"fail";
					$json_data["message"]	=	'								<div class="alert alert-error">
									<button class="close" data-dismiss="alert"></button>
									<strong>Error!</strong> Tidak dapat menirim pesan.
								</div>';

				}

			}
			else
			{
				$json_data["status"]	=	"fail";
				$json_data["message"]	=	validation_errors();
			}
			
			echo json_encode( $json_data );

		} 
		else{
			redirect("admin/login");
		}		
	}

	public function send(){
		if( $this->auth->_is_admin_logged_in() )
		{
			$output = new stdClass();

			$output->output 		= $this->load->view("sms/list_inbox",$data,TRUE);
			$output->menus = $this->menu->get_menus( 'Kotak Masuk'  );
			$output->breadcrumb 	= $this->breadcrumb->render();
			$this->output( $output,TRUE );	
		} 
		else{
			redirect("admin/login");
		}
	}

	function forward($id){
		if( $this->auth->_is_admin_logged_in() )
		{
			$output = new stdClass();
			$data['contacts']		=	$this->smsdata->get_contacts();
			$data['groups']			=	$this->smsdata->getAll("pbk_groups");
			$x						=	$this->smsdata->getOne("sentitems",array("ID"=>$id));
			$data['text']			=	$x[0]->TextDecoded;

			$output->output 		= $this->load->view("sms/send_sms_full",$data,TRUE);
			$output->menus = $this->menu->get_menus( 'Kirim SMS'  );

			$this->breadcrumb->add( array("link"=>'#',"label"=>"Teruskan Pesan") );

			$output->breadcrumb 	= $this->breadcrumb->render();
			$this->output( $output,TRUE );		
		} 
		else{
			redirect("admin/login");
		}
	}

	function forward_inbox($id){
		if( $this->auth->_is_admin_logged_in() )
		{
			$output = new stdClass();
			$data['contacts']		=	$this->smsdata->get_contacts();
			$data['groups']			=	$this->smsdata->getAll("pbk_groups");
			$x						=	$this->smsdata->getOne("inbox",array("ID"=>$id));
			$data['text']			=	$x[0]->TextDecoded;

			$output->output 		= $this->load->view("sms/send_sms_full",$data,TRUE);
			$output->menus = $this->menu->get_menus( 'Kirim SMS'  );

			$this->breadcrumb->add( array("link"=>'#',"label"=>"Teruskan Pesan") );

			$output->breadcrumb 	= $this->breadcrumb->render();
			$this->output( $output,TRUE );		
		} 
		else{
			redirect("admin/login");
		}
	}

	public function inbox(){
		
		if( $this->auth->_is_admin_logged_in() )
		{
			$output = new stdClass();
			$output->output 		= $this->load->view("sms/list_inbox",null,TRUE);
			$output->menus = $this->menu->get_menus( 'Kotak Masuk'  );

			$this->breadcrumb->add( array("link"=>'#',"label"=>"Kotak Masuk") );

			$output->breadcrumb 	= $this->breadcrumb->render();
			$this->output( $output,TRUE );	
		} 
		else{
			redirect("admin/login");
		}
	}

	public function sent(){
		
		if( $this->auth->_is_admin_logged_in() )
		{
			$output = new stdClass();
			$output->output 		= $this->load->view("sms/list_sent",null,TRUE);

			$output->menus = $this->menu->get_menus( 'Pesan Terkirim'  );

			$this->breadcrumb->add( array("link"=>'#',"label"=>"Pesan Terkirim") );

			$output->breadcrumb 	= $this->breadcrumb->render();
			$this->output( $output,TRUE );	
		} 
		else{
			redirect("admin/login");
		}
	}


	public function inbox_list(){
		
		if( $this->auth->_is_admin_logged_in() )
		{
			$this->smsdata->get_inbox_list();
		} 
		else{
			redirect("admin/login");
		}
	}


	public function sentitems_list(){
		
		if( $this->auth->_is_admin_logged_in() )
		{
			$this->smsdata->get_sent_list();
		} 
		else{
			redirect("admin/login");
		}
	}

	public function get($tipe="view",$id){
		
		if( $this->auth->_is_admin_logged_in() )
		{
			$data['sms'] = $this->smsdata->getOne( 'inbox', array('id'=> $id ) );
			$modal = "";

			if( $tipe == "reply" ){
			
				$modal = $this->load->view("sms/reply",$data,TRUE);
			
			}
			else if( $tipe == "view" ){

				$modal = $this->load->view("sms/view_inbox",$data,TRUE);

			}
			else if( $tipe=="teruskan" ){

				$modal = $this->load->view("sms/forward",$data,TRUE);

			}

			echo $modal;			
		} 
		else{
			redirect("admin/login");
		}		
	}

	public function inbox_delete($id){
		
		$json_data = array();

		if( $this->auth->_is_admin_logged_in() )
		{

			if( $this->smsdata->delete("inbox",array("ID"=>$id)) ){
				$json_data['status'] = 'success';
				$json_data['message']	=	"Pesan Telah dihapus";
			}else{
				$json_data['status'] = 'fail';
				$json_data['message']	=	"Pesan gagal dihapus";
			}

		} 
		else{
			$json_data['status'] = 'fail';
			$json_data['message']	=	"Session Time Out";
		}

		echo json_encode( $json_data );

	}

	public function sent_delete($id){
		
		$json_data = array();

		if( $this->auth->_is_admin_logged_in() )
		{

			if( $this->smsdata->delete("sentitems",array("ID"=>$id)) ){
				$json_data['status'] = 'success';
				$json_data['message']	=	"Pesan Telah dihapus";
			}else{
				$json_data['status'] = 'fail';
				$json_data['message']	=	"Pesan gagal dihapus";
			}

		} 
		else{
			$json_data['status'] = 'fail';
			$json_data['message']	=	"Session Time Out";
		}

		echo json_encode( $json_data );

	}


	public function get_sent($tipe="view",$id){
		
		if( $this->auth->_is_admin_logged_in() )
		{
			$data['sms'] = $this->smsdata->getOne( 'sentitems', array('id'=> $id ) );

			$modal = "";

			if( $tipe == "reply" ){
			
				$modal = $this->load->view("sms/reply",$data,TRUE);
			
			}
			else if( $tipe == "view" ){

				$modal = $this->load->view("sms/view_sent",$data,TRUE);

			}
			else if( $tipe=="teruskan" ){

				$modal = $this->load->view("sms/forward",$data,TRUE);

			}

			echo $modal;			
		} 
		else{
			redirect("admin/login");
		}		
	}

	function set_processed($id){
		if( $this->auth->_is_admin_logged_in() )
		{

			$this->smsdata->update( "inbox",array("processed"=>"true"),"ID", $id);

		} 
		else{
			echo "Session time out!";
		}		
	}

	function set_read($id){
		if( $this->auth->_is_admin_logged_in() )
		{

			$this->smsdata->update( "inbox",array("read"=>"true"),"ID", $id);

		} 
		else{
			echo "Session time out!";
		}		
	}	

	function set_notified($id){
		if( $this->auth->_is_admin_logged_in() )
		{

			$this->smsdata->update( "inbox",array("Notification"=>"notified"),"ID", $id);

		} 
		else{
			echo "Session time out!";
		}		
	}

	function set_appended($id){
		if( $this->auth->_is_admin_logged_in() )
		{

			$this->smsdata->update( "inbox",array("Notification"=>"bar"),"ID", $id);

		} 
		else{
			echo "Session time out!";
		}		
	}

	

	function get_push_inbox(){

		if( $this->auth->_is_admin_logged_in() )
		{

			$data = $this->smsdata->push_notification_message();

			echo json_encode( $data );

		} 
		else{
			echo "Session time out!";
		}		

	}

	function get_unread_message(){
		
		if( $this->auth->_is_admin_logged_in() )
		{

			$data = $this->smsdata->unread_messages();

			echo json_encode( $data );

		} 
		else{
			echo "Session time out!";
		}		
	}



	public function template(){
		if( $this->auth->_is_admin_logged_in() )
		{
			$output = new stdClass();
			$output->output 		= $this->load->view("sms/list_inbox",null,TRUE);
			$output->breadcrumb 	= $this->breadcrumb->render();
			$this->output( $output,TRUE );	
		} 
		else{
			redirect("admin/login");
		}
	}

	private function output($output,$isPlain=false){
		if( $this->auth->_is_admin_logged_in() )
		{
			$output->title = "SMS Gateaway | Admin";
			$output->page_title='SMS Gateaway';
			$output->description='';
			$this->template->display("content",$output,$isPlain);
		}
		else{
			redirect( site_url("admin/login") );
		}
	}

}