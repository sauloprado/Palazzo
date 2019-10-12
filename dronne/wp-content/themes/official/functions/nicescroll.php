<?php 

// Template fo NiceScroll 
// by: Tohid Golkar


if (_option('nicescroll',1)==1){
		
	
	add_action( 'wp_footer', 'nicescroll_script' );
	
	function nicescroll_script() {
		
		wp_register_script('jquery.nicescroll', get_template_directory_uri() . '/js/jquery.nicescroll.min.js','jquery','3.5.1', true);
		wp_enqueue_script('jquery.nicescroll');
		
		$cursorwidth = _option('nicescroll_width','7px');
		$cursorborderradius = _option('nicescroll_radius','7px');
		if ($cursorwidth==''){$cursorwidth='7px';}
		if ($cursorborderradius==''){$cursorborderradius='7px';}
		
			?>
                <style type="text/css">body{overflow:hidden}</style>
				<script type="text/javascript">
					jQuery(document).ready(function ($) {
						var isDesktop = (function() {
							return !('ontouchstart' in window) // works on most browsers 
							|| !('onmsgesturechange' in window); // works on ie10
						})();
						window.isDesktop = isDesktop;
						
						if( isDesktop ){
							$("html").niceScroll({zindex:999,cursorborder:"",cursorwidth:"<?php echo $cursorwidth; ?>",cursorborderradius:"<?php echo $cursorborderradius; ?>",cursorcolor:"#191919",cursoropacitymin:.5,horizrailenabled:0}); 
						}
					});
				</script>
				<?php
	}

}
?>