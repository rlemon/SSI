<?php
class Controller {

	function __construct() {
		$this->view = new View();
	}
	public function loadModel( $name ) {
		
		$path = PATH_MODELS . $name . '.php';
		if ( file_exists( $path ) ) {
			require $path;
			$modelName = $name . MODEL_NAME_POSTPEND;
			$this->model = new $modelName();
		}
	}
}
