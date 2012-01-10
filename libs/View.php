<?php
class View {
	function __construct() {
	}
	public function render( $name, $noInclude = false ) {
		$this->themes = array(
			'base',
			'blitzer',
			'dot-luv',
			'eggplant',
			'excite-bike',
			'flick',
			'hot-sneaks',
			'humanity',
			'le-frog',
			'overcast',
			'pepper-grinder',
			'redmond',
			'smoothness',
			'south-street',
			'sunny',
			'ui-darkness',
			'ui-lightness',
			'vader'
		);
		if ( $noInclude == true ) {
			require 'views/' . $name . '.php';
		} else {
			if( isset( $this->widgets ) ) {
				foreach( $this->widgets as $widget_file ) {
					require 'views/' . $widget_file;
				}
			}
			require 'views/header.php';
			require 'views/' . $name . '.php';
			require 'views/footer.php';
		}
	}
}
