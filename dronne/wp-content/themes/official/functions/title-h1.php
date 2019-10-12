<?php 
global $thdglkr_is_blog;

if (function_exists( 'is_woocommerce' )){
	
	if (is_search()) {
		echo __('Search Result for: ','official') . get_search_query();					
	} elseif (is_product_category() || is_product_tag() || is_filtered()) {
		$btext = '';
		if (is_product_category()) { $btext = __('Category: ','official'); } elseif(is_product_tag()) { $btext = __('Tag: ','official'); }
		if (is_filtered()) {
			$curr= get_woocommerce_currency();
			if (!isset($_GET['min_price'])) {
				echo $btext;
				echo woocommerce_page_title() . ' | Filter: '.$curr.'0-'.$curr . $_GET['max_price'];
			} elseif (!isset($_GET['max_price'])) {
				echo $btext;
				echo woocommerce_page_title() . ' | Filter: Minimum: '.$curr . $_GET['min_price'];
			} else {
				echo $btext;
				echo woocommerce_page_title() . ' | Filter: '.$curr . $_GET['min_price'] . '-'.$curr . $_GET['max_price'];
			}
		} else {
			echo $btext;
			echo woocommerce_page_title();
		}					
	} elseif (is_shop()) {
		echo _option('woo_shop_title','Shop');
	} elseif ($thdglkr_is_blog!="") {
		_e('Blog','official');
	} else {
		echo get_the_title();
	}
	
	
}else{
	
	if (is_search()) {
		echo __('Search Result for: ','official') . get_search_query();
	}elseif ($thdglkr_is_blog!="") {
		_e('Blog','official');
	} else {
		echo get_the_title();
	}
	
}


?>