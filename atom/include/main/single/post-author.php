<?php
$id = get_the_author_meta('ID');
$avatar = get_avatar($id, 256);
$fname = get_the_author_meta('first_name');
$lname = get_the_author_meta('last_name');
$alias = get_the_author_meta('nickname');
$time = get_the_date('Y-m-d h:i:s');
$author_url = '/author/' . $alias;
$author_url = esc_url(get_author_posts_url(get_the_author_meta('ID')));
?>

<a href="<?php echo $author_url; ?>">
	<?php echo $avatar; ?>
</a>
<div class="details">
	<div class="alias"><?php echo $fname . " " . $lname; ?></div>
	<div class="date"><?php echo $time; ?></div>
</div>