<!-- Author Page -->
<?php
$id = get_query_var('author');

// Author details
$avatar = get_avatar_url($id, 256);
$displayname = get_the_author_meta('display_name', $id);
$first_name = get_the_author_meta('first_name', $id);
$last_name = get_the_author_meta('last_name', $id);
$alias = get_the_author_meta('nicename', $id);
$email = get_the_author_meta('email', $id);
$www = get_the_author_meta('url', $id);
$status = get_the_author_meta('status', $id);
$desc = get_the_author_meta('description', $id);
?>

<div class="author-profil">

	<div class="author-image">
		<img src="<?php echo $avatar; ?>" alt="Author">
	</div>

	<div class="author-details">
		<h1 class="name"><?php echo $first_name . ' ' . $last_name; ?></h1>
		<div class="alias">@<?php echo $alias; ?></div>
		<div class="www"><a href="<?php echo $www; ?>"><?php echo $www; ?></a></div>
		<p class="desc"><?php echo $desc; ?></p>
	</div>
</div>


<?php
// Get page number
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

// Params
$args = array(
	'author'        =>  $id,
	'orderby'       =>  'post_date',
	'order'         =>  'DESC',
	'posts_per_page' => 4,
	'post_status' => 'publish',
	'post_type' => 'post',
	'paged' => $paged, // paginate
	// 'category_name' => 'pc',
);

// Get posts
$posts = new WP_Query($args);

echo '<div class="author-posts"><h2>' . __('Author posts') . '</h2>';

if ($posts->have_posts()) : while ($posts->have_posts()) : $posts->the_post(); ?>

		<div class="author-post">
			<?php if (has_post_thumbnail()): ?>
				<img src="<?php the_post_thumbnail_url('post-thumbnail-medium'); ?>" alt="<?php the_title(); ?>">
			<?php else: ?>
				<img src="<?php echo get_template_directory_uri() . '/images/posts/default-small.webp'; ?>" alt="<?php the_title(); ?>">
			<?php endif; ?>

			<div class="about">
				<a href="<?php the_permalink(); ?>">
					<h3><?php the_title(); ?></h3>
				</a>

				<p><?php the_excerpt(); ?></p>
			</div>
		</div>
	<?php
	endwhile;
	echo '</div>';
	wp_reset_postdata();
	?>

	<div class="pages">
		<span class="prev">
			<?php previous_posts_link(); ?>
		</span>
		<span class="next">
			<?php next_posts_link(); ?>
		</span>
	</div>

	<div class="authors-list">
		<h2><?php echo __('Authors list'); ?></h2>
		<?php wp_list_authors([
			'orderby' => 'nicename',
			'show_fullname' => true
		]);
		?>
	</div>

<?php
endif;
?>


<?php
// User details
// $id = get_query_var('author');
// $data = get_userdata(intval($id));
// echo $data->display_name;
?>

<?php
// Get posts 2
// $posts = get_posts($args);
// foreach($posts as $post) : setup_postdata($post);
//     echo '<div><a href="'.the_permalink().'">'.the_title().'</a></div>';
// endforeach;
// wp_reset_postdata();
?>