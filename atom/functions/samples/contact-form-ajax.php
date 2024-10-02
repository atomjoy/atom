<?php

add_action('phpmailer_init', 'mailer_config', 10, 1);
function mailer_config($mailer) {
	// PHPMailer class for $mailer
	$mailer->IsSMTP();
	$mailer->SetFrom(get_option('admin_email'), 'Admin');
	$mailer->addReplyTo('info@example.com', 'Information');
	$mailer->SMTPDebug = 0; // 2 show error, 0 if you don't want to see client/server communication in page
	$mailer->CharSet  = "utf-8";
	// SMTP server
	$mailer->SMTPAuth = true;
	$mailer->SMTPSecure = 'tls';
	$mailer->Port = 587;
	$mailer->Host = "smtp.gmail.com"; // define in wp-config.php
	$mailer->Username = ''; // define in wp-config.php
	$mailer->Password = ''; // define in wp-config.php
}

add_action('wp_mail_failed', 'log_mailer_errors', 10, 1);
function log_mailer_errors($wp_error) {
	$fn = ABSPATH . '/mail.log'; // say you've got a mail.log file in your server root
	$fp = fopen($fn, 'a');
	fputs($fp, "Mailer Error: " . $wp_error->get_error_message() . "\n");
	fclose($fp);
}

// Website form js
function send_contact_form() {
?>
	<script>
		const form = document.getElementById("contact-form");
		const url = admin_url('admin-ajax.php'); // wp-admin/admin-ajax.php
		const data = new FormData(form);
		data.append('nounce', <?php echo wp_create_nonce('contact-form') ?>) // Secure hash
		data.append('action', 'contact-form') // Action name

		try {
			// Send fetch post
			const response = await fetch(url, {
				method: "POST",
				body: data,
				headers: {
					// "Content-Type": "application/json",
					"Content-Type": "multipart/form-data",
					"Accept": "application/json"
				},
			});
			if (response.ok) {
				const json = await response.json();
				console.log(json);
				alert('Message has been sent.')
			} else {
				throw new Error(`Response status: ${response.status}`);
			}
		} catch (error) {
			console.error(error.message, error.responseJSON.data);
			alert('Message has not been sent.')
		}
	</script>
<?php
}

// Server ajax action
add_action('wp_ajax_contact-form', 'submit_contact_form');
add_action('wp_ajax_nopriv_contact-form', 'submit_contact_form');

function submit_contact_form() {
	if (wp_verify_nonce($_POST['nounce'], 'contact-form')) {
		$email = sanitize_email($_POST['email']);
		$admin_email = get_option('admin_email');
		$headers = [
			'Content-Type: text/html; charset=UTF-8',
			'From: Contact form message <' . $admin_email . '>',
			'Reply-To: ' . $email, // Client or admin email
		];
		$subject = 'Question from client';
		$firstname = sanitize_text_field($_POST['firstname']) ?? 'No first name';
		$lastname = sanitize_text_field($_POST['lastname']) ?? 'No last name';
		$mobile = sanitize_text_field($_POST['mobile']) ?? 'No mobile.';
		$msg = sanitize_text_field($_POST['message']) ?? 'Empty message.';
		// Html body
		$body = '
		<h1>Contact form</h1>
		<h2>' . $subject . '</h2>
		<h3>NAME: ' . $firstname . ' ' . $lastname . '</h3>
		<p>Send message: <a href="mailto:"' . $email . '">' . $email . '</a></p>
		<h3>MOBILE:</h3>
		<p>Call: <a href="tel:"' . $mobile . '">' . $mobile . '</a></p>
		<h4>MESSAGE:</h4>
		<p>' . $msg . '</p>
		';

		// Get html template
		// ob_start();
		// include get_template_directory() . '/templates/emails/confirm-html.php';
		// $body = ob_get_clean();

		// Send email
		wp_mail($admin_email, $subject, $body, $headers);

		// Response
		wp_send_json_success('Ok');
	} else {
		// Response
		wp_send_json_error('Error', 401);
	}
}

// Catch error
add_action('wp_mail_failed', function ($error) {
	wp_send_json_error('Send mail error.', 401);
	// wp_die("<pre>".print_r($error, true)."</pre>");
});

// Html email
add_filter('wp_mail_content_type', 'set_my_mail_content_type');
function set_my_mail_content_type() {
	return "text/html";
}
