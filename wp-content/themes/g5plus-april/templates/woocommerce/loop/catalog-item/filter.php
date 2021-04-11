<?php
/**
 * Created by PhpStorm.
 * User: thanglk
 * Date: 07/08/2017
 * Time: 8:11 SA
 */

global $wp_registered_sidebars;
$woocommerce_customize_filter = g5Theme()->options()->get_woocommerce_customize_filter();
if('show-bellow' !== $woocommerce_customize_filter) {
    add_action('wp_footer', array(g5Theme()->templates(), 'canvas_filter'), 10);
}
if('show-bellow' === $woocommerce_customize_filter) : ?>
<div class="gf-toggle-filter gf-filter-bellow" data-target="#filter-content">
    <?php esc_html_e('Filter', 'g5plus-april'); ?> <span class="ion-ios-settings-strong"></span>
</div>
<?php else: ?>
<div data-off-canvas="true" data-off-canvas-target="#canvas-filter-wrapper" data-off-canvas-position="left" class="gf-toggle-filter">
    <?php esc_html_e('Filter', 'g5plus-april'); ?> <span class="ion-ios-settings-strong"></span>
</div>
<?php endif; ?>