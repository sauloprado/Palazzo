 
<?php 
// Template Name: Blog 3 Columns (Masonry)
get_header(); 



global $thdglkr_blog_style,$thdglkr_blog_thumb_class,$thdglkr_blog_img,$thdglkr_blog_iframe_class,$thdglkr_masonry;
$thdglkr_blog_style = 'masonry';
$thdglkr_blog_thumb_class = 'thumb-big';
$thdglkr_blog_img = 'blog1';
$thdglkr_blog_iframe_class = 'iframe-thumb';
$thdglkr_masonry = true;

?>
<?php wp_enqueue_script('jquery.masonry'); ?>

	<?php get_template_part('functions/title'); //Setup the Titlebar ?>
                
        
		<div class="page-content">
			<div class="row clearfix mbs">
				<div id="masonry-container" class="three-column transitions-enabled centered clearfix">
					<div class="grid_12 both-sidebars alpha omega">

					
                    <?php

					$number_of_blog_item = _option( 'number_of_blog_item', 10 );
					global $paged;
     				if(empty($paged)) $paged = 1;
					
					// the query
					$args = array(
						'post_type' => array('post'), 
						'posts_per_page' => $number_of_blog_item,
						'paged' => $paged
					);
					query_posts( $args );
			
					// begin the loop
					if ( have_posts() ) : while ( have_posts() ) : the_post();

					?>
			
						<?php get_template_part( 'functions/post-format/content', get_post_format() ); ?>
                
                    <?php endwhile; ?>
                    
                
                    
                    
                
                    <?php else : ?>
                
                        <h3><?php _e('Not Found', 'official') ?></h3>
                
                    <?php endif; wp_reset_query(); ?>

                 
                </div><!-- end grid full -->
                
                
                    
            </div><!-- end masonry -->
        </div><!-- row -->
        
        <!-- PAGINATION -->
		<?php pagination($pages = '', $range = 4); ?>
        <p class="hide"><?php posts_nav_link(); ?></p>
        <!-- END PAGINATION -->
        
    </div><!-- end page content -->
    
    
    
    <?php 
	function masonry_inline(){
	?>
	<script>
    /* <![CDATA[ */
        jQuery(function(){
            var msnry = jQuery('#masonry-container');
			var msnrychk = jQuery('.post:not(.format-audio)');
            msnrychk.imagesLoaded( function(){
               msnry.masonry({
                    itemSelector: '.post',
                    isAnimated: true,
                    columnWidth: 1
                });
            });
        });
    /* ]]> */
	</script>
    
    <?php } ?>
    
    
    <?php add_action( 'wp_footer', 'masonry_inline',100 ); ?>
    
    
  <?php get_footer(); ?>