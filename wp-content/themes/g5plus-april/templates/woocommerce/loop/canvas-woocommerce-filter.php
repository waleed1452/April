<?php
/**
 * The template for displaying canvas-sidebar
 */
global $wp_registered_sidebars;
$skin = g5Theme()->options()->get_canvas_sidebar_skin();
$wrapper_classes = array(
	'canvas-sidebar-wrapper'
);

$inner_classes = array(
	'canvas-sidebar-inner',
	'sidebar'
);

$skin_classes = g5Theme()->helper()->getSkinClass($skin, true);
$wrapper_classes = array_merge($wrapper_classes,$skin_classes);

$wrapper_class = implode(' ',array_filter($wrapper_classes));
$inner_class = implode(' ',array_filter($inner_classes));
?>
<div id="canvas-filter-wrapper" class="<?php echo esc_attr($wrapper_class); ?>">
    <a href="javascript:;" class="gsf-link close-canvas" title="<?php esc_html_e('Close', 'g5plus-april'); ?>"><i class="ion-android-close"></i></a>
	<div class="<?php echo esc_attr($inner_class)?>">
		<?php if (is_active_sidebar('woocommerce-filter')): ?>
			<?php dynamic_sidebar('woocommerce-filter'); ?>
		<?php endif; ?>
	</div>
</div>
