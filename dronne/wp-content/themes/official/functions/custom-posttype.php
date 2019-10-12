<?php
/*
 * Theme post types.
 *
 * Theme: Official
 * Author: Tohid Golkar
 * Website: http://tohidgolkar.com
 */

/* ---------------------------------------------------------------------------
 * Create new post type: Portfolio
 * --------------------------------------------------------------------------- */
function official_post_type_portfolio() 
{
	$portfolio_item_slug = _option( 'portfolio_item_slug', 'portfolio', true );
	
	$labels = array(
		'name' => __('Portfolio','official'),
		'singular_name' => __('Portfolio item','official'),
		'add_new' => __('Add New','official'),
		'add_new_item' => __('Add New Portfolio item','official'),
		'edit_item' => __('Edit Portfolio item','official'),
		'new_item' => __('New Portfolio item','official'),
		'view_item' => __('View Portfolio item','official'),
		'search_items' => __('Search Portfolio items','official'),
		'not_found' =>  __('No portfolio items found','official'),
		'not_found_in_trash' => __('No portfolio items found in Trash','official'), 
		'parent_item_colon' => ''
	  );
		
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'query_var' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'rewrite' => array( 'slug' => $portfolio_item_slug),
		'supports' => array( 'title', 'editor', 'thumbnail', 'page-attributes', 'comments' ),
	); 
	  
	register_post_type( 'portfolio' ,$args);
}	
  
	register_taxonomy(
		'portfolio_types',
		array('portfolio'),
		array(
		'hierarchical' => true, 
		'label' =>  __('Portfolio categories','official'), 
		'singular_label' =>  __('Portfolio category','official'), 
		'rewrite' => true
		)
	);

add_action( 'init', 'official_post_type_portfolio' );


/* ---------------------------------------------------------------------------
 * Portfolio edit columns
 * --------------------------------------------------------------------------- */
function official_edit_columns_portfolio($columns)
{
	$newcolumns = array(
		"cb" => "<input type=\"checkbox\" />",
		"title" => __('Title','official'),
		"portfolio_thumbnail" => __('Thumbnail','official'),
		"portfolio_types" => __('Categories','official'),
		"comments" => __('Comments', 'official'),
		"portfolio_order" =>  __('Order','official'),
	);
	$columns= array_merge($newcolumns, $columns);	
	
	return $columns;
}
add_filter("manage_edit-portfolio_columns", "official_edit_columns_portfolio");  


/* ---------------------------------------------------------------------------
 * Portfolio custom columns
 * --------------------------------------------------------------------------- */
function official_custom_columns_portfolio($column)
{
	global $post;
	switch ($column)
	{
		case "portfolio_thumbnail":
			if ( has_post_thumbnail() ) { the_post_thumbnail('thumbnail'); }
			break;
		case "portfolio_types":
			echo get_the_term_list($post->ID, 'portfolio_types', '', ', ','');
			break;
		case "portfolio_order":
			echo $post->menu_order;
			break;		
	}
}
add_action("manage_posts_custom_column",  "official_custom_columns_portfolio"); 

// Add Filter to admin page //////////////////////////////////////////////////////////////
add_action( 'restrict_manage_posts', 'portfolio_add_taxonomy_filters' ); 

function portfolio_add_taxonomy_filters() {
	global $typenow;
	$taxonomies = array( 'portfolio_types' );

	if ( $typenow == 'portfolio' ) {
		foreach ( $taxonomies as $tax_slug ) {
			$current_tax_slug = isset( $_GET[$tax_slug] ) ? $_GET[$tax_slug] : false;
			$tax_obj = get_taxonomy( $tax_slug );
			$tax_name = $tax_obj->labels->name;
			$terms = get_terms($tax_slug);
			if ( count( $terms ) > 0) {
				echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
				echo "<option value=''>$tax_name</option>";
				foreach ( $terms as $term ) {
					echo '<option value=' . $term->slug, $current_tax_slug == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>';
				}
				echo "</select>";
			}
		}
	}
}




/* ---------------------------------------------------------------------------
 * Create new post type: Slides
 * --------------------------------------------------------------------------- */
function official_post_type_slides() 
{
	$slider_item_slug = 'slider-item';
	
	$labels = array(
		'name' => __('Slides','official'),
		'singular_name' => __('Slide','official'),
		'add_new' => __('Add New','official'),
		'add_new_item' => __('Add New Slide','official'),
		'edit_item' => __('Edit Slide','official'),
		'new_item' => __('New Slide','official'),
		'view_item' => __('View Slide','official'),
		'search_items' => __('Search Slides','official'),
		'not_found' =>  __('No slides found','official'),
		'not_found_in_trash' => __('No slides found in Trash','official'), 
		'parent_item_colon' => ''
	  );	
	  
	  $args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'query_var' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'rewrite' => array( 'slug' => $slider_item_slug, 'with_front'=>true ),
		'supports' => array( 'title', 'thumbnail',  'page-attributes' ),
	  ); 
	  
	  register_post_type( 'slide' ,$args);
	  
	  register_taxonomy('slider_types','slide',array(
		'hierarchical' => true, 
		'label' =>  __('Slider types','official'), 
		'singular_label' =>  __('Slider type','official'), 
		'rewrite' => true,
		'query_var' => true
	  ));
}
add_action( 'init', 'official_post_type_slides' );


/* ---------------------------------------------------------------------------
 * Slider edit columns
 * --------------------------------------------------------------------------- */
function official_edit_columns_slide($columns)
{

	$newcolumns = array(
		"cb" => "<input type=\"checkbox\" />",
		"slider_thumbnail" => __('Thumbnail','official'),
		"title" => 'Title',
		"slider_types" =>  __('Category','official'),
		"slider_order" => __('Order','official'),
	);
	$columns= array_merge($newcolumns, $columns);	
	
	return $columns;
}
add_filter("manage_edit-slide_columns", "official_edit_columns_slide");  


/* ---------------------------------------------------------------------------
 * Slider custom columns
 * --------------------------------------------------------------------------- */
function official_custom_columns_slide($column)
{
	global $post;
	switch ($column)
	{
		case "slider_thumbnail":
			if ( has_post_thumbnail() ) { the_post_thumbnail('thumbnail'); }
			break;	
		case "slider_order":
			echo $post->menu_order;
			break;
			
		case "slider_types":
			$post_type = get_post_type($post->ID);
			$terms = get_the_terms($post->ID, 'slider_types');
			if ( !empty($terms) ) {
				foreach ( $terms as $term )
            $post_terms[] = "<a href='edit.php?post_type=slide&slider_types={$term->slug}'> " . esc_html(sanitize_term_field('name', $term->name, $term->term_id, 'slider_types', 'edit')) . "</a>";
				echo join( ', ', $post_terms );
			}
			else echo '<i>Not Selected!</i>'; 
			break;	
			
				
	}
}
add_action("manage_posts_custom_column",  "official_custom_columns_slide"); 



/* Add FlexSlider & Nivo Slider to Slider Types*/
function add_custom_term_FlexSlider() {
	if(!term_exists('Flex Slider', 'slider_types')){
		wp_insert_term('Flex Slider', 'slider_types');
	}
}

function add_custom_term_NivoSlider() {
	if(!term_exists('Nivo Slider', 'slider_types')){
		wp_insert_term('Nivo Slider', 'slider_types');
	}
}

function add_custom_term_KwickSlider() {
	if(!term_exists('Kwick Slider', 'slider_types')){
		wp_insert_term('Kwick Slider', 'slider_types');
	}
}

function add_custom_term_3DSliceSlider() {
	if(!term_exists('3D Slice Slider', 'slider_types')){
		wp_insert_term('3D Slice Slider', 'slider_types');
	}
}


function add_custom_term_RoudaboutSlider() {
	if(!term_exists('Roundabout Slider', 'slider_types')){
		wp_insert_term('Roundabout Slider', 'slider_types');
	}
}

function add_custom_term_LiteAccordionSlider() {
	if(!term_exists('Lite Accordion Slider', 'slider_types')){
		wp_insert_term('Lite Accordion Slider', 'slider_types');
	}
}

add_action( 'init', 'add_custom_term_FlexSlider' );
add_action( 'init', 'add_custom_term_NivoSlider' );
add_action( 'init', 'add_custom_term_KwickSlider' );
add_action( 'init', 'add_custom_term_3DSliceSlider' );
add_action( 'init', 'add_custom_term_RoudaboutSlider' );
add_action( 'init', 'add_custom_term_LiteAccordionSlider' );

/* ---------------------------------------------------------------------------
 * Create new post type: Clients
 * --------------------------------------------------------------------------- */
function official_post_type_clients() 
{
	$clients_item_slug = 'clients-item';
	
	$labels = array(
		'name' => __('Clients','official'),
		'singular_name' => __('Client','official'),
		'add_new' => __('Add New','official'),
		'add_new_item' => __('Add New Client','official'),
		'edit_item' => __('Edit Client','official'),
		'new_item' => __('New Client','official'),
		'view_item' => __('View Client','official'),
		'search_items' => __('Search Clients','official'),
		'not_found' =>  __('No Clients found','official'),
		'not_found_in_trash' => __('No Clients found in Trash','official'), 
		'parent_item_colon' => ''
	  );	
	  
	  $args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'query_var' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'rewrite' => array( 'slug' => $clients_item_slug, 'with_front'=>true ),
		'supports' => array( 'title', 'thumbnail',  'page-attributes' ),
	  ); 
	  
	  register_post_type( 'clients' ,$args);
	  
	  register_taxonomy(
		'clients_types',
		array('clients'),
		array(
		'hierarchical' => true, 
		'label' =>  __('Clients categories','official'), 
		'singular_label' =>  __('Clients category','official'), 
		'rewrite' => true
		)
	);
}
add_action( 'init', 'official_post_type_clients' );


/* ---------------------------------------------------------------------------
 * Slider edit columns
 * --------------------------------------------------------------------------- */
function official_edit_columns_clients($columns)
{
	$newcolumns = array(
		"cb" => "<input type=\"checkbox\" />",
		"clients_thumbnail" => __('Thumbnail','official'),
		"title" => 'Title',
		"client_url" => 'URL',
		"clients_types" =>  __('Category','official'),
		"slider_order" => __('Order','official'),
	);
	$columns= array_merge($newcolumns, $columns);	
	
	return $columns;
}
add_filter("manage_edit-clients_columns", "official_edit_columns_clients");  


/* ---------------------------------------------------------------------------
 * Clients custom columns
 * --------------------------------------------------------------------------- */
function official_custom_columns_clients($column)
{
	global $post;
	switch ($column)
	{
		case "clients_thumbnail":
			if ( has_post_thumbnail() ) { the_post_thumbnail('client'); }
			break;	
			
		case "clients_order":
			echo $post->menu_order;
			break;	
			
		case "clients_types":
			echo get_the_term_list($post->ID, 'clients_types', '', ', ','');
			break;
			
		case "client_url":
			$strUrl = get_post_meta( get_the_ID(), 'official_client-url', true ) ;
			if ($strUrl){
				echo '<a href="' . $strUrl . '" target="_blank" >'  . $strUrl . '</a>';
				} else {
				echo 'N/A';	
				}
			
			break;
	}
}
add_action("manage_posts_custom_column",  "official_custom_columns_clients"); 


/* Add Default Clients Categories */
function add_custom_term_clients_clients() {
	if(!term_exists('Clients', 'clients_types')){
		wp_insert_term('Clients', 'clients_types');
	}
}

function add_custom_term_clients_sponsors() {
	if(!term_exists('Sponsors', 'clients_types')){
		wp_insert_term('Sponsors', 'clients_types');
	}
}

function add_custom_term_clients_partners() {
	if(!term_exists('Partners', 'clients_types')){
		wp_insert_term('Partners', 'clients_types');
	}
}

add_action( 'init', 'add_custom_term_clients_clients' );
add_action( 'init', 'add_custom_term_clients_sponsors' );
add_action( 'init', 'add_custom_term_clients_partners' );




/* ---------------------------------------------------------------------------
 * Create new post type: Testimonial
 * --------------------------------------------------------------------------- */
function official_post_type_testimonial() 
{
	$testimonial_item_slug = 'testimonial-item';
	
	$labels = array(
		'name' => __('Testimonials','official'),
		'singular_name' => __('Testimonial','official'),
		'add_new' => __('Add New','official'),
		'add_new_item' => __('Add New Testimonial','official'),
		'edit_item' => __('Edit Testimonial','official'),
		'new_item' => __('New Testimonial','official'),
		'view_item' => __('View Testimonial','official'),
		'search_items' => __('Search Testimonials','official'),
		'not_found' =>  __('No Testimonial found','official'),
		'not_found_in_trash' => __('No Testimonial found in Trash','official'), 
		'parent_item_colon' => ''
	  );	
	  
	  $args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'query_var' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'rewrite' => array( 'slug' => $testimonial_item_slug, 'with_front'=>true ),
		'supports' => array( 'title', 'thumbnail',  'page-attributes' ),
	  ); 
	  
	  register_post_type( 'testimonial' ,$args);
	  
	  register_taxonomy('testimonial_types','testimonial',array(
		'hierarchical' => true, 
		'label' =>  __('Testimonial types','official'), 
		'singular_label' =>  __('Testimonial type','official'), 
		'rewrite' => true,
		'query_var' => true
	  ));
}
add_action( 'init', 'official_post_type_testimonial' );


function add_custom_term_testimonial_testimonial() {
	if(!term_exists('Testimonial', 'testimonial_types')){
		wp_insert_term('Testimonial', 'testimonial_types');
	}
}

function add_custom_term_testimonial_quote() {
	if(!term_exists('Quote', 'testimonial_types')){
		wp_insert_term('Quote', 'testimonial_types');
	}
}

add_action( 'init', 'add_custom_term_testimonial_testimonial' );
add_action( 'init', 'add_custom_term_testimonial_quote' );


/* ---------------------------------------------------------------------------
 * Testimonial edit columns
 * --------------------------------------------------------------------------- */
function official_edit_columns_testimonial($columns)
{

	$newcolumns = array(
		"cb" => "<input type=\"checkbox\" />",
		"testimonial_thumbnail" => __('Thumbnail','official'),
		"testimonial_name" => 'Author',
		"testimonial_types" =>  __('Category','official'),
		"testimonial_order" => __('Order','official'),
	);
	$columns= array_merge($newcolumns, $columns);	
	
	return $columns;
}
add_filter("manage_edit-testimonial_columns", "official_edit_columns_testimonial");  


/* ---------------------------------------------------------------------------
 * Testimonial custom columns
 * --------------------------------------------------------------------------- */
function official_custom_columns_testimonial($column)
{
	global $post;
	switch ($column)
	{
		case "testimonial_thumbnail":
			if ( has_post_thumbnail() ) { the_post_thumbnail('thumbnail'); }
			break;	
		case "testimonial_order":
			echo $post->menu_order;
			break;
			
		case "testimonial_types":
			$post_type = get_post_type($post->ID);
			$terms = get_the_terms($post->ID, 'testimonial_types');
			if ( !empty($terms) ) {
				foreach ( $terms as $term )
            $post_terms[] = "<a href='edit.php?post_type=testimonial&testimonial_types={$term->slug}'> " . esc_html(sanitize_term_field('name', $term->name, $term->term_id, 'testimonial_types', 'edit')) . "</a>";
				echo join( ', ', $post_terms );
			}
			else echo '<i>Not Selected!</i>'; 
			break;	
			
		case "testimonial_name":
			echo get_post_meta( get_the_ID(), 'official_testimonial_name', true ) ;	
			break;	
				
	}
}
add_action("manage_posts_custom_column",  "official_custom_columns_testimonial"); 


/* ---------------------------------------------------------------------------
 * Custom Post Types Icon
 * --------------------------------------------------------------------------- */
 add_action( 'admin_head', 'custom_icons' );
 function custom_icons() { ?>
	    <style type="text/css">
			#menu-posts-clients .menu-icon-post div.wp-menu-image:before {content: "\f307";color:#2EA2CC}
			#menu-posts-testimonial .menu-icon-post div.wp-menu-image:before {content: "\f122";color:#2EA2CC}
			#menu-posts-slide .menu-icon-post div.wp-menu-image:before {content: "\f169";color:#2EA2CC}
			#menu-posts-portfolio .menu-icon-post div.wp-menu-image:before {content: "\f322";color:#2EA2CC}
			#adminmenu .wp-has-current-submenu div.wp-menu-image:before {color:#FFFFFF}
			#wp-admin-bar-of_theme_options .ab-item:before{content: "\f107";top:2px}
			.updated.rs-update-notice-wrap,.updated.vc_license-activation-notice{display:none !important}
	    </style>
	<?php } 

?>
