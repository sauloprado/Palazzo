    
    <?php if (_option('portfolio_nav')==1): ?>
        <div class="grid_12 single-first-row mb clearfix">

            <div class="project-links">
                <?php previous_post_link('%link','<span class="toptip" title="%title" ><i class="icon-angle-left mi"></i> '.__('Previous','official').'</span>'); ?>
                <a href="<?php echo home_url(); ?>/<?php echo _option( 'portfolio_item_slug', 'portfolio' ); ?>/"> <i class="icon-th toptip" title="<?php _e('All Projects','official'); ?>"></i> </a>
                <?php next_post_link('%link','<span class="toptip" title="%title" >'.__('Next','official').' <i class="icon-angle-right mii"></i></span>'); ?>  
            </div><!-- links -->        
    
        </div>
    <?php endif; ?> 
    		
    <div class="grid_12 portfolio-detail">
        
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
          
				 <?php  
				 
				 if (get_post_meta( get_the_ID(), 'official_embed', true ) != '') {
				 
					if (get_post_meta( get_the_ID(), 'official_portfolio-video', true ) == 'vimeo') {  
						echo '<div id="portfolio-video" class="mbt"><iframe src="http://player.vimeo.com/video/'.get_post_meta( get_the_ID(), 'official_embed', true ).'?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="1080" height="600" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen class="iframe"></iframe></div>';  
					}  
					else if (get_post_meta( get_the_ID(), 'official_portfolio-video', true ) == 'youtube') {  
						echo '<div id="portfolio-video" class="mbt" ><iframe width="1080" height="600" src="http://www.youtube.com/embed/'.get_post_meta( get_the_ID(), 'official_embed', true ).'?rel=0&showinfo=0&modestbranding=1&hd=1&autohide=1&color=white" frameborder="0" allowfullscreen class="iframe"></iframe></div>';  
					}  
					else {  
						echo '<div id="portfolio-video" class="mbt" >'.get_post_meta( get_the_ID(), 'official_embed', true ).'</div>'; 
					}  
					
				 	} else {	
				 ?>
                 
					<?php if(has_post_thumbnail()): ?>
                    	<figure >
                    	<?php if (get_post_meta( get_the_ID(), 'official_portfolio-lb', true )){?>
                        	<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'portfolio-full'); ?>
                            <a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" data-gal="photo[detail]" >
                            	<img class="four-radius mbf" src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>"/>
                            </a>
                        <?php } else { ?>
                        	<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'portfolio3'); ?>
                        	<img class="four-radius mbf" src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>"/>
                        <?php } ?>
                        </figure>
                    <?php endif; ?>
                    
                <?php } ?>

				
                
                
     
                <div class="grid_9 alpha">
                
                <?php $portfolio_sidebar = _option('portfolio_sidebar');  ?>
				<?php if ($portfolio_sidebar=='nosidebar'){ ?>
                    <h4 class="p-title"><?php the_title();?></h4>
                <?php } ?>
                
                	<?php the_content(); ?>
                </div>
                		
				
                <div class="grid_3 omega">
                	<?php get_template_part('functions/portfolio-info'); ?>
                </div>
                
                
                
                <?php if(_option('portfolio_share',1) == 1) { ?>
					<?php get_template_part( 'functions/share' ); ?>
                <?php } ?>
                
                
                
                <?php if(_option('related_portfolio') == 1) {
				  
				  global $thdglkr_pc_col;
				  $thdglkr_pc_col = "4";
				  get_template_part( 'functions/related-portfolio' );
				  
       		   			}
				?>


        
        <?php endwhile; endif; ?>
        
        <?php if(_option('portfolio_author_info') == 1): ?>
                <div class="grid_12 author-box mbs">
                    <?php echo get_avatar( get_the_author_meta('user_email'), '130', '' ); ?>
                    <div class="author-details">
                    	<h3> <?php the_author_link(); ?> <small> - author </small></h3>
                    	<p><?php the_author_meta("description"); ?></p>
                    </div>
                </div><!-- author -->
        <?php endif; ?>
                    
                    
                    
        
        <?php if ( comments_open() ) : ?>
        <div class="grid_12 comments"><?php comments_template(); ?></div>
        <?php endif; ?>

    </div><!-- end grid -->
    
    