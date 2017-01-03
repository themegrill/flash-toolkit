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
		<div id="portfolio_options" class="panel-wrap portfolio_data">
			<ul class="portfolio_data_tabs flash-toolkit-tabs">
				<?php
					$portfolio_data_tabs = apply_filters( 'flash-toolkit_portfolio_data_tabs', array(
						'general' => array(
							'label'  => __( 'General', 'flash-toolkit' ),
							'target' => 'general_portfolio_data',
							'class'  => array(),
						),
					) );

					foreach ( $portfolio_data_tabs as $key => $tab ) {
						?><li class="<?php echo $key; ?>_options <?php echo $key; ?>_tab <?php echo implode( ' ', (array) $tab['class'] ); ?>">
							<a href="#<?php echo $tab['target']; ?>"><?php echo esc_html( $tab['label'] ); ?></a>
						</li><?php
					}

					do_action( 'flash_toolkit_portfolio_write_panel_tabs' );
				?>
			</ul>
			<div id="general_portfolio_data" class="panel flash_toolkit_options_panel"><?php

				echo '<div class="options_group">';

					// Layout Type
					flash_toolkit_wp_select( array(
						'id'    => 'layout_type',
						'label' => __( 'Layout Type', 'restaurantpress' ),
						'options' => array(
							'one_column' => __( 'One Column', 'restaurantpress' ),
							'two_column' => __( 'Two Column', 'restaurantpress' ),
							'grid_image' => __( 'Grid Image', 'restaurantpress' ),
						),
						'desc_tip'    => 'true',
						'description' => __( 'Define whether or not the entire layout should be column based, or just with the grid image.', 'restaurantpress' )
					) );

				echo '</div>';

				echo '<div class="options_group">';

					// Category Icon
					flash_toolkit_wp_checkbox( array( 'id' => '_category_icon', 'wrapper_class' => 'show_to_all_layout', 'label' => __( 'Category Icon', 'restaurantpress' ), 'description' => __( 'Show category image icon.', 'restaurantpress' ) ) );

					// Featured Image
					flash_toolkit_wp_checkbox( array( 'id' => '_featured_image', 'wrapper_class' => 'hide_if_grid_image', 'label' => __( 'Featured Image', 'restaurantpress' ), 'description' => __( 'Disable the featured image.', 'restaurantpress' ) ) );

				echo '</div>';

				do_action( 'flash_toolkit_portfolio_options_general' );

			?></div>
			<?php do_action( 'flash_toolkit_portfolio_data_panels' ); ?>
			<div class="clear"></div>
		</div>
		<?php
	}

	/**
	 * Save meta box data.
	 * @param int $post_id
	 */
	public static function save( $post_id ) {

	}
}
