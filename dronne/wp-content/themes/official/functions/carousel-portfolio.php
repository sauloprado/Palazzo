<?php 

/*
 * Portfolio Carousel
 *
 * Theme: Official
 * Author: Tohid Golkar
 * Website: http://tohidgolkar.com
 */


$carousel_id = 'pc_' . rand();
global $thdglkr_pc_col;
global $thdglkr_pc_title;
global $thdglkr_pc_cat;
global $thdglkr_pc_car;
global $thdglkr_pc_items;
global $thdglkr_pc_nav;
if ($thdglkr_pc_items==''){$thdglkr_pc_items=10;}



	 if ($thdglkr_pc_car=='true'):

	
	?>
    
	<script language="javascript">
	
		jQuery(document).ready(function($) {
			
			// portfolio Carousel /////////////////////////////
			try {

					$("#<?php echo $carousel_id ; ?>").owlCarousel({
						items:<?php echo $thdglkr_pc_col; ?>,
						loop: true,
						margin:12,
						nav:true,
						navSpeed:<?php echo _option('portfolio_carousel_speed',1000); ?>,
						navText:['<i class="icon-angle-right"></i>','<i class="icon-angle-left"></i>'],
						dots:false,
						autoplay:true,
						autoplayTimeout:<?php echo _option('portfolio_carousel_pause_time',4000); ?>,
						autoplaySpeed:<?php echo _option('portfolio_carousel_speed',1000); ?>,
						autoplayHoverPause:true,
						responsive : {0 : {items : 1,nav : false}, 480 : {items : 2}, 768 : {items : <?php echo $thdglkr_pc_col; ?>}}
						
					});
					
					
			} catch(e){}
				
		//End Document.ready//
		});	
	</script>
	<?php endif; ?>
    
    
	<?php 
		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		$number_of_portfolio = $thdglkr_pc_items;
		$orderby_posts = _option( 'orderby_portfolio_carousel', 'menu_order' );
		$order_posts = _option( 'order_portfolio_carousel', 'ASC' );
		
		$portfolio_args = array( 
			'post_type' => 'portfolio',
			'posts_per_page' => $number_of_portfolio,
			'paged' => $paged,
			'order' => $order_posts,
			'orderby' => $orderby_posts
		);
		
		global $thdglkr_pc_cat;
		if($thdglkr_pc_cat){
			
			$thdglkr_pc_cats = explode(',' , $thdglkr_pc_cat);
			
			$portfolio_args['tax_query'][] = array(
							'taxonomy' 	=> 'portfolio_types',
							'field' 	=> 'slug',
							'terms' 	=> $thdglkr_pc_cats
			);
		}
		global $wp_query;
		$wp_query = null;
		$wp_query = new WP_Query();
		$wp_query->query( $portfolio_args );
	?>

        
        
        <?php 
			
			$columns_class='';
			switch($thdglkr_pc_col){
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
			
		if( $wp_query->have_posts() ) :	
	
			if ($thdglkr_pc_title!=''){echo do_shortcode('[title]'.$thdglkr_pc_title.'[/title]');}
	
			
			if ($thdglkr_pc_car=='true') {
				?>
                <div class="owl-carousel nav_<?php echo $thdglkr_pc_nav; ?>" id="<?php echo $carousel_id ; ?>">
                <?php	
				$liclass = ' class="uowl" ';
				
				while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
	
				<?php $terms = get_the_terms( get_the_ID(), 'portfolio_types' ); ?>              	
			
					<?php 
					global $thdglkr_embed_code;
					global $thdglkr_permalink;
					?>
		

					<?php if ( has_post_thumbnail()) { ?> 
               
					<div <?php echo $liclass; ?> >
						<?php get_template_part('functions/portfolio-source');  ?>
	
                        <div class="detailes">
                            <h5><a href="<?php echo $thdglkr_permalink; ?>"><?php the_title();?></a></h5>
                            <?php foreach ($terms as $term) { echo $term->name.', '; } ?>
                        </div>
                    </div>

				<?php } ?>

			<?php 
				endwhile; 
				
			?>
		
			</div>
				
				
			<?php 
			
			}else{
				$liclass = 'class="'. $columns_class .' alpha"';
				?>
                
				<div class="grid_12 alpha omega portfolio<?php echo $thdglkr_pc_col; ?>">
            	<div class="clearfix"><ul class="portfolio">
                <?php
				
				
				while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
	
				<?php $terms = get_the_terms( get_the_ID(), 'portfolio_types' ); ?>              	
			
					<?php 
					global $thdglkr_embed_code;
					global $thdglkr_permalink;
					?>
		

					<?php if ( has_post_thumbnail()) { ?> 
               
					<li <?php echo $liclass; ?> >
						<?php get_template_part('functions/portfolio-source');  ?>
	
                        <div class="detailes">
                            <h5><a href="<?php echo $thdglkr_permalink; ?>"><?php the_title();?></a></h5>
                            <?php foreach ($terms as $term) { echo $term->name.', '; } ?>
                        </div>
                    </li>

				<?php } ?>

			<?php 
				endwhile; 
				
			?>
		
			</ul></div></div>
            
            <?php
            
			}		

			?>	
            

 
 <?php endif;  wp_reset_query();?>