<?php
// Enqueue styles
add_action('wp_enqueue_scripts', function() {
  wp_enqueue_style('trillyco-style', get_stylesheet_uri());
  wp_enqueue_script('trillyco-js', get_template_directory_uri() . '/js/index.js', [], null, true);
});
