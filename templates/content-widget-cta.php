<?php
/**
 * The template for displaying cta widget.
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
<div class="cta-wrapper <?php echo esc_attr( $style ); ?>">
	<div class="section-title-wrapper">
		<?php if( !empty( $title ) ) { ?>
		<h3 class="section-title"><?php echo esc_html( $title ); ?></h3>
		<?php }
		if ( !empty( $subtitle ) ) { ?>
		<h4 class="section-subtitle"><?php echo esc_html( $subtitle ); ?></h4>
		<?php } ?>
	</div>
	<?php if( !empty( $btn1_link ) || !empty( $btn2_link ) ) { ?>
	<div class="btn-wrapper">
		<?php if( !empty( $btn1_link ) ) { ?>
		<a class="btn" href="<?php echo esc_url( $btn1_link ); ?>"><?php echo esc_html( $btn1 ); ?></a>
		<?php } ?>
		<?php if( !empty( $btn2_link ) ) { ?>
		<a class="btn" href="<?php echo esc_url( $btn2_link ); ?>"><?php echo esc_html( $btn2 ); ?></a>
		<?php } ?>
	</div>
	<?php } ?>
</div>
