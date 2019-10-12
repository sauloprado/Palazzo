<?php 
get_header(); 
?>

        <div class="breadcrumb-place">
            <div class="row clearfix">
                <h1 class="page-title"><?php echo get_the_title(); ?></h1>
            </div><!-- row -->
        </div><!-- breadcrumb --> 
        

		<div class="page-content">
           <div class="row clearfix">
           

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
                    
                    
            </div><!-- end row -->    
		</div><!-- end page-content -->
        
        
  <?php get_footer(); ?>