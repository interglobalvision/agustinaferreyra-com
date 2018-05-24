<?php

// Custom functions (like special queries, etc)

function igv_format_exhibition_dates($start, $end) {
  if (!empty($start)) {
    $date_string = '';

    $start_month = date('M', $start);
    $start_day = date('d', $start);
    $start_year = date('Y', $start);
    if (!empty($end)) {
      $end_month = date('M', $end);
      $end_day = date('d', $end);
      $end_year = date('Y', $end);
      if ($start_month === $end_month) {
        $date_string .= $start_month . '.' . $start_day . '–' . $end_day;
      } else {
        $date_string .= $start_month . '.' . $start_day . '–' . $end_month . '.' . $end_day;
      }
      $date_string .= ' ' . $end_year;
    } else {
      $date_string .= $start_month . '.' . $start_day . ' ' . $start_year;
    }

    return $date_string;
  }
}

function return_artist_list($artists) {
  if (!empty($artists)) {
    if (count($artists) >= 5) {
      $artist_list = '';
      foreach ($artists as $key => $artist) {
        $artist_list .= '<span class="u-inline-block">';

        $artist_list .= $artist->name ;

        if ($key != count($artists) - 1) {
          $artist_list .= ',&nbsp;';
        }

        $artist_list .= '</span>';
      }
      echo '<div class="font-uppercase font-size-large font-heavy">' . $artist_list . '</div>';
    } else {
      foreach ($artists as $artist) {
        echo '<div class="font-uppercase font-size-large font-heavy">' . $artist->name . '</div>';
      }
    }
  }
}
