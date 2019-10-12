<?php 
/*
 * Recent Posts
 *
 * Theme: official
 * Author: Tohid Golkar
 * Website: http://tohidgolkar.com
 */
?>

<?php 
		
		global $thdglkr_poc_items;
		$number_of_blog_item = $thdglkr_poc_items;
		
		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		$number_of_posts = $thdglkr_poc_items;
		$orderby_posts = 'date';
		$order_posts = 'DESC';
		
		
		$posts_args = array( 
			'post_type' => 'post',
			'posts_per_page' => $number_of_posts,
			'paged' => $paged,
			'order' => $order_posts,
			'orderby' => $orderby_posts,
		);
		
		global $thdglkr_poc_cat;
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

			<?php if( $wp_query->have_posts() ) :  ?>        
					
                    <?php 
					global $thdglkr_poc_title;
                    if ($thdglkr_poc_title!=''){echo do_shortcode('[title]'.$thdglkr_poc_title.'[/title]');}
                    ?>
                    
                	<div class="fb-blog animtt"><ul>
                    
                    
                	<?php while( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
								
                            <li>
                                <div class="grid_2 alpha">
                                    <span class="date"><?php the_time('d'); ?></span>
                                    <span class="month"><?php the_time('M'); ?></span>
                                </div>
                
                                <div class="grid_10 omega">
                                    <h3 class="fb-head"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
                                    <span class="fb-meta"><?php _e('by','official'); ?> <?php the_author_posts_link(); ?>  |  <?php comments_number(__('No Comment','official'), __('1 Comment','official'), __('% Comments','official')); ?></span>     
                                    <p><?php echo excerpt(30); ?></p>
                                </div>
                            </li>

					<?php endwhile; ?>

                </ul></div>

     
     	<?php endif; ?>
