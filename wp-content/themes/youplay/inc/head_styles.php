<style>
  /* Custom Typography */
  body {
  <?php
    $custom_typography = yp_opts('fonts_typography_body');

    if($custom_typography['font-family']) {
      echo 'font-family: ' . $custom_typography['font-family'] . ', sans-serif;';
    }
    if($custom_typography['font-size']) {
      echo 'font-size: ' . $custom_typography['font-size'] . ';';
    }
    if($custom_typography['letter-spacing']) {
      echo 'letter-spacing: ' . $custom_typography['letter-spacing'] . ';';
    }
    if($custom_typography['line-height']) {
      echo 'line-height: ' . $custom_typography['line-height'] . ';';
    }
  ?>
  }
</style>