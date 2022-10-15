<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Site_Model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	function get_last_blog()
	{
		$this->db->select();
		$this->db->from("posts");
		$this->db->where('blog_status','langsung publish');
		$this->db->where("blog_type","post");
		$this->db->order_by("blog_date", "desc");
		$this->db->limit(12);

		$query = $this->db->get();
		return $query->result(); 
	}

	function get_post( $id )
	{
		$this->db->select();
		$this->db->from("posts");
		$this->db->join("categories","category = id_category","left");
		$this->db->where("blog_id",$id);
		$this->db->where("blog_type","post");
		return $this->db->get()->row();
	}
	
	function get_promo( $id )
	{
		$this->db->select();
		$this->db->from("promosi");
		$this->db->where("id_promosi",$id);
		return $this->db->get()->row();
	}

	function get_page( $id )
	{
		$this->db->select();
		$this->db->from("halaman");
		$this->db->where("id_halaman",$id);
		return $this->db->get()->row();
	}

	function get_ask( $id )
	{
		$this->db->select();
		$this->db->from("konsultasi");
		$this->db->join("dokter","konsultasi.id_dokter = dokter.id_dokter","left");
		$this->db->where("id",$id);
		$this->db->where("tampilkan",1);
		return $this->db->get()->row();
	}

	function count_blog_by_cat($id){

		$this->db->select();
		$this->db->from("posts");
		$this->db->where("category",$id);
		$query = $this->db->get();

		return $query->num_rows();
	}


	function get_blog_by_category( $category_id, $limit , $start )
	{
		$this->db->select();
		$this->db->from("posts");
		$this->db->join("categories","category = id_category","left");
		$this->db->where('category',$category_id);
		$this->db->where('blog_status','langsung publish');
		$this->db->where("blog_type","post");
		$this->db->order_by("blog_date", "desc");
		$this->db->limit($limit,$start);

		$query = $this->db->get();
		return $query->result(); 
	}

	function get_all_blog($limit,$start)
	{
		$this->db->select();
		$this->db->from("posts");
		$this->db->join("categories","category = id_category","left");
		$this->db->where('blog_status','langsung publish');
		$this->db->where("blog_type","post");
		$this->db->order_by("blog_timestamp", "desc");
		$this->db->limit($limit,$start);

		$query = $this->db->get();
		return $query->result();
	}

	function get_all_promo($limit,$start)
	{
		$this->db->select();
		$this->db->from("promosi");
		$this->db->where("tampil","1");
		$this->db->order_by("tgl_promosi","desc");
		$this->db->limit($limit,$start);

		$query = $this->db->get();
		return $query->result();
	}

	function count_data($table)
	{
		return $this->db->count_all_results($table);
	}

	function get_category( $id )
	{
		$this->db->select();
		$this->db->from("categories");
		$this->db->where("id_category",$id);
		$query = $this->db->get();

		return $query->result();

	}

	function get_all_category()
	{

		$sql = 'SELECT id_category,category_name, COUNT(*) AS total_post
				FROM categories 
				LEFT JOIN `posts` 
				ON `categories`.`id_category` = `posts`.`category` 
				GROUP BY id_category
				UNION
				SELECT 0,"Uncategorized", COUNT(*) FROM posts WHERE category = 0';

		$oResult = $this->db->query($sql);


		return $oResult->result();

	}

	function get_root_menu()
	{
		$sql = "SELECT a.menu_id,
						a.menu_title , 
						a.menu_content, 
						a.menu_status, 
						child.CCount as child_count
				FROM portal_menu a 
				LEFT JOIN 
					(SELECT menu_parent,COUNT(*) AS CCount FROM portal_menu GROUP BY menu_parent) 
					child ON child.menu_parent = a.menu_id 
					where a.menu_parent = 0 and menu_status = 1
				order by menu_order asc";

		$query = $this->db->query( $sql );

		return $query->result();
	}

	function get_child_menu( $parent )
	{
		$this->db->select("menu_id,menu_content,menu_title");
		$this->db->from("portal_menu");
		$this->db->where("menu_parent",$parent);
		
		return $this->db->get()->result();
	}

	function get_promotion(){

	}

	function get_all_ask($limit,$start)
	{
		$this->db->select();
		$this->db->from("konsultasi");
		$this->db->where("tampilkan",1);
		$this->db->order_by("timestamp", "desc");
		$this->db->limit($limit,$start);

		$query = $this->db->get();
		return $query->result();
	}

	function save_registration(){

	}

	function get_jadwal(){
		
		$this->db->select( 'dokter.nama,
							nip_dokter,
							spesialisasi,
							CASE WHEN (
									GROUP_CONCAT(
											CONCAT(
												waktu_jadwal.hari,"(",waktu_mulai,"-",waktu_akhir,")") 
											SEPARATOR " | ")
								 ) IS NULL THEN "Belum ada jadwal" 
								 
								 ELSE GROUP_CONCAT(
											CONCAT(
												waktu_jadwal.hari,"(",waktu_mulai,"-",waktu_akhir,")") 
											SEPARATOR " </br> ") end AS jadwal',FALSE);

		$this->db->from("dokter");
		$this->db->join('jadwal_dokter', 'dokter.id_dokter = jadwal_dokter.id_dokter ', 'left');
		$this->db->join('waktu_jadwal', 'waktu_jadwal.id_waktu_jadwal = jadwal_dokter.id_waktu', 'left');
		$this->db->group_by("dokter.id_dokter");


		$rResult = $this->db->get();
		return $rResult->result();
	}
}