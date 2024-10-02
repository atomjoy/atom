<main>
	<?php
	global $show_archive_sidebar;

	if ($show_archive_sidebar != true) {
		// Center layout
		get_template_part('include/page/layout', 'center-archive');
	} else {
		// Rightbar layout
		get_template_part('include/page/layout', 'rightbar-archive');
	}
	?>
</main>