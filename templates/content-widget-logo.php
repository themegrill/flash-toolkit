<?php
/**
 * The template for displaying logo widget entries
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

<div class="tg-client-widget">
	<div class="client-container swiper-container">
		<div class="client-wrapper swiper-wrapper">
<?php
$i =  1;
foreach ($repeatable_logo as $logo) {
	if( $logo['image'] != '' ) {
	/*
	 * WPML plugin compatibility. To make it compatible, these below two steps needs to be done:
	 *
	 * 1. Need to register the strings first
	 * 2. Display the registered strings
	 */

	// 1. For WPML plugin string register
	if ( function_exists( 'icl_register_string' ) ) {
		icl_register_string( 'Flash Toolkit', 'FT: Logo Image'.$i, $logo['image'] );
		icl_register_string( 'Flash Toolkit', 'FT: Logo Title'.$i, $logo['title'] );
	}

	// 2. For WPML plugin translated string display
	if ( function_exists( 'icl_t' ) ) {
		$logo['image'] = icl_t( 'Flash Toolkit', 'FT: Logo Image'.$i, $logo['image'] );
		$logo['title'] = icl_t( 'Flash Toolkit', 'FT: Logo Title'.$i, $logo['title'] );
	}
	?>

	<div class="client-slide swiper-slide">
		<img src="<?php echo $logo['image']; ?>" alt="<?php echo $logo['title']; ?>" />
	</div>
	<?php
	}

	$i++;
}
?>
		</div>
	</div>
</div>
