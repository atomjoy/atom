<!-- Custom Page -->
<?php get_header(); ?>

<div class="page-custom">
    <div class="page-container">
        <h1><?php the_title(); ?></h1>
        <?php
        the_content();
        get_contact_form();
        ?>
    </div>
</div>

<?php get_footer(); ?>