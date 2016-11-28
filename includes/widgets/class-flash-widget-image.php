<?php
/**
 * Image Widget
 *
 * Displays image widget.
 *
 * @extends  FT_Widget
 * @version  1.0.0
 * @package  FlashToolkit/Widgets
 * @category Widgets
 * @author   ThemeGrill
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * FT_Widget_Image Class
 */
class FT_Widget_Image extends FT_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'tg-widget tg-image-widget';
		$this->widget_description = __( 'Add your advertisment image here.', 'flash-toolkit' );
		$this->widget_id          = 'themegrill_flash_image';
		$this->widget_name        = __( 'FT: Image', 'flash-toolkit' );
		$this->control_ops        = array( 'width' => 400, 'height' => 350 );
		$this->settings           = apply_filters( 'flash_toolkit_widget_settings_' . $this->widget_id, array(
			'image'  => array(
				'type'  => 'image',
				'std'   => '',
				'label' => __( 'Image', 'flash-toolkit' )
			),
			'image_link'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Image Link', 'flash-toolkit' )
			),
		) );

		parent::__construct();
	}

	/**
	 * Output widget.
	 *
	 * @see WP_Widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		$image    = isset( $instance[ 'image' ] ) ? $instance[ 'image' ] : '';
		$link     = isset( $instance[ 'image_link' ] ) ? $instance[ 'image_link' ] : '';


		/*
		 * WPML plugin compatibility. To make it compatible, these below two steps needs to be done:
		 *
		 * 1. Need to register the strings first
		 * 2. Display the registered strings
		 */

		// 1. For WPML plugin string register
		if ( function_exists( 'icl_register_string' ) ) {
			icl_register_string( 'Flash Toolkit', 'FT: Image URL' . $this->id, $image );
			icl_register_string( 'Flash Toolkit', 'FT: Image Link' . $this->id, $link );
		}

		// 2. For WPML plugin translated string display
		if ( function_exists( 'icl_t' ) ) {
			$image = icl_t( 'Flash Toolkit', 'FT: Image URL' . $this->id, $image );
			$link = icl_t( 'Flash Toolkit', 'FT: Image Link' . $this->id, $link );
		}

		$this->widget_start( $args, $instance );

		flash_get_template( 'content-widget-image.php', array( 'image' => $image, 'link' => $link ) );

		$this->widget_end( $args );
	}
}
