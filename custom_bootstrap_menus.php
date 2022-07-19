<?php
/**
 * Custom bootstrap Menu
 */

/** 
 * First of get Menu ID 
 */
function get_menu_id( $location ) {
    /** Get all the locations. */
    $locations = get_nav_menu_locations();

    /** Get object id by location. */
    $menu_id = $locations[ $location ];

    return ! empty( $menu_id ) ? $menu_id : '';
}
$header_menu_id = get_menu_id( 'wakanda-header_menu' ); // Menu ID

/**
 * SECOND GET ALL MENUS ITEMS
 */ 
$header_menus = wp_get_nav_menu_items( $header_menu_id );
// echo '<pre>';
// print_r($header_menus);
// wp_die();

/**
 * THIRD GET CHILD MENUS ITEM
 */
function get_child_menu_items( $menu_array, $parent_id ) {
    $child_menus = [];

    if ( !empty( $menu_array ) && is_array( $menu_array ) ) {
        foreach( $menu_array as $menu ) {
            if ( intval( $menu->menu_item_parent ) === $parent_id ) {
                array_push( $child_menus, $menu );  
            }
        }
    }

    return $child_menus;
}
$child_menu_items = get_child_menu_items( $header_menus, $menu_item->ID );
// echo '<pre>';
// print_r($child_menu_items);

/**
 * Then create Dynamic Menu
 */
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <?php
      if ( function_exists( 'the_custom_logo' ) ) {
        the_custom_logo();
      }
    ?>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <?php 
        if ( !empty( $header_menus ) && is_array( $header_menus ) ) {
          ?>
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <?php
            foreach( $header_menus as $menu_item ) {
              if( ! $menu_item->menu_item_parent ) {

                $child_menu_items = $menu_class->get_child_menu_items( $header_menus, $menu_item->ID );
                // echo '<pre>';
                // print_r($child_menu_items);

                $has_children = ! empty( $child_menu_items ) && is_array( $child_menu_items );

                if( ! $has_children ) {
                  ?>
                    <li class="nav-item">
                      <a class="nav-link" aria-current="page" href="<?php echo esc_url( $menu_item->url ); ?>">
                        <?php echo esc_html( $menu_item->title ); ?>
                      </a>
                    </li>
                  <?php
                } else {
                  ?>
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="<?php echo esc_url( $menu_item->url ); ?>" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo esc_html( $menu_item->title ); ?>
                      </a>
                      <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php
                          foreach ( $child_menu_items as $child_menu_item ) {
                            ?>
                              <li>
                                <a class="dropdown-item" href="<?php echo esc_url( $child_menu_item->url ); ?>">
                                  <?php echo esc_html( $child_menu_item->title ); ?>
                                </a>
                              </li>
                            <?php
                          }
                        ?>
                      </ul>
                    </li>
                  <?php
                }
              }
            }
            ?>
          </ul>
          <?php
        }
      ?>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
