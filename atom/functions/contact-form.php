<?php

// Catch mail error
add_action('wp_mail_failed', function ($error) {
    wp_send_json_error('Send mail error.', 404);
});

// Force html email
add_filter('wp_mail_content_type', function () {
    return "text/html";
});

// Server ajax action
add_action('wp_ajax_nopriv_contactform', 'submit_contact_form');
add_action('wp_ajax_contactform', 'submit_contact_form');

function submit_contact_form() {
    if (wp_verify_nonce($_POST['nounce'], 'contactform') == false) {
        wp_send_json_error('Invalid secret code.', 404);
        die();
    }

    $email = sanitize_email($_POST['email']);
    $admin_email = get_option('admin_email');
    $headers = [
        'Content-Type: text/html; charset=UTF-8',
        'From: Contact form message <' . $admin_email . '>',
        'Reply-To: ' . $email, // Client or admin email
    ];
    $subject = sanitize_text_field($_POST['subject']) ?? 'Question from client';
    $firstname = sanitize_text_field($_POST['firstname']) ?? 'No first name';
    $lastname = sanitize_text_field($_POST['lastname']) ?? 'No last name';
    $mobile = sanitize_text_field($_POST['mobile']) ?? 'No mobile.';
    $message = sanitize_text_field($_POST['message']) ?? 'Empty message.';
    // Html body
    $body = '
    <h1>CONTACT FORM SUBJECT</h1>
    <h2>' . $subject . '</h2>
    <h3>NAME:</h3><p style="color: #f23; font-size: 20px;">' . $firstname . ' ' . $lastname . '</p>
    <h3>EMAIL:</h3><p><a href="mailto:"' . $email . '">' . $email . '</a></p>
    <h3>PHONE:</h3><p><a href="tel:"' . $mobile . '">' . $mobile . '</a></p>
    <h3>MESSAGE:</h3><p>' . $message . '</p>
    ';

    // Get html template
    // ob_start();
    // include get_template_directory() . '/templates/emails/confirm-html.php';
    // $body = ob_get_clean();

    if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
        wp_send_json_error('Invalid email address.', 404);
    }

    if (empty($email) || empty($firstname) || empty($lastname) || empty($mobile) || empty($message)) {
        wp_send_json_error('The form cannot be empty.', 404);
    }

    wp_mail($admin_email, $subject, $body, $headers);
    wp_send_json_success('Message has been sent.');
}

// Contact form
function get_contact_form() {
?>
    <form method="POST" onsubmit="sendContactFormMessage(event, this)" id="ajax-contact-form" enctype="multipart/form-data">
        <div class="title"><?php echo __('Contact'); ?></div>
        <div class="form-rows">
            <div class="row">
                <label><?php echo __('E-mail'); ?></label>
                <input type="text" name="email">
            </div>
            <div class="row">
                <label><?php echo __('Phone'); ?></label>
                <input type="text" name="mobile">
            </div>
        </div>
        <div class="form-rows">
            <div class="row">
                <label><?php echo __('Firstname'); ?></label>
                <input type="text" name="firstname">
            </div>
            <div class="row">
                <label><?php echo __('Lastname'); ?></label>
                <input type="text" name="lastname">
            </div>
        </div>
        <label><?php echo __('Subject'); ?></label>
        <input type="text" name="subject">
        <label><?php echo __('Message'); ?></label>
        <textarea name="message"></textarea>
        <button><?php echo __('Send Message'); ?></button>
    </form>

    <script>
        async function sendContactFormMessage(event, form) {
            event.preventDefault();
            // const form = document.getElementById('ajax-contact-form');
            const data = new FormData(form);
            const url = '<?php echo admin_url('admin-ajax.php'); ?>' // wp-admin/admin-ajax.php
            data.append('nounce', '<?php echo wp_create_nonce('contactform') ?>') // Secure hash
            data.append('action', 'contactform') // Action name

            try {
                // Send fetch post
                const response = await fetch(url, {
                    method: "POST",
                    body: data,
                    // For x-www-form-urlencoded
                    // body: new URLSearchParams(data),
                    // headers: {
                    //     "Content-Type": "application/json",
                    //     "Content-Type": "application/x-www-form-urlencoded",
                    // },
                });

                if (response.ok) {
                    const json = await response.json();
                    console.log("Json", json);
                    alert('Message has been sent.')
                } else {
                    const json = await response.json();
                    alert(json.data);
                }
            } catch (error) {
                console.log(error);
            }
            return false;
        }
    </script>
<?php
}
