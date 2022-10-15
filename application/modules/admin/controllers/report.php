<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class report extends MY_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->library( array( "template" , "auth" , "menu","breadcrumb" ,"RPdf") );
		$this->load->helper("post_date_helper");
		$this->load->model( array("m_layanan","report_model") );
		$this->breadcrumb = new Breadcrumb();
		$this->breadcrumb->add( array("link"=>site_url("admin/report"),"label"=>"laporan") );


		     /* to grant access to the controller. */
        $this->controller = "report";
        $this->grant_access();
	}

	public function index(){
		if( $this->auth->_is_admin_logged_in() ){
			$output = new stdClass();
			$output->output 		= $this->load->view("report/report_main",null,TRUE);
			$output->breadcrumb 	= $this->breadcrumb->render();
			$this->output( $output,TRUE );		
		}
		else{
			redirect("admin/login");
		}
	}

	public function kunjungan_poli(){
		if( $this->auth->_is_admin_logged_in() ){
			$output = new stdClass();
			$output->output 		= $this->load->view("report/poli_report",null,TRUE);

			$this->breadcrumb->add( array("link"=>site_url("admin/report/kunjungan_poli"),"label"=>"Laporan Kunjungan Poliklinik") );
			$output->breadcrumb 	= $this->breadcrumb->render();
			$this->output( $output,TRUE );		
		}
		else{
			redirect("admin/login");
		}
	}

	public function loyalitas(){
		if( $this->auth->_is_admin_logged_in() ){
			$output = new stdClass();
			$output->output 		= $this->load->view("report/loyalitas",null,TRUE);

			$this->breadcrumb->add( array("link"=>site_url("admin/report/loyalitas"),"label"=>"Laporan Loyalitas Pasien") );
			$output->breadcrumb 	= $this->breadcrumb->render();
			$this->output( $output,TRUE );		
		}
		else{
			redirect("admin/login");
		}
	}

	public function print_feedback(){
		if( $this->auth->_is_admin_logged_in() ){
			$output = new stdClass();
			$output->output 		= $this->load->view("report/feedback",null,TRUE);

			$this->breadcrumb->add( array("link"=>site_url("admin/report/print_feedback"),"label"=>"Cetak Kritik & Saran") );
			$output->breadcrumb 	= $this->breadcrumb->render();
			$this->output( $output,TRUE );		
		}
		else{
			redirect("admin/login");
		}
	}
	private function generate_report_feedback_table($start,$end){
			
			$table =  '	<table class="table table-striped table-bordered table-advance table-hover">
									<thead>
										<tr>
											<th>#</th>
											<th>Jenis</th>
											<th>Email</th>
											<th>Topik</th>
											<th>Isi</th>
											<th>Via</th>
											<th>Tanggal</t>
										</tr>
									</thead>
									<tbody>';

            $feedbacks = $this->report_model->laporan_feedback($start,$end);

            $counter = 1;
            foreach ($feedbacks as $key => $feed) {
            	$table .= '<tr>';
				$table .= '<td>'.$counter.'</td>';
				$table .= '<td>'.$feed->type.'</td>';
				$table .= '<td>'.$feed->email.'</td>';
				$table .= '<td>'.$feed->perihal.'</td>';
				$table .= '<td>'.$feed->isi.'</td>';
				$table .= '<td>'.$feed->via.'</td>';
				$table .= '<td>'.$feed->time.'</td>';
				$table .= '</tr>';
            	$counter++;
            		
            }
                          
            $table .='</tbody>
                     </table>';


            return $table;		
	}

	private function generate_report_poli_table($start,$end){
			
			$table =  '	<table class="table table-striped table-bordered table-advance table-hover">
									<thead>
										<tr>
											<th>#</th>
											<th>ID Pasien</th>
											<th>Nama</th>
											<th>Umur</th>
											<th>Jenis Kelamin</th>
											<th>Poliklinik</th>
										</tr>
									</thead>
									<tbody>';

            $kunjungan = $this->report_model->laporan_kunjungan($start,$end);

            $counter = 1;
            foreach ($kunjungan['main_data'] as $key => $poli) {
            	$table .= '<tr>';
				$table .= '<td>'.$counter.'</td>';
				$table .= '<td>'.$poli->id_pasien.'</td>';
				$table .= '<td>'.$poli->nama_pasien.'</td>';
				$table .= '<td>'.$poli->umur.'</td>';
				$table .= '<td>'.$poli->jenis_kelamin.'</td>';
				$table .= '<td>'.$poli->nama_poliklinik.'</td>';
				$table .= '</tr>';
            	$counter++;
            		
            }
                          
            $table .='</tbody>
                     </table>';


            return $table;		
	}


	private function fill_poli_report($start,$end){
			
			
            $table = "<h4>Rekapitulasi Data Pengunjung Poliklinik</h4>";

			$table .=  '<table cellspacing="0" cellpadding="4" border="1">
                           <thead style="background:#aee5f8;">
                              <tr>
											<th width="5%" align="center">#</th>
											<th width="15%" align="center">ID Pasien</th>
											<th width="30%" align="center">Nama</th>
											<th width="10%" align="center">Umur</th>
											<th width="10%" align="center">Jenis Kelamin</th>
											<th width="30%" align="center">Poliklinik</th>
                              </tr>
                           </thead>
                           <tbody>';

            $kunjungan = $this->report_model->laporan_kunjungan($start,$end);


            $counter = 1;
            foreach ($kunjungan['main_data'] as $key => $poli) {
            	$table .= '<tr>';
				$table .= '<td width="5%">'.$counter.'</td>';
				$table .= '<td width="15%">'.$poli->id_pasien.'</td>';
				$table .= '<td width="30%">'.$poli->nama_pasien.'</td>';
				$table .= '<td width="10%" align="center">'.$poli->umur.'</td>';
				$table .= '<td width="10%">'.$poli->jenis_kelamin.'</td>';
				$table .= '<td width="30%">'.$poli->nama_poliklinik.'</td>';
				$table .= '</tr>';

            	$counter++;
            		
            }

                          
            $table .='</tbody>
                     </table>';


            $table .= "</br></br>";
            $table .= "<h4>Rangkuman</h4>";

			$table .=  '<table cellspacing="0" cellpadding="4" border="1">
                           <tbody>';

            $counter = 1;
            foreach ($kunjungan['resume'] as $key => $poli) {
            	$table .= '<tr>';
				$table .= '<td width="40%">'.$poli->label.'</td>';
				$table .= '<td width="10%" align="center">'.$poli->total.'</td>';
				$table .= '</tr>';

            	$counter++;
            		
            }

            $table .='</tbody>
                     </table>';

            return $table;
	}

	private function fill_loyal_report($start,$end){
			
			
            $table = "<h4>Laporan Loyalitas Pasien</h4>";

			$table .=  '<table width="100%" cellspacing="0" cellpadding="4" border="1">
                           <thead style="background:#aee5f8;">
								<tr>
									<th valign="middle" rowspan="2" align="center" width="5%">No</th>
									<th valign="middle" rowspan="2" align="center" width="10%">Id Pasien</th>
									<th valign="middle" rowspan="2" align="center" width="30%">Nama</th>
									<th valign="middle" rowspan="2" align="center" width="10%">Jenis Kelamin</th>
									<th valign="middle" rowspan="2" align="center" width="15%">No. Telp</th>
									<th valign="middle" colspan="2" align="center" width="20%">Kunjungan</th>
									<th valign="middle" rowspan="2" align="center" width="10%">Kunjungan Terakhir</th>
								</tr>
								<tr>
									<td align="center" width="10%">Periode Ini</td>
									<td align="center" width="10%">Total</td>
								</tr>
                           </thead>
                           <tbody>';

            $loyalitas = $this->report_model->loyalitas($start,$end);

            $counter = 1;
            foreach ($loyalitas as $key => $loyalistas) {
            	$table .= '<tr>';
				$table .= '<td align="center" width="5%">'.$counter.'</td>';
				$table .= '<td width="10%">'.$loyalistas->id_pasien.'</td>';
				$table .= '<td width="30%">'.$loyalistas->nama_pasien.'</td>';
				$table .= '<td align="center" width="10%">'.$loyalistas->jenis_kelamin.'</td>';
				$table .= '<td width="15%">'.$loyalistas->no_telp.'</td>';
				$table .= '<td align="center" width="10%">'.$loyalistas->periodeini.'</td>';
				$table .= '<td align="center" width="10%">'.$loyalistas->total.'</td>';
				$table .= '<td width="10%">'.format_date($loyalistas->terakhir).'</td>';
				$table .= '</tr>';
            	$counter++;
            		
            }

                          
            $table .='</tbody>
                     </table>';

            return $table;
	}

	private function fill_feedback_report($start,$end){
			
			$table = "<h4>Laporan Kritik & Saran</h4>";
			
			$table .=  '<table cellspacing="0" cellpadding="4" border="1">
                           <thead style="background:#aee5f8;">
                              <tr>
											<th width="5%" align="center">#</th>
											<th width="5%" align="center">Jenis</th>
											<th width="15%" align="center">Email</th>
											<th width="20%" align="center">Topik</th>
											<th width="30%" align="center">Isi</th>
											<th width="10%" align="center">Via</th>
											<th width="15%" align="center">Tanggal</th>
													
                              </tr>
                           </thead>
                           <tbody>';

            $feedbacks = $this->report_model->laporan_feedback($start,$end);

            $counter = 1;
            foreach ($feedbacks as $key => $feed) {
            	$table .= '<tr>';
				$table .= '<td width="5%" >'.$counter.'</td>';
				$table .= '<td width="5%">'.$feed->type.'</td>';
				$table .= '<td width="15%">'.$feed->email.'</td>';
				$table .= '<td width="20%">'.$feed->perihal.'</td>';
				$table .= '<td width="30%">'.$feed->isi.'</td>';
				$table .= '<td width="10%">'.$feed->via.'</td>';
				$table .= '<td width="15%">'.$feed->time.'</td>';
				$table .= '</tr>';
            	$counter++;
            		
            }
                          
            $table .='</tbody>
                     </table>';


            return $table;	
	}

	public function ambil_rpoli(){

		if( $this->auth->_is_admin_logged_in() ){

			$start 	= $this->input->post("start",TRUE);
			$end 	= $this->input->post("end",TRUE);

			$table = $this->generate_report_poli_table($start,$end);
			$this->session->set_userdata( array("start"=>$start,"end"=>$end) );

            echo $table;

		}else{
			echo "Session time out";
		}

	}


	public function generate_report_loyalitas_table($start,$end){
		
		if( $this->auth->_is_admin_logged_in() ){
			$table =  '	<table class="table table-striped table-bordered table-advance table-hover">
									<thead>
										<tr>
											<th rowspan="2" align="center" width="2%">No</th>
											<th rowspan="2" align="center" width="5%">Id Pasien</th>
											<th rowspan="2" align="center" width="7%">Nama</th>
											<th rowspan="2" align="center" width="5%">Jenis Kelamin</th>
											<th rowspan="2" align="center" width="5%">No. Telp</th>
											<th colspan="2" align="center" width="10%">Kunjungan</th>
											<th rowspan="2" align="center" width="5%">Kunjungan Terakhir</th>
										</tr>
										<tr>
											<td align="center" width="5%">Periode Ini</td>
											<td align="center" width="5%">Total</td>
										</tr>
									</thead>
									<tbody>';

            $loyalitas = $this->report_model->loyalitas($start,$end);

            $counter = 1;
            foreach ($loyalitas as $key => $loyalistas) {
            	$table .= '<tr>';
				$table .= '<td>'.$counter.'</td>';
				$table .= '<td>'.$loyalistas->id_pasien.'</td>';
				$table .= '<td>'.$loyalistas->nama_pasien.'</td>';
				$table .= '<td>'.$loyalistas->jenis_kelamin.'</td>';
				$table .= '<td>'.$loyalistas->no_telp.'</td>';
				$table .= '<td>'.$loyalistas->periodeini.'</td>';
				$table .= '<td>'.$loyalistas->total.'</td>';
				$table .= '<td>'.$loyalistas->terakhir.'</td>';
				$table .= '</tr>';
            	$counter++;
            		
            }
                          
            $table .='</tbody>
                     </table>';


            return $table;	
		}
		else{
			echo "Session time out";
		}

	}


	public function ambil_rloyalitas(){
		
		if( $this->auth->_is_admin_logged_in() ){

			$start 	= $this->input->post("start",TRUE);
			$end 	= $this->input->post("end",TRUE);

			$table = $this->generate_report_loyalitas_table($start,$end);
			$this->session->set_userdata( array("start"=>$start,"end"=>$end) );

            echo $table;

		}else{
			echo "Session time out";
			//redirect("admin/login");
		}		
	}

	public function ambil_rfeedback(){
		
		if( $this->auth->_is_admin_logged_in() ){

			$start 	= $this->input->post("start",TRUE);
			$end 	= $this->input->post("end",TRUE);

			$table = $this->generate_report_feedback_table($start,$end);
			$this->session->set_userdata( array("start"=>$start,"end"=>$end) );

            echo $table;

		}else{
			echo "Session time out";
			//redirect("admin/login");
		}		
	}

	public function report_poli(){

		$start 		= 	$this->session->userdata("start");
		$end   		= 	$this->session->userdata("end");	

		$subtitle 	= 	"Periode ".format_date($start)." - ".format_date( $end );
		$fill 		=	$this->fill_poli_report($start,$end);

		$this->pdf( "L", "Rekapitulasi Kunjungan Poli", $subtitle, $fill );

	}

	public function report_loyalitas(){

		$start 		= 	$this->session->userdata("start");
		$end   		= 	$this->session->userdata("end");	

		$subtitle 	= 	"Periode ".format_date($start)." - ".format_date( $end );
		$fill 		=	$this->fill_loyal_report($start,$end);

		$this->pdf( "L", "Laporan Loyalitas Pasien", $subtitle, $fill );

	}

	public function report_feedback(){

		$start 		= 	$this->session->userdata("start");
		$end   		= 	$this->session->userdata("end");	

		$subtitle 	= 	"Periode ".format_date($start)." - ".format_date( $end );
		$fill 		=	$this->fill_feedback_report($start,$end);

		$this->pdf( "L", "Laporan Kritik & Saran", $subtitle, $fill );

	}


	private function pdf( $orientation, $title, $subtitle, $fill ){

		$pdf = new TCPDF( $orientation , PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  

		$start = $this->session->userdata("start");
		$end   = $this->session->userdata("end");		

		// set document information
	    $pdf->SetCreator(PDF_CREATOR);
	 
	    // set default header data
	    $pdf->SetHeaderData(NULL, NULL, $title, 
	    					$subtitle, 
	    					array(0,0,0), 
	    					array(0,0,0));


	    $pdf->setFooterData(array(0,64,0), array(0,64,128)); 
	 
	    // set header and footer fonts
	    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
	 
	    // set default monospaced font
	    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED); 
	 
	    // set margins
	    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);    
	 
	    // set auto page breaks
	    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM); 
	 
	    // set image scale factor
	    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);  
	 
	    // set some language-dependent strings (optional)
	    if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	        require_once(dirname(__FILE__).'/lang/eng.php');
	        $pdf->setLanguageArray($l);
	    }   
	 
	    // ---------------------------------------------------------    
	 
	    // set default font subsetting mode
	    $pdf->setFontSubsetting(true);   
	 
	    // Set font
	    // dejavusans is a UTF-8 Unicode font, if you only need to
	    // print standard ASCII chars, you can use core fonts like
	    // helvetica or times to reduce file size.
	    $pdf->SetFont('dejavusans', '', 10, '', true);   
	 
	    // Add a page
	    // This method has several options, check the source code documentation for more information.
	    $pdf->AddPage(); 
	 
	    // set text shadow effect
	    $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));    
	 
	    // Set some content to print
	    $html = $fill;
	 
	    // Print text using writeHTMLCell()
	    $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);   
	 
	    // ---------------------------------------------------------    
	 
	    // Close and output PDF document
	    // This method has several options, check the source code documentation for more information.
	    $report_name = 'laporan '.date("Y-m-d").'.pdf';
	    ob_end_clean();
	    $pdf->Output($report_name, 'I');    

	    //$this->session->unset_userdata("start");
	    //$this->session->unset_userdata("end");
	}


	private function output($output,$isPlain=false){
		if( $this->auth->_is_admin_logged_in() )
		{
			$output->title = "Laporan | Admin";
			$output->page_title='Laporan';
			$output->description='';
			$output->menus = $this->menu->get_menus( 'Laporan'  );
			$this->template->display("content",$output,$isPlain);
		}
		else{
			redirect( site_url("admin/login") );
		}
	}
}