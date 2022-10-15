<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_crud extends CI_Model {
	
	public function __construct(){
		 parent::__construct();
	}
	function cek_session(){
		if(!$this->session->userdata('login'))
		{
			header('location:'.base_url().'index.php/login/formlogin');
			exit(0);
		}
		$sess=$this->session->userdata('login');
		$uri=$this->uri->segment(1)."/".$this->uri->segment(2);
		$uri=str_replace('#',"",$uri);
		$sql="select * from aksesmenu am,menu m where m.kode_menu=am.kode_menu 
			  and m.url='".$uri."' and am.kode_role='".$sess['kode_role']."'";
        $res = $this->db->query($sql);
        if ($res->num_rows() == 0) 
		{
            header('location:'.base_url().'index.php/login/formlogin');
			exit(0);
        } 
	}
	public function list_field($tabel){
		return $this->db->list_fields($tabel);
	} 
	
	public function list_data_fields($tabel){
		return $this->db->field_data($tabel);
	}
	
	public function add($tabel, $data){
		return $this->db->insert($tabel, $data);
	}
	
	public function update($id, $field_id, $tabel, $data){
		$this->db->where($field_id, $id);
		return $this->db->update($tabel, $data);
	}
	
	public function delete($id, $field_id, $tabel){
		$this->db->where($field_id, $id);
		return $this->db->delete($tabel);
	}
	
	public function get_all($start,$perpage,$id,$tabel){
		$this->db->limit($perpage,$start);
		$this->db->order_by($id,'desc');
		return $this->db->get($tabel);
	}
	public function get_autocomplete($id,$tabel){
		$this->db->select($id);
		$this->db->order_by($id,'asc');
		return $this->db->get($tabel);
	}
	function GetMenuByRole($kodeRole)
	{
	 return $this->db->query("select m.kode_menu,m.name,m.url,m.parent,COALESCE(m.color,'') as color,m.icon from menu m,aksesmenu am
							where m.kode_menu=am.kode_menu and am.kode_role='".$kodeRole."'
							order by m.kode_menu,m.parent");
	}
	public function autoNIS($cabang){
						$autonew1=0;
						$query = $this->db->query("select NIS from siswa where kode_cabang='$cabang' and year(tanggal_daftar)='".date("Y")."'  order by NIS DESC LIMIT 1");
						if ($query->num_rows() > 0)
						{
						$ret = $query->row();
						$str=explode('/',$ret->NIS);
						$autonew1 = $str[0]; 
						}
						$autonew2 = (int) $autonew1;
						$autonew3 = sprintf("%04d",$autonew2+1);
						return $autonew3."/".$cabang."/".date("Y");
	}
	public function autoNota($cabang){
						$autonew1=0;
						$query = $this->db->query("select id_nota from nota_pembayaran where kode_cabang='$cabang' and year(tanggal)='".date("Y")."'  order by id_nota DESC LIMIT 1");
						if ($query->num_rows() > 0)
						{
						$ret = $query->row();
						$str=explode('/',$ret->id_nota);
						$autonew1 = $str[0]; 
						}
						$autonew2 = (int) $autonew1;
						$autonew3 = sprintf("%04d",$autonew2+1);
						return $autonew3."/".$cabang."/".date("Y");
	}
	public function autoNotaPenerimaan($cabang){
						$autonew1=0;
						$query = $this->db->query("select id_nota from nota_penerimaan where kode_cabang='$cabang' and year(tanggal)='".date("Y")."'  order by id_nota DESC LIMIT 1");
						if ($query->num_rows() > 0)
						{
						$ret = $query->row();
						$str=explode('/',$ret->id_nota);
						$autonew1 = $str[0]; 
						}
						$autonew2 = (int) $autonew1;
						$autonew3 = sprintf("%04d",$autonew2+1);
						return $autonew3."/".$cabang."/".date("Y");
	}
	public function pesan_warning($pesan)
	{
			$data='
			<div class="alert alter-block">
			<button class="close" data-dismiss="alert" type="button">x</button>
			<h4>Perhatian!</h4>
			'.$pesan.'
			</div>';
			return $data;
	}
	public function dp_query($idnota,$limit)
	{
		return 	$this->db->query("
							select count(*) as jumlah,k.kode_kursus from jenis_iuran j 
							join iuran i on(j.kode_jenisiuran=i.kode_jenisiuran and periode=1)
							join subkursus s on (i.kode_subkursus=s.kode_subkursus)
							join kursus k on (k.kode_kursus=s.kode_kursus) 
							join pembayaran p on (i.kode_iuran=p.kode_iuran and p.id_nota='".$idnota."')
							group by k.kode_kursus
							".$limit."
							");
	}
	public function dp2_query($idnota,$limit)
	{
		return 	$this->db->query("
									select p.kode_pembayaran,
									(select diskon from diskon where date(now()) BETWEEN date(mulai) and 
									date(akhir) and id_jiuran=0 order by mulai DESC limit 1) as diskon_double from jenis_iuran j 
									join iuran i on(j.kode_jenisiuran=i.kode_jenisiuran and periode=1)
									join subkursus s on (i.kode_subkursus=s.kode_subkursus)
									join kursus k on (k.kode_kursus=s.kode_kursus and k.kode_kursus=1) 
									join pembayaran p on (i.kode_iuran=p.kode_iuran and p.id_nota='".$idnota."')
									limit ".$limit."
								");
	}
	public function stokbukuaksi($idnota)
	{
		return $this->db->query("
									select s.kodesk,count(*) as jumlah from jenis_iuran j 
									join iuran i on(j.kode_jenisiuran=i.kode_jenisiuran and stok=1)
									join subkursus s on (i.kode_subkursus=s.kode_subkursus)
									join kursus k on (k.kode_kursus=s.kode_kursus) 
									join pembayaran p on (i.kode_iuran=p.kode_iuran and p.id_nota='".$idnota."')
									group by p.kode_iuran
								");
	
	}
	public function siswa_kenaikan($kursus,$subkursus,$kode_cabang)
	{
	  return $this->db->query("
								select * from
								(
								select s.NIS,s.nama,s.nama_ayah,s.sekolah,
								s.jenis_kelamin,k.nama_kursus,hk.kode_hk,
								sk.kode_subkursus,sk.nama_subkursus,s.kode_cabang from siswa s
								join history_kelas hk on(s.NIS=hk.NIS)
								join subkursus sk on (hk.kode_subkursus=sk.kode_subkursus)
								join kursus k on (k.kode_kursus=sk.kode_kursus)
								where k.kode_kursus='".$kursus."' and s.status='1' and s.verifikasi='1' and s.kode_cabang='".$kode_cabang."'
								order by sk.kode_subkursus DESC
								) as a
								where a.kode_subkursus='".$subkursus."'
							");
	}	
	public function siswa_tingkat($kursus,$subkursus,$kode_cabang)
	{
	  return $this->db->query("
								select * from
								(
								select s.NIS,s.nama,s.nama_ayah,s.sekolah,
								s.jenis_kelamin,k.nama_kursus,hk.kode_hk,
								sk.kode_subkursus,sk.nama_subkursus,s.kode_cabang from siswa s
								join history_kelas hk on(s.NIS=hk.NIS)
								join subkursus sk on (hk.kode_subkursus=sk.kode_subkursus)
								join kursus k on (k.kode_kursus=sk.kode_kursus)
								where k.kode_kursus='".$kursus."' and s.status='1' and s.verifikasi='1' and s.kode_cabang='".$kode_cabang."'
								order by sk.kode_subkursus DESC
								) as a
								where a.kode_subkursus='".$subkursus."' and
								a.NIS not in 
								(
									select ss.NIS from siswa ss
									join kelas_siswa ks on (ks.NIS=ss.NIS)
									join kelas k on (k.kode_kelas=ks.kode_kelas)
									join history_kelas hk on (hk.NIS=ss.NIS and hk.kode_subkursus=k.kode_subkursus)
									where k.kode_subkursus='".$subkursus."' and k.kode_kelas like '%".date('Y')."%' and k.kode_cabang='".$kode_cabang."'
								)
							");
	}
	public function siswa_tingkatedit($kursus,$subkursus,$kode_cabang,$kode_kelas)
	{
	  return $this->db->query("
								select * from
								(
								select s.NIS,s.nama,s.nama_ayah,s.sekolah,
								s.jenis_kelamin,k.nama_kursus,hk.kode_hk,
								sk.kode_subkursus,sk.nama_subkursus,s.kode_cabang from siswa s
								join history_kelas hk on(s.NIS=hk.NIS)
								join subkursus sk on (hk.kode_subkursus=sk.kode_subkursus)
								join kursus k on (k.kode_kursus=sk.kode_kursus)
								where k.kode_kursus='".$kursus."' and s.status='1' and s.verifikasi='1' and s.kode_cabang='".$kode_cabang."'
								order by sk.kode_subkursus DESC
								) as a
								where a.kode_subkursus='".$subkursus."' and
								a.NIS not in 
								(
									select ss.NIS from siswa ss
									join kelas_siswa ks on (ks.NIS=ss.NIS)
									join kelas k on (k.kode_kelas=ks.kode_kelas)
									join history_kelas hk on (hk.NIS=ss.NIS and hk.kode_subkursus=k.kode_subkursus)
									where k.kode_subkursus='".$subkursus."' and k.kode_kelas!='".$kode_kelas."' and k.kode_cabang='".$kode_cabang."'
								)
							");
	}
	public function siswa_tingkatkelas($kursus,$subkursus,$kode_cabang)
	{
	  return $this->db->query("
								select * from
								(
								select s.NIS,s.nama,s.nama_ayah,s.sekolah,
								s.jenis_kelamin,k.nama_kursus,hk.kode_hk,
								sk.kode_subkursus,sk.nama_subkursus,s.kode_cabang from siswa s
								join history_kelas hk on(s.NIS=hk.NIS)
								join subkursus sk on (hk.kode_subkursus=sk.kode_subkursus)
								join kursus k on (k.kode_kursus=sk.kode_kursus)
								where k.kode_kursus='".$kursus."' and s.status='1' and s.verifikasi='1' and s.kode_cabang='".$kode_cabang."'
								order by sk.kode_subkursus DESC
								) as a
								where a.kode_subkursus='".$subkursus."'
							");
	}
	public function count_result($table)
	{
		return $this->db->count_all_results($table);
	}
	
	public function searching($key,$field_1, $tabel, $limit=0, $offset=0){
		$this->db->like($field_1,$key);
		$list_header = $this->list_field($tabel);
		foreach($list_header as $row_field)
		{
			$this->db->or_like($row_field,$key);			
		}
		if($limit==0 && $offset==0){
			$count = $this->db->get($tabel);
			return $count->num_rows();
		}else{
			return $this->db->get($tabel,$limit,$offset);
		}
	}
	
	public function detail($id,$field,$table){
		$this->db->where($field,$id);
		$query = $this->db->get($table);
		if($query->num_rows() > 0)
		{
			return $query;
		}
	}	
	public function get_where($table,$array_field)
	{
		$query = $this->db->get_where($table,$array_field);		
		return $query;
	}	
	public function getTable($sTable ,$aColumns,$ids,array $acts)
    {
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
        $this->db->select('SQL_CALC_FOUND_ROWS '.str_replace(' , ', ' ', implode(', ', $aColumns)), false);
        $rResult = $this->db->get($sTable);
    
        // Data set length after filtering
        $this->db->select('FOUND_ROWS() AS found_rows');
        $iFilteredTotal = $this->db->get()->row()->found_rows;
    
        // Total data set length
        $iTotal = $this->db->count_all($sTable);
    
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
            

            foreach ($acts as $key => $aks) {
            	$act .= '<li><a data-id='.$aRow[$ids].' href="#" ';
            	
            	if( array_key_exists('class', $aks) ){
            		$act .= " class='".$aks['class']."'";
            	}

            	if( array_key_exists('data', $aks) ){
            		$act .= " ".$aks['name']."='".$aks['value']."'";
            	}

            	$act .= '>';

            	if( array_key_exists('icon', $aks) ){
            		$act .= '<i class="icon-eye-open"></i>';
            	}

            	$act .= $aks['label']."</a></li>";
            }

            $act .= '</ul>';

			$row[] =$act;
            $output['aaData'][] = $row;
        }
    
        echo json_encode($output);
    }
	public function js_datatables($id_table,$url_json,$limit,$add='')
	{
		return	'$(document).ready(function()
				{
				var oTable=$(\'#'.$id_table.'\').dataTable({
				"oLanguage": {
				"sProcessing"   : "Memuat...",
				"sZeroRecords"  : "Tidak ada entri.",
				"sInfo"         : "Menampilkan _START_ - _END_ dari _TOTAL_ entri",
				"sInfoEmpty"    : "Menampilkan 0 - 0 dari 0 entri",
				"sInfoFiltered" : "(Disaring dari _MAX_ total entri)",
				"sInfoPostFix"  : "",
				"sSearch"       : "Pencarian",
				"sUrl"			: "",
				"oPaginate": {						
				"sFirst":    "Pertama",							
				"sPrevious": "Sebelumnya",							
				"sNext":     "Selanjutnya",							
				"sLast":     "Terakhir"
				}
				},
				"bProcessing": true,
				"bServerSide": true,
				"sServerMethod": "GET",
				"sAjaxSource": "'.$url_json.'",
				"bPaginate": true,
				"bLengthChange": true,
				"bFilter": true,
				"bSort": true,
				"bInfo": true,
				"bAutoWidth": false,
				"bSortClasses": true,			
				"bStateSave": false,
				"aaSorting": [[0, \'asc\']],
				"iDisplayLength":'.$limit.',
				"aLengthMenu": [5,10,25,50,100],
				"sPaginationType": "full_numbers"
				'.$add.'
				
				})
				
				});';	
	}
	public function paging($segment,$limits,$query,$data_name,$link,$key)
	{
		$page  = $this->uri->segment($segment);
		$limit = $limits;
		if(!$page)
		{
		$offset = 0;
		}
		else
		{
		   $offset = ($page-1)*$limit;
		}
		$config['base_url']    = $link;
		$config['total_rows']  = $this->db->query("$query")->num_rows();
		$config['per_page']    = $limit;
		$config['uri_segment'] = $segment;
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li><a href="#"><font color="#4D4D4D">';
		$config['cur_tag_close'] = '</font></a></li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['first_link']  = 'Awal';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['last_link']   = 'Akhir';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['next_link']   = 'Selanjutnya';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['prev_link']   = 'Sebelumnya';
		$config['use_page_numbers'] = TRUE;
		$this->pagination->initialize($config);
		$data["paginator"]     	  = $this->pagination->create_links();
		$data[$data_name.'_entries'] = $this->db->query("$query limit $offset,$limit")->result_array();
		return $data;
	}
}
