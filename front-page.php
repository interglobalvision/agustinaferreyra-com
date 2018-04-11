<?php
get_header();
?>

<main id="main-content">
  <section id="posts">
    <div class="container">
      <div class="grid-row">

<?php
$now = time();

$args = array(
	'post_type' => array( 'exhibition' ),
  'orderby' => 'meta_value_num',
  'meta_key' => '_igv_exhibition_start',
  'meta_query' => array(
    'relation' => 'AND',
		array(
			'key'     => '_igv_exhibition_start',
			'value'   => $now,
			'compare' => '<=',
		),
    array(
			'key'     => '_igv_exhibition_end',
			'value'   => $now,
			'compare' => '>=',
		),
	),
);

$current_query = new WP_Query( $args );

if ( $current_query->have_posts() ) {
?>
        <div class="grid-item item-s-12 item-m-6 offset-m-6 grid-row">
<?php
	while ( $current_query->have_posts() ) {
		$current_query->the_post();
?>

          <article <?php post_class('grid-item item-s-12 no-gutter'); ?> id="post-<?php the_ID(); ?>">

            <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>

          </article>

<?php
  }
?>
        </div>
<?php
}

// Restore original Post Data
wp_reset_postdata();
?>

      </div>
    </div>
  </section>

</main>

<?php
get_footer();
?>
