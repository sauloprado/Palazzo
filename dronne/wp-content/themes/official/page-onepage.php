<?php 
// Template Name: One Page (Landing Page)
global $thdglkr_menu;
$thdglkr_menu = 'onepage';

get_header();

?>

        <?php get_template_part('functions/title'); //Setup the Titlebar ?>
         

		<div class="page-content">
           <div class="row clearfix">
           

  					<?php 
					
						if ( have_posts() ) : the_post();
						
							the_content();
							
						endif;
						wp_reset_query();
					 
					?>
                    
                    
            </div><!-- end row -->    
		</div><!-- end page-content -->
        
        
    <?php
    
	wp_register_script('jquery.plusanchor', get_template_directory_uri() . '/js/jquery.plusanchor.js','jquery','1.0.7.3', true);   
  	wp_enqueue_script('jquery.plusanchor');
	
	add_action( 'wp_footer', 'themetor_onepage_inline',100 );
	
    function themetor_onepage_inline(){
    ?>
    <script>
    /* <![CDATA[ */
	jQuery(document).ready(function ($) {
		if ($(".OneNav")[0]){
			$('body').plusAnchor({
				easing: 'easeInOutExpo',
				speed:  1000
			});
			$('.OneNav li').click(function(){
				$('.OneNav li.current').removeClass('current');
				$(this).addClass('current');
			});
			// Bind to scroll
			$(window).scroll(function(){
				var lastId,
					topMenu = $(".OneNav"),
					topMenuHeight = topMenu.outerHeight()+15,
					menuItems = topMenu.find("a"),
				scrollItems = menuItems.map(function(){
					var item = $($(this).attr("href"));
					if (item.length) { return item; }
				});
				var fromTop = $(this).scrollTop()+topMenuHeight;
				var cur = scrollItems.map(function(){
				if ($(this).offset().top < fromTop)
					return this;
				});
				// Get the id of the current element
				cur = cur[cur.length-1];
				var id = cur && cur.length ? cur[0].id : "";
			   
				if (lastId !== id) {
					lastId = id;
					// Set/remove active class
					menuItems
					.parent().removeClass("current-menu-item selectedLava current")
					.end().filter("[href=#"+id+"]").parent().addClass("current-menu-item selectedLava current");

				}                   
			});
		} 
	});
    /* ]]> */
    </script>
    
    <?php } ?>

        
  <?php get_footer(); ?>