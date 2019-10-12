<?php 
// Template Name: Blog (Large Image)
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
                
                
				<div class="grid_8 posts">
					

					
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