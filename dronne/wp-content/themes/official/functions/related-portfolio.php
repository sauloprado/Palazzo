<?php 

/*
 * Related Portfolio Carousel
 *
 * Theme: Official
 * Author: Tohid Golkar
 * Website: http://tohidgolkar.com
 */


$carousel_id = 'pc_' . rand();


?>

	<div class="grid_12 alpha omega mbs clearfix">

	<script language="javascript">
	
		jQuery(document).ready(function($) {
			
			// portfolio Carousel /////////////////////////////
			try {
				
				$("#<?php echo $carousel_id ; ?>").jCarouselLite({
						btnNext: ".portfolio-carousel .nexte",
						btnPrev: ".portfolio-carousel .preve",
						visible: <?php global $thdglkr_pc_col; echo $thdglkr_pc_col; ?>,
						scroll: 1,
						hoverPause: true,
						circular: true,
						auto: <?php echo _option('portfolio_carousel_pause_time',4000); ?>,
						speed: <?php echo _option('portfolio_carousel_speed',700); ?>,
						easing: '<?php echo _option('portfolio_carousel_easing','easeInOutExpo'); ?>'
					});
				
			} catch(e){}
				
		//End Document.ready//
		});	
	</script>

    
	<?php 
		$thdglkr_embed_code = '';
        $terms = get_the_terms( $post->ID , 'portfolio_types', 'string');
        $term_ids = array_values( wp_list_pluck( $terms,'term_id' ) );
        $related_query = new WP_Query( array(
              'post_type' => 'portfolio',
              'tax_query' => array(
                            array(
                                'taxonomy' => 'portfolio_types',
                                'field' => 'id',
                                'terms' => $term_ids,
                                'operator'=> 'IN' //Or 'AND' or 'NOT IN'
                             )),
              'posts_per_page' => 10,
              'ignore_sticky_posts' => 1,
              'orderby' => 'date',  // 'rand' for random order
              'post__not_in'=>array($post->ID)
           ) );
	?>

        
        
        <?php 

			
	
			if (_option('related_portfolio_title')){
				
				echo do_shortcode('[title]'. _option('related_portfolio_title') .'[/title]');
				}
            
	
	
			?>
				
                
            <div class="portfolio-carousel" id="<?php echo $carousel_id ; ?>"><div class="anyClass"><ul>
   
        
                
            <?php
				

				while ( $related_query->have_posts() ) : $related_query->the_post(); ?>
	
				<?php $terms = get_the_terms( get_the_ID(), 'portfolio_types' ); ?>              	
				
                <?php 
				global $thdglkr_embed_code;
				global $thdglkr_permalink;
				?>
	
					<?php if ( has_post_thumbnail()) { ?> 
               
					<li>
						<?php get_template_part('functions/portfolio-source');  ?>
	
                        <div class="detailes">
                            <h5><a href="<?php echo $thdglkr_permalink; ?>"><?php the_title();?></a></h5>
                            <?php foreach ($terms as $term) { echo $term->name.', '; } ?>
                        </div>
                    </li>

				<?php } ?>

			<?php endwhile; ?>
		
			</ul>
            </div>
            
            <div class="preve"><i class="icon-angle-left"></i></div><!-- portfolio carousel left -->
			<div class="nexte"><i class="icon-angle-right"></i></div><!-- portfolio carousel right -->
            
            </div>
            
            
     </div>
