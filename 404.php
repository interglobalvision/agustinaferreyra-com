<?php
get_header();
?>

<main id="main-content">
  <section id="404">
    <div class="container">
      <div class="grid-row flex-nowrap">
        <div id="logo-holder" class="grid-item flex-grow">
          <?php get_template_part('partials/logo'); ?>
        </div>
        <div class="grid-item item-s-12 item-m-6">
          <h1 class="font-size-large font-heavy">404?!</h1>
          <p>Whatever you're lookin' for ain't here</p>
        </div>
      </div>
    </div>
  </section>
</main>

<?php
get_footer();
?>
