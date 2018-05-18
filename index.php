<?php
get_header();
?>

<main id="main-content">
  <section id="posts">
    <div class="container">
      <div class="grid-row">
        <div class="grid-item item-s-12 item-m-6 no-gutter grid-row">
          <div class="grid-item item-s-12">
            <?php get_template_part('partials/logo'); ?>
          </div>
          <div class="grid-item item-s-12 no-gutter">
            <?php get_template_part('partials/footer-content'); ?>
          </div>
        </div>

<?php
if (have_posts()) {
?>
        <div class="grid-item item-s-12 item-m-6 no-gutter grid-row align-items-start">
<?php
  while (have_posts()) {
    the_post();
?>
          <article <?php post_class('grid-item item-s-12 item-m-6 border-top padding-top-small padding-bottom-basic'); ?> id="post-<?php the_ID(); ?>">

            <?php the_content(); ?>

          </article>
<?php
  }
?>
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
