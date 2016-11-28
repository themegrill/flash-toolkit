<?php
/**
 * CTA Widget
 *
 * Displays cta widget.
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
 * FT_Widget_CTA Class
 */
class FT_Widget_CTA extends FT_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'tg-widget call-to-action-section';
		$this->widget_description = __( 'CTA Widget.', 'flash-toolkit' );
		$this->widget_id          = 'themegrill_flash_cta';
		$this->widget_name        = __( 'FT: CTA', 'flash-toolkit' );
		$this->control_ops        = array( 'width' => 400, 'height' => 350 );
		$this->settings           = apply_filters( 'flash_toolkit_widget_settings_' . $this->widget_id, array(
			'cta-title'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Call to action Title', 'flash-toolkit' )
			),
			'cta-subtitle'  => array(
				'type'  => 'textarea',
				'std'   => '',
				'label' => __( 'Call to Action Subtitle', 'flash-toolkit' )
			),
			'cta-btn1'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Call to Action Button 1 Text', 'flash-toolkit' )
			),
			'cta-btn1-link'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Call to Action Button 1 Link', 'flash-toolkit' )
			),
			'cta-btn2'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Call to Action Button 2 Text', 'flash-toolkit' )
			),
			'cta-btn2-link'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Call to Action Button 2 Link', 'flash-toolkit' )
			),
			'style' => array(
				'type'    => 'select',
				'std'     => 'tg-cta-layout-1',
				'label'   => __( 'Widget Style', 'flash-toolkit' ),
				'options' => array(
					'call-to-action-section-layout-1' => __( 'Style 1', 'flash-toolkit' ),
					'call-to-action-section-layout-2' => __( 'Style 2', 'flash-toolkit' ),
				)
			)
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
		$title       = isset( $instance[ 'cta-title' ] ) ? $instance[ 'cta-title' ] : '';
		$subtitle    = apply_filters( 'widget_text', isset( $instance[ 'cta-subtitle' ] ) ? $instance[ 'cta-subtitle' ] : '', $instance, $this->id_base );
		$btn1        = isset( $instance[ 'cta-btn1' ] ) ? $instance[ 'cta-btn1' ] : '';
		$btn1_link   = isset( $instance[ 'cta-btn1-link' ] ) ? $instance[ 'cta-btn1-link' ] : '';
		$btn2        = isset( $instance[ 'cta-btn2' ] ) ? $instance[ 'cta-btn2' ] : '';
		$btn2_link   = isset( $instance[ 'cta-btn2-link' ] ) ? $instance[ 'cta-btn2-link' ] : '';
		$style       = isset( $instance[ 'style' ] ) ? $instance[ 'style' ] : 'tg-cta-layout-1';

		/*
		 * WPML plugin compatibility. To make it compatible, these below two steps needs to be done:
		 *
		 * 1. Need to register the strings first
		 * 2. Display the registered strings
		 */

		// 1. For WPML plugin string register
		if ( function_exists( 'icl_register_string' ) ) {
			icl_register_string( 'Flash Toolkit', 'FT: CTA Button 1 Text' . $this->id, $btn1 );
			icl_register_string( 'Flash Toolkit', 'FT: CTA Button 1 Link' . $this->id, $btn1_link );
			icl_register_string( 'Flash Toolkit', 'FT: CTA Button 2 Text' . $this->id, $btn2 );
			icl_register_string( 'Flash Toolkit', 'FT: CTA Button 2 Link' . $this->id, $btn2_link );
		}

		// 2. For WPML plugin translated string display
		if ( function_exists( 'icl_t' ) ) {
			$btn1 = icl_t( 'Flash Toolkit', 'FT: CTA Button 1 Text' . $this->id, $btn1 );
			$btn1_link = icl_t( 'Flash Toolkit', 'FT: CTA Button 1 Link' . $this->id, $btn1_link );
			$btn2 = icl_t( 'Flash Toolkit', 'FT: CTA Button 2 Text' . $this->id, $btn2 );
			$btn2_link = icl_t( 'Flash Toolkit', 'FT: CTA Button 2 Link' . $this->id, $btn2_link );
		}

		$this->widget_start( $args, $instance );

		flash_get_template( 'content-widget-cta.php', array( 'title' => $title,  'subtitle' => $subtitle, 'btn1' => $btn1, 'btn1_link' => $btn1_link, 'btn2' => $btn2, 'btn2_link' => $btn2_link, 'style' => $style ) );

		$this->widget_end( $args );
	}
}
