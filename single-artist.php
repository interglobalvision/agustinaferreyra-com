<?php
get_header();

?>

<main id="main-content">

<?php
// Post-it
$studio_pic = get_post_meta(get_the_ID(), '_igv_artist_studio_pic_id', true);

if (!empty($studio_pic)) {
  render_postit($studio_pic);
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
        <div class="grid-row margin-bottom-basic">
          <div class="grid-item item-s-12 item-m-6 offset-m-6">
            <div class="font-bold font-uppercase font-size-large"><?php the_title(); ?></div>
          </div>
        </div>

        <div id="masonry-holder" class="hidden">
          <div class="masonry-gutter"></div>

          <div id="logo-holder" class="masonry-item">
            <div>
              <?php get_template_part('partials/logo'); ?>
            </div>
          </div>

          <div class="masonry-item grid-row">
            <div class="grid-item item-s-8 no-gutter">
              <?php the_content(); ?>
            </div>
            <div class="grid-item no-gutter item-s-4 text-align-right">
              <?php echo !empty($cv_pdf) ? '<a href="' . $cv_pdf . '" class="link-underline">View CV</a>' : ''; ?>
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
              echo wp_get_attachment_image($image['image_id'], '1920', false, array('class'=>'carousel-trigger','data-no-lazysizes'=>'true','data-index'=>$index));

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
