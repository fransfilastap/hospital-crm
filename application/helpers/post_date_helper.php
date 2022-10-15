<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if( !function_exists( 'format_date' ) )
{
	function format_date($date)
	{
		$year = substr($date, 0,4);
		$month = substr($date, 5,2);
		$date = substr($date, 8,2);

		switch ($month) {
			case 1:
				$month = "Januari";
				break;
			case 2:
				$month = "Februari";
				break;
			case 3:
				$month = "Maret";
				break;
			case 4:
				$month = "April";
				break;
			case 5:
				$month = "Mei";
				break;
			case 6:
				$month = "Juni";
				break;
			case 7:
				$month = "Juli";
				break;
			case 8:
				$month = "Agustus";
				break;
			case 9:
				$month = "September";
				break;
			case 10:
				$month = "Oktober";
				break;
			case 11:
				$month = "November";
				break;
			case 12:
				$month = "Desember";
				break;
			
			default:
				$month = "-";
				break;
		}

		return $date." ".$month." ".$year;



	}
}
