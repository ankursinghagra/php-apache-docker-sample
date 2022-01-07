<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists("thumb_str")) {
	function thumb_str($filename)
    {
    	$extension_pos = strrpos($filename, '.'); // find position of the last dot, so where the extension starts
		return substr($filename, 0, $extension_pos) . '_thumb' . substr($filename, $extension_pos);
    }
}