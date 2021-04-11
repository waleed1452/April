<?php
/**
 * The template for displaying canvas-sidebar
 */
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
<div id="canvas-sidebar-wrapper" class="<?php echo esc_attr($wrapper_class); ?>">
	<div class="<?php echo esc_attr($inner_class)?>">
		<?php if (is_active_sidebar('canvas')): ?>
			<?php dynamic_sidebar('canvas'); ?>
		<?php endif; ?>
	</div>
</div>
