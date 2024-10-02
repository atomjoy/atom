<?php

// 1. Send email with phpmailer
function wp_send_email($email, $subject) {
	require_once(ABSPATH . WPINC . '/PHPMailer/PHPMailer.php');
	require_once(ABSPATH . WPINC . '/PHPMailer/SMTP.php');
	require_once(ABSPATH . WPINC . '/PHPMailer/Exception.php');

	try {
		// Create email message here
		// https://github.com/PHPMailer/PHPMailer?tab=readme-ov-file#a-simple-example

		// Throw errors
		$mail = new \PHPMailer\PHPMailer\PHPMailer(true);
		$mail->SMTPDebug = \PHPMailer\PHPMailer\SMTP::DEBUG_OFF; // 0,1,2

		// Smtp settings
		$mail->isSMTP();
		$mail->CharSet  = "utf-8";
		$mail->Host = SMTP_server;
		$mail->SMTPAuth = SMTP_AUTH;
		$mail->Port = SMTP_PORT;
		$mail->Username = SMTP_username;
		$mail->Password = SMTP_password;
		$mail->SMTPSecure = SMTP_SECURE;
		$mail->From = SMTP_FROM;
		$mail->FromName = SMTP_NAME;

		//Recipients
		$mail->setFrom('from@example.com', 'Mailer');
		$mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
		$mail->addAddress('ellen@example.com');               //Name is optional
		$mail->addReplyTo('info@example.com', 'Information');
		$mail->addCC('cc@example.com');
		$mail->addBCC('bcc@example.com');

		//Attachments
		$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
		$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

		//Content
		$mail->isHTML(true);                                  //Set email format to HTML
		$mail->Subject = 'Here is the subject';
		$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		// Or html template
		// ob_start();
		// include get_template_directory() . '/templates/emails/confirm-html.php';
		// $mail->Body = ob_get_clean();

		// Send email
		$mail->send();

		// Response
		wp_send_json_success('The message has been sent.');
	} catch (\Exception $e) {
		// Response
		wp_send_json_error('Error something went wrong.');
	}
}

// 2. Set smtp settings with global $phpmailer
function update_phpmailer_smtp($phpmailer) {
	// Config global
	$phpmailer->isSMTP();
	$phpmailer->SMTPDebug = 0;
	$phpmailer->CharSet  = "utf-8";
	$phpmailer->Host = SMTP_server;
	$phpmailer->SMTPAuth = SMTP_AUTH;
	$phpmailer->Port = SMTP_PORT;
	$phpmailer->Username = SMTP_username;
	$phpmailer->Password = SMTP_password;
	$phpmailer->SMTPSecure = SMTP_SECURE;
	$phpmailer->From = SMTP_FROM;
	$phpmailer->FromName = SMTP_NAME;
	// $phpmailer->SetFrom(get_option('admin_email'), 'Administrator');
}
add_action('phpmailer_init', 'update_phpmailer_smtp');

// Then send with global $phpmailer
function send_email() {
	global $phpmailer;

	try {
		// Config local
		// $phpmailer->IsSMTP();
		// $phpmailer->Host = 'smtp.google.com';
		// $phpmailer->Port = '587';
		// $phpmailer->SMTPSecure = 'tls';
		// $phpmailer->SMTPAuth = true;
		// $phpmailer->Username = 'something@gmail.com';
		// $phpmailer->Password = 'blablabla';

		// Email Message
		$phpmailer->addAddress('joe@example.com', 'Joe User');
		$phpmailer->setFrom('from@example.com', 'Mailer');
		$phpmailer->addReplyTo('info@example.com', 'Information');
		$phpmailer->isHTML(true);
		$phpmailer->Subject = 'Here is the subject';
		$phpmailer->Body    = 'This is the HTML message body <b>in bold!</b>';
		$phpmailer->AltBody = 'This is the body in plain text for non-HTML mail clients';
		$phpmailer->send();
		// Response
		wp_send_json_success('The message has been sent.');
	} catch (\Exception $e) {
		// Response
		wp_send_json_error('Error something went wrong.');
	}
}
