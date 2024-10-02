<?php

// Enable widgets
add_theme_support('widgets');

// Create sidebar
add_action('widgets_init', function () {
	register_sidebar([
		'name' => 'Page Sidebar',
		'id' => 'page-sidebar',
		// 'before_title' => '<h4 class="widget-title">',
		// 'after_title' => '</h4>',
		// 'before_widget' => '<div id="%1$s" class="page-sidebar-row widget %2$s">',
		// 'after_widget'  => '</div>',
	]);
});

// Display sidebar
function show_page_sidebar() {
	if (is_active_sidebar('page-sidebar')) {
		dynamic_sidebar('page-sidebar');
	}
}
