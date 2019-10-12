/* Live Customizer */
( function( $ ){		
	
	wp.customize('theme_color',function( value ) {
		value.bind(function(cc) {
			$('head').append('<style type="text/css">.tabs li a.active,.wpb_tabs_nav li.ui-tabs-active a{border-top-color:'+cc+' !important}.head,.arrow-down{border-top-color:'+cc+' !important;}.header_bag span,.fRight:hover,#toTop,.nicescroll-rails div,.pagination-tt ul li a:hover,.woocommerce-page .widget_price_filter .ui-slider .ui-slider-range,.woocommerce-page .ui-widget-header,.woocommerce-page .widget_layered_nav_filters ul li a,.woocommerce-page .ui-slider .ui-slider-handle{background-color: '+cc+' !important;}</style>');
			$('.col-title,.extra-content h3').attr('style', 'border-color: '+cc+' !important');
			$('.pagination-tt ul li a,.pagination-tt ul li span').attr('style', 'border-bottom-color: '+cc+' !important');
		});
	});
	
	wp.customize('bg_color',function( value ) {
		value.bind(function(cc) {
			$('body').attr('style', 'background-color: '+cc+' !important');
		});
	});
	
	
	wp.customize('header_color',function( value ) {
		value.bind(function(cc) {
			$('.head').attr('style', 'background-color: '+cc+' !important');
		});
	});
	
	wp.customize('header_text_color',function( value ) {
		value.bind(function(cc) {
			$('head').append('<style type="text/css">.info, .info a,.info a:hover{color: '+cc+' !important;}</style>');
		});
	});
	
	
	wp.customize('menu_bg_color',function( value ) {
		value.bind(function(cc) {
			$('.headdown').attr('style', 'background-color: '+cc+' !important');
		});
	});
	
	
	wp.customize('submenu_bg_color',function( value ) {
		value.bind(function(cc) {
			$('.sf-menu ul li').attr('style', 'background-color: '+cc+' !important');
		});
	});
	
	wp.customize('submenu_text_color',function( value ) {
		value.bind(function(cc) {
			$('.sf-menu li li a').attr('style', 'color: '+cc+' !important');
		});
	});
	
	wp.customize('menu_ind_color',function( value ) {
		value.bind(function(cc) {
			$('head').append('<style type="text/css">.header_v6 .sf-menu li.back,.header_v8 .sf-menu li.back{background: '+cc+' !important;}.sf-menu li.back .left{border-bottom-color: '+cc+' !important;}.sf-menu li li:first-child,.header_v7 .sf-menu li.back .left{border-top-color: '+cc+' !important;}.sf-menu .subarrow i{color: '+cc+' !important;}</style>');
		});
	});
	
	wp.customize('menu_icon_color',function( value ) {
		value.bind(function(cc) {
			$('head').append('<style type="text/css">.sf-menu i{color: '+cc+' !important;}</style>');
		});
	});
	
	wp.customize('breadcrumbs_color',function( value ) {
		value.bind(function(cc) {
			$('.breadcrumb-place').attr('style', 'background-color: '+cc+';');
		});
	})
	
	wp.customize('breadcrumbs_title_color',function( value ) {
		value.bind(function(cc) {
			$('.page-title').attr('style', 'color: '+cc+';');
		});
	})
	
	wp.customize('breadcrumbs_text_color',function( value ) {
		value.bind(function(cc) {
			$('.breadcrumbIn span,.breadcrumbIn ul,.breadcrumbIn ul li,.breadcrumbIn ul li a').attr('style', 'color: '+cc+';');
		});
	})
	
	wp.customize('extrapanel_color',function( value ) {
		value.bind(function(cc) {
			$('head').append('<style type="text/css">.extrabox{background: '+cc+' !important;}</style>');
		});
	});
	
	wp.customize('footer_color',function( value ) {
		value.bind(function(cc) {
			$('#footer').attr('style', 'background-color: '+cc+' !important');
		});
	})
	
	
	wp.customize('icon_color',function( value ) {
		value.bind(function(cc) {
			
			$('head').append('<style type="text/css">i,.table table i:before{color: '+cc+' !important;}</style>');
		});
	})
	
	wp.customize('social_icon_color',function( value ) {
		value.bind(function(cc) {
			$('.social a i').attr('style', 'color: '+cc+' !important');
		});
	})
	
	wp.customize('light_icon_color',function( value ) {
		value.bind(function(cc) {
			$('head').append('<style type="text/css">.tbutton i,.sf-menu ul li i,#toTop i, .arrow-down i{color: '+cc+' !important;}</style>');
		});
	})
	

	
	wp.customize('button_color',function( value ) {
		value.bind(function(cc) {
			$('head').append('<style type="text/css">.tbutton,.tparrows,.rev_slider_wrapper .tp-bullets.simplebullets.navbar-old .bullet:hover,.rev_slider_wrapper .tp-bullets.simplebullets.navbar-old .bullet.selected,.woocommerce-page #content input.button, .woocommerce-page #respond input#submit, .woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button, .woocommerce-page #content .quantity .minus, .woocommerce-page #content .quantity .plus, .woocommerce-page .quantity .minus, .woocommerce-page .quantity .plus{background-color: '+cc+' !important;}</style>');
			
		});
	})
	
	// Footer ------------------------------------------------------------------
	wp.customize('footer_bottom_color',function( value ) {
		value.bind(function(cc) {
			$('.footer-last').attr('style', 'background-color: '+cc+';');
		});
	})
	
	wp.customize('footer_bottom_border_color',function( value ) {
		value.bind(function(cc) {
			$('#footer').attr('style', 'border-bottom-color: '+cc+';');
		});
	})

	wp.customize('footer_links_color',function( value ) {
		value.bind(function(cc) {
			$('#footer a').attr('style', 'color: '+cc+';');
		});
	})
	
	wp.customize('footer_icon_color',function( value ) {
		value.bind(function(cc) {
			$('#footer i').attr('style', 'color: '+cc+';');
		});
	})
	
	wp.customize('footer_hover_color',function( value ) {
		value.bind(function(cc) {
			$('head').append('<style type="text/css">#footer a:hover{color: '+cc+' !important;}</style>');
		});
	})
	
	wp.customize('footer_text_color',function( value ) {
		value.bind(function(cc) {
			$('head').append('<style type="text/css">#footer{color: '+cc+' !important;}</style>');
		});
	})
	
	wp.customize('footer_title_color',function( value ) {
		value.bind(function(cc) {
			$('head').append('<style type="text/css">#footer .col-title{color: '+cc+' !important;border-color: '+cc+' !important;}</style>');
		});
	})
	
	wp.customize('footer_title_border_color',function( value ) {
		value.bind(function(cc) {
			$('head').append('<style type="text/css">#footer .liner{border-color: '+cc+' !important;}</style>');

		});
	})
	
	wp.customize('copyright_text_color',function( value ) {
		value.bind(function(cc) {
			$('#footer .copyright').attr('style', 'color: '+cc+';');
		});
	})
	
	wp.customize('copyright_links_color',function( value ) {
		value.bind(function(cc) {
			$('#footer .copyright a').attr('style', 'color: '+cc+' !important;');
		});
	})
	
	wp.customize('footer_bottom_menu_color',function( value ) {
		value.bind(function(cc) {
			$('head').append('<style type="text/css">#footer .foot-menu li a,#footer .foot-menu li:before{color: '+cc+' !important;}</style>');

		});
	})
	

	// Woocomeerce ----------------------------------------------------
	
	wp.customize('cart_icon_color',function( value ) {
		value.bind(function(cc) {
			$('.header_bag a i').attr('style', 'color: '+cc+' !important');
		});
	})
	
	
	wp.customize('woo_sale_color',function( value ) {
		value.bind(function(cc) {
			$('.woocommerce-page a span.onsale, .woocommerce-page span.onsale').attr('style', 'background-color: '+cc+' !important;');
		});
	})
	
	wp.customize('cart_c_color',function( value ) {
		value.bind(function(cc) {
			$('head').append('<style type="text/css">.header_bag span{color: '+cc+';}</style>');

		});
	})
	
	wp.customize('cart_c_bg',function( value ) {
		value.bind(function(cc) {
			$('head').append('<style type="text/css">.header_bag span{background-color: '+cc+' !important;}</style>');

		});
	})
	
} )( jQuery );



