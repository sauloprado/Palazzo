<?php

$prefix = 'official_';
global $meta_boxes;
$meta_boxes = array();


// Fetching the Portfolio Categories ////////////////////////////////////////////////////////
$types = get_terms('portfolio_types', 'hide_empty=0');
$types_array['all'] = 'All categories';
if($types) {
	foreach($types as $type) {
		$types_array[$type->term_id] = $type->name;
	}
}

// Fetching the Title Bar Types  ////////////////////////////////////////////////////////////
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



// Page Metabox /////////////////////////////////////////////////////////////////////////////
$meta_boxes[] = array(
	'id' => 'pagesettings',
	'title' => 'Page Advanced Settings',
	'pages' => array( 'page' ),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => 'Overlay Header?',
			'id'   => "{$prefix}fixed_header",
			'type' => 'checkbox',
			'desc' => 'Do you wanted an Overlay and Fixed header on over of Slider or Page\'s Featured Iamage?',
			'std'  => 0,
		),array(
			'type' => 'divider',
			'id'   => 'fake_id',
		),array(
			'name'		=> 'Title (Slider)',
			'id'		=> $prefix . "title",
			'type'		=> 'select',
			'options'	=> $title_type,
			'multiple'	=> false,
			'desc'		=> 'Please select the Title bar type (you can insert slider instead of page title)',
			'std' => 'cpmb_title'
		),
		array(
			'name' => 'Breadcrumbs Background Image',
			'id' => $prefix ."breadcrumbs",
			'type' => 'image_advanced',
			'max_file_uploads' => 1,
		),array(
			'name' => 'Dark Text?',
			'id'   => "{$prefix}breadcrumbs_dark",
			'type' => 'checkbox',
			'std'  => 0,
		)
	)
);


// Page Metabox /////////////////////////////////////////////////////////////////////////////
$meta_boxes[] = array(
	'id' => 'portfolio_page_settings',
	'title' => 'Portfolio Settings',
	'pages' => array( 'page' ),
	'context' => 'normal',
	'priority' => 'low',
	'fields' => array(
		array(
			'name' => 'Select Portfolio Categories',
			'id' => $prefix . "portfoliocat",
			'type' => 'select',
			'options' => $types_array,
			'multiple' => true,
			'desc' => 'Select portfolio category for <strong>Portfolio Template only</strong><br/>Select multiple by holding ctrl key <br/> (optional).',
		),array(
			'name' => 'Hide Title?',
			'id'   => "{$prefix}portfolio_title",
			'type' => 'checkbox',
			'std'  => 0,
		),array(
			'name' => 'Hide Category?',
			'id'   => "{$prefix}portfolio_cat",
			'type' => 'checkbox',
			'std'  => 0,
		),array(
			'name' => 'Full Wide?',
			'id'   => "{$prefix}portfolio_full",
			'type' => 'checkbox',
			'std'  => 0,
			'desc'	 => 'This option only works on Full width layout',
		),
		array(
			'name'     => 'Content Display?',
			'id'       => $prefix . 'content',
			'type'     => 'select',
			'options'  => array(
				'no' => 'No',
				'top' => 'Show on Top',
				'bottom' => 'Show on Bottom'
			),
			'multiple' => false,
			'desc'	 => 'Please select your position of page content show.',
			'std'      => 'no'
		)
	)
);

// Post Format Settings  //////////////////////////////////////////////////////////////////
$meta_boxes[] = array(
	'id' => 'gallerypostformat',
	'title' => 'Gallery Post Format',
	'pages' => array( 'post' ),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => 'Gallery Images (Slider Images)',
			'id' => $prefix ."gallery",
			'type' => 'image_advanced',
			'max_file_uploads' => 10,
		)
	)
);



$meta_boxes[] = array(
	'id' => 'quotepostformat',
	'title' => 'Quote Post Format',
	'pages' => array( 'post' ),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name'  => "Source Name",
			'id'    => "{$prefix}format_quote_source_name",
			'desc'  => "Enter source name",
			'type'  => 'text'
		),array(
			'name'  => 'URL',
			'id'    => "{$prefix}format_quote_source_url",
			'desc'  => "Please enter source URL",
			'type'  => 'url',
			'std'   => '',
		)
	)
);

$meta_boxes[] = array(
	'id' => 'videopostformat',
	'title' => 'Video Post Format',
	'pages' => array( 'post' ),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => "Video Embed",
			'desc' => "Please enter video embed",
			'id'   => "{$prefix}format_video_embed",
			'type' => 'textarea',
			'cols' => 20,
			'rows' => 3,
		)
	)
);


$meta_boxes[] = array(
	'id' => 'audiopostformat',
	'title' => 'Audio Post Format',
	'pages' => array( 'post' ),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => "Audio URL",
			'desc' => "Please enter audio url",
			'id'   => "{$prefix}format_audio_embed",
			'type' => 'textarea',
			'cols' => 20,
			'rows' => 1,
		)
	)
);




// SEO Settings ///////////////////////////////////////////////////////////////////////////
$meta_boxes[] = array(
	'id' => 'seometa',
	'title' => 'SEO Settings',
	'pages' => array( 'page','post','portfolio'),
	'context' => 'normal',
	'priority' => 'low',
	'fields' => array(
		array(
			'name' => 'Page Description',
			'id'   => $prefix . "pg_desc",
			'type' => 'textarea',
			'desc' => 'Please enter an abstract description about this page or post. (Good for SEO)',
			'cols' => '20',
			'rows' => '3',
		),
		array(
			'name' => 'Page Keywords',
			'id'   => $prefix . "pg_key",
			'type' => 'textarea',
			'desc' => 'Please enter keywords seperated by comma (,) ',
			'cols' => '20',
			'rows' => '3',
		)

	)
);


// Metabox for Slide Custom Post ////////////////////////////////////////////////////////////
$meta_boxes[] = array(
	'id' => 'slidebox',
	'title' => 'Slide details',
	'pages' => array('slide'),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
	
		
		array(
			'name' => 'Caption Title',
			'desc' => 'Enter the caption Title (optional)',
			'id' => $prefix . 'slide_caption_title',
			'type' => 'text',
			'std' => '',
			'clone' => false 
		),
			
		array(
			'name' => 'Caption Text',
			'desc' => 'Caption text (Description)',
			'id' => $prefix . 'slide_caption_text',
			'type' => 'textarea',
			'std' => '',
			'cols' => '20',
			'rows' => '3'
		),				
		
		array(
			'name' => 'Slide Link',
			'desc' => 'Enter the link of slide (optional)',
			'id' => $prefix . 'slide_url',
			'type' => 'text',
			'std' => '',
			'clone' => false 
		)

	),
	
);


// PORTFOLIO ///////////////////////////////////////////////////////////
$meta_boxes[] = array(
	'id' => 'portfolio',
	'title' => 'Portfolio details',
	'pages' => array('portfolio'),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		
		array(
			'name'		=> 'Client',
			'id'		=> $prefix . 'portfolio-client',
			'desc'		=> 'Project\'s Client Name. (optional)',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> ''
		),
		array(
			'name'		=> 'Year',
			'id'		=> $prefix . 'portfolio-year',
			'desc'		=> 'The year of project. (optional)',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> ''
		),
		array(
			'name'		=> 'Project URL',
			'id'		=> $prefix . 'portfolio-url',
			'desc'		=> 'URL to the Project. (optional) (with http://)',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> ''
		),
		array(
			'name'     => 'Thumbnail link to?',
			'id'       => $prefix . 'portfolio-to',
			'type'     => 'select',
			'options'  => array(
				'nothing' => 'Nothing',
				'details' => 'Project Details',
				'lightbox' => 'Show Image in Lightbox (or Video)',
				'projecturl' => 'Project URL'
			),
			'multiple' => false,
			'desc'	 => 'Select the action that you want when click on portfolio thumbnails.',
			'std'      => 'details'
		),
		array(
			'name'		=> 'Enable Lightbox on Details?',
			'id'		=> $prefix . "portfolio-lb",
			'type'		=> 'checkbox',
			'std'		=> true,
			'desc'		=> 'Do you want to open images on the details page in the Lightbox?'
		)

	)
	
);



$meta_boxes[] = array(
	'id'		=> 'portfolio_video',
	'title'		=> 'Portfolio Video or Audio',
	'pages'		=> array( 'portfolio' ),
	'context' => 'normal',

	'fields'	=> array(
		array(
			'name'		=> 'Video Source',
			'id'		=> $prefix . 'portfolio-video',
			'type'		=> 'select',
			'options'	=> array(
				'youtube'		=> 'Youtube',
				'vimeo'			=> 'Vimeo',
				'other'			=> 'Other Embed Code'
			),
			'multiple'	=> false,
			'std'		=> array( 'no' )
		),
		array(
			'name'	=> 'Video URL or Embed Code (Video or Audio)',
			'id'	=> $prefix . 'embed',
			'desc'	=> 'Paste the ID of the video (E.g. http://www.youtube.com/watch?v=<strong>gOlgRapHiC4</strong>) <br /> Or <br /> Insert your own Embed Code. <br />You can also insert your <strong>Audio</strong> Embedd Code.',
			'type' 	=> 'textarea',
			'std' 	=> "",
			'cols' 	=> "40",
			'rows' 	=> "8"
		)
	)
);



// CLIENTS ///////////////////////////////////////////////////////////
$meta_boxes[] = array(
	'id' => 'clients',
	'title' => 'Clients Details',
	'pages' => array('clients'),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		
		array(
			'name'		=> 'Client URL',
			'id'		=> $prefix . 'client-url',
			'desc'		=> 'URL to the Client Page or Website . (optional) (with http://)',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> ''
		)

	)
	
);


// TESTIMONIALS ///////////////////////////////////////////////////////////
$meta_boxes[] = array(
	'id' => 'testimonial',
	'title' => 'Testimonial details',
	'pages' => array('testimonial'),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		
		array(
			'name'		=> 'Author Name',
			'id'		=> $prefix . 'testimonial_name',
			'desc'		=> '',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> ''
		),
		array(
			'name'		=> 'Job',
			'id'		=> $prefix . 'testimonial_job',
			'desc'		=> 'Testimonial author\'s job. (optional)',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> ''
		),
		array(
			'name' => 'Testimonial or Quote',
			'id'   => $prefix . "testimonial",
			'type' => 'textarea',
			'desc' => 'Please enter Testimonial or Quote here.',
			'cols' => '20',
			'rows' => '3',
		)

	)
	
);


// Register the Metaboxes //////////////////////////////////////////
function official_register_meta_boxes()
{
	if ( !class_exists( 'RW_Meta_Box' ) )
		return;

	global $meta_boxes;
	foreach ( $meta_boxes as $meta_box )
	{
		new RW_Meta_Box( $meta_box );
	}
}

add_action( 'admin_init', 'official_register_meta_boxes' );

?>