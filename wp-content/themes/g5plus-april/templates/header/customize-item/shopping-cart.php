<?php
/**
 * @var $customize_location
 */
if (!class_exists('WooCommerce')) {
    return;
}
$cart_icon_style = g5Theme()->options()->getOptions("header_customize_{$customize_location}_cart_icon_style");
?>
<div class="header-customize-item item-shopping-cart fold-out hover woocommerce cart-icon-<?php echo esc_attr($cart_icon_style); ?>">
    <div class="widget_shopping_cart_content">
        <?php wc_get_template('cart/mini-cart.php'); ?>
    </div>
</div>