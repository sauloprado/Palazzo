<?php 
// Template Name: Portfolio 2 Columns
get_header(); 

?>


		<?php get_template_part('functions/title'); //Setup the Titlebar ?>
                
                
                
                
 
                
        

		<div class="page-content">
        	
			<?php 
				$sc = rwmb_meta('official_content');
				if ($sc=='top'){ get_template_part('functions/portfolio-content');}
			?>





			<?php get_template_part('functions/portfolio-filtering');?>
            
        
			<div class="row clearfix mbf">
            <div class="grid_12 alpha omega portfolio2">
            	<ul class="portfolio clearfix">
                
                <?php
				global $wp_query;
				$portfolioitems = _option('number_of_portfolio_item',12); // Get Items per Page Value
				$portfolio_grid='grid_6 alpha';
				
				$paged = get_query_var('paged') ? get_query_var('paged') : 1;
				$args = array(
					'post_type' 		=> 'portfolio',
					'posts_per_page' 	=> $portfolioitems,
					'post_status' 		=> 'publish',
					'orderby' 			=> 'date',
					'order' 			=> 'DESC',
					'paged' 			=> $paged
				);
				
				// Only pull from selected Filters if chosen
				$selectedcats = get_post_meta(get_the_ID(), 'official_portfoliocat', false);
				$hidetitle = rwmb_meta('official_portfolio_title');
				$hidecats = rwmb_meta('official_portfolio_cat');
				
				if($selectedcats && $selectedcats[0] == 0) {
					unset($selectedcats[0]);
				}
				if($selectedcats){
					$args['tax_query'][] = array(
						'taxonomy' 	=> 'portfolio_types',
						'field' 	=> 'ID',
						'terms' 	=> $selectedcats
					);
				}
				
				$wp_query = new WP_Query($args);
				global $thdglkr_embed_code,$thdglkr_permalink;
				while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
	
				<?php $terms = get_the_terms( get_the_ID(), 'portfolio_types' ); ?>              	

				
				
					<?php if ( has_post_thumbnail()) { ?> 
                	<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full'); ?>
                    
					<li class="<?php echo $portfolio_grid; ?>" data-id="<?php echo get_the_ID(); ?>" data-type="<?php if($terms) : foreach ($terms as $term) { echo $term->slug.' '; } endif; ?>">
						
                        <?php get_template_part('functions/portfolio-source');  ?>
	
                        
                        <?php if (!$hidetitle || !$hidecats){ ?>
                        <div class="detailes">
                        	
							<?php if (!$hidetitle){ ?>
                            	<h5><a href="<?php echo $thdglkr_permalink; ?>"><?php the_title();?></a></h5>
                            <?php } ?>
                             
                            <?php if (!$hidecats){ ?>
                            	<?php foreach ($terms as $term) { echo $term->name.', '; } ?>
                            <?php } ?>
                        </div>
                        <?php } ?>
                        
                    </li>

				<?php } ?>

			<?php endwhile; ?>
		
			</ul> <!-- end of .portfolio UL -->	
    
    		</div>
			<?php echo $thdglkr_embed_code; ?>

			</div><!-- row -->

            <!-- PAGINATION -->
                <?php pagination($pages = '', $range = 4); wp_reset_query(); ?>
            <!-- END PAGINATION -->

			
			<?php if ($sc=='bottom'){ get_template_part('functions/portfolio-content');} ?>


		</div><!-- end page content -->
        
        
  <?php get_footer(); ?>