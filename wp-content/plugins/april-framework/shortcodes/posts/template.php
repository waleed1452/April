<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $post_layout
 * @var $post_item_skin
 * @var $category
 * @var $tag
 * @var $ids
 * @var $orderby
 * @var $time_filter
 * @var $order
 * @var $meta_key
 * @var $posts_per_page
 * @var $show_cate_filter
 * @var $cate_filter_align
 * @var $post_columns_gutter
 * @var $is_slider
 * @var $rows
 * @var $dots
 * @var $nav
 * @var $nav_position
 * @var $nav_style
 * @var $loop
 * @var $autoplay
 * @var $autoplay_timeout
 * @var $columns
 * @var $columns_md
 * @var $columns_sm
 * @var $columns_xs
 * @var $columns_mb
 * @var $post_paging
 * @var $post_animation
 * @var $css_animation
 * @var $animation_duration
 * @var $animation_delay
 * @var $el_class
 * @var $css
 * @var $responsive
 * Shortcode class
 * @var $this WPBakeryShortCode_GSF_Posts
 */
$post_layout = $post_item_skin = $category = $tag = $ids = $orderby = $time_filter = $order = $meta_key = $posts_per_page = $show_cate_filter = $cate_filter_align
    = $post_columns_gutter = $is_slider = $rows = $dots = $nav = $nav_position = $nav_style = $loop = $autoplay = $autoplay_timeout = $columns = $columns_md = $columns_sm = $columns_xs
    = $columns_mb = $post_paging = $post_animation = $css_animation = $animation_duration = $animation_delay = $el_class = $css = $responsive = '';
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$wrapper_classes = array(
	'gf-posts',
    $cate_filter_align,
    'clearfix',
	G5P()->core()->vc()->customize()->getExtraClass($el_class),
	$this->getCSSAnimation($css_animation),
	vc_shortcode_custom_css_class( $css ),
	$responsive
);

if ('' !== $css_animation && 'none' !== $css_animation) {
	$animation_class = G5P()->core()->vc()->customize()->get_animation_class($animation_duration, $animation_delay);
	$wrapper_classes[] = $animation_class;
}

$args = array(
	'post_type'=> 'post',
	'ignore_sticky_posts' => true,
	'posts_per_page' => (is_numeric( $posts_per_page ) && $posts_per_page > 0) ? $posts_per_page : '-1',
	'orderby' => $orderby,
	'order' => $order,
	'meta_key' => ( 'meta_value' == $orderby || 'meta_value_num' == $orderby ) ? $meta_key : ''
);
$category = G5P()->helper()->get_term_ids_from_slugs(explode(',', $category), 'category');
if (count($category) > 0) {
	$args['category__in'] = $category;
}
$tag = G5P()->helper()->get_term_ids_from_slugs(explode(',', $tag), 'post_tag');
if (count($tag) > 0) {
	$args['tag__in'] = $tag;
}
// Prepares time filter
if ( $time_filter !== 'none' ) {
	$args['date_query'] = $this -> get_time_filter_query( $time_filter );
}
if ( ! empty( $ids ) ) {
	$post_id_array = explode( ',', $ids );

	// Split ids into post_in and post_not_in
    $post_in = array();
	foreach ( $post_id_array as $post_id ) {
		$post_id = trim( $post_id );
		if ( is_numeric( $post_id ) || intval($post_id) > 0) {
            $post_in[] = intval($post_id);
        }
	}
	if ( ! empty( $post_in ) ) {
		$args['post__in'] = $post_in;
	}
}

$settings = array(
	'posts_per_page' => (is_numeric( $posts_per_page ) && $posts_per_page > 0) ? $posts_per_page : '-1',
	'post_columns_gutter' => $post_columns_gutter,
	'post_layout' => $post_layout,
	'post_item_skin' => $post_item_skin,
	'post_paging' => $post_paging,
	'cat' => $category,
    'post_columns' => array(
		'lg' => $columns,
		'md' => $columns_md,
		'sm' => $columns_sm,
		'xs' => $columns_xs,
        'mb' => $columns_mb
	)
);

if('on' === $show_cate_filter) {
    $settings['category_filter_enable'] = true;
    $settings['category_filter_vertical'] = false;
    $settings['category_filter_type'] = 'click';
}
if($post_animation !== '') {
    $settings['post_animation'] = $post_animation;
}
$columns = intval($columns);
$post_columns_gutter = intval($post_columns_gutter);
$columns_md = intval($columns_md);
$columns_sm = intval($columns_sm);
$columns_xs = intval($columns_xs);
$columns_mb = intval($columns_mb);
if(in_array($post_layout, array('large-image', 'medium-image'))) {
    $columns = $columns_md = $columns_sm = $columns_xs = $columns_mb = 1;
}
if('on' === $is_slider) {
    $settings['post_paging'] = 'none';
    $carousel_class = '';
    if($rows == 1) {
        $owl_args = array(
            'items' => $columns,
            'margin' => $columns == 1 ? 0 : $post_columns_gutter,
            'slideBy' => $columns,
            'dots' => ($dots === 'on') ? true : false,
            'nav' => ($nav === 'on') ? true : false,
            'responsive' => array(
                '1200' => array(
                    'items' => $columns,
                    'margin' => $columns == 1 ? 0 : $post_columns_gutter,
                    'slideBy' => $columns,
                ),
                '992' => array(
                    'items' => $columns_md,
                    'margin' => $columns_md == 1 ? 0 : $post_columns_gutter,
                    'slideBy' => $columns_md,
                ),
                '768' => array(
                    'items' => $columns_sm,
                    'margin' => $columns_sm == 1 ? 0 : $post_columns_gutter,
                    'slideBy' => $columns_sm,
                ),
                '600' => array(
                    'items' => $columns_xs,
                    'margin' => $columns_xs == 1 ? 0 : $post_columns_gutter,
                    'slideBy' => $columns_xs,
                ),
                '0' => array(
                    'items' => $columns_mb,
                    'margin' => $columns_mb == 1 ? 0 : $post_columns_gutter,
                    'slideBy' => $columns_mb,
                )
            ),
            'autoHeight' => true,
            'loop' => ($loop === 'on') ? true : false,
            'autoplay' => ($autoplay === 'on') ? true : false,
            'autoplayTimeout' => intval($autoplay_timeout),
        );
    } else {
        $settings['itemSelector'] = '.carousel-item';
        $owl_args = array(
            'items' => 1,
            'margin' => 0,
            'slideBy' => 1,
            'dots' => ($dots === 'on') ? true : false,
            'nav' => ($nav === 'on') ? true : false,
            'autoHeight' => true,
            'loop' => ($loop === 'on') ? true : false,
            'autoplay' => ($autoplay === 'on') ? true : false,
            'autoplayTimeout' => intval($autoplay_timeout),
        );
        $settings['carousel_rows'] = array(
            'rows' => intval($rows),
            'items_show' => $rows*$columns
        );
        $carousel_class = 'carousel-gutter-'.$post_columns_gutter;
    }
    if($nav_style == 'nav-square-text' || $nav_style == 'nav-circle-text') {
        $owl_args['navText'] = array('<i class="fa fa-angle-left"></i> <span>'.esc_html__( 'Prev', 'april-framework' ).'</span>', '<span>'.esc_html__( 'Next', 'april-framework' ).'</span> <i class="fa fa-angle-right"></i>');
    }

    if($nav === 'on') {
        $carousel_class .= ' ' . $nav_position. ' ' . $nav_style;
    }
    if(!empty($carousel_class)) {
        $settings['carousel_class'] = $carousel_class;
    }
    $settings['carousel'] = $owl_args;
}

$class_to_filter = implode(' ', array_filter($wrapper_classes));
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts);
?>
<div class="<?php echo esc_attr($css_class) ?>">
	<?php if (function_exists('g5Theme')){g5Theme()->blog()->archive_markup($args, $settings);}  ?>
</div>