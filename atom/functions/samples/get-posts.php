<?php

// Custom posts
$args = [
    'post_type'  => 'product',
    'meta_query' => [[
        'key'   => 'featured',
        'value' => 'yes',
    ]]
];

$args = array(
    'post_type' => 'album',
    'post_status' => 'publish',
    'tax_query' => [[
        'taxonomy' => 'genre',
        'field'    => 'slug',
        'terms'    => array('jazz', 'improv')
    ]]
);

// Default posts
$post = get_posts([
    'category' => 0,
    'numberposts' => 5,
    'post_type' => 'post',
    'orderby' => 'date',
    'order' => 'DESC',
    'post_status' => 'publish',
    // 's' => 'Lorem',
    // 'offset' => 1,
    // 'posts_per_page' => 3,
    // 'post_parent' => null,
    // 'post_parent' => $post->ID
    // 'post_type' => get_post_types(),
    // 'post_type' => ['page','post'],
]);


foreach ($posts as $post) {
    setup_postdata($post);

    // Post content
    get_the_title();
    get_the_permalink();
    the_attachment_link($post->ID, false);
    the_excerpt();
}
wp_reset_postdata();
