<?php
  $site_options = get_site_option('_igv_site_options');
  $hours = $site_options['_igv_gallery_hours'];
  $address = $site_options['_igv_gallery_address'];
  $email = $site_options['_igv_gallery_email'];
?>

  <footer id="footer" class="margin-top-large">
    <div class="container">
      <div class="grid-row">
        <div class="grid-item item-s-12 item-m-6">
          <div id="footer-holder" class="border-top padding-top-small">
            <div class="font-uppercase font-heavy">
              Galería Agustina Ferreyra
            </div>
            <?php echo !empty($hours) ? '<div class="margin-top-small">' . $hours . '</div>' : ''; ?>
            <?php echo !empty($address) ? '<div class="margin-top-small">' . apply_filters('the_content', $address) . '</div>' : ''; ?>
            <?php echo !empty($email) ? '<div class="margin-top-small"><a href="mailto:' . $email . '">' . $email . '</a></div>' : ''; ?>
          </div>
        </div>
      </div>
    </div>
  </footer>

</section>

<?php
get_template_part('partials/scripts');
get_template_part('partials/schema-org');
?>

</body>
</html>
