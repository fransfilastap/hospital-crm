<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu
{

	private $menus;
	private $modules;
	private $CI;

	public function __construct()
	{
		$this->CI 	=	&get_instance();
		$this->CI->load->model("m_module");
		$this->CI->load->library("session");
		$this->modules = $this->CI->m_module->_get_module();
		$this->__initialize();
		$this->__check_access_and_status();
	}

	private function __initialize()
	{
		$this->menus = array( 

			array( 
					'name'			=>	'Dashboard' , 
					'href'			=>	site_url( 'admin/dashboard' ) , 
					'status'		=>  true,
					'access'		=>  'all',
					'has_sub'		=>	false , 
					'selected'		=>	false , 
					'has_attribut'	=>	true ,
					'attributes'	=>	array( 'icon' => ' icon-dashboard')
				),
				array( 
					'name'			=>	'Web Portal' , 
					'href'			=>	"#" , 
					'access'		=>  'superuser',
					'status'		=>  true,
					'has_sub'		=>	true , 
					'sub'			=>	array( 
											array( 'name' => 'Posting' , 'href' => site_url( 'admin/blog' ), 'active' => false , 'status' => true, 'access' => 'superuser'),
											array( 'name' => 'Halaman' , 'href' => site_url( 'admin/pages' ), 'active' => false , 'status' => true, 'access' => 'superuser'),
										 	array( 'name' => 'Kategori Posting' , 'href' => site_url( 'admin/category' ), 'active' => false , 'status' => true, 'access' => 'superuser'),
										 	array( 'name' => 'Menu' , 'href' => site_url( 'admin/portal_menu' ), 'active' => false , 'status' => true, 'access' => 'superuser'),
										 ),
					'selected'		=>	false , 
					'has_attribut'	=>	true ,
					'attributes'	=>	array( 'icon' => ' icon-cloud')
				),

				array( 
					'name'			=>	'Master Data' , 
					'href'			=>	'#' , 
					'access'		=>  'superuser',
					'status'		=>  true,
					'has_sub'		=>	true , 
					'sub'			=>	array( 
											array( 'name' => 'Data Pasien' , 'href' => site_url( 'admin/pasiens' ), 'active' => false, 'status' => true, 'access' => 'superuser' ),
											array( 'name' => 'Poliklinik' , 'href' => site_url( 'admin/polikliniks' ), 'active' => false, 'status' => true, 'access' => 'superuser' ),
										 	array( 'name' => 'Dokter' , 'href' => site_url( 'admin/dokters' ), 'active' => false  , 'status' => true, 'access' => 'superuser'),
										 ),
					'selected'		=>	false , 
					'has_attribut'	=>	true ,
					'attributes'	=>	array( 'icon' => 'icon-folder-open')
			),
			array( 
					'name'			=>	'Layanan' , 
					'href'			=>	'#' , 
					'access'		=>  'superuser',
					'status'		=>  true,
					'has_sub'		=>	true , 
					'sub'			=>	array( 
											array( 'name' => 'Kunjungan Poli' , 'href' => site_url('admin/kunjungan_poli'), 'active' => false, 'status' => true, 'access' => 'superuser' ),
											array( 'name' => 'Promosi' , 'href' => site_url('admin/promosi'), 'active' => false, 'status' => true, 'access' => 'superuser' ),
										 	array( 'name' => 'Jadwal Dokter' , 'href' => site_url('admin/jadwal_dokter'), 'active' => false  , 'status' => true, 'access' => 'superuser'),
										 	array( 'name' => 'Kritik & Saran' , 'href' => site_url('admin/feedback'), 'active' => false , 'status' => true, 'access' => 'superuser'),
										 	array( 'name' => 'e-Konsultasi' , 'href' => site_url('admin/ekonsultasi'), 'active' => false , 'status' => true, 'access' => 'superuser'),
										 
										 ),
					'selected'		=>	false , 
					'has_attribut'	=>	true ,
					'attributes'	=>	array( 'icon' => ' icon-heart')
				),
			array( 
					'name'			=>	'SMS Gateaway' , 
					'href'			=>	'#' , 
					'access'		=>  'superuser',
					'status'		=>  true,
					'has_sub'		=>	true , 
					'sub'			=>	array( 
											array( 'name' => 'Kirim SMS' , 'href' => site_url('admin/smsgateaway/kirim_sms'), 'active' => false, 'status' => true, 'access' => 'superuser' ),
											array( 'name' => 'Kotak Masuk' , 'href' => site_url('admin/smsgateaway/inbox'), 'active' => false, 'status' => true, 'access' => 'superuser' ),
										 	array( 'name' => 'Pesan Terkirim' , 'href' => site_url('admin/smsgateaway/sent'), 'active' => false  , 'status' => true, 'access' => 'superuser'),
										 	//array( 'name' => 'Template' , 'href' => "#", 'active' => false , 'status' => true, 'access' => 'superuser'),
										 	//array( 'name' => 'Kontak' , 'href' => "#", 'active' => false , 'status' => true, 'access' => 'superuser'),
										 	//array( 'name' => 'Group' , 'href' => "#", 'active' => false , 'status' => true, 'access' => 'superuser'),
										 
										 ),
					'selected'		=>	false , 
					'has_attribut'	=>	true ,
					'attributes'	=>	array( 'icon' => 'icon-envelope')
				),
			array( 
					'name'			=>	'Laporan' , 
					'href'			=>	site_url( 'admin/report' ) , 
					'status'		=>  true,
					'access'		=>  'superuser',
					'has_sub'		=>	false , 
					'selected'		=>	false , 
					'has_attribut'	=>	true ,
					'attributes'	=>	array( 'icon' => ' icon-bar-chart')
				),
			array( 
					'name'			=>	'Control Panel' , 
					'href'			=>	'#' , 
					'access'		=>  'superuser',
					'status'		=>  true,
					'has_sub'		=>	true , 
					'sub'			=>	array( 
											array( 'name' => 'Pengguna' , 'href' => site_url( 'admin/administrator_management' ), 'active' => false , 'status' => true, 'access' => 'superuser'),
											//array( 'name' => 'Kelompok Pengguna' , 'href' => site_url( 'admin/module_setting' ), 'active' => false , 'status' => true, 'access' => 'superuser' ),
											array( 'name' => 'Akses' , 'href' => site_url( 'admin/module_setting' ), 'active' => false , 'status' => true, 'access' => 'superuser' ),
										 ),
					'selected'		=>	false , 
					'has_attribut'	=>	true ,
					'attributes'	=>	array( 'icon' => 'icon-wrench')
				),
						
						
		);

		$current_menu_index = 0;

		for( $i=0; $i < count( $this->modules ); $i++ )
		{

			for( $j=$current_menu_index ; $j<count( $this->menus ); $j++ )
			{

				if( strtolower($this->menus[$j]['name']) == strtolower($this->modules[$i]['module_name']) )
				{
					$this->menus[$j]['status'] =  ( $this->modules[$i]['module_mode'] == 1 ? true : false );
					$this->menus[$j]['access'] =  $this->modules[$i]['access'];
					break;
				}
				else{
					if( $this->menus[$j]['has_sub'] )
					{
							for( $k=0 ; $k<count( $this->menus[$j]['sub'] ); $k++ )
							{
								if( strtolower($this->menus[$j]['sub'][$k]['name']) == strtolower($this->modules[$i]['module_name']) )
								{
									/*echo "SUBMENU FOUND IN: ".$this->menus[$j]['sub'][$k]['name']. " FOR ".$this->modules[$i]['module_name']."\n"; */
									$this->menus[$j]['sub'][$k]['status'] =  ( $this->modules[$i]['module_mode'] == 1? true : false );
									$this->menus[$j]['sub'][$k]['access'] =  $this->modules[$i]['access'];
									break;
								}
							}
					}
				}
			}

		}

	}

	private function __check_access_and_status()
	{

		
		$admin_role = $this->CI->session->userdata("current_admin_role");

		if( $admin_role != "superuser" )
		{
			foreach ($this->menus as $key => $menu) 
			{
				if( $menu['status'] == false )
				{
					unset($this->menus[$key]);
				}
				else
				{
					if( strtolower($menu['access']) == strtolower("superuser") )
					{
						unset($this->menus[$key]);
					}

					if( $menu['access'] == "admin" )
					{
						if( $admin_role != "admin" ){
							unset($this->menus[$key]);
						}
							
					}


					if( $menu['has_sub'] )
					{
						foreach ( $menu['sub'] as $key2 => $submenu) {
							
							if( $submenu['status']  == false )
							{
								unset( $this->menus[$key]['sub'][$key2] );
							}
							else
							{
								if( strtolower($submenu['access']) == strtolower("superuser") )
								{
									unset( $this->menus[$key]['sub'][$key2] );
								}

								if( strtolower($submenu['access']) == strtolower("admin") )
								{
									if( strtolower($admin_role) != strtolower("admin") ){
										unset( $this->menus[$key]['sub'][$key2] );
									}
										
									if( $submenu['status'] == FALSE ){
										unset( $this->menus[$key]['sub'][$key2] );
									}
										
								}

								if( strtolower($submenu['access']) == strtolower("dokter") )
								{
									if( strtolower($admin_role) != strtolower("dokter") ){
										unset( $this->menus[$key]['sub'][$key2] );
									}
										
									if( $submenu['status'] == FALSE ){
										unset( $this->menus[$key]['sub'][$key2] );
									}
										
								}
							}
						}
					}
				}
			}
		}

	}

	public function get_menus( $selected_menu = 'Dashboard')
	{
		
		foreach ($this->menus as $key => $menu) {
			
			if( strtolower( $selected_menu ) === strtolower( $menu['name'] ) )
			{
				$this->menus[$key]['selected']	=	true;
			}
			else
			{
				if( $menu['has_sub'] )
				{

					foreach ( $menu['sub'] as $key2 => $submenu) {
					
						if( strtolower( $selected_menu ) === strtolower( $submenu['name'] ) )
						{
							$this->menus[$key]['selected']	=	true;
							$this->menus[$key]['sub'][$key2]['active']	=	'active';
							break;
						}
					}
				}
			}

		}

		return $this->menus;
	}
}