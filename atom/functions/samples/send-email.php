<?php

// Send email
function subscribeUser($email) {
	$code = uniqid();
	$subject = 'Subscription confirmation.';
	$headers = [
		'Content-Type: text/html; charset=UTF-8',
		// Custom sender, recipient or get from PHPmailer settimgs
		// 'Reply-To: ' . get_option('admin_email'),
		// 'From: Newsletter <' . get_option('admin_email') . '>' ,
	];

	// Html body
	$body = 'Confirm your email address! <a href="' . site_url('/') . 'confirm/email/' . $code . '">Confirm Email</a>';

	// Or html template
	ob_start();
	// include 'templates/emails/confirm-html.php';
	// include get_template_directory() . '/templates/emails/confirm-html.php' ;
	$body = ob_get_clean();

	// Send email
	wp_mail($email, $subject, $body, $headers);
}
