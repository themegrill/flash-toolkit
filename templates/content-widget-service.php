<?php
/**
 * The template for displaying heading widget.
 *
 * This template can be overridden by copying it to yourtheme/flash-toolkit/content-widget-test.php.
 *
 * HOWEVER, on occasion FlashToolkit will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     http://docs.themegrill.com/flash-toolkit/template-structure/
 * @author  ThemeGrill
 * @package FlashToolkit/Templates
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="tg-service-widget <?php echo esc_attr( $style ); ?>">
	<div class="service-wrapper">
		<div class="service-icon-title-wrapper clearfix">
			<?php if( $icon_type == 'icon' && !empty($icon) ) { ?>
			<div class="service-icon-wrap"><i class="fa <?php echo esc_attr($icon); ?>"></i></div>
			<?php } ?>
			<?php if( $icon_type == 'image' && !empty($image) ) { ?>
			<figure class="service-image-wrap"><img src="<?php echo esc_url( $image ); ?>" /></figure>
			<?php } ?>
			<?php if( !empty( $title ) ) { ?>
			<h3 class="service-title-wrap">
				<?php if( !empty( $more_url ) ) { ?>
				<a href="<?php echo esc_url( $more_url ); ?>">
				<?php
				}
				echo esc_html($title); ?>
				<?php if( !empty( $more_url ) ) { ?>
				</a>
				<?php } ?>
			</h3>
			<?php } ?>
		</div>
		<?php if( !empty( $text ) ) { ?>
		<div class="service-content-wrap"><?php echo esc_html($text); ?></div>
		<?php } ?>
		<?php if ( !empty( $more_url )) { ?>
		<a class="service-more" href="<?php echo esc_url( $more_url ); ?>"><?php echo esc_html( $more_text ); ?></a>
		<?php } ?>
	</div>
</div>
