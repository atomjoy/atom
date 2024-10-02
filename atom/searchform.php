<form action="/" method="get" class="search-form">
    <label for="s"><?php echo __('Search'); ?></label>
    <input type="text" name="s" id="search" value="<?php the_search_query(); ?>" required>
    <button type="submit"><?php echo __('Search'); ?></button>
</form>