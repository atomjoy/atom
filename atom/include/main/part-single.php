<section class="section section-singlepage">
	<div class="single-post">

		<?php if (have_posts()): while (have_posts()): the_post(); ?>

				<div class="post-content">
					<?php
					get_template_part('include/main/single/post', 'content');
					?>
				</div>

				<div class="post-owner">
					<?php
					get_template_part('include/main/single/post', 'author');
					?>
				</div>

				<div class="post-tags">
					<?php
					get_template_part('include/main/single/post', 'tags');
					?>
				</div>

				<div class="share-socials">
					<?php
					get_template_part('include/main/single/post', 'share');
					?>
				</div>
	</div>

	<div class="atom-post-links">
		<?php
				get_template_part('include/main/single/post', 'links');
		?>
	</div>

	<div class="atom-post-most-popular">
		<?php
				get_template_part('include/main/single/post', 'most-popular');
		?>
	</div>

	<div class="atom-post-comments">
		<?php
				get_template_part('include/main/single/post', 'comments');
		?>
	</div>

<?php endwhile;
		else : endif; ?>
<?php
// Count views
countPostViews();
?>

</section>