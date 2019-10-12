 <?php 
 /*
 Template for Footer
 */
 ?>

		<footer id="footer">
			<div class="row clearfix">
            	
                <?php 
				
				if ( ! dynamic_sidebar ( 'footer_widgets' ) ){
					thdglkr_emptysidebar('Footer');
					}        				
				?>

			</div><!-- row -->

			<div class="footer-last row mtf clearfix">
				<span class="copyright"><?php echo _option('footer_text'); ?></span>
					
                
                
                <?php 

					wp_nav_menu(  
						array(  
							'theme_location' => 'secondary',
							'menu' => 'Footer Menu',
							'container'       	=> 'div',
							'container_class'  => '' ,
							'menu_class'	   => 'foot-menu',
							
						)  
					); 
				
				?> 


			</div><!-- end last footer -->

		</footer><!-- end footer -->

	</div><!-- end layout -->
	</div><!-- end frame -->


	<?php if (_option('footer_gototop')==1): ?>
		<div id="toTop"><i class="icon-angle-up"></i></div><!-- Back to top -->
	<?php endif; ?>
    



<?php wp_footer(); ?>

	

</body>
</html>