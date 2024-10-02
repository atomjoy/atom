<?php
$id = get_the_author_meta('ID');
$avatar = get_avatar($id, 256);
$fname = get_the_author_meta('first_name');
$lname = get_the_author_meta('last_name');
$alias = get_the_author_meta('nickname');
$time = get_the_date('Y-m-d h:i:s');
// $time = get_the_date('l jS F, Y');
?>

<?php if (has_post_thumbnail()): ?>
	<div class="post-thumbnail">
		<img src="<?php the_post_thumbnail_url('post-thumbnail-large'); ?>" alt="<?php the_title(); ?>">
	</div>
<?php else: ?>
	<div class="post-thumbnail post-thumbnail-mini">
		<img src="<?php echo get_template_directory_uri() . '/images/posts/default-full.webp'; ?>" alt="<?php the_title(); ?>">
	</div>
<?php endif; ?>

<div class="single-post-content">

	<div class="post-categories">
		<?php
		get_template_part('include/main/single/post', 'categories');
		?>
	</div>

	<h1 class="single-post-title"><?php the_title(); ?></h1>

	<?php the_content(); ?>

	<?php wp_link_pages(); ?>
</div>