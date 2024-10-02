<main>
	<?php
	global $show_search_sidebar;

	if ($show_search_sidebar != true) {
		// Center layout
		get_template_part('include/page/layout', 'center-search');
	} else {
		// Rightbar layout
		get_template_part('include/page/layout', 'rightbar-search');
	}
	?>
</main>