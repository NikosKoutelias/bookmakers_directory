<?php
/*
Plugin Name: Bookers Bookmakers Directory
Description: Bookmakers Directory For Bookmakers
Version: 1.0
Plugin URI: http://localhost/livestoixima.gr/wp-content/plugins/bookmakers_directory/bookmakers_directory.php
Author: Kout
Author URI: http://localhost/livestoixima.gr/wp-content/plugins/bookmakers_directory/bookmakers_directory.php
*/

add_action('wp_enqueue_scripts', function () {
    wp_register_style( 'custom_CSS', plugins_url('/dist/main.css', __FILE__),array(),false,'all');
});

add_action('admin_enqueue_scripts', function(){
    wp_enqueue_script('bookers_helpers',plugins_url('/dist/bookers_helpers.js', __FILE__),array(),false,false);
});




require_once "includes/helper_functions.php";
require_once 'includes/bookmakers_directory_shortcode.php';
require_once 'includes/bookmakers_directory_widget.php';
require_once 'includes/plugin_rest_api.php';
require_once 'includes/bookmakers_post_type_generator.php';



if (!defined('ABSPATH')) exit;


//wp_register_style();
// $style =  get_stylesheet_directory();
// $url = site_url() . '/wp-json/customroutes/bookmakersdata';
// $response = wp_remote_get($url);

// $data = json_decode(wp_remote_retrieve_body($response));
