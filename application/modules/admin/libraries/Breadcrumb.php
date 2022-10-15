<?php

/**
 *
 						<ul class="breadcrumb">
							<li>
								<i class="icon-home"></i>
								<a href="<?php echo base_url("backoffice") ?>">Home</a> 
								<span class="icon-angle-right"></span>
							</li>
							<li><a href="#"><?php echo $breadcrumb;?></a></li>

							<li class="pull-right no-text-shadow">
								<div id="dashboard-report-range" class="dashboard-date-range tooltips no-tooltip-on-touch-device responsive" >
									<i class="icon-calendar"></i>
									<span></span>
									<i class="icon-angle-down"></i>
								</div>
							</li>
						</ul>
	**/

class Breadcrumb{


	private $crumbs = array();

	public function __construnct( $crumbs = null ){

	}

	public function add( array $link ){
		array_push($this->crumbs, $link);
	}

	public function render($isDashboard=false){

		$crumb_size = count( $this->crumbs );
		$breadcrumb = '<ul class="breadcrumb">';
		//as home
		$breadcrumb .= '<li>
								<i class="icon-home"></i>
								<a href="'.base_url("admin").'">Home</a> 
								';
		if( $crumb_size > 0 )
			$breadcrumb .= '<span class="icon-angle-right"></span>';
		$breadcrumb .= '</li>';


		foreach ($this->crumbs as $key => $crumb) {
			$breadcrumb .= '
							<li><a href="'.$crumb['link'].'">'.$crumb['label'].'</a>';

			if( $key+1 != $crumb_size )
				$breadcrumb .= '<span class="icon-angle-right"></span>';

			$breadcrumb .= '</li>';
		}

		if( $isDashboard ){
			$breadcrumb .= '<li class="pull-right no-text-shadow">
								<div id="dashboard-report-range" class="dashboard-date-range tooltips no-tooltip-on-touch-device responsive" data-tablet="" data-desktop="tooltips" data-placement="top" data-original-title="Change dashboard date range">
									<i class="icon-calendar"></i>
									<span></span>
									<i class="icon-angle-down"></i>
								</div>
							</li>';
		}

		$breadcrumb .= '</ul>';


		return $breadcrumb;
	}


}
