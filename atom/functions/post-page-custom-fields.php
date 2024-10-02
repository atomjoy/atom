<?php

global $meta_boxes;
$prefix = 'test';

function add_post_meta_box() {
	global $meta_boxes;
	$post_type = ['post', 'page'];

	if (is_admin()) {
		add_meta_box(
			'some_meta_box_name',
			__('SEO'),
			'render_meta_box_content',
			$post_type,
			'advanced',
			'high'
		);
	}
}

function render_meta_box_content($post) {
	wp_nonce_field('myplugin_inner_custom_box', 'myplugin_inner_custom_box_nonce');
	$value1 = get_post_meta($post->ID, '_my_meta_value_key_1', true);
	$value2 = get_post_meta($post->ID, '_my_meta_value_key_2', true);
?>
	<div class="row">
		<label for="myplugin_new_field"><?php __('Page Title'); ?></label>
		<input type="text" id="myplugin_new_field_1" name="myplugin_new_field_1" value="<?php echo esc_attr($value1); ?>" />
	</div>

	<div class="row">
		<label for="myplugin_new_field"><?php __('Page Description'); ?></label>
		<input type="text" id="myplugin_new_field_2" name="myplugin_new_field_2" value="<?php echo esc_attr($value2); ?>" />
	</div>
<?php
}

function add_post_meta_box_save($post_id) {
	if (! isset($_POST['myplugin_inner_custom_box_nonce'])) {
		return $post_id;
	}

	$nonce = $_POST['myplugin_inner_custom_box_nonce'];
	if (! wp_verify_nonce($nonce, 'myplugin_inner_custom_box')) {
		return $post_id;
	}

	/*
    * If this is an autosave, our form has not been submitted,
    * so we don't want to do anything.
    */
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}

	if ('page' == $_POST['post_type']) {
		if (! current_user_can('edit_page', $post_id)) {
			return $post_id;
		}
	} else {
		if (! current_user_can('edit_post', $post_id)) {
			return $post_id;
		}
	}

	$mydata = sanitize_text_field($_POST['myplugin_new_field_1']);
	update_post_meta($post_id, '_my_meta_value_key_1', $mydata);

	$mydata = sanitize_text_field($_POST['myplugin_new_field_2']);
	update_post_meta($post_id, '_my_meta_value_key_2', $mydata);
}

add_action('add_meta_boxes', 'add_post_meta_box');
add_action('save_post', 'add_post_meta_box_save');
