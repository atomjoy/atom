<?php

/**
 * Template Name: Blog Page
 * Template Post Type: post
 *
 * @package WordPress
 * @subpackage Atom Blog
 * @since Atom Blog 2.0
 */

$wp_query = new WP_Query([
	'post_type' => 'post',
	'paged' => get_query_var('paged'),
]);

get_header();

get_template_part('include/body', 'header');

get_template_part('include/body', 'main-front');

get_template_part('include/body', 'footer');

get_footer();
