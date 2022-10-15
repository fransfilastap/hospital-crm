<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu
{

	private $menus;

	public function __construct()
	{
		$this->CI 	=	&get_instance();
		$this->__initialize();
	}

	private function __initialize()
	{
		$this->menus = array( 

			array( 
					'name'			=>	'Dashboard' , 
					'href'			=>	site_url( 'pasien/dashboard' ) , 
					'has_sub'		=>	false , 
					'selected'		=>	false , 
					'has_attribut'	=>	true ,
					'attributes'	=>	array( 'icon' => ' icon-dashboard')
				),
			
			array( 
					'name'			=>	'Akun Anda' , 
					'href'			=>	site_url( 'pasien/profil' ) , 
					'has_sub'		=>	true , 
					'sub'			=>	array( 
											array( 'name' => 'Biodata' , 'href' => site_url( 'pasien/profil' ), 'active' => false ),
											array( 'name' => 'Ubah Password' , 'href' => site_url( 'pasien/change_password' ), 'active' => false ),
										 ),
					'selected'		=>	false , 
					'has_attribut'	=>	true ,
					'attributes'	=>	array( 'icon' => 'icon-user')
				),
			array( 
					'name'			=>	'Deposit' , 
					'href'			=>	site_url( 'pasien/deposit' ) , 
					'has_sub'		=>	false , 
					'selected'		=>	false , 
					'has_attribut'	=>	true ,
					'attributes'	=>	array( 'icon' => 'icon-sitemap')
				),
			array( 
					'name'			=>	'Withdraw Bonus' , 
					'href'			=>	site_url( 'pasien/bonus' ) , 
					'has_sub'		=>	false , 
					'selected'		=>	false , 
					'has_attribut'	=>	true ,
					'attributes'	=>	array( 'icon' => 'icon-sitemap')
				),

			array(
					'name'			=> 'Client Anda',
					'href'			=>	site_url( 'pasien/clients' ) , 
					'has_sub'		=>	false , 
					'selected'		=>	false , 
					'has_attribut'	=>	true ,
					'attributes'	=>	array( 'icon' => ' icon-list')

				),
			array( 
					'name'			=>	'History Transaksi' , 
					'href'			=>	site_url( 'pasien/history' ) , 
					'has_sub'		=>	false , 
					'selected'		=>	false , 
					'has_attribut'	=>	true ,
					'attributes'	=>	array( 'icon' => ' icon-money')
				),
			array( 
					'name'			=>	'Panduan' , 
					'href'			=>	site_url( 'pasien/panduan' ) , 
					'has_sub'		=>	false , 
					'selected'		=>	false , 
					'has_attribut'	=>	true ,
					'attributes'	=>	array( 'icon' => 'icon-book')
				),
						
		);

	}

	public function get_menus( $selected_menu = 'Dashboard', $selected_submenu = ''  )
	{
		
		foreach ($this->menus as $key => $menu) {
			
			if( strtolower( $selected_menu ) === strtolower( $menu['name'] ) )
			{
				$this->menus[$key]['selected']	=	true;

				if( $menu['has_sub'] )
				{

					foreach ( $menu['sub'] as $key2 => $submenu) {
					
						if( strtolower( $selected_submenu ) === strtolower( $submenu['name'] ) )
						{
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