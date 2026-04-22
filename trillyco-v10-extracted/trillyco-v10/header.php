<?php if (!defined('ABSPATH')) { exit; } ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> data-theme="light">
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Trilly Co — hands-on HR operations and hiring systems for small businesses and startups in Seattle. Get cleaner people process without the overhead.">
  <title><?php wp_title('·', true, 'right'); ?><?php bloginfo('name'); ?></title>
  <link rel="preconnect" href="https://api.fontshare.com" crossorigin>
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<a class="skip" href="#main">Skip to main content</a>

<nav class="site-nav" role="navigation" aria-label="Main navigation">
  <div class="wrap nav-inner">

    <!-- Brand -->
    <a class="brand" href="<?php echo esc_url(home_url('/')); ?>" aria-label="Trilly Co — home">
      <span class="brand-logo-wrap">
        <img
          class="brand-logo-img"
          src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo-trillium.png'); ?>"
          alt="Trilly Co logo"
          width="44"
          height="44"
          loading="eager"
        >
      </span>
      <span>
        <strong>Trilly Co.</strong>
        <span class="brand-sub">People Operations &amp; Hiring</span>
      </span>
    </a>

    <!-- Desktop links -->
    <div class="nav-links" role="list">
      <a href="#who-we-help" role="listitem">Who we help</a>
      <a href="#services" role="listitem">Services</a>
      <a href="#approach" role="listitem">Our Approach</a>
      <a href="#faq" role="listitem">FAQs</a>
    </div>

    <!-- Right side -->
    <div class="nav-right">
      <!-- Theme toggle -->
      <button class="theme-btn" data-theme-toggle aria-label="Toggle dark mode">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>
        </svg>
      </button>
      <!-- Primary nav CTA -->
      <a class="nav-cta" href="#contact" data-route-audience="general">Get Started Today</a>
      <!-- Mobile hamburger -->
      <button class="menu-btn" data-menu-toggle aria-label="Open menu" aria-expanded="false" aria-controls="mobile-menu">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round">
          <line x1="3" y1="6"  x2="21" y2="6"/>
          <line x1="3" y1="12" x2="21" y2="12"/>
          <line x1="3" y1="18" x2="21" y2="18"/>
        </svg>
      </button>
    </div>

  </div><!-- .nav-inner -->

  <!-- Mobile drawer -->
  <div class="mobile-menu" id="mobile-menu" aria-hidden="true" role="menu">
    <a href="#who-we-help" role="menuitem">Who we help</a>
    <a href="#services"    role="menuitem">Services</a>
    <a href="#approach"    role="menuitem">Our Approach</a>
    <a href="#faq"         role="menuitem">FAQs</a>
    <a href="#contact" class="mobile-cta" data-route-audience="general" role="menuitem">Get Started Today</a>
  </div>

</nav><!-- .site-nav -->
