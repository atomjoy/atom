<!-- Search Page -->
<?php
$search = get_search_query();
?>

<div class="atom-posts">

	<div class="blog-header">
		<img class="image" src="<?php echo get_template_directory_uri() . '/images/blog-title.webp'; ?>" alt="<?php echo __('Blog image'); ?>">

		<h1 class="title"><?php echo __($search ?? 'Search'); ?></h1>

		<form class="blog-search" method="get" action="/">
			<input type="text" name="s" id="blog-search-input" placeholder="<?php echo __('Search'); ?>">
			<button class="blog-search-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
		</form>
	</div>

	<div class="categories">
		<?php wp_list_categories([
			'title_li' => 'div',
			'style' => 'none',
			'separator' => ''
		]); ?>
	</div>

	<div class="post-row">
		<?php
		$count = 0;
		if (have_posts()): while (have_posts()): the_post();
				$count++;

				// Posts
				if ($count == 1) {
					get_template_part('include/main/front/post', 'big');
				} else {
					get_template_part('include/main/front/post', 'small');
				}
			endwhile;
		else : ?>
			<div class="no-posts"><?php echo __('No posts'); ?></div>
		<?php endif; ?>

		<!-- empty post justify dont delete -->
		<div class="post-card post-card-hidden" style="visibility: hidden;"></div>
	</div>

	<div class="pages">
		<span class="prev">
			<?php previous_posts_link(); ?>
		</span>
		<span class="next">
			<?php next_posts_link(); ?>
		</span>
	</div>
</div>