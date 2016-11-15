<?php
/**
 * Heading Widget
 *
 * Displays heading widget.
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
 * FT_Widget_Heading Class
 */
class FT_Widget_Heading extends FT_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'tg-widget section-title-wrapper';
		$this->widget_description = __( 'Add your heading here.', 'flash-toolkit' );
		$this->widget_id          = 'themegrill_flash_heading';
		$this->widget_name        = __( 'FT: Heading', 'flash-toolkit' );
		$this->control_ops        = array( 'width' => 400, 'height' => 350 );
		$this->settings           = array(
			'heading-title'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Heading', 'flash-toolkit' )
			),
			'subheading'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Sub Heading', 'flash-toolkit' )
			),
		);

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
		$heading    = isset( $instance[ 'heading-title' ] ) ? $instance[ 'heading-title' ] : '';
		$subheading = isset( $instance[ 'subheading' ] ) ? $instance[ 'subheading' ] : '';

		$this->widget_start( $args, $instance );

		flash_get_template( 'content-widget-heading.php', array( 'heading' => $heading, 'subheading' => $subheading ) );

		$this->widget_end( $args );
	}
}
