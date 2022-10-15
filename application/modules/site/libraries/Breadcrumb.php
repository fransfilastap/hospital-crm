<?php

/**
 *
	<section id="inner-headline">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<ul class="breadcrumb">
					<li><a href="#"><i class="fa fa-home"></i></a><i class="icon-angle-right"></i></li>
					<li><a href="#">Features</a><i class="icon-angle-right"></i></li>
					<li class="active">Pricing box</li>
				</ul>
			</div>
		</div>
	</div>
	<section id="content">
	**/

class Breadcrumb{


	private $crumbs = array();

	public function __construnct( $crumbs = null ){

	}

	public function add( array $link ){
		array_push($this->crumbs, $link);
	}

	public function render(){

		$crumb_size = count( $this->crumbs );
		$breadcrumb = '	<section id="inner-headline">
						<div class="container">
							<div class="row">
								<div class="col-lg-12">';
		$breadcrumb .= '<ul class="breadcrumb">';
		//as home
		$breadcrumb .= '<li><a href="'.base_url().'"><i class="fa fa-home"></i></a> ';
		if( $crumb_size > 0 )
			$breadcrumb .= '<i class="icon-angle-right"></i>';
		$breadcrumb .= '</li>';


		foreach ($this->crumbs as $key => $crumb) {
			$breadcrumb .= '
							<li><a href="'.$crumb['link'].'">'.$crumb['label'].'</a>';

			if( $key+1 != $crumb_size )
				$breadcrumb .= '<i class="icon-angle-right"></i>';

			$breadcrumb .= '</li>';
		}


		$breadcrumb .= '				</ul>
			</div>
		</div>
	</div>
	</section>';


		return $breadcrumb;
	}


}