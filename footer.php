<?php
  $hours = IGV_get_option('_igv_site_options', '_igv_gallery_hours');
  $address = IGV_get_option('_igv_site_options', '_igv_gallery_address');
  $email = IGV_get_option('_igv_site_options', '_igv_gallery_email');
?>

  <footer id="footer">
    <div class="container">
      <div class="grid-row">
        <div class="grid-item item-s-12 item-m-6 border-top padding-top-small">
          <div class="font-uppercase font-bold">
            Galería Agustina Ferreyra
          </div>
          <? echo !empty($hours) ? '<div class="margin-top-small">' . $hours . '</div>' : ''; ?>
          <? echo !empty($address) ? '<div class="margin-top-small">' . apply_filters('the_content', $address) . '</div>' : ''; ?>
          <? echo !empty($email) ? '<div class="margin-top-small"><a href="mailto:' . $email . '">' . $email . '</a></div>' : ''; ?>
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
