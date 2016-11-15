<?php
/**
 * The template for displaying about widget.
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

<div class="tg-column-wrapper">
	<div class="about-content-wrapper tg-column-2">
		<?php if( !empty( $title ) ) { ?>
		<h3 class="section-title"><?php echo esc_html( $title ); ?></h3>
		<?php } ?>
		<?php if( !empty( $text ) ) { ?>
		<div class="section-description"><?php echo esc_html( $text ); ?></div>
		<?php } ?>
		<?php if ( !empty( $more_url )) { ?>
		<div class="btn-wrapper">
			<a class="about-more" href="<?php echo esc_url( $more_url ); ?>"><?php echo esc_html( $more_text ); ?></a>
		</div>
		<?php } ?>
	</div>
	<?php if( !empty( $image ) ) { ?>
	<figure class="about-section-image tg-column-2">
		<img src="<?php echo esc_url( $image ); ?>" />
	</figure>
	<?php } ?>
</div>
