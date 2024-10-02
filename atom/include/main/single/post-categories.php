<div class="post-categories">
	<?php
	$categories = get_the_category();
	if ($categories):
		foreach ($categories as $i) {
	?>
			<a href="<?php echo get_category_link($i?->term_id); ?>" class="btn btn-outline-primary btn-sm" role="button" aria-pressed="false">
				<?php echo $i?->name; ?>
			</a>
	<?php
		}
	endif;
	?>
</div>