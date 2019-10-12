<?php 

/*
 * Testimonials & Quotes
 *
 * Theme: Official
 * Author: Tohid Golkar
 * Website: http://tohidgolkar.com
 */



global $thdglkr_tq_type;
global $thdglkr_tq_style;
global $thdglkr_tq_title;
global $thdglkr_tq_items;
global $thdglkr_tq_cat;
global $thdglkr_tq_transition;
$tst_id = 'tst_' . rand();


?>
	
	<script language="javascript">
	
		jQuery(document).ready(function($) {
			
			// Testimonial Javascript /////////////////////////////
			try {

				if ($("#<?php echo $tst_id; ?>")[0]) {
					jQuery('#<?php echo $tst_id; ?>').flexslider({
						animation: "<?php echo $thdglkr_tq_transition; ?>",
						slideshowSpeed: 8000,
						animationSpeed: 800,
						directionNav: true,
						controlNav: false,
						pauseOnHover: true,
						initDelay: 0,
						randomize: false,
						smoothHeight: true,
						keyboardNav: false
					});
				}
			} catch(e){}

		});	
	</script>

	<?php 
		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		
		$testimonial_args = array( 
			'post_type' => 'testimonial',
			'posts_per_page' => $thdglkr_tq_items,
			'paged' => $paged,
			'order' => 'ASC',
			'orderby' => 'menu_order',
		);
		
		global $thdglkr_tq_cat;
		if($thdglkr_tq_cat){
			
			$thdglkr_tq_cats = explode(',' , $thdglkr_tq_cat);
			
			$testimonial_args['tax_query'][] = array(
						  'taxonomy' 	=> 'testimonial_types',
						  'field' 	=> 'slug',
						  'terms' 	=> $thdglkr_tq_cats
			);
		}
		global $wp_query;
		$temp = $wp_query;
		$wp_query = null;
		$wp_query = new WP_Query();
		$wp_query->query( $testimonial_args );
	?>

	<?php if( $wp_query->have_posts() ) :  ?>
    

			<?php if ($thdglkr_tq_title!=''){?> 
					<h3 class="col-title"><?php echo $thdglkr_tq_title; ?></h3><span class="liner"></span>
			<?php } ?>
            
            <div id="<?php echo $tst_id; ?>" class="<?php echo $thdglkr_tq_style; ?> testimonials testimonial-wrapper clearfix flexslider tst">
				<ul class="slides">
        
 
                <?php while( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
				 		
					<?php $strUrl = get_post_meta( get_the_ID(), 'official_client-url', true ); ?>
                    <li class="testimonial-s">
                        <div class="testimonial">
                        	<?php if ($thdglkr_tq_type=='quote'){?> <i class="icon-quote-left icon-4x pull-left icon-muted"></i> <?php }?>
                            <p><?php echo get_post_meta( get_the_ID(), 'official_testimonial', true ); ?></p>
                            <div class="testimonial-arrow"></div>
                        </div>
                        <p>
                        	<?php if( has_post_thumbnail() ) : ?>
                                
                            	<?php the_post_thumbnail('testimonial', array('class' => 'client-avat')); ?>
                                <span class="testimonial-details">
                                <?php else:?>
                                <span class="testimonial-details2">
                        	<?php endif; ?>
                            	<strong class="testimonial-name"><?php echo get_post_meta( get_the_ID(), 'official_testimonial_name', true ); ?></strong>
                            	<?php $job = get_post_meta( get_the_ID(), 'official_testimonial_job', true ); if ($job!=''){echo "- " . $job;} ?>
                            </span>
                        </p>
                    </li>
                    
                    
                <?php endwhile; ?>
              </ul>
        	</div><!-- testimonial -->
        
         
     <?php endif; ?>
