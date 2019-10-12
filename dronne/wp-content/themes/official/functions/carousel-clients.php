<?php 

/*
 * Clients Carousel
 *
 * Theme: Official
 * Author: Tohid Golkar
 * Website: http://tohidgolkar.com
 */


$carousel_id = 'cc_' . rand();
global $thdglkr_cc_col;
global $thdglkr_cc_title;
global $thdglkr_cc_cat;
global $thdglkr_cc_nav;
?>
	
	<script language="javascript">
	
		jQuery(document).ready(function($) {
			
			// Clients Carousel /////////////////////////////
			try {
				
				$("#<?php echo $carousel_id ; ?>").owlCarousel({
						items:<?php echo $thdglkr_cc_col; ?>,
						loop: true,
						margin:12,
						nav:true,
						navSpeed:<?php echo _option('portfolio_carousel_speed',1000); ?>,
						navText:['<i class="icon-angle-right"></i>','<i class="icon-angle-left"></i>'],
						dots:false,
						autoplay:true,
						autoplayTimeout:<?php echo _option('carousel_pause_time',4000); ?>,
						autoplaySpeed:<?php echo _option('carousel_speed',1000); ?>,
						autoplayHoverPause:true,
						responsive : {0 : {items : 1,nav : false}, 480 : {items : 2}, 768 : {items : <?php echo $thdglkr_cc_col; ?>}}
						
					});
		
			} catch(e){}

		});	
	</script>

	<?php 
		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		$number_of_clients = _option( 'number_of_clients', 10 );
		$orderby_posts = _option( 'orderby_clients_carousel', 'menu_order' );
		$order_posts = _option( 'order_clients_carousel', 'ASC' );
		
		$clients_args = array( 
			'post_type' => 'clients',
			'posts_per_page' => $number_of_clients,
			'paged' => $paged,
			'order' => $order_posts,
			'orderby' => $orderby_posts,
		);
		
		global $thdglkr_cc_cat;
		if($thdglkr_cc_cat){
			
			$thdglkr_cc_cats = explode(',' , $thdglkr_cc_cat);
			
			$clients_args['tax_query'][] = array(
						  'taxonomy' 	=> 'clients_types',
						  'field' 	=> 'slug',
						  'terms' 	=> $thdglkr_cc_cats
			);
		}
		global $wp_query;
		$temp = $wp_query;
		$wp_query = null;
		$wp_query = new WP_Query();
		$wp_query->query( $clients_args );
	
			
	?>
	
	<?php if( $wp_query->have_posts() ) :  ?>
    	<?php if ($thdglkr_cc_title!=''){echo do_shortcode('[title]'.$thdglkr_cc_title.'[/title]');} ?>

            <div class="clients">

              <ul id="<?php echo $carousel_id ; ?>" class="owl-carousel nav_<?php echo $thdglkr_cc_nav; ?>">
                <?php while( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
				 		
					<?php $strUrl = get_post_meta( get_the_ID(), 'official_client-url', true ); ?>
                    <li><a href="<?php if ($strUrl) {echo $strUrl.'"';} else {echo '#" onclick="return false;" ';} ?> title="<?php the_title(); ?>" class="toptip" <?php if ($strUrl) {echo 'target="_blank"';} ?> >     

                        <?php if( has_post_thumbnail() ) : ?>
                                
                            <?php the_post_thumbnail(); ?>
                                    
                        <?php endif; ?>

                    </a></li>
                    
                <?php endwhile; ?>
              </ul>
           </div>

     <?php endif; wp_reset_query(); ?>
