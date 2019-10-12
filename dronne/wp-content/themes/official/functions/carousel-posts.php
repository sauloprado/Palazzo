<?php 

/*
 * Recent Posts + Carousel
 *
 * Theme: Official
 * Author: Tohid Golkar
 * Website: http://tohidgolkar.com
 */


$carousel_id = 'poc_' . rand();
global $thdglkr_poc_col;
global $thdglkr_poc_title;
global $thdglkr_poc_cat;
global $thdglkr_poc_car;
global $thdglkr_poc_items;
global $thdglkr_poc_nav;
if ($thdglkr_poc_items==''){$thdglkr_poc_items=10;}



	 if ($thdglkr_poc_car=='true'):

	
	?>
    
	<script language="javascript">
	
		jQuery(document).ready(function($) {
			
			// posts Carousel /////////////////////////////
			try {
					
					$("#<?php echo $carousel_id ; ?>").owlCarousel({
						items:<?php echo $thdglkr_poc_col; ?>,
						loop: true,
						margin:12,
						nav:true,
						navSpeed:<?php echo _option('rp_carousel_speed',1000); ?>,
						navText:['<i class="icon-angle-right"></i>','<i class="icon-angle-left"></i>'],
						dots:false,
						autoplay:false,
						autoplayTimeout:<?php echo _option('rp_carousel_pause_time',4000); ?>,
						autoplaySpeed:<?php echo _option('rp_carousel_speed',1000); ?>,
						fallbackEasing:'<?php echo _option('rp_carousel_easing','easeInOutExpo'); ?>',
						autoplayHoverPause:true,
						responsive : {0 : {items : 1,nav : false}, 480 : {items : 2}, 768 : {items : <?php echo $thdglkr_poc_col; ?>}}
						
					});

				
			} catch(e){}
				
		//End Document.ready//
		});	
	</script>
	<?php endif; ?>
    
    
	<?php 

		
		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		$orderby_posts = _option( 'orderby_rp_carousel', 'date' );
		$order_posts = _option( 'order_rp_carousel', 'DESC' );
		
		
		$posts_args = array( 
			'post_type' => 'post',
			'posts_per_page' => $thdglkr_poc_items,
			'paged' => $paged,
			'order' => $order_posts,
			'orderby' => $orderby_posts,
		);
		
		if($thdglkr_poc_cat){
			
			$thdglkr_poc_cats = explode(',' , $thdglkr_poc_cat);
			
			$posts_args['tax_query'][] = array(
						'taxonomy' 	=> 'category',
						'field' 	=> 'slug',
						'terms' 	=> $thdglkr_poc_cats
			);
		}
		
		
		global $wp_query;
		$wp_query = null;
		$wp_query = new WP_Query();
		$wp_query->query( $posts_args );
	?>

        
        
        <?php 
			
			$columns_class='';
			switch($thdglkr_poc_col){
				case 1:
					$columns_class='grid_12';
				break;
				
				case 2:
					$columns_class='grid_6';
				break;
				
				case 3:
					$columns_class='grid_4';
				break;
				
				case 4:
					$columns_class='grid_3';
				break;

			}
			
			
	
			if ($thdglkr_poc_title!=''){echo do_shortcode('[title]'.$thdglkr_poc_title.'[/title]');}
	
			
			if ($thdglkr_poc_car=='true') {
				$liclass =  $columns_class .' alpha';
				?>
                
              
                <div class="owl-carousel nav_<?php echo $thdglkr_poc_nav; ?>" id="<?php echo $carousel_id ; ?>">
                
				<?php	
				$liclass = ' class="uowl ribb" ';
	
				
				while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
	

					<?php if ( has_post_thumbnail()) { ?> 
               
					<div <?php echo $liclass; ?> >
                    	<span class="dtrbn"><?php the_time('d M'); ?></span>
                        <div class="hover-fx zoom">
                        	
							<a href="<?php the_permalink() ?>" ><?php the_post_thumbnail('blog1'); ?></a>
                        </div>
                        
                        <div class="detailes clearfix">
                            <h5><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h5>
                            
                            <?php _e('by','official'); ?> <?php the_author_posts_link(); ?>  |  <?php comments_number(__('No Comment','official'), __('1 Comment','official'), __('% Comments','official')); ?>
                        </div>
                    </div>

				<?php } ?>

			<?php endwhile; wp_reset_query(); ?>
		
			</div>
            
            <?php
			}else{
				$liclass = 'class="'. $columns_class .' alpha ribb"';

				?>
                
				<div class="grid_12 alpha omega portfolio<?php echo $thdglkr_poc_col; ?> rp<?php echo $thdglkr_poc_col; ?>">
            	<div class="rpwrap clearfix">
                <ul class="from-blog portfolio clearfix">
                
                <?php
				
				while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
	

					<?php if ( has_post_thumbnail()) { ?> 
               
					<li <?php echo $liclass; ?> >
                    	<span class="dtrbn"><?php the_time('d M'); ?></span>
                        <div class="hover-fx zoom">
                        	
							<a href="<?php the_permalink() ?>" ><?php the_post_thumbnail('blog1'); ?></a>
                        </div>
                        
                        <div class="detailes clearfix">
                            <h5><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h5>
                            
                            <?php _e('by','official'); ?> <?php the_author_posts_link(); ?>  |  <?php comments_number(__('No Comment','official'), __('1 Comment','official'), __('% Comments','official')); ?>
                        </div>
                    </li>

				<?php } ?>

			<?php endwhile; wp_reset_query(); ?>
		
			</ul></div></div>
            

			<?php
            
			}		

			?>
                
           
