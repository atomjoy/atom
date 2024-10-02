<?php

// Create subscribers table
function wp_setup_subscribers_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'subscribers';
    
    $sql = "CREATE TABLE $table_name (
        id int(11) NOT NULL AUTO_INCREMENT,
        email varchar(100) NOT NULL UNIQUE,
        code varchar(50) NOT NULL UNIQUE,
        active int(11) NOT NULL,
        PRIMARY KEY (id)         
    ) ENGINE=InnoDB DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;"; // New use: utf8mb4_0900_ai_ci

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}

// In function
add_action('init', 'wp_setup_subscribers_table');

// In theme
add_action('after_switch_theme', 'wp_setup_subscribers_table');

// In plugin
register_activation_hook(__FILE__, 'wp_setup_subscribers_table');


// Select
function wp_learn_rest_get_form_submission($request) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'form_submissions';        
    
    $email = $request['email'];
    $results = $wpdb->get_results("SELECT * FROM $table_name WHERE email=" . sanitize_email($email) );
    
    return $results[0];

    // $res = $wpdb->get_results($wpdb->prepare("SELECT COUNT(id) as total FROM {$table_name} WHERE email=%s", $email));
    // $row = $wpdb->get_row($wpdb->prepare("SELECT id FROM $table_name WHERE email=%s", $email));
    // $ok = $wpdb->query($wpdb->prepare("UPDATE $table_name SET active = 1 WHERE code = %s", [$code]));
    // $ok = $wpdb->query($wpdb->prepare("DELETE FROM $table_name WHERE email = %s", [$email]));
    // $ok = $wpdb->insert($table_name, ['email' => $email, 'code' => $code, 'active' => 0], ['%s','%s','%d']);
}