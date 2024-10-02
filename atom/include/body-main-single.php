<main>
	<?php
	global $show_single_sidebar;

	if ($show_single_sidebar != true) {
		// Center layout
		get_template_part('include/page/layout', 'center-single');
	} else {
		// Rightbar layout
		get_template_part('include/page/layout', 'rightbar-single');
	}
	?>
</main>