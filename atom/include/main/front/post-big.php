<?php

// Views
$views = 0;

// Categories
$categories = get_the_category();
foreach ($categories as $cat) {
	if (strtolower($cat->name) != 'blog') {
		$category = $cat;
	}
}

// Details
$id = get_the_author_meta('ID');
$avatar = get_avatar_url($id, 256);
$fname = get_the_author_meta('first_name');
$lname = get_the_author_meta('last_name');
$alias = get_the_author_meta('nickname');
$author_url = '/author/' . $alias;
$author_url = esc_url(get_author_posts_url(get_the_author_meta('ID')));
$time = get_the_date('Y-m-d h:i:s');

// Views
$views = 0;
if (function_exists('showPostViews')) {
	$views = showPostViews();
}
?>
<div class="main-post">

	<div class="main-post-image">
		<?php if (has_post_thumbnail()): ?>
			<img class="image" src="<?php the_post_thumbnail_url('post-thumbnail-large'); ?>" alt="<?php the_title(); ?>">
		<?php else: ?>
			<img class="image" src="<?php echo get_template_directory_uri() . '/images/posts/default-full.webp'; ?>" alt="<?php the_title(); ?>">
		<?php endif; ?>
	</div>

	<div class="main-post-content">
		<div class="main-post-category"><a href="<?php echo get_category_link($category->term_id); ?>"><?php echo $category->name ?? 'Blog'; ?></a></div>
		<a href="<?php the_permalink(); ?>">
			<h2 class="main-post-title"><?php the_title(); ?></h2>
		</a>

		<div class="main-post-excerpt"><?php the_excerpt(); ?></div>

		<div class="main-post-author">
			<a href="<?php echo $author_url; ?>"><img class="image" src="<?php echo $avatar; ?>" alt="<?php echo $alias; ?>"></a>

			<div class="details">
				<div class="name"><?php echo $fname . ' ' . $lname; ?></div>
				<div class="date"><?php echo $time; ?></div>
			</div>
		</div>
	</div>

</div>