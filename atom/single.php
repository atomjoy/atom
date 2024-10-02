<?php // Default single posts
?>

<?php get_header(); ?>

<section class="section section-singlepage">
	<div class="single-post">

		<?php if (have_posts()): while (have_posts()): the_post(); ?>

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

					<h1 class="single-post-title"><?php the_title(); ?></h1>

					<?php the_content(); ?>

					<?php wp_link_pages(); ?>

					<div class="post-owner">
						<?php echo $avatar; ?>
						<div class="details">
							<div class="alias"><?php echo $fname . " " . $lname; ?></div>
							<div class="date"><?php echo $time; ?></div>
						</div>
					</div>

					<div class="post-tags">
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
					</div>


					<div class="share-socials">
						<div class="title"><?php echo __('Social share'); ?></div>
						<?php
						shareSocial(get_permalink());
						?>
					</div>

				</div>

				<div class="page-links">
					<?php
					// Previous/next post navigation.
					the_post_navigation(array(
						'next_text' => '<span class="post-title-text">' . __('Next Post') . '</span> <span class="post-title">%title</span>',
						'prev_text' => '<span class="post-title-text">' . __('Previous Post') . '</span> <span class="post-title">%title</span>',
					));
					?>
				</div>

				<h3 class="post-popular-post-title"><?php echo __('Most Popular Posts'); ?></h3>
				<?php
				// Show posts
				mostPopularPosts();
				?>

				<div class="comments">
					<?php
					if (comments_open() || get_comments_number()) :
						comments_template();
					endif;

					if (!comments_open() || get_comments_number() < 1) :
						echo '<div class="no-comments">' . __('No comments') . "</div>";
					endif;
					?>
				</div>


		<?php endwhile;
		else : endif; ?>

		<?php
		// Count views
		countPostViews();
		?>
	</div>
</section>



<?php get_footer(); ?>