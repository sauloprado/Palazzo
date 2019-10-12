<?php
/*
Template For Roundabout Slider
Tohid Golkar Roundabout Slider for Wordpress
v1.0
*/
?>			

	<?php 
		
		$number_of_slides = _option( 'slider_number_of_slides', 5 );
		$roundabout_pause_time =  _option( 'slider_pause_time', 4000 );
		$roundabout_speed =  _option( 'slider_speed', 700 );
	
		
		$slide_args = array( 
			'post_type' => 'slide',
			'slider_types' => 'roundabout-slider',
			'posts_per_page' => $number_of_slides,
			'paged' => 1,
			'order' => 'ASC',
			'orderby' => 'menu_order',
		);
		
		//$temp = $wp_query;
		$wp_query = null;
		$wp_query = new WP_Query();
		$wp_query->query( $slide_args );
	?>

	<?php if( $wp_query->have_posts() ) :  ?> 
    <?php wp_enqueue_script('jquery.event.drag', get_template_directory_uri() . '/js/jquery.event.drag.js','2.2',true); ?>
    <?php wp_enqueue_script('jquery.event.drop', get_template_directory_uri() . '/js/jquery.event.drop.js','2.0.0',true); ?>   
    <?php wp_enqueue_script('jquery.roundabout', get_template_directory_uri() . '/js/jquery.roundabout.min.js','2.4.2',true); ?>         

         
	
		<script language="javascript">
			jQuery(document).ready(function($) {

				$(".roundabout ul").roundabout({
					autoplay:true,
					autoplayInitialDelay:1000,
					autoplayDuration:<?php echo $roundabout_pause_time; ?>,
					autoplayPauseOnHover:true,
					minOpacity:1,
					duration: <?php echo $roundabout_speed; ?>,
					easing: 'easeOutQuad',
					enableDrag: true,
					responsive:true		
				});
			
			});
        </script>
            
            
            <!-- SLIDER -->   
            <div class="row clearfix fullBG">
   
                    <div class="roundabout">
                        
                        <ul>
                            
							<?php while( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
                            <li>
                                
								<?php $slide_caption_title=get_post_meta($post->ID, 'official_slide_caption_title', true); ?>
								<?php $slide_url=get_post_meta($post->ID, 'official_slide_url', true); ?>
                            	<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full'); ?> 
                                
                                <?php if ($slide_url!=''){ echo '<a href="'.$slide_url.'">'; }?>
                                	<img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>" />
                                <?php if ($slide_url!=''){ echo '</a>'; }?>
                                
                            </li>
                            <?php endwhile;?>
                        </ul>
                        
                    </div>

            </div><!-- container -->
            
            
            
	<?php endif; wp_reset_query(); ?>
	