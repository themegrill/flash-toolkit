<?php
/**
 * Flash Toolkit Admin.
 *
 * @class    FT_Admin
 * @version  1.0.0
 * @package  FlashToolkit/Admin
 * @category Admin
 * @author   ThemeGrill
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * FT_Admin Class
 */
class FT_Admin {

	/**
	 * Hook in tabs.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'includes' ) );
		add_action( 'current_screen', array( $this, 'conditional_includes' ) );
	}

	/**
	 * Includes any classes we need within admin.
	 */
	public function includes() {
		include_once( dirname( __FILE__ ) . '/class-flash-admin-notices.php' );
		include_once( dirname( __FILE__ ) . '/class-flash-admin-assets.php' );
	}

	/**
	 * Include admin files conditionally.
	 */
	public function conditional_includes() {
		if ( ! $screen = get_current_screen() ) {
			return;
		}

		switch ( $screen->id ) {
			case 'options-permalink' :
				include( 'class-flash-admin-permalink-settings.php' );
		}
	}
}

new FT_Admin();
