<?php
get_header();
global $wp_query;
?>

<div class="page-wrap">
	<div class="container">
		<h1 style="float: left; width: 100%; padding: 20px 0px; text-align: center;"><?php echo __('Your email address has been removed from the newsletter.') . ' </br> ' . $wp_query->query_vars['wow_remove_email']; ?></h1>
	</div>
</div>

<?php get_footer(); ?>