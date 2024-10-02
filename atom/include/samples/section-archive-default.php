<?php
/*
Template Name: Archive Default
*/
?>

<section class="section section-frontpage">
	<h1>
		<?php
		if (is_category()) {
			single_cat_title();
		} elseif (is_tag()) {
			single_tag_title();
		} elseif (is_author()) {
			the_post();
			echo "Author Archives: " . get_the_author();
			rewind_posts();
		} elseif (is_day()) {
			echo 'Daily Archives: ' . get_the_date();
		} elseif (is_month()) {
			echo 'Monthly Archives: ' . get_the_date('F Y');
		} elseif (is_year()) {
			echo 'Yearly Archives: ' . get_the_date('Y');
		} else {
			echo 'Archives';
		}
		?>
	</h1>

	<?php if (have_posts()):
		while (have_posts()): the_post();
			// echo get_template_part('include/posts/content', get_post_type());
			the_permalink();
			the_title();
		endwhile;

		echo paginate_links();
	else:
		echo '<p>No content found</p>';
	endif;
	?>
</section>