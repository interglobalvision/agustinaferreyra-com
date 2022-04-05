<?php
get_header();
?>

<main id="main-content">
  <section id="posts">
    <div class="container">
      <div class="grid-row align-items-start">
        <div id="blog-info" class="grid-item item-s-12 item-m-6 no-gutter grid-row">
          <div class="grid-item item-s-12 no-gutter">
            <?php get_template_part('partials/footer-content'); ?>
          </div>
        </div>

<?php
if (have_posts()) {
?>
        <div id="blog-posts" class="grid-item item-s-12 item-m-6 no-gutter align-items-start">
          <div id="masonry-holder" class="hidden">
<?php
  while (have_posts()) {
    the_post();
?>
            <article <?php post_class('masonry-item padding-bottom-basic'); ?> id="post-<?php the_ID(); ?>">
              <div class="grid-item no-gutter item-s-8 border-top margin-bottom-small"></div>
              <div class="grid-item no-gutter item-s-12 text-max-width text-align-justify js-fix-widows">
                <?php the_content(); ?>
              </div>
            </article>
<?php
  }
?>
          </div>
        </div>
<?php
}
?>

      </div>
    </div>
  </section>

  <?php get_template_part('partials/pagination'); ?>

</main>

<?php
get_footer();
?>
