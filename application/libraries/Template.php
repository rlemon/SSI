<?php
class Template {

	function titlecase( $str ) {
		$words = explode('_', $str); 
		$results = '';
		foreach($words as $word) {
			$results .= ucfirst( $word ) . ' ';
		}
		return rtrim( $results );
	}

	function load($view, $data = null)
	{
		$CI = &get_instance();

		$headData = array_key_exists('styles', $data) ? array('styles' => $data['styles']) : array();
		$footData = array_key_exists('scripts', $data) ? array('scripts' => $data['scripts']) : null;

		unset( $data['scripts'] );
		unset( $data['styles'] );

		$headData['controller'] = $CI->router->fetch_class();
		echo $headData['controller'];
		$headData['logged_in'] = $CI->tank_auth->is_logged_in();
		
		if( array_key_exists('styles', $headData) ) {
			array_push( $headData['styles'], base_url('application/assets/css/layout.css') );
		} else {
			$headData['styles'] = array( base_url('application/assets/css/layout.css') );
		}

		$CI->load->view('global/header', $headData );

		$breadcrumbs = array();
		$uri = uri_string();
		
		if( empty( $uri ) ) {
			$uri = $headData['controller'];
		}

		while( !empty( $uri ) ) {
			$title = explode('/', $uri);
			array_push( $breadcrumbs, array( 'path' => $uri, 'title' => $this->titlecase( $title[count($title)-1] ) ) );
			$uri = substr( $uri, 0, strrpos( $uri, '/' ) );
		}
		$tmp['breadcrumbs'] = array_reverse( $breadcrumbs );

		$CI->load->view('global/breadcrumbs.php', $tmp );

		$CI->load->view($view, $data);

		if( $footData ) {
			$CI->load->view('global/footer', $footData );
		} else {
			$CI->load->view('global/footer');
		}

	}

}
?>
