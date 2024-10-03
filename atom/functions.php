<?php

// Show single post sidebar
$show_single_sidebar = true;
$show_single_sidebar = false;

// Functions
require(__DIR__ . '/functions/sidebars.php');
require(__DIR__ . '/functions/views-counter.php');
require(__DIR__ . '/functions/share-social.php');
require(__DIR__ . '/functions/subscribe-email.php');
require(__DIR__ . '/functions/contact-form.php');
require(__DIR__ . '/functions/change-title.php');
// require(__DIR__ . '/functions/cars-custom-post-type.php');
// require(__DIR__ . '/functions/post-page-custom-fields.php');

// Disable auto updates
add_filter('auto_update_plugin', '__return_false');
add_filter('auto_update_theme', '__return_false');

// Css
function load_css() {
	// Load bootstrap css
	// wp_register_style('bootstrap', get_template_directory_uri() . '/css/bootstrap/bootstrap.min.css', [], false, 'all');
	// wp_enqueue_style('bootstrap');

	// Load template css
	wp_register_style('main', get_template_directory_uri() . '/css/main.css', [], false, 'all');
	wp_enqueue_style('main');

	// Load code highlighter
	wp_register_style('code', get_template_directory_uri() . '/css/highlighter.css', [], false, 'all');
	wp_enqueue_style('code');
}

add_action('wp_enqueue_scripts', 'load_css');


// JavaScript
function load_js() {
	// Load only jquery
	wp_enqueue_script('jquery');

	// Main.js
	wp_register_script('main', get_template_directory_uri() . '/js/main.js', [], false);
	wp_enqueue_script('main');

	wp_register_script('code', get_template_directory_uri() . '/js/highlighter.js', [], false);
	wp_enqueue_script('code');

	// Load bootstrap and jquery
	// wp_register_script('bootstrap', get_template_directory_uri() . '/js/bootstrap/bootstrap.min.js', ['jquery'], false);
	// wp_enqueue_script('bootstrap');
}

add_action('wp_enqueue_scripts', 'load_js');

// Add menu
add_theme_support('menus');

// Add menus variants in panel
register_nav_menus([
	'top-menu' => 'Top Menu Location',
	'mobile-menu' => 'Mobile Menu Location',
	'footer-menu' => 'Footer Menu Location',
]);


// Post formats
add_theme_support('post-formats', ['aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat']);

// Enable post thumbnails
add_theme_support('post-thumbnails');

// Update default thumbnails size (post-thumbnail, medium_large)
set_post_thumbnail_size(1280, 720, true);
add_image_size('medium_large', 768, 480, true);

// Add thumbnail custom sizes crop array( 'center', 'center')
add_image_size('post-thumbnail-large', 1280, 720, true);
add_image_size('post-thumbnail-medium', 640, 360, true);
add_image_size('post-thumbnail-small', 360, 208, true);

// Remove thumbnails
function remove_extra_image_sizes() {
	foreach (get_intermediate_image_sizes() as $size) {
		if (!in_array($size, array('medium_large', 'post-thumbnail', 'post-thumbnail-large', 'post-thumbnail-medium', 'post-thumbnail-small'))) {
			remove_image_size($size);
		}
	}

	// Remove default thumbnails
	update_option('thumbnail_size_h', 0);
	update_option('thumbnail_size_w', 0);
	update_option('medium_size_h', 0);
	update_option('medium_size_w', 0);
	update_option('medium_large_size_w', 0);
	update_option('medium_large_size_h', 0);
	update_option('large_size_h', 0);
	update_option('large_size_w', 0);
}
add_action('init', 'remove_extra_image_sizes');

// Search only in posts
function search_filter($query) {
	if ($query->is_search) {
		$query->set('post_type', 'post');
	}
	return $query;
}
add_filter('pre_get_posts', 'search_filter');

// Php mailer settings
function my_phpmailer_smtp($phpmailer) {
	$phpmailer->isSMTP();
	$phpmailer->CharSet = "utf-8";
	$phpmailer->Host = SMTP_server;
	$phpmailer->Username = SMTP_username;
	$phpmailer->Password = SMTP_password;
	$phpmailer->Port = SMTP_PORT;
	$phpmailer->SMTPAuth = SMTP_AUTH;
	$phpmailer->SMTPSecure = SMTP_SECURE;
	$phpmailer->From = SMTP_FROM;
	$phpmailer->FromName = SMTP_NAME;
	// $phpmailer->SetFrom(get_option('admin_email'), 'Administrator');
}
add_action('phpmailer_init', 'my_phpmailer_smtp');

// Send email
function subscribeUser($email) {
	$code = uniqid();
	$subject = 'Subscription confirmation.';
	$headers = [
		'Content-Type: text/html; charset=UTF-8',
		// 'Reply-To: ' . get_option('admin_email'),
		// Custom sender or get from PHPmailer settimgs
		// 'From: Newsletter <' . get_option('admin_email') . '>' ,
	];

	// Html body
	$body = 'Confirm your email address! <a href="' . site_url('/') . 'confirm/email/' . $code . '">Confirm Email</a>';

	// Or html template
	ob_start();
	include 'templates/emails/confirm-html.php';
	// include get_template_directory() . '/templates/emails/confirm-html.php' ;
	$body = ob_get_clean();

	// Send email
	wp_mail($email, $subject, $body, $headers);
}
