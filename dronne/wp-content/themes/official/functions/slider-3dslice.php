<?php
/*
Template For 3D Slice Slider
Tohid Golkar 3D Slice for Wordpress
v1.0
*/
?>			

	<?php 
		
		$number_of_slides = _option( 'slider_number_of_slides', 5 );

		$slide_args = array( 
			'post_type' => 'slide',
			'slider_types' => '3d-slice-slider',
			'posts_per_page' => $number_of_slides,
			'paged' => 1,
			'order' => 'ASC',
			'orderby' => 'menu_order',
		);

		$wp_query = null;
		$wp_query = new WP_Query();
		$wp_query->query( $slide_args );
	?>

	<?php if( $wp_query->have_posts() ) :  ?>    

    <?php wp_enqueue_script('jquery.custom.modernizr', get_template_directory_uri() . '/js/modernizr.custom.46884.js','2.6.2',true); ?>         
    <?php wp_enqueue_script('jquery.slicebox', get_template_directory_uri() . '/js/jquery.slicebox.js','1.1',true); ?> 
         

		<script language="javascript">


			jQuery(function($) {
			var Page = (function() {

				var $navArrows = $( '#nav-arrows' ),
					$shadow = $( '#shadow' ).hide(),
					slicebox = $( '#sb-slider' ).slicebox( {
						onReady : function() {

							$shadow.show();

						},
						// (v)ertical, (h)orizontal or (r)andom
						orientation : '<?php echo _option( 'slider_orientation', 'r' ); ?>',
						// number of slices / cuboids
						// needs to be an odd number 15 => number > 0 (if you want the limit higher, change the _validate function).
						cuboidsCount : 5,
						// if true then the number of slices / cuboids is going to be random (cuboidsCount is overwitten)
						cuboidsRandom : true,
						// animation speed
						// this is the speed that takes "1" cuboid to rotate
						speed : <?php echo _option( 'slider_speed', 700 ); ?>,
						// transition easing
						easing : 'ease',
						// if true the slicebox will start the animation automatically
						autoplay : true,
						// time (ms) between each rotation, if autoplay is true
						interval: <?php echo _option( 'slider_pause_time', 4000 ); ?>,
					} ),
					
					init = function() {

						initEvents();
						
					},
					initEvents = function() {

						// add navigation events
						$navArrows.children( ':first' ).on( 'click', function() {
							
							slicebox.next();
							return false;

						} );

						$navArrows.children( ':last' ).on( 'click', function() {
							
							slicebox.previous();
							return false;

						} );

					};

					return { init : init };

			})();

			Page.init();
		});
        </script>
            
            
            <!-- SLIDER --> 
            <div class="row clearfix fullBG"> 
            <div class="sliderr">

                    <div class="myslicebox clearfix">
                        
                        <ul id="sb-slider" class="sb-slider <?php if (_option("slice_rounded",1)==1){echo 'sbrad';}; ?> <?php if (_option("slice_border",0)==1){echo 'sbborder';}; ?>">
                            
                            <?php while( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
							<li>
                            	
								<?php $slide_caption_title=get_post_meta($post->ID, 'official_slide_caption_title', true); ?>
                                <?php $slide_caption_text=get_post_meta($post->ID, 'official_slide_caption_text', true); ?>
                                <?php $slide_url=get_post_meta($post->ID, 'official_slide_url', true); ?>
                            
                            	<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'photo_slider'); ?>
                                
                                <?php if ($slide_url!=''){ echo '<a href="'.$slide_url.'">'; }?>
                                	<img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>" />
                                <?php if ($slide_url!=''){ echo '</a>'; }?>
                                	
                                <?php if ($slide_caption_title || $slide_caption_text ){?>
                                    <div class="sb-description">
                                        <h3><?php echo $slide_caption_title ; ?><span><?php echo $slide_caption_text ; ?></span></h3>
                                        
                                    </div>
             					<?php } ?>
                            </li>
                            <?php endwhile; ?>
                            
                            
                        </ul>
                        
                        <?php if (_option('slice_shadow',1)==1):?>
                        <div id="shadow" class="shadow"></div>
                        <?php endif; ?>
                        
                        <div id="nav-arrows" class="nav-arrows <?php if (_option("slice_rounded",1)==1){echo 'sbrad';}; ?>">
                            <a href="#"><i class="icon-angle-right"></i></a>
                            <a href="#"><i class="icon-angle-left"></i></a>
                        </div>
                        
                    </div>
                    
                             
                    
                    

            </div>
            </div>
            
            
	<?php endif;  wp_reset_query();?>
	