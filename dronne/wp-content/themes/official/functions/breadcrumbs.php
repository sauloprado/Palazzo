<?php

function official_breadcrumbs() {


	/* === OPTIONS === */
	$text['home']     = __('Home','official'); // text for the 'Home' link
	$text['category'] = __('Archive by Category "%s"','official'); // text for a category page
	$text['search']   = __('Search Results for "%s" Query','official'); // text for a search results page
	$text['tag']      = __('Posts Tagged "%s"','official'); // text for a tag page
	$text['author']   = __('Articles Posted by %s','official'); // text for an author page
	$text['404']      = __('Error 404','official'); // text for the 404 page

	$showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
	$showOnHome  = 1; // 1 - show breadcrumbs on the homepage, 0 - don't show
	$delimiter   = ' ' . _option('bread_crumb_sep') . ' ' ; // delimiter between crumbs
	$before      = '<li>'; // tag before the current crumb
	$after       = '</li>'; // tag after the current crumb
	/* === END OF OPTIONS === */
	
	$breadcrumbs_title = _option('breadcrumb_title');
	
	global $post;
	$homeLink = home_url()  . '/';
	$linkBefore = '<li>';
	$linkAfter = '</li>';
	$linkAttr = '';
	$link = $linkBefore . '<a' . $linkAttr . ' href="%1$s">%2$s</a>' . $linkAfter;
	
	?>
	
    
    <div class="breadcrumbIn">
		<span> <?php if ($breadcrumbs_title){echo $breadcrumbs_title ;} ?> </span>
			<ul>

       
		
	<?php 
	
	if (is_home() || is_front_page()) {

		if ($showOnHome == 1) echo '<li><a href="' . $homeLink . '">' . $text['home'] . '</a></li>';

	} else {
		
		//echo sprintf($link, $homeLink, $text['home']) . $delimiter;
		
		echo '<li><a href="'.$homeLink.'" title="Homepage"> <i class="icon-home"></i> </a></li> '. $delimiter;

		if ( is_category() ) {
			$thisCat = get_category(get_query_var('cat'), false);
			if ($thisCat->parent != 0) {
				$cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
				$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
				$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
				echo $cats;
			}
			echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;

		} elseif (function_exists('is_shop') && is_shop()) {
				// If main Shop page, just display Shop
				echo $before . _option('woo_shop_title','Shop') . $after;
		
		} elseif (function_exists('is_product') && is_product()) {
				
				$shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) );
				echo  sprintf($link, $shop_page_url , _option('woo_shop_title','Shop') ) .$delimiter . $before . get_the_title() . $after;	
		
		} elseif((function_exists('is_product_category') &&  is_product_category()) || (function_exists('is_product_tag') && is_product_tag())){
			$btext = '';
			if (is_product_category()) { $btext = __('Category:','official'); } else { $btext = __('Tag:','official'); }
			echo $btext.' ';
			echo woocommerce_page_title();
		} elseif ( is_search() ) {
			echo $before . sprintf($text['search'], get_search_query()) . $after;

		} elseif ( is_day() ) {
			echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
			echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
			echo $before . get_the_time('d') . $after;

		} elseif ( is_month() ) {
			echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
			echo $before . get_the_time('F') . $after;

		} elseif ( is_year() ) {
			echo $before . get_the_time('Y') . $after;

		} elseif ( is_single() && !is_attachment() ) {
			if ( get_post_type() != 'post' ) {
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				printf($link, $homeLink . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);
				if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;
			} else {
				$cat = get_the_category(); $cat = $cat[0];
				$cats = get_category_parents($cat, TRUE, $delimiter);
				if ($showCurrent == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
				$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
				$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
				echo $cats;
				if ($showCurrent == 1) echo $before . get_the_title() . $after;
			}

		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
			$post_type = get_post_type_object(get_post_type());
			echo $before . $post_type->labels->singular_name . $after;

		} elseif ( is_attachment() ) {
			$parent = get_post($post->post_parent);
			$cat = get_the_category($parent->ID); $cat = $cat[0];
			$cats = get_category_parents($cat, TRUE, $delimiter);
			$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
			$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
			echo $cats;
			printf($link, get_permalink($parent), $parent->post_title);
			if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;

		} elseif ( is_page() && !$post->post_parent ) {
			if ($showCurrent == 1) echo $before . get_the_title() . $after;

		} elseif ( is_page() && $post->post_parent ) {
			$parent_id  = $post->post_parent;
			$breadcrumbs = array();
			while ($parent_id) {
				$page = get_page($parent_id);
				$breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
				$parent_id  = $page->post_parent;
			}
			$breadcrumbs = array_reverse($breadcrumbs);
			for ($i = 0; $i < count($breadcrumbs); $i++) {
				echo $breadcrumbs[$i];
				if ($i != count($breadcrumbs)-1) echo $delimiter;
			}
			if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;

		} elseif ( is_tag() ) {
			echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;

		} elseif ( is_author() ) {
	 		global $author;
			$userdata = get_userdata($author);
			echo $before . sprintf($text['author'], $userdata->display_name) . $after;

		} elseif ( is_404() ) {
			echo $before . $text['404'] . $after;
		}

		if ( get_query_var('paged') ) {
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
			echo __('Page','official') . ' ' . get_query_var('paged');
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
		}


	}
	
	
	?>
    
    
    	</ul>
    </div><!-- breadcrumb -->
    
    
    <?php
}

?>