<main>
	<?php
	global $show_front_sidebar;

	if ($show_front_sidebar != true) {
		// Center layout
		get_template_part('include/page/layout', 'center-front');
	} else {
		// Rightbar layout
		get_template_part('include/page/layout', 'rightbar-front');
	}
	?>
</main>