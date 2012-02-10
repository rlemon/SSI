<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Template
 *
 * Simple template loader for CodeIgniter
 *
 * @package		Template
 * @author		Robert Lemon
 * @version		0.0.1
 */
class Template {

	function titlecase( $str ) {
		$words = explode('_', $str); 
		$results = '';
		foreach($words as $word) {
			$results .= ucfirst( $word ) . ' ';
		}
		return rtrim( $results );
	}

	function load($view, $data = array())
	{

		$CI = &get_instance();
		$data_head = array();
		$data_foot = array();
		
		/* check for additional styles 
		 * If they are included push to header
		 * and remove entry from the data
		 * */
		if( array_key_exists('styles', $data) ) {
			$data_head['styles'] = $data['styles'];
			unset( $data['styles'] );
		}

		/* check for additional scripts 
		 * If they are included push to footer
		 * and remove entry from the data
		 * */
		if( array_key_exists('scripts', $data) ) {
			$data_foot['scripts'] = $data['scripts'];
			unset( $data['scripts'] );
		}


		$data_head['base_controller'] = $CI->uri->segment(1);
		
		$data_head['logged_in'] = $CI->tank_auth->is_logged_in();

		/* Load header
		 * */
		$CI->load->view('global/header', $data_head );
		
		/* Breadcrumbs!!! 
		 * */
		$breadcrumbs = array();
		$uri = uri_string();

		if( empty( $uri ) ) {
			$uri = $data_head['base_controller'];
		}

		while( !empty( $uri ) ) {
			$title = explode('/', $uri);
			array_push( $breadcrumbs, array( 'path' => $uri, 'title' => $this->titlecase( $title[count($title)-1] ) ) );
			$uri = substr( $uri, 0, strrpos( $uri, '/' ) );
		}
		$tmp['breadcrumbs'] = array_reverse( $breadcrumbs );

		$CI->load->view('global/breadcrumbs.php', $tmp );
		
		/* Main view
		 * */
		 
		$CI->load->view($view, $data);

		/* Load footer
		 * */
		$CI->load->view('global/footer', $data_foot );

	}

}
?>
