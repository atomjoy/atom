<?php

function add_custom_meta_tags() {
    echo '<meta name="keywords" content="Your Keywords Here" />';
    echo '<meta name="description" content="Your Description Here" />';
}

add_action('wp_head', 'add_custom_meta_tags');


function hueman_add_meta_tags() {
    global $post;

    if ( is_singular() ) {
        $des_post = strip_tags($post->post_content);
        $des_post = strip_shortcodes($post->post_content);
        $des_post = str_replace(["\n", "\r", "\t"], ' ', $des_post);
        $des_post = mb_substr($des_post, 0, 300, 'utf8');
        echo '<meta name="description" content="' . $des_post . '" />' . "\n";
    }

    if ( is_home() ) {
        echo '<meta name="description" content="' . get_bloginfo( "description" ) . '" />' . "\n";
    }

    if ( is_category() ) {
        $des_cat = strip_tags(category_description());
        echo '<meta name="description" content="' . $des_cat . '" />' . "\n";
    }
}

add_action( 'wp_head', 'hueman_add_meta_tags');