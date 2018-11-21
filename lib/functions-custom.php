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

function return_artist_list($artists, $classes) {
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
      echo '<div class="' . $classes . '">' . $artist_list . '</div>';
    } else {
      foreach ($artists as $artist) {
        echo '<div class="' . $classes . '">' . $artist->name . '</div>';
      }
    }
  }
}

function render_postit($id) {
  $file_path = wp_get_attachment_url($id);
  $filetype = wp_check_filetype($file_path);
  $size = $filetype['ext'] === 'gif' ? 'full' : 'thumbnail';
?>
  <div id="postit">
    <div id="postit-scale">
      <?php
        echo wp_get_attachment_image($id, $size, false, 'class=postit-image');
      ?>
      <div id="postit-dot" class="dot"></div>
    </div>
  </div>
  <?php
}

function return_pdf_links($pr_pdf_en, $pr_pdf_es) {
  if (!empty($pr_pdf_en) && !empty($pr_pdf_es)) {
    echo 'Press Release ';
    echo !empty($pr_pdf_en) ? '<a href="' . $pr_pdf_en . '" class="link-underline">EN</a> ' : '';
    echo !empty($pr_pdf_es) ? '<a href="' . $pr_pdf_es . '" class="link-underline">ES</a>' : '';
  } elseif (!empty($pr_pdf_en)) {
    echo !empty($pr_pdf_en) ? '<a href="' . $pr_pdf_en . '" class="link-underline">Press Release</a>' : '';
  } elseif (!empty($pr_pdf_es)) {
    echo !empty($pr_pdf_es) ? '<a href="' . $pr_pdf_es . '" class="link-underline">Press Release</a>' : '';
  }
}
