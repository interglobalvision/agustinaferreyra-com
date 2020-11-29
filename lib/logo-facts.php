<?php
class BlogFact {
  private $facts = array(
    'weather' => array(
      'temp' => 'Current temp in San Juan, PR is %d&deg;C',
      'conditions' => '%s in San Juan, PR',
    ),
    'expo' => array(
      'closes' => 'The current expo closes in %d days',
      'opens' => 'The next expo opens in %d days',
      'closed' => 'The last expo closed %d days ago',
    ),
  );

  public function renderFact() {
    $site_options = get_site_option('_igv_site_options');

    if (!empty($site_options['_igv_blog_logo_strings'])) {
      $this->facts['string'] = $site_options['_igv_blog_logo_strings'];
    }

    $fact = $this->getFact();

    wp_reset_query();

    echo $fact;
  }

  private function getFact() {
    switch (array_rand($this->facts)) {
      case 'weather':
        $fact = $this->getWeatherFact();
        break;
      case 'expo':
        $fact = $this->getExpoFact();
        break;
      case 'string':
        $fact = $this->getStringFact();
        break;
      default:
        $fact = false;
    }

    if (!$fact) {
      $fact = $this->getFact();
    }

    return $fact;
  }

  private function getWeatherFact() {
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
        // Requests weather data
        $res = $client->request('GET', 'http://api.openweathermap.org/data/2.5/weather?id=4568138&units=metric&appid=' . $api_key);

        // Decode the response's body
        $weatherRes = json_decode($res->getBody());

        switch (array_rand($this->facts['weather'])) {
          case 'temp':
            return $this->getWeatherTemp($weatherRes);
            break;
          case 'conditions':
            return $this->getWeatherConditions($weatherRes);
            break;
          default:
            return false;
        }
      } catch (Exception $e) {
        // Remove this as fact option
        unset($this->facts['weather']);

        return false;
      }
    } else {
      // Remove this as fact option
      unset($this->$facts['weather']);

      return false;
    }
  }

  private function getWeatherTemp($weatherRes) {
    // Display current temperature in CDMX

    $string = $this->facts['weather']['temp'];

    $value = $weatherRes->main->temp;

    return sprintf($string, $value);
  }

  private function getWeatherConditions($weatherRes) {
    // Display current weather conditions in CDMX

    $string = $this->facts['weather']['conditions'];

    // https://openweathermap.org/weather-conditions#Weather-Condition-Codes-2
    $value = ucfirst($weatherRes->weather[0]->description);

    return sprintf($string, $value);
  }

  private function getExpoFact() {
    $this->timeNow = time();

    $this->expoArgs = array(
      'post_type' => array( 'exhibition' ),
      'orderby' => 'meta_value_num',
      'meta_key' => '_igv_exhibition_start',
      'posts_per_page' => 1,
      'tax_query' => array(
        array(
          'taxonomy' => 'location',
          'field'    => 'slug',
          'terms'    => 'galeria-agustina-ferreyra',
        ),
    	),
    );

    switch (array_rand($this->facts['expo'])) {
      case 'closes':
        return $this->getExpoCloses();
        break;
      case 'opens':
        return $this->getExpoOpens();
        break;
      case 'closed':
        return $this->getExpoClosed();
        break;
    }
  }

  private function getExpoCloses() {
    // Display current exhibition fact

    $this->expoArgs['meta_query'] = array(
      'relation' => 'AND',
      array(
        'key'     => '_igv_exhibition_start',
        'value'   => $this->timeNow,
        'compare' => '<',
      ),
      array(
        'key'     => '_igv_exhibition_end',
        'value'   => $this->timeNow,
        'compare' => '>',
      ),
    );

    $expo_query = new WP_Query( $this->expoArgs );

    // Display when current exhibition ends
    if ($expo_query->have_posts()) {
      while($expo_query->have_posts()) {
        $expo_query->the_post();

        $string = $this->facts['expo']['closes'];

        $expo_end_date = get_post_meta(get_the_ID(), '_igv_exhibition_end', true);

        $value = abs($this->timeNow - $expo_end_date)/60/60/24;

        return sprintf($string, $value);
      }
    } else {
      // Remove this as fact option
      unset($this->facts['expo']['closes']);

      return false;
    }
  }

  private function getExpoOpens() {
    // Display upcoming exhibition fact

    $this->expoArgs['meta_query'] = array(
      array(
        'key'     => '_igv_exhibition_start',
        'value'   => $this->timeNow,
        'compare' => '>',
      ),
    );

    $expo_query = new WP_Query( $this->expoArgs );

    // Display when next exhibition starts
    if ($expo_query->have_posts()) {
      while($expo_query->have_posts()) {
        $expo_query->the_post();

        $string = $this->facts['expo']['opens'];

        $expo_start_date = get_post_meta(get_the_ID(), '_igv_exhibition_start', true);

        $value = abs($this->timeNow - $expo_start_date)/60/60/24;

        return sprintf($string, $value);
      }
    } else {
      // Remove this as fact option
      unset($this->facts['expo']['opens']);

      return false;
    }
  }

  private function getExpoClosed() {
    // Display past exhibition fact

    $this->expoArgs['meta_query'] = array(
      array(
        'key'     => '_igv_exhibition_end',
        'value'   => $this->timeNow,
        'compare' => '<',
      ),
    );

    $expo_query = new WP_Query( $this->expoArgs );

    // Display when last exhibition ended
    if ($expo_query->have_posts()) {
      while($expo_query->have_posts()) {
        $expo_query->the_post();

        $string = $this->facts['expo']['closed'];
        echo get_the_title();
        $expo_end_date = get_post_meta(get_the_ID(), '_igv_exhibition_end', true);

        $value = abs($this->timeNow - $expo_end_date)/60/60/24;

        return sprintf($string, $value);
      }
    } else {
      // Remove this as fact option
      unset($this->facts['expo']['closed']);

      return false;
    }
  }

  private function getStringFact() {
    return $this->facts['string'][array_rand($this->facts['string'])];
  }
}
