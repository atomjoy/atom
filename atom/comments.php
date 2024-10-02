<div class="comment-form">
	<?php comment_form(); ?>
</div>

<div class="comments">
	<h2><?php echo __('Comments'); ?></h2>
	<?php wp_list_comments(); ?>
</div>