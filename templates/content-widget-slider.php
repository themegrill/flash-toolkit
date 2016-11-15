<?php
/**
 * The template for displaying slider widget entries
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
<div class="tg-slider-widget <?php echo esc_attr( $color ); ?> <?php echo esc_attr( $align ); ?> <?php echo esc_attr( $controls ); ?>">
	<div class="swiper-container">
		<div class="swiper-wrapper">
			<?php foreach ($repeatable_slider as $slider) {
			if( $slider['image'] != '' ) { ?>
			<div class="swiper-slide">
				<figure class="slider-image">
					<img src="<?php echo esc_html( $slider[ 'image' ] ); ?>"/>
					<div class="overlay"></div>
				</figure>
				<div class="slider-content">
					<div class="tg-container">
						<div class="caption-title"><?php echo esc_html( $slider[ 'title' ] ); ?></div>
						<div class="caption-desc"><?php echo esc_html( $slider[ 'description' ] ); ?></div>
						<?php if($slider['button_text']) : ?>
						<div class="btn-wrapper">
							<a href="<?php echo esc_url( $slider[ 'button_link' ] ); ?>"><?php echo esc_html( $slider[ 'button_text' ] ); ?></a>
						</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<?php }
			} ?>
		</div>
		<div class="swiper-pagination"></div>
		<div class="slider-arrow">
			<div class="swiper-button-next"></div>
			<div class="swiper-button-prev"></div>
		</div>
	</div>
</div>
