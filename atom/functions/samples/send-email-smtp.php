<?php

// Ustawienia SMTP email: wp-config.php
define('SMTP_username', 'twojadres@email');   // wpisz swój adres e-mail dla WordPress
define('SMTP_password', 'twoje-haslo');       // tu podaje swoje hasło
define('SMTP_server', 'smtp.gmail.com');      // tu podaj swój host serwera poczty
define('SMTP_FROM', 'from@email');            // wpisz swój adres e-mail dla WordPress
define('SMTP_NAME', 'Biuro');                 // tu podaj np. swoje imie
define('SMTP_PORT', '587');                   // tu podaj numer portu np. 465 dla SSL lun 587 dla tls
define('SMTP_SECURE', 'tls');                 // Szyfrowanie SSL lub TLS
define('SMTP_AUTH', true);                    // Uwierzytelnienie (true|false)
define('SMTP_DEBUG', 0);                       // dla debugowania błędów 0/1/2

// Php mailer settings: functions.php
function my_phpmailer_smtp($phpmailer) {
    $phpmailer->isSMTP();
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
add_action('phpmailer_init', 'my_phpmailer_smtp');


// Send email: function.php
function subscribeUser($to) {
    $subject = 'Subscription confirmation.';
    $headers = [
        'Content-Type: text/html; charset=UTF-8',
        // Reply to admin or client
        // 'Reply-To: ' . get_option('admin_email'),
        // Custom sender or get from PHPmailer settimgs
        // 'From: Newsletter <' . get_option('admin_email') . '>',
    ];
    // Html body
    $body = 'Confirm your email address! <a href="' . site_url('/') . 'confirm/email/' . $to . '">Confirm Email</a>';

    // Or html template
    // ob_start();
    // include get_template_directory() . '/templates/emails/confirm-html.php';
    // $body = ob_get_clean();

    // Send email
    wp_mail($to, $subject, $body, $headers);
}

// Catch wp_mail errors
add_action('wp_mail_failed', function ($error) {
    wp_send_json_error('Send mail error.', 401);
    // wp_die("<pre>".print_r($error, true)."</pre>");
});

// Force html email wp_mail
add_filter('wp_mail_content_type', function () {
    return "text/html";
});
