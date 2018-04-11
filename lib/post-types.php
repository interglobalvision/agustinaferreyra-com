<?php
// Menu icons for Custom Post Types
// https://developer.wordpress.org/resource/dashicons/
function add_menu_icons_styles(){
?>

<style>
#menu-posts-exhibition .dashicons-admin-post:before {
    content: '\f128';
}
#menu-posts-artist .dashicons-admin-post:before {
    content: '\f309';
}
</style>

<?php
}
add_action( 'admin_head', 'add_menu_icons_styles' );


//Register Custom Post Types
add_action( 'init', 'register_cpt_exhibition' );

function register_cpt_exhibition() {

  $labels = array(
    'name' => _x( 'Exhibitions', 'exhibition' ),
    'singular_name' => _x( 'Exhibition', 'exhibition' ),
    'add_new' => _x( 'Add New', 'exhibition' ),
    'add_new_item' => _x( 'Add New Exhibition', 'exhibition' ),
    'edit_item' => _x( 'Edit Exhibition', 'exhibition' ),
    'new_item' => _x( 'New Exhibition', 'exhibition' ),
    'view_item' => _x( 'View Exhibition', 'exhibition' ),
    'search_items' => _x( 'Search Exhibitions', 'exhibition' ),
    'not_found' => _x( 'No exhibitions found', 'exhibition' ),
    'not_found_in_trash' => _x( 'No exhibitions found in Trash', 'exhibition' ),
    'parent_item_colon' => _x( 'Parent Exhibition:', 'exhibition' ),
    'menu_name' => _x( 'Exhibitions', 'exhibition' ),
  );

  $args = array(
    'labels' => $labels,
    'hierarchical' => false,

    'supports' => array( 'title', 'editor', 'thumbnail' ),

    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,

    'show_in_nav_menus' => true,
    'publicly_queryable' => true,
    'exclude_from_search' => false,
    'has_archive' => 'exhibitions',
    'query_var' => true,
    'can_export' => true,
    'rewrite' => true,
    'capability_type' => 'post'
  );

  register_post_type( 'exhibition', $args );
}

add_action( 'init', 'register_cpt_artist' );

function register_cpt_artist() {

  $labels = array(
    'name' => _x( 'Artists', 'artist' ),
    'singular_name' => _x( 'Artist', 'artist' ),
    'add_new' => _x( 'Add New', 'artist' ),
    'add_new_item' => _x( 'Add New Artist', 'artist' ),
    'edit_item' => _x( 'Edit Artist', 'artist' ),
    'new_item' => _x( 'New Artist', 'artist' ),
    'view_item' => _x( 'View Artist', 'artist' ),
    'search_items' => _x( 'Search Artists', 'artist' ),
    'not_found' => _x( 'No artists found', 'artist' ),
    'not_found_in_trash' => _x( 'No artists found in Trash', 'artist' ),
    'parent_item_colon' => _x( 'Parent Artist:', 'artist' ),
    'menu_name' => _x( 'Artists', 'artist' ),
  );

  $args = array(
    'labels' => $labels,
    'hierarchical' => false,

    'supports' => array( 'title', 'editor', 'thumbnail' ),

    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,

    'show_in_nav_menus' => true,
    'publicly_queryable' => true,
    'exclude_from_search' => false,
    'has_archive' => 'artists',
    'query_var' => true,
    'can_export' => true,
    'rewrite' => true,
    'capability_type' => 'post'
  );

  register_post_type( 'artist', $args );
}
