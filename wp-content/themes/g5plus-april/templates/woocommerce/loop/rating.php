<?php
/**
 * Loop Rating
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/rating.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $product;

if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' ) {
    return;
}

$product_rating_enable = g5Theme()->options()->get_product_rating_enable();
if('on' !== $product_rating_enable) return;

$rating_count = $product->get_rating_count();
if($rating_count > 0) {
    echo '<div class="product-rating">';
    echo wc_get_rating_html($product->get_average_rating());
    echo '<a href="' . get_the_permalink() . '#reviews" class="woocommerce-review-link" rel="nofollow"><span class="rating-count">' . sprintf(esc_html__('(Based on %s review)','g5plus-april'), $rating_count) . '</span></a>';
    echo '</div>';
}
