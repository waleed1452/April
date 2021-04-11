<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.7.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action('woocommerce_before_mini_cart');

$total_item = sizeof(WC()->cart->get_cart());
if (!isset($args) || !isset($args['list_class'])) {
	$args['list_class'] = '';
}
?>
<div class="shopping-cart-icon">
    <div class="icon">
        <a href="<?php echo esc_url( wc_get_cart_url() ); ?>">
            <span><?php echo esc_html($total_item); ?></span>
            <i class="ti-shopping-cart"></i>
        </a>
    </div>
    <div class="subtotal-info-wrapper">
        <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="gsf-link">
            <span class="cart-label"><?php esc_html_e('My cart', 'g5plus-april'); ?></span>
            <span class="cart-subtotal"><?php echo WC()->cart->get_cart_subtotal(); ?></span>
        </a>
    </div>
</div>
<div class="shopping-cart-list drop-shadow">
	<ul class="cart_list product_list_widget <?php echo esc_attr($args['list_class']); ?>">
		<?php if (!WC()->cart->is_empty()) : ?>

			<?php
            do_action( 'woocommerce_before_mini_cart_contents' );
			foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
				$_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
				$product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

				if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key)) {

					$product_name = apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key);
					$thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);
					$product_price = apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key);
                    $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
					?>
					<li class="<?php echo esc_attr(apply_filters('woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key)); ?>">
						<?php
						echo apply_filters('woocommerce_cart_item_remove_link', sprintf(
							'<a href="%s" class="remove remove_from_cart_button" title="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s"><i class="ion-android-close"></i></a>',
							esc_url(wc_get_cart_remove_url($cart_item_key)),
							esc_html__('Remove this item', 'g5plus-april'),
							esc_attr($product_id),
                            esc_attr( $cart_item_key ),
							esc_attr($_product->get_sku())
						), $cart_item_key);
						?>
                        <?php if ( empty( $product_permalink ) ) : ?>
                            <?php echo sprintf('%s %s',$thumbnail,$product_name); ?>
                        <?php else : ?>
                            <a href="<?php echo esc_url( $product_permalink ); ?>">
                                <?php echo sprintf('%s <span>%s</span>',$thumbnail ,$product_name) ; ?>
                            </a>
                        <?php endif; ?>
						<?php echo wc_get_formatted_cart_item_data($cart_item); ?>

						<?php echo apply_filters('woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf('%s &times; %s', $product_price, $cart_item['quantity']) . '</span>', $cart_item, $cart_item_key); ?>
					</li>
				<?php
				}
			}
			?>

		<?php else : ?>
            <?php $cart_empty_text = g5Theme()->options()->get_shop_cart_empty_text();?>
			<li class="empty"><?php echo wp_kses_post($cart_empty_text); ?></li>
		<?php endif; ?>
        <?php do_action( 'woocommerce_mini_cart_contents' ); ?>

	</ul>
	<!-- end product list -->

	<?php if (!WC()->cart->is_empty()) : ?>

		<p class="woocommerce-mini-cart__total total"><strong><?php _e('Subtotal', 'g5plus-april'); ?>
				:</strong> <?php echo WC()->cart->get_cart_subtotal(); ?></p>

		<?php do_action('woocommerce_widget_shopping_cart_before_buttons'); ?>

		<p class="woocommerce-mini-cart__buttons buttons">
			<a href="<?php echo esc_url(wc_get_cart_url()); ?>"
			   class="wc-forward btn btn-outline btn-sm btn-black"><?php _e('View Cart', 'g5plus-april'); ?></a>
			<a href="<?php echo esc_url(wc_get_checkout_url()); ?>"
			   class="checkout wc-forward btn btn-black btn-sm"><?php _e('Checkout', 'g5plus-april'); ?></a>
		</p>

	<?php endif; ?>

	<?php do_action('woocommerce_after_mini_cart'); ?>
</div>