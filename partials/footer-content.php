<?php
  $site_options = get_site_option('_igv_site_options');
  $hours = $site_options['_igv_gallery_hours'];
  $address = $site_options['_igv_gallery_address'];
  $email = $site_options['_igv_gallery_email'];
?>

<footer id="footer" class="margin-top-basic padding-bottom-mid">
  <?php echo !is_home() ? '<div class="container">' : ''; ?>
    <div class="grid-row">
      <div class="grid-item item-s-12 <?php echo !is_home() ? 'item-m-6' : ''; ?>">
        <div id="footer-holder" class="border-top padding-top-tiny">
          <div class="font-uppercase font-heavy font-size-mid">
            Galería Agustina Ferreyra
          </div>
          <?php echo !empty($hours) ? '<div class="margin-top-tiny">' . $hours . '</div>' : ''; ?>
          <?php echo !empty($address) ? '<div class="margin-top-tiny">' . apply_filters('the_content', $address) . '</div>' : ''; ?>
          <?php echo !empty($email) ? '<div class="margin-top-tiny"><a href="mailto:' . $email . '">' . $email . '</a></div>' : ''; ?>
        </div>
      </div>
    </div>
  <?php echo !is_home() ? '</div>' : ''; ?>
</footer>
