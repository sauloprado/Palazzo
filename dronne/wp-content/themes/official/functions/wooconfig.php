<?php 

// Ajax update of top menu shopping cart
//--------------------------------------------------------------------------------------
add_filter('add_to_cart_fragments', 'official_woocommerce_header_add_to_cart_fragment');
function official_woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;

	ob_start();
	?>
	<div class="shopping_bag">
        <div class="header_bag">
            <a href="<?php echo get_permalink(get_option('woocommerce_cart_page_id')); ?>">
            <?php $carticon = _option('woo_cart_type','cart1');?>
            <i class="flaticon-<?php echo $carticon; ?>"></i>
            <?php $cart_count = $woocommerce->cart->cart_contents_count; 
                if ($cart_count>0):
            ?>
            <span class="cc-<?php echo $carticon; ?>"><?php echo $cart_count;?></span>
            <?php endif; ?>
            
            </a>
        </div>
    
        <div class="view_cart_mini">
            <div class="view_cart">
                <ul class="cart_list">
                
                <?php foreach($woocommerce->cart->cart_contents as $cart_item): ?>
                    <li class="clearfix">
                        <a href="<?php echo get_permalink($cart_item['product_id']); ?>">
                        <?php $thumbnail_id = ($cart_item['variation_id']) ? $cart_item['variation_id'] : $cart_item['product_id']; ?>
                        <?php echo get_the_post_thumbnail($thumbnail_id, 'thumb'); ?>
                        </a>
                        <div class="cart_list_product_title">
                            <a href="<?php echo get_permalink($cart_item['product_id']); ?>">
                            <?php echo $cart_item['data']->post->post_title; ?>
                            </a>
                            <div class="cart_list_product_quantity"><?php echo $cart_item['quantity']; ?> x <?php echo $woocommerce->cart->get_product_subtotal($cart_item['data'], 1); ?> </div>
                            
                        </div>
    
                    </li>
                    
                <?php endforeach; ?>
                </ul>
                
                <div class="mcart_total">
                    <span class="total_checkout fll"><?php _e('Cart subtotal','official');?></span>
                    <span class="amount_total flr"><?php echo $woocommerce->cart->get_cart_total(); ?></span>
                </div>
                
                <div class="mcart_buttons">
                    <a href="<?php echo get_permalink(get_option('woocommerce_cart_page_id')); ?>" class="tbutton small"><span><?php _e('Shopping Cart','official');?></span></a>   
                    <a href="<?php echo get_permalink(get_option('woocommerce_checkout_page_id')); ?>" class="tbutton small"><span><i class="icon-credit-card mid"></i><?php _e('Checkout','official');?></span></a>
                </div>
            </div>
        </div>
    </div><!-- end Shopping Cart -->
	<?php
	$fragments['.shopping_bag'] = ob_get_clean();

	ob_start();

	return $fragments;

}




// Change the Columns 
//--------------------------------------------------------------------------------------

add_filter('loop_shop_columns', 'loop_columns');

if (!function_exists('loop_columns')) {
	function loop_columns() {
		return _option('woo_col',3);
	}
}



// Change Number of products per page
//--------------------------------------------------------------------------------------
add_filter( 'loop_shop_per_page', 'official_loop_shop_per_page');
function official_loop_shop_per_page() {
	return _option('woo_item',12);
}



// Remove H1 Title
//--------------------------------------------------------------------------------------
add_filter('woocommerce_show_page_title', 'override_page_title');
function override_page_title() {
	return false;
}




// Add custom images size 
//--------------------------------------------------------------------------------------
add_action('admin_init','official_theme_activation');
function official_theme_activation()
{
	global $pagenow;
	if(is_admin() && 'themes.php' == $pagenow && isset($_GET['activated']))
	{
		update_option('shop_thumbnail_image_size', array('width' => 150, 'height' => '', 1));
		update_option('shop_catalog_image_size', array('width' => 300, 'height' => '', 1));
		update_option('shop_single_image_size', array('width' => 500, 'height' => '', 0));
		
	}
}



// Change the Position of Star Rating
//--------------------------------------------------------------------------------------
//remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
//add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_rating',1 );



// Related Product Columns
//--------------------------------------------------------------------------------------
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
add_action('woocommerce_after_single_product_summary', 'official_woocommerce_output_related_products', 15);
function official_woocommerce_output_related_products()
{
		$args = array(
			'posts_per_page' => _option('woo_col',3),
			'columns' => _option('woo_col',3),
			'orderby' => 'rand'
		);

		woocommerce_related_products( apply_filters( 'woocommerce_output_related_products_args', $args ) );
}




// Custom Search Form
//--------------------------------------------------------------------------------------
add_filter( 'get_product_search_form' , 'woo_custom_product_searchform' );
 
function woo_custom_product_searchform( $form ) {
$form = '<form role="search" method="get" id="searchform" action="' . esc_url( home_url( '/' ) ) . '">
			<div>
			<input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' . __( 'Search...', 'woocommerce' ) . '" />
			<input type="submit" id="searchsubmit" value="&#61442;" />
			<input type="hidden" name="post_type" value="product" />
			</div>
		</form>';
return $form;
}



?>