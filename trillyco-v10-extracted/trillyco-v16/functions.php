<?php
/**
 * Trilly Co Theme Functions
 * Version: 2.0.0
 */
if (!defined('ABSPATH')) { exit; }

function trillyco_setup() {
  add_theme_support('title-tag');
  add_theme_support('html5', ['search-form','comment-form','comment-list','gallery','caption','style','script']);
  add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'trillyco_setup');

function trillyco_enqueue() {
  wp_enqueue_style(
    'trillyco-style',
    get_stylesheet_uri(),
    [],
    '2.0.0'
  );
  wp_enqueue_script(
    'trillyco-script',
    get_template_directory_uri() . '/assets/js/main.js',
    [],
    '2.0.0',
    true
  );
  // Pass AJAX URL and nonce to JS (for form submission)
  wp_localize_script('trillyco-script', 'trillycoData', [
    'ajaxUrl' => admin_url('admin-ajax.php'),
    'nonce'   => wp_create_nonce('trillyco_contact'),
  ]);
}
add_action('wp_enqueue_scripts', 'trillyco_enqueue');

/**
 * Contact form AJAX handler
 * On the WordPress side you can pipe this into HubSpot via
 * the HubSpot WP plugin's form submission hook, or simply
 * forward the POST to the HubSpot Forms API (v3).
 */
function trillyco_handle_contact() {
  check_ajax_referer('trillyco_contact', 'nonce');

  $name     = sanitize_text_field($_POST['name'] ?? '');
  $email    = sanitize_email($_POST['email'] ?? '');
  $audience = sanitize_text_field($_POST['audience'] ?? 'general');
  $message  = sanitize_textarea_field($_POST['message'] ?? '');

  if (empty($name) || !is_email($email)) {
    wp_send_json_error(['message' => 'Please fill in your name and a valid email.']);
  }

  // ── Forward to HubSpot Forms API ────────────────────────────
  // Replace PORTAL_ID and FORM_GUID with your HubSpot values.
  // Create one HubSpot form for small-business and one for startup,
  // then select the correct GUID based on the $audience value.
  $hs_portal = defined('TRILLYCO_HS_PORTAL') ? TRILLYCO_HS_PORTAL : '';
  $hs_forms  = [
    'small-business' => defined('TRILLYCO_HS_FORM_SMB')     ? TRILLYCO_HS_FORM_SMB     : '',
    'startup'        => defined('TRILLYCO_HS_FORM_STARTUP')  ? TRILLYCO_HS_FORM_STARTUP : '',
    'general'        => defined('TRILLYCO_HS_FORM_GENERAL')  ? TRILLYCO_HS_FORM_GENERAL : '',
  ];
  $form_guid = $hs_forms[$audience] ?? $hs_forms['general'];

  if ($hs_portal && $form_guid) {
    $hs_url = "https://api.hsforms.com/submissions/v3/integration/submit/{$hs_portal}/{$form_guid}";
    $payload = wp_json_encode([
      'fields' => [
        ['name' => 'firstname', 'value' => $name],
        ['name' => 'email',     'value' => $email],
        ['name' => 'message',   'value' => $message],
        ['name' => 'audience',  'value' => $audience], // custom HubSpot property
      ],
      'context' => [
        'pageUri'  => isset($_SERVER['HTTP_REFERER']) ? esc_url_raw($_SERVER['HTTP_REFERER']) : '',
        'pageName' => 'Trilly Co - Home',
      ],
    ]);
    wp_remote_post($hs_url, [
      'headers'     => ['Content-Type' => 'application/json'],
      'body'        => $payload,
      'data_format' => 'body',
      'timeout'     => 15,
    ]);
  }

  // Fallback: email notification
  if (defined('TRILLYCO_NOTIFY_EMAIL') && TRILLYCO_NOTIFY_EMAIL) {
    wp_mail(
      TRILLYCO_NOTIFY_EMAIL,
      "[Trilly Co] New inquiry — {$audience}: {$name}",
      "Name: {$name}\nEmail: {$email}\nAudience: {$audience}\n\n{$message}"
    );
  }

  wp_send_json_success(['message' => "Thanks {$name} — we'll be in touch shortly."]);
}
add_action('wp_ajax_trillyco_contact',        'trillyco_handle_contact');
add_action('wp_ajax_nopriv_trillyco_contact', 'trillyco_handle_contact');
