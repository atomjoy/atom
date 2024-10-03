<?php

/**
 * Template Name: Custom Contact Form No Title
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
		<?php the_content(); ?>
		<?php get_contact_form(); ?>
	</div>
</div>

<?php
get_template_part('include/body', 'footer');

get_footer();
?>