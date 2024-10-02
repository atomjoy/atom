<?php

/**
 * Grab latest post title by an author!
 */
function user_posts($data) {
    $posts = get_posts(['author' => $data['id']]);
    if (empty($posts)) {
        return null;
    }
    return $posts[0]->post_title;
    // return json_encode($posts);
}

// 'http://example.com/wp-json/myplugin/v1/author/([a-z.@-]+)'
// 'http://example.com/wp-json/myplugin/v1/author/(?P<id>[a-z0-9\@\.\-]+)'
add_action('rest_api_init', function () {
    register_rest_route( 'wow/v1', '/author/(?P<name>[a-z0-9\@\.\-]+)', array(
        'methods' => 'GET',
        'callback' => 'user_posts',
        'permission_callback' => '__return_true',
    ));
});


/**
 * Subscribers table
 */
function wp_setup_subscribers_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'subscribers';    
    $sql = "CREATE TABLE $table_name (
      id bigint(21) NOT NULL AUTO_INCREMENT,      
      email varchar (190) NOT NULL,
      PRIMARY KEY  (id)
    )";
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}
add_action('init', 'wp_setup_subscribers_table');
add_action('after_setup_theme', 'wp_setup_subscribers_table');
register_activation_hook(__FILE__, 'wp_setup_subscribers_table');

// Subscribe user
function subscribe_user(WP_REST_Request $request) {    
    $email = $request->get_param('email');
    return [
        'email' => $email,
        'message' => 'Subscribed',
    ];
    // $params = $request->get_params();
    // $email = $params['email'];    
}

// 'wp.xxx/wp-json/wow/v1/subscribe?email=email@email.com'
add_action('rest_api_init', function () {    
    register_rest_route( 'wow/v1', '/subscribe', array(    
        'methods' => 'GET',
        'callback' => 'subscribe_user',
        'permission_callback' => '__return_true',
    ));    
});

// 'wp.xxx/wp-json/wow/v1/subscribe/email@email.com'
add_action('rest_api_init', function () {    
    register_rest_route('wow/v1', '/subscribe/(?P<email>[a-z0-9\@\.\-]+)', array(
        'methods' => 'GET',
        'callback' => 'subscribe_user',
        'permission_callback' => '__return_true',
    ));
});