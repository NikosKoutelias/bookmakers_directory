<?php
/*
Plugin Name: Bookers Templates
Description: Templates For Bookmakers
Version: 1.0
Plugin URI: http://localhost/livestoixima.gr/wp-content/plugins/bookmakers_directory/bookmakers_directory.php
Author: Kout
Author URI: http://localhost/livestoixima.gr/wp-content/plugins/bookmakers_directory/bookmakers_directory.php
*/

include "bookmakers_directory_shortcode.php";
include "bookmakers_directory_widget.php";
include "plugin_rest_api.php";

if (!defined('ABSPATH')) exit;

// $style =  get_stylesheet_directory();
// $url = site_url() . '/wp-json/customroutes/bookmakersdata';
// $response = wp_remote_get($url);

// $data = json_decode(wp_remote_retrieve_body($response));
