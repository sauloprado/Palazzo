<?php
/*
Description: A framework for building theme options.
Author: Devin Price
Author URI: http://www.wptheming.com
License: GPLv2
Version: 1.3
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

/* Make sure we don't expose any info if called directly */

if ( !function_exists( 'add_action' ) ) {
	echo "Hi there!  I'm just a little extension, don't mind me.";
	exit;
}

/* If the user can't edit theme options, no use running this plugin */

add_action('init', 'optionsframework_rolescheck' );

function optionsframework_rolescheck () {
	if ( current_user_can( 'edit_theme_options' ) ) {
		// If the user can edit theme options, let the fun begin!
		add_action( 'admin_menu', 'optionsframework_add_page');
		add_action( 'admin_init', 'optionsframework_init' );
		add_action( 'admin_init', 'optionsframework_mlu_init' );
		add_action( 'wp_before_admin_bar_render', 'optionsframework_adminbar' );
	}
}

/* Loads the file for option sanitization */

add_action('init', 'optionsframework_load_sanitization' );

function optionsframework_load_sanitization() {
	require_once dirname( __FILE__ ) . '/options-sanitize.php';
}

/* 
 * Creates the settings in the database by looping through the array
 * we supplied in options.php.  This is a neat way to do it since
 * we won't have to save settings for headers, descriptions, or arguments.
 *
 * Read more about the Settings API in the WordPress codex:
 * http://codex.wordpress.org/Settings_API
 *
 */

function optionsframework_init() {

	// Include the required files
	global $_thdglkr_of_name,$_thdglkr_of_id,$_thdglkr_cur_lang;
	$_thdglkr_of_name = 'optionsframework';
	$_thdglkr_of_id = 'official';
	$_thdglkr_cur_lang = '';
	
	
	if(defined('ICL_LANGUAGE_CODE')) {
		global $sitepress;
		if(ICL_LANGUAGE_CODE != 'all' && ICL_LANGUAGE_CODE != $sitepress->get_default_language()) {
			$_thdglkr_of_name = $_thdglkr_of_name.'_'.ICL_LANGUAGE_CODE;
			$_thdglkr_cur_lang = ICL_LANGUAGE_CODE;
			$_thdglkr_of_id = $_thdglkr_of_id.'_'.ICL_LANGUAGE_CODE;
		} else {
			$_thdglkr_cur_lang = $sitepress->get_default_language();
		}
			
	}
		
	$option_name = $_thdglkr_of_name;

	require_once dirname( __FILE__ ) . '/options-interface.php';
	require_once dirname( __FILE__ ) . '/options-medialibrary-uploader.php';
	
	// Loads the options array from the theme
	if ( $optionsfile = locate_template( array('options.php') ) ) {
		require_once($optionsfile);
	}
	else if (file_exists( dirname( __FILE__ ) . '/options.php' ) ) {
		require_once dirname( __FILE__ ) . '/options.php';
	}
	
	$optionsframework_settings = get_option($_thdglkr_of_name);
	
	// Updates the unique option id in the database if it has changed
	optionsframework_option_name();
	
	
	
	// Gets the unique id, returning a default if it isn't defined
	if ( isset($optionsframework_settings['id']) ) {
		$option_name = $optionsframework_settings['id'];
	}
	
	// If the option has no saved data, load the defaults
	if ( ! get_option($option_name) ) {
		optionsframework_setdefaults();
	}
	
	// Registers the settings fields and callback
	register_setting( $_thdglkr_of_name, $option_name, 'optionsframework_validate' );
	
	// Change the capability required to save the 'optionsframework' options group.
	add_filter( 'option_page_capability_optionsframework', 'optionsframework_page_capability' );
}


/**
 * Ensures that a user with the 'edit_theme_options' capability can actually set the options
 * See: http://core.trac.wordpress.org/ticket/14365
 *
 * @param string $capability The capability used for the page, which is manage_options by default.
 * @return string The capability to actually use.
 */

function optionsframework_page_capability( $capability ) {
	return 'edit_theme_options';
}

/* 
 * Adds default options to the database if they aren't already present.
 * May update this later to load only on plugin activation, or theme
 * activation since most people won't be editing the options.php
 * on a regular basis.
 *
 * http://codex.wordpress.org/Function_Reference/add_option
 *
 */

function optionsframework_setdefaults() {
	global $_thdglkr_of_name;
	$optionsframework_settings = get_option($_thdglkr_of_name);

	// Gets the unique option id
	$option_name = $optionsframework_settings['id'];
	
	/* 
	 * Each theme will hopefully have a unique id, and all of its options saved
	 * as a separate option set.  We need to track all of these option sets so
	 * it can be easily deleted if someone wishes to remove the plugin and
	 * its associated data.  No need to clutter the database.  
	 *
	 */
	
	if ( isset($optionsframework_settings['knownoptions']) ) {
		$knownoptions =  $optionsframework_settings['knownoptions'];
		if ( !in_array($option_name, $knownoptions) ) {
			array_push( $knownoptions, $option_name );
			$optionsframework_settings['knownoptions'] = $knownoptions;
			update_option($_thdglkr_of_name, $optionsframework_settings);
		}
	} else {
		$newoptionname = array($option_name);
		$optionsframework_settings['knownoptions'] = $newoptionname;
		update_option($_thdglkr_of_name, $optionsframework_settings);
	}
	
	// Gets the default options data from the array in options.php
	$options = optionsframework_options();
	
	// If the options haven't been added to the database yet, they are added now
	$values = of_get_default_values();
	
	if ( isset($values) ) {
		add_option( $option_name, $values ); // Add option with default settings
	}
}

/* Add a subpage called "Theme Options" to the appearance menu. */

if ( !function_exists( 'optionsframework_add_page' ) ) {

	function optionsframework_add_page() {
		$of_page = add_theme_page(__('Official Options', 'options_framework_theme'), __('Official Options', 'options_framework_theme'), 'edit_theme_options', 'options-framework','optionsframework_page');
		
		// Load the required CSS and javscript
		add_action('admin_enqueue_scripts', 'optionsframework_load_scripts');
		add_action( 'admin_print_styles-' . $of_page, 'optionsframework_load_styles' );
	}
	
}

/* Loads the CSS */

function optionsframework_load_styles() {
	wp_enqueue_style('optionsframework', OPTIONS_FRAMEWORK_DIRECTORY.'css/optionsframework.css');
	wp_enqueue_style('color-picker', OPTIONS_FRAMEWORK_DIRECTORY.'css/colorpicker.css');
	wp_register_style( 'flaticon', get_template_directory_uri() . '/styles/flaticon/flaticon.css', array(), '1.0', 'all' );
	wp_enqueue_style( 'flaticon' );
	if (is_rtl()){wp_enqueue_style('optionsframework-rtl', OPTIONS_FRAMEWORK_DIRECTORY.'css/rtl.css');}
}	

/* Loads the javascript */

function optionsframework_load_scripts($hook) {

	if ( 'appearance_page_options-framework' != $hook )
        return;
	
	// Enqueued scripts
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('color-picker', OPTIONS_FRAMEWORK_DIRECTORY.'js/colorpicker.js', array('jquery'));
	wp_enqueue_script('itoggle', OPTIONS_FRAMEWORK_DIRECTORY.'js/ibutton.js', array('jquery'));
	wp_enqueue_script('simple-slider', OPTIONS_FRAMEWORK_DIRECTORY.'js/simple-slider.min.js', array('jquery'));
	wp_enqueue_script('options-custom', OPTIONS_FRAMEWORK_DIRECTORY.'js/options-custom.js', array('jquery'));
	
	
	// Inline scripts from options-interface.php
	add_action('admin_head', 'of_admin_head');
}

function of_admin_head() {

	// Hook to add custom scripts
	do_action( 'optionsframework_custom_scripts' );
}

/* 
 * Builds out the options panel.
 *
 * If we were using the Settings API as it was likely intended we would use
 * do_settings_sections here.  But as we don't want the settings wrapped in a table,
 * we'll call our own custom optionsframework_fields.  See options-interface.php
 * for specifics on how each individual field is generated.
 *
 * Nonces are provided using the settings_fields()
 *
 */

if ( !function_exists( 'optionsframework_page' ) ) {
	function optionsframework_page() {
		
		global $_thdglkr_of_name;
		global $_thdglkr_cur_lang;
		settings_errors();
?>

	<div id="optionsframework-wrap" class="wrap">
	
    <div class="option_header">
		
        <div class="logo">
            <h2><?php echo TG_THEME_NAME; ?></h2>
            <span>v<?php echo TG_THEME_VERSION ; ?></span>
        </div>
        
        <?php if ($_thdglkr_cur_lang!=''){ echo '<div style="color:#EEE;float:left;margin:26px;" >Settings for this language: '. strtoupper($_thdglkr_cur_lang) .'</div>';}?>
        
        <div class="icon-setting"></div>
        
        
        
    </div>
        
    <h2 class="nav-tab-wrapper">
        <?php echo optionsframework_tabs(); ?>
    </h2>

    <div id="optionsframework-metabox" class="metabox-holder">
	    <div id="optionsframework" class="postbox">
			<form action="options.php" method="post" name="ofform">
            <input type="submit" class="button-primary topbtn" name="update" value="<?php esc_attr_e( 'Save Options', $_thdglkr_of_name); ?>" />
            <input type="hidden" id="security" name="security" value="<?php echo wp_create_nonce('of_ajax_nonce'); ?>" />
			<?php settings_fields($_thdglkr_of_name); ?>
            <div id="of-option-loading" class="group" style="display: block;"><h3>Loading ...</h3></div>
            <div id="of-option-importing" class="group" style="display: none;">
            <h3>Please Wait...</h3>
            <div id="section-importing" class="section section-importing">
            <h4 class="heading">Importing Demo Data</h4>
            <div><strong>NOTE:</strong> It will take some minutes, please wait for finishing the import process.</div>
            </div></div>
			<?php optionsframework_fields(); /* Settings */ ?>
			<div id="optionsframework-submit">
				<input type="submit" class="button-primary" name="update" value="<?php esc_attr_e( 'Save Options', $_thdglkr_of_name); ?>" />
				<input type="submit" class="reset-button button-secondary" name="reset" value="<?php esc_attr_e( 'Restore Defaults', $_thdglkr_of_name ); ?>" onclick="return confirm( '<?php print esc_js( __( 'Click OK to reset. Any theme settings will be lost!', 'options_framework_theme' ) ); ?>' );" />
				<div class="clear"></div>
			</div>
			</form>
		</div> <!-- / #container -->
	</div>
	<?php do_action('optionsframework_after'); ?>
	</div> <!-- / .wrap -->
	
<?php
	}
}

/**
 * Validate Options.
 *
 * This runs after the submit/reset button has been clicked and
 * validates the inputs.
 *
 * @uses $_POST['reset'] to restore default options
 */
function optionsframework_validate( $input ) {

	/*
	 * Restore Defaults.
	 *
	 * In the event that the user clicked the "Restore Defaults"
	 * button, the options defined in the theme's options.php
	 * file will be added to the option for the active theme.
	 */

	if ( isset( $_POST['reset'] ) ) {
		add_settings_error( 'options-framework', 'restore_defaults', __( 'Default options restored.', 'options_framework_theme' ), 'updated fade hide' );
		return of_get_default_values();
	} else {
	
	/*
	 * Update Settings
	 *
	 * This used to check for $_POST['update'], but has been updated
	 * to be compatible with the theme customizer introduced in WordPress 3.4
	 */

		$clean = array();
		$options = optionsframework_options();
		foreach ( $options as $option ) {

			if ( ! isset( $option['id'] ) ) {
				continue;
			}

			if ( ! isset( $option['type'] ) ) {
				continue;
			}

			$id = preg_replace( '/[^a-zA-Z0-9._\-]/', '', strtolower( $option['id'] ) );

			// Set checkbox to false if it wasn't sent in the $_POST
			if ( 'checkbox' == $option['type'] && ! isset( $input[$id] ) ) {
				$input[$id] = false;
			}

			// Set each item in the multicheck to false if it wasn't sent in the $_POST
			if ( 'multicheck' == $option['type'] && ! isset( $input[$id] ) ) {
				foreach ( $option['options'] as $key => $value ) {
					$input[$id][$key] = false;
				}
			}

			// For a value to be submitted to database it must pass through a sanitization filter
			if ( has_filter( 'of_sanitize_' . $option['type'] ) ) {
				$clean[$id] = apply_filters( 'of_sanitize_' . $option['type'], $input[$id], $option );
			}
		}

		add_settings_error( 'options-framework', 'save_options', __( 'Options saved.', 'options_framework_theme' ), 'updated fade hide' );
		return $clean;
	}

}

/**
 * Format Configuration Array.
 *
 * Get an array of all default values as set in
 * options.php. The 'id','std' and 'type' keys need
 * to be defined in the configuration array. In the
 * event that these keys are not present the option
 * will not be included in this function's output.
 *
 * @return    array     Rey-keyed options configuration array.
 *
 * @access    private
 */
 
function of_get_default_values() {
	$output = array();
	$config = optionsframework_options();
	foreach ( (array) $config as $option ) {
		if ( ! isset( $option['id'] ) ) {
			continue;
		}
		if ( ! isset( $option['std'] ) ) {
			continue;
		}
		if ( ! isset( $option['type'] ) ) {
			continue;
		}
		if ( has_filter( 'of_sanitize_' . $option['type'] ) ) {
			$output[$option['id']] = apply_filters( 'of_sanitize_' . $option['type'], $option['std'], $option );
		}
	}
	return $output;
}


/**
 * AJAX Callback
 */
add_action('wp_ajax_of_ajax_post_action', 'of_ajax_callback');

function of_ajax_callback()
{
	$nonce=$_POST['security'];

	if (! wp_verify_nonce($nonce, 'of_ajax_nonce') ) die('-1');


	$save_type = $_POST['type'];

	if($save_type == 'import_options'){
		
		global $_thdglkr_of_id;
	
		
		$data = $_POST['data'];
		$data = unserialize(base64_decode($data)); //100% safe - ignore theme check nag
		update_option($_thdglkr_of_id, $data);


		die(1);
		
		
	}elseif($save_type == 'update_color'){
		
		$cc = $_POST['data'];
		
		switch($cc){
			
			case "light-alizarin":
				update_option('theme_color','#cc0000');
			break;
			
			case "light-river":
				update_option('theme_color','#ccbbdd');
			break;
			
			}
		
	}elseif($save_type == 'import_demo'){
		
		$dv = $_POST['data'];
		
		////////////////////////////////////////////////////////////////
		
		
		if ( !defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true);
			
		
		require_once ABSPATH . 'wp-admin/includes/import.php';
		$importer_error = false;
		if ( !class_exists( 'WP_Importer' ) ) {
			$class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
			if ( file_exists( $class_wp_importer ) ){
				require_once($class_wp_importer);
			}
			else{
				$importer_error = true;
			}
		}


		if (!function_exists('wordpress_importer_init')){

			if ( !class_exists( 'WP_Import' ) ) {
				$class_wp_import = get_template_directory() . '/functions/importer/wordpress-importer.php';
				if ( file_exists( $class_wp_import ) )
					require_once($class_wp_import);
				else
					$importerError = true;
			}
		
		}
		
		
		
		if($importer_error){
			die(-1);
		}else{
			$xmlfile = LIBS_DIR . '/demo/'.$dv.'.xml';
			if(!file_exists( $xmlfile )){
				die($xmlfile . ": The XML file containing the dummy content is not available or could not be read.");
			}
			else{
				$wp_import = new WP_Import();
				$wp_import->fetch_attachments = true;
				$wp_import->import( $xmlfile );
				
		  }
	  }
		
	
	themetor_set_demo_data($dv);

	}	

}

function themetor_set_demo_data($dv){

	
	$json_string = LIBS_DIR . '/demo/'.$dv.'.json';

	$jsondata = file_get_contents($json_string);
	
	if ($jsondata){
	$obj = json_decode($jsondata,true);
	
	$arr_c= $obj['tt-colors'][0];
	$sfp =  get_page_by_title($obj['tt-homepage'])->ID;
	$tod = $obj['tt-backup'];
	
	foreach ($arr_c as $op => $val){
			update_option($op,$val);
		}
	
	//Set front page
	update_option( 'page_on_front', $sfp );
	update_option( 'show_on_front', 'page' );
		
	//Theme Options
	global $_thdglkr_of_id;
	$tod = unserialize(base64_decode($tod)); //100% safe - ignore theme check nag
	update_option($_thdglkr_of_id, $tod);	
		
	}
	
	
	// Menu
	$main_menu = get_term_by('name', 'main', 'nav_menu');
	$footer_menu = get_term_by('name', 'Footer Menu', 'nav_menu');
	$onepage_menu = get_term_by('name', 'One Page', 'nav_menu');
	set_theme_mod( 'nav_menu_locations' , array('primary' => $main_menu->term_id, 'secondary' => $footer_menu->term_id, 'onepage' => $onepage_menu->term_id ) );
	
	
	//Import Widgets
	update_option('sidebars_widgets', '');
	
	tt_addWidget( 'footer_widgets' , 'text', 0, array('title' => 'About Us','text' => '<p>Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repella sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repella</p>'));
	tt_addWidget( 'footer_widgets', 'official_embed', 0, array('title' => 'Latest Video','youtube_video' =>'qANZrq7UbjE','embed' => '','vimeo_video' =>'','description' => ''));
	tt_addWidget( 'footer_widgets', 'official_portfolio', 0, array('title' => 'Latest Projects','items' =>'6'));
	tt_addWidget( 'footer_widgets', 'official_contact', 0, array('title' => 'Contact','address' =>'#23, 48th Allety, Some Ave. Anywhere. US','tel' =>'+1 (300) 11 22 33','email' =>'you@yourdomainn.com','fax' =>'+1 (300) 99 88 77','map' =>'http://maps.google.com'));
	
	tt_addWidget( 'sidebar-blog', 'official_ads', 0,array('title' => 'Sponsors','url1' =>'http://www.themetor.com','ads1' =>'http://demo.themetor.com/official/demo9/wp-content/uploads/2014/08/ads125.png','url2' =>'http://www.themetor.com','ads2' =>'http://demo.themetor.com/official/demo9/wp-content/uploads/2014/08/ads125.png'));
	tt_addWidget( 'sidebar-blog', 'search', 0);
	tt_addWidget( 'sidebar-blog', 'official_combo_tabs', 0,array('posts' => '5','thumb' => 'on','show_date' => 'on','date_format' => 'F j Y'));
	tt_addWidget( 'sidebar-blog', 'categories', 0);
	tt_addWidget( 'sidebar-blog', 'official_facebook', 0,array('title' => 'Like Us', 'page_url' => 'http://www.facebook.com/envato', 'color_scheme' => 'light', 'show_faces' => 'on', 'show_stream' => false, 'show_header' => 'on'));
	tt_addWidget( 'sidebar-blog', 'official_subscription', 0,array('title' => 'Join Us'));
	
	tt_addWidget( 'sidebar-blog2', 'official_ads', 0,array('title' => 'Sponsors','url1' =>'http://www.themetor.com','ads1' =>'http://demo.themetor.com/official/demo9/wp-content/uploads/2014/08/ads125.png','url2' =>'http://www.themetor.com','ads2' =>'http://demo.themetor.com/official/demo9/wp-content/uploads/2014/08/ads125.png'));
	tt_addWidget( 'sidebar-blog2', 'categories', 0);
	tt_addWidget( 'sidebar-blog2', 'recent-posts', 0);
	
	tt_addWidget( 'extrapanel_widgets' , 'text', 0, array('title' => 'Contact','text' => '[contact-form-7 id="9" title="Contact form 1"]'));
	tt_addWidget( 'extrapanel_widgets' , 'text', 0, array('title' => 'Map','text' => '[gmap height="350" lat="0" long="0" style="full" zoom="14" marker="yes" infowindow="Hello World!" infowindowdefault="no" maptype="ROADMAP" hidecontrols="true" address="Los Angeles" markerimage="http://demo.themetor.com/official/demo1/wp-content/uploads/2014/08/mapmarker.png"]'));
	
	tt_addWidget( 'sidebar-search', 'search', 0);

	tt_addWidget( 'sidebar-page', 'search', 0);
	tt_addWidget( 'sidebar-page', 'official_ads', 0,array('title' => 'Sponsors','url1' =>'http://www.themetor.com','ads1' =>'http://demo.themetor.com/official/demo9/wp-content/uploads/2014/08/ads125.png','url2' =>'http://www.themetor.com','ads2' =>'http://demo.themetor.com/official/demo9/wp-content/uploads/2014/08/ads125.png','url3'=>'','ads3'=>'','url4'=>'','ads4'=>''));
	tt_addWidget( 'sidebar-page', 'recent-comments', 0,array('title' => 'Popular Posts','number'=>'5'));
		
	die($dv .' is imported successfully.');
			
}


function tt_addWidget($sidebarSlug, $widgetSlug, $countMod, $widgetSettings = array()){
	$sidebarOptions = get_option('sidebars_widgets');
	if(!isset($sidebarOptions[$sidebarSlug])){
	$sidebarOptions[$sidebarSlug] = array('_multiwidget' => 1);
	}
	$newWidget = get_option('widget_'.$widgetSlug);
	if(!is_array($newWidget))$newWidget = array();
	$count = count($newWidget)+1+$countMod;
	$sidebarOptions[$sidebarSlug][] = $widgetSlug.'-'.$count;

	$newWidget[$count] = $widgetSettings;

	update_option('sidebars_widgets', $sidebarOptions);
	update_option('widget_'.$widgetSlug, $newWidget);
}


/**
 * Add Theme Options menu item to Admin Bar.
 */

function optionsframework_adminbar() {

	global $wp_admin_bar;
	

		$wp_admin_bar->add_menu( array(
				'id' => 'of_theme_options',
				'title' => __( 'Official Options', 'options_framework_theme' ),
				'href' => admin_url( 'themes.php?page=options-framework' )
			));

}

if ( ! function_exists( '_option' ) ) {

	/**
	 * Get Option.
	 *
	 * Helper function to return the theme option value.
	 * If no value has been saved, it returns $default.
	 * Needed because options are saved as serialized strings.
	 */
	
	
	
	function _option( $name, $default = false ) {
		
		
		$_thdglkr_of_name = 'optionsframework';
	
	
		if(defined('ICL_LANGUAGE_CODE')) {
			global $sitepress;
			if(ICL_LANGUAGE_CODE != 'all' && ICL_LANGUAGE_CODE != $sitepress->get_default_language()) {
				$_thdglkr_of_name = $_thdglkr_of_name.'_'.ICL_LANGUAGE_CODE;
	
			} 
				
		}

		$config = get_option($_thdglkr_of_name);

		if ( ! isset( $config['id'] ) ) {
			return $default;
		}

		$options = get_option( $config['id'] );

		if ( isset( $options[$name] ) ) {
			return $options[$name];
		}

		return $default;
	}
}