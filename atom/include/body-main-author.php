<main>
	<?php
	global $show_author_sidebar;

	if ($show_author_sidebar != true) {
		// Center layout
		get_template_part('include/page/layout', 'center-author');
	} else {
		// Rightbar layout
		get_template_part('include/page/layout', 'rightbar-author');
	}
	?>
</main>