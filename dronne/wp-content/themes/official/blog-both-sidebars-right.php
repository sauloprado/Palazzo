<?php 
// Template Name: Blog (Both Sidebars Right)
get_header(); 

global $thdglkr_blog_style,$thdglkr_blog_thumb_class,$thdglkr_blog_img,$thdglkr_blog_iframe_class;
$thdglkr_blog_style = 'large';
$thdglkr_blog_thumb_class = 'thumb-big';
$thdglkr_blog_img = 'blog2';
$thdglkr_blog_iframe_class = 'iframe-thumb';


?>


	<?php get_template_part('functions/title'); //Setup the Titlebar ?>
                
        

		<div class="page-content">
			<div class="row clearfix">
            

               
		
                
				<div class="grid_6 posts alpha both-sidebars">
					

					
                    <?php

					$number_of_blog_item = _option( 'number_of_blog_item', 10 );
					global $paged;
     				if(empty($paged)) $paged = 1;
					
					// the query
					$args = array(
						'post_type' => array('post'), 
						'posts_per_page' => $number_of_blog_item,
						'paged' => $paged
					);
					query_posts( $args );
			
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
                
                    <?php endif; wp_reset_query(); ?>

	

				</div><!-- grid 8 posts -->
				
				
                 <!-- start sidebar -->
				<div class="grid_3 sidebar">
                    
                        <?php 
						
							if ( ! dynamic_sidebar ( 'sidebar-blog' ) ){
								thdglkr_emptysidebar('Blog');
								}        				
						?>	
     
               
				</div><!-- grid 3 Sidebar -->
                
                
                <!-- start sidebar -->
				<div class="grid_3 sidebar omega">
                    
                        <?php 
						
							if ( ! dynamic_sidebar ( 'sidebar-blog2' ) ){
								thdglkr_emptysidebar('Second Blog');
								}        				
						?>	
     
               
				</div><!-- grid 3 Sidebar -->

                 
                 
			</div><!-- row -->


		</div><!-- end page content -->
        
        
  <?php get_footer(); ?>