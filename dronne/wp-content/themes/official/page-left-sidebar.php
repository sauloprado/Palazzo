<?php 
// Template Name: Page Left Sidebar
get_header(); 
?>

        <?php get_template_part('functions/title'); //Setup the Titlebar ?>
         

		<div class="page-content">
           <div class="row clearfix">
           
           
           		<div class="grid_4 sidebar">
                    
                      <?php get_sidebar(); ?>	

				</div><!-- grid 4 Sidebar -->
                
                
                <div class="grid_8 posts">
            	
  					<?php if ( have_posts() ) : the_post(); ?>
                    
                  	<?php the_content(); ?>
                    <?php 
						
						wp_link_pages(array(
								'before' => '<div class="pagination mbs">'. __('Pages: ','official') ,
								'after' => '</div>' ,
								'next_or_number' => 'number',
								'link_before'      => '',
								'link_after'       => '',
								'echo'             => 1
								)); 
					?>
                        
                    <?php endif; wp_reset_query(); ?>
                    
                </div><!-- grid 8 posts -->  
            </div><!-- end row -->    
		</div><!-- end page-content -->
        
        
  <?php get_footer(); ?>