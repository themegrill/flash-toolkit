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
		add_action( 'admin_footer', 'flash_print_js', 25 );
		add_filter( 'admin_footer_text', array( $this, 'admin_footer_text' ), 1 );
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

	/**
	 * Change the admin footer text on Flash Toolkit admin pages.
	 * @param  string $footer_text
	 * @return string
	 */
	public function admin_footer_text( $footer_text ) {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		$current_screen = get_current_screen();

		// Check to make sure we're on a Flash Toolkit admin page
		if ( isset( $current_screen->id ) && apply_filters( 'flash_toolkit_display_admin_footer_text', in_array( $current_screen->id, array( 'edit-portfolio', 'portfolio' ) ) ) ) {
			// Change the footer text
			if ( ! get_option( 'flash_toolkit_admin_footer_text_rated' ) ) {
				$footer_text = sprintf( __( 'If you like <strong>Flash Toolkit</strong> please leave us a %s&#9733;&#9733;&#9733;&#9733;&#9733;%s rating. A huge thanks in advance!', 'flash-toolkit' ), '<a href="https://wordpress.org/support/view/plugin-reviews/flash-toolkit?filter=5#postform" target="_blank" class="flash-toolkit-rating-link" data-rated="' . esc_attr__( 'Thanks :)', 'flash-toolkit' ) . '">', '</a>' );
				flash_enqueue_js( "
					jQuery( 'a.flash-toolkit-rating-link' ).click( function() {
						jQuery.post( '" . FT()->ajax_url() . "', { action: 'flash_toolkit_rated' } );
						jQuery( this ).parent().text( jQuery( this ).data( 'rated' ) );
					});
				" );
			} else {
				$footer_text = __( 'Thank you for creating with Flash Toolkit.', 'axiscomposer' );
			}
		}

		return $footer_text;
	}
}

new FT_Admin();
