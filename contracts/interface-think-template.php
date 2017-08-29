<?php

if ( ! interface_exists( 'Think_Template' ) ) {
	/**
	 * Contract for view elements render
	 *
	 * Interface Think_Template
	 *
	 * @package wp-think-framework
	 */
	interface Think_Template {
        /**
         * render html
         *
         * @param array $data
         */
	    public static function render( array $data );
	}
}