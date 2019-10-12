<?php
/*
Template For Nivo Slider
*/
?>			

	<?php 
		
		$number_of_slides = _option( 'slider_number_of_slides', 5 );
		$slider_shadow = _option( 'slider_shadow', 1 );
		$cap_html = "";
		
		$slide_args = array( 
			'post_type' => 'slide',
			'slider_types' => 'nivo-slider',
			'posts_per_page' => $number_of_slides,
			'paged' => 1,
			'order' => 'ASC',
			'orderby' => 'menu_order',
		);
		
		$wp_query = new WP_Query();
		$wp_query->query( $slide_args );
	?>

	<?php if( $wp_query->have_posts() ) :  ?>            
    <?php wp_enqueue_script('jquery.nivoslider', get_template_directory_uri() . '/js/jquery.nivo.slider.pack.js'); ?>  

    <link rel="stylesheet" id="nivo-css"  href="<?php echo get_template_directory_uri(); ?>/styles/nivo-slider/default/default.css" type="text/css" media="all" />
	
		<script language="javascript">
			jQuery(document).ready(function($) {
				
				// Nivo Slider //////////////////
				try {
					$('#nivo-slider').nivoSlider({
						   animSpeed: <?php echo _option( 'slider_speed', 900 ); ?>,
						   pauseTime: <?php echo _option( 'slider_pause_time', 5000 ); ?>
					});
					} catch(e){}

			});
        </script>
            
            
            <!-- SLIDER --> 
            <div class="sliderr">
				<div class="theme-default nivo-<?php if(_option('nivo_slider_style', 'full')=='full'){echo 'full';}else{echo 'boxed row';} ?> clearfix ">
					
                    <div id="nivo-slider" class="nivoSlider nivo-<?php echo _option('nivo_slider_shadow', 'noshadow') ?>">
                    
                    <?php while( $wp_query->have_posts() ) : $wp_query->the_post(); ?>    
                    	
                         <?php /* Tohid Golkar's Nivo Slider for Wordpress */ ?>
                         <?php $slide_url=get_post_meta($post->ID, 'official_slide_url', true); ?>
                         <?php $slide_caption_title=get_post_meta($post->ID, 'official_slide_caption_title', true); ?>
						 <?php $slide_caption_text=get_post_meta($post->ID, 'official_slide_caption_text', true); ?>

                         <?php if($slide_caption_text ){
							 
							$cap_html .= '<div id="cap-'. $post->ID .'" class="nivo-html-caption capinside">' . $slide_caption_text . '</div>';
							 
							}
							
							$thumb_attr = array (
								"alt"=>$slide_caption_title,
								"title"=>'#cap-'. $post->ID
							);
						 
						?>
                            
                        <?php if( has_post_thumbnail() ) : ?>
                        	<?php if ($slide_url!=''){ echo '<a href="'.$slide_url.'">'; }?>
                        		<?php the_post_thumbnail('photo_slider',$thumb_attr); ?>
                            <?php if ($slide_url!=''){ echo '</a>'; }?>    
                        <?php endif; ?>
                        
                    <?php endwhile;  ?> 
                    
                     </div><!-- End Nivoslider -->
                     
                     
                  	<?php echo $cap_html;  ?>
  

            </div>
            </div>
            <!-- End SLIDER --> 
            
	<?php endif; wp_reset_query();?>