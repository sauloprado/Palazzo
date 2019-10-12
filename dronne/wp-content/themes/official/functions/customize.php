<?php
/*
 * Theme Customize
 *
 * Theme: Official
 * Author: Tohid Golkar
 * Website: http://tohidgolkar.com
 */
 
if (!function_exists('color_customize_register')) {
	function color_customize_register($wp_customize){
		
		
		// Main Colors ------------------------------------------------
		$colors = array();
		$colors[] = array( 'slug'=>'theme_color', 'default' => '#191919', 'label' => __( 'Theme Color', 'official' ) );
		$colors[] = array( 'slug'=>'bg_color', 'default' => '#FFFFFF', 'label' => __( 'Background Color', 'official' ) );
		$colors[] = array( 'slug'=>'links_color', 'default' => '#000000', 'label' => __( 'Links Color', 'official' ) );
		$colors[] = array( 'slug'=>'hover_color', 'default' => '#ACACAC', 'label' => __( 'Links Hover Color', 'official' ) );
		$colors[] = array( 'slug'=>'extrapanel_color', 'default' => '#000000', 'label' => __( 'Extra Panel Background Color', 'official' ) );
		$colors[] = array( 'slug'=>'button_color', 'default' => '#191919', 'label' => __( 'Buttons Color', 'official' ) );
		$colors[] = array( 'slug'=>'icon_color', 'default' => '#ACACAC', 'label' => __( 'Icons Color', 'official' ) );
		$colors[] = array( 'slug'=>'social_icon_color', 'default' => '#ACACAC', 'label' => __( 'Social Icons Color', 'official' ) );
		$colors[] = array( 'slug'=>'light_icon_color', 'default' => '#FFFFFF', 'label' => __( 'Light Icons Color', 'official' ) );
  
		   // SECTION //
		   $wp_customize->add_section('official_color', array(
			'title' => __('Main Colors', 'official'),
			'description' => __('Select the colors of each part of page that you want.', 'official'),
			'priority' => 30
		   ));
		
	
		  foreach($colors as $color)
		  {
			// SETTINGS //
			$wp_customize->add_setting(
				$color['slug'],
				array( 'default' => $color['default'],
					   'type'		   => 'option',
					   'transport'      => 'postMessage',
						'capability'    => 'edit_theme_options'
					  )
				);
		
			// CONTROLS //
			$wp_customize->add_control(
				new WP_Customize_Color_Control( $wp_customize, $color['slug'],
				array('label' => $color['label'],
					  'section' => 'official_color',
					  'settings' => $color['slug']
					  )
				));
		  }
		  
		
		// Header Colors ------------------------------------------------
		$colors = array();
		$colors[] = array( 'slug'=>'header_color', 'default' => '#FFFFFF', 'label' => __( 'Header Color', 'official' ) );
		$colors[] = array( 'slug'=>'header_text_color', 'default' => '#777777', 'label' => __( 'Header Text Color', 'official' ) );
		$colors[] = array( 'slug'=>'menu_bg_color', 'default' => '#191919', 'label' => __( 'Menu Background Color', 'official' ) );
		$colors[] = array( 'slug'=>'submenu_bg_color', 'default' => '#191919', 'label' => __( 'Sub Menu Background Color', 'official' ) );
		$colors[] = array( 'slug'=>'submenu_text_color', 'default' => '#FFFFFF', 'label' => __( 'Sub Menu Text Color', 'official' ) );
		$colors[] = array( 'slug'=>'menu_ind_color', 'default' => '#FFFFFF', 'label' => __( 'Menu Indicator Color', 'official' ) );
		$colors[] = array( 'slug'=>'menu_icon_color', 'default' => '#FFFFFF', 'label' => __( 'Menu Icon Color', 'official' ) );
		$colors[] = array( 'slug'=>'breadcrumbs_color', 'default' => '#0B0B0B', 'label' => __( 'Breadcrumbs Color', 'official' ) );
		$colors[] = array( 'slug'=>'breadcrumbs_title_color', 'default' => '#FFFFFF', 'label' => __( 'Breadcrumbs Title Color', 'official' ) );
		$colors[] = array( 'slug'=>'breadcrumbs_text_color', 'default' => '#C2C2C2', 'label' => __( 'Breadcrumbs Text Color', 'official' ) );
		
  
		   // SECTION //
		   $wp_customize->add_section('official_h_color', array(
			'title' => __('Header Colors', 'official'),
			'description' => __('Select the colors of each part of page that you want.', 'official'),
			'priority' => 35
		   ));
		
	
		  foreach($colors as $color)
		  {
			// SETTINGS //
			$wp_customize->add_setting(
				$color['slug'],
				array( 'default' => $color['default'],
					   'type'		   => 'option',
					   'transport'      => 'postMessage',
						'capability'    => 'edit_theme_options'
					  )
				);
		
			// CONTROLS //
			$wp_customize->add_control(
				new WP_Customize_Color_Control( $wp_customize, $color['slug'],
				array('label' => $color['label'],
					  'section' => 'official_h_color',
					  'settings' => $color['slug']
					  )
				));
		  }
		  
		// Footer Colors ----------------------------------------------
		$f_colors = array();
		$f_colors[] = array( 'slug'=>'footer_color', 'default' => '#333333', 'label' => __( 'Footer Background Color', 'official' ) );
		$f_colors[] = array( 'slug'=>'footer_text_color', 'default' => '#BFBFBF', 'label' => __( 'Footer Text Color', 'official' ) );
		$f_colors[] = array( 'slug'=>'footer_icon_color', 'default' => '#999999', 'label' => __( 'Footer Icon Color', 'official' ) );
		$f_colors[] = array( 'slug'=>'footer_bottom_color', 'default' => '#101010', 'label' => __( 'Footer Bottom Background Color', 'official' ) );
		$f_colors[] = array( 'slug'=>'footer_bottom_border_color', 'default' => '#101010', 'label' => __( 'Footer Bottom Border Color', 'official' ) );
		$f_colors[] = array( 'slug'=>'footer_links_color', 'default' => '#CCCCCC', 'label' => __( 'Footer Links Color', 'official' ) );
		$f_colors[] = array( 'slug'=>'footer_hover_color', 'default' => '#FFFFFF', 'label' => __( 'Footer Links Hover Color', 'official' ) );
		$f_colors[] = array( 'slug'=>'footer_title_border_color', 'default' => '#FFFFFF', 'label' => __( 'Footer Title Bottom line Color', 'official' ) );
		$f_colors[] = array( 'slug'=>'footer_title_color', 'default' => '#FFFFFF', 'label' => __( 'Footer Title Color', 'official' ) ); 
		$f_colors[] = array( 'slug'=>'copyright_links_color', 'default' => '#FFFFFF', 'label' => __( 'Footer Copyright Links Color', 'official' ) );  
		$f_colors[] = array( 'slug'=>'copyright_text_color', 'default' => '#777777', 'label' => __( 'Footer Copyright Text Color', 'official' ) );
		$f_colors[] = array( 'slug'=>'footer_bottom_menu_color', 'default' => '#FFFFFF', 'label' => __( 'Footer Bottom Menu Color', 'official' ) );
		
		 
		   // SECTION //
		   $wp_customize->add_section('official_f_color', array(
			'title' => __('Footer Colors', 'official'),
			'description' => __('Select the colors of each part of page that you want.', 'official'),
			'priority' => 40
		   ));
		
	
		  foreach($f_colors as $f_color)
		  {
			// SETTINGS //
			$wp_customize->add_setting(
				$f_color['slug'],
				array( 'default' => $f_color['default'],
					   'type'		   => 'option',
					   'transport'      => 'postMessage',
						'capability'    => 'edit_theme_options'
					  )
				);
		
			// CONTROLS //
			$wp_customize->add_control(
				new WP_Customize_Color_Control( $wp_customize, $f_color['slug'],
				array('label' => $f_color['label'],
					  'section' => 'official_f_color',
					  'settings' => $f_color['slug']
					  )
				));
		  }
		  
		
		// Woocommerce Colors ---------------------------------------
		$w_colors = array();
  		$w_colors[] = array( 'slug'=>'cart_icon_color', 'default' => '#A7A7A7', 'label' => __( 'Shopping Cart Icons Color', 'official' ) );
		$w_colors[] = array( 'slug'=>'cart_c_color', 'default' => '#EEEEEE', 'label' => __( 'Shopping Cart Counter Text Color', 'official' ) );
		$w_colors[] = array( 'slug'=>'cart_c_bg', 'default' => '#191919', 'label' => __( 'Shopping Cart Counter Background Color', 'official' ) );
		$w_colors[] = array( 'slug'=>'woo_sale_color', 'default' => '#CC0000', 'label' => __( 'Sale Ribbon Color', 'official' ) );
		
		   // SECTION //
		   $wp_customize->add_section('official_w_color', array(
			'title' => __('Woocommerce Colors', 'official'),
			'description' => __('Select the colors of each part of page that you want.', 'official'),
			'priority' => 50
		   ));
		
	
		  foreach($w_colors as $w_color)
		  {
			// SETTINGS //
			$wp_customize->add_setting(
				$w_color['slug'],
				array( 'default' => $w_color['default'],
					   'type'		   => 'option',
					   'transport'      => 'postMessage',
						'capability'    => 'edit_theme_options'
					  )
				);
		
			// CONTROLS //
			$wp_customize->add_control(
				new WP_Customize_Color_Control( $wp_customize, $w_color['slug'],
				array('label' => $w_color['label'],
					  'section' => 'official_w_color',
					  'settings' => $w_color['slug']
					  )
				));
		  }
		  
	}
	
	
	add_action( 'customize_register', 'color_customize_register' );
 
}


	function thdglkr_customizer_live_preview() {
		wp_enqueue_script( 'thdglkr-customizer',	get_template_directory_uri().'/js/live-customizer.js?4', array( 'jquery','customize-preview' ), NULL, true);
	}
	add_action( 'customize_preview_init', 'thdglkr_customizer_live_preview' );


?>