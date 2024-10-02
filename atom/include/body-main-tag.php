<main>
	<?php
	global $show_tag_sidebar;

	if ($show_tag_sidebar != true) {
		// Center layout
		get_template_part('include/page/layout', 'center-tag');
	} else {
		// Rightbar layout
		get_template_part('include/page/layout', 'rightbar-tag');
	}
	?>
</main>