<?php
function official_custom_styles() {
?>

<!-- Custom CSS Codes
========================================================= -->
	
<style type="text/css" media="all">


	<?php

	$font_text = _option('font_text');
	$font_menu = _option('font_menu');
	$font_h1 = _option('font_h1');
	$font_h2 = _option('font_h2');
	$font_h3 = _option('font_h3');
	$font_h4 = _option('font_h4');
	$font_h5 = _option('font_h5');
	$font_h6 = _option('font_h6');
	?>
	
	body{ font-family: <?php echo str_replace('+', ' ', $font_text['face']); ?>, Helvetica, Arial, sans-serif;
		  font-size: <?php echo $font_text['size']; ?>;
		  font-weight: <?php echo $font_text['style']; ?>;
		  color: <?php echo $font_text['color']; ?>;
		  
		  <?php
	  
			  if (get_option('bg_color','#FFFFFF')){
				  echo 'background-color:' .get_option('bg_color','#FFFFFF').' !mportant;';
			  }
				  
			  if (_option('bg_img')){
				  echo 'background-image:url(' . _option('bg_img') .');';
				  
				  if (_option('bg_repeat')!== 'stretch'){
		  	  	  echo 'background-repeat:' . _option('bg_repeat').';';
				  } else {
					  echo '-webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;'; 
				  	  echo 'background-attachment:fixed;' ;
				  }
				  
			  }elseif (_option('bg_img_select')!= '0'){
				  $img_key = _option('bg_img_select');
				  $default_img=get_bloginfo('template_url').'/images/pattern/'.str_pad($img_key, 2, '0', STR_PAD_LEFT). '.png';
				  echo 'background-image:url('. $default_img .');';
				  echo 'background-repeat:' . _option('bg_repeat').';';
			  }

		 
		?> 
		
	}
	
	<?php 

	 
	// SET COLORS  
	$theme_color = get_option('theme_color','#191919');
	$links_color = get_option('links_color','#000000');
	$hover_color = get_option('hover_color','#ACACAC');
	$header_color = get_option('header_color','#FFFFFF');
	$header_text_color = get_option('header_text_color','#777777');
	$menu_bg_color = get_option('menu_bg_color','#191919');
	$submenu_bg_color = get_option('submenu_bg_color','#191919');
	$submenu_text_color = get_option('submenu_text_color','#FFFFFF');
	$menu_ind_color = get_option('menu_ind_color','#FFFFFF');
	$menu_icon_color = get_option('menu_icon_color','#FFFFFF');
	$breadcrumbs_color = get_option('breadcrumbs_color','#0B0B0B');
	$breadcrumbs_title_color = get_option('breadcrumbs_title_color','#FFFFFF');
	$breadcrumbs_text_color = get_option('breadcrumbs_text_color','#C2C2C2');
	$extrapanel_color = get_option('extrapanel_color','#000000');
	$button_color = get_option('button_color','#191919');
	$icon_color = get_option('icon_color','#ACACAC');
	$social_icon_color = get_option('social_icon_color','#ACACAC');
	$light_icon_color = get_option('light_icon_color','#FFFFFF');
	
	// Footer Colors
	$footer_color = get_option('footer_color','#333333');
	$footer_bottom_color = get_option('footer_bottom_color','#101010');
	$footer_text_color = get_option('footer_text_color','#BFBFBF');
	$footer_icon_color = get_option('footer_icon_color','#999999');
	$footer_bottom_border_color = get_option('footer_bottom_border_color','#101010');
	$footer_links_color = get_option('footer_links_color','#CCCCCC');
	$footer_hover_color = get_option('footer_hover_color','#FFFFFF');
	$footer_title_border_color = get_option('footer_title_border_color','#FFFFFF');
	$footer_title_color = get_option('footer_title_color','#FFFFFF');
	$copyright_links_color = get_option('copyright_links_color','#FFFFFF');
	$copyright_text_color = get_option('copyright_text_color','#777777');
	$footer_bottom_menu_color = get_option('footer_bottom_menu_color','#FFFFFF');
	
	
		
	?>
		
	
	::selection{
		background:<?php echo $theme_color; ?> !important
	}
	::-moz-selection{
		background:<?php echo $theme_color; ?> !important
	}
	h1{ font-family: <?php echo str_replace('+', ' ', $font_h1['face']); ?>, Arial, Helvetica, sans-serif; font-size: <?php echo $font_h1['size']; ?>; font-weight: <?php echo $font_h1['style']; ?>; color: <?php echo $font_h1['color']; ?>; }        
	h2{ font-family: <?php echo str_replace('+', ' ', $font_h2['face']); ?>, Arial, Helvetica, sans-serif; font-size: <?php echo $font_h2['size']; ?>; font-weight: <?php echo $font_h2['style']; ?>; color: <?php echo $font_h2['color']; ?>; }
	h3{ font-family: <?php echo str_replace('+', ' ', $font_h3['face']); ?>, Arial, Helvetica, sans-serif; font-size: <?php echo $font_h3['size']; ?>; font-weight: <?php echo $font_h3['style']; ?>; color: <?php echo $font_h3['color']; ?>; }
	h4{ font-family: <?php echo str_replace('+', ' ', $font_h4['face']); ?>, Arial, Helvetica, sans-serif; font-size: <?php echo $font_h4['size']; ?>; font-weight: <?php echo $font_h4['style']; ?>; color: <?php echo $font_h4['color']; ?>; }
	h5{ font-family: <?php echo str_replace('+', ' ', $font_h5['face']); ?>, Arial, Helvetica, sans-serif; font-size: <?php echo $font_h5['size']; ?>; font-weight: <?php echo $font_h5['style']; ?>; color: <?php echo $font_h5['color']; ?>; }
	h6{ font-family: <?php echo str_replace('+', ' ', $font_h6['face']); ?>, Arial, Helvetica, sans-serif; font-size: <?php echo $font_h6['size']; ?>; font-weight: <?php echo $font_h6['style']; ?>; color: <?php echo $font_h6['color']; ?>; }

	h1 a, h2 a, h3 a, h4 a, h5 a, h6 a, h1 a:visited, h2 a:visited, h3 a:visited, h4 a:visited, h5 a:visited, h6 a:visited  { font-weight: inherit; color: inherit; }

	a{ color: <?php echo $links_color; ?>; }
	a:hover, a:focus{ color: <?php echo $hover_color; ?>; }
	
	.sf-menu a{ font-size: <?php echo $font_menu['size']; ?>;color: <?php echo $font_menu['color']; ?>;font-family: <?php echo str_replace('+', ' ', $font_menu['face']); ?>, Arial, Helvetica, sans-serif;font-weight: <?php echo $font_menu['style']; ?>;}
	.sf-menu a:hover{ color: <?php echo $font_menu['color']; ?>;}
	.sf-menu li li a {}

	
	<?php if (_option('header_bg_img')!=''){echo '.head{background-image:url(' . _option('header_bg_img') .');}';}?>
	<?php if (_option('header_top_line')!='0'){echo '.head{border-top-width:' . _option('header_top_line','5') .'px;}';}?>
	.head{background-color:<?php echo $header_color; ?>;<?php if (_option('bh_opacity',100)!=100){echo 'background-color:rgba(' . hex2rgb($header_color).','. getOpacity(_option('bh_opacity',100)) .');';}?>}
	.head.sticky{background-color:<?php echo $header_color; ?>}
	
	.header_bag span,.fLeft:hover,
	.fRight:hover,#toTop,.nicescroll-rails div,
	.pagination-tt ul li a:hover,
	.big-slider .flex-direction-nav a,.big-slider .flex-direction-nav a:hover,
	.table table th,.table table tfoot td,
	#wp-calendar caption,#wp-calendar tr #today,
	#mobilepro{
		background-color:<?php echo $theme_color; ?> !important
	}
	
	
	.headdown{background-color:<?php echo $menu_bg_color; ?> !important;<?php if (_option('sh_opacity',100)!=100){echo 'background-color:rgba(' . hex2rgb($menu_bg_color).','. getOpacity(_option('sh_opacity',100)) .') !important;';}?>}
	.headdown.sticky{background-color:<?php echo $menu_bg_color; ?> !important;}
	<?php if (_option('header_shadow',1)):?>
	.headdown {box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2) inset;}
	.header_v12 .sf-menu ul{box-shadow: 0px 3px 5px rgba(0,0,0,0.15);}
	.header_v12 .head{box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);}
	<?php endif; ?>
	.sf-menu ul li{background-color:<?php echo $submenu_bg_color; ?> !important; <?php if (_option('submenu_opacity',100)!=100){echo 'background-color:rgba(' . hex2rgb($submenu_bg_color).','. getOpacity(_option('submenu_opacity',100)) .') !important;';}?>}      
	.sf-menu li li a{color:<?php echo $submenu_text_color; ?> !important}
	.sf-menu li li:first-child{border-top-color:<?php echo $menu_ind_color; ?> !important}
	.sf-menu i{color:<?php echo $menu_icon_color; ?> !important}
	.sf-menu li.back .left{border-bottom-color:<?php echo $menu_ind_color; ?> !important}
	.header_v7 .sf-menu li.back .left{border-top-color:<?php echo $menu_ind_color; ?>}
	.header_v6 .sf-menu li.back,.header_v8 .sf-menu li.back{background:<?php echo $menu_ind_color; ?>}
	.sf-menu .subarrow i{color:<?php echo $menu_ind_color; ?> !important}
	.info, .info a,.info a:hover{color:<?php echo $header_text_color; ?>}
	.info{margin-top:<?php echo _option("info_margin_top","56px");?>;}
	.header_v2 .sf-menu,.header_v10 .sf-menu,.header_v12 .sf-menu{margin-top:<?php echo _option('menu_margin_top','40px') ?>;}
	.sticky .logo{margin:<?php echo _option('menu_sticky_margin','5px 0') ?>;width:<?php echo _option('logo_width_sticky','170') ?>}
	
	.logo{
		width:<?php echo _option("logo_width","220px");?>;
		margin-top:<?php echo _option("logo_margin_top","30px");?>;
		margin-bottom:<?php echo _option("logo_margin_bottom","30px");?>
		}
	
	
	.widget li a:before,
	.tags a:before, .widget_tag_cloud a:before, .widget_official_tags a:before, .wp-tag-cloud li a:before, .tagcloud a:before,
	.countdown li span{
		color: <?php echo $theme_color; ?> !important
	}
	
	.col-title{
		border-color:<?php echo $theme_color; ?> !important
	}
	
	.head,.arrow-down,.tabs li a.active,.wpb_tabs .wpb_tabs_nav li.ui-tabs-active a{border-top-color:<?php echo $theme_color; ?> !important}
	.pagination-tt ul li a,.pagination-tt ul li span{border-bottom-color:<?php echo $theme_color; ?> !important}
	.wpb_tour .wpb_tabs_nav li.ui-tabs-active a{border-left-color:<?php echo $theme_color; ?> !important}
	
	
	.extrabox{background:<?php echo $extrapanel_color; ?>}
	
	
	.social a i{color:<?php echo $social_icon_color; ?>;}
	
	i,.table table i:before{color:<?php echo $icon_color; ?>;}
	.social.with_color i{color:#FFF !important;}
	.social-head{margin-top:<?php echo _option("social_margin_top","48px");?>;}
	
	.tbutton,.filterable.st4 ul.filter li.current{background-color:<?php echo $button_color; ?>;}
	.tbutton.tbutton5.color1,.tbutton.tbutton6.color1,.tbutton.tbutton7.color1,.filterable.st6 ul.filter li.current a,.filterable.st7 ul.filter li.current a {border-color:<?php echo $button_color; ?>;color:<?php echo $button_color; ?>;}
	.tbutton.tbutton5.color1 i,.tbutton.tbutton6.color1 i,.tbutton.tbutton7.color1 i {color:<?php echo $button_color; ?>;}
	
	.footer-last{background-color:<?php echo $footer_bottom_color; ?>;}
	#footer {
		color:<?php echo $footer_text_color; ?>;
		<?php if(_option('footer_line','5')!=0){echo 'border-bottom:solid ' . _option('footer_line','5').'px ' . $footer_bottom_border_color . ';';} ?>
		}
	#footer a{color:<?php echo $footer_links_color; ?>}
	#footer a:hover{color:<?php echo $footer_hover_color; ?>}
	#footer .col-title{color:<?php echo $footer_title_color; ?> !important;border-color:<?php echo $footer_title_color; ?> !important}
	#footer .liner{border-color:<?php echo $footer_title_border_color; ?> !important}
	#footer .copyright{color:<?php echo $copyright_text_color; ?>}
	#footer .copyright a{color:<?php echo $copyright_links_color; ?> !important;}
	#footer .foot-menu li a,#footer .foot-menu li:before{color:<?php echo $footer_bottom_menu_color; ?> !important;}
	#footer i{color:<?php echo $footer_icon_color; ?>}

	.breadcrumb-place{
		background-color:<?php echo $breadcrumbs_color; ?>;
		height:<?php echo _option('breadcrumbs_height','110px'); ?>;
		line-height:<?php echo _option('breadcrumbs_height','110px'); ?>
		}
	<?php if (_option('breadcrumbs_bg_img')!=''){ echo '.breadcrumb-place{background-image:url('._option('breadcrumbs_bg_img').')}'; }?>
	.page-title{color:<?php echo $breadcrumbs_title_color; ?>;}
	.breadcrumbIn span,.breadcrumbIn ul,.breadcrumbIn ul li,.breadcrumbIn ul li a{color:<?php echo $breadcrumbs_text_color; ?>;}
	
	.sf-menu ul li i,#toTopi, .arrow-down i{color:<?php echo $light_icon_color; ?>;}
	
	#footer{
		background-color:<?php echo $footer_color; ?> !important;
		<?php
		if (_option('footer_bg_img')){
			echo 'background-image:url(' . _option('footer_bg_img') .');';	  
			} 
		?>
	}
	
	<?php if(_option('menu_sep',1)==0){?> .sf-menu li:before {content:'' !important;}<?php } ?>
	
	<?php if (function_exists( 'is_woocommerce' )):
	
	// WooCommerce Colors
	$cart_icon_color = get_option('cart_icon_color','#A7A7A7');
	$woo_sale_color = get_option('woo_sale_color','#CC0000');
	$cart_c_color = get_option('cart_c_color','#EEEEEE');
	$cart_c_bg = get_option('cart_c_bg','#191919');
	?>
	.shopping_bag {top:<?php echo _option('woo_cart_margin','52px') ?>;}
	.header_bag a i{color:<?php echo $cart_icon_color; ?>;}
	.header_bag span{color:<?php echo $cart_c_color; ?>;background-color:<?php echo $cart_c_bg; ?> !important;}
	.woocommerce .widget_price_filter .ui-slider .ui-slider-range,
	.woocommerce .ui-widget-header,
	.woocommerce .widget_layered_nav_filters ul li a,
	.woocommerce .ui-slider .ui-slider-handle{
		background-color:<?php echo $theme_color; ?> !important
		}
	.woocommerce #content input.button,
	.woocommerce #respond input#submit,
	.woocommerce a.button,
	.woocommerce button.button,
	.woocommerce input.button,
	.woocommerce #content .quantity .minus,
	.woocommerce #content .quantity .plus,
	.woocommerce .quantity .minus,
	.woocommerce .quantity .plus{
		background:<?php echo $button_color; ?> !important;
		}
	.woocommerce a span.onsale, .woocommerce span.onsale{background:<?php echo $woo_sale_color; ?> !important;}
	<?php endif; ?> 
	
	
	@media only screen and (max-width: 767px) and (min-width: 480px){
		.sf-menu a:hover { background-color:<?php //echo $header_color1; ?> !important }
	}
	

	
	<?php if (_option('rev_cs')== 1): ?>

	.tparrows {
			   text-align:center;
			   font-family:FontAwesome;
			   line-height:40px;
			   font-size:15px;
			   color:#FFF;
			   width:40px !important;
			   height:40px !important;
			   border-radius:4px;
			   background:none !important;
			   background-color:<?php echo $button_color; ?> !important;
			   opacity:.6
			   }
	.tp-leftarrow.default:before {content: "\f104";}
	.tp-rightarrow.default:before {content: "\f105";}
	.tp-rightarrow:hover,.tp-leftarrow:hover{opacity:1}
	.tp-bullets{background:none !important;}
	.rev_slider_wrapper .tp-bullets.simplebullets.navbar-old .bullet{
		background:#ccc !important;
		width:12px !important;
		height:12px !important;
		margin:0 3px !important;
		border-radius:50%;
		}
	.rev_slider_wrapper .tp-bullets.simplebullets.navbar-old .bullet:hover,
	.rev_slider_wrapper .tp-bullets.simplebullets.navbar-old .bullet.selected{background:<?php echo $button_color; ?> !important;}
	
	<?php endif; ?>
	
	
	
	<?php if (_option('wrap_shadow',0)==1):?>
		#layout.boxed-margin, #layout.boxed{
			-webkit-box-shadow:0 0 5px rgba(0,0,0,.5);
			-moz-box-shadow:0 0 5px rgba(0,0,0,.5);
			box-shadow:0 0 5px rgba(0,0,0,.5);
			}
	<?php endif; ?>
	
	
	<?php if (_option('blocked_corners',1)==1):?>
		.boxed-margin {border-radius: 5px;}
		.boxed-margin .footer-last{border-radius:5px 5px 0 0;}
	<?php endif; ?>
	
	</style>

	

	<?php if(_option('custom_css')){ echo '<style>' . _option('custom_css') . '</style>';} ?>
	
	


<?php }
add_action( 'wp_head', 'official_custom_styles', 100 );


function hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   return implode(",", $rgb);
   //return $rgb;
}

function getOpacity($p) { 
  return $p/100;
}

?>