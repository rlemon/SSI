<?php
class Bootstrap {
	function __construct() {
		$url = isset( $_GET[ 'url' ] ) ? explode( '/', rtrim( $_GET[ 'url' ], '/' ) ) : null;
		if ( empty( $url[ 0 ] ) ) {
			$url[ 0 ] = 'dashboard'; // default value
		}
		$file = PATH_CONTROLLERS . $url[ 0 ] . '.php';
		if ( file_exists( $file ) ) {
			require $file;
		} else {
			$this->error();
		}
		$controller = new $url[ 0 ];
		$controller->loadModel( $url[ 0 ] );
		if ( isset( $url[ 1 ] ) ) {
			if ( !method_exists( $controller, $url[ 1 ] ) ) {
				$this->error();
			}
			$params = array_slice( $url, 2 );
			call_user_func_array( array(
				 $controller,
				$url[ 1 ] 
			), $params );
		} else {
			$controller->index();
		}
	}
	function error() {
		require PATH_CONTROLLERS . 'error.php';
		$controller = new Error();
		$controller->index();
		return false;
	}
}
