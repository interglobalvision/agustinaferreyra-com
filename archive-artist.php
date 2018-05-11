<?php
get_header();
?>

<main id="main-content" class="margin-top-mid">
  <section id="posts">
    <div class="container">
      <div class="grid-row flex-nowrap">
        <div id="logo-holder" class="grid-item flex-grow item-m-6">
          <?php get_template_part('partials/logo'); ?>
        </div>
        <div class="grid-item item-s-12 item-m-6 grid-row align-self-start">
<?php
if (have_posts()) {
?>
          <ul>
<?php
  while (have_posts()) {
    the_post();
?>
            <li class="margin-bottom-tiny font-size-mid"><a href="<?php the_permalink(); ?>"><?php echo the_title(); ?></a></li>
<?php
  }
?>
          </ul>
<?php
}
?>
        </div>
      </div>
    </div>
  </section>
</main>

<?php
get_footer();
?>
