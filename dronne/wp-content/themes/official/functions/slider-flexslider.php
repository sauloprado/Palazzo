<?php
/*
Template For Flex Slider
*/
?>			
	<?php /*Tohid Golkar Flex Slider for Wordpress*/ ?>
	<?php 
		
		$number_of_slides = _option( 'slider_number_of_slides', 5 );
	
		
		$slide_args = array( 
			'post_type' => 'slide',
			'slider_types' => 'flex-slider',
			'posts_per_page' => $number_of_slides,
			'paged' => 1,
			'order' => 'ASC',
			'orderby' => 'menu_order',
		);
		
		$temp = $wp_query;
		$wp_query = null;
		$wp_query = new WP_Query();
		$wp_query->query( $slide_args );
	?>

	<?php if( $wp_query->have_posts() ) :  ?>            
   <?php 
   		$animation = 'slide';
   		$slider_style =  _option( 'flex_slider_direction', 'horizontal' );
   		if ($slider_style=='fade'){
			$animation = 'fade';
		}
   
   ?>
		<script language="javascript">
			jQuery(document).ready(function($) {
				try {
					$('.flexslider').flexslider({
						animation: "<?php echo $animation;?>",
						direction: "<?php echo $slider_style;?>",
						slideshowSpeed: <?php echo _option( 'slider_pause_time', 4000 ); ?>,
						animationSpeed: <?php echo _option( 'slider_speed', 700 ); ?>,
						prevText: "",
    					nextText: "",
						controlNav: false,
						keyboardNav: true,
						start: function(slider) {
							$('.flex-active-slide').find('h3').delay(100).addClass('effect').fadeIn(400);
							$('.flex-active-slide').find('p').delay(100).addClass('effectt').fadeIn(400);
						},
						after: function(slider) {
							$('.flex-active-slide').find('h3').delay(100).addClass('effect').fadeIn(400).removeClass('Out');
							$('.flex-active-slide').find('p').delay(100).addClass('effectt').fadeIn(400).removeClass('Out');
						}
					});
				} catch(e){}
			});
        </script>
            
            
            <!-- SLIDER -->   
            <div class="row clearfix fullBG">
            <div class="big-slider clearfix flexslider flex-slide-h">
                
                <ul class="slides">
                    
                    
                    <?php while( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
                        
                            <li>
    
                                <?php if( has_post_thumbnail() ) : ?>
  										<?php $slide_url=get_post_meta($post->ID, 'official_slide_url', true); ?>
                                        
                                        <?php if ($slide_url!=''){ echo '<a href="'.$slide_url.'">'; }?>	
                                			<?php the_post_thumbnail('photo_slider'); ?>
                                		<?php if ($slide_url!=''){ echo '</a>'; }?>

                                <?php endif; ?>
                                
                                <?php $slide_caption_title=get_post_meta($post->ID, 'official_slide_caption_title', true); ?>
                                <?php $slide_caption_text=trim(get_post_meta($post->ID, 'official_slide_caption_text', true)); ?>
                      
                                
                                <?php if($slide_caption_text !='' || $slide_caption_title !='' ): ?>
                                        <?php if ($slide_caption_title): ?>
                                            <h3><?php echo $slide_caption_title; ?></h3>
                                        <?php endif; ?> 
                                        <?php if ($slide_caption_text): ?>                            
                                        	<p><?php echo $slide_caption_text; ?></p>
                                        <?php endif; ?> 
                                <?php endif; ?>
                            </li>
   
                    <?php endwhile; wp_reset_query();?>
                            
                    
                </ul>

            </div>
            </div>
            <!-- End SLIDER --> 
            
            
	<?php endif;  ?>
	