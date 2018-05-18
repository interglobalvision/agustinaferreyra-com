<?php
get_header();
?>

<main id="main-content">
  <section id="posts">
    <div class="container">
      <div class="grid-row">
        <div id="logo-holder" class="grid-item item-s-12 item-m-6">
          <?php get_template_part('partials/logo'); ?>
        </div>
        <div class="grid-item item-s-12 item-m-6 grid-row no-gutter align-self-start">

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
          <div class="grid-item item-s-12 exhibitions-section-label-holder margin-bottom-micro">
            <div class="exhibitions-section-label">Current</div>
          </div>
          <div class="grid-item item-s-12 grid-row no-gutter margin-bottom-small">
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
          <div class="grid-item item-s-12 exhibitions-section-label-holder margin-bottom-micro">
            <div class="exhibitions-section-label">Upcoming</div>
          </div>
          <div class="grid-item item-s-12 grid-row no-gutter margin-bottom-small">
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

$past_args = array(
  'post_type' => array( 'exhibition' ),
  'orderby' => 'meta_value_num',
  'meta_key' => '_igv_exhibition_start',
  'meta_query' => array(
    array(
      'key'     => '_igv_exhibition_start',
      'value'   => $now,
      'compare' => '<',
    ),
  ),
);

$past_query = new WP_Query( $past_args );

if ( $past_query->have_posts() ) {
?>
          <div class="grid-item item-s-12 exhibitions-section-label-holder margin-bottom-micro">
            <div class="exhibitions-section-label">Past</div>
          </div>
          <div class="grid-item item-s-12 grid-row no-gutter margin-bottom-small">
<?php
	while ( $past_query->have_posts() ) {
		$past_query->the_post();

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
