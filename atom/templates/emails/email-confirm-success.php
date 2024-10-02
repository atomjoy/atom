<?php
get_header();
global $wp_query;
$email = $wp_query->query_vars['wow_email'];
?>

<div class="page-wrap">
	<div class="container">
		<h1 style="float: left; width: 100%; padding: 20px 0px; text-align: center;"><?php echo __('The email address has been subscribed.'); ?></h1>
	</div>
</div>

<?php get_footer(); ?>