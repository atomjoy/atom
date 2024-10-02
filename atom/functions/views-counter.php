<?php
/*
 * Set post views count using post meta 
 * Add to: single.php
 */
function countPostViews($key = 'post_views_count') {
    $postID = get_the_ID();
    $count = get_post_meta($postID, $key, true);
    // Update the custom field value.
    if($count == ''){
        $count = 0;
        delete_post_meta($postID, $key);
        add_post_meta($postID, $key, '1');
    }else{
        $count++;
        update_post_meta($postID, $key, $count);
    }
}

/*
 * Get post views count using post meta
 */
function showPostViews($key = 'post_views_count') {
    $count = get_post_meta(get_the_ID(), $key, true);
    // Check if the custom field has a value.
    if (!empty( $count )) {
        return $count;
    }    
    return 0;
}

/*
 * Show most popular post views count using post meta
 */
function mostPopularPosts($per_page = 3, $key = 'post_views_count') {
    $all = query_posts('meta_key=post_views_count&posts_per_page='.$per_page.'&orderby=meta_value_num&order=DESC');
    echo '<div class="most-popular-posts">';
    foreach ($all as $post) {
        // print_r($post); die();
        $author_id = $post->post_author;
        $avatar = get_avatar($author_id, 256);
        // $pid = get_post_thumbnail_id($post);
        // $url = wp_get_attachment_image_src($pid, 'full')[0] ?? '';
        $categories=get_the_category($post->ID); // $post->ID
        $cat_name = $categories[0]->name ?? '';
        $views = get_post_meta($post->ID, $key, true);
        $time = get_the_date('Y-m-d h:i:s', $post);
        $fname = get_the_author_meta('first_name', $author_id); 
        $lname = get_the_author_meta('last_name', $author_id); 
        $alias = get_the_author_meta('nickname', $author_id);
        echo '<div class="most-popular-post">';
            if (has_post_thumbnail($post->ID)) {
                echo get_the_post_thumbnail($post,'post-thumbnail-medium');
            }        
            
            echo '<div class="author">';
                echo $avatar;
                echo '<div class="details">';
                    echo '<div class="alias">'. $fname . " " . $lname .'</div>';                    
                echo '</div>';
            echo '</div>';

            echo '<div class="content">';
                
                echo '<div class="info">';               
                    echo '<span class="category">'.$cat_name.'</span>';
                    echo '<span class="views"><i class="fa-solid fa-eye"></i>'.$views.'</span>';
                echo '</div>';

                echo '<a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a>';
            echo '</div>';

        echo '</div>';
    }
    echo '</div>';
    wp_reset_query();
}