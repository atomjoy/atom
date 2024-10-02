<?php

// Title
// add_theme_support('title-tag');

// Remove
// remove_action('wp_head', '_wp_render_title_tag', 1);

// Overwrite title
add_filter('wp_title', 'change_title', 100);

// Add wp_title() in header.php
function change_title($title) {
	global $post;

	if (is_home()) {
		bloginfo('name');
	} else if (is_category()) {
		single_cat_title();
		echo  ' ' . __('Category') . ' | ';
		bloginfo('name');
	} else if (is_single()) {
		single_post_title();
		echo ' | ';
		bloginfo('name');
	} else if (is_page()) {
		single_post_title();
		echo ' | ';
		bloginfo('name');
	} else if (is_author()) {
		echo get_the_author();
		echo ' | ';
		bloginfo('name');
	} else if (is_tag()) {
		echo '#';
		single_tag_title();
		echo ' | ';
		bloginfo('name');
	} else if (is_day() || is_month() | is_year()) {
		if (is_day()) {
			echo __('Archives') . ' ' . get_the_date();
			echo ' | ';
			bloginfo('name');
		} else if (is_month()) {
			echo __('Archives') . ' ' . get_the_date('F Y');
			echo ' | ';
			bloginfo('name');
		} else if (is_year()) {
			echo __('Archives') . ' ' . get_the_date('Y');
			echo ' | ';
			bloginfo('name');
		} else {
			echo __('Archives');
			echo ' | ';
			bloginfo('name');
		}
	} else {
		bloginfo('name');
	}
}
