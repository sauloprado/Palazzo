<?php get_header(); ?>

	<?php 
	
	if (is_home()){
		global $thdglkr_is_blog;
		$thdglkr_is_blog = true;
		get_template_part('blog-large');
	}else if (function_exists('is_shop') &&  is_shop()){
		get_template_part('woocommerce');  
	} else {
		get_template_part('search');
	}
	
	?>

<?php get_footer(); ?>
    
  