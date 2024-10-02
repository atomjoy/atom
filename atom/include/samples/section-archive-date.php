<?php
/*
Template Name: Archive Date
*/
?>

<section class="section section-frontpage">
    <?php while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
                <h1 class="entry-title"><?php the_title(); ?></h1>
            </header>
            <div class="entry-content">
                <?php
                $year = 0;
                $list = preg_replace(
                    '@</li>@',
                    '',
                    wp_get_archives(
                        array(
                            'type' => 'monthly',
                            'show_post_count' => true,
                            'echo' => false
                        )
                    )
                );
                $start = true;
                foreach (preg_split('/<li>/', $list) as $entry) {
                    if (!preg_match('/ (\d{4})</', $entry, $matches)) {
                        continue;
                    }
                    if ($matches[1] != $year) {
                        $year = $matches[1];
                        if (!$start) {
                            echo '</ul>';
                        }
                        printf('<h2>%d</h2>', $year);
                        echo '<ul>';
                        $start = false;
                    }
                    printf('<li>%s</li>', $entry);
                }
                echo '</ul>';
                ?>
            </div>
        </article>
    <?php endwhile; ?>
</section>