<?php
/**
 * The template for displaying sidebar
 * @var $customize_location
 */
global $wp_registered_sidebars;
$sidebar = g5Theme()->options()->getOptions("header_customize_{$customize_location}_sidebar");
?>
<?php if (is_active_sidebar($sidebar)): ?>
	<?php dynamic_sidebar($sidebar) ?>
<?php endif; ?>
