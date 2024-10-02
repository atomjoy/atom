<?php

/*
Plugin Name: Adminux
Plugin URI: https://github.com/atomjoy/adminux
Description: Wordpress login page theme with custom logo, minimal custom style for Wp login page.
Author: Atomjoy
Version: 1.0
Author URI: https://github.com/atomjoy
*/

if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

// Login page
function adminux_login_css() {    
    echo '<link rel="stylesheet" type="text/css" href="' .plugins_url('login.css  ', __FILE__). '">';
}
add_action('login_head', 'adminux_login_css');
?>