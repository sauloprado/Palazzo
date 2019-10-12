<!DOCTYPE html>
<!--[if IE 7 ]><html class="ie7" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8 ]><html class="ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 9 ]><html class="ie9" <?php language_attributes(); ?>><![endif]-->
<!--[if (gte IE 10)|!(IE)]><!--><html <?php language_attributes(); ?>><!--<![endif]-->
<head>
	
    <!-- Basic Page Needs
 	================================================== -->
	<meta charset="<?php bloginfo('charset'); ?>">

    <?php if (!defined('WPSEO_VERSION')){ ?>
    
    <title><?php bloginfo('name'); ?> <?php wp_title(' | ', true, 'left'); ?></title>

    <?php $pg_desc = get_post_meta( get_the_ID(), 'official_pg_desc', true );?>
	<?php if(is_front_page() && _option('meta_description')): ?>
     
    <?php elseif ($pg_desc): ?>
    <meta name="description" content="<?php echo $pg_desc; ?>" /> 
	<?php endif; ?>
    
    
    <?php $pg_key = get_post_meta( get_the_ID(), 'official_pg_key', true );?>
	<?php if(is_front_page() && _option('meta_keywords')): ?>
    <meta name="keywords" content="<?php echo _option('meta_keywords'); ?>" /> 
    <?php elseif ($pg_key): ?>
    <meta name="keywords" content="<?php echo $pg_key; ?>" /> 
	<?php endif; ?>
	
    <?php 
	$seo = _option('meta_robots',array('index'=>1,'follow'=>1));	
	if( $seo['follow'] ) { $seo['follow'] = 'follow'; } else { $seo['follow'] = 'nofollow'; }
	if( $seo['index'] ) { $seo['index'] = 'index'; } else { $seo['index'] = 'noindex'; }
	echo '<meta name="robots" content="'.$seo['index'].', '.$seo['follow'].'" />'."\n";
    ?>
	
    <?php }else{ ?>
		
	<title><?php wp_title(' | ', true, 'left'); ?></title>
	
	<?php }?>
    
    
	<!--[if IE]>
		<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=EmulateIE8; IE=EDGE" />
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<script language="javascript" type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/excanvas.min.js"></script>
	<![endif]-->
    
    

    <?php if(_option('zoom')!=1): ?>
	<!-- Mobile Specific Metas
    ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <?php endif; ?>
    
    
    
	<!-- Favicons
	================================================== -->
	
    <?php if(_option('favicon')): ?>
	<link href="<?php echo _option('favicon'); ?>" rel="shortcut icon" /> 
	<?php endif; ?>
    
    <?php if(_option('touch-icon57')): ?>
	<link rel="apple-touch-icon" href="<?php echo _option('touch-icon57'); ?>" /> 
	<?php endif; ?>
    
    <?php if(_option('touch-icon114')): ?>
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo _option('touch-icon114'); ?>" /> 
	<?php endif; ?>
    
    <?php if(_option('touch-icon72')): ?>
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo _option('touch-icon72'); ?>" /> 
	<?php endif; ?>
    
    <?php if(_option('touch-icon144')): ?>
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo _option('touch-icon144'); ?>" /> 
	<?php endif; ?>
    

    <?php get_template_part( 'functions/googlefonts'); ?>
   
    <?php wp_head(); ?>

    
</head>

<?php $isrtl = ''; if(is_rtl() || _option('rtl_support')){$isrtl = 'isrtl';}; ?>
    
<body <?php  body_class($isrtl); ?>>
	
	
	<?php $page_style = _option('page_style','full');?>
    <?php $frame = _option('frame','noframe');?>
	<div id="home" <?php if($frame!='noframe' && $page_style =='boxed'){echo ' class="'.$frame.'"';};?>>
	<div id="layout" class="<?php echo $page_style; ?><?php if(_option('dark_style',0)==1){echo ' dark';};?>">    
		
        <?php get_template_part('functions/header/header',_option('header_style','v1')); ?>

	
