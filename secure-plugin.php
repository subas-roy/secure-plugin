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

function secure_plugin_enqueue_assets() {
  wp_enqueue_style( 'secure-plugin', plugin_dir_url( __FILE__ ) . 'style.css', [], '1.0.0', 'all' );
  wp_enqueue_script( 'secure-plugin', plugin_dir_url( __FILE__ ) . 'ajax-script.js', ['jquery'], '1.0.0', true);

  wp_localize_script( 'secure-plugin', 'siteInfo', [
    'ajaxUrl' => admin_url('admin-ajax.php'),
    'nonce' => wp_create_nonce( 'secure_plugin_nonce')
  ]);
}
add_action( 'wp_enqueue_scripts', 'secure_plugin_enqueue_assets' );


function secure_plugin_form_shortcode() {
  ob_start();
  include_once 'form.php';
  return ob_get_clean();
}
add_shortcode('secure_plugin_form', 'secure_plugin_form_shortcode' );


function secure_plugin_form_handler() {
  if (!wp_verify_nonce( $_REQUEST['nonce'], 'secure_plugin_nonce' )) {
    wp_send_json_error( 'unauthorized request');
  }

  parse_str( $_REQUEST['form_data'], $post ); // Convert query string to associative array using parse_str function

  if (!is_string($post['name'] ) ) {
    wp_send_json_error( 'Name must be a string');
  }
  if (!is_email($post['email'] ) ) {
    wp_send_json_error( 'Email must be a valid email address' );
  }
  if (!is_numeric( $post['age'])) {
    wp_send_json_error( 'Age must be a number');
  }
  if (!is_string($post['message'] ) ) {
    wp_send_json_error('Message must be a string');
  }

  error_log( '==============================' );
  error_log(print_r( $post, true ));
  error_log( '==============================' );
}
add_action( 'wp_ajax_secure_plugin_ajax', 'secure_plugin_form_handler' );