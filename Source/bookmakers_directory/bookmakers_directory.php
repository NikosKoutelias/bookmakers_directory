<?php
/*
Plugin Name: Bookers Templates
Description: Templates For Bookmakers
Version: 1.0
Plugin URI: http://localhost/livestoixima.gr/wp-content/plugins/bookmakers_directory/bookmakers_directory.php
Author: Kout
Author URI: http://localhost/livestoixima.gr/wp-content/plugins/bookmakers_directory/bookmakers_directory.php
*/

add_action('wp_enqueue_scripts', function () {

    wp_register_style( 'custom_CSS', plugins_url('/dist/main.css', __FILE__),array(),false,'all');
});


require_once 'includes/bookmakers_directory_shortcode.php';
require_once 'includes/bookmakers_directory_widget.php';
require_once 'includes/plugin_rest_api.php';



if (!defined('ABSPATH')) exit;


//wp_register_style();
// $style =  get_stylesheet_directory();
// $url = site_url() . '/wp-json/customroutes/bookmakersdata';
// $response = wp_remote_get($url);

// $data = json_decode(wp_remote_retrieve_body($response));
