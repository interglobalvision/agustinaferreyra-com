<?php
$options = get_site_option('_igv_site_options');

if (!empty($options['_igv_mailchimp_url'])) {
?>
<form id="mailchimp-form" class="grid-row margin-top-small" novalidate="true">
  <div class="grid-item item-s-12 margin-bottom-micro">Join our mailing list:</div>
  <div class="grid-item item-s-12">
    <input id="mailchimp-email" type="email" placeholder="Email" name="EMAIL">
    <button id="mailchimp-submit" type="submit" class="font-bold u-pointer">Subscribe</button>
  </div>
  <div id="mailchimp-response" class="grid-item item-s-12 margin-top-micro">&nbsp;</div>
</form>
<?php
}
?>
