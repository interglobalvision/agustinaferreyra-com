<?php
get_header();
?>

<main id="main-content">
  <section id="page">
    <div class="container">
      <div class="grid-row flex-nowrap">
        <div id="logo-holder" class="grid-item flex-grow">
          <?php get_template_part('partials/logo'); ?>
        </div>
<?php
if (have_posts()) {
  while (have_posts()) {
    the_post();
?>
        <article id="page-<?php the_ID(); ?>" <?php post_class('grid-item item-s-12 item-m-6 margin-bottom-mid'); ?>>
          <h1 class="font-size-large font-heavy margin-bottom-mid"><?php the_title(); ?></h1>
          <?php the_content(); ?>
        </article>
<?php
  }
}
?>
      </div>
    </div>
  </section>
</main>

<?php
get_footer();
?>
