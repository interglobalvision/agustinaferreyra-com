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
