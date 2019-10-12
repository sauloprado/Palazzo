<?php 
get_header(); 

?>

	
		<div class="breadcrumb-place">
            <div class="row clearfix">
                <h1 class="page-title"><?php echo get_the_title() ?></h1>
                
                <div class="breadcrumbIn">
                	<span> <?php _e('You are here:','official'); ?> </span>
                    <ul>
                    
                        <li>
                            <a href="<?php echo home_url(); ?>" ><i class="icon-home"></i></a>
                        </li>
                        
                        /
                        
                        <?php if (is_home() || is_front_page()){ ?>
                        
                            <li>
                                <?php _e('Blog','official'); ?>
                            </li>
                            
                            /
                            
                        <?php } else { ?>
                            <li>
                                <a href="<?php echo home_url(); ?>/blog/" ><?php _e('Blog','official'); ?></a>
                            </li>
                            
                            /
                            
                            <li>	
                                <?php echo get_the_title(); ?>
                            </li>        				
    
                        <?php } ?>
                            
                        
                    </ul>
        		</div><!-- breadcrumb -->
        
            </div><!-- row -->
        </div><!-- breadcrumb -->
                
        

		<div class="page-content">
			<div class="row clearfix">
            
            
            	<?php if (_option('blog_sidebar','right')=='left'): ?>
                <!-- start sidebar -->
				<div class="grid_4 sidebar alpha">
                    
                        <?php 
						
							if ( ! dynamic_sidebar ( 'sidebar-blog' ) ){
								thdglkr_emptysidebar('Blog');
								}        				
						?>	
     
               
				</div><!-- grid 4 Sidebar -->
				<?php endif; ?>
                
                
                
				<div class="grid_8 posts">
					

					
                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
						<?php get_template_part( 'functions/post-format/single', get_post_format() ); ?>
                
                    <?php endwhile; ?>
                    
                
                   
                    
                    
                
                    <?php else : ?>
                
                        <h3><?php _e('Not Found', 'official') ?></h3>
                
                    <?php endif; ?>

					
                    
                     <?php 
						wp_link_pages(array(
									'before' => '<div class="pagination pages mbs mts"><span>'. __('Pages: ','official') .'</span>',
									'after' => '</div>' ,
									'next_or_number' => 'number',
									'link_before'      => '<span>',
									'link_after'       => '</span>',
									)); 
					?>
                    
                    
                    
                    <?php $bef='<div class="post-tags tags mtt mbf"><span>'. __('Tags: ','official').'</span>'; ?>
					<?php the_tags($bef,' ','</div>'); ?>
					
                    
  
                    <?php if(_option('author_info') == 1): ?>
                    <div class="author-box">
						<?php echo get_avatar( get_the_author_meta('user_email'), '130', '' ); ?>
                        <div class="author-details">
						<h3> <?php the_author_link(); ?> <small> - author </small></h3>
						<p><?php the_author_meta("description"); ?></p>
                        </div>
					</div><!-- author -->
                    <?php endif; ?>
                    
                    
                    
                    <?php if(_option('blog_share',1) == 1) { ?>
						<?php get_template_part( 'functions/share' ); ?>
                    <?php } ?>
                    
                    
					<?php if (_option('blog_comment')==1):?>
                    	<div class="comments"><?php comments_template(); ?></div>
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