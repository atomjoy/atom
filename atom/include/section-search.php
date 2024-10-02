<!-- Front Page -->
<?php     
    $search = get_search_query();
?>

<section class="section section-frontpage">
    <div class="blog-header">
        <img class="image" src="<?php echo get_template_directory_uri() . '/images/posts/blog-title.webp'; ?>" alt="<?php echo __('Blog image'); ?>">
        <h1 class="title"><?php echo __($search ?? 'Search'); ?></h1>
        <form class="blog-search" method="get" action="/">
            <input type="text" name="s" id="blog-search-input" placeholder="<?php echo __('Search'); ?>">
            <button class="blog-search-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
    </div>
    <!-- <div class="categories">
        <?php wp_list_categories([
            'title_li' => 'div',
            'style' => 'none',
            'separator' => ''
        ]); ?>
    </div> -->
    <div class="post-row">
        <?php 
            $count = 0;
            if(have_posts()): while(have_posts()): the_post(); 
            $count++;

            // Details
            $id = get_the_author_meta('ID');
            $avatar = get_avatar_url($id, 256);
            $fname = get_the_author_meta('first_name'); 
            $lname = get_the_author_meta('last_name'); 
            $alias = get_the_author_meta('nickname'); 
            $author_url = '/author/'.$alias;
            $time = get_the_date('Y-m-d h:i:s');            
            // Categories
            $categories = get_the_category();
            foreach ($categories as $cat) {
                if(strtolower($cat->name) != 'blog') {
                    $category = $cat;
                }
            }
            // Views 
            $views = 0;
            if(function_exists('showPostViews')) {
                $views = showPostViews();
            }
            // Posts
            if($count == 1) {
        ?>
        <div class="main-post">
            <div class="main-post-image">
            <?php  if(has_post_thumbnail()):?>
                <img class="image" src="<?php the_post_thumbnail_url('post-thumbnail-large'); ?>" alt="<?php the_title();?>">                
            <?php else: ?>
                <img class="image" src="<?php echo get_template_directory_uri() . '/images/posts/default-full.webp'; ?>" alt="<?php the_title();?>">            
            <?php endif; ?>
            </div>
            <div class="main-post-content">
                <div class="main-post-category"><a href="<?php echo get_category_link($category->term_id);?>"><?php echo $category->name ?? 'Blog'; ?></a></div>
                <a href="<?php the_permalink();?>"><h2 class="main-post-title"><?php the_title();?></h2></a>
                <div class="main-post-excerpt"><?php the_excerpt();?></div>
                <div class="main-post-author">
                    <a href="<?php echo $author_url; ?>"><img class="image" src="<?php echo $avatar; ?>" alt="<?php echo $alias; ?>"></a>
                    <div class="details">
                        <div class="name"><?php echo $fname . ' ' . $lname; ?></div>
                        <div class="date"><?php echo $time; ?></div>
                    </div>
                </div>
            </div>
        </div>
        <?php } else { ?>
        <div class="post-card">
            <div class="card-image">
            <?php  if(has_post_thumbnail()):?>
                <img class="image" src="<?php the_post_thumbnail_url('post-thumbnail-medium'); ?>" alt="<?php the_title();?>">                
            <?php else: ?>
                <img class="image" src="<?php echo get_template_directory_uri() . '/images/posts/default-small.webp'; ?>" alt="<?php the_title();?>">            
            <?php endif; ?>
            </div>
            <div class="card-body">
                <div class="card-author">                    
                    <a href="<?php echo $author_url; ?>"><img class="image" src="<?php echo $avatar; ?>" alt="<?php echo $alias; ?>"></a>
                    <div class="details">
                        <div class="name"><?php echo $fname . ' ' . $lname; ?></div>
                        <div class="date"><span><?php echo $time; ?></span></div>
                    </div>
                </div>
                <div class="card-content">
                    <a href="<?php the_permalink();?>"><h2 class="title"><?php the_title();?></h2></a>
                    <div class="excerpt"><?php the_excerpt_embed();?></div>
                </div>
            </div>
            <div class="card-category">
                <span class="name"><a href="<?php echo get_category_link($category->term_id);?>"><?php echo $category->name ?? 'Blog'; ?></a></span>
                <span class="views"><i class="fa-solid fa-eye"></i><?php echo $views; ?></span>
                <a href="<?php the_permalink();?>"><span class="link"><i class="fa-solid fa-arrow-right"></i></span></a>
            </div>
        </div>    
        <?php } ?>
        
        <?php endwhile; else : ?>
            <div class="no-posts"><?php echo __('No posts'); ?></div>
            <h2><?php echo __('Most Popular Posts'); ?></h2>
        <?php mostPopularPosts(); endif; ?>
        
        <!-- empty post justify dont delete -->
        <div class="post-card post-card-hidden" style="visibility: hidden;"></div>
    </div>    
    <div class="pages">
        <span class="prev">
            <?php previous_posts_link(); ?>
        </span>
        <span class="next">
            <?php next_posts_link(); ?>
        </span>        
    </div>
</section>
