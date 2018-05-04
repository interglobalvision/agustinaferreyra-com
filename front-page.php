<?php
get_header();
?>

<?php
  $site_options = get_site_option('_igv_site_options');

  if (!empty($site_options['_igv_frontpage_postit_image_id'])) {
?>
<div id="postit">
  <?php echo wp_get_attachment_image($site_options['_igv_frontpage_postit_image_id'], 'thumbnail', false, 'class=postit-image'); ?>
  <div id="postit-dot" class="dot"></div>
</div>
<?php
  }
?>

<main id="main-content">
  <section id="posts">
    <div class="container">
      <div class="grid-row">
        <div id="logo-holder" class="grid-item align-self-end flex-grow">
          <?php get_template_part('partials/logo'); ?>
        </div>
        <div class="grid-item item-s-9 grid-row no-gutter align-self-start">
<?php
$now = time();

$current_args = array(
  'post_type' => array( 'exhibition' ),
  'orderby' => 'meta_value_num',
  'meta_key' => '_igv_exhibition_start',
  'meta_query' => array(
    'relation' => 'AND',
    array(
      'key'     => '_igv_exhibition_start',
      'value'   => $now,
      'compare' => '<',
    ),
    array(
      'key'     => '_igv_exhibition_end',
      'value'   => $now,
      'compare' => '>',
    ),
  ),
);

$current_query = new WP_Query( $current_args );

if ( $current_query->have_posts() ) {
?>
        <div class="grid-item item-s-12 item-m-4 frontpage-section-label-holder">
          <div class="frontpage-section-label font-size-mid">Current</div>
        </div>
        <div class="grid-item item-s-12 item-m-8 grid-row no-gutter margin-bottom-basic">
<?php
	while ( $current_query->have_posts() ) {
		$current_query->the_post();

    get_template_part('partials/archive-exhibition-item');
  }
?>
        </div>
<?php
}

wp_reset_postdata();

$upcoming_args = array(
  'post_type' => array( 'exhibition' ),
  'orderby' => 'meta_value_num',
  'meta_key' => '_igv_exhibition_start',
  'meta_query' => array(
    array(
      'key'     => '_igv_exhibition_start',
      'value'   => $now,
      'compare' => '>',
    ),
  ),
);

$upcoming_query = new WP_Query( $upcoming_args );

if ( $upcoming_query->have_posts() ) {
?>
        <div class="grid-item item-s-12 item-m-4 frontpage-section-label-holder">
          <div class="frontpage-section-label font-size-mid">Upcoming</div>
        </div>
        <div class="grid-item item-s-12 item-m-8 grid-row no-gutter margin-bottom-basic">
<?php
	while ( $upcoming_query->have_posts() ) {
		$upcoming_query->the_post();

    get_template_part('partials/archive-exhibition-item');
  }
?>
        </div>
<?php
}

wp_reset_postdata();
?>
      </div>
    </div>
  </section>

</main>

<?php
get_footer();
?>
