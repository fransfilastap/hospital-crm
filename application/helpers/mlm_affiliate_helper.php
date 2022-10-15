<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if( !function_exists("print_btree") ){

	function print_btree($downlines){

		if( count( $downlines ) > 0 ){
			
			$img="fill-downline.png";

			if( $downlines[0]["pasien_id"] == "dummy" || $downlines[1] == "dummy" ){
				$class="class='dummy'";
			}

			if( count( $downlines ) == 1 ){
				//echo '<li><a href="#">'.$downlines[0]["pasien_username"].'</a>';

				if( $downlines[0]['pasien_id'] == "dummy" ){
					$img = "fill-downline-dummy.png";
				}

				echo '<li><a href="#"><img title="'.$downlines[0]["pasien_username"].'" src="'.site_url("assets/".$img).'"/></a>';

				if( count( $downlines[0]['pasien_child'] ) > 0 ){
    				echo "<ul>";
    				print_btree( $downlines[0]['pasien_child'] );
    				echo "</ul>";
				}
				else{
					echo "<ul>";
					echo '<li class="empty"><img src="'.site_url("assets/empty.png").'"/></li>';
					echo '<li class="empty"><img src="'.site_url("assets/empty.png").'"/></li>';
					echo "</ul>";
				}
				echo '</li>';
				echo '<li></li>';
			}
			else{
				if( $downlines[0]['pasien_id'] == "dummy" ){
					$img = "fill-downline-dummy.png";
				}
				echo '<li><a href="#"><img title="'.$downlines[0]["pasien_username"].'" src="'.site_url("assets/".$img).'"/></a>';
				if( count( $downlines[0]['pasien_child'] ) > 0 ){
    				echo "<ul>";
    				print_btree( $downlines[0]['pasien_child'] );
    				echo "</ul>";
				}
				else{
					echo "<ul>";
					echo '<li class="empty"><img src="'.site_url("assets/empty.png").'"/></li>';
					echo '<li class="empty"><img src="'.site_url("assets/empty.png").'"/></li>';
					echo "</ul>";
				}
				echo '</li>';
				if( $downlines[1]['pasien_id'] == "dummy" ){
					$img = "fill-downline-dummy.png";
				}
				echo '<li><a href="#"><img title="'.$downlines[1]["pasien_username"].'" src="'.site_url("assets/".$img).'"/></a>';
				if( count( $downlines[1]['pasien_child'] ) > 0 ){
    				echo "<ul>";
    				print_btree( $downlines[1]['pasien_child'] );
    				echo "</ul>";
				}
				else{
					echo "<ul>";
					echo '<li class="empty"><img src="'.site_url("assets/empty.png").'"/></li>';
					echo '<li class="empty"><img src="'.site_url("assets/empty.png").'"/></li>';
					echo "</ul>";
				}
				echo '</li>';
			}
		}	

	}

}