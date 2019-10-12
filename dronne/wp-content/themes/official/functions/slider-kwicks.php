<?php
/*
Template For Kwicks Slider
Tohid Golkar Kwicks Slider for Wordpress
v1.0
*/
?>			

	<?php 
		
		$number_of_slides = _option( 'slider_number_of_slides', 5 );
		$slider_shadow = _option( 'slider_shadow', 1 );
		
		
		$slide_args = array( 
			'post_type' => 'slide',
			'slider_types' => 'kwick-slider',
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
    <?php wp_enqueue_script('jquery.kwickslider', get_template_directory_uri() . '/js/jquery.kwicks.min.js','2.1',true); ?> 
    <?php wp_enqueue_style( 'kwickslider', get_template_directory_uri() . '/styles/kwicks.css', array(), '1.0', 'all' ); ?>      
	
		<script language="javascript">
			jQuery(document).ready(function($) {
				try {
					$('.kwicks').kwicks({
						maxSize : <?php echo _option( 'kwick_maxsize', 750 ); ?>,
						spacing : <?php echo _option( 'kwick_spacing', 0 ); ?>,
						behavior: 'menu'
					});
				} catch(e){}
			});
        </script>
            
            
            <!-- SLIDER -->   
            <div class="row clearfix fullBG">
    
                     <div class="kwickslider kwick_<?php echo $number_of_slides; ?>_col">
                        
                        <ul class="kwicks kwicks-horizontal <?php if (_option("kwicks_rounded",1)==1){echo 'rad';}; ?>">
                            
							<?php $i = 1; $str_style=""; ?>
                            
                            <?php while( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
								
								
                                <li id="kwick<?php echo $i; ?>">
                                
                                	<?php $slide_url=get_post_meta($post->ID, 'official_slide_url', true); ?>
                                    <?php if ($slide_url!=''){ echo '<a href="'.$slide_url.'">'; }?>
                                        
                                    <?php $slide_caption_title=get_post_meta($post->ID, 'official_slide_caption_title', true); ?>
                                    <?php $slide_caption_text=get_post_meta($post->ID, 'official_slide_caption_text', true); ?>	
         								
                                        <?php if ($slide_caption_title || $slide_caption_text ){?>
                                            <div class="kwick_caption">
                                                <h4><?php echo $slide_caption_title ; ?></h4>
                                                <div class="kwick_caption_text"><?php echo $slide_caption_text ; ?></div>
                                            </div>
      									<?php } ?>
                                    <?php if ($slide_url!=''){ echo '</a>'; }?>
                                </li>
                                
                                <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'photo_slider'); ?>
                                <?php $str_style .= "#kwick" . $i . "{background:url(". $image[0] .") center center;}" ?>
                    			<?php $i++;?>
                                
                            <?php endwhile; ?>
                            
                        </ul>
                        
                    </div>
                    
                    <style>
                    	<?php echo $str_style; ?>
						.kwickslider,.kwickslider ul,.kwickslider ul li{height:<?php echo _option( 'kwick_height', 315 ); ?>px;}
						.kwick_caption {width:<?php echo _option( 'kwick_maxsize', 750 ); ?>px;}
                    </style>
                   

            </div><!-- container -->
            
            
            
	<?php endif; wp_reset_query(); ?>
	