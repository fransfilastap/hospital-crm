<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class m_layanan extends CI_Model
{	
	
	public function __construct()
	{
		parent::__construct();
	}


	/**
	 * METHOD-METHOD GENERAL, UNTUK INSERT UPDATE DELETE TABLE APA PUN
	 *
	 */

	public function getAll($table){
		$query = $this->db->get($table);
		return $query->result();
	}

	public function getAllExcept($table,$whereExcept,$exceptValue){
		$this->db->select();
		$this->db->from($table);
		$this->db->where($whereExcept,$exceptValue);
		$query = $this->db->get();
		return $query->result();
	}

	public function delete( $table,array $where ){
		return $this->db->delete( $table, $where );
	}

	public function insert( $table,array $data){
		return $this->db->insert( $table, $data );
	}

	public function update( $table,array $data,$where_column, $where_value){
		$this->db->where( $where_column, $where_value );
		return $this->db->update( $table, $data );
	}


	public function getOne( $table, array $where  ){
		$query = $this->db->get_where($table,$where);
		return $query->result();
	}


	public function isExist($table,array $where){
		$this->db->select();
		$this->db->from($table);
		$this->db->where($where);
		$rResult = $this->db->get();


		return ( $rResult->num_rows() > 0 );
	}

	/**
	 * BEGIN
	 * -------------------------------------------------------------	
	 * METHOD-METHOD UNTUK MODUL LAYANAN > PROMOSI
	 *
	 */
	public function get_promo_list()
	{
		$sql = 'SELECT  promosi.id_promosi AS id_prom,
						judul_promosi,
						sms_promosi,
						tgl_promosi,
						web_promosi,
						(CASE WHEN COUNT(id_pasien) > 0 THEN "Sudah Disebar" ELSE "Belum Disebar" END) AS isSebar,
						COUNT(id_pasien) AS jumlah_target
					FROM promosi
					LEFT JOIN target_promosi 
						ON 
							target_promosi.id_promosi = promosi.id_promosi
				GROUP BY promosi.id_promosi';

		$query = $this->db->query( $sql );

		return $query->result_array();

	}

	/**
	 * Type 
	 *		all :
	 *
	 */
	public function insert_target_promosi($data, $type ){

		/*public static $T_ALL = 1;
		public static $T_FULL = 2;
		public static $T_AGE = 3;
		public static $T_GENDER = 4;
		public static $T_VISIT = 5;
		public static $T_VISIT_AGE = 6;
		public static $T_VISIT_GENDER = 7;
		public static $T_GENDER_AGE = 8;
		*/
		$sql = "";
		
		//semua pasien
		if( $type == 1  ){

			$sql = "SELECT id_pasien,no_telp FROM pasien";
		}
		//full custom
		else if( $type == 2 ){

			$poli = "";
		
			foreach ($data['poli'] as $key => $value) {
				$poli.="'$value'";
				if( $key!=count($data['poli']) - 1 )
					$poli .= ",";
			}
			

			$sql = "( SELECT DISTINCT pasien.id_pasien,pasien.nama_pasien,pasien.`no_telp` 
							FROM `kunjungan_poli` 
							LEFT JOIN 
								`pasien` ON 
									`pasien`.`id_pasien` = `kunjungan_poli`.`id_pasien` 
							RIGHT JOIN 
							( SELECT id_pasien,nama_pasien,no_telp FROM pasien
								WHERE 
									(DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(tanggal_lahir, '%Y') - (DATE_FORMAT(NOW(), '00-%m-%d') < DATE_FORMAT(tanggal_lahir, '00-%m-%d'))
								BETWEEN ".$data['umur_1']." AND ".$data['umur_2']." ) AND jenis_kelamin = '".$data['jenis_kelamin']."'
							) AS fTable
							ON fTable.id_pasien = pasien.id_pasien 
							WHERE `kunjungan_poli`.`id_poli` IN(".$poli.") )";
		}
		//berdasarkan umur
		else if( $type == 3 ){
			$sql = "SELECT id_pasien,nama_pasien,no_telp FROM pasien
								WHERE 
									(DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(tanggal_lahir, '%Y') - (DATE_FORMAT(NOW(), '00-%m-%d') < DATE_FORMAT(tanggal_lahir, '00-%m-%d'))
								BETWEEN ".$data['umur_1']." AND ".$data['umur_2']." )";
		}
		//berdasarkan gender
		else if( $type == 4 ){
			$sql = "SELECT id_pasien,nama_pasien,no_telp FROM pasien
								WHERE 
									jenis_kelamin = '".$data['jenis_kelamin']."'";		
		}
		//berdasarkan kunjungan
		else if( $type == 5 ){
			$poli = "";
		
			foreach ($data['poli'] as $key => $value) {
				$poli.="'$value'";
				if( $key!=count($data['poli']) - 1 )
					$poli .= ",";
			}
			

			$sql = "( SELECT DISTINCT pasien.id_pasien,pasien.nama_pasien,pasien.`no_telp` 
							FROM `kunjungan_poli` 
							LEFT JOIN 
								`pasien` ON 
									`pasien`.`id_pasien` = `kunjungan_poli`.`id_pasien` 
							WHERE `kunjungan_poli`.`id_poli` IN(".$poli.") )";	
		}
		//berdasarkan kunjungan dan umur
		else if( $type == 6 ){
			$poli = "";
		
			foreach ($data['poli'] as $key => $value) {
				$poli.="'$value'";
				if( $key!=count($data['poli']) - 1 )
					$poli .= ",";
			}
			

			$sql = "( SELECT DISTINCT pasien.id_pasien,pasien.nama_pasien,pasien.`no_telp` 
							FROM `kunjungan_poli` 
							LEFT JOIN 
								`pasien` ON 
									`pasien`.`id_pasien` = `kunjungan_poli`.`id_pasien` 
							RIGHT JOIN 
							( SELECT id_pasien,nama_pasien,no_telp FROM pasien
								WHERE 
									(DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(tanggal_lahir, '%Y') - (DATE_FORMAT(NOW(), '00-%m-%d') < DATE_FORMAT(tanggal_lahir, '00-%m-%d'))
								BETWEEN ".$data['umur_1']." AND ".$data['umur_2']." )
							) AS fTable
							ON fTable.id_pasien = pasien.id_pasien 
							WHERE `kunjungan_poli`.`id_poli` IN(".$poli.") )";		
		}

		//berdasarkan kunjungan dan gender
		else if( $type == 7 ){
			$poli = "";
		
			foreach ($data['poli'] as $key => $value) {
				$poli.="'$value'";
				if( $key!=count($data['poli']) - 1 )
					$poli .= ",";
			}
			

			$sql = "( SELECT DISTINCT pasien.id_pasien,pasien.nama_pasien,pasien.`no_telp` 
							FROM `kunjungan_poli` 
							LEFT JOIN 
								`pasien` ON 
									`pasien`.`id_pasien` = `kunjungan_poli`.`id_pasien` 
							RIGHT JOIN 
							( SELECT id_pasien,nama_pasien,no_telp FROM pasien
								WHERE 
									jenis_kelamin = '".$data['jenis_kelamin']."'
							) AS fTable
							ON fTable.id_pasien = pasien.id_pasien 
							WHERE `kunjungan_poli`.`id_poli` IN(".$poli.") )";		
		}
		//berdasarkan umur dan gender
		else if( $type == 8 ){
			$poli = "";
		
			foreach ($data['poli'] as $key => $value) {
				$poli.="'$value'";
				if( $key!=count($data['poli']) - 1 )
					$poli .= ",";
			}
			

			$sql = "SELECT id_pasien,nama_pasien,no_telp FROM pasien
								WHERE 
									(DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(tanggal_lahir, '%Y') - (DATE_FORMAT(NOW(), '00-%m-%d') < DATE_FORMAT(tanggal_lahir, '00-%m-%d'))
								BETWEEN ".$data['umur_1']." AND ".$data['umur_2']." ) AND jenis_kelamin = '".$data['jenis_kelamin']."'";		
		}
		else{
			$sql = "SELECT id_pasien,no_telp FROM pasien";			
		}

		$rResult = $this->db->query( $sql );


		$insert_data = array();

		foreach($rResult->result_array() as $aRow){

			array_push( $insert_data , array(	'id_promosi' => $data['id_promosi'],
												'id_pasien'  => $aRow['id_pasien'],
												'nomor_telp' => $aRow['no_telp'] )
			);

		}


		$this->db->insert_batch("target_promosi",$insert_data);


		$data_promo = $this->getOne("promosi",array("id_promosi"=>$data['id_promosi']));

		$this->db->distinct();
		$this->db->from("target_promosi");
		$this->db->where( array('id_promosi'=>$data['id_promosi']) );
		$rResultTarget = $this->db->get();

		$sms_batch = array();

		foreach($rResultTarget->result_array() as $aRow){

			array_push( $sms_batch , array(	'DestinationNumber' => $aRow['nomor_telp'],
											'TextDecoded'  => $data_promo[0]->sms_promosi,
											'CreatorID' => "CRM" )
			);

		}


		$this->db->insert_batch("outbox",$sms_batch);

		

		/*INSERT INTO outbox(DestinationNumber, TextDecoded, CreatorID) VALUES ('+62811000001', 'Hello World', 'Gammu'*/
		


	}

	/**
	 * END
	 * -------------------------------------------------------------	
	 * METHOD-METHOD UNTUK MODUL LAYANAN > PROMOSI
	 *
	 */

	/**
	 * BEGIN 
	 * -------------------------------------------------------------
	 * METHOD-METHOD UNTUK MODUL LAYANAN > KUNJUNGAN
	 *
	 */
	public function get_kunjungan_beta($date_range1 = "DATE(NOW())", $date_range2 ="DATE(NOW())",$poli)
    {
        
    	$aColumns = array("kunjungan_poli.id_pasien","nama_pasien","jenis_kelamin","id_kunjungan","isConfirmed","tanggal_kunjungan","confirmation","no_urut");

		$this->db->select( "pasien.nama_pasien,
						pasien.jenis_kelamin,
						kunjungan_poli.id_kunjungan,
						kunjungan_poli.id_pasien,
						kunjungan_poli.tanggal_kunjungan,
						kunjungan_poli.confirmation,
						kunjungan_poli.no_urut,
						nama_poliklinik,
						isDone,
						isConfirmed");
		$this->db->from("kunjungan_poli");
		$this->db->join('pasien', 'pasien.id_pasien = kunjungan_poli.id_pasien ', 'left');
		$this->db->join('poliklinik', 'poliklinik.id_poliklinik = kunjungan_poli.id_poli', 'left');

        $iDisplayStart = $this->input->get_post('iDisplayStart', true);
        $iDisplayLength = $this->input->get_post('iDisplayLength', true);
        $iSortCol_0 = $this->input->get_post('iSortCol_0', true);
        $iSortingCols = $this->input->get_post('iSortingCols', true);
        $sSearch = $this->input->get_post('sSearch', true);
        $sEcho = $this->input->get_post('sEcho', true);
    
        // Paging
        if(isset($iDisplayStart) && $iDisplayLength != '-1')
        {
            $this->db->limit($this->db->escape_str($iDisplayLength), $this->db->escape_str($iDisplayStart));
        }
        
        // Ordering
        if(isset($iSortCol_0))
        {
            for($i=0; $i<intval($iSortingCols); $i++)
            {
                $iSortCol = $this->input->get_post('iSortCol_'.$i, true);
                $bSortable = $this->input->get_post('bSortable_'.intval($iSortCol), true);
                $sSortDir = $this->input->get_post('sSortDir_'.$i, true);
    
                if($bSortable == 'true')
                {
                    $this->db->order_by($aColumns[intval($this->db->escape_str($iSortCol))], $this->db->escape_str($sSortDir));
                }
            }
        }
        
        if(isset($sSearch) && !empty($sSearch))
        {
            for($i=0; $i<count($aColumns); $i++)
            {
                $bSearchable = $this->input->get_post('bSearchable_'.$i, true);
                if(isset($bSearchable) && $bSearchable == 'true')
                {
                    $this->db->or_like($aColumns[$i], $this->db->escape_like_str($sSearch));
                }		
				
            }
        }
		
          for($i=0; $i<count($aColumns); $i++)
          {
              	$bSearchable = $this->input->get_post('bSearchable_'.$i, true);
              	@$sSearchs[$i] = $this->input->get_post('sSearch_'.$i, true);
              
              	if (isset($bSearchable) && $bSearchable == 'true' && $sSearchs[$i]!='')
			  	{
			 		$this->db->like($aColumns[$i-1], $this->db->escape_like_str($sSearchs[$i]));
				}		
		
          }

		
        // Select Data
        $this->db->where('tanggal_kunjungan BETWEEN "'.$date_range1.'" AND "'.$date_range2.'"');
        if( isset($poli) && $poli!="" )
        	$this->db->where("id_poli",$poli);
        $rResult = $this->db->get();
    
    	$this->db->select('SQL_CALC_FOUND_ROWS *', false);
    	$this->db->where('tanggal_kunjungan >=', $date_range1);
		$this->db->where('tanggal_kunjungan <=', $date_range2);
        $this->db->get("kunjungan_poli");
        $this->db->select('FOUND_ROWS() AS found_rows');
        $iFilteredTotal = $this->db->get()->row()->found_rows;
        // Data set length after filtering
        //$iFilteredTotal = $rResult->num_rows();
    
        // Total data set length
        $iTotal = $rResult->num_rows();
    
        // Output
        $output = array(
            'sEcho' => intval($sEcho),
            'iTotalRecords' => $iTotal,
            'iTotalDisplayRecords' => $iFilteredTotal,
            'aaData' => array()
        );
        
        foreach($rResult->result_array() as $aRow)
        {
            $row = array();
			$button_del='<div class="icon"><span class="ico-remove">Del</span></div>';
			$button_edit='<div class="icon"><span class="ico-pencil">Edit</span></div>';
			$button_pilih='<div class="icon"><span class="ico-ok"></span></div>';
			$button_print='<div class="icon"><span class="ico-print"></span></div>';
			
			$act='<div class="btn-group">
                    <a class="btn green" href="#" data-toggle="dropdown">
                    	<i class="icon-wrench"></i> Aksi
                    	<i class="icon-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                    	<li><a href="#" id="selesai" data-id="'.$aRow['id_kunjungan'].'"><i class="icon-ok"></i>Antrian Selesai</a></li>
                        <li class="divider"></li>
                        <li><a href="#" id="konfirmasi" data-id="'.$aRow['id_kunjungan'].'"><i class="icon-thumbs-up"></i>Konfirmasi</a></li>
                        <li class="divider"></li>
                        <li><a href="'.site_url('admin/kunjungan_poli/edit/'.$aRow['id_kunjungan']).'"><i class="icon-pencil"></i> Edit</a></li>
                        <li><a href="#removalModal" class="delete" data-id="'.$aRow['id_kunjungan'].'" data-toggle="modal"><i class="icon-trash"></i> Delete</a></li>
                    </ul>
                </div>';


            $row[] = $aRow['no_urut'];
            $row[] = ( $aRow['isDone'] == 1 ? '<span class="label label-success"> Selesai</span>' : '<span class="label label-warning"> Belum Selesai</span>' );
            $row[] = $aRow['id_pasien'];
            $row[] = $aRow['nama_pasien'];
            $row[] = $aRow['nama_poliklinik'];
            $row[] = $aRow['confirmation'];
            $row[] = ( $aRow['isConfirmed'] == 1 ? '<span class="label label-success"> Sudah Dikonfirmasi</span>' : '<span class="label label-warning"> Belum Dikonfirmasi</span>' );
            $row[] = $aRow['tanggal_kunjungan'];

			$row[] =$act;
            $output['aaData'][] = $row;
        }

        $output['total'] = $iTotal;
    
        echo json_encode($output);
    }


    public function generateNoUrut( $date,$poli ){

    	$this->db->select_max("no_urut");
		$this->db->from( "kunjungan_poli" );
		$this->db->where('tanggal_kunjungan', $date); 
		$this->db->where('id_poli',$poli);
		$query = $this->db->get();

		$last_queue = $query->result();

		$no_urut = (int)($last_queue[0]->no_urut + 1);

		return $no_urut;

    }


    public function is_confcode_useable($code){

    	$this->db->select("confirmation");
    	$this->db->from("kunjungan_poli");
    	$this->db->where("tanggal_kunjungan",date("Y-m-d"));
    	$rResult = $this->db->get();
    	return ($rResult->num_rows() <= 0);

    }

	/**
	 * END
	 * -------------------------------------------------------------
	 * METHOD-METHOD UNTUK MODUL LAYANAN > KUNJUNGAN
	 *
	 */

	/**
	 * BEGIN
	 * -------------------------------------------------------------	
	 * METHOD-METHOD UNTUK MODUL MASTER POLIKLINIK
	 *
	 */

	function generatePoliID(){
		$pk_length = 3;
		$pk_head="POLI";
		$this->db->select_max("id_poliklinik");
		$this->db->from( "poliklinik" );

		$query  =	$this->db->get();

		$last_pk =	$query->result();

		//mencari number terakhir
		$max 	=	(int) substr($last_pk[0]->id_poliklinik, strlen( $pk_head ), $pk_length  );

		//next number will be
		$max++;

		//generate new id
		$newID = $pk_head. sprintf("%0".$pk_length."s", $max);

		return $newID;	
	}	

	/**
	 * END
	 * -------------------------------------------------------------	
	 * METHOD-METHOD UNTUK MODUL MASTER POLIKLINIK
	 *
	 */	

	/**
	 * BEGIN
	 * -------------------------------------------------------------	
	 * METHOD-METHOD UNTUK MODUL LAYANAN > JADWAL DOKTER
	 *
	 */

	function getjadwaldokter(){

   		$aColumns = array("dokter.id_dokter",
   						  "nip_dokter",
   						  "dokter.nama");

		$this->db->select( "dokter.id_dokter,
							dokter.nama,
							nip_dokter,
							CASE WHEN (
								GROUP_CONCAT(
									CONCAT(
										waktu_jadwal.hari, 
										CONCAT(\"(\", 
											CONCAT(CONCAT(waktu_mulai, 
												\"-\"),
										 CONCAT(waktu_akhir, 
										 	\")\")
								))) SEPARATOR \" | \")) 
								IS NULL 
								THEN \"Belum ada jadwal\" 
								ELSE 
								GROUP_CONCAT(
									CONCAT(waktu_jadwal.hari, 
										CONCAT(\"&nbsp;&nbsp;(\", 
											CONCAT(CONCAT(waktu_mulai, 
												\"-\"), 
										CONCAT(waktu_akhir, 
										\")\")))) 
									SEPARATOR \" <br/> \"
							) END AS jadwal",FALSE);

		$this->db->from("dokter");
		$this->db->join('jadwal_dokter', 'dokter.id_dokter = jadwal_dokter.id_dokter ', 'left');
		$this->db->join('waktu_jadwal', 'waktu_jadwal.id_waktu_jadwal = jadwal_dokter.id_waktu', 'left');
		$this->db->group_by("dokter.id_dokter");

        $iDisplayStart = $this->input->get_post('iDisplayStart', true);
        $iDisplayLength = $this->input->get_post('iDisplayLength', true);
        $iSortCol_0 = $this->input->get_post('iSortCol_0', true);
        $iSortingCols = $this->input->get_post('iSortingCols', true);
        $sSearch = $this->input->get_post('sSearch', true);
        $sEcho = $this->input->get_post('sEcho', true);
    
        // Paging
        if(isset($iDisplayStart) && $iDisplayLength != '-1')
        {
            $this->db->limit($this->db->escape_str($iDisplayLength), $this->db->escape_str($iDisplayStart));
        }
        
        // Ordering
        if(isset($iSortCol_0))
        {
            for($i=0; $i<intval($iSortingCols); $i++)
            {
                $iSortCol = $this->input->get_post('iSortCol_'.$i, true);
                $bSortable = $this->input->get_post('bSortable_'.intval($iSortCol), true);
                $sSortDir = $this->input->get_post('sSortDir_'.$i, true);
    
                if($bSortable == 'true')
                {
                    $this->db->order_by($aColumns[intval($this->db->escape_str($iSortCol))], $this->db->escape_str($sSortDir));
                }
            }
        }
        
        if(isset($sSearch) && !empty($sSearch))
        {
            for($i=0; $i<count($aColumns); $i++)
            {
                $bSearchable = $this->input->get_post('bSearchable_'.$i, true);
                if(isset($bSearchable) && $bSearchable == 'true')
                {
                    $this->db->or_like($aColumns[$i], $this->db->escape_like_str($sSearch));
                }		
				
            }
        }
		
          for($i=0; $i<count($aColumns); $i++)
          {
              	$bSearchable = $this->input->get_post('bSearchable_'.$i, true);
              	@$sSearchs[$i] = $this->input->get_post('sSearch_'.$i, true);
              
              	if (isset($bSearchable) && $bSearchable == 'true' && $sSearchs[$i]!='')
			  	{
			 		$this->db->like($aColumns[$i-1], $this->db->escape_like_str($sSearchs[$i]));
				}		
		
          }

        $rResult = $this->db->get();
    
        // Data set length after filtering
        $this->db->select('SQL_CALC_FOUND_ROWS *', false);
        $this->db->get("dokter");
        $this->db->select('FOUND_ROWS() AS found_rows');
        $iFilteredTotal = $this->db->get()->row()->found_rows;
    
    
        // Total data set length
        $iTotal = $this->db->count_all("dokter");
    
        // Output
        $output = array(
            'sEcho' => intval($sEcho),
            'iTotalRecords' => $iTotal,
            'iTotalDisplayRecords' => $iFilteredTotal,
            'aaData' => array()
        );
        
        foreach($rResult->result_array() as $aRow)
        {
            $row = array();
			$button_del='<div class="icon"><span class="ico-remove">Del</span></div>';
			$button_edit='<div class="icon"><span class="ico-pencil">Edit</span></div>';
			$button_pilih='<div class="icon"><span class="ico-ok"></span></div>';
			$button_print='<div class="icon"><span class="ico-print"></span></div>';
			
			$act='<div class="btn-group">
                    <a class="btn green" href="#" data-toggle="dropdown">
                    	<i class="icon-wrench"></i> Aksi
                    	<i class="icon-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="'.site_url('admin/jadwal_dokter/edit/'.$aRow['id_dokter']).'"><i class="icon-pencil"></i> Edit</a></li>
 					</ul>
                </div>';

            
            //$row[] = '<input type="checkbox" class="checkboxes" value="'.$aRow['id_kunjungan'].'" />';
            $row[] = $aRow['nama'];
            $row[] = $aRow['jadwal'];

			$row[] =$act;
            $output['aaData'][] = $row;
        }

        $output['total'] = $iTotal;
    
        echo json_encode($output);
	}

	function getJadwalByDokter($id){

   		$aColumns = array("waktu_jadwal.hari",
   						  "jadwal_dokter.waktu_mulai",
   						  "jadwal_dokter.waktu_akhir");

		$this->db->select( "jadwal_dokter.id_dokter,
							jadwal_dokter.id_waktu,
							waktu_jadwal.hari,
							jadwal_dokter.waktu_mulai,
							jadwal_dokter.waktu_akhir",FALSE);

		$this->db->from("jadwal_dokter");
		$this->db->join('dokter', 'dokter.id_dokter = jadwal_dokter.id_dokter ', 'left');
		$this->db->join('waktu_jadwal', 'waktu_jadwal.id_waktu_jadwal = jadwal_dokter.id_waktu', 'left');
		$this->db->where("jadwal_dokter.id_dokter",$id);

        $iDisplayStart = $this->input->get_post('iDisplayStart', true);
        $iDisplayLength = $this->input->get_post('iDisplayLength', true);
        $iSortCol_0 = $this->input->get_post('iSortCol_0', true);
        $iSortingCols = $this->input->get_post('iSortingCols', true);
        $sSearch = $this->input->get_post('sSearch', true);
        $sEcho = $this->input->get_post('sEcho', true);
    
        // Paging
        if(isset($iDisplayStart) && $iDisplayLength != '-1')
        {
            $this->db->limit($this->db->escape_str($iDisplayLength), $this->db->escape_str($iDisplayStart));
        }
        
        // Ordering
        if(isset($iSortCol_0))
        {
            for($i=0; $i<intval($iSortingCols); $i++)
            {
                $iSortCol = $this->input->get_post('iSortCol_'.$i, true);
                $bSortable = $this->input->get_post('bSortable_'.intval($iSortCol), true);
                $sSortDir = $this->input->get_post('sSortDir_'.$i, true);

                if($bSortable == 'true')
                {
                    $this->db->order_by($aColumns[intval($this->db->escape_str($iSortCol))], $this->db->escape_str($sSortDir));
                }
            }
        }
        
        if(isset($sSearch) && !empty($sSearch))
        {
            for($i=0; $i<count($aColumns); $i++)
            {
                $bSearchable = $this->input->get_post('bSearchable_'.$i, true);
                if(isset($bSearchable) && $bSearchable == 'true')
                {
                    $this->db->or_like($aColumns[$i], $this->db->escape_like_str($sSearch));
                }		
				
            }
        }
		
          for($i=0; $i<count($aColumns); $i++)
          {
              	$bSearchable = $this->input->get_post('bSearchable_'.$i, true);
              	@$sSearchs[$i] = $this->input->get_post('sSearch_'.$i, true);
              
              	if (isset($bSearchable) && $bSearchable == 'true' && $sSearchs[$i]!='')
			  	{
			 		$this->db->like($aColumns[$i-1], $this->db->escape_like_str($sSearchs[$i]));
				}		
		
          }

        $rResult = $this->db->get();
    
        // Data set length after filtering
        $this->db->select('SQL_CALC_FOUND_ROWS *', false);
        $this->db->get("jadwal_dokter");
        $this->db->select('FOUND_ROWS() AS found_rows');
        $iFilteredTotal = $this->db->get()->row()->found_rows;
    
    
        // Total data set length
        $iTotal = $this->db->count_all("dokter");
    
        // Output
        $output = array(
            'sEcho' => intval($sEcho),
            'iTotalRecords' => $iTotal,
            'iTotalDisplayRecords' => $iFilteredTotal,
            'aaData' => array()
        );
        
        foreach($rResult->result_array() as $aRow)
        {
            $row = array();
			$button_del='<div class="icon"><span class="ico-remove">Del</span></div>';
			$button_edit='<div class="icon"><span class="ico-pencil">Edit</span></div>';
			$button_pilih='<div class="icon"><span class="ico-ok"></span></div>';
			$button_print='<div class="icon"><span class="ico-print"></span></div>';
			
			$act='<div class="btn-group">
                    <a class="btn green" href="#" data-toggle="dropdown">
                    	<i class="icon-wrench"></i> Aksi
                    	<i class="icon-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#editModal" class="edit" data-toggle="modal" data-iddokter="'.$aRow['id_dokter'].'" data-idwaktu="'.$aRow['id_waktu'].'"><i class="icon-pencil"></i> Edit</a></li>
                        <li><a href="#hapusModal" class="delete" data-toggle="modal" data-iddokter="'.$aRow['id_dokter'].'" data-idwaktu="'.$aRow['id_waktu'].'"><i class="icon-trash"></i> Hapus</a></li>
 					</ul>
                </div>';


                //'.site_url('admin/jadwal_dokter/edit_jadwal_dokter/'.$aRow['id_dokter'].'/'.$aRow['id_waktu']).'
                //'.site_url('admin/jadwal_dokter/hapus/'.$aRow['id_dokter'].'/'.$aRow['id_waktu']).'

            $row[] = $aRow['hari'];
            $row[] = $aRow['waktu_mulai'];
            $row[] = $aRow['waktu_akhir'];

			$row[] =$act;
            $output['aaData'][] = $row;
        }

        $output['total'] = $iTotal;
    
        echo json_encode($output);
	}


	public function getJadwal($id_dokter,$id_waktu){
		
		$this->db->select();
		$this->db->from("jadwal_dokter");
		$this->db->where("id_waktu",$id_waktu);
		$this->db->where("id_dokter",$id_dokter);
		$query = $this->db->get();

		$data = $query->result();
		

		$json_data = array();

		$json_data['id_waktu'] 		= 	$data[0]->id_waktu;
		$json_data['id_dokter']		=	$data[0]->id_dokter;
		$json_data['waktu_mulai']	=	$data[0]->waktu_mulai;
		$json_data['waktu_akhir']	=	$data[0]->waktu_akhir;

		echo json_encode( $json_data ); 

	}

	public function update_jadwal_nian( array $data,$id_waktu,$id_dokter){
		$this->db->where( 'id_waktu' , $id_waktu );
		$this->db->where( 'id_dokter' , $id_dokter );
		return $this->db->update( "jadwal_dokter", $data );
	}

	/**
	 * END
	 * -------------------------------------------------------------	
	 * METHOD-METHOD UNTUK MODUL JADWAL DOKTER
	 *
	 */



	/**
	 * BEGIN
	 * -------------------------------------------------------------	
	 * METHOD-METHOD UNTUK MODUL FEEDBACK / KRITIK-SARAN
	 *
	 */
	function getFeedback($date_range1 = "DATE(NOW())", $date_range2 ="DATE(NOW())",$jenis){

    	$aColumns = array("id_feedback",
    						"email",
    						"perihal",
    						"isi",
    						"type",
    						"via",
    						"time");
    	$this->db->select();
    	$this->db->from("kritik_saran");


        $iDisplayStart = $this->input->get_post('iDisplayStart', true);
        $iDisplayLength = $this->input->get_post('iDisplayLength', true);
        $iSortCol_0 = $this->input->get_post('iSortCol_0', true);
        $iSortingCols = $this->input->get_post('iSortingCols', true);
        $sSearch = $this->input->get_post('sSearch', true);
        $sEcho = $this->input->get_post('sEcho', true);
    
        // Paging
        if(isset($iDisplayStart) && $iDisplayLength != '-1')
        {
            $this->db->limit($this->db->escape_str($iDisplayLength), $this->db->escape_str($iDisplayStart));
        }
        
        // Ordering
        if(isset($iSortCol_0))
        {
            for($i=0; $i<intval($iSortingCols); $i++)
            {
                $iSortCol = $this->input->get_post('iSortCol_'.$i, true);
                $bSortable = $this->input->get_post('bSortable_'.intval($iSortCol), true);
                $sSortDir = $this->input->get_post('sSortDir_'.$i, true);
    
                if($bSortable == 'true')
                {
                    $this->db->order_by($aColumns[intval($this->db->escape_str($iSortCol))], $this->db->escape_str($sSortDir));
                }
            }
        }
        
        if(isset($sSearch) && !empty($sSearch))
        {
            for($i=0; $i<count($aColumns); $i++)
            {
                $bSearchable = $this->input->get_post('bSearchable_'.$i, true);
                if(isset($bSearchable) && $bSearchable == 'true')
                {
                    $this->db->or_like($aColumns[$i], $this->db->escape_like_str($sSearch));
                }		
				
            }
        }
		
          for($i=0; $i<count($aColumns); $i++)
          {
              	$bSearchable = $this->input->get_post('bSearchable_'.$i, true);
              	@$sSearchs[$i] = $this->input->get_post('sSearch_'.$i, true);
              
              	if (isset($bSearchable) && $bSearchable == 'true' && $sSearchs[$i]!='')
			  	{
			 		$this->db->like($aColumns[$i-1], $this->db->escape_like_str($sSearchs[$i]));
				}		
		
          }

		
        // Select Data
        $this->db->where('time BETWEEN "'.$date_range1.'" AND "'.$date_range2.'"');
        if( isset($jenis) && trim( $jenis ) != "" )
        	$this->db->where("type",$jenis);
        $rResult = $this->db->get();
    
        // Data set length after filtering
        $this->db->select('SQL_CALC_FOUND_ROWS '.str_replace(' , ', ' ', implode(', ', $aColumns)), false);
        $this->db->get("kritik_saran");
        $this->db->select('FOUND_ROWS() AS found_rows');
        $iFilteredTotal = $this->db->get()->row()->found_rows;
    
    
        // Total data set length
        $iTotal = $this->db->count_all("kritik_saran");
    
        // Output
        $output = array(
            'sEcho' => intval($sEcho),
            'iTotalRecords' => $iTotal,
            'iTotalDisplayRecords' => $iFilteredTotal,
            'aaData' => array()
        );
        
        foreach($rResult->result_array() as $aRow)
        {
            $row = array();
			$button_del='<div class="icon"><span class="ico-remove">Del</span></div>';
			$button_edit='<div class="icon"><span class="ico-pencil">Edit</span></div>';
			$button_pilih='<div class="icon"><span class="ico-ok"></span></div>';
			$button_print='<div class="icon"><span class="ico-print"></span></div>';
			
			$act='<div class="btn-group">
                    <a class="btn green" href="#" data-toggle="dropdown">
                    	<i class="icon-wrench"></i> Aksi
                    	<i class="icon-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a data-id='.$aRow['id_feedback'].' href="#" class="view"><i class="icon-eye-open"></i> Lihat Rinci</a></li>
                        <li><a href="#removalModal" class="delete" data-id="'.$aRow['id_feedback'].'" data-toggle="modal"><i class="icon-trash"></i> Hapus</a></li>
                    </ul>
                </div>';

            
            $row[] = $aRow['type'];
            $row[] = $aRow['perihal'];
            $row[] = $aRow['isi'];
            $row[] = $aRow['via'];
            $row[] = $aRow['time'];
            $row[] = $aRow['email'];

			$row[] =$act;
            $output['aaData'][] = $row;
        }

        $output['total'] = $iTotal;
    
        echo json_encode($output);
	}
	/**
	 * END
	 * -------------------------------------------------------------	
	 * METHOD-METHOD UNTUK MODUL FEEDBACK / KRITIK-SARAN
	 *
	 */


	function getQuestions( $status ){

    	$aColumns = array("id",
    						"title",
    						"content",
    						"author",
    						"email",
    						"timestamp",
    						"tampilkan");
    	$this->db->select("id,
    					   title,
    					   content,
    					   author,
    					   email,
    					   timestamp,
    					   tampilkan, 
    						(CASE WHEN Jawaban IS NULL 
    							THEN 'belum dijawab' 
    							ELSE 'sudah dijawab' 
    							END) AS stat ",TRUE);
    	$this->db->from("konsultasi");


        $iDisplayStart = $this->input->get_post('iDisplayStart', true);
        $iDisplayLength = $this->input->get_post('iDisplayLength', true);
        $iSortCol_0 = $this->input->get_post('iSortCol_0', true);
        $iSortingCols = $this->input->get_post('iSortingCols', true);
        $sSearch = $this->input->get_post('sSearch', true);
        $sEcho = $this->input->get_post('sEcho', true);
    
        // Paging
        if(isset($iDisplayStart) && $iDisplayLength != '-1')
        {
            $this->db->limit($this->db->escape_str($iDisplayLength), $this->db->escape_str($iDisplayStart));
        }
        
        // Ordering
        if(isset($iSortCol_0))
        {
            for($i=0; $i<intval($iSortingCols); $i++)
            {
                $iSortCol = $this->input->get_post('iSortCol_'.$i, true);
                $bSortable = $this->input->get_post('bSortable_'.intval($iSortCol), true);
                $sSortDir = $this->input->get_post('sSortDir_'.$i, true);
    
                if($bSortable == 'true')
                {
                    $this->db->order_by($aColumns[intval($this->db->escape_str($iSortCol))], $this->db->escape_str($sSortDir));
                }
            }
        }
        
        if(isset($sSearch) && !empty($sSearch))
        {
            for($i=0; $i<count($aColumns); $i++)
            {
                $bSearchable = $this->input->get_post('bSearchable_'.$i, true);
                if(isset($bSearchable) && $bSearchable == 'true')
                {
                    $this->db->or_like($aColumns[$i], $this->db->escape_like_str($sSearch));
                }		
				
            }
        }
		
          for($i=0; $i<count($aColumns); $i++)
          {
              	$bSearchable = $this->input->get_post('bSearchable_'.$i, true);
              	@$sSearchs[$i] = $this->input->get_post('sSearch_'.$i, true);
              
              	if (isset($bSearchable) && $bSearchable == 'true' && $sSearchs[$i]!='')
			  	{
			 		$this->db->like($aColumns[$i-1], $this->db->escape_like_str($sSearchs[$i]));
				}		
		
          }

		
        if( $status == 0  ){
        	$this->db->where('Jawaban IS NULL');
        }
        else{
			$this->db->where('Jawaban IS NOT NULL');        	
        }

        $rResult = $this->db->get();
    
        // Data set length after filtering
        $this->db->select('SQL_CALC_FOUND_ROWS '.str_replace(' , ', ' ', implode(', ', $aColumns)), false);
        $this->db->get("konsultasi");
        $this->db->select('FOUND_ROWS() AS found_rows');
        $iFilteredTotal = $this->db->get()->row()->found_rows;
    
    
        // Total data set length
        $iTotal = $this->db->count_all("konsultasi");
    
        // Output
        $output = array(
            'sEcho' => intval($sEcho),
            'iTotalRecords' => $iTotal,
            'iTotalDisplayRecords' => $iFilteredTotal,
            'aaData' => array()
        );
        
        foreach($rResult->result_array() as $aRow)
        {
            $row = array();
			
			$act='<div class="btn-group">
                    <a class="btn green" href="#" data-toggle="dropdown">
                    	<i class="icon-wrench"></i> Aksi
                    	<i class="icon-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu">';
            
            $text = "";
            if( $status == 0 ){
            	$text = "Jawab";
            }
            else{
            	$text = "Edit Jawaban";
            }

 			$act .= '		<li><a data-id="'.$aRow['id'].'" href="'.site_url("admin/ekonsultasi/reply_page")."/".$aRow['id'].'" class="jwb"><i class="icon-comment-alt"></i> Jawab</a></li>';
            $act .= '		<li><a data-id="'.$aRow['id'].'" href="#" class="vsbl"><i class="icon-eye-open"></i> Tampilkan</a></li>';
            $act .= '       <li><a data-id="'.$aRow['id'].'" href="#" class="hdn" data-id="'.$aRow['id'].'"><i class="icon-eye-close"></i>Sembunyikan</a></li>';
            $act .= '		<li><a href="#removalModal" class="delete"  data-id="'.$aRow['id'].'" data-toggle="modal"><i class="icon-trash"></i> Hapus</a></li>
                    </ul>
                	</div>';

            

            $row[] = $aRow['author'];
            $row[] = $aRow['title'];
            $row[] = substr($aRow['content'], 0,30)."...";
            $row[] = $aRow['email'];
            $row[] = $aRow['timestamp'];
			$row[] = $aRow['tampilkan'];


			$row[] =$act;
            $output['aaData'][] = $row;
        }

        $output['total'] = $iTotal;
    
        echo json_encode($output);


	}


	function get_inbox_list(){

    	$aColumns = array("ReceivingDateTime",
    						"SenderNumber",
    						"SMSCNumber",
    						"TextDecoded",);
    	$this->db->select("inbox.ID,ReceivingDateTime,
    						SenderNumber,
    						SMSCNumber,
    						TextDecoded,
    						Processed,
    						read,
    						notification,
    						Name",TRUE);

    	$this->db->join('pbk', 'CONCAT("+62",SUBSTR(Number,2)) = SenderNumber ', 'left');
    	$this->db->from("inbox");
    	$this->db->order_by("inbox.ReceivingDateTime", "desc"); 
    	


        $iDisplayStart = $this->input->get_post('iDisplayStart', true);
        $iDisplayLength = $this->input->get_post('iDisplayLength', true);
        $iSortCol_0 = $this->input->get_post('iSortCol_0', true);
        $iSortingCols = $this->input->get_post('iSortingCols', true);
        $sSearch = $this->input->get_post('sSearch', true);
        $sEcho = $this->input->get_post('sEcho', true);
    
        // Paging
        if(isset($iDisplayStart) && $iDisplayLength != '-1')
        {
            $this->db->limit($this->db->escape_str($iDisplayLength), $this->db->escape_str($iDisplayStart));
        }
        
        // Ordering
        if(isset($iSortCol_0))
        {
            for($i=0; $i<intval($iSortingCols); $i++)
            {
                $iSortCol = $this->input->get_post('iSortCol_'.$i, true);
                $bSortable = $this->input->get_post('bSortable_'.intval($iSortCol), true);
                $sSortDir = $this->input->get_post('sSortDir_'.$i, true);
    
                if($bSortable == 'true')
                {
                    $this->db->order_by($aColumns[intval($this->db->escape_str($iSortCol))], $this->db->escape_str($sSortDir));
                }
            }
        }
        
        if(isset($sSearch) && !empty($sSearch))
        {
            for($i=0; $i<count($aColumns); $i++)
            {
                $bSearchable = $this->input->get_post('bSearchable_'.$i, true);
                if(isset($bSearchable) && $bSearchable == 'true')
                {
                    $this->db->or_like($aColumns[$i], $this->db->escape_like_str($sSearch));
                }		
				
            }
        }
		
          for($i=0; $i<count($aColumns); $i++)
          {
              	$bSearchable = $this->input->get_post('bSearchable_'.$i, true);
              	@$sSearchs[$i] = $this->input->get_post('sSearch_'.$i, true);
              
              	if (isset($bSearchable) && $bSearchable == 'true' && $sSearchs[$i]!='')
			  	{
			 		$this->db->like($aColumns[$i-1], $this->db->escape_like_str($sSearchs[$i]));
				}		
		
          }

        $rResult = $this->db->get();
    
        // Data set length after filtering
        $this->db->select('SQL_CALC_FOUND_ROWS '.str_replace(' , ', ' ', implode(', ', $aColumns)), false);
        $this->db->get("inbox");
        $this->db->select('FOUND_ROWS() AS found_rows');
        $iFilteredTotal = $this->db->get()->row()->found_rows;
    
        // Total data set length
        $iTotal = $this->db->count_all("inbox");
    
        // Output
        $output = array(
            'sEcho' => intval($sEcho),
            'iTotalRecords' => $iTotal,
            'iTotalDisplayRecords' => $iFilteredTotal,
            'aaData' => array()
        );
        
        foreach($rResult->result_array() as $aRow)
        {
            $row = array();
			
			$act='<div class="btn-group">
                    <a class="btn green" href="#" data-toggle="dropdown">
                    	<i class="icon-wrench"></i> Aksi
                    	<i class="icon-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu">';

            $act .= '		<li><a data-id="'.$aRow['ID'].'" href="#" class="view"><i class="icon-eye-open"></i> Lihat</a></li>';
            $act .= '		<li><a data-id="'.$aRow['ID'].'" href="#" class="balas"><i class="icon-envelope"></i> Balas</a></li>';
            $act .= '       <li><a href="'.site_url("admin/smsgateaway/forward_inbox\/").$aRow['ID'].'"><i class="icon-retweet"></i>Teruskan</a></li>';
            $act .= '		<li><a href="#removalModal" data-id="'.$aRow['ID'].'" data-toggle="modal" class="delete"><i class="icon-trash"></i> Hapus</a></li>
                    </ul>
                	</div>';

            $row[]	=	( $aRow['read'] == "false" ? '<span class="label label-success">Baru</span>': '<span class="label label-warning">Sudah Dibaca</span>' );
            $row[] 	= 	$aRow['ReceivingDateTime'];
            $row[] 	= 	$aRow['SenderNumber'];
            $row[] 	= 	$aRow['Name'];
            $row[] 	= 	substr($aRow['TextDecoded'],0,30);

			$row[] =$act;

            $output['aaData'][] = $row;
        }

        $output['total'] = $iTotal;
    
        echo json_encode($output);

	}



	function get_sent_list(){

    	$aColumns = array(	"SendingDateTime",
    						"DeliveryDateTime",
    						"DestinationNumber",
    						"SMSCNumber",
    						"TextDecoded",
    						"ID",
    						"SequencePosition",
    						"sentitems.Status",
    				);
    	$this->db->select("sentitems.ID,SendingDateTime,DestinationNumber,TextDecoded,sentitems.Status,Name");
    	$this->db->from("sentitems");
    	$this->db->join('pbk', 'CONCAT("+62",SUBSTR(Number,2)) = DestinationNumber ', 'left');


        $iDisplayStart = $this->input->get_post('iDisplayStart', true);
        $iDisplayLength = $this->input->get_post('iDisplayLength', true);
        $iSortCol_0 = $this->input->get_post('iSortCol_0', true);
        $iSortingCols = $this->input->get_post('iSortingCols', true);
        $sSearch = $this->input->get_post('sSearch', true);
        $sEcho = $this->input->get_post('sEcho', true);
    
        // Paging
        if(isset($iDisplayStart) && $iDisplayLength != '-1')
        {
            $this->db->limit($this->db->escape_str($iDisplayLength), $this->db->escape_str($iDisplayStart));
        }
        
        // Ordering
        if(isset($iSortCol_0))
        {
            for($i=0; $i<intval($iSortingCols); $i++)
            {
                $iSortCol = $this->input->get_post('iSortCol_'.$i, true);
                $bSortable = $this->input->get_post('bSortable_'.intval($iSortCol), true);
                $sSortDir = $this->input->get_post('sSortDir_'.$i, true);
    
                if($bSortable == 'true')
                {
                    $this->db->order_by($aColumns[intval($this->db->escape_str($iSortCol))], $this->db->escape_str($sSortDir));
                }
            }
        }
        
        if(isset($sSearch) && !empty($sSearch))
        {
            for($i=0; $i<count($aColumns); $i++)
            {
                $bSearchable = $this->input->get_post('bSearchable_'.$i, true);
                if(isset($bSearchable) && $bSearchable == 'true')
                {
                    $this->db->or_like($aColumns[$i], $this->db->escape_like_str($sSearch));
                }		
				
            }
        }
		
          for($i=0; $i<count($aColumns); $i++)
          {
              	$bSearchable = $this->input->get_post('bSearchable_'.$i, true);
              	@$sSearchs[$i] = $this->input->get_post('sSearch_'.$i, true);
              
              	if (isset($bSearchable) && $bSearchable == 'true' && $sSearchs[$i]!='')
			  	{
			 		$this->db->like($aColumns[$i-1], $this->db->escape_like_str($sSearchs[$i]));
				}		
		
          }

        $rResult = $this->db->get();
    
        // Data set length after filtering
        $this->db->select('SQL_CALC_FOUND_ROWS *', false);
        $this->db->get("sentitems");
        $this->db->select('FOUND_ROWS() AS found_rows');
        $iFilteredTotal = $this->db->get()->row()->found_rows;
    
        // Total data set length
        $iTotal = $this->db->count_all("sentitems");
    
        // Output
        $output = array(
            'sEcho' => intval($sEcho),
            'iTotalRecords' => $iTotal,
            'iTotalDisplayRecords' => $iFilteredTotal,
            'aaData' => array()
        );
        
        foreach($rResult->result_array() as $aRow)
        {
            $row = array();
			
			$act='<div class="btn-group">
                    <a class="btn green" href="#" data-toggle="dropdown">
                    	<i class="icon-wrench"></i> Aksi
                    	<i class="icon-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu">';

            $act .= '		<li><a data-id="'.$aRow['ID'].'" href="#" class="view"><i class="icon-eye-open"></i> Lihat</a></li>';
            $act .= '		<li><a href="'.site_url("admin/smsgateaway/forward\/").$aRow['ID'].'"><i class="icon-envelope"></i> Teruskan</a></li>';
            //$act .= '       <li><a data-id="'.$aRow['ID'].'"href="#" class="forward" data-id="'.$aRow['ID'].'"><i class="icon-retweet"></i>Teruskan</a></li>';
            $act .= '		<li><a href="#removalModal"  data-id="'.$aRow['ID'].'" data-toggle="modal" class="delete"><i class="icon-trash"></i> Hapus</a></li>
                    </ul>
                	</div>';

               
            $row[] = $aRow['SendingDateTime'];
            $row[] = $aRow['DestinationNumber'];
            $row[] = $aRow['Name'];
            $row[] = $aRow['TextDecoded'];
			$row[] = $aRow['Status'];


			$row[] =$act;

            $output['aaData'][] = $row;
        }

        $output['total'] = $iTotal;
    
        echo json_encode($output);

	}


	function get_contacts($group=null){

		$this->db->from("pbk");
		
		if( is_null( $group )  ){
			$this->db->select("pbk.ID,pbk.Number,pbk.Name,pbk_groups.Name as group_name");
			$this->db->order_by("GroupID","Asc");
			$this->db->join("pbk_groups","GroupID = pbk_groups.ID","left");
		}else{
			$this->db->select("pbk.ID,pbk.Number,pbk.Name");
			$this->db->where("GroupID",$group);

		}

		return  $this->db->get()->result();

	}


	function send_sms( array $numbers, $sms ){
		
		$sms_batch = array();

		foreach($numbers as $number){

			array_push( $sms_batch , array(	'DestinationNumber' => $number,
											'TextDecoded'  => $sms,
											'CreatorID' => "CRM" )
			);

		}


		return $this->db->insert_batch("outbox",$sms_batch);		
	}



	function push_notification_message(){

		$query = $this->db->query("SELECT * FROM inbox WHERE Notification = 'push' ");
		
		$json_data = array();

		foreach ($query->result_array() as $aRow) {
			
			$message = array(
							"ID"=>$aRow["ID"],
							"TextDecoded"=>$aRow["TextDecoded"],
							"SenderNumber"=>$aRow["SenderNumber"],
							"ReceivingDateTime" => $aRow["ReceivingDateTime"]
						);

			array_push($json_data, $message);

		}


		return $json_data;

	}


	function push_notification_konsultasi(){
		
		$query = $this->db->query("SELECT * FROM konsultasi WHERE Notification = 'push' AND (Jawaban IS NULL OR (CHAR_LENGTH(Jawaban) = 0)) AND `read` = 'false'");
		
		$json_data = array();

		foreach ($query->result_array() as $aRow) {
			
			$message = array(
							"id"=>$aRow["id"],
							"title"=>$aRow["title"],
							"content"=>$aRow["content"],
							"timestamp" => $aRow["timestamp"]
						);

			array_push($json_data, $message);

		}


		return $json_data;		
	}

	function unread_messages(){
		
		$query = $this->db->query("SELECT * FROM inbox WHERE `read` = 'false' and `Notification` = 'bar' ORDER BY ReceivingDateTime DESC LIMIT 0,5");
		

		$return_data = array();
		$message_data = array();

		foreach ($query->result_array() as $aRow) {
			
			$message = array(
							"ID"=>$aRow["ID"],
							"TextDecoded"=>substr($aRow["TextDecoded"],0,30),
							"SenderNumber"=>$aRow["SenderNumber"],
							"ReceivingDateTime" => $aRow["ReceivingDateTime"]
						);

			array_push($message_data, $message);

		}

		$return_data["mData"] = $message_data;

		$this->db->where('read', 'false');
		$this->db->where('Notification', 'bar');
        $rResult = $this->db->get("inbox");

        $return_data["mTotal"]	=	$rResult->num_rows();

		return $return_data;		
	}


	function unread_questions(){
		
		$query = $this->db->query("SELECT * FROM konsultasi WHERE `read` = 'false' and `Notification` = 'bar' ORDER BY `timestamp` DESC LIMIT 0,10");
		

		$return_data = array();
		$message_data = array();

		foreach ($query->result_array() as $aRow) {
			
			$message = array(
							"id"=>$aRow["id"],
							"title"=>$aRow["title"],
							"content"=>$aRow["content"],
							"timestamp" => $aRow["timestamp"]
						);

			array_push($message_data, $message);

		}

		$return_data["mData"] = $message_data;

		$this->db->where('read', 'false');
		$this->db->where('Notification', 'bar');
        $rResult = $this->db->get("konsultasi");

        $return_data["mTotal"]	=	$rResult->num_rows();

		return $return_data;		
	}

	public function dashboard_datakunjungan($start,$end){
		$sql1 = "SELECT tanggal_kunjungan,
														 COUNT(*) AS banyak_kunjungan 
												  FROM `kunjungan_poli` 
												  WHERE `tanggal_kunjungan` BETWEEN '$start' AND '$end'
												  GROUP BY tanggal_kunjungan";

		$kunjungan_poli		=	$this->db->query($sql1);

		$rResult_kunjungan_poli	=	$kunjungan_poli->result();

		$counter = 0;
		$banyak = count( $rResult_kunjungan_poli );

		$data_kunjungan = "[";

		foreach ($rResult_kunjungan_poli as $key => $data) {

			$data_kunjungan .= "[\"".format_date( $data->tanggal_kunjungan )."\",".$data->banyak_kunjungan."]";
			if( $counter < ( $banyak - 1 ) ){
				$data_kunjungan .= ",";
			}

			$counter++;

		}	

		$data_kunjungan .= "]";


		return $data_kunjungan;
	}


	function dashboard_itung_itungan($start,$end,$table,$where_column){

		$this->db->select();
		$this->db->from($table);
		$this->db->where("$where_column BETWEEN '$start' and '$end'");
		$query = $this->db->get();

		return $query->num_rows();
	}

	public function data_dashboard($start,$end){

		$data_kunjungan 		= $this->dashboard_datakunjungan($start,$end);
		$totalpasiendaftar 		= $this->dashboard_itung_itungan($start,$end,"pasien","tanggal_daftar");
		$visit 					= $this->dashboard_itung_itungan($start,$end,"kunjungan_poli","tanggal_kunjungan");
		$kritik 				= $this->dashboard_itung_itungan($start,$end,"kritik_saran","time");

		$r		 = "{";
		$r 		.= " \"kunjungan\" : ".$data_kunjungan.",";
		$r      .= "\"totalpasiendaftar\": $totalpasiendaftar,";
		$r      .= "\"visit\": $visit,";
		$r      .= "\"kritik\": $kritik";
		$r 		.= "}";
		
		return $r;

	}

}