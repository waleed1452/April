<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $layout_style
 * @var $product_ids
 * @var $custom_product_title
 * @var $images
 * @var $image_size
 * @var $name_size
 * @var $additional_info
 * @var $css_animation
 * @var $animation_duration
 * @var $animation_delay
 * @var $el_class
 * @var $css
 * @var $responsive
 * Shortcode class
 * @var $this WPBakeryShortCode_GSF_Product_Singular
 */
$layout_style = $product_ids = $custom_product_title = $images = $image_size = $name_size = $additional_info = $css_animation = $animation_duration = $animation_delay = $el_class = $css = $responsive = '';
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$wrapper_classes = array(
	'gsf-product-singular',
	'woocommerce',
	'product',
	'product-item-wrap',
	'gsf-product-singular-' . $layout_style,
	G5P()->core()->vc()->customize()->getExtraClass($el_class),
	$this->getCSSAnimation($css_animation),
	vc_shortcode_custom_css_class( $css ),
	$responsive
);

if ('' !== $css_animation && 'none' !== $css_animation) {
	$animation_class = G5P()->core()->vc()->customize()->get_animation_class($animation_duration, $animation_delay);
	$wrapper_classes[] = $animation_class;
}

if(empty($product_ids)) return;
global $product;
$product = wc_get_product( $product_ids );
if(empty($images)) {
    $images = array();
    if(has_post_thumbnail($product_ids)) {
        $images[] = get_post_thumbnail_id($product_ids);
    }
    $attachment_ids = $product->get_gallery_image_ids();
    if ($attachment_ids) {
        foreach ($attachment_ids as $attachment_id) {
            if (in_array($attachment_id, $images)) continue;
            $images[] = $attachment_id;
        }
    }
} else {
    $images = explode(',', $images);
}
$product_class = 'gf-product-singular-' . uniqid();
$name_fs = 24;
$name_lh = 24;
$price_fs = 18;
$price_del_fs = 16;
$margin_bottom = 16;
if('large' === $name_size) {
    $name_fs = 34;
    $price_fs = 24;
    $price_del_fs = 20;
    $margin_bottom = 10;
}
if('style-02' === $layout_style) {
    $name_fs = 16;
    $price_fs = 14;
    $price_del_fs = 12;
    $margin_bottom = 10;
    if('large' === $name_size) {
        $name_fs = 20;
        $price_fs = 18;
        $price_del_fs = 16;
    }
}
if('style-03' === $layout_style) {
    $name_fs = 18;
    $price_fs = 14;
    $price_del_fs = 12;
    if('large' === $name_size) {
        $name_fs = 40;
        $name_lh = 56;
        $price_fs = 20;
        $price_del_fs = 18;
        $margin_bottom = 16;
    }
}
if('style-04' === $layout_style) {
    $name_fs = 18;
    $price_fs = 14;
    $price_del_fs = 12;
    if('large' === $name_size) {
        $name_fs = 24;
        $margin_bottom = 16;
    }
}
$product_css = <<<CSS
    .{$product_class} .product-info .product-name {
        font-size: {$name_fs}px;
        margin-bottom: {$margin_bottom}px !important;
        line-height: {$name_lh}px;
    }
    .{$product_class} .product-info .price {
        font-size: {$price_fs}px;
    }
    .{$product_class} .product-info .price del {
        font-size: {$price_del_fs}px;
    }
CSS;
GSF()->customCss()->addCss($product_css);
$wrapper_classes[] = $product_class;
$class_to_filter = implode(' ', array_filter($wrapper_classes));
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts);
if (!(defined('CSS_DEBUG') && CSS_DEBUG)) {
    wp_enqueue_style(G5P()->assetsHandle('gf-product-singular'), G5P()->helper()->getAssetUrl('shortcodes/product-singular/assets/css/product-singular.min.css'), array(), G5P()->pluginVer());
}
?>
<div class="<?php echo esc_attr($css_class) ?>">
    <?php if(!empty($additional_info) && $images !== array()): ?>
        <span class="additional-info"><?php echo esc_html($additional_info); ?></span>
    <?php endif; ?>
    <?php if('style-03' === $layout_style): ?>
        <?php do_action('april_product_singular_sale_flash'); ?>
    <?php endif; ?>
    <?php if('style-04' === $layout_style): ?>
    <div class="product-info">
        <?php
        $product_title = $product->get_title();
        if(!empty($custom_product_title)) {
            $product_title = $custom_product_title;
        }
        ?>
        <h4 class="product-name"><a href="<?php echo esc_url($product->get_permalink()); ?>" title="<?php echo wp_kses_post($product_title); ?>"><?php echo wp_kses_post($product_title); ?></a></h4>
        <p class="price"><?php echo wp_kses_post($product->get_price_html()); ?></p>
    </div>
    <?php endif; ?>
    <?php if($images !== array()): ?>
        <?php
        $owl_attrs = array(
            'items' => 1,
            'nav' => true,
            'loop' => false,
            'autoHeight' => true,
            'slideSpeed' => '500',
            'paginationSpeed' => '500'
        )
        ?>
        <div class="product-thumbnail product-item-inner">
            <?php if('style-03' !== $layout_style): ?>
                <?php do_action('april_product_singular_sale_flash'); ?>
            <?php endif; ?>
            <div class="product-singular-images owl-carousel owl-theme nav-center nav-icon"  data-owl-options='<?php echo json_encode( $owl_attrs );?>'>
                <?php foreach ($images as $image):
                    $width = $height = $image_src = $image_full_src = '';
                    if (preg_match('/\d+x\d+/', $image_size)) {
                        $image_sizes = explode('x', $image_size);
                        $width = $image_sizes[0];
                        $height = $image_sizes[1];
                        $image_src = array();
                        if(function_exists('g5Theme')) {
                            $image_src = g5Theme()->image_resize()->resize(array(
                                'image_id' => $image,
                                'width' => $width,
                                'height' => $height
                            ));
                        }
                        if (isset($image_src['url']) && ($image_src['url'] !== '')) {
                            $image_src = $image_src['url'];
                        }
                        $image_full_src = wp_get_attachment_image_src($image, 'full');
                        if ($image_full_src && !empty($image_full_src[0])) {
                            $image_full_src = $image_full_src[0];
                        }
                    } else {
                        if (!in_array($image_size, array('full', 'thumbnail'))) {
                            $image_size = 'full';
                        }
                        $image_src = wp_get_attachment_image_src($image, $image_size);
                        if ($image_src && !empty($image_src[0])) {
                            $width = isset($image_src[1]) ? intval($image_src[1]) : 0;
                            $height = isset($image_src[2]) ? intval($image_src[2]) : 0;
                            $image_src = $image_src[0];
                            $image_full_src = $image_src;
                        }
                    }
                    ?>
                    <div class="image-item">
                        <img width="<?php echo esc_attr($width); ?>" height="<?php echo esc_attr($height);?>" src="<?php echo esc_url($image_src)?>" alt="<?php echo wp_kses_post($product->get_title())?>" />
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="product-actions">
                <?php do_action('april_product_singular_product_actions'); ?>
            </div>
        </div>
    <?php endif; ?>
    <?php if('style-04' !== $layout_style): ?>
        <div class="product-info">
            <?php
            $product_title = $product->get_title();
            if(!empty($custom_product_title)) {
                $product_title = $custom_product_title;
            }
            ?>
            <h4 class="product-name"><a href="<?php echo esc_url($product->get_permalink()); ?>" title="<?php echo wp_kses_post($product_title); ?>"><?php echo wp_kses_post($product_title); ?></a></h4>
            <p class="price"><?php echo wp_kses_post($product->get_price_html()); ?></p>
        </div>
    <?php endif; ?>
</div>