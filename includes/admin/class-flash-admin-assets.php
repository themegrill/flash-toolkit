<?php
/**
 * FlashToolkit Admin Assets.
 *
 * Load Admin Assets.
 *
 * @class    FT_Admin_Assets
 * @version  1.0.0
 * @package  FlashToolkit/Admin
 * @category Admin
 * @author   ThemeGrill
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * FT_Admin_Assets Class
 */
class FT_Admin_Assets {

	/**
	 * Hook in tabs.
	 */
	public function __construct() {
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
		add_action( 'siteorigin_panel_enqueue_admin_scripts', array( $this, 'siteorigin_panel_scripts' ) );
	}

	/**
	 * Enqueue styles.
	 */
	public function admin_styles() {
		$screen    = get_current_screen();
		$screen_id = $screen ? $screen->id : '';

		// Register admin styles.
		wp_register_style( 'font-awesome', FT()->plugin_url() . '/assets/css/fontawesome.css', array(), '4.6.3' );
		wp_register_style( 'flash-toolkit-admin-widgets', FT()->plugin_url() . '/assets/css/widgets.css', array( 'font-awesome' ), FT_VERSION );

		// Widgets Specific enqueue.
		if ( in_array( $screen_id, array( 'widgets', 'customize' ) ) ) {
			wp_enqueue_style( 'flash-toolkit-admin-widgets' );
		}
	}

	/**
	 * Enqueue styles.
	 */
	public function admin_scripts() {
		$screen    = get_current_screen();
		$screen_id = $screen ? $screen->id : '';
		$suffix    = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		// Register admin scripts.
		wp_register_script( 'flash-toolkit-admin-widgets', FT()->plugin_url() . '/assets/js/admin/widgets' . $suffix . '.js', array( 'jquery', 'jquery-ui-sortable', 'wp-util', 'underscore', 'backbone', 'flash-enhanced-select' ), FT_VERSION );
		wp_register_script( 'select2', FT()->plugin_url() . '/assets/js/select2/select2' . $suffix . '.js', array( 'jquery' ), '3.5.4' );
		wp_register_script( 'flash-enhanced-select', FT()->plugin_url() . '/assets/js/admin/enhanced-select' . $suffix . '.js', array( 'jquery', 'select2' ), FT_VERSION );
		wp_localize_script( 'flash-enhanced-select', 'flash_enhanced_select_params', array(
			'i18n_matches_1'            => _x( 'One result is available, press enter to select it.', 'enhanced select', 'flash-toolkit' ),
			'i18n_matches_n'            => _x( '%qty% results are available, use up and down arrow keys to navigate.', 'enhanced select', 'flash-toolkit' ),
			'i18n_no_matches'           => _x( 'No matches found', 'enhanced select', 'flash-toolkit' ),
			'i18n_ajax_error'           => _x( 'Loading failed', 'enhanced select', 'flash-toolkit' ),
			'i18n_input_too_short_1'    => _x( 'Please enter 1 or more characters', 'enhanced select', 'flash-toolkit' ),
			'i18n_input_too_short_n'    => _x( 'Please enter %qty% or more characters', 'enhanced select', 'flash-toolkit' ),
			'i18n_input_too_long_1'     => _x( 'Please delete 1 character', 'enhanced select', 'flash-toolkit' ),
			'i18n_input_too_long_n'     => _x( 'Please delete %qty% characters', 'enhanced select', 'flash-toolkit' ),
			'i18n_selection_too_long_1' => _x( 'You can only select 1 item', 'enhanced select', 'flash-toolkit' ),
			'i18n_selection_too_long_n' => _x( 'You can only select %qty% items', 'enhanced select', 'flash-toolkit' ),
			'i18n_load_more'            => _x( 'Loading more results&hellip;', 'enhanced select', 'flash-toolkit' ),
			'i18n_searching'            => _x( 'Searching&hellip;', 'enhanced select', 'flash-toolkit' )
		) );
		wp_localize_script( 'flash-toolkit-admin-widgets', 'flashToolkitLocalizeScript', array(
			'i18n_max_field_entries' => apply_filters( 'flash_toolkit_maximum_repeater_field_entries', 5 ),
			'i18n_max_field_message' => esc_js( sprintf( __( 'You can add upto %s fields.', 'flash-toolkit' ), apply_filters( 'flash_toolkit_maximum_repeater_field_entries', 5 ) ) ),
		) );

		// Widgets Specific enqueue.
		if ( in_array( $screen_id, array( 'widgets', 'customize' ) ) ) {
			wp_enqueue_media();
			wp_enqueue_script( 'flash-toolkit-admin-widgets' );
		}
	}

	/**
	 * Enqueue siteorigin panel scripts.
	 */
	public function siteorigin_panel_scripts() {
		wp_enqueue_style( 'flash-toolkit-admin-widgets' );
		wp_enqueue_script( 'flash-toolkit-admin-widgets' );
	}
}

new FT_Admin_Assets();
