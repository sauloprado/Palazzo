<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 * 
 */

function optionsframework_option_name() {

	global $_thdglkr_of_name,$_thdglkr_of_id;
	$optionsframework_settings = get_option( $_thdglkr_of_name );
	$optionsframework_settings['id'] = $_thdglkr_of_id;
	update_option( $_thdglkr_of_name, $optionsframework_settings );


}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 *  
 */

function optionsframework_options() {	


	// Pull all the pages into an array
	$options_pages = array();  
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages['default'] = 'Default Maintenance Page';
	foreach ($options_pages_obj as $page) {
    	$options_pages[$page->ID] = $page->post_title;
	}
	
	
	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/images/';
	$admin_images_url = get_template_directory_uri().'/admin/images/';
	
	// TitleTypes 
	$title_type = array(
		'cpmb_no' => 'No Title',
		'cpmb_title' => 'Page Title',
		'cpmb_title_center' => 'Page Title (Center)',
		'cpmb_breadcrumbs' => 'Page Title + Breadcrumbs',
		'cpmb_breadcrumbs_center' => 'Page Title + Breadcrumbs (Center)',
		'cpmb_image' => 'Featured Image',
		'cpmb_nivo' => 'Nivo Slider',
		'cpmb_flex' => 'Flex Slider',
		'cpmb_kwick' => 'Kwicks Slider',
		'cpmb_roundabout' => 'Roundabout Slider',
		'cpmb_liteaccordion' => 'Lite Accordion Slider',
		'cpmb_3dslice' => '3D Slice Slider'
		);
	
	if(class_exists('RevSlider')){
		$slider = new RevSlider();
		$arrSliders = $slider->getArrSliders();
		foreach($arrSliders as $revSlider) { 
			$title_type[$revSlider->getAlias()] = $revSlider->getTitle().' (Revolution Slider)';
		}
	}

	
	$options = array();
	

	
	// Layout Settings /////////////////////////////////	
	$options[] = array("name" => __("Layout","official"),
						"class" => "layout",
						"type" => "heading");
	
	$pl_images = array('full'=>$admin_images_url.'wl.png','boxed'=>$admin_images_url.'bl.png','boxed-margin'=>$admin_images_url.'bm.png');
	$options[] = array( "name" => __("Layout Style","official"),
						"desc" => __("Select Website layout style: Wide, Boxed or Boxed with Margin on top and bottom","official"),
						"id" => "page_style",
						"type" => "images",
						"std" =>"full",
						"options" => $pl_images);	
						
										
	$options[] = array( "name" => __("Responsive?","official"),
						"desc" => __("Turn On/Off the Responsive","official"),
						"id" => "responsive",
						"type" => "checkbox",
						"std" => 1);
	
	$options[] = array( "name" => __("Zoom on Small Devices?","official"),
						"desc" => __("Turn On/Off the Zoom ability on small devices","official"),
						"id" => "zoom",
						"type" => "checkbox",
						"std" => 0);
						
	
	
						
	$options[] = array( "name" => __("Animate?","official"),
						"desc" => __("Turn On/Off the Animation Effect","official"),
						"id" => "animate",
						"type" => "checkbox",
						"std" => 1);
		
		
												
	$options[] = array("name" => __("Nice Scroll","official"),
						"type" => "info");	
						
	$options[] = array( "name" => __("Nice Scroll?","official"),
						"desc" => __("Turn On/Off the Nice Scroll","official"),
						"id" => "nicescroll",
						"type" => "checkbox",
						"std" => 1);					
						
	$options[] = array( "name" => __("Scroll Bar Width","official"),
						"desc" => __("Enter Scroll Bar Width (Thickness) (Default is 7px)","official"),
						"id" => "nicescroll_width",
						"std" => "7px",
						"class" => "mini",
						"type" => "text");
						
	$options[] = array( "name" => __("Scroll Bar Border Radius","official"),
						"desc" => __("Enter Scroll Bar Border Radius (Default is 7px)","official"),
						"id" => "nicescroll_radius",
						"std" => "7px",
						"class" => "mini",
						"type" => "text");
						
													
	$options[] = array("name" => __("Boxed & Blocked Layout Options (only work when Boxed or Blocked Layouts is selected)","official"),
						"type" => "info");					
	
	
	$options[] = array( "name" => __("Boxed and Blocked Shadow","official"),
						"desc" => __("Turn On/Off the Boxed and Blocked Shadow","official"),
						"id" => "wrap_shadow",
						"type" => "checkbox",
						"std" => 0);
						
	$options[] = array( "name" => __("Blocked Rounded Corners","official"),
						"desc" => __("Turn On/Off the Blocked Rounded Corners","official"),
						"id" => "blocked_corners",
						"type" => "checkbox",
						"std" => 1);
						
											
	$options[] = array( "name" => __("Custom Background Image","official"),
						"desc" => __("Upload Background Image or paste Image URL","official"),
						"id" => "bg_img",
						"std" => "",
						"type" => "upload");
	

	$options[] = array( "name" => __("Background Repeat","official"),
						"desc" => __("Select Background Repeat Option for the Background.","official"),
						"id" => "bg_repeat",
						"std" => "repeat",
						"type" => "select",
						"class" => "mini",
						"options" => array('stretch' => __('Stretch Image','official'), 'repeat' => __('Repeat','official'), 'no-repeat' => __('No Repeat','official'), 'repeat-x' => __('Repeat Horizontal (X)','official'), 'repeat-y' => __('Repeat Vertical (Y)','official')));	
	
						
	
	//Background Images Reader
	$bg_images_path = get_template_directory() . '/images/pattern/thumb/'; 
	$bg_images_url = get_template_directory_uri().'/images/pattern/thumb/'; 

	$bg_images = array();
	
	if ( is_dir($bg_images_path) ) {
		if ($bg_images_dir = opendir($bg_images_path) ) { 
			while ( ($bg_images_file = readdir($bg_images_dir)) !== false ) {
				if(stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {
					$bg_images[] = $bg_images_url . $bg_images_file;
				}
			}    
		}
	}
	sort($bg_images);

	$options[] = array( "name" => __("Background Patterns","official"),
						"id" => "bg_img_select",
						"type" => "tiles",
						"std" =>"0",
						"options" => $bg_images);
		
	
	
	// Frames
	$options[] = array("name" => __("Boxed Layout Frames","official"),
						"type" => "info");
	
	$drk = '';
	if (_option('dark_style',0)==1){$drk='d';}
	$fr_images = array(
		'noframe'=>$admin_images_url.'nofr.jpg',
		'frame_1'=>$admin_images_url.'fr1'.$drk.'.jpg',
		'frame_2'=>$admin_images_url.'fr2'.$drk.'.jpg',
		'frame_3'=>$admin_images_url.'fr3'.$drk.'.jpg',
		'frame_4'=>$admin_images_url.'fr4'.$drk.'.jpg',
		'frame_5'=>$admin_images_url.'fr5'.$drk.'.jpg',
		'frame_6'=>$admin_images_url.'fr6'.$drk.'.jpg',
		'frame_7'=>$admin_images_url.'fr7'.$drk.'.jpg',
		'frame_8'=>$admin_images_url.'fr8'.$drk.'.jpg',
		'frame_9'=>$admin_images_url.'fr9'.$drk.'.jpg',
		'frame_10'=>$admin_images_url.'fr10'.$drk.'.jpg',
		
	);
											
	$options[] = array( "name" => __("Frames","official"),
						"desc" => __("Select frame for boxed style","official"),
						"id" => "frame",
						"type" => "images",
						"std" =>"noframe",
						"desc" =>__("NOTE: Frames only works on Boxed layout","official"),
						"options" => $fr_images);
						
	
	// SEO SETTINGS /////////////////////////////////	
	$options[] = array("name" => __("SEO Settings","official"),
						"class" => "seo",
						"type" => "heading");
						
	
	
	$options[] = array( "name" => __("Meta Description","official"),
						"desc" => __("Description about your website (Good for SEO)","official"),
						"id" => "meta_description",
						"std" => get_bloginfo( 'description' ),
						"type" => "textarea");
	
	$options[] = array( "name" => __("Meta Keywords","official"),
						"desc" => __("Keywords about your website, Separate them with comma ( , )","official"),
						"id" => "meta_keywords",
						"std" => "",
						"type" => "textarea");
						
						
	$meta_robots_array = array( "index" => "Index", "follow" => "Follow" );
	$meta_robots_defaults = array( "index" => "1", "follow" => "1" );

	$options[] = array( "name" => __("Meta Robots","official"),
						"desc" => __("Should the robots index your site or not? Maybe you don`t want to let robots follow all your pages/folders?","official"),
						"id" => "meta_robots",
						"type" => "multicheck",
						"options" => $meta_robots_array,
						"std" => $meta_robots_defaults);
											
	
	$options[] = array("name" => __("Apple Devices Icons","official"),
						"type" => "info");
					
						
	$options[] = array( "name" => __("Apple iPhone Icon","official"),
						"desc" => __("This is a hidden image that Apple iPhone use this icon as a shortcut icon. (57x57 pixel .PNG or .JPG format)","official"),
						"id" => "touch-icon57",
						"std" => "",
						"type" => "upload");
						
	$options[] = array( "name" => __("Apple iPhone Retina Icon","official"),
						"desc" => __("This is a hidden image that Retina Apple iPhone use this icon as a shortcut icon. (114x114 pixel .PNG or .JPG format)","official"),
						"id" => "touch-icon114",
						"std" => "",
						"type" => "upload");
	
	$options[] = array( "name" => __("Apple iPad Icon","official"),
						"desc" => __("This is a hidden image that Apple iPad use this icon as a shortcut icon. (72x72 pixel .PNG or .JPG format)","official"),
						"id" => "touch-icon72",
						"std" => "",
						"type" => "upload");
	
	
	$options[] = array( "name" => __("Apple iPad Retina Icon","official"),
						"desc" => __("This is a hidden image that Retina Apple iPad use this icon as a shortcut icon. (144x144 pixel .PNG or .JPG format)","official"),
						"id" => "touch-icon144",
						"std" =>  "",
						"type" => "upload");


		
	
	// Header ////////////////////////////////////////
	$options[] = array("name" => __("Header","official"),
						"class" => "header",
						"type" => "heading");
	
	
	$options[] = array( "name" => __("Custom Header Background Image","official"),
						"desc" => __("Upload Header Background Image or paste Image URL","official"),
						"id" => "header_bg_img",
						"std" => "",
						"type" => "upload");
						

	$options[] = array( "name" => __("Sticky Menu?","official"),
						"desc" => __("Turn On/Off the Sticky Menu","official"),
						"id" => "is_sticky",
						"type" => "checkbox",
						"std" => 1);
	
	
	$options[] = array( "name" => __("Header Top Line","official"),
						"desc" => __("Header top line height, if you want to remove it please select 0","official"),
						"id" => "header_top_line",
						"std" => "5",
						"type" => "select",
						"class" => "mini",
						"options" => array('0'=>'0px','1'=>'1px','2'=>'2px','3'=>'3px','4'=>'4px','5'=>'5px',
											'6'=>'6px','7'=>'7px','8'=>'8px','9'=>'9px','10'=>'10px','11'=>'11px',
											'12'=>'12px','13'=>'13px','14'=>'14px','15'=>'15px','16'=>'16px',
											'17'=>'17px','18'=>'18px','19'=>'19px','20'=>'20px'));
						
	
	$hdr_images = array(
		'v1'=>$admin_images_url.'header1.gif',
		'v2'=>$admin_images_url.'header2.gif',
		'v3'=>$admin_images_url.'header3.gif',
		'v4'=>$admin_images_url.'header4.gif',
		'v5'=>$admin_images_url.'header5.gif',
		'v6'=>$admin_images_url.'header6.gif',
		'v7'=>$admin_images_url.'header7.gif',
		'v8'=>$admin_images_url.'header8.gif',
		'v9'=>$admin_images_url.'header9.gif',
		'v10'=>$admin_images_url.'header10.gif',
		'v11'=>$admin_images_url.'header11.gif',
		'v12'=>$admin_images_url.'header12.gif',
	);
	$options[] = array( "name" => __("Header Style","official"),
						"desc" => "",
						"id" => "header_style",
						"type" => "images",
						"std" =>"v1",
						"options" => $hdr_images);	

	$options[] = array( "name" => __("Main Menu Margin Top","official"),
						"desc" => __("Enter Main Menu Margin from Top (Default is 40px) only works on Header style 2,5,9,10,12","official"),
						"id" => "menu_margin_top",
						"std" => "40px",
						"class" => "mini",
						"type" => "text");

	
	$options[] = array( "name" => __("Big Header Opacity","official"),
						"desc" => __("Please select Big Header Opacity between 0 to 100","official"),
						"id" => "bh_opacity",
						"std" => "100",
						"range" => "0,100",
						"step" => "1",
						"type" => "slider");
						
	$options[] = array( "name" => __("Small Header Opacity","official"),
						"desc" => __("Please select Small Header Opacity between 0 to 100","official"),
						"id" => "sh_opacity",
						"std" => "100",
						"range" => "0,100",
						"step" => "1",
						"type" => "slider");
	
	
	$options[] = array( "name" => __("Header Shadows?","official"),
						"desc" => __("Turn On/Off the header shadow effects","official"),
						"id" => "header_shadow",
						"type" => "checkbox",
						"std" => 1);
						
	$options[] = array( "name" => __("Sub Menu Opacity","official"),
						"desc" => __("Please select Sub Menu Opacity between 0 to 100","official"),
						"id" => "submenu_opacity",
						"std" => "100",
						"range" => "0,100",
						"step" => "1",
						"type" => "slider");
	
																
	$options[] = array("name" => __("Logo","official"),
						"type" => "info");				
						
	$options[] = array( "name" => __("Logo","official"),
						"desc" => __("Use the upload button to upload your site's logo and then click '<strong>Use this image</strong>.","official"),
						"id" => "logo",
						"std" => $imagepath . "logo.png",
						"type" => "upload");
	
	$options[] = array( "name" => __("Logo Width","official"),
						"desc" => __("Enter your logo width (Default is 220px)","official"),
						"id" => "logo_width",
						"std" => "220px",
						"class" => "mini",
						"type" => "text");
						
	$options[] = array( "name" => __("Logo Margin Top","official"),
						"desc" => __("Enter your logo Margin from Top (Default is 30px)","official"),
						"id" => "logo_margin_top",
						"std" => "30px",
						"class" => "mini",
						"type" => "text");
						
	$options[] = array( "name" => __("Logo Margin Bottom","official"),
						"desc" => __("Enter your logo Margin from Bottom (Default is 30px)","official"),
						"id" => "logo_margin_bottom",
						"std" => "30px",
						"class" => "mini",
						"type" => "text");
	
	$options[] = array( "name" => __("Logo Width in Sticky","official"),
						"desc" => __("Enter your logo Width in Sticky Menu (Default is 170px)","official"),
						"id" => "logo_width_sticky",
						"std" => "170px",
						"class" => "mini",
						"type" => "text");
	
	$options[] = array( "name" => __("Logo Sticky Margin","official"),
						"desc" => __("Enter your logo Margin from Bottom (Default is 5px 0px)","official"),
						"id" => "menu_sticky_margin",
						"std" => "5px 0px",
						"class" => "mini",
						"type" => "text");
											
											
	$options[] = array( "name" => __("Custom Favicon","official"),
						"desc" => __("Site favicon. (32x32 pixel or 16x16 pixel .PNG or .ICO file)","official"),
						"id" => "favicon",
						"type" => "upload",
						"std" => $imagepath . "favicon.ico");
	
	
	$options[] = array("name" => __("Navigation Menu","official"),
						"type" => "info");
	
						
	$options[] = array( "name" => __("Show Search?","official"),
						"desc" => __("Turn On/Off the Search bar on top right","official"),
						"id" => "search",
						"type" => "checkbox",
						"std" => 1);
						
	$options[] = array( "name" => __("Show Menu Separator","official"),
						"desc" => __("Turn On/Off the Menu Separator","official"),
						"id" => "menu_sep",
						"type" => "checkbox",
						"std" => 1);	

						
	$options[] = array("name" => __("Email and Call Us Text","official"),
						"type" => "info");
										
										
	$options[] = array( "name" => __("Email and Call Us Text","official"),
						"desc" => __("This text show in the top header area","official"),
						"id" => "right_sub_text",
						"std" => '<span><i class="icon-envelope-alt"></i> <a href="mailto:info@yourname.com">info@yourname.com</a></span><span><i class="icon-phone"></i>  +1 (888) 0000</span>',
						"type" => "editor");	
	
	
	$options[] = array( "name" => __("Margin Top","official"),
						"desc" => __("Enter Main Email and Call Us Margin from Top (Default is 56px) only works on Header style 1,3,6,7,8","official"),
						"id" => "info_margin_top",
						"std" => "56px",
						"class" => "mini",
						"type" => "text");
						
	//Breadcrumbs
	$options[] = array("name" => __("Breadcrubs Area","official"),
						"type" => "info");	
						
	$options[] = array( "name" => __("Default Breadcrumbs Background Image","official"),
						"desc" => __("Upload Breadcrumbs Background Image or paste Image URL, if you add Breadcrumb Image to your page advanced settings that will override this default image.","official"),
						"id" => "breadcrumbs_bg_img",
						"std" => "",
						"type" => "upload");
						
	$options[] = array( "name" => __("Breadcrumbs Height","official"),
						"desc" => __("Breadcrumbs Height (Default is 110px)","official"),
						"id" => "breadcrumbs_height",
						"std" => "110px",
						"class" => "mini",
						"type" => "text");
						
						
	//Extra Panel
	$options[] = array("name" => __("Extra Panel","official"),
						"type" => "info");	
	
	$options[] = array( "name" => __("Show Top Extra Panel?","official"),
						"desc" => __("Turn On/Off the Top Extra Panel","official"),
						"id" => "extrapanel",
						"type" => "checkbox",
						"std" => 1);	
	
	$options[] = array( "name" => __("Arrow Button Align","official"),
						"desc" => __("Select extra panel arrow button alignment","official"),
						"id" => "extra_align",
						"std" => "right",
						"type" => "select",
						"class" => "mini",
						"options" => array(
									'left'=>__("Left","official"),
									'center'=>__("Center","official"),
									'right'=>__("Right","official")									
									)
						);
						
	$col_images = array('1'=>$admin_images_url.'1c.png','2'=>$admin_images_url.'2c.png','3'=>$admin_images_url.'3c.png','4'=>$admin_images_url.'4c.png');
	$options[] = array( "name" => __("Number of Extra Panel Columns","official"),
						"desc" => __("Select how many columns you want to display in the Extra Panel widgets.","official"),
						"id" => "extrapanel_col",
						"type" => "images",
						"std" =>"2",
						"options" => $col_images);
											
	
	
	// Custom WPML Language Selector ==================================================================================	
	if (function_exists('icl_get_languages')){
					
	$options[] = array("name" => __("WPML Settings","official"),
						"type" => "info");
						
						
	$options[] = array( "name" => __("Show WPML Language Selector","official"),
						"desc" => __("Turn On/Off the WPML Language Selector on top right","official"),
						"id" => "wpml_lang_selector",
						"type" => "checkbox",
						"std" => 0);
						
	
	$options[] = array( "name" => __("Show WPML Language Selector in which Menu?","official"),
						"desc" => __("Select your menu you want to show WPML Language Selector in.","official"),
						"id" => "wpml_menu",
						"std" => "Main Menu",
						"type" => "select",
						"class" => "mini",
						"options" => array('Main Menu'=>'Main Menu','Footer Menu'=>'Footer Menu'));
											
						
	
	$options[] = array( "name" => __("WPML Language Selector Style?","official"),
						"desc" => __("Select WPML Language Selector style.","official"),
						"id" => "wpml_style",
						"std" => "3",
						"type" => "select",
						"class" => "mini",
						"options" => array(1=>'Flag + Native Name',
										   2=>'Flag + Translated Name',
										   3=>'Flags (In a Line)',
										   4=>'Flags (Dropdown Menu)',
										   5=>'Native Name',
										   6=>'Translated Name',
						));

	}	
	
	
	
									   					
	// Colors ////////////////////////////////////////
	$options[] = array("name" => __("Colors","official"),
						"class" => "appearance",
						"type" => "heading");
						
	
	$options[] = array( "name" => __("Dark Style?","official"),
						"desc" => __("Turn On/Off the Dark style","official"),
						"id" => "dark_style",
						"type" => "checkbox",
						"std" => 0);

	
											
	$options[] = array( 'name' => __('Note', 'official'),
						'type' => 'note',
						'class' =>'note_info',
						'desc' => __('For Live Colors settings please go to <a href="customize.php">Theme Customize</a> &gt; <strong>Colors</strong> ','official')
						);
						
						
	
	// Typography
	$options[] = array( 'name' => __('Typography', 'official'),
						'class' =>'typography',
						'type' => 'heading');
	
	$options[] = array( 'desc' => __('Body font.', 'official'),
						'name' =>__('Text font:', 'official'),
						'id' => 'font_text',
						'class' => 'hty',
						'std' => array('size' => '12px','face' => 'Tahoma','style' => 'normal','color' => '#7A7A7A'),
						'type' => 'typography');
	
	$options[] = array( 'desc' => __('Menu font.', 'official'),
						'name' =>__('Menu font:', 'official'),
						'id' => 'font_menu',
						'class' => 'hty',
						'std' => array('size' => '12px','face' => 'Tahoma','style' => 'bold','color' => '#B9B9B9'),
						'type' => 'typography');

						
	
	$options[] = array("name" => __("Heading","official"),
						"type" => "info");
											
							
	$options[] = array( 'desc' => __('Header H1 font.', 'official'),
						'name' =>__('H1 font:', 'official'),
						'id' => 'font_h1',
						'class' => 'hty',
						'std' => array('size' => '32px','face' => 'Marcellus','style' => 'bold','color' => '#000000'),
						'type' => 'typography');
	
	$options[] = array( 'desc' => __('Header H2 font.', 'official'),
						'name' =>__('H2 font:', 'official'),
						'id' => 'font_h2',
						'class' => 'hty',
						'std' => array('size' => '26px','face' => 'Marcellus','style' => 'bold','color' => '#000000'),
						'type' => 'typography');
	
	$options[] = array( 'desc' => __('Header H3 font.', 'official'),
						'name' =>__('H3 font:', 'official'),
						'id' => 'font_h3',
						'class' => 'hty',
						'std' => array('size' => '20px','face' => 'Marcellus','style' => 'bold','color' => '#000000'),
						'type' => 'typography');
	
	$options[] = array( 'desc' => __('Header H4 font.', 'official'),
						'name' =>__('H4 font:', 'official'),
						'id' => 'font_h4',
						'class' => 'hty',
						'std' => array('size' => '18px','face' => 'Marcellus','style' => 'bold','color' => '#000000'),
						'type' => 'typography');
	
	$options[] = array( 'desc' => __('Header H5 font.', 'official'),
						'name' =>__('H5 font:', 'official'),
						'id' => 'font_h5',
						'class' => 'hty',
						'std' => array('size' => '14px','face' => 'Marcellus','style' => 'bold','color' => '#000000'),
						'type' => 'typography');
	
	$options[] = array( 'desc' => __('Header H6 font.', 'official'),
						'name' =>__('H6 font:', 'official'),
						'id' => 'font_h6',
						'class' => 'hty',
						'std' => array('size' => '12px','face' => 'Marcellus','style' => 'bold','color' => '#000000'),
						'type' => 'typography');	
	
	
	
	$options[] = array( 'name' => __('Note', 'official'),
						'type' => 'note',
						'class' =>'note_info',
						'desc' => __('For Other Colors settings please <a href="customize.php" >Click Here</a>  ','official')
						);
						
	
	
	
	// Blog Page Settings /////////////////////////////////	
	$options[] = array("name" => __("Blog Settings","official"),
						"class" => "blog",
						"type" => "heading");
						
										
	$options[] = array( "name" => __("Blog Sidebar Position","official"),
						"desc" => __("Choose which side you would like the sidebar to appear on the Blog.","official"),
						"id" => "blog_sidebar",
						"std" => "right",
						"type" => "images",
						"options" => array('nosidebar'=> $admin_images_url.'ns.png','right' =>$admin_images_url.'rs.png','left' => $admin_images_url.'ls.png' ));	
	
	$options[] = array( "name" => __("Number of Blog items?","official"),
						"desc" => __("Number of blog items per page in blog pages for pagination.","official"),
						"id" => "number_of_blog_item",
						"std" => "10",
						"class" => "mini",
						"type" => "text");
	
	
	
	$options[] = array( "name" => __("Blog Excerpt Length","official"),
						"desc" => __("Default is 30 words. Used for blog page, archives, Tags, Category Search and ... ","official"),
						"id" => "excerpt_blog",
						"std" => "30",
						"class" => "mini",
						"type" => "text"); 
		
	$options[] = array( "name" => __("Show Author avatar?","official"),
						"desc" => __("This will display the author's avatar in the bottom of the bolg posts.","official"),
						"id" => "blog_author_avatar",
						"std" => 1,
						"type" => "checkbox"); 
						
	$options[] = array( "name" => __("Show Read More button?","official"),
						"desc" => __("This will display the Read More button in the blogs page.","official"),
						"id" => "blog_more_button",
						"std" => 1,
						"type" => "checkbox"); 		

	$options[] = array( "name" => __("Read More Button Text","official"),
					"desc" => __("This is the text that will appear on the Blog \"More button\".  Default text is <strong>Read more &rsaquo;</strong>","official"),
					"id" => "blog_button",
					"std" => __("Read more &rsaquo;","official"),
					"class" => "mini",
					"type" => "text");

	$options[] = array( "name" => __("Blog Thumbnail Image Style","official"),
						"desc" => __("Select blog thumbnail style ","official"),
						"id" => "blog_thumb",
						"std" => "c",
						"type" => "select",
						"class" => "mini",
						"options" => array(
									'c'=>'Cropped Thumbnail',
									'f'=>'Full Thumbnail'									
									)
						);
						
	$options[] = array( 'name' => __('Blog Details', 'official'),
						'type' => 'info');
						
											
	$options[] = array( "name" => __("Show Author Info on Blog Details?","official"),
						"desc" => __("This will display the Author Name &amp; Biography in the Blog Posts. You can edit the Author Biography under Users > Profiles.","official"),
						"id" => "author_info",
						"std" => 1,
					    "type" => "checkbox"); 
	
	
	$options[] = array( "name" => __("Show Next and Previous buttons?","official"),
						"desc" => __("This will display the next and previous Post links on blog details page.","official"),
						"id" => "blog_nav",
						"std" => 1,
					    "type" => "checkbox"); 
						
						
	$options[] = array( "name" => __("Enable Comments?","official"),
						"desc" => __("This will display the Comments in the Blog Posts.","official"),
						"id" => "blog_comment",
						"std" => 1,
					    "type" => "checkbox"); 
						
	
	$options[] = array( "name" => __("Show Share Buttons in Blog Details?","official"),
						"desc" => __("Turn On/Off the Share buttons in blog details","official"),
						"id" => "blog_share",
						"type" => "checkbox",
						"std" => 1);
	
	$options[] = array( "name" => __("Share Buttons Title","official"),
					"desc" => __("The Title of share buttons box, Default is <strong>Share This Post</strong>","official"),
					"id" => "share_title_post",
					"std" => __("Share This Post","official"),
					"class" => "mini",
					"type" => "text");						

	
	// Portfolio Settings /////////////////////////////////	
	$options[] = array("name" => __("Portfolio Settings","official"),
						"class" => "portfolio",
						"type" => "heading");
									
	
	
	$options[] = array( "name" => __("Portfolio slug","official"),
					"desc" => __("Portfolio slug is URL friendly string that will shows in your portfolio details link.","official"),
					"id" => "portfolio_item_slug",
					"std" => "portfolio",
					"class" => "mini",
					"type" => "text");
					
	$options[] = array( "name" => __("Portfolio Page Name","official"),
					"desc" => __("Portfolio Page Name.","official"),
					"id" => "portfolio_page_name",
					"std" => "Portfolio",
					"class" => "mini",
					"type" => "text");
	
	$options[] = array( 'name' => __('Note', 'official'),
						'type' => 'note',
						'class' =>'note_alert',
						'desc' => __('After Changing the <strong>Portfolio Slug</strong> you should go to <strong>Settings</strong> > <strong>Permalinks</strong> and click on <strong>Save Changes</strong> to set the new slug.','official')
						);
						
					
	$options[] = array( "name" => __("Portfolio Filtering?","official"),
						"desc" => __("Turn On/Off the Filtering Portfolio by Categories.","official"),
						"id" => "filtering",
						"type" => "checkbox",
						"std" => 1);
						
	$filter_images = array(
		'st1'=>$admin_images_url.'fst1.gif',
		'st2'=>$admin_images_url.'fst2.gif',
		'st3'=>$admin_images_url.'fst3.gif',
		'st4'=>$admin_images_url.'fst4.gif',
		'st5'=>$admin_images_url.'fst5.gif',
		'st6'=>$admin_images_url.'fst6.gif',
		'st7'=>$admin_images_url.'fst7.gif'
	);
	$options[] = array( "name" => __("Filtering Button Style","official"),
						"desc" => "",
						"id" => "filter_style",
						"type" => "images",
						"std" =>"st1",
						"options" => $filter_images);	
	
	
	$options[] = array( "name" => __("Filtering Button position","official"),
						"desc" => __("Select portfolio buttons position","official"),
						"id" => "filter_align",
						"std" => "tal",
						"type" => "select",
						"class" => "mini",
						"options" => array(
									'tal'=>__("Left","official"),
									'tac'=>__("Center","official"),
									'tar'=>__("Right","official")									
									)
						);
											
																
	$options[] = array( "name" => __("Number of Portfolio items?","official"),
					"desc" => __("Number of portfolio items per page in portfolio pages for pagination.","official"),
					"id" => "number_of_portfolio_item",
					"std" => "12",
					"class" => "mini",
					"type" => "text");		
	
	$options[] = array( "name" => __("Portfolio Excerpt Length","official"),
						"desc" => __("Default is 30 words. Used for Portfolio pages.","official"),
						"id" => "excerpt_portfolio",
						"std" => "30",
						"class" => "mini",
						"type" => "text");
	
	
	$options[] = array( "name" => __("Show View Details button?","official"),
						"desc" => __("This will display the Read More button in the Portfolio pages.","official"),
						"id" => "portfolio_more_button",
						"std" => 1,
						"type" => "checkbox"); 		

	$options[] = array( "name" => __("View Details Button Text","official"),
						"desc" => __("This is the text that will appear on the Portfolio \"More button\".  Default text is <strong>View Details</strong>","official"),
						"id" => "portfolio_button",
						"std" => __("View Details","official"),
						"class" => "mini",
						"type" => "text");
					

	$options[] = array( "name" => __("Thumbnail Zoom Effect?","official"),
						"desc" => __("Turn On/Off the Zoom Effect on hover of thumbnails.","official"),
						"id" => "zoom_effect",
						"type" => "checkbox",
						"std" => 1);					
						
	$options[] = array( 'name' => __('Portfolio Details', 'official'),
						'type' => 'info');
	
	
	$options[] = array( "name" => __("Portfolio Details Page Sidebar Position","official"),
						"desc" => __("Choose which side you would like the sidebar to appear on the Portfolio Details page.","official"),
						"id" => "portfolio_sidebar",
						"std" => "left",
						"type" => "images",
						"options" => array('nosidebar'=> $admin_images_url.'ns.png','right' =>$admin_images_url.'rs.png','left' => $admin_images_url.'ls.png' ));	
	
	
	$options[] = array( "name" => __("Show Next and Previous buttons?","official"),
						"desc" => __("This will display the next and previous Project links on project Details page.","official"),
						"id" => "portfolio_nav",
						"std" => 1,
					    "type" => "checkbox"); 
						
																	
	$options[] = array( "name" => __("Show Share Buttons in Portfolio Details?","official"),
						"desc" => __("Turn On/Off the Share buttons in Portfolio details","official"),
						"id" => "portfolio_share",
						"type" => "checkbox",
						"std" => 1);	
						
																		
	$options[] = array( "name" => __("Show Author Info on Project Details?","official"),
						"desc" => __("This will display the Author Name & Biography in the Project Details page. You can edit the Author Biography under Users > Profiles.","official"),
						"id" => "portfolio_author_info",
						"std" => 1,
					    "type" => "checkbox"); 
	

		
						
	$options[] = array( "name" => __("Share Buttons Title","official"),
						"desc" => __("The Title of share buttons box, Default is <strong>Share This Project</strong>","official"),
						"id" => "share_title_portfolio",
						"std" => __("Share This Project","official"),
						"class" => "mini",
						"type" => "text");	
					
	
	$options[] = array( "name" => __("Show Related Projects on Portfolio Detail?","official"),
						"desc" => __("Related projects show in the bottom of project details page.","official"),
						"id" => "related_portfolio",
						"std" => 1,
						"type" => "checkbox"); 
	
	$options[] = array( "name" => __("Related Projects Title","official"),
						"desc" => __("The Title of Related Projects, Default is <strong>Related Projects</strong>","official"),
						"id" => "related_portfolio_title",
						"std" => __("Related Projects","official"),
						"class" => "mini",
						"type" => "text");
						
						
						
	$options[] = array( "name" => __("Enable Comments?","official"),
						"desc" => __("This will display the Comments in the Portfolio details page.","official"),
						"id" => "portfolio_comment",
						"std" => 1,
					    "type" => "checkbox"); 	
						
	
	
	$options[] = array( "name" => __("Project details show style","official"),
						"desc" => __("Select project details style to show in project details page.","official"),
						"id" => "project_details",
						"std" => "acc",
						"type" => "select",
						"class" => "mini",
						"options" => array(
									'simple'=>__("Simple","official"),
									'acc'=>__("Accordion Style","official")									
									)
						);				
	
	
	
	
	
	// Woocommerce Settings /////////////////////////////////	
	$options[] = array("name" => __("Woocommerce","official"),
						"class" => "woo",
						"type" => "heading");
						
										
	$options[] = array( "name" => __("Shop Sidebar Position","official"),
						"desc" => __("Choose which side you would like the sidebar to appear on the shop page. (Shop Page Layout)","official"),
						"id" => "woo_sidebar",
						"std" => "right",
						"type" => "images",
						"options" => array('nosidebar'=> $admin_images_url.'ns.png','right' =>$admin_images_url.'rs.png','left' => $admin_images_url.'ls.png' ));	
	
	
	$options[] = array( "name" => __("Number of products columns","official"),
						"desc" => __("Select how many columns you want to display in the shop page.","official"),
						"id" => "woo_col",
						"type" => "images",
						"std" =>"3",
						"options" => $col_images);
						
						
	$options[] = array( "name" => __("Number of shop items?","official"),
						"desc" => __("Number of shop items per page in shop pages for pagination.","official"),
						"id" => "woo_item",
						"std" => "12",
						"class" => "mini",
						"type" => "text");
	
	
	
	$options[] = array( "name" => __("Shop Page Title","official"),
						"desc" => __("Please enter your shop page title","official"),
						"id" => "woo_shop_title",
						"std" => "Shop",
						"class" => "mini",
						"type" => "text");
	
	
	$options[] = array( "name" => __("Breadcrumbs Background Image","official"),
						"desc" => __("Upload Breadcrumbs Background Image or paste Image URL, This will override the default breadcrumbs background image.","official"),
						"id" => "woo_breadcrumbs_bg_img",
						"std" => "",
						"type" => "upload");
						
	$options[] = array( "name" => __("Dark Text?","official"),
						"desc" => __("Turn On/Off the Dark Text style","official"),
						"id" => "woo_dark_text",
						"std" => 0,
					    "type" => "checkbox"); 
														

	$options[] = array( "name" => __("Shop Page Title Type","official"),
						"desc" => __("Select Shop page Title type.","official"),
						"id" => "woo_title_type",
						"std" => "cpmb_breadcrumbs",
						"type" => "select",
						"options" => $title_type
						);
	
	$options[] = array( "name" => __("Overlay Header","official"),
						"desc" => __("Turn On the overlay Header if you want to have header on top of featured image or slider","official"),
						"id" => "woo_header_overlay",
						"std" => 0,
					    "type" => "checkbox"); 
						
						
	$options[] = array( 'name' => __('Shopping Cart Icon', 'official'),
						'type' => 'info');
	
	$options[] = array( "name" => __("Show Shopping Cart in top Menu?","official"),
						"desc" => __("Turn On/Off the Shopping Cart icon in top menu.","official"),
						"id" => "woo_cart_icon",
						"std" => 1,
					    "type" => "checkbox"); 

	$options[] = array( "name" => __("Shopping Cart Top Margin","official"),
						"desc" => __("Enter Shopping Cart Margin from Top (Default is 52px)","official"),
						"id" => "woo_cart_margin",
						"std" => "52px",
						"class" => "mini",
						"type" => "text");
	
	$sc_vk=array('bag2','bag21','bag22','basket17','basket4','cart1','cart2','cart4','cupcake2','ecommerce7','grocery6','picnic','shopping10','shopping101','shopping11','shopping111','shopping122','shopping140','shopping143','shopping20','shopping223','shopping31','shopping38','shopping58','shopping63','shopping64','shopping66','shopping69','shopping82','stock1');
	$sc_arr=array_combine($sc_vk,$sc_vk);

	$options[] = array( "name" => __("Shopping Cart Icon","official"),
						"id" => "woo_cart_type",
						"type" => "carticon",
						"std" =>"cart1",
						"options" => $sc_arr);
								
	$options[] = array( 'name' => __('Woocommerce Colors', 'official'),
						'type' => 'info');
						
						
	$options[] = array( 'name' => __('Note', 'official'),
						'type' => 'note',
						'class' =>'note_info',
						'desc' => __('For Live Colors settings please go to <a href="customize.php">Theme Customize</a> &gt; <strong>Woocommerce Colors</strong> ','official')
						);
						
										
											
	// Footer Settings /////////////////////////////////	
	$options[] = array("name" =>  __("Footer Settings","official"),
						"class" => "footer",
						"type" => "heading");

	
			
	$options[] = array( "name" => __("Number of Footer Columns","official"),
						"desc" => __("Select how many columns you want to display in the footer.","official"),
						"id" => "footer_col",
						"type" => "images",
						"std" =>"4",
						"options" => $col_images);		

	
	
	$options[] = array( "name" =>  __("Footer Text","official"),
						"desc" =>  __("Add your copyright phrase or any text to be displayed below the footer.","official"),
						"id" => "footer_text",
						"std" => "Copyright &copy; 2014 Official Theme. Designed by <a href='http://themeforest.net/user/tohidgolkar?ref=tohidgolkar' target='_blank'>Tohid Golkar</a>.",
						"type" => "editor");
	
	
	$options[] = array( "name" => __("Show Go To Top button?","official"),
						"desc" => __("Turn On/Off the <strong>Got To Top</strong> button","official"),
						"id" => "footer_gototop",
						"std" => 1,
					    "type" => "checkbox"); 
	
	
	
	$options[] = array( "name" => __("Custom footer Background Image","official"),
						"desc" => __("Upload footer Background Image or paste Image URL","official"),
						"id" => "footer_bg_img",
						"std" => "",
						"type" => "upload");
						
	
	$options[] = array( "name" => __("Footer Bottom Line","official"),
						"desc" => __("Footer bottom line height, if you want to remove it please select 0","official"),
						"id" => "footer_line",
						"std" => "5px",
						"type" => "select",
						"class" => "mini",
						"options" => array( '0'=>'0px','1'=>'1px','2'=>'2px','3'=>'3px','4'=>'4px','5'=>'5px',
											'6'=>'6px','7'=>'7px','8'=>'8px','9'=>'9px','10'=>'10px','11'=>'11px',
											'12'=>'12px','13'=>'13px','14'=>'14px','15'=>'15px','16'=>'16px',
											'17'=>'17px','18'=>'18px','19'=>'19px','20'=>'20px'));
						
	
	

						
	//Sliders Settings /////////////////////////////////	
	$options[] = array("name" => __("Sliders Settings","official"),
						"class" => "slider",
						"type" => "heading");
						
	
						
	$options[] = array( "name" => __("Revolution Slider custom style?","official"),
						"desc" => __("Turn On/Off Official custom style for Revolution Slider.","official"),
						"id" => "rev_cs",
						"std" => 1,
					    "type" => "checkbox"); 
	
	
	/*Nivo and Flex */
	$options[] = array("name" => __("Global Settings","official"),
						"type" => "info");
	
	

	
		
						
	$options[] = array( "name" => __("Slider Pause Time","official"),
						"desc" => __("Enter slider pause time in milisecond(for example: 4000 = 4sec)","official"),
						"id" => "slider_pause_time",
						"std" => "4000",
						"class" => "mini",
						"type" => "text");
						
	$options[] = array( "name" => __("Slider Transition Time","official"),
						"desc" => __("Enter slider transition time in milisecond (for example: 700 = 0.7sec)","official"),
						"id" => "slider_speed",
						"std" => "700",
						"class" => "mini",
						"type" => "text");						
					

	
	/* Nivo Slider */
	$options[] = array("name" => __("Nivo Slider Settings","official"),
						"type" => "info");
	
	$options[] = array( "name" => __("Slider Style","official"),
						"desc" => __("Select Slider Style","official"),
						"id" => "nivo_slider_style",
						"std" => "full",
						"type" => "select",
						"class" => "mini",
						"options" => array('full'=>'Full Width','boxed'=>'Boxed with Margin'));
	
	$options[] = array( "name" => __("Slider Shadow","official"),
						"desc" => __("Select Slider Shadow (Works on Boxed style of slider)","official"),
						"id" => "nivo_slider_shadow",
						"std" => "noshadow",
						"type" => "select",
						"class" => "mini",
						"options" => array('noshadow'=>'No Shadow','lightshadow'=>'Light Shadow','mediumshadow'=>'Medium Shadow','hardshadow'=>'Hard Shadow'));
							
				
					
	/* Flex Slider */
	$options[] = array("name" => __("Flex Slider Settings","official"),
						"type" => "info");
	
	$options[] = array( "name" => __("Slider Direction","official"),
						"desc" => __("Select Slider direction of transition","official"),
						"id" => "flex_slider_direction",
						"std" => "horizontal",
						"type" => "select",
						"class" => "mini",
						"options" => array('horizontal'=>'Horizontal','vertical'=>'Vertical','fade'=>'Fade'));									

	
	/* Kwicks Slider */
	$options[] = array("name" => __("Kwicks Slider Settings","official"),
						"type" => "info");
						
	$options[] = array( "name" => __("Kwick Slides Height","official"),
						"desc" => __("Enter slides Height in Pixel (Default is 315)","official"),
						"id" => "kwick_height",
						"std" => "315",
						"class" => "mini",
						"type" => "text");
	
	
	$options[] = array( "name" => __("Kwick Slide Max Size","official"),
						"desc" => __("Enter Max size of each slide on hover (Default is 750)","official"),
						"id" => "kwick_maxsize",
						"std" => "750",
						"class" => "mini",
						"type" => "text");
						
	$options[] = array( "name" => __("Kwick Slides Spacing","official"),
						"desc" => __("Enter slides spacing (Default is 0)","official"),
						"id" => "kwick_spacing",
						"std" => "0",
						"class" => "mini",
						"type" => "text");
						
	$options[] = array( "name" => __("Rounded Corners?","official"),
						"desc" => __("Turn On/Off the Rounded corners of Slider","official"),
						"id" => "kwicks_rounded",
						"std" => 1,
					    "type" => "checkbox");
						
	
	/* 3D Slice Slider */
	$options[] = array("name" => __("3D Slice Slider Settings","official"),
						"type" => "info");
						
						
	$options[] = array( "name" => __("Slider Orientation","official"),
						"desc" => __("Select Slider Orientation","official"),
						"id" => "slider_orientation",
						"std" => "r",
						"type" => "select",
						"class" => "mini",
						"options" => array('r'=>'Random','v'=>'Vertical','h'=>'Horizontal'));					
						
	$options[] = array( "name" => __("Show Shadow?","official"),
						"desc" => __("Turn On/Off the shadow of slider.","official"),
						"id" => "slice_shadow",
						"std" => 1,
					    "type" => "checkbox"); 
						

	$options[] = array( "name" => __("Show Border","official"),
						"desc" => __("Turn On/Off the Border of slider.","official"),
						"id" => "slice_border",
						"std" => 0,
					    "type" => "checkbox");
						
	
	$options[] = array( "name" => __("Rounded Corners?","official"),
						"desc" => __("Turn On/Off the Rounded corners of Slider, Buttons and Caption","official"),
						"id" => "slice_rounded",
						"std" => 1,
					    "type" => "checkbox");
						
						
	/* Lite Accordion */
	$options[] = array("name" => __("Lite Accordion Settings","official"),
						"type" => "info");
							
						
	
	$options[] = array( "name" => __("Lite Accordion Height","official"),
						"desc" => __("Enter Lite Accordion height in px (default is 300)","official"),
						"id" => "acc_height",
						"std" => "300",
						"class" => "mini",
						"type" => "text");
	
	$options[] = array( "name" => __("Lite Accordion Theme","official"),
						"desc" => __("Please select the Theme of Accordion","official"),
						"id" => "acc_theme",
						"std" => "light",
						"type" => "select",
						"class" => "mini",
						"options" => array('flat' => __('Flat','official'),'basic' => __('Basic','official'), 'light' => __('Light','official'), 'dark' => __('Dark','official'), 'stitch' => __('Stitch','official')));	
						
						
						
																													
						
	// Social Icons Settings /////////////////////////////////	
	$options[] = array("name" => __("Social &amp; Shares","official"),
						"class" => "social",
						"type" => "heading");

	$options[] = array( "name" => __("Show Social Icons in Header?","official"),
						"desc" => __("Turn On/Off the Social icons in the Header.  Note: They will only appear if you have set a link below.","official"),
						"id" => "header_social_icons",
						"std" => 1,
					    "type" => "checkbox"); 
	
	$options[] = array( "name" => __("Margin Top","official"),
						"desc" => __("Enter Header Social Icons Margin from Top (Default is 48px) only works on Header style 1,3,6","official"),
						"id" => "social_margin_top",
						"std" => "48px",
						"class" => "mini",
						"type" => "text");					
						
	$options[] = array( "name" => __("Social Icon Styles","official"),
						"desc" => __("Please select the Style of Social Icons","official"),
						"id" => "social_style",
						"std" => "rs",
						"type" => "select",
						"class" => "mini",
						"options" => array('rs' => __('Rounded Square','official'),'circular' => __('Circular','official')));	
	
	$options[] = array( "name" => __("Border?","official"),
						"desc" => __("Turn On/Off the Social icons Border.","official"),
						"id" => "social_border",
						"std" => 1,
					    "type" => "checkbox"); 
	
	$options[] = array( "name" => __("Show Social Icons Tooltip?","official"),
						"desc" => __("Turn On/Off the Social icons Tooltip","fficial"),
						"id" => "social_icons_tooltip",
						"std" => 1,
					    "type" => "checkbox"); 					
	
	
	$options[] = array( "name" => __("Tooltip Style","official"),
						"desc" => __("Please select the Tooltip Style","official"),
						"id" => "social_icons_tipstyle",
						"std" => "toptip",
						"type" => "select",
						"class" => "mini",
						"options" => array('toptip' => __('Display on Top','official'),'righttip' => __('Display on Right','official'),'bottomtip' => __('Display on Bottom','official'),'lefttip' => __('Display on Left','official')));	
						
											
						
	$options[] = array( "name" => __("Open links in new window?","official"),
						"desc" => __("Turn On/Off the links target (Open links in new window or in current window)","official"),
						"id" => "social_icons_link_target",
						"std" => 1,
					    "type" => "checkbox"); 	
						
					
															
    $options[] = array( "name" => __("Twitter Link","official"),
						"desc" => __("Enter the Twitter Link that you would like to use for the social-networking icons. Use http://","official"),
						"id" => "twitter_link",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => __("Facebook Link","official"),
						"desc" => __("Enter the Facebook Link that you would like to use for the social-networking icons. Note: Use http://","official"),
						"id" => "facebook_link",
						"std" => "",
						"type" => "text");

						
	$options[] = array( "name" => __("Pinterest Link","official"),
						"desc" => __("Enter the Pinterest Link that you would like to use for the social-networking icons. Use http://","official"),
						"id" => "pinterest_link",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => __("GitHub Link","official"),
						"desc" => __("Enter the GitHub Link that you would like to use for the social-networking icons. Use http://","official"),
						"id" => "github_link",
						"std" => "",
						"type" => "text");
						

	
	$options[] = array( "name" => __("Flickr Link","official"),
						"desc" => __("Enter the Flickr Link that you would like to use for the social-networking icons. Use http://","official"),
						"id" => "flickr_link",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => __("Google Plus Link","official"),
						"desc" => __("Enter the Google Plus Link that you would like to use for the social-networking icons. Use http://","official"),
						"id" => "google_link",
						"std" => "",
						"type" => "text");
	
	$options[] = array( "name" => __("YouTube Link","official"),
						"desc" => __("Enter the YouTube Link that you would like to use for the social-networking icons. Use http://","official"),
						"id" => "youtube_link",
						"std" => "",
						"type" => "text");
	
	$options[] = array( "name" => __("Dribbble Link","official"),
						"desc" => __("Enter the Dribbble Link that you would like to use for the social-networking icons. Use http://","official"),
						"id" => "dribbble_link",
						"std" => "",
						"type" => "text");
	
	$options[] = array( "name" => __("Instagram Link","official"),
						"desc" => __("Enter the Instagram Link that you would like to use for the social-networking icons. Use http://","official"),
						"id" => "instagram_link",
						"std" => "",
						"type" => "text");
											
	$options[] = array( "name" => __("LinkedIn Link","official"),
						"desc" => __("Enter the LinkedIn Link that you would like to use for the social-networking icons. Use http://","official"),
						"id" => "linkedin_link",
						"std" => "",
						"type" => "text");

	
	$options[] = array( "name" => __("Skype Link","official"),
						"desc" => __("Enter the Skype Link that you would like to use for the social-networking icons. Use http://","official"),
						"id" => "skype_link",
						"std" => "",
						"type" => "text");										
	

	$options[] = array( "name" => __("Tumblr Link","official"),
						"desc" => __("Enter the Tumblr Link that you would like to use for the social-networking icons. Use http://","official"),
						"id" => "tumblr_link",
						"std" => "",
						"type" => "text");
				
						
	$options[] = array( "name" => __("RSS Feed","official"),
						"desc" => __("Enter the RSS Feed that you would like to use for the social-networking icons. Use http://","official"),
						"id" => "rss_link",
						"std" => "",
						"type" => "text");
	
	
	$options[] = array( "name" => __("Email Address","official"),
						"desc" => __("Enter the email address that you would like to use for the social-networking icons.","official"),
						"id" => "email_address",
						"std" => "",
						"type" => "text");
						
											
	$options[] = array( "name" => __("Sitemap","official"),
						"desc" => __("Enter the Sitemap link that you would like to use for the social-networking icons. Use http://","official"),
						"id" => "sitemap_link",
						"std" => "",
						"type" => "text");
	
	
	$options[] = array("name" => __("Share Buttons","official"),
						"type" => "info");
						
	
	$share_button_array = array( "facebook" => "Facebook", "twitter" => "Twitter", "linkedin" => "LinkedIn", "reddit" => "Reddit", "digg" => "Digg", "delicious" => "Delicious", "google" => "Google" , "email" => "Email" );
	$share_button_defaults = array( "facebook" => "1", "twitter" => "1", "linkedin" => "1", "reddit" => "1", "digg" => "1", "delicious" => "1", "google" => "1" , "email" => "1" );

	$options[] = array( "name" => __("Share Buttons","official"),
						"desc" => __("Turn On/Off buttons you want to display in Blog or Portfolio details page.","official"),
						"id" => "share_button",
						"type" => "multicheck",
						"options" => $share_button_array,
						"std" => $share_button_defaults);				
	
											
	// Recent Posts Carousel Settings /////////////////////////////////	
	$options[] = array("name" => __("Blog Carousel","official"),
						"class" => "recentposts",
						"type" => "heading");


				
	$options[] = array( "name" => __("Carousel Speed","official"),
						"desc" => __("Enter carousel speed time in milisecond (for example: 1000 = 1sec)","official"),
						"id" => "rp_carousel_speed",
						"std" => "1000",
						"class" => "mini",
						"type" => "text");
						
	$options[] = array( "name" => __("Carousel Pause Time","official"),
						"desc" => __("Enter carousel pause time in milisecond (for example: 4000 = 4sec)","official"),
						"id" => "rp_carousel_pause_time",
						"std" => "4000",
						"class" => "mini",
						"type" => "text");			
	

						
						
	$options[] = array( "name" => __("Posts Order by:","official"),
						"desc" => __("Choose Date or Menu Order for Blog Posts carousel sort order.","official"),
						"id" => "orderby_rp_carousel",
						"std" => "date",
						"type" => "select",
						"class" => "mini",
						"options" => array('date' => __('Date','official'), 'menu_order' => __('Menu Order','official')));	
						
						
	$options[] = array( "name" => __("Posts Order","official"),
						"desc" => __("Choose ASC (Ascending) or DESC (Descending) for Blog Posts order in carousel .","official"),
						"id" => "order_rp_carousel",
						"std" => "DESC",
						"type" => "select",
						"class" => "mini",
						"options" => array('ASC' => __('ASC','official'), 'DESC' => __('DESC','official')));
						
										

	// Portfolio Carousel Settings /////////////////////////////////	
	$options[] = array("name" => __("Portfolio Carousel","official"),
						"class" => "portfolioc",
						"type" => "heading");

				
	$options[] = array( "name" => __("Carousel Speed","official"),
						"desc" => __("Enter carousel speed time in milisecond (for example: 1000 = 1sec)","official"),
						"id" => "portfolio_carousel_speed",
						"std" => "1000",
						"class" => "mini",
						"type" => "text");
						
	$options[] = array( "name" => __("Carousel Pause Time","official"),
						"desc" => __("Enter carousel pause time in milisecond (for example: 4000 = 4sec)","official"),
						"id" => "portfolio_carousel_pause_time",
						"std" => "4000",
						"class" => "mini",
						"type" => "text");					

	
	$options[] = array( "name" => __("Portfolio Order by:","official"),
						"desc" => __("Choose Date or Menu Order for Portfolio carousel sort order.","official"),
						"id" => "orderby_portfolio_carousel",
						"std" => "menu_order",
						"type" => "select",
						"class" => "mini",
						"options" => array('date' => __('Date','official'), 'menu_order' => __('Menu Order','official')));	
						
						
	$options[] = array( "name" => __("Portfolio Order","official"),
						"desc" => __("Choose ASC (Ascending) or DESC (Descending) for Portfolio order in carousel .","official"),
						"id" => "order_portfolio_carousel",
						"std" => "ASC",
						"type" => "select",
						"class" => "mini",
						"options" => array('ASC' => __('ASC','official'), 'DESC' => __('DESC','official')));
			
	
	// Clients Carousel Settings /////////////////////////////////	
	$options[] = array("name" => __("Clients Carousel","official"),
						"class" => "clients",
						"type" => "heading");
	
						
	$options[] = array( "name" => __("Number of Items in Carousel","official"),
						"desc" => __("Enter number of Item you want to display in carousel.","official"),
						"id" => "number_of_clients",
						"std" => "10",
						"class" => "mini",
						"type" => "text");
						
	$options[] = array( "name" => __("Carousel Pause Time","official"),
						"desc" => __("Enter carousel pause time in milisecond (for example: 4000 = 4sec)","official"),
						"id" => "carousel_pause_time",
						"std" => "4000",
						"class" => "mini",
						"type" => "text");
						
	$options[] = array( "name" => __("Carousel Speed","official"),
						"desc" => __("Enter carousel speed time in milisecond (for example: 1000 = 1sec)","official"),
						"id" => "carousel_speed",
						"std" => "1000",
						"class" => "mini",
						"type" => "text");					

	
	$options[] = array( "name" => __("Clients Order by:","official"),
						"desc" => __("Choose Date or Menu Order for Clients carousel sort order.","official"),
						"id" => "orderby_clients_carousel",
						"std" => "menu_order",
						"type" => "select",
						"class" => "mini",
						"options" => array('date' => __('Date','official'), 'menu_order' => __('Menu Order','official')));	
						
						
	$options[] = array( "name" => __("Clients Order","official"),
						"desc" => __("Choose ASC (Ascending) or DESC (Descending) for Clients order in carousel .","official"),
						"id" => "order_clients_carousel",
						"std" => "ASC",
						"type" => "select",
						"class" => "mini",
						"options" => array('ASC' => __('ASC','official'), 'DESC' => __('DESC','official')));
						


	// Lightbox //////////////////////////////////////////////////////////////////////					
	$options[] = array("name" => __("Lightbox","official"),
						"class" => "lightbox",
						"type" => "heading");
	
	$lb_images = array(
		'pp_default'=>$admin_images_url.'lb/pp.png',
		'light_rounded'=>$admin_images_url.'lb/lr.png',
		'dark_rounded'=>$admin_images_url.'lb/dr.png',
		'light_square' =>$admin_images_url.'lb/ls.png',
		'dark_square'=>$admin_images_url.'lb/ds.png',
		'facebook'=>$admin_images_url.'lb/fb.png',
		);
	$options[] = array( "name" =>__("Lightbox Theme","official"),
						"id" => "lb_theme",
						"class" => "widelb",
						"type" => "images",
						"std" =>'pp_default',
						"options" => $lb_images);
						
						
	$options[] = array( "name" => __("Animation Speed","official"),
						"desc" =>  __("Speed of lightbox animation Slow, Normanl or Fast","official"),
						"id" => "lb_animation_speed",
						"std" => "fast",
						"class" => "mini",
						"type" => "select",
						"options" => array('fast' => __('Fast','official'), 'slow' => __('Slow','official'), 'normal' => __('Normal','official')));
	
	$options[] = array( "name" => __("Overlay Opacity","official"),
						"desc" =>  __("Overlay background opacity a number between 0 to 1","official"),
						"id" => "lb_opacity",
						"class" => "mini",
						"std" => "0.8",
						"type" => "text");
	
	$options[] = array( "name" => __("Show title?","official"),
						"desc" => __("Turn On/Off the title showing in lightbox","official"),
						"id" => "lightbox_title",
						"std" => 1,
						"type" => "checkbox");
						
	$options[] = array( "name" => __("Show Gallery Thumbnails?","official"),
						"desc" => __("Turn On/Off the gallery thumbnails in the lightbox","official"),
						"id" => "lb_gallery",
						"std" => 1,
						"type" => "checkbox");
	
	$options[] = array( "name" => __("Autoplay Gallery?","official"),
						"desc" => __("Turn On/Off the autoplay the lightbox gallery","official"),
						"id" => "lb_autoplay",
						"std" => 0,
						"type" => "checkbox");
	
	$options[] = array( "name" => __("Gallery Slideshow Speed","official"),
						"desc" => __("If autoplay is set to true, select the slideshow speed in ms. (Default: 5000, 1000 ms = 1 second)","official"),
						"id" => "lb_slideshow_speed",
						"std" => "5000",
						"class" => "mini",
						"type" => "text");
						
	$options[] = array( "name" => __("Resizable?","official"),
						"desc" => __("Turn On/Off the Resizing for big images.","official"),
						"id" => "lb_resize",
						"std" => 1,
						"type" => "checkbox");							
	
	$options[] = array( "name" => __("Gallery Separator","official"),
						"desc" => __("The separator for the gallery counter 1 \"of\" 2","official"),
						"id" => "lb_sep",
						"std" => "of",
						"class" => "mini",
						"type" => "text");					
						
	$options[] = array( "name" => __("Social Icons","official"),
						"desc" => __("Turn On/Off the social sharing icons in lightbox","official"),
						"id" => "lb_social",
						"std" => 1,
						"type" => "checkbox");		
						
	$options[] = array( "name" => __("Turn OFF Lightbox on Small Devices?","official"),
						"desc" => __("Turn On/Off the Lightbox on small devices such as smartphones. This will link directly to the image on small devices.","official"),
						"id" => "lb_small",
						"std" => 1,
						"type" => "checkbox");							
						
						
						
	// TOOLS //////////////////////////////////////////////////////////////////////					
	$options[] = array("name" => __("Tools","official"),
						"class" => "tools",
						"type" => "heading");
	
	$options[] = array( "name" => __("Breadcrumb Text","official"),
					"desc" => __("This is the text will appear before the breadcrumb. Default is nothing (empty)","official"),
					"id" => "breadcrumb_title",
					"std" => "You are here:",
					"class" => "mini",
					"type" => "text");
					
	$options[] = array( "name" => __("Breadcrumb Separator","official"),
					"desc" => __("This is the text will separate breadcrumb items.","official"),
					"id" => "bread_crumb_sep",
					"std" => "/",
					"class" => "mini",
					"type" => "text");
					
	
	$options[] = array( "name" => __("Date and Time Format","official"),
						"desc" => __('Date and Time format, <a href="http://codex.wordpress.org/Formatting_Date_and_Time" target="_blank" >Documentation on date and time formatting</a>','official'),
						"id" => "date_format",
						"std" => "jS M Y",
						"class" => "mini",
						"type" => "text");
	
	$options[] = array("name" => __("RTL Language Support","official"),
						"type" => "info");					
				
	$options[] = array( "name" => __("Right to Left (RTL) Language Support?","official"),
						"desc" => __("If you want to run a RTL Language website on English WP back-end (any LTR Language) you can turn on this feature to add RTL Css to your website.","official"),
						"id" => "rtl_support",
						"type" => "checkbox",
						"std" => 0);
						

						
	
	$options[] = array("name" => __("Error 404","official"),
						"type" => "info");
									

	$options[] = array( "name" => __("404 Error Title","official"),
						"desc" => __("Enter your custom 404 error title.","official"),
						"id" => "e404_title",
						"std" => __("404 Page Not Found","official"),
						"type" => "text");
	
	$options[] = array( "name" => __("404 Error Message Text","official"),
						"desc" => __("Enter your custom 404 error message.","official"),
						"id" => "e404_text",
						"std" =>__("Sorry, We could not find the content you were looking for.","official"),
						"type" => "textarea"); 
	
	
		
						
						
						
	//Custom Codes //////////////////////////////////////////////////////////////
	$options[] = array("name" => __("Custom Codes","official"),
						"class" => "custom",
						"type" => "heading");	
				

	$options[] = array( "name" => __("Custom CSS","official"),
						"desc" => __("Paste your custom css here... <br /><strong>NOTE:</strong> You don't need to add &lt;style&gt; tags","official"),
						"id" => "custom_css",
						"std" => "",
						"type" => "textarea"); 
	
	$options[] = array( "name" => __("Custom Javascript","official"),
						"desc" => __("Paste your custom JavaScript code here... <br /><strong>NOTE:</strong> You don't need to add &lt;script&gt; tags<br/><br/>This will add to Footer of page.","official"),
						"id" => "custom_js",
						"std" => "",
						"type" => "textarea"); 
						
						
	$options[] = array( "name" => __("Track Code","official"),
						"desc" => __("Paste your Track Code here (for example: Google Analytics) <br /><strong>NOTE:</strong> You don't need to add &lt;script&gt; tags<br/><br/>This will add to Footer of page.","official"),
						"id" => "track_code",
						"type" => "textarea"); 							
	
	
	
	
	// Maintenance ////////////////////////////////////////
	$options[] = array("name" => __("Maintenance","official"),
						"class" => "main",
						"type" => "heading");
	


	$options[] = array( "name" => __("Maintenance Mode","official"),
						"desc" => __("Turn On/Off Maintenace mode.","official"),
						"id" => "main_mode",
						"type" => "checkbox",
						"std" => 0);
	
	
	$options[] = array( "name" => __("Maintenance Page","official"),
						"desc" => __("Please select maintenace mode page","official"),
						"id" => "main_page",
						"std" => "default",
						"type" => "select",
						"class" => "mini",
						"options" => $options_pages
						);
	
	$options[] = array( "name" => __("Default Maintenance Page Text","official"),
						"desc" => __("Please set your own text for Default Maintenance Page","official"),
						"id" => "main_html",
						"std" => '<p style="text-align:center">We are currently in maintenance mode, please check back shortly.</p>',
						"type" => "editor");									
	
	// Sample Importer ////////////////////////////////////////////////////
	$options[] = array("name" => __("Import Demo","official"),
						"class" => "demo",
						"type" => "heading");
	
	$demo_images = array(
		'demo1'=>$admin_images_url.'demo/d1.jpg',
		'demo2'=>$admin_images_url.'demo/d2.jpg',
		'demo3'=>$admin_images_url.'demo/d3.jpg',
		'demo4'=>$admin_images_url.'demo/d4.jpg',
		'demo5'=>$admin_images_url.'demo/d5.jpg',
		'demo6'=>$admin_images_url.'demo/d6.jpg',
		'demo7'=>$admin_images_url.'demo/d7.jpg',
		'demo8'=>$admin_images_url.'demo/d8.jpg',
		'demo9'=>$admin_images_url.'demo/d9.jpg',
		'demo10'=>$admin_images_url.'demo/d10.jpg',
		'demo11'=>$admin_images_url.'demo/d11.jpg',
		'demo12'=>$admin_images_url.'demo/d12.jpg',
		'demo13'=>$admin_images_url.'demo/d13.jpg',
		'demo14'=>$admin_images_url.'demo/d14.jpg',
		'demo15'=>$admin_images_url.'demo/d15.jpg',
		'demo16'=>$admin_images_url.'demo/d16.jpg',
		'demo17'=>$admin_images_url.'demo/d17.jpg',
		'demo18'=>$admin_images_url.'demo/d18.jpg',
		'demo19'=>$admin_images_url.'demo/d19.jpg',
		'demo20'=>$admin_images_url.'demo/d20.jpg',
		'demo21'=>$admin_images_url.'demo/d21.jpg',
		'demo22'=>$admin_images_url.'demo/d22.jpg'
		

	);
	$options[] = array( "name" => __("One Click Demo Intaller","official"),
						"desc" => __("Please select your sample demo and click on <strong>Import Demo</strong> button.<br/><br/><strong>NOTE:</strong> It will take some minutes, please wait for finishing the import process.","official"),
						"id" => "demo",
						"type" => "demo",
						"options" => $demo_images); 
						
	
	// Backup //////////////////////////////////////////////////////////////
	$options[] = array("name" => __("Backup","official"),
						"class" => "backup",
						"type" => "heading");
	
	
	$options[] = array( "name" => __("Backup","official"),
						"desc" => __("Backup and restore your theme options<br /><strong>NOTE:</strong>For WPML Users: You should get backup for each language.","official"),
						"id" => "track_code",
						"type" => "backup"); 
						
	
	return $options;
	
	
}