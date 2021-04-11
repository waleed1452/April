<?php
$product_rating_enable = g5Theme()->options()->get_product_rating_enable();
?>

<h4 class="product-name product_title<?php echo esc_attr($product_rating_enable === 'on' ? ' product-title-rating' : ''); ?>">
    <a class="gsf-link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
</h4>
