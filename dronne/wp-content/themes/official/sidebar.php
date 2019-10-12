
    <?php 
	
	if(is_page()){
		
		/* Page Sidebar */
		generated_dynamic_sidebar(); 
	
		
	} elseif (get_post_type() == 'portfolio') {
		
		/* Portfolio Details */
		if ( ! dynamic_sidebar ( 'sidebar-portfolio' ) ):		
        endif;	
	
	} elseif (get_post_type() == 'product') {
		
		/* Portfolio Details */
		if ( ! dynamic_sidebar ( 'sidebar-shop' ) ):
           thdglkr_emptysidebar('Shop');				
        endif;
			
	} elseif (is_search()) {
		
		/* Search Page*/
		if ( ! dynamic_sidebar ( 'sidebar-search' ) ):
           thdglkr_emptysidebar('Search');				
        endif;
		
	} else {
		
		/* Blog Sidebar */
		if ( ! dynamic_sidebar ( 'sidebar-blog' ) ):
           thdglkr_emptysidebar('Blog');				
        endif;
	}
	
	?>
