<?php
/*
Plugin Name: Bookers Templates
Description: Templates For Bookmakers
Version: 1.0
Plugin URI: http://localhost/livestoixima.gr/wp-content/plugins/bookmakers_directory/
Author: Kout
Author URI: http://localhost/livestoixima.gr/wp-content/plugins/bookmakers_directory/
*/

include "bookmakers_directory_shortcode.php";
include "bookmakers_directory_widget.php";

if (!defined('ABSPATH')) exit;

//The Following registers an api route with multiple parameters. 
add_action('rest_api_init', 'add_bookmakers_api');
function add_bookmakers_api()
{
    register_rest_route('customroutes', '/bookmakersdata', array(
        'methods' => 'GET',
        'callback' => 'get_bookmakers_data',
    ));
}
function get_bookmakers_data($data)
{
    //get users by market
    $args = [
        'numberposts' => 999,
        'post_type' => 'kss_bookmakers'
    ];
    $bookmakers = get_posts($args);
    foreach ($bookmakers as $bookmaker) {
        unset($bookmaker->post_content);
        $bookmaker->meta = get_post_meta($bookmaker->ID);
    }
    usort($bookmakers, function ($a, $b) {
        return ($b->meta['bk_final_score'][0] <=> $a->meta['bk_final_score'][0]);
    });
    return $bookmakers;
}

