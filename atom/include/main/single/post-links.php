<div class="page-links">
	<?php
	// Previous/next post navigation.
	the_post_navigation(array(
		'next_text' => '<span class="post-title-text">' . __('Next Post') . '</span> <span class="post-title">%title</span>',
		'prev_text' => '<span class="post-title-text">' . __('Previous Post') . '</span> <span class="post-title">%title</span>',
	));
	?>
</div>