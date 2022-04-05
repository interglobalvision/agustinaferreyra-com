<?php
get_header();
?>

<main id="main-content">
  <section id="posts">
    <div class="container">
      <div class="grid-row">

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
        <div class="item-s-12 item-l-6 offset-l-6">
          <div class="grid-item exhibitions-section-label-holder margin-bottom-micro">
            <div class="exhibitions-section-label padding-bottom-micro">Current</div>
          </div>
          <div class="grid-row margin-bottom-small">
<?php
	while ( $current_query->have_posts() ) {
		$current_query->the_post();
    $offsite_url = get_post_meta($post->ID, '_igv_exhibition_offsite_url', true);
?>
            <article <?php post_class('grid-item item-s-12 grid-row no-gutter hover-dot margin-bottom-small' . (!empty($offsite_url) ? ' offsite-item' : '')); ?> id="post-<?php the_ID(); ?>">
              <?php get_template_part('partials/archive-exhibition-item'); ?>
            </article>
<?php
  }
?>
          </div>
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
        <div class="item-s-12 item-l-6 offset-l-6">
          <div class="grid-item exhibitions-section-label-holder margin-bottom-micro">
            <div class="exhibitions-section-label padding-bottom-micro">Upcoming</div>
          </div>
          <div class="grid-row margin-bottom-small">
<?php
	while ( $upcoming_query->have_posts() ) {
		$upcoming_query->the_post();
    $offsite_url = get_post_meta($post->ID, '_igv_exhibition_offsite_url', true);
?>
                <article <?php post_class('grid-item item-s-12 grid-row no-gutter hover-dot margin-bottom-small' . (!empty($offsite_url) ? ' offsite-item' : '')); ?> id="post-<?php the_ID(); ?>">
                  <?php get_template_part('partials/archive-exhibition-item'); ?>
                </article>
<?php
  }
?>
          </div>
        </div>
<?php
}

wp_reset_postdata();

$past_args = array(
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
      'compare' => '<',
    ),
  ),
);

$past_query = new WP_Query( $past_args );

if ( $past_query->have_posts() ) {
?>
        <div class="item-s-12">
          <div class="grid-item exhibitions-section-label-holder margin-bottom-micro">
            <div class="exhibitions-section-label padding-bottom-micro">Past</div>
          </div>
          <div class="grid-row margin-bottom-small">
<?php
	while ( $past_query->have_posts() ) {
		$past_query->the_post();
    $offsite_url = get_post_meta($post->ID, '_igv_exhibition_offsite_url', true);
?>
                <article <?php post_class('grid-item item-s-12 item-m-6 grid-row no-gutter hover-dot margin-bottom-small' . (!empty($offsite_url) ? ' offsite-item' : '')); ?> id="post-<?php the_ID(); ?>">
                  <?php get_template_part('partials/archive-exhibition-item'); ?>
                </article>
<?php
  }
?>
          </div>
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
