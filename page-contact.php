<?php
get_header();

if (have_posts()) {
  while (have_posts()) {
    the_post();
?>

<main id="main-content">
  <section id="posts">
    <div class="container">
      <div class="grid-row">
        <div class="grid-item item-s-12 item-m-6 offset-m-6">
          <?php the_content(); ?>
        </div>
      </div>
    </div>
  </section>
</main>

<?php
  } 
}

get_footer();
?>
