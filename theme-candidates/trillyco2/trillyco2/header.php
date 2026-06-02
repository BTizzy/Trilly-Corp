<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php bloginfo('name'); ?><?php wp_title('|', true, 'left'); ?></title>
  <!-- No Google Fonts: Use system font stack for performance and privacy -->
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
