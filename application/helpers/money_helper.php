<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    if( !function_exists("formatWithSuffix") ){
    	function formatWithSuffix($input)
	    {
	        $suffixes = array('', 'k', 'm', 'g', 't');
	        $suffixIndex = 0;
	    
	        while(abs($input) >= 1000 && $suffixIndex < sizeof($suffixes))
	        {
	            $suffixIndex++;
	            $input /= 1000;
	        }
	    
	        return (
	            $input > 0
	                // precision of 3 decimal places
	                ? floor($input * 1000) / 1000
	                : ceil($input * 1000) / 1000
	            )
	            . $suffixes[$suffixIndex];
	    }
    }