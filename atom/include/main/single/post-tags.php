<?php
$tags = get_the_tags();
if ($tags) {
	foreach ($tags as $tag) {
?>
		<a href="<?php echo get_tag_link($tag?->term_id); ?>" class="tag-btn" role="button" aria-pressed="false">
			<?php echo '#' . $tag?->name; ?>
		</a>
<?php }
} ?>