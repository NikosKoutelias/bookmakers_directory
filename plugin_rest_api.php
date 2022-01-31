<?php

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
    return $bookmakers;
}


$url = site_url() . '/wp-json/customroutes/bookmakersdata';
$response = wp_remote_get($url);
$data = json_decode(wp_remote_retrieve_body($response));

?>
