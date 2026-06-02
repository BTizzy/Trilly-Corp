<?php
// Enqueue styles
add_action('wp_enqueue_scripts', function() {
  wp_enqueue_style('trillyco-style', get_stylesheet_uri());
});
