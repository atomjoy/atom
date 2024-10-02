<?php

// Create database table
function wow_create_subscribers_table() {
	global $wpdb;
	$table_name = $wpdb->prefix . 'wow_subscribers';
	$sql = "CREATE TABLE $table_name (
        id int(11) NOT NULL AUTO_INCREMENT,
        email varchar(100) NOT NULL UNIQUE,
        code varchar(50) NOT NULL UNIQUE,
        active int(11) NOT NULL,
        PRIMARY KEY (id)
    ) ENGINE=InnoDB DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;";

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);
}
add_action('init', 'wow_create_subscribers_table');
add_action('after_setup_theme', 'wow_create_subscribers_table');

// Subscribe user
function wow_subscribe_user(WP_REST_Request $request) {
	$email = $request->get_param('email');
	$nounce = $request->get_param('nounce');
	if (wp_verify_nonce($nounce, 'subscribe')) {
		// Unique id
		$code = uniqid();
		// Add to db
		$ok = wow_add_subscriber($email, $code);
		if ($ok) {
			// Return json
			return [
				'message' => 'Success',
				'email' => $email,
			];
		}
	}
	// Return json
	return [
		'message' => 'Error',
		'email' => $email,
	];
}

// Add to db
function wow_add_subscriber($email, $code) {
	global $wpdb;
	$table_name = $wpdb->prefix . 'wow_subscribers';
	$email = sanitize_email($email);
	$code = sanitize_text_field($code);
	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
		try {
			// Delete if email exists
			if (wow_exist_subscriber($email)) {
				wow_remove_subscriber($email);
			}
			// Disable duplicate warnings
			// mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
			$ok = $wpdb->insert($table_name, ['email' => $email, 'code' => $code, 'active' => 0], ['%s', '%s', '%d']);
			if ($ok) {
				wow_send_confirmation_email($email, $code);
				return true;
			}
		} catch (\Throwable $e) {
			return true;
		}
		return false;
	}
}

// Remove from db
function wow_remove_subscriber($email) {
	global $wpdb;
	$table_name = $wpdb->prefix . 'wow_subscribers';
	if (!empty($email)) {
		try {
			$ok = $wpdb->query($wpdb->prepare("DELETE FROM $table_name WHERE email = %s", [$email]));
			if ($ok) {
				return true;
			}
		} catch (\Throwable $e) {
			return true;
		}
	}
	return false;
}

// Is subscriber exists
function wow_exist_subscriber($email) {
	global $wpdb;
	$table_name = $wpdb->prefix . 'wow_subscribers';
	$row = $wpdb->get_row($wpdb->prepare("SELECT id FROM {$table_name} WHERE email=%s", $email));
	if ($row?->id) {
		return true;
	}
	return false;
}

// Activate
function wow_update_subscriber($code) {
	global $wpdb;
	$table_name = $wpdb->prefix . 'wow_subscribers';
	$code = sanitize_text_field($code);
	if (!empty($code)) {
		try {
			// Is activated
			$row = $wpdb->get_row($wpdb->prepare("SELECT active FROM {$table_name} WHERE code=%s", $code));
			if ($row?->active) {
				return true;
			}
			// Activate
			$ok = $wpdb->query($wpdb->prepare("UPDATE $table_name SET active = 1 WHERE code = %s", [$code]));
			if ($ok) {
				return true;
			}
		} catch (\Throwable $e) {
			return true;
		}
	}
	return false;
}

// Send email
function wow_send_confirmation_email($email, $code) {
	$subject = 'Confirm your email address.';
	$headers = [
		'Content-Type: text/html; charset=UTF-8',
		// 'From: Newsletter <' . get_option('admin_email') . '>',
		// 'Reply-To: ' . get_option('admin_email'), // Client or admin email
	];
	// Html body
	$body = '
    <h1>Welcome!</h1>
    <h3>Confirm your email address.</h3>
    </br>
    <a href="' . site_url('/') . 'confirm/email/' . $code . '">Subscribe</a>
    </br></br>
    <a href="' . site_url('/') . 'unsubscribe/email/' . $email . '">Unsubscribe</a>
    ';
	// Get html template
	// ob_start();
	// include get_template_directory() . '/templates/emails/confirm-html.php';
	// $body = ob_get_clean();
	// Send email
	wp_mail($email, $subject, $body, $headers);
}

// [GET] Subscribe rest api route
add_action('rest_api_init', function () {
	// example.org/wp-json/wow/v1/subscribe?email=email@example.com&nounce=hash12345
	register_rest_route('wow/v1', '/subscribe', array(
		'methods' => 'GET',
		'callback' => 'wow_subscribe_user',
		'permission_callback' => '__return_true',
	));
});

// [GET] Unsubscribe rest api route
add_action('rest_api_init', function () {
	// example.org/wp-json/wow/v1/unsubscribe?email=email@example.com
	register_rest_route('wow/v1', '/unsubscribe', array(
		'methods' => 'GET',
		'callback' => 'wow_unsubscribe_user',
		'permission_callback' => '__return_true',
	));
});

// [GET] Create confirm route rewrite
add_action('init', function () {
	// Flush permalinks from php or go to WP Admin > Settings > Permalinks > Save.
	add_rewrite_rule('confirm/email/([a-z0-9]+)[/]?$', 'index.php?wow_email=$matches[1]', 'top');
	add_rewrite_rule('unsubscribe/email/([a-z0-9-@.]+)[/]?$', 'index.php?wow_remove_email=$matches[1]', 'top');
	flush_rewrite_rules();
});

// Whitelist the query param in get_query_var('wow_email')
add_filter('query_vars', function ($query_vars) {
	$query_vars[] = 'wow_email';
	$query_vars[] = 'wow_remove_email';
	return $query_vars;
});

// Show templates
add_filter('template_include', function ($template) {
	if (!empty(get_query_var('wow_email'))) {
		// Get code
		$code = get_query_var('wow_email');
		// Update table with code
		if (wow_update_subscriber($code)) {
			// Success
			return get_template_directory() . '/templates/emails/email-confirm-success.php';
		}
		// Error
		return get_template_directory() . '/templates/emails/email-confirm-error.php';
	}
	if (!empty(get_query_var('wow_remove_email'))) {
		// Get code
		$email = get_query_var('wow_remove_email');
		// Update table with code
		if (wow_remove_subscriber($email)) {
			// Success
			return get_template_directory() . '/templates/emails/email-unsubscribe-success.php';
		}
		// Error
		return get_template_directory() . '/templates/emails/email-unsubscribe-error.php';
	}
	return $template;
});
