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
    $images = get_post_meta($post->ID, '_igv_exhibition_images', true);
?>
      <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
        <div class="grid-row">
          <div class="grid-item item-s-12 item-m-6 margin-bottom-basic">
            <?php
              echo !empty($start) ? '<div class="font-heavy font-uppercase font-size-mid">' . igv_format_exhibition_dates($start, $end) . '</div>' : '';
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
              return_artist_list($artists);
            ?>
            <div class="grid-row justify-between align-items-end">
              <div class="grid-item no-gutter item-s-8 margin-bottom-basic">
                <?php echo !empty($title) ? '<h2 class="font-uppercase font-size-mid">' . $title . '</h2>' : ''; ?>
              </div>
              <div class="grid-item no-gutter item-s-4 text-align-right margin-bottom-basic">
                <?php echo !empty($pr_pdf) ? '<a href="' . $pr_pdf . '" class="link-underline">Press Release</a>' : ''; ?>
              </div>
            </div>
          </div>
        </div>

        <div id="masonry-holder" class="hidden">
          <div class="masonry-gutter"></div>

          <div id="logo-holder" class="masonry-item">
            <div>
              <?php get_template_part('partials/logo'); ?>
            </div>
          </div>

        <?php
          if (!empty(get_the_content())) {
        ?>

          <div class="masonry-item grid-row">
            <div class="grid-item item-s-8 no-gutter">
              <?php the_content(); ?>
            </div>
          </div>

        <?php
          }

          if (!empty($images)) {
        ?>
          <?php
            $index = 0;

            foreach($images as $image) {
          ?>
          <div class="masonry-item">
            <?php
              if (!empty($image['image_id'])) {
                echo wp_get_attachment_image($image['image_id'], '1920', false, array('class'=>'carousel-trigger','data-no-lazysizes'=>'true','data-index'=>$index));
              } elseif (!empty($image['vimeo_id'])) {
            ?>

            <div class="u-video-embed-container">
              <iframe src="https://player.vimeo.com/video/<?php echo $image['vimeo_id']; ?>?color=ffffff&title=0&byline=0&portrait=0" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
            </div>

            <?php
              }

              echo !empty($image['caption']) ? '<div class="masonry-item-caption margin-top-tiny">' . apply_filters('the_content', $image['caption']) . '</div>' : '';
            ?>
          </div>
          <?php
              $index++;
            }
          ?>
        </div>

        <div id="carousel-overlay">
          <div class="slick-carousel">
            <?php
              foreach($images as $image) {
            ?>
            <div class="slide-content-holder">
              <div class="grid-column justify-center align-items-center">
                <div>
                  <?php echo wp_get_attachment_image($image['image_id'], '1920', false, 'data-no-lazysizes=true'); ?>
                </div>
              </div>
            </div>
            <?php
              }
            ?>
          </div>
        </div>
        <?php
          }
        ?>
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
