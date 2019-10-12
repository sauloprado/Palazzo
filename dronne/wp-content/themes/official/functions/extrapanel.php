<div class="extrabox">
    <div class="row clearfix">
        <div class="extra-content">
           
           <?php 
				
			if ( ! dynamic_sidebar ( 'extrapanel_widgets' ) ){
				thdglkr_emptysidebar('Extra Panel');
				}        				
			?>
           
        </div><!-- extra content -->

        <div class="arrow-down arrow-<?php echo _option('extra_align','right'); ?>"><i class="icon-angle-down"></i></div><!-- arrow down -->
    </div><!-- end row -->
</div><!-- end extrabox -->