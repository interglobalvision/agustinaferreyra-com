<?php
get_header();
?>

<main id="main-content">
  <section id="posts">
    <div class="container">

<?php
if (have_posts()) {
  while (have_posts()) {
    the_post();

    $artists = wp_get_post_terms($post->ID, 'artist');
    $title = get_post_meta($post->ID, '_igv_exhibition_title', true);
    $start = get_post_meta($post->ID, '_igv_exhibition_start', true);
    $end = get_post_meta($post->ID, '_igv_exhibition_end', true);
    $location = wp_get_post_terms($post->ID, 'location');
    $pr_pdf = get_post_meta($post->ID, '_igv_exhibition_pdf', true);
?>
      <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
        <div class="grid-row">
          <div class="grid-item item-s-12 item-m-6">
            <?php
              echo !empty($start) ? '<div class="font-bold font-uppercase">' . igv_format_exhibition_dates($start, $end) . '</div>' : '';
            ?>
            <?php
              if (!empty($location)) {
                echo '<div>' . $location[0]->name . '</div>';

                $location_city = get_term_meta($location[0]->term_id, '_igv_location_city', true);

                echo !empty($location_city) ? '<div>' . $location_city . '</div>' : '';
              }
            ?>
          </div>
          <div class="grid-item item-s-12 item-m-6">
            <?php
              if (!empty($artists)) {
                foreach ($artists as $artist) {
                  echo '<div class="font-bold font-uppercase">' . $artist->name . '</div>';
                }
              }
            ?>
            <div class="grid-row justify-between align-items-end">
              <div class="grid-item no-gutter">
                <?php echo !empty($title) ? '<h2 class="font-uppercase">' . $title . '</h2>' : ''; ?>
              </div>
              <div class="grid-item no-gutter">
                <?php echo !empty($pr_pdf) ? '<a href="' . $pr_pdf . '" class="link-underline">Press Release</a>' : ''; ?>
              </div>
            </div>
          </div>
        </div>
      </article>
<?php
  }
}
?>

    </div>
  </section>
</main>

<?php
get_footer();
?>
