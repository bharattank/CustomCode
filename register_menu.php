<?php
/**
 * Register Custom Menu
 */
add_action( 'after_setup_theme', 'pp_theme_setup' );
function pp_theme_setup() {
    register_nav_menus(array(
        'product_category' => __('Product Category Menu', 'kadence-child'),
        'product_category_right' => __('Product Category Menu Right', 'kadence-child')
    ));
}