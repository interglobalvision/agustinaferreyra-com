<?php

/* Get post objects for select field options */
function get_post_objects( $query_args ) {
  $args = wp_parse_args( $query_args, array(
    'post_type' => 'post',
  ) );
  $posts = get_posts( $args );
  $post_options = array();
  if ( $posts ) {
    foreach ( $posts as $post ) {
      $post_options [ $post->ID ] = $post->post_title;
    }
  }
  return $post_options;
}


/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */

/**
 * Hook in and add metaboxes. Can only happen on the 'cmb2_init' hook.
 */
add_action( 'cmb2_init', 'igv_cmb_metaboxes' );
function igv_cmb_metaboxes() {

  // Start with an underscore to hide fields from custom fields list
  $prefix = '_igv_';

  /**
   * Metaboxes declarations here
   * Reference: https://github.com/WebDevStudios/CMB2/blob/master/example-functions.php
   */

  $exhibition_metabox = new_cmb2_box( array(
 		'id'            => $prefix . 'exhibition_metabox',
 		'title'         => esc_html__( 'Details', 'cmb2' ),
 		'object_types'  => array( 'exhibition' ), // Post type
 	) );

  $exhibition_metabox->add_field( array(
		'name' => esc_html__( 'Start Date', 'cmb2' ),
		'id'   => $prefix . 'exhibition_start',
		'type' => 'text_datetime_timestamp_timezone',
	) );

  $exhibition_metabox->add_field( array(
		'name' => esc_html__( 'End Date', 'cmb2' ),
		'id'   => $prefix . 'exhibition_end',
		'type' => 'text_datetime_timestamp_timezone',
	) );

  $exhibition_metabox->add_field( array(
		'name' => esc_html__( 'Artists', 'cmb2' ),
		'id'   => $prefix . 'exhibition_artists',
		'type' => 'text',
	) );

  $exhibition_metabox->add_field( array(
		'name' => esc_html__( 'Title', 'cmb2' ),
		'id'   => $prefix . 'exhibition_title',
		'type' => 'text',
	) );

  $exhibition_metabox->add_field( array(
		'name' => esc_html__( 'Press Release PDF', 'cmb2' ),
		'id'   => $prefix . 'exhibition_pdf',
		'type' => 'file',
    'options' => array(
  		'url' => false, // Hide the text input for the url
  	),
    'text'    => array(
  		'add_upload_file_text' => 'Add PDF'
  	),
  	// query_args are passed to wp.media's library query.
  	'query_args' => array(
  		'type' => 'application/pdf', // Make library only display PDFs.
  	),
	) );

  $exhibition_images_group = $exhibition_metabox->add_field( array(
		'id'          => $prefix . 'exhibition_images',
		'type'        => 'group',
		'options'     => array(
			'group_title'   => esc_html__( 'Image {#}', 'cmb2' ), // {#} gets replaced by row number
			'add_button'    => esc_html__( 'Add Another Image', 'cmb2' ),
			'remove_button' => esc_html__( 'Remove Image', 'cmb2' ),
			'sortable'      => true, // beta
		),
	) );

  $exhibition_metabox->add_group_field( $exhibition_images_group, array(
		'name' => esc_html__( 'Image', 'cmb2' ),
		'id'   => 'image',
		'type' => 'file',
	) );

  $exhibition_metabox->add_group_field( $exhibition_images_group, array(
		'name' => esc_html__( 'Caption', 'cmb2' ),
		'id'   => 'caption',
		'type' => 'wysiwyg',
	) );

  $location_metabox = new_cmb2_box( array(
		'id'               => $prefix . 'location_metabox',
		'title'            => esc_html__( 'Details', 'cmb2' ), // Doesn't output for term boxes
		'object_types'     => array( 'term' ), // Tells CMB2 to use term_meta vs post_meta
		'taxonomies'       => array( 'location' ), // Tells CMB2 which taxonomies should have these fields
	) );

  $location_metabox->add_field( array(
		'name'    => esc_html__( 'City', 'cmb2' ),
		'id'      => $prefix . 'location_city',
		'type'    => 'text',
	) );

}
?>
