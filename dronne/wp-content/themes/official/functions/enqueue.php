<?php

//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
// Scripts Enqueue
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
function official_scripts_enqueue() {  
	


	// Register Scripts ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
	wp_register_script('jquery.theme20', get_template_directory_uri() . '/js/theme20.js','jquery','1.0');
	wp_register_script('jquery.owlcarousel', get_template_directory_uri() . '/js/owl.carousel.min.js','jquery','2.0.0');
	wp_register_script('jquery.flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js','jquery','2.1'); 
	wp_register_script('jquery.prettyPhoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.js','jquery','3.1', true);
	wp_register_script('jquery.tweet', get_template_directory_uri() . '/js/twitter/jquery.tweet.js','jquery','1.2', true );
	wp_register_script('official-custom', get_template_directory_uri() . '/js/custom.js','jquery','1.0', true); 
	wp_register_script('jquery.quicksand', get_template_directory_uri() . '/js/jquery.quicksand.js','jquery','1.2.2', true);
	wp_register_script('jquery.easing', get_template_directory_uri() . '/js/jquery.easing.1.3.pack.js','jquery','1.3'); 
	wp_register_script('jquery.jplayer', get_template_directory_uri() . '/js/jquery.jplayer.min.js','jquery','2.4.0', true);
	wp_register_script('jquery.masonry', get_template_directory_uri() . '/js/jquery.masonry.pkgd.min.js','jquery','3.1.5');
	
	
	// Enqueue Scripts ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery.theme20');
	wp_enqueue_script('jquery.flexslider');
	wp_enqueue_script('jquery.owlcarousel');
	wp_enqueue_script('jquery.prettyPhoto');
	wp_enqueue_script('jquery.tweet');
	wp_enqueue_script('official-custom');
	
	
	
	
    // Comment Reply Script
    if ( is_singular()){wp_enqueue_script('comment-reply');} 
    
	
 
 	// Portfolio Scripts 
	if( is_page_template('portfolio1.php') || is_page_template('portfolio2.php') || is_page_template('portfolio3.php') || is_page_template('portfolio4.php') || is_page_template('portfolio4-masonry.php') || is_page_template('portfolio3-masonry.php') || is_page_template('portfolio5-masonry.php') || is_page_template('portfolio2-masonry.php') || get_post_type() == 'portfolio') {

		wp_enqueue_script('jquery.quicksand');
		
	}
	

}

add_action( 'wp_enqueue_scripts', 'official_scripts_enqueue' );  





//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
// Register Styles
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
	
function official_styles_enqueue()  
{  



	// Register Styles :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
	wp_register_style( 'jplayer', get_template_directory_uri() . '/styles/jplayer.css', array(), '1.0', 'all' );
	wp_register_style( 'animate', get_template_directory_uri() . '/styles/animate.css', array(), '1.0', 'all' );
	wp_register_style( 'icons', get_template_directory_uri() . '/styles/icons.css', array(), '1.0', 'all' );
	wp_register_style( 'responsive', get_template_directory_uri() . '/styles/responsive.css', array(), '1.0', 'all' );
	wp_register_style( 'rtl', get_template_directory_uri() . '/styles/rtl.css', array(), '1.0', 'all' );
	wp_register_style( 'darkstyle', get_template_directory_uri() . '/styles/dark.css', array(), '1.0', 'all' );
	
	
	
	
	// Enqueue Default CSSs
	wp_enqueue_style( 'stylesheet', get_stylesheet_uri(), array(), TG_THEME_VERSION, 'all' );
	wp_enqueue_style( 'icons' );

	
	// WooCommerce
	if (function_exists( 'is_woocommerce' )){
		wp_register_style( 'wooshop', get_template_directory_uri() . '/styles/shop.css', array(), '1.0', 'all' );
		wp_enqueue_style( 'wooshop' );
		wp_register_style( 'flaticon', get_template_directory_uri() . '/styles/flaticon/flaticon.css', array(), '1.0', 'all' );
		wp_enqueue_style( 'flaticon' );
		} 
	
	// bbPress
	if(function_exists('is_bbpress')) {
		wp_register_style( 'custom_bbp', get_template_directory_uri() . '/styles/bbp.css', array(), '1.0', 'all' );
		wp_enqueue_style( 'custom_bbp' );
	}
	
	//EventOn
	if( function_exists('add_eventon')) {
		wp_register_style( 'custom_eventon', get_template_directory_uri() . '/styles/eventon.css', array(), '1.0', 'all' );
        wp_enqueue_style( 'custom_eventon' );
	}

	/* Dark Style */
	if(_option('dark_style',0)==1){
		wp_enqueue_style( 'darkstyle' ); 
	}
	
	
	/* Animate */
	if (_option('animate',1)==1){
		wp_enqueue_style( 'animate' ); 
	}
	
	/* Responsive */
	if (_option('responsive',1)==1){
		wp_enqueue_style( 'responsive' ); 
	}
	
	
     
     /* RTL */
     if (is_rtl() || _option('rtl_support')){
		wp_enqueue_style( 'rtl' );
	 }
	
	
	
}  


add_action( 'wp_enqueue_scripts', 'official_styles_enqueue', 1 ); 




//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
// Lightbox Enqueue
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
function official_lightbox(){
?>

<script type="text/javascript">
function _lightbox(){
		var lbarray = {			
			
			<?php if(_option("lb_animation_speed")): ?>
			animation_speed: '<?php echo strtolower(_option("lb_animation_speed")); ?>',
			<?php endif; ?>
			overlay_gallery: <?php if(_option("lb_gallery")) { echo 'true'; } else { echo 'false'; } ?>,
			autoplay_slideshow: <?php if(_option("lb_autoplay")) { echo 'true'; } else { echo 'false'; } ?>,
			<?php if(_option("lb_slideshow_speed")): ?>
			slideshow: <?php echo _option('lb_slideshow_speed'); ?>,
			<?php endif; ?>
			<?php if(_option("lb_theme")): ?>
			theme: '<?php echo _option('lb_theme'); ?>', 
			<?php endif; ?>
			<?php if(_option("lb_opacity")): ?>
			opacity: <?php echo _option('lb_opacity'); ?>,
			<?php endif; ?>
			show_title: <?php if(_option("lb_title")) { echo 'true'; } else { echo 'false'; } ?>,
			<?php if(!_option("lb_social")) { echo 'social_tools: "",'; } ?>
			allow_resize: <?php if(_option("lb_resize")) { echo 'true'; } else { echo 'false'; } ?>,
			<?php if(_option("lb_sep")): ?>
			counter_separator_label: ' <?php echo _option('lb_sep'); ?> ',
			<?php endif; ?>
			deeplinking: false,
			default_width: 900,
			default_height: 500
		};

		var slctr='a[data-gal^="photo"],a[href$=jpg], a[href$=JPG], a[href$=jpeg], a[href$=JPEG], a[href$=png], a[href$=gif], a[href$=bmp]:has(img), a[class^="prettyPhoto"]';
		//var slctr='a[data-gal^="photo"]';

		jQuery(slctr).prettyPhoto();
		
		<?php if(_option("lb_small") == 1): ?>
		var windowWidth = 	window.screen.width < window.outerWidth ?
                  			window.screen.width : window.outerWidth;
        var issmall = windowWidth < 500;
        
        if(issmall){
	      
        	jQuery(slctr).unbind('click.prettyphoto');
		}
        <?php endif; ?>
		
	}
	
	

    _lightbox();


</script>

<?php 

} 


add_action( 'wp_footer', 'official_lightbox',99 );  


//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
// Custom JS and Track Code
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
function official_cutoms_javascript() {

	
		if(_option('custom_js')){
	
			echo '<script type="text/javascript">';
			echo _option('custom_js');
			echo '</script>';
		}
		
		
		if(_option('track_code')){
			echo '<script type="text/javascript">';
			echo _option('track_code');
			echo '</script>';
		}
			
	}


add_action( 'wp_footer', 'official_cutoms_javascript' ,100); 

?>