<?php

/*
 * Official Theme Functions
 *
 * Author: ThemeTor.com
 * Website: http://themetor.com
 */


// PUBLIC DEFINES ================================================================================================
define('THEME_DIR', get_template_directory());
define('THEME_URI', get_template_directory_uri());

define('LIBS_DIR', THEME_DIR. '/functions');
define('LIBS_URI', THEME_URI. '/functions');
define('LANG_DIR', THEME_DIR. '/lang');

define('TG_THEME_NAME', 'Official');
define('TG_THEME_VERSION', '1.5');
define('TG_THEME_EXTERNAL_FILES', 'http://demo.themetor.com/official/files/q3t8d/');


// Loads Theme Textdomain (Localization) ==============================================================================
load_theme_textdomain( 'official', LANG_DIR );


// Content Width ======================================================================================================
if ( ! isset( $content_width ) ) $content_width = 1080;

function official_adjust_content_width() {
    global $content_width;
 
    if ( is_page_template( 'page-left-sidebar.php' ) || is_page_template( 'page-right-sidebar.php' ) || is_page_template( 'blog-small.php' ) || is_page_template( 'blog-medium.php' ) || is_page_template( 'blog-large.php' )){
        $content_width = 790;
	}
}
add_action( 'template_redirect', 'official_adjust_content_width' );




// Options Framework Theme ==========================================================================================
if ( !function_exists( 'optionsframework_init' ) ) {

	define('OPTIONS_FRAMEWORK_URL', THEME_DIR . '/admin/');
	define('OPTIONS_FRAMEWORK_DIRECTORY', THEME_URI  . '/admin/');
		
	require_once (OPTIONS_FRAMEWORK_URL . 'options-framework.php');

}



// Plugins Activation ===========================================================================================
require_once('functions/plugin-activation.php');
	
	add_action('tgmpa_register', 'official_register_required_plugins');
	function official_register_required_plugins() {
		$plugins = array(
			array(
				'name'     				=> 'Slider Revolution',
				'slug'     				=> 'revslider',
				'source'   				=> TG_THEME_EXTERNAL_FILES . 'plugins/revslider.zip',
				'required' 				=> false,
				'version' 				=> '',
				'force_activation' 		=> false,
				'force_deactivation' 	=> false,
				'external_url' 			=> '', 
			),
			array(
				'name'     				=> 'Visual Composer',
				'slug'     				=> 'js_composer',
				'source'   				=> TG_THEME_EXTERNAL_FILES . 'plugins/js_composer.zip',
				'required' 				=> false,
				'version' 				=> '',
				'force_activation' 		=> false,
				'force_deactivation' 	=> false,
				'external_url' 			=> '', 
			),
			array(
            	'name'      => 'Contact Form 7',
            	'slug'      => 'contact-form-7',
            	'required'  => false,
            ),
		);

		$theme_text_domain = 'official';

		$config = array(
			'domain'       		=> $theme_text_domain,
			'default_path' 		=> '',
			'parent_menu_slug' 	=> 'themes.php',
			'parent_url_slug' 	=> 'themes.php',
			'menu'         		=> 'install-required-plugins',
			'has_notices'      	=> true,
			'is_automatic'    	=> true,
			'message' 			=> '',
			'strings'      		=> array(
				'page_title'                       			=> __( 'Install Required Plugins', $theme_text_domain ),
				'menu_title'                       			=> __( 'Install Plugins', $theme_text_domain ),
				'installing'                       			=> __( 'Installing Plugin: %s', $theme_text_domain ),
				'oops'                             			=> __( 'Something went wrong with the plugin API.', $theme_text_domain ),
				'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
				'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
				'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
				'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
				'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
				'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
				'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
				'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
				'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
				'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
				'return'                           			=> __( 'Return to Required Plugins Installer', $theme_text_domain ),
				'plugin_activated'                 			=> __( 'Plugin activated successfully.', $theme_text_domain ),
				'complete' 									=> __( 'All plugins installed and activated successfully. %s', $theme_text_domain ),
				'nag_type'									=> 'updated'
			)
		);
	
		tgmpa($plugins, $config);
		
	}
	
	




	
// Automatic Feed Links ===========================================================================================
if(function_exists('add_theme_support')) {
    add_theme_support('automatic-feed-links');
}


// WP Post Formats=================================================================================================
add_theme_support( 'post-formats', array('gallery', 'quote', 'audio', 'video'));
	
	

// enqueue ========================================================================================================
require_once(LIBS_DIR.'/enqueue.php');




// Loads Breadcrumbs ==============================================================================================
require_once(LIBS_DIR.'/breadcrumbs.php');




// Shortcodes =====================================================================================================

require_once ( LIBS_DIR.'/shortcodes/tinymce-class.php' );	
require_once ( LIBS_DIR.'/shortcodes.php' );
add_filter('widget_text', 'do_shortcode');
add_filter('wp_nav_menu', 'do_shortcode');

// Visual Composer
if ( function_exists( 'vc_map' ) ) {
	require_once(LIBS_DIR.'/vc/vc-custom.php');
}
	

// Custom Styles ==================================================================================================
include_once(LIBS_DIR.'/custom-styles.php');
 
 


// Custom Nav Menu Walker =========================================================================================
include_once( LIBS_DIR.'/custom-menu.php' );



// Custom Widgets =================================================================================================

require_once(LIBS_DIR.'/widgets/widget-contact.php');
require_once(LIBS_DIR.'/widgets/widget-embed.php');
require_once(LIBS_DIR.'/widgets/widget-flickr.php');
require_once(LIBS_DIR.'/widgets/widget-twitter.php');
require_once(LIBS_DIR.'/widgets/widget-ads.php');
require_once(LIBS_DIR.'/widgets/widget-combo-tabs.php');
require_once(LIBS_DIR.'/widgets/widget-facebook.php');
require_once(LIBS_DIR.'/widgets/widget-portfolio.php');
require_once(LIBS_DIR.'/widgets/widget-subscription.php');





// Custom Post Type ===============================================================================================
require_once(LIBS_DIR.'/custom-posttype.php');




// Customizer  ===========================================================================================	
require_once(LIBS_DIR.'/customize.php');



// Include Meta Box Script ========================================================================================
define( 'RWMB_URL', trailingslashit( LIBS_URI . '/metabox' ) );
define( 'RWMB_DIR', trailingslashit( LIBS_DIR . '/metabox' ) );
require_once RWMB_DIR . '/meta-box.php';
require_once(LIBS_DIR.'/metabox.php');


// Post Thumbnails ================================================================================================
if ( function_exists( 'add_theme_support' ) ) {
	
	add_theme_support( 'post-thumbnails' );
	
	// 1060x9999
	add_image_size( 'fullwidth', 1060, 9999, false );
	add_image_size( 'blog3', 1060, 9999, false );
	add_image_size( 'portfolio3', 1060, 9999, false );
	
	//1060x460 (cropped)
	add_image_size( 'fullwidthcrop', 1060, 460, true );
	add_image_size( 'blog3c', 1060, 460, true );
	add_image_size( 'portfolio-full', 1060, 460, true );

	// Blog
	add_image_size( 'blog1', 420, 9999, false );
	add_image_size( 'blog1c', 420, 170, true );
	add_image_size( 'blog2', 790, 9999, false );
	
	// 790x320 (cropped)
	add_image_size( 'blog2c', 790, 320, true );
	add_image_size( 'portfolio2', 790, 320, true );
	
	
	// PORTFOLIO
	add_image_size( 'portfolio1', 500, 360, true );
	

	//Testimonial
	add_image_size( 'testimonial', 32, 32, true );

}




// Custom Navigation Menu =============================================================================
if ( function_exists( 'register_nav_menus' ) ) {
	register_nav_menus(
		array(
		  'primary' => 'Main Menu'
		)
	);
	
	register_nav_menus(
		array(
		  'secondary' => 'Footer Menu'
		)
	);
	
	register_nav_menus(
		array(
		  'onepage' => 'One Page'
		)
	);
	
}	


// Custom WPML Language Selector ==================================================================================	
if (function_exists('icl_get_languages')){
	require_once(LIBS_DIR.'/wpml.php');
	}

// Sidebars =======================================================================================================
include_once(LIBS_DIR.'/unlimited_sidebars.php');

register_sidebar(
	array(
		'name' => 'Blog Sidebar',
		'id' => 'sidebar-blog',
		'description'   => __( 'Widgets for the Blog sidebar.','official' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',  
	    'after_widget' => '</div>',  
	    'before_title' => '<h3 class="col-title">',  
	    'after_title' => '</h3><span class="liner"></span>'  
	));

register_sidebar(
	array(
		'name' => 'Second Blog Sidebar',
		'id' => 'sidebar-blog2',
		'description'   => __( 'Widgets for the Blog second sidebar.','official' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',  
	    'after_widget' => '</div>',  
	    'before_title' => '<h3 class="col-title">',  
	    'after_title' => '</h3><span class="liner"></span>'   
	));
	
register_sidebar(
	array(
		'name' => 'Page Sidebar',
		'id' => 'sidebar-page',
		'description'   => __( 'Widgets for the Pages sidebar.','official' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',  
	    'after_widget' => '</div>',  
	    'before_title' => '<h3 class="col-title">',  
	    'after_title' => '</h3><span class="liner"></span>' 
	));		

register_sidebar(
	array(
		'name' => 'Portfolio Details Sidebar',
		'id' => 'sidebar-portfolio',
		'description'   => __( 'Widgets for the Portfolio Details sidebar.','official' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',  
	    'after_widget' => '</div>',  
	    'before_title' => '<h3 class="col-title">',  
	    'after_title' => '</h3><span class="liner"></span>'   
	));

// Set Footer Widget Dynamic by Option value
$fw_desc = array(1 => 'Add only 1 Widget',2 => 'Add 2 Widgets',3 => 'Add 3 Widgets',4 => 'Add 4 Widgets');
$fw_class = array(1 => 'grid_12',2 => 'grid_6',3 => 'grid_4',4 => 'grid_3');
$footer_columns = 4;
if ( function_exists( '_option' ) ) {$footer_columns = _option('footer_col',4);}


$fw_desc_full = 'Widgets for the Footer. (' . $fw_desc[$footer_columns] . ')';

register_sidebar(
	array(
		'name' => 'Footer Widgets',
		'id' => 'footer_widgets',
		'description'   =>  $fw_desc_full,
		'before_widget' => '<div id="%1$s" class="footer_widget %2$s ' . $fw_class[$footer_columns] . '">',  
	    'after_widget' => '</div>',  
	    'before_title' => '<h3 class="col-title">',  
	    'after_title' => '</h3><span class="liner"></span>'
	));
	
register_sidebar(
	array(
		'name' => 'Search Page Sidebar',
		'id' => 'sidebar-search',
		'description'   => __( 'Widgets for the Search Page sidebar.','official' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',  
	    'after_widget' => '</div>',  
	    'before_title' => '<h3 class="col-title">',  
	    'after_title' => '</h3><span class="liner"></span>'   
	));


register_sidebar(
	array(
		'name' => 'Shop Page Sidebar',
		'id' => 'sidebar-shop',
		'description'   => __( 'Widgets for the Shop Page sidebar.','official' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',  
	    'after_widget' => '</div>',  
	    'before_title' => '<h3 class="col-title">',  
	    'after_title' => '</h3><span class="liner"></span>' 
	));


// Set Extra Panel Widget Dynamic by Option value
$epw_desc = array(1 => 'Add only 1 Widget',2 => 'Add 2 Widgets',3 => 'Add 3 Widgets',4 => 'Add 4 Widgets');
$epw_class = array(1 => 'grid_12',2 => 'grid_6',3 => 'grid_4',4 => 'grid_3');
$ep_columns = 3;
if ( function_exists( '_option' ) ) {$ep_columns = _option('extrapanel_col',3);}

$epw_desc_full = 'Widgets for the Extra Panel. (' . $epw_desc[$ep_columns] . ')';

register_sidebar(
	array(
		'name' => 'Extra Panel Widgets',
		'id' => 'extrapanel_widgets',
		'description'   =>  $epw_desc_full,
		'before_widget' => '<div id="%1$s" class="ep_widget %2$s ' . $fw_class[$ep_columns] . '">',  
	    'after_widget' => '</div>',  
	    'before_title' => '<h3 class="col-title">',  
	    'after_title' => '</h3><span class="liner"></span>'
	));
	
function thdglkr_emptysidebar($section)
{
	echo '<h3 class="col-title">No Sidebar</h3><span class="liner"></span> This template supports the unlimited sidebar\'s widgets. <br />For adding widgets to <strong>'. $section .'</strong> sidebar <a href="'. home_url() .'/wp-admin/widgets.php">Click Here</a> ';	
}




// WooCommerce  ===========================================================================================	

add_theme_support('woocommerce');	
include_once( get_template_directory() . '/functions/wooconfig.php' );




// Custom Excerpt Length  ===========================================================================================
	
	function excerpt($limit) {
      $excerpt = explode(' ', get_the_excerpt(), $limit);
      if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).'...';
      } else {
        $excerpt = implode(" ",$excerpt);
      } 
      $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
      return $excerpt;
    }

    function content($limit) {
      $content = explode(' ', get_the_content(), $limit);
      if (count($content)>=$limit) {
        array_pop($content);
        $content = implode(" ",$content).'...';
      } else {
        $content = implode(" ",$content);
      } 
      $content = preg_replace('/\[.+\]/','', $content);
      $content = apply_filters('the_content', $content); 
      $content = str_replace(']]>', ']]&gt;', $content);
      return $content;
    }

	function custom_excerpt_more($more) {
		return '...';
	}


// Nice Scroll  =========================================================================================
require_once(LIBS_DIR.'/nicescroll.php');



// Add Class to Avatar  =================================================================================
add_filter('get_avatar','change_avatar_css');

function change_avatar_css($class) {
$class = str_replace("class='avatar avatar-130", "class='fll image-author-big ", $class) ;
$class = str_replace("class='avatar avatar-80", "class='image-author ", $class) ;
return $class;
}


// Remove the Hight and Width from Slider for Responsive purpose ========================================
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10, 4 );

function remove_thumbnail_dimensions( $html, $post_id, $post_image_id,$post_thumbnail ) {
	
	if ($post_thumbnail==='photo_slider'){
    	$html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
	}
    return $html;

}

// PrettyPhoto Gallery Link change  ======================================================================
add_filter('wp_get_attachment_link', 'tt_pretty_photo');
function tt_pretty_photo($content) {
	$content = preg_replace("/<a/","<a data-gal=\"photo[gallery]\"",$content,1);
	return $content;
}

// Pagination  ===========================================================================================	

function pagination($pages = '', $range = 4)
{  

	 $showitems = ($range * 2)+1;  

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   

     if(1 != $pages)
     {
         echo "<div class='pagination-tt clearfix'><ul>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link(1)."'>&laquo; First</a></li>";
         if($paged > 1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a></li>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<li><span>".$i."</span></li>":"<li><a href='".get_pagenum_link($i)."' >".$i."</a></li>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged + 1)."'>Next &rsaquo;</a></li>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($pages)."'>Last &raquo;</a></li>";
         echo "</ul></div>\n";
     }
}



// MAINTENANCE MODE =====================================================================================	

	if (!function_exists('themetor_maintenance_mode')) {
		
		function themetor_maintenance_mode() {

			$custom_logo = $custom_logo_output = $maintenance_mode = "";
			
			$custom_logo = _option('logo');
			$custom_logo_output = '<img src="'. $custom_logo .'" alt="maintenance" style="margin: 0 auto; display: block;" />';


			$main_page = _option('main_page','default');

			if ($main_page == 'default') {
				
				if ( !current_user_can( 'edit_themes' ) || !is_user_logged_in() ) {
		    	    wp_die($custom_logo_output . do_shortcode(_option('main_html','<p style="text-align:center">'.__('We are currently in maintenance mode, please check back shortly.', 'official').'</p>')));
		    	}

		    } else {
		    	
				$holding_page = _option('main_page');
			    $current_page_URL = themetor_current_page_url();
			    $holding_page_URL = get_permalink($holding_page);
			    
			    if ($current_page_URL != $holding_page_URL) {
			    	if ( !current_user_can( 'edit_themes' ) || !is_user_logged_in() ) {
			    	wp_redirect( $holding_page_URL );
			    	exit;
			    	}
			    }
				
		    }
		}
		
		if (_option('main_mode',0)==1){
			add_action('get_header', 'themetor_maintenance_mode');
		}
		
	}
	
	
	// GET CURRENT PAGE URL 
	function themetor_current_page_url() {
		$pageURL = 'http';
		if( isset($_SERVER["HTTPS"]) ) {
			if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		}
		$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		return $pageURL;
	}


?>