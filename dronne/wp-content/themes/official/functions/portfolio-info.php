<?php //Template for Portfolio Informations ?>


<?php $portfolio_sidebar = _option('portfolio_sidebar');  ?>
<?php if ($portfolio_sidebar != 'nosidebar'){ ?>
	<h4 class="p-title"><?php the_title();?></h4>
<?php } ?>
   
   
<?php if (_option('project_details','acc')=='acc'){ ?>
<ul class="tt-accordion">

	<?php if( get_post_meta( get_the_ID(), 'official_portfolio-client', true ) != "") { ?>
    <li class="sub-accordion">
        <div class="accordion-head">
            <div class="accordion-head-sign"></div>
            <p><?php _e('Client', 'official'); ?></p>
        </div>
        <div class="accordion-content">
            <span><?php echo get_post_meta( get_the_ID(), 'official_portfolio-client', true ); ?></span>
        </div>
    </li>
    <?php } ?>
    
    
    <?php if( get_post_meta( get_the_ID(), 'official_portfolio-url', true ) != "") { ?>
    
    <li class="sub-accordion">
        <div class="accordion-head">
            <div class="accordion-head-sign"></div>
            <p><?php _e('Website', 'official'); ?></p>
        </div>
        <div class="accordion-content">
            <span><a href="<?php echo get_post_meta( get_the_ID(), 'official_portfolio-url', true ); ?>" target="_blank" ><?php echo get_post_meta( get_the_ID(), 'official_portfolio-url', true ); ?></a></span>
        </div>
    </li>
    
    <?php } ?>
    
    
	<?php if( get_post_meta( get_the_ID(), 'official_portfolio-year', true ) != "") { ?>
    <li class="sub-accordion">
        <div class="accordion-head">
            <div class="accordion-head-sign"></div>
            <p><?php _e('Date', 'official'); ?></p>
        </div>
        <div class="accordion-content">
            <span><?php echo get_post_meta( get_the_ID(), 'official_portfolio-year', true ); ?></span>
        </div>
    </li>
    <?php } ?>
    
    
    <li class="sub-accordion">
        <div class="accordion-head">
            <div class="accordion-head-sign"></div>
            <p><?php _e('Category', 'official'); ?></p>
        </div>
        <div class="accordion-content">
            <span><?php echo get_the_term_list($post->ID, 'portfolio_types', '', ', ', ''); ?></span>
        </div>
    </li>
    
    
</ul>

<?php }else{ ?>

<ul class="portfolio-meta mbs">

    
    <?php if( get_post_meta( get_the_ID(), 'official_portfolio-client', true ) != "") { ?>
    <li><span><?php _e('Client', 'official'); ?>:</span> <strong><?php echo get_post_meta( get_the_ID(), 'official_portfolio-client', true ); ?></strong></li>
    <?php } ?>
    
    <?php if( get_post_meta( get_the_ID(), 'official_portfolio-year', true ) != "") { ?>
    <li><span><?php _e('Date', 'official'); ?>:</span> <span><?php echo get_post_meta( get_the_ID(), 'official_portfolio-year', true ); ?></span></li>
    <?php } ?>
    
    <?php if( get_post_meta( get_the_ID(), 'official_portfolio-url', true ) != "") { ?>
    <li>
        <span><?php _e('Website', 'official'); ?>:</span> 
        <span>
        <a href="<?php echo get_post_meta( get_the_ID(), 'official_portfolio-url', true ); ?>" target="_blank" ><?php echo get_post_meta( get_the_ID(), 'official_portfolio-url', true ); ?></a>
        </span>
    </li>
    <?php } ?>
    
    
   <li><span><?php _e('Category', 'official'); ?>:</span> <strong><?php echo get_the_term_list($post->ID, 'portfolio_types', '', ', ', ''); ?></strong></li>


</ul>


<?php } ?>
                            