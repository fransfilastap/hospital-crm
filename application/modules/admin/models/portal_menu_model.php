<?php  if ( ! defined('BASEPATH')) exit('No direct script access superuserowed');

class Portal_Menu_Model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function get_page_list()
	{
		$this->db->select();
		$this->db->from("halaman");

		return $this->db->get()->result();
	}

	public function get_category_list()
	{
		$this->db->select();
		$this->db->from("categories");
		return $this->db->get()->result();
	}

	public function get_all_menu()
	{
		$this->db->select("	portal_menu.menu_id, 
							portal_menu.menu_title, 
							portal_menu.menu_order,
							parent_menu.menu_title AS parent_title,
							portal_menu.menu_content,
							portal_menu.menu_status, 
							portal_menu.menu_type,
							(SELECT menu_order from portal_menu order by menu_order asc limit 1) as first_menu,
							(SELECT menu_order from portal_menu order by menu_order desc limit 1) as last_menu,
							");
		$this->db->from("portal_menu");
		$this->db->join("portal_menu as parent_menu","parent_menu.menu_id = portal_menu.menu_parent","left");
		$this->db->order_by("portal_menu.menu_order", "asc"); 
		return $this->db->get()->result();
	}


	public function order_up($id){
		$sql = "SELECT (menu_order-1) as order_now from portal_menu where menu_id = $id";
		$query_order_seharusnya = $this->db->query( $sql,FALSE);
		$order			 		= $query_order_seharusnya->result();
		$order_nya 				= $order[0]->order_now;
		$query_id 				= $this->db->query("SELECT menu_id from portal_menu where menu_order = $order_nya",FALSE);
		$idx 					= $query_id->result();
		$id_nya					= $idx[0]->menu_id;

		$this->db->query("UPDATE portal_menu SET menu_order = 543 WHERE menu_id = $id_nya",TRUE);
		$this->db->query("UPDATE portal_menu SET menu_order = $order_nya where menu_id = $id",FALSE);
		$this->db->query("UPDATE portal_menu SET menu_order = ".($order_nya+1)." where menu_id = $id_nya",FALSE);
	}

	public function order_down($id){
		$sql_kampang = "SELECT (menu_order+1) as order_now from portal_menu where menu_id = $id";
		echo $sql_kampang;
		$query_order_seharusnya = $this->db->query($sql_kampang,FALSE);
		$order			 		= $query_order_seharusnya->result();
		$order_nya 				= $order[0]->order_now;
		$query_id 				= $this->db->query("SELECT menu_id from portal_menu where menu_order = $order_nya",FALSE);
		$idx 					= $query_id->result();
		$id_nya					= $idx[0]->menu_id;

		$this->db->query("UPDATE portal_menu SET menu_order = 543 WHERE menu_id = $id_nya",TRUE);
		$this->db->query("UPDATE portal_menu SET menu_order = $order_nya where menu_id = $id",FALSE);
		$this->db->query("UPDATE portal_menu SET menu_order = ".($order_nya-1)." where menu_id = $id_nya",FALSE);
	}

	public function get_detail( $id )
	{
		$this->db->select();
		$this->db->from("portal_menu");
		$this->db->where("menu_id",$id);
		return $this->db->get()->result();
	}

	public function insert_menu( array $menu )
	{
		return $this->db->insert( "portal_menu", $menu );
	}

	public function update_menu( array $menu, $id ){
		$this->db->where( "menu_id", $id );
		return $this->db->update( "portal_menu" , $menu );
	}

	public function delete_menu( $id )
	{
		$this->db->where("menu_id",$id);
		return $this->db->delete("portal_menu");
	}
}