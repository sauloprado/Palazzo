<?php 
// Template For Search
get_header(); 

global $thdglkr_blog_style,$thdglkr_blog_thumb_class,$thdglkr_blog_img,$thdglkr_blog_iframe_class;
$thdglkr_blog_style = 'small';
$thdglkr_blog_thumb_class = 'thumb-small fll';
$thdglkr_blog_img = 'blog1';
$thdglkr_blog_iframe_class = 'iframe-thumb fll';


?>


	<div class="breadcrumb-place">
            <div class="row clearfix">
                <h1 class="page-title"><?php _e('Search','official'); ?></h1>
                
                <div class="breadcrumbIn">
                	<span> <?php _e('You are here:','official'); ?> </span>
                    <ul>
                    	<li>
                            <a href="<?php echo home_url(); ?>" ><i class="icon-home"></i></a>
                        </li>
                        /
                        <li>
                        
                            <?php
                    
                                if (is_tag()){
                                
                                _e('Tag search for: ','official');
                                echo $tag;
                                
                                } elseif (is_search()){
                                    
                                    _e('Search for: ','official');
                                    echo get_search_query();
                                    
                                } elseif (is_category()){
                                    
                                    _e('Category: ','official'); echo single_cat_title('', false);
                                } elseif (is_day()){
                                    
                                    _e('Archive for: ','official'); echo get_the_time('d'); echo ' / ' . get_the_time('F');  echo ' / ' . get_the_time('Y');
                                    
                                } elseif (is_month()){
                                    
                                    _e('Archive for: ','official'); echo get_the_time('F'); echo ' / ' . get_the_time('Y');
                                    
                                } elseif (is_year()){
                                    
                                    _e('Archive for: ','official'); echo get_the_time('Y');
                                    
                                } elseif (is_author()){
                                    global $author;
                                    $userdata = get_userdata($author);
                                    _e('Articles posted by: ','official'); echo $userdata->display_name;
                                }
                      
                            ?>
                            
                        </li>
                           
                                
                            
                    </ul>
        		</div><!-- breadcrumb -->
        
            </div><!-- row -->
        </div><!-- breadcrumb -->

		<div class="page-content">
			<div class="row clearfix">
            
            	
                <?php if (_option('blog_sidebar','right')=='left'): ?>
                <!-- start sidebar -->
				<div class="grid_4 alpha sidebar">
                    
                        <?php 
						
							if ( ! dynamic_sidebar ( 'sidebar-blog' ) ){
								thdglkr_emptysidebar('Blog');
								}        				
						?>	
     
               
				</div><!-- grid 4 Sidebar -->
				<?php endif; ?>
                
                
				<div class="grid_8 posts s-thumbnails">
					

					
                    <?php

			
					// begin the loop
					if ( have_posts() ) : while ( have_posts() ) : the_post();

					?>
			
						<?php get_template_part( 'functions/post-format/content', get_post_format() ); ?>
                
                    <?php endwhile; ?>
                    
                
                    <!-- PAGINATION -->
					<?php pagination($pages = '', $range = 4); ?>
                    <p class="hide"><?php posts_nav_link(); ?></p>
                    <!-- END PAGINATION -->
                    
                    
                
                    <?php else : ?>
                
                        <h3><?php _e('Not Found', 'official') ?></h3>
                
                    <?php endif; ?>

	

				</div><!-- grid 8 posts -->
				
                
                
                <?php if (_option('blog_sidebar','right')=='right'): ?>
                <!-- start sidebar -->
				<div class="grid_4 sidebar omega">
                    
                        <?php 
						
							if ( ! dynamic_sidebar ( 'sidebar-blog' ) ){
								thdglkr_emptysidebar('Blog');
								}        				
						?>	
     
               
				</div><!-- grid 4 Sidebar -->
				<?php endif; ?>
                 
                 
                 
			</div><!-- row -->


		</div><!-- end page content -->
        
        
  <?php get_footer(); ?>