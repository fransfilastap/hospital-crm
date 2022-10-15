<?php  if ( ! defined('BASEPATH')) exit('No direct script access superuserowed');

class report_model extends CI_Model
{
	public function __construct(){
		parent::__construct();
	}


	public function kunjungan_poli_by($by,$date1,$date2){

		$query = $this->db->query("SELECT 
								nama_poliklinik, COUNT(*) AS banyak 
							FROM `kunjungan_poli` 
							LEFT JOIN 
								`poliklinik` ON `id_poliklinik` = `id_poli` 
							WHERE tanggal_kunjungan BETWEEN '$date1' AND '$date2' 

							GROUP BY `$by`");

		$rResult = $query->result();


		return $rResult;

	}


	public function laporan_kunjungan($date1,$date2){

		$main_data 		= $this->main_data_kunjungan($date1,$date2);
		$resume_data 	= $this->resume_data_kunjungan($date1,$date2);

		$return_data = array(
					"main_data" => $main_data,
					"resume"	=> $resume_data
			);

		return $return_data;

	}

	public function main_data_kunjungan($date1,$date2){
		$sql = "SELECT `id_kunjungan`,
						( CASE WHEN (`pasien`.`id_pasien` IS NULL) THEN 'Unknown' ELSE `pasien`.`id_pasien` END) AS id_pasien,
						( CASE WHEN (`nama_pasien` IS NULL) THEN 'Unknown' ELSE `nama_pasien` END) AS `nama_pasien`,
						(CASE WHEN (`jenis_kelamin` = 'L') THEN 'Laki-laki' WHEN(jenis_kelamin = 'P') THEN 'Perempuan' ELSE 'Unknown' END) AS jenis_kelamin,
						( CASE WHEN ((DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(tanggal_lahir, '%Y') - (DATE_FORMAT(NOW(), '00-%m-%d') < DATE_FORMAT(tanggal_lahir, '00-%m-%d'))) IS NULL ) THEN 0 ELSE (DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(tanggal_lahir, '%Y') - (DATE_FORMAT(NOW(), '00-%m-%d') < DATE_FORMAT(tanggal_lahir, '00-%m-%d') ) ) END ) AS umur,
						( CASE WHEN nama_poliklinik IS NULL THEN 'Unknown' ELSE nama_poliklinik END ) AS nama_poliklinik
				FROM `kunjungan_poli` 
				LEFT JOIN pasien ON `kunjungan_poli`.`id_pasien` = `pasien`.`id_pasien`
				LEFT JOIN `poliklinik` ON `id_poliklinik` = `id_poli` 
				WHERE tanggal_kunjungan BETWEEN '$date1' AND '$date2'";
		$query = $this->db->query($sql);

		$rResult = $query->result();

		return $rResult;
	}

	public function resume_data_kunjungan($date1,$date2){
		
		$sql2 = 'SELECT UPPER("<h4>Berdasarkan Poliklinik</h4>") AS label,
						"<h4>JUMLAH</h4>" AS total
					UNION
					( 
						SELECT 
								CONCAT("Pengunjung ",CASE WHEN (nama_poliklinik IS NULL) THEN "Unknown" ELSE nama_poliklinik END),
								COUNT(*)
						FROM kunjungan_poli 
						LEFT JOIN 
							`poliklinik` 
							ON `id_poliklinik` = `id_poli`  
						WHERE (tanggal_kunjungan BETWEEN "'.$date1.'" AND "'.$date2.'") GROUP BY id_poli 
					)
					UNION( 
						SELECT UPPER("<h4>Berdasarkan Gender</h4>"),
						"<h4>JUMLAH</h4>"
					)
					UNION( 
						SELECT 
							(CASE WHEN (jenis_kelamin = "P") THEN "Pengunjung Wanita" WHEN (jenis_kelamin = "L") THEN "Pengunjung Pria" ELSE "Pengunjung Unknown" END),
							COUNT(*)
						FROM kunjungan_poli 
						LEFT JOIN pasien 
						ON `kunjungan_poli`.`id_pasien` = `pasien`.`id_pasien`
						WHERE (tanggal_kunjungan BETWEEN "'.$date1.'" AND "'.$date2.'") GROUP BY jenis_kelamin 
					)
					UNION( 
						SELECT "<h4>TOTAL</h4>",
								CONCAT("<h4>",COUNT(*),"</h4>")
						FROM kunjungan_poli 
						WHERE 
						tanggal_kunjungan BETWEEN "'.$date1.'" AND "'.$date2.'" 
					)';

		$query2 = $this->db->query( $sql2 );

		$rResult2 = $query2->result();

		return $rResult2;
	}


	function loyalitas($start,$end){
		
		$sql = "SELECT
				`pasien`.`id_pasien`,
				`pasien`.`nama_pasien`,
				`pasien`.`jenis_kelamin`,
				`pasien`.`no_telp`,
				CASE WHEN( periodeini ) IS NULL THEN 0 ELSE periodeini END as periodeini,
				CASE WHEN( total ) IS NULL THEN 0 ELSE total END AS total,
				CASE WHEN (MAX(`kunjungan_poli`.`tanggal_kunjungan`)) IS NULL THEN '' ELSE MAX(`kunjungan_poli`.`tanggal_kunjungan`) END AS terakhir
			FROM `pasien`
			LEFT JOIN `kunjungan_poli` ON `pasien`.`id_pasien` = `kunjungan_poli`.`id_pasien`
			LEFT JOIN ( SELECT
					`pasien`.`id_pasien`,
					(CASE WHEN(COUNT(*)) IS NULL THEN 0 ELSE COUNT(*) END ) AS total
					FROM `pasien`
					INNER JOIN `kunjungan_poli` 
					ON `pasien`.`id_pasien` = `kunjungan_poli`.`id_pasien` 
					GROUP BY `pasien`.`id_pasien`
				) AS other 
				ON other.id_pasien = pasien.id_pasien
						LEFT JOIN ( SELECT
					`pasien`.`id_pasien`,
					COUNT(*) AS periodeini
					FROM `pasien`
					LEFT JOIN `kunjungan_poli` 
					ON `pasien`.`id_pasien` = `kunjungan_poli`.`id_pasien` 
					WHERE kunjungan_poli.tanggal_kunjungan BETWEEN '$start' AND '$end'
					GROUP BY `pasien`.`id_pasien`
				) AS other2 
				ON other2.id_pasien = pasien.id_pasien
			GROUP BY `pasien`.`id_pasien`";

		$query 		= 	$this->db->query( $sql );
		$rResult 	=	$query->result();

		return $rResult;

	}

	public function laporan_feedback($start,$end){

		$sql = "SELECT * FROM `kritik_saran` WHERE `kritik_saran`.time BETWEEN '$start' AND '$end'";


		$query = $this->db->query( $sql );
		$rResult = $query->result();


		return $rResult;


	}
}