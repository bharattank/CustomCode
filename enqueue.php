<?php
/**
 * Enqueue child styles.
 */
function child_enqueue_styles() {
	wp_enqueue_style( 'child-theme', get_stylesheet_directory_uri() . '/style.css', array(), 100 );
	
	wp_register_style( 'slick-css', get_stylesheet_directory_uri() .'/assets/css/slick.css', [], false, 'all' );
	wp_register_style( 'upload-css', get_stylesheet_directory_uri() .'/assets/css/uploadfile.css', [], false, 'all' );
	//Register Scripts
	wp_register_script( 'script-js', get_stylesheet_directory_uri() .'/assets/js/main.js', ['jquery'], '', true );
	wp_register_script( 'slick-js', get_stylesheet_directory_uri() .'/assets/js/slick.min.js', ['jquery'], '', true );
	wp_register_script( 'upload-js', get_stylesheet_directory_uri() .'/assets/js/jquery.uploadfile.min.js', ['jquery'], '', true );
	//Enqueue Style 
	wp_enqueue_style( 'slick-css' );
	if(is_checkout()) {
		wp_enqueue_style( 'upload-css' );
	}
	//Enqueue Scripts
	wp_enqueue_script( 'script-js' );
    // Localize Scripts
	$vars = array('ajax_url' => admin_url('admin-ajax.php'),'home_url' => home_url(), 'checkout_url' => get_permalink(wc_get_page_id('checkout')));
    wp_localize_script('script-js', 'WC_VARIATION_ADD_TO_CART', $vars);

	wp_enqueue_script( 'slick-js' );
	if(is_checkout()) {
		wp_enqueue_script( 'upload-js' );
	}
}
