<?php
/**
 * FlashToolkit Formatting
 *
 * Functions for formatting data.
 *
 * @author   ThemeGrill
 * @category Core
 * @package  FlashToolkit/Functions
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Clean variables using sanitize_text_field
 * @param  string|array $var
 * @return string
 */
function flash_clean( $var ) {
	return is_array( $var ) ? array_map( 'flash_clean', $var ) : sanitize_text_field( $var );
}

/**
 * Sanitize permalink values before insertion into DB.
 *
 * Cannot use flash_clean because it sometimes strips % chars and breaks the user's setting.
 *
 * @param  string $value
 * @return string
 */
function flash_sanitize_permalink( $value ) {
	global $wpdb;

	$value = $wpdb->strip_invalid_text_for_column( $wpdb->options, 'option_value', $value );

	if ( is_wp_error( $value ) ) {
		$value = '';
	}

	$value = esc_url_raw( $value );
	$value = str_replace( 'http://', '', $value );
	return untrailingslashit( $value );
}
