<?php
$artists = wp_get_post_terms($post->ID, 'artist');
$title = get_post_meta($post->ID, '_igv_exhibition_title', true);
$start = get_post_meta($post->ID, '_igv_exhibition_start', true);
$end = get_post_meta($post->ID, '_igv_exhibition_end', true);
$location = wp_get_post_terms($post->ID, 'location');
$show_title = get_post_meta($post->ID, '_igv_exhibition_show_title', true);
?>
<article <?php post_class('grid-item item-s-12 grid-row no-gutter hover-dot margin-bottom-small'); ?> id="post-<?php the_ID(); ?>">
  <a href="<?php the_permalink() ?>" class="grid-item item-s-12 grid-row no-gutter">
    <div class="grid-item item-s-12 item-m-6 font-uppercase margin-bottom-micro">
    <?php
      if (!empty($show_title) && !empty($title)) {
        echo '<div class="font-uppercase font-size-large font-heavy">' . $title . '</div>';
      } else if (!empty($artists)) {
        foreach ($artists as $artist) {
          echo '<div class="font-uppercase font-size-large font-heavy">' . $artist->name . '</div>';
        }
      }
    ?>
    </div>
    <div class="grid-item item-s-12 item-m-6 margin-bottom-micro">
      <?php
        echo !empty($start) ? '<div class="font-heavy font-uppercase font-size-large">' . igv_format_exhibition_dates($start, $end) . '</div>' : '';

        echo !empty($location) ? '<div>' . $location[0]->name . '</div>' : '';
      ?>
    </div>
  </a>
  <div class="dot"></div>
</article>
