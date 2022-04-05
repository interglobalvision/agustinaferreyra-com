<?php
  $site_options = get_site_option('_igv_site_options');
  $hours = $site_options['_igv_gallery_hours'];
  $address = $site_options['_igv_gallery_address'];
  $email = $site_options['_igv_gallery_email'];
?>

<footer id="footer" class="margin-top-basic padding-bottom-mid">
  <div class="container">
    <div class="grid-row">
      <div class="grid-item item-s-12">
        <div class="border-top padding-top-tiny"></div>
      </div>
      <div class="grid-item item-s-12 item-l-6 margin-bottom-small">
        <div class="font-uppercase font-heavy font-size-mid">
          <a href="<?php echo home_url(); ?>">Galería Agustina Ferreyra</a>
        </div>
      </div>
      <div class="grid-item item-s-12 item-l-6 no-gutter">
        <?php get_template_part('partials/mailinglist-form'); ?>
      </div>
    </div>
  </div>
</footer>
