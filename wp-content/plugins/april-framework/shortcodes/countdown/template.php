<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $layout_style
 * @var $time
 * @var $value_color
 * @var $url_redirect
 * @var $css_animation
 * @var $animation_duration
 * @var $animation_delay
 * @var $el_class
 * @var $css
 * @var $responsive
 * Shortcode class
 * @var $this WPBakeryShortCode_GSF_Countdown
 */
$layout_style = $time = $value_color = $url_redirect = $css_animation = $animation_duration = $animation_delay = $el_class = $css = $responsive = '';
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$wrapper_classes = array(
	'gsf-countdown',
    'gsf-countdown-' . $layout_style,
    G5P()->core()->vc()->customize()->getExtraClass($el_class),
    $this->getCSSAnimation($css_animation),
    vc_shortcode_custom_css_class( $css ),
    $responsive
);

if ('' !== $css_animation && 'none' !== $css_animation) {
    $animation_class = G5P()->core()->vc()->customize()->get_animation_class($animation_duration, $animation_delay);
    $wrapper_classes[] = $animation_class;
}
if(empty($value_color)) {
    $value_color = '#000';
}
$countdown_class = 'gsf-countdown-' . uniqid();
$countdown_css = <<<CSS
    .{$countdown_class} .countdown-value {
        color: {$value_color} !important;
    }
CSS;
GSF()->customCss()->addCss($countdown_css);
$wrapper_classes[] = $countdown_class;

$class_to_filter = implode(' ', array_filter($wrapper_classes));
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts);

if (!(defined('CSS_DEBUG') && CSS_DEBUG)) {
    wp_enqueue_style(G5P()->assetsHandle('g5-countdown'), G5P()->helper()->getAssetUrl('shortcodes/countdown/assets/css/countdown.min.css'), array(), G5P()->pluginVer());
}
wp_enqueue_script(G5P()->assetsHandle('countdown_js'), G5P()->helper()->getAssetUrl('shortcodes/countdown/assets/js/countdown.min.js'), array( 'jquery' ), G5P()->pluginVer(), true);

if (!empty($time)) {
    $time = mysql2date('Y/m/d H:i:s', $time);

    ?>
    <div class="<?php echo esc_attr($css_class) ?>"
         data-url-redirect="<?php echo esc_attr($url_redirect) ?>"
         data-date-end="<?php echo esc_attr($time); ?>">
        <div class="gsf-countdown-inner">
            <div class="countdown-section">
                <span class="countdown-value countdown-day">00</span>
                <span class="countdown-text"><?php esc_html_e('Days', 'april-framework'); ?></span>
            </div>
            <div class="countdown-section">
                <span class="countdown-value countdown-hours">00</span>
                <span class="countdown-text"><?php esc_html_e('Hours', 'april-framework'); ?></span>
            </div>
            <div class="countdown-section">
                <span class="countdown-value countdown-minutes">00</span>
                <span class="countdown-text"><?php esc_html_e('Mins', 'april-framework'); ?></span>
            </div>
            <div class="countdown-section">
                <span class="countdown-value countdown-seconds">00</span>
                <span class="countdown-text"><?php esc_html_e('Secs', 'april-framework'); ?></span>
            </div>
        </div>
    </div>
    <?php
}