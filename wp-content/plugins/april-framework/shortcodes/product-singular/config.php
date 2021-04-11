<?php
/**
 * The template for displaying config.php
 *
 * @package WordPress
 * @subpackage april
 * @since april 1.0
 */
return array(
	'base' => 'gsf_product_singular',
	'name' => esc_html__('Product Singular', 'april-framework'),
	'category' => G5P()->shortcode()->get_category_name(),
	'icon' => 'fa fa-product-hunt',
	'params' => array(
        array(
            'type' => 'gsf_image_set',
            'heading' => esc_html__('Layout Style', 'april-framework'),
            'param_name' => 'layout_style',
            'value' => apply_filters('gsf_product_singular_layout_style', array(
                'style-01' => array(
                    'label' => esc_html__('Style 01', 'april-framework'),
                    'img' => G5P()->pluginUrl('assets/images/shortcode/product-singular-01.png'),
                ),
                'style-02' => array(
                    'label' => esc_html__('Style 02', 'april-framework'),
                    'img' => G5P()->pluginUrl('assets/images/shortcode/product-singular-02.png'),
                ),
                'style-03' => array(
                    'label' => esc_html__('Style 03', 'april-framework'),
                    'img' => G5P()->pluginUrl('assets/images/shortcode/product-singular-03.png'),
                ),
                'style-04' => array(
                    'label' => esc_html__('Style 04', 'april-framework'),
                    'img' => G5P()->pluginUrl('assets/images/shortcode/product-singular-04.png'),
                )
            )),
            'std' => 'style-01',
            'admin_label' => true
        ),
		array(
			'type' => 'autocomplete',
			'heading' => __( 'Choose product to show', 'april-framework' ),
			'param_name' => 'product_ids',
            'settings' => array(
                'multiple' => false,
                'unique_values' => true,
                'display_inline' => true
            ),
            'save_always' => true,
		),
        array(
            'type' => 'textfield',
            'heading' => __( 'Custom Product Title', 'april-framework' ),
            'param_name' => 'custom_product_title'
        ),
        array(
            'type' => 'attach_images',
            'heading' => esc_html__('Custom Images', 'april-framework'),
            'description' => esc_html__('Choose gallery to show (set empty to use above product image)', 'april-framework'),
            'param_name' => 'images'
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Image Size', 'april-framework'),
            'description' => esc_html__('Enter image size ("thumbnail" or "full"). Alternatively enter size in pixels (Example: 280x180, 330x180, 380x180 (Not Include Unit, Space)).', 'april-framework'),
            'param_name' => 'image_size',
            'std' => '516x572',
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'dependency' => array('element' => 'images', 'value_not_equal_to' => array(''))
        ),
        array(
            'type' => 'gsf_button_set',
            'heading' => __( 'Product Info Size', 'april-framework' ),
            'param_name' => 'name_size',
            'value' => array(
                esc_html__('Larrge', 'april-framework') => 'large',
                esc_html__('Medium', 'april-framework') => 'medium'
            ),
            'std' => 'medium'
        ),
		array(
			'type' => 'textfield',
            'heading' => __( 'Additional Information', 'april-framework' ),
			'param_name' => 'additional_info'
		),
		G5P()->shortcode()->vc_map_add_css_animation(),
		G5P()->shortcode()->vc_map_add_animation_duration(),
		G5P()->shortcode()->vc_map_add_animation_delay(),
		G5P()->shortcode()->vc_map_add_extra_class(),
		G5P()->shortcode()->vc_map_add_css_editor(),
		G5P()->shortcode()->vc_map_add_responsive()
	)
);