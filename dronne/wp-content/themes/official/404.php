<?php get_header(); ?>
        
        
        <div class="page-content">
           <div class="row mt mbs tac error-page clearfix mbs">
           
                <i class="icon-warning-sign errori"></i>
                <h2 class="tac"><?php echo _option('e404_title') ?><small> <?php echo _option('e404_text') ?> </small></h2>
                
                
                <div class="search widget mtt mbt">
                    <form role="search" method="get" id="searchform" action="<?php echo home_url(); ?>">
                        <input type="text" value="<?php get_search_query(); ?>" name="s" id="s" placeholder="<?php _e( 'Search...', 'official' ); ?>" />
                        <input type="submit" id="searchsubmit" value="&#61442;" />
                    </form>
                </div>
                   
                   
                <a class="tbutton medium" href="<?php echo home_url(); ?>"><span><?php _e('Back To Homepage','official'); ?></span></a>
                
                
                
            </div><!-- end row -->    
		</div><!-- end page-content -->
        

        
<?php get_footer(); ?>