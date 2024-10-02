<main>
	<?php
	global $show_category_sidebar;

	if ($show_category_sidebar != true) {
		// Center layout
		get_template_part('include/page/layout', 'center-category');
	} else {
		// Rightbar layout
		get_template_part('include/page/layout', 'rightbar-category');
	}
	?>
</main>