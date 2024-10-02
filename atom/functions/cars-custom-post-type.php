<?php

// Cars post type brands taxonomy https://example.org/cars/brands/brand-name/
add_action('init', function () {
	register_taxonomy(
		'cars-brands',
		['cars'],
		[
			'labels' => [
				'name' => 'Brands',
				'singular_name' => 'Brand'
			],
			'hierarchical' => true, // Category or Tags
			'has_archive' => true,
			'public' => true,
			'query_var' => 'cars_brands', // Sets the query_var key for this post type taxonomy.
			'rewrite' => ['slug' => 'cars/brands'], // Single cars brands url
		]
	);
}, 100); // Always before custom post type (rewrite brands error)

// Cars post type https://example.org/cars
add_action('init', function () {
	register_post_type('cars', [
		'labels' => [
			'name' => __('Cars'),
			'singular_name' => __('Car'),
			// 'add_new' => __('Add New'),
			// 'add_new_item' => __('Add New'),
		],
		'description' => 'Cars custom post type.',
		'hierarchical' => true, // Pages or posts
		'has_archive' => true,
		'public' => true,
		'query_var' => true,
		'rewrite' => ['slug' => 'cars'],
		'supports' => ['title', 'editor', 'thumbnail', 'excerpt',  'custom-fields',], // 'title', 'editor', 'thumbnail', 'author', 'excerpt', 'comments', 'custom-fields',
		'menu_icon' => 'dashicon-images-alt2',
	]);
}, 200); // Always after brands taxonomy

function show_brands() {
	// 1. Get brands taxonomy
	$terms = get_terms([
		'taxonomy' => 'cars-brands',
		'hide_empty' => false,
	]);

	echo '<pre><p>1. Get brands taxonomy</p>';
	print_r($terms);
	echo '</pre>';

	// 2. Cars posts search
	$cars = get_posts([
		// All posts
		'posts_per_page'   => 3,
		'post_type' => 'cars',
		// Or only with taxonomy query_var key
		'cars_brands' => 'dodge',
	]);

	echo '<pre><p>2. Cars posts search</p>';
	print_r($cars);
	echo '</pre>';

	// 3. Cars posts with brand
	$args = array(
		'posts_per_page'   => 3,
		'post_type' => 'cars',
		'tax_query' => array(
			array(
				'taxonomy' => 'cars-brands', // All brands as category
				'terms' => ['bmw', 'dodge'], // Single car brand
				'field' => 'slug',
			)
		)
	);

	$query = new WP_Query($args);

	$posts = $query->posts;

	echo '<pre><p>3. Cars posts with brand</p>';
	print_r($posts);
	echo '</pre>';

	if ($query->have_posts()) {
		while ($query->have_posts()) {
			$query->the_post();
			// Post details
			the_title();
			// Cars post custom fields
			print_r(get_post_meta(get_the_ID(), 'color', true));
		}
	}

	wp_reset_query();
}
