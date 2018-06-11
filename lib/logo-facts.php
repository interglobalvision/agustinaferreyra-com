<?php
function renderLogoFact() {
  $facts = array(
    'temp' => 'Current temp in CDMX is %d&deg; C',
    'expo' => array(
      'close' => 'The current expo closes in %d days',
      'opens' => 'The next expo opens in %d days',
    )
  );

  $key = array_rand($facts);

  // TODO: split expo randomly. add 'closed' for last expo 

  if ($key === 'expo') {
    // Get current or upcoming exhibition

    $now = time();

    $args = array(
      'post_type' => array( 'exhibition' ),
      'orderby' => 'meta_value_num',
      'meta_key' => '_igv_exhibition_start',
      'meta_query' => array(
        'relation' => 'AND',
        array(
          'key'     => '_igv_exhibition_start',
          'value'   => $now,
          'compare' => '<',
        ),
        array(
          'key'     => '_igv_exhibition_end',
          'value'   => $now,
          'compare' => '>',
        ),
      ),
      'posts_per_page' => 1,
      'tax_query' => array(
        array(
          'taxonomy' => 'location',
          'field'    => 'slug',
          'terms'    => 'galeria-agustina-ferreyra',
        ),
    	),
    );

    $expo_query = new WP_Query( $args );

    if ($expo_query->have_posts()) {
      while($expo_query->have_posts()) {
        $expo_query->the_post();

        $string = $facts[$key]['close'];

        $expo_end_date = get_post_meta(get_the_ID(), '_igv_exhibition_end', true);

        $value = abs($now - $expo_end_date)/60/60/24;

      }
    } else {
      $args['meta_query'] = array(
        array(
          'key'     => '_igv_exhibition_start',
          'value'   => $now,
          'compare' => '>',
        ),
      );

      $expo_query = new WP_Query( $args );

      if ($expo_query->have_posts()) {
        while($expo_query->have_posts()) {
          $expo_query->the_post();

          $string = $facts[$key]['opens'];

          $expo_start_date = get_post_meta(get_the_ID(), '_igv_exhibition_start', true);

          $value = abs($now - $expo_start_date)/60/60/24;

        }
      } else {
        $key = 'temp';
      }
    }
  }

  if ($key === 'temp') {
    // Get Site Options
    $site_options = get_site_option('_igv_site_options');

    // Check the API key
    if(isset($site_options['_igv_weather_api_key'])) {
      // Get Zip Code Api Key
      $api_key = $site_options['_igv_weather_api_key'];

      // Init http client
      // https://github.com/guzzle/guzzle
      $client = new \GuzzleHttp\Client();

      // Wrapped in try/catch to catch exceptions
      try {


        // Requestes all zipcodes whithin 3 miles
        $res = $client->request('GET', 'http://api.openweathermap.org/data/2.5/weather?id=3530597&units=metric&appid=' . $api_key);

        // Decode the response's body
        $decoded_res = json_decode($res->getBody());

        $string = $facts[$key];

        $value = $decoded_res->main->temp;

      } catch (Exception $e) {
        $value = 0;
        $string = 'Everything<br> else';
      }

    } else {
      $value = 0;
      $string = 'Everything<br> else';
    }
  }

  echo sprintf($string, $value);
}
