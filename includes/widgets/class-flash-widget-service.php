<?php
/**
 * Animated Service Widget
 *
 * Displays service widget.
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
 * FT_Widget_Service Class
 */
class FT_Widget_Service extends FT_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'tg-widget tg-single-service';
		$this->widget_description = __( 'Add your service here.', 'flash-toolkit' );
		$this->widget_id          = 'themegrill_flash_service';
		$this->widget_name        = __( 'FT: Service', 'flash-toolkit' );
		$this->control_ops        = array( 'width' => 400, 'height' => 350 );
		$this->settings           = array(
			'service-title'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Title', 'flash-toolkit' )
			),
			'icon_type' => array(
				'type'    => 'select',
				'std'     => 'icon',
				'class'   => 'icon_chooser',
				'label'   => __( 'Icon Type', 'flash-toolkit' ),
				'options' => array(
					'icon'  => __( 'Icon Picker', 'flash-toolkit' ),
					'image' => __( 'Image Uploader', 'flash-toolkit' )
				)
			),
			'icon'  => array(
				'type'  => 'icon_picker',
				'class' => 'show_if_icon',
				'std'   => '',
				'label' => __( 'FontAwesome Icon', 'flash-toolkit' ),
				'options' => flash_get_fontawesome_icons()
			),
			'image'  => array(
				'type'  => 'image',
				'class' => 'show_if_image',
				'std'   => '',
				'label' => __( 'Upload an Image', 'flash-toolkit' )
			),
			'text'  => array(
				'type'  => 'textarea',
				'std'   => '',
				'label' => __( 'Text', 'flash-toolkit' )
			),
			'more_text'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Read More Text', 'flash-toolkit' )
			),
			'more_url'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Read More URL', 'flash-toolkit' )
			),
			'style' => array(
				'type'    => 'select',
				'std'     => 'tg-service-layout-1',
				'label'   => __( 'Widget Style', 'flash-toolkit' ),
				'options' => array(
					'tg-service-layout-1' => __( 'Style 1', 'flash-toolkit' ),
					'tg-service-layout-2' => __( 'Style 2', 'flash-toolkit' ),
				)
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
		$title       = isset( $instance[ 'service-title' ] ) ? $instance[ 'service-title' ] : '';
		$icon_type   = isset( $instance[ 'icon_type' ] ) ? $instance[ 'icon_type' ] : 'icon';
		$icon        = isset( $instance[ 'icon' ] ) ? $instance[ 'icon' ] : '';
		$image       = isset( $instance[ 'image' ] ) ? $instance[ 'image' ] : '';
		$text        = isset( $instance[ 'text' ] ) ? $instance[ 'text' ] : '';
		$more_text   = isset( $instance[ 'more_text' ] ) ? $instance[ 'more_text' ] : '';
		$more_url    = isset( $instance[ 'more_url' ] ) ? $instance[ 'more_url' ] : '';
		$style       = isset( $instance[ 'style' ] ) ? $instance[ 'style' ] : '';

		$this->widget_start( $args, $instance );

		flash_get_template( 'content-widget-service.php', array( 'title' => $title, 'icon_type' => $icon_type, 'icon' => $icon, 'image' => $image, 'text' => $text, 'more_text' => $more_text, 'more_url' => $more_url, 'style' => $style ) );

		$this->widget_end( $args );
	}
}
