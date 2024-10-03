<?php

/**
 * Template Name: Front Page
 * Template Post Type: post
 *
 * @package WordPress
 * @subpackage Atom Blog
 * @since Atom Blog 2.0
 */

get_header();

get_template_part('include/body', 'header');
?>

<div class="page-front">
	<?php the_content(); ?>
</div>

<?php
get_template_part('include/body', 'footer');

get_footer();
?>