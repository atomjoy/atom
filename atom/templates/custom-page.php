<?php

/**
 * Template Name: Custom Page
 * Template Post Type: post, page
 *
 * @package WordPress
 * @subpackage Atom Blog
 * @since Atom Blog 2.0
 */
?>

<?php
get_header();

get_template_part('include/body', 'header');
?>

<div class="page-custom">
	<div class="page-container">
		<h1><?php the_title(); ?></h1>
		<?php the_content(); ?>
	</div>
</div>

<?php
get_template_part('include/body', 'footer');

get_footer();
?>