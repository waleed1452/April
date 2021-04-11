<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.2
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $post, $woocommerce, $product, $product_images, $gallery_id;
$product_images = array();
$index = 0;
$image_ids = array();

if (has_post_thumbnail()) {
    $product_images[$index] = array(
        'image_id' => get_post_thumbnail_id()
    );
    $image_ids[$index] = get_post_thumbnail_id();
    $index++;
}

// Additional Images
$attachment_ids = $product->get_gallery_image_ids();
if ($attachment_ids) {
    foreach ($attachment_ids as $attachment_id) {
        if (in_array($attachment_id, $image_ids)) continue;
        $product_images[$index] = array(
            'image_id' => $attachment_id
        );
        $image_ids[$index] = $attachment_id;
        $index++;
    }
}

// product variable type
if ($product->get_type() == 'variable') {
    $available_variations = $product->get_available_variations();

    if (isset($available_variations)) {
        foreach ($available_variations as $available_variation) {
            $variation_id = $available_variation['variation_id'];
            if (has_post_thumbnail($variation_id)) {
                $variation_image_id = get_post_thumbnail_id($variation_id);

                if (in_array($variation_image_id, $image_ids)) {
                    $index_of = array_search($variation_image_id, $image_ids);
                    if (isset($product_images[$index_of]['variation_id'])) {
                        $product_images[$index_of]['variation_id'] .= $variation_id . '|';
                    } else {
                        $product_images[$index_of]['variation_id'] = '|' . $variation_id . '|';
                    }
                    continue;
                }

                $product_images[$index] = array(
                    'image_id' => $variation_image_id,
                    'variation_id' => '|' . $variation_id . '|'
                );
                $image_ids[$index] = $variation_image_id;
                $index++;
            }

            $variation_gallery_ids = get_post_meta( $variation_id, '_wc_additional_variation_images', true );
            $variation_gallery_ids = explode(',',$variation_gallery_ids);

            foreach ($variation_gallery_ids as $variation_gallery_id) {
                if (in_array($variation_gallery_id, $image_ids) || empty($variation_gallery_id)) continue;
                $product_images[$index] = array(
                    'image_id' => $variation_gallery_id
                );
                $image_ids[$index] = $variation_gallery_id;
                $index++;
            }
        }
    }
}

$gallery_id = rand();
?>
<div id="single-product-image" class="single-product-image-inner">
    <div class="single-product-image-main-wrap">
        <div class="single-product-image-main">
            <?php
            if(count($product_images) > 0) {
                $image_id = $product_images[0]['image_id'];
                g5Theme()->blog()->render_post_image_markup(array(
                    'post_id' => $post->ID,
                    'image_id' => $image_id,
                    'image_size' => 'full',
                    'gallery_id' => $gallery_id,
                    'display_permalink' => false,
                    'is_single' => true,
                    'image_mode' => 'image'
                ));
            }?>
        </div>
        <?php
        /**
         * g5plus_after_single_product_image_main hook.
         *
         * @hooked g5plus_woocommerce_template_loop_sale_count_down - 10
         */
        do_action( 'g5plus_after_single_product_image_main' );
        ?>
    </div>
</div>
