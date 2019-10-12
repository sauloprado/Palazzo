<?php 

/*
 * News Ticker
 *
 * Theme: Official
 * Author: Tohid Golkar
 * Website: http://tohidgolkar.com
 */


$ticker_id = 'nt_' . rand();
global $thdglkr_nt_title;
global $thdglkr_nt_cat;
global $thdglkr_nt_orderby;
global $thdglkr_nt_order;
global $thdglkr_nt_items;
global $thdglkr_nt_color;
global $thdglkr_nt_blink;
if ($thdglkr_nt_items==''){$thdglkr_nt_items=10;}
if ($thdglkr_nt_orderby==''){$thdglkr_nt_orderby='date';}
if ($thdglkr_nt_order==''){$thdglkr_nt_order='DESC';}

	if (is_rtl() || _option('rtl_support')){
			wp_enqueue_script('jquery.li-scrollerRTL', get_template_directory_uri() . '/js/jquery.li-scroller.1.0_RTL.js');
		}else{
			wp_enqueue_script('jquery.li-scroller', get_template_directory_uri() . '/js/jquery.li-scroller.1.0.js');
		}	

	?>
    
	<script language="javascript">
	
		jQuery(document).ready(function($) {	
			// News Ticker /////////////////////////////
			try {
				jQuery("ul#<?php echo $ticker_id; ?>").liScroll({travelocity: 0.08});
			} catch(e){}
		});	
	</script>

    
    
	<?php 


		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

		$posts_args = array( 
			'post_type' => 'post',
			'posts_per_page' => $thdglkr_nt_items,
			'paged' => $paged,
			'order' => $thdglkr_nt_order,
			'orderby' => $thdglkr_nt_orderby,
		);
		
		if($thdglkr_nt_cat){
			
			$thdglkr_nt_cats = explode(',' , $thdglkr_nt_cat);
			
			$posts_args['tax_query'][] = array(
						'taxonomy' 	=> 'category',
						'field' 	=> 'slug',
						'terms' 	=> $thdglkr_nt_cats
			);
		}
		
		
		global $wp_query;
		$wp_query = null;
		$wp_query = new WP_Query();
		$wp_query->query( $posts_args );
		
		$title_color = "";
		if ($thdglkr_nt_color != ''){$title_color = ' style="color:'.$thdglkr_nt_color.';" ';}
				
				?>
				<div class="breaking-news-bar">
                    <span class="title<?php if ($thdglkr_nt_blink=='true'){echo ' blink_me';}?>" <?php echo $title_color; ?> > <?php echo $thdglkr_nt_title; ?></span>
                    <ul id="<?php echo $ticker_id; ?>" class="newst">
                    
				<?php
				
				while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
	
					<li><span><?php the_time('d M'); ?></span><a href="<?php the_permalink() ?>" ><?php the_title(); ?></a></li>

				<?php endwhile; ?>
                
                    </ul>
               </div>
