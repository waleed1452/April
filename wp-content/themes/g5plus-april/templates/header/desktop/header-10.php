<?php
/**
 * The template for displaying layout-10
 *
 * @package WordPress
 * @subpackage april
 * @since april 3.0
 * @var $header_layout
 * @var $header_float_enable
 * @var $header_border
 * @var $header_content_full_width
 * @var $header_sticky_enable
 * @var $navigation_skin
 * @var $page_menu
 */

$header_classes = array(
	'header-wrap'
);

$header_inner_classes = array(
	'header-inner',
    'x-nav-menu-container'
);

if ($header_border === 'container') {
	$header_inner_classes[] = 'gf-border-bottom';
	$header_inner_classes[] = 'border-color';
}

if ($header_border == 'full') {
	$header_classes[] = 'gf-border-bottom';
	$header_classes[] = 'border-color';
}

if ($header_sticky_enable == 'on') {
	$header_classes[] = 'header-sticky';
}

if ($header_content_full_width === 'on') {
    $header_classes[] = 'header-full-width';
}

$header_class = implode(' ', array_filter($header_classes));
$header_inner_class = implode(' ', array_filter($header_inner_classes));
?>
<div class="<?php echo esc_attr($header_class) ?>">
    <div class="container">
		<div class="<?php echo esc_attr($header_inner_class) ?>">
			<nav class="primary-menu">
                <div class="primary-menu-inner">
                    <?php if (has_nav_menu('primary') || $page_menu) {
                        $arg_menu = array(
                            'menu_id'        => 'main-menu',
                            'container'      => '',
                            'theme_location' => 'primary',
                            'menu_class'     => 'main-menu clearfix',
                            'main_menu'      => true
                        );
                        if (!empty($page_menu)) {
                            $arg_menu['menu'] = $page_menu;
                        }
                        wp_nav_menu($arg_menu);
                    } ?>
                </div>
			</nav>
            <?php g5Theme()->helper()->getTemplate('header/desktop/logo', array('header_layout' => $header_layout)); ?>
            <?php g5Theme()->helper()->getTemplate('header/header-customize', array('customize_location' => 'right', 'canvas_position' => 'right')); ?>
		</div>
    </div>
</div>


