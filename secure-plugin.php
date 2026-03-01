<?php
/*
 * Plugin Name:       Secure Plugin
 * Plugin URI:        https://github.com/subas-roy/
 * Description:       A demo plugin for securing inputs, AJAX, and nonces in WordPress.
 * Version:           1.0
 * Requires at least: 6.8
 * Requires PHP:      8.0
 * Author:            Subas Roy
 * Author URI:        https://github.com/subas-roy/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       secure-plugin
 */

// 1. Nonce validation
// 2. Input validation
// 3. Input sanitization
// 4. Escaping output

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Enqueue assets
function secure_plugin_enqueue_assets() {
    wp_enqueue_style('secure-plugin', plugin_dir_url(__FILE__) . 'style.css', [], '1.0.0', 'all');
    wp_enqueue_script('secure-plugin', plugin_dir_url(__FILE__) . 'ajax-script.js', ['jquery'], '1.0.0', true);

    // Localize script to pass AJAX URL and nonce
    wp_localize_script('secure-plugin', 'siteInfo', [
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('secure_plugin_nonce')
    ]);
}
add_action('wp_enqueue_scripts', 'secure_plugin_enqueue_assets');

// Shortcode 
function secure_plugin_from_shortcode() {
  ob_start();
  include_once 'form.php';
  return ob_get_clean();
}
add_shortcode('secure_plugin_from', 'secure_plugin_from_shortcode');


// Register AJAX handler
function secure_plugin_form_handler() {
  error_log('==============');
  error_log(print_r($_REQUEST, true));
  error_log('==============');
}
add_action('wp_ajax_secure_plugin_ajax', 'secure_plugin_form_handler');