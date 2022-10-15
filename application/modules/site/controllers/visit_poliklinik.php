<?php


class visit_poliklinik extends MY_Controller{

	public function __construct(){

		parent::__construct();
		$this->load->model( array("site_model","m_layanan") );
		$this->load->library( array("breadcrumb") );

		$this->breadcrumb = new Breadcrumb();
		$this->breadcrumb->add( array("link"=>'#',"label"=>"Services") );
		$this->breadcrumb->add( array("link"=>site_url("site/visit_poliklinik"),"label"=>"Registrasi Online") );

	}

	public function index(){

		$data['last_asks']	=	$this->site_model->get_all_ask(10,0);
		$data['poliklinik']	=	$this->m_layanan->getAll("poliklinik");
		$content_view = $this->load->view("daftar_poli",$data,TRUE);
		$data = array( "title" => "Registrasi Online | Rumah Sakit dr. AK Gani Palembang",
						"content" => $content_view,
						"breadcrumb" => $this->breadcrumb->render(),
					 );

		$this->_output( $data );

	}


	public function submit(){

			$json_data = array();

			$this->load->library("form_validation");
			
			$form_rules = array(
									array(
										'field' => 	'id_pasien',
										'label' =>	'nama',
										'rules'	=>	'required|xss_clean'
									),
									array(
										'field' => 	'id_poliklinik',
										'label' =>	'email',
										'rules'	=>	'xss_clean|email|required'
									),		
							);	

			$this->form_validation->set_rules( $form_rules );

			if( $this->form_validation->run() != FALSE ){

				$kunjungan_poli['id_pasien'] 			=	$this->input->post("id_pasien",TRUE);
				$kunjungan_poli['id_poli'] 				=	$this->input->post("id_poliklinik",TRUE);

				//check pasien

				$pasien = $this->m_layanan->getOne("pasien",array("id_pasien"=>$kunjungan_poli['id_pasien']));

				//jika kode pasien benar
				if( count($pasien) > 0 ){

					$kunjungan_poli['no_urut'] 				=	$this->m_layanan->generateNoUrut( date("Y-m-d") , $kunjungan_poli['id_poli'] );
					$kunjungan_poli['tanggal_kunjungan'] 	=	date("Y-m-d");
					$kunjungan_poli['confirmation'] 		=	random_string("numeric",5);
					$kunjungan_poli['isConfirmed'] 			=	0;

					$kunjgn = array("id_pasien"=>$kunjungan_poli['id_pasien'],
																 "id_poli"  => $kunjungan_poli['id_poli'],
																 "tanggal_kunjungan" => $kunjungan_poli['tanggal_kunjungan']
															);


					if( $this->m_layanan->getOne("kunjungan_poli",$kunjgn)  ){
						$json_data['status'] 	= 	"fail";
						$json_data['message']	=	'<div class="alert alert-error">
										<button class="close" data-dismiss="alert"></button>
										<strong>ID Pasien Salah.!</strong> Anda sudah terdaftar!. 
									</div>';
					}else{
						if( $this->m_layanan->insert( "kunjungan_poli", $kunjungan_poli ) ) {

							$sms = "No. Urut Anda : ".$kunjungan_poli['no_urut'];
							$sms .= "\nKode Konfirmasi : ".$kunjungan_poli['confirmation'];

							$this->m_layanan->send_sms( array($pasien[0]->no_telp), $sms );
								$json_data['status'] 	= 	"success";
								$json_data['message']	=	'<div class="alert alert-success">
									<button class="close" data-dismiss="alert"></button>
									<strong>Berhasil!</strong> No.Urut & kode konfirmasi telah kami kirim kan ke nomor telepon anda yang terdaftar . 
								</div>';
						}		
						else{
							
							$json_data['status'] 	= 	"fail";
							$json_data['message']	=	'<div class="alert alert-error">
									<button class="close" data-dismiss="alert"></button>
									<strong>Gagal.!</strong> Terjadi kesalahan sistem. 
								</div>';
						}
					}


				}
				//jika kode pasien salah
				else{
					$json_data['status'] 	= 	"fail";
					$json_data['message']	=	'<div class="alert alert-error">
									<button class="close" data-dismiss="alert"></button>
									<strong>ID Pasien Salah.!</strong> Mohon periksa lagi ID Pasien Anda. 
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

	private function _output( $output_data )
	{	$output_data['menus']		=	$this->_build_menu();
		//$output_data['categories']	=	$this->site_model->get_all_category();
		$this->load->view("template",$output_data);
	}

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

}


