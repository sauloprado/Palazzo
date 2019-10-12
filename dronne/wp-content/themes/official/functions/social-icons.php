<?php
/*
Template For Header Social Icons
*/
?>


	<?php 

		$target = '';
		if (_option('social_icons_link_target')==1):
			$target = ' target="_blank" ';
		endif;
	?>
	
    
    
    <?php 
		// Tooltip Options
		$tooltip = '';
		if (_option('social_icons_tooltip',1)==1):
			$tipstyle= _option('social_icons_tipstyle','toptip');
			$tooltip = ' class="'.$tipstyle.'" ';
		endif;
	?>
    
        
    <?php if(_option('twitter_link')): ?>
        <a href="<?php echo _option('twitter_link') ?>" <?php echo $target; ?> <?php echo $tooltip; ?> title="Twitter">
        	<i class="icon-twitter"></i>
        </a >	
    <?php endif; ?> 
      
        
    <?php if(_option('facebook_link')): ?>
        <a href="<?php echo _option('facebook_link') ?>" <?php echo $target; ?> <?php echo $tooltip; ?> title="Facebook">
        	<i class="icon-facebook"></i>
        </a >	
    <?php endif; ?> 
    

    <?php if(_option('pinterest_link')): ?>
        <a href="<?php echo _option('pinterest_link') ?>" <?php echo $target; ?> <?php echo $tooltip; ?> title="Pinterest">
        	<i class="icon-pinterest"></i>
        </a >	
    <?php endif; ?> 
    
    
    <?php if(_option('github_link')): ?>
        <a href="<?php echo _option('github_link') ?>" <?php echo $target; ?> <?php echo $tooltip; ?> title="GitHub">
        	<i class="icon-github"></i>
        </a >	
    <?php endif; ?> 
    
    <?php if(_option('flickr_link')): ?>
        <a href="<?php echo _option('flickr_link') ?>" <?php echo $target; ?> <?php echo $tooltip; ?> title="Flickr">
        	<i class="icon-flickr"></i>
        </a >	
    <?php endif; ?> 
    
    
    <?php if(_option('google_link')): ?>
        <a href="<?php echo _option('google_link') ?>" <?php echo $target; ?> <?php echo $tooltip; ?> title="Google +"> 
        	<i class="icon-google-plus"></i>
        </a >	
    <?php endif; ?> 
    
    
    <?php if(_option('youtube_link')): ?>
        <a href="<?php echo _option('youtube_link') ?>" <?php echo $target; ?> <?php echo $tooltip; ?> title="Youtube">
        	<i class="icon-youtube"></i>
        </a >	
    <?php endif; ?> 
    
    
    <?php if(_option('dribbble_link')): ?>
        <a href="<?php echo _option('dribbble_link') ?>" <?php echo $target; ?> <?php echo $tooltip; ?> title="Dribbble">
        	<i class="icon-dribbble"></i>
        </a >	
    <?php endif; ?> 
    
    
    <?php if(_option('instagram_link')): ?>
        <a href="<?php echo _option('instagram_link') ?>" <?php echo $target; ?> <?php echo $tooltip; ?> title="Instagram">
        	<i class="icon-instagram"></i>
        </a >	
    <?php endif; ?> 
    
    
    <?php if(_option('linkedin_link')): ?>
        <a href="<?php echo _option('linkedin_link') ?>" <?php echo $target; ?> <?php echo $tooltip; ?> title="Linkedin">
        	<i class="icon-linkedin"></i>
        </a >	
    <?php endif; ?> 
    
    
    <?php if(_option('skype_link')): ?>
        <a href="<?php echo _option('skype_link') ?>" <?php echo $target; ?> <?php echo $tooltip; ?> title="Skype">
        	<i class="icon-skype"></i>
        </a >	
    <?php endif; ?> 
    
    <?php if(_option('tumblr_link')): ?>
        <a href="<?php echo _option('tumblr_link') ?>" <?php echo $target; ?> <?php echo $tooltip; ?> title="Tumblr">
        	<i class="icon-tumblr"></i>
        </a >	
    <?php endif; ?> 

    
    <?php if(_option('email_address')): ?>
        <a href="mailto:<?php echo _option('email_address') ?>" <?php echo $target; ?> <?php echo $tooltip; ?> title="Email">
        	<i class="icon-envelope-alt"></i>
        </a >
    <?php endif; ?> 
    
    
    <?php if(_option('rss_link')): ?>
        <a href="<?php echo _option('rss_link') ?>" <?php echo $target; ?> <?php echo $tooltip; ?> title="RSS">
        	<i class="icon-rss"></i>
        </a >	
    <?php endif; ?> 
    
    
    <?php if(_option('sitemap_link')): ?>
        <a href="<?php echo _option('sitemap_link') ?>" <?php echo $target; ?> <?php echo $tooltip; ?> title="Sitemap">
        	<i class="icon-sitemap"></i>
        </a >	
    <?php endif; ?> 
    
