<form role="search" method="get" id="searchform" action="<?php echo home_url(); ?>">
    <input type="text" value="<?php get_search_query(); ?>" name="s" id="s" placeholder="<?php _e( 'Search...', 'official' ); ?>" />
    <input type="submit" id="searchsubmit" value="&#61442;" />
</form>