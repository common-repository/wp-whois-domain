<?php
/*
Plugin Name: WP Whois Domain
Plugin URI: http://www.netattingo.com/
Description: This plugin intended to lookup for domain registrant data.
Author: NetAttingo Technologies
Version: 1.0.0
Author URI: http://www.netattingo.com/
*/
define('WP_DEBUG',true);
define('WPWD_DIR', plugin_dir_path(__FILE__));
define('WPWD_URL', plugin_dir_url(__FILE__));
define('WPWD_PAGE_DIR', plugin_dir_path(__FILE__).'pages/');
define('WPWD_INCLUDE_URL', plugin_dir_url(__FILE__).'includes/');

// plugin activation hook called	
function wpwd_install() {
   	global $wpdb;
}
register_activation_hook(__FILE__, 'wpwd_install');

// plugin deactivation hook called	
function wpwd_uninstall() {	
	global $wpdb;
}
register_deactivation_hook(__FILE__, 'wpwd_uninstall');

//Include menu and assign page
function wpwd_plugin_menu() {
    $icon = WPWD_URL. 'includes/icon.png';
	add_menu_page("Whois Domain", "Whois Domain", "administrator", "wpwd-whois-domain-setting", "wpwd_plugin_pages", $icon ,30);
	add_submenu_page("wpwd-whois-domain-setting", "About Us", "About Us", "administrator", "wpwd-about-us", "wpwd_plugin_pages");
}
add_action("admin_menu", "wpwd_plugin_menu");

function wpwd_plugin_pages() {
	
   $wpwd_pageitem = WPWD_PAGE_DIR.$_GET["page"].'.php';
   include($wpwd_pageitem);
}

//Include front css 
function wpwd_js_css_add_init() {
    wp_enqueue_style("whois_front_css", plugins_url('includes/wpwd-front-style.css',__FILE__ )); 
	wp_enqueue_script('whois_front_css');
}
add_action( 'wp_enqueue_scripts', 'wpwd_js_css_add_init' );

//add admin color picker js
function wpwd_admin_css_js() {
  wp_register_style('whois_admin_css', plugins_url('includes/wpwd-admin-style.css',__FILE__ ));
  wp_enqueue_style('whois_admin_css');
}
add_action( 'admin_init','wpwd_admin_css_js' );

add_action( 'admin_enqueue_scripts', 'wp_enqueue_color_picker' );
function wp_enqueue_color_picker( ) {
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'wp-color-picker-script', plugins_url('includes/color-picker.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
}

// Generate shortcode
add_shortcode( 'whois-domain', 'wpwd_shortcode_function' );
function wpwd_shortcode_function( $atts ) {
	include('pages/func-whois.php');
}