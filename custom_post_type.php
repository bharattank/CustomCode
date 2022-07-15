<?php
/**
 * Create Custom Post type
 */
 //Init Hook for the custom post type
 
add_action('init', 'create_custom_post_type');
 
function create_custom_post_type() {
 
    $supports = array(
        'title', // post title
        'editor', // post content
        'author', // post author
        'thumbnail', // featured images
        'excerpt', // post excerpt
        'custom-fields', // custom fields
        'comments', // post comments
        'revisions', // post revisions
        'post-formats', // post formats
    );
 
    $labels = array(
        'name' => _x('news', 'plural'),
        'singular_name' => _x('news', 'singular'),
        'menu_name' => _x('news', 'admin menu'),
        'name_admin_bar' => _x('news', 'admin bar'),
        'add_new' => _x('Add New', 'add new'),
        'add_new_item' => __('Add New news'),
        'new_item' => __('New news'),
        'edit_item' => __('Edit news'),
        'view_item' => __('View news'),
        'all_items' => __('All news'),
        'search_items' => __('Search news'),
        'not_found' => __('No news found.'),
    );
 
    $args = array(
        'supports' => $supports,
        'labels' => $labels,
        'description' => 'Holds our News and specific data',
        'public' => true,
        'taxonomies' => array( 'category', 'post_tag' ),
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'can_export' => true,
        'capability_type' => 'post',
        'show_in_rest' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'news'),
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 6,
        'menu_icon' => 'dashicons-megaphone',
    );
 
register_post_type('news', $args); // Register Post type
}


/**
 * Create a Template for Archive List
 * After the code has been developed, the next step is to create a new file called template-news.php in your theme folder. Once * * this file has been created, add the following code to it.
 */
    /*Template Name: News*/
    get_header();
        query_posts(array(
            'post_type' => 'news'
    )); ?>
    <?php
    while (have_posts()) : the_post(); ?>
        <h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
        <p><?php the_excerpt(); ?></p>
    <?php endwhile;
    get_footer();


/**
 * Create a Detail Page of Custom Post Type
 * We must also create a custom post types detail page. To do this, simply create a new file called single-news.php located in * * your WordPress theme and add the following code.
 */
get_header();
    /* Start the Loop */
    while (have_posts()) : the_post();
        get_template_part('template-parts/content', get_post_format());
    endwhile; // End of the loop.
get_footer();