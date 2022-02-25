<?php

//The Following registers an api route with multiple parameters. 
add_action('rest_api_init', 'bd_add_bookmakers_api');
function bd_add_bookmakers_api()
{
    register_rest_route('bookmakersdirectory', '/data', array(
        'methods' => WP_REST_SERVER::READABLE,
        'callback' => 'bd_get_bookmakers_data',
    ));
}
function bd_get_bookmakers_data($data)
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
    return $bookmakers;
}
