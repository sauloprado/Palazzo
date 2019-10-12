<?php 
get_header(); 

?>

	
		<div class="breadcrumb-place">
            <div class="row clearfix">
                <h1 class="page-title"><?php echo get_the_title() ?></h1>
                
                <div class="breadcrumbIn">
                	<span> <?php _e('You are here:','official'); ?> </span>
                    <ul>
                    
                        <li>
                            <a href="<?php echo home_url(); ?>" ><i class="icon-home"></i></a>
                        </li>
                        
                        /
                        
                        <?php if (is_home() || is_front_page()){ ?>
                        
                            <li>
                                <?php echo _option('portfolio_page_name','Portfolio'); ?>
                            </li>
                            
                            /
                            
                        <?php } else { ?>
                            <li>
                                <a href="<?php echo home_url(); ?>/<?php echo _option( 'portfolio_item_slug', 'portfolio' ); ?>/" ><?php echo _option('portfolio_page_name','Portfolio'); ?></a>
                            </li>
                            
           				
    
                        <?php } ?>
                            
                        
                    </ul>
        		</div><!-- breadcrumb -->
        
            </div><!-- row -->
        </div><!-- breadcrumb -->
                
        

		<div class="page-content">
			<div class="row clearfix">
            
            
           		<?php 

					$portfolio_sidebar = _option('portfolio_sidebar'); 
				

					if ($portfolio_sidebar=='nosidebar'){
						
						get_template_part('functions/portfolio-full');
							
					} else {
							
						get_template_part('functions/portfolio-sidebar');	
					}
				
				
				?>
                 
                 
                 
			</div><!-- row -->


		</div><!-- end page content -->
        
<?php get_footer(); ?>