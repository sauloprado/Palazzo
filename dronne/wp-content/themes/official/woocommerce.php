<?php 
// Template Name: Shop

global $woo_title_type;
global $woo_header_overlay;

$woo_title_type = _option('woo_title_type','cpmb_breadcrumbs') ;
$woo_header_overlay = _option('woo_header_overlay','0') ;


get_header(); 


// Get WooCommerce Layout from Theme Options
if( _option('woo_sidebar','right')=='nosidebar'){
	$wooclass = 'grid_12 alpha omega';
}elseif( _option('woo_sidebar','right')=='right'){
	$wooclass = 'grid_9 alpha';
}else{
	$wooclass = 'grid_9 omega';
}


?>

		<?php get_template_part('functions/title'); //Setup the Titlebar ?>
        
  

		<div class="page-content">
           <div class="row official-shop clearfix mbs">
            	
  					
                <?php if (_option('woo_sidebar','right')=='left'): ?>
                <!-- start sidebar -->
				<div class="grid_3 alpha">
                    
                        <?php 
						
							if ( ! dynamic_sidebar ( 'sidebar-shop' ) ){
								thdglkr_emptysidebar('Shop');
								}        				
						?>	
     
               
				</div><!-- grid 3 Sidebar -->
				<?php endif; ?>   
                    
                
                
                <div class="<?php echo $wooclass; ?>">
					
					<?php woocommerce_content(); ?>
                    
                </div> <!-- end content -->
                            
                
                
                
                <?php if (_option('woo_sidebar','right')=='right'): ?>
                <!-- start sidebar -->
				<div class="grid_3 omega">
                    
                        <?php 
						
							if ( ! dynamic_sidebar ( 'sidebar-shop' ) ){
								thdglkr_emptysidebar('Shop');
								}        				
						?>	
     
               
				</div><!-- grid 3 Sidebar -->
				<?php endif; ?> 
                   
                    
                    
                    
            </div><!-- end row -->    
		</div><!-- end page-content -->
        
        
  <?php get_footer(); ?>