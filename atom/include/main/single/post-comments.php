<div class="comments">
	<?php
	if (comments_open() || get_comments_number()) :
		comments_template();
	endif;

	if (!comments_open() || get_comments_number() < 1) :
		echo '<div class="no-comments">' . __('No comments') . "</div>";
	endif;
	?>
</div>