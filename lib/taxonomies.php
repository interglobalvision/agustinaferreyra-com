<?php

// DIRECTOR

add_action( 'init', 'create_location_tax' );

function create_location_tax() {
  $labels = array(
    'name'                       => _x( 'Locations', 'taxonomy general name' ),
    'singular_name'              => _x( 'Location', 'taxonomy singular name' ),
    'search_items'               => __( 'Search Locations' ),
    'popular_items'              => __( 'Popular Locations' ),
    'all_items'                  => __( 'All Locations' ),
    'parent_item'                => null,
    'parent_item_colon'          => null,
    'edit_item'                  => __( 'Edit Location' ),
    'update_item'                => __( 'Update Location' ),
    'add_new_item'               => __( 'Add New Location' ),
    'new_item_name'              => __( 'New Location Name' ),
    'separate_items_with_commas' => __( 'Use only 1 Location' ),
    'add_or_remove_items'        => __( 'Add or remove Location' ),
    'choose_from_most_used'      => __( 'Choose from the most used Locations' ),
    'not_found'                  => __( 'No Locations found.' ),
    'menu_name'                  => __( 'Locations' ),
  );

  $args = array(
    'hierarchical'          => false,
    'labels'                => $labels,
    'show_ui'               => true,
    'show_admin_column'     => true,
    'query_var'             => true,
  );

  register_taxonomy( 'location', array('exhibition'), $args );
} 
