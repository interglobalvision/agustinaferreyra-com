<?php
get_header();

?>

<main id="main-content" class="margin-top-large padding-top-basic">

<?php
// Post-it
$studio_pic = get_post_meta(get_the_ID(), '_igv_artist_studio_pic_id', true);

if (!empty($studio_pic)) {
?>

  <div id="postit">
    <?php echo wp_get_attachment_image($studio_pic, 'thumbnail', false, 'class=postit-image'); ?>
    <div id="postit-dot" class="dot"></div>
  </div>

<?php
}
?>

  <section id="posts">
    <div class="container">

<?php
if (have_posts()) {
  while (have_posts()) {
    the_post();

    $cv_pdf = get_post_meta($post->ID, '_igv_artist_cv_pdf', true);
    $images = get_post_meta($post->ID, '_igv_artist_images', true);
?>
      <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
        <div class="grid-row padding-bottom-basic">
          <div class="grid-item item-s-12 item-m-6 offset-m-6">
            <div class="font-bold font-uppercase font-size-large margin-bottom-mid"><?php the_title(); ?></div>
            <div class="grid-row justify-between align-items-start">
              <div class="grid-item item-s-8 no-gutter">
                <?php the_content(); ?>
              </div>
              <div class="grid-item no-gutter">
                <?php echo !empty($cv_pdf) ? '<a href="' . $cv_pdf . '" class="link-underline">View CV</a>' : ''; ?>
              </div>
            </div>
          </div>
        </div>

        <div class="masonry-holder">
          <div class="masonry-gutter"></div>

          <div id="logo-holder" class="masonry-item">
            <div>
              <?php get_template_part('partials/logo'); ?>
            </div>
          </div>

        <?php
          if (!empty($images)) {
        ?>
          <?php
            $index = 0;

            foreach($images as $image) {
          ?>
          <div class="masonry-item">
            <?php
              echo wp_get_attachment_image($image['image_id'], 'full', false, array('class'=>'carousel-trigger','data-no-lazysizes'=>'true','data-index'=>$index));

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
                  <?php echo wp_get_attachment_image($image['image_id'], 'full', false, 'data-no-lazysizes=true'); ?>
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
