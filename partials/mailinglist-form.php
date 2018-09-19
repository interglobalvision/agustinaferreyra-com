<?php
$options = get_site_option('_igv_site_options');

if (!empty($options['_igv_mailchimp_url'])) {
?>
<form id="mailchimp-form" class="grid-row" novalidate="true">
  <input id="mailchimp-email" type="email" placeholder="EMAIL" name="EMAIL" class="item-s-8 item-l-6">
  <button type="submit" class="button-side-margin">ENTER</button>
  <div id="mailchimp-response" class="item-s-12 margin-top-tiny">&nbsp;</div>
</form>
<?php
}
?>
