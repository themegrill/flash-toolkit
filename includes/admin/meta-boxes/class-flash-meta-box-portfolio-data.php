<?php
/**
 * Portfolio Data.
 *
 * @class    FT_Meta_Box_Portfolio_Data
 * @version  1.1.0
 * @package  FlashToolkit/Admin/Meta Boxes
 * @category Admin
 * @author   ThemeGrill
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * FT_Meta_Box_Portfolio_Data Class
 */
class FT_Meta_Box_Portfolio_Data {

	/**
	 * Output the meta box.
	 * @param WP_Post $post
	 */
	public static function output( $post ) {
		wp_nonce_field( 'flash_toolkit_save_data', 'flash_toolkit_meta_nonce' );

		?>

		<?php
	}

	/**
	 * Save meta box data.
	 * @param int $post_id
	 */
	public static function save( $post_id ) {
		// Update post meta.
		update_post_meta( $post_id, '_breadcrumb_parent', absint( $_POST['breadcrumb_parent'] ) );
	}
}
