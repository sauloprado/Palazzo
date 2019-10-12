<?php
/*
Template For Lite Accordion Slider
Tohid Golkar Lite Accordion for Wordpress
v1.0
*/
?>			

	<?php 
		
		$number_of_slides = _option( 'slider_number_of_slides', 5 );
		$slider_shadow = _option( 'slider_shadow', 1 );
		$acc_height = _option( 'acc_height', 300 );
		$acc_theme = _option( 'acc_theme', 'flat' );
		$acc_width = 1030; 
		
		if ($acc_theme=='basic'){$acc_width = 1050;$acc_height=$acc_height+10;}
		
		$slide_args = array( 
			'post_type' => 'slide',
			'slider_types' => 'lite-accordion-slider',
			'posts_per_page' => $number_of_slides,
			'paged' => 1,
			'order' => 'DESC',
			'orderby' => 'menu_order',
		);
		
		//$temp = $wp_query;
		$wp_query = null;
		$wp_query = new WP_Query();
		$wp_query->query( $slide_args );
	?>

	<?php if( $wp_query->have_posts() ) :  ?>    
    <?php wp_enqueue_style( 'liteaccordion', get_template_directory_uri() . '/styles/accordion-slider/liteaccordion.css', array(), '1.1', 'all' ); ?>
    <?php wp_enqueue_script('jquery.liteaccordion', get_template_directory_uri() . '/js/liteaccordion.jquery.min.js','jquery','2.2.0'); ?>   

         
	
		<script language="javascript">
			jQuery(document).ready(function($) {

				$('#ACCslider').liteAccordion({
						onTriggerSlide : function() {
							this.find('figcaption').fadeOut();
						},
						onSlideAnimComplete : function() {
							this.find('figcaption').fadeIn();
						},
						containerWidth:<?php echo $acc_width; ?>,
						containerHeight:<?php echo $acc_height; ?>,
						headerWidth:48,
						cycleSpeed : <?php echo _option( 'slider_pause_time', 4000 ); ?>,
						slideSpeed : <?php echo _option( 'slider_speed', 700 ); ?>,
						activateOn : 'click', // Or mouseover
						autoPlay : false,
						pauseOnHover : true,
						rounded : false,
						enumerateSlides : true,
						theme : '<?php echo $acc_theme; ?>',
						easing: 'easeOutExpo'
				}).find('figcaption:first').show();
		
			});
        </script>
            
            
            <!-- SLIDER -->   
            <div class="row clearfix fullBG">
    
                    <div id="ACCslider">
                        
                        <ol>
                            
                            <?php while( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
                            <li>
                            	<?php $slide_caption_title=get_post_meta($post->ID, 'official_slide_caption_title', true); ?>
                                <?php $slide_caption_text=get_post_meta($post->ID, 'official_slide_caption_text', true); ?>
                                <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full'); ?>
                                <?php $slide_url=get_post_meta($post->ID, 'official_slide_url', true); ?>
                                
                                <h2><span><?php if ($slide_caption_title!=''){echo $slide_caption_title;}else{ the_title(); } ?></span></h2>
                                <div>
                                    <figure>
                                        <?php if ($slide_url!=''){ echo '<a href="'.$slide_url.'">'; }?>
                                        	<img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>" />
										<?php if ($slide_url!=''){ echo '</a>'; }?>
                                        <?php if ($slide_caption_text) {?>
                                        	<figcaption class="ap-caption"><?php echo $slide_caption_text; ?></figcaption>
                                        <?php } ?>
                                    </figure>
                                </div>
                            </li>
                            <?php endwhile;?>
                            
                        </ol>
                        
                    </div>
                             
            </div><!-- container -->
            
            
            
	<?php endif; wp_reset_query();  ?>
	