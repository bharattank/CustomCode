<?php
/**
 * Create Custom Taxonomy
 */
// Hooking up our function to theme setup taxonomy
 
add_action('init', 'register_custom_taxonomy');
 
function register_custom_taxonomy()
{
    $labels = array(
        'name'              => _x('Locations', 'taxonomy general name'),
    'singular_name'     => _x('Location','taxonomy singular name'),
    'search_items'      => __('Search Location'),
    'all_items'         => __('All Location'),
    'parent_item'       => __('Parent Location'),
    'parent_item_colon' => __('Parent Location:'),
    'edit_item'         => __('Edit Location'),
    'update_item'       => __('Update Location'),
    'add_new_item'      => __('Add New Location'),
    'new_item_name'     => __('New Location Name'),
    'menu_name'         => __('Locations'),
    );
    
    $args = array(
    'hierarchical'      => true, // make it hierarchical (like categories)
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'show_in_rest' => true,
    'rewrite'    => array('slug' => 'location'),
    );
 
    register_taxonomy('locations', 'news', $args); // Register Taxonomy
}

/**
 * Displaying Custom Taxonomies
 * Add custom taxonomy on your single post page. For this add single line of code in your single.php file within the loop:
 */
 the_terms( $post->ID, 'locations', 'Locations: ', ', ', ' ' );

 /**
  * Get All Terms in a Taxonomy
  */
  // Get a list of all terms in a taxonomy
    $terms = get_terms( "locations", array(
    'hide_empty' => 0,
    ) );
    $locations = array();
    if ( count($terms) > 0 ):
    foreach ( $terms as $term )
        $locations[] = $term->name;
    
    $locations_str = implode(', ', $locations);
    ?>
    <p>We cover News stories around the country in places like <?php echo $locations_str; ?> and more.</p>
    <?php endif;