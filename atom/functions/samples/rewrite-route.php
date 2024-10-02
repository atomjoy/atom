<?php

// Add new route
add_action('init', function () {
    add_rewrite_tag('%wow_email%', '([a-z0-9-@.]+)'); // Update query_vars
    add_rewrite_rule('confirm/email/([a-z0-9-@.]+)[/]?$', 'index.php?wow_email=$matches[1]&wow_param=confirm', 'top');
    // Flush permalinks rewrites for tests only
    flush_rewrite_rules();
    // Flush permalinks rewrites in theme or go to WP Admin > Settings > Permalinks > Save.
    // add_action('after_switch_theme', flush_rewrite_rules());
    // Flush permalinks rewrites in plugin
    // register_activation_hook(__FILE__, flush_rewrite_rules());
});

// Update query_vars
add_filter('query_vars', function ($query_vars) {
    $query_vars[] = 'wow_email';
    $query_vars[] = 'wow_param';
    return $query_vars;
});

// Update query_vars with add_rewrite_tag()
add_action('init', function () {
    add_rewrite_tag('%wow_email%', '([a-z0-9-@.]+)');
    add_rewrite_tag('%wow_param%', '([a-z0-9-@.]+)');
    add_rewrite_tag('%wow_eventdate%', '([0-9]{4}-[0-9]{2}-[0-9]{2})');
});

// Update GET from query_vars
add_action('parse_query', function () {
    if (false !== get_query_var('wow_param')) {
        $_GET['wow_param'] = get_query_var('wow_param');
    }
});

// Check param and display custom template
add_filter('template_include', function ($template) {
    // Default template if param empty
    if (get_query_var('wow_email') == false || get_query_var('wow_email') == '') {
        return $template;
    }
    // Get data in template or here
    // $email = get_query_var('wow_email');
    return get_template_directory() . '/templates/emails/email-confirm-page.php';
});

// Check param and send response
add_filter('template_redirect', function () {
    global $wp_query;
    $email = $wp_query->get('wow_email');
    if (!empty($email)) {
        wp_send_json(['message' => 'Success'], 200);
    }
});

// Redirect to template
add_action('template_redirect', function () {
    if (is_page('goodies') && ! is_user_logged_in()) {
        wp_redirect(home_url('/signup/'));
        exit();
    }

    if (is_front_page() && is_user_logged_in()) {
        wp_redirect(home_url('/dashboard/'));
        die;
    }
});
