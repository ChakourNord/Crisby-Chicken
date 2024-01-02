<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

/**
* Include xcrud libraries
*/
if ( ! function_exists('get_xcrud'))
{
	function get_xcrud($name = false){
		require_once FCPATH . 'assets/vendor/xcrud/xcrud.php';
		return Xcrud::get_instance($name);
	}
}

/**
* Get html <header> css <link> tags for xcrud & its plugins.
* This function can only get called after calling get_xcrud()
*/
if ( ! function_exists('get_xcrud_css'))
{
	function get_xcrud_css(){
		return Xcrud::load_css();
	}
}

/**
* Get html <script> tags for xcrud & its plugins.
* This function can only get called after calling get_xcrud()
*/
if ( ! function_exists('get_xcrud_js'))
{
	function get_xcrud_js(){
		return Xcrud::load_js();
	}
}


/* End of file Xcrud_helper.php */