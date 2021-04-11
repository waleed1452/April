<?php
/**
 * The template for displaying footer
 */
$footer_enable = g5Theme()->options()->get_footer_enable();
if ($footer_enable !== 'on') return;
$footer_fixed_enable = g5Theme()->options()->get_footer_fixed_enable();
$wrapper_classes = array(
	'main-footer-wrapper'
);

if ($footer_fixed_enable === 'on') {
	$wrapper_classes[] = 'footer-fixed';
}
$content_block = g5Theme()->options()->get_footer_content_block();
$content_block = g5Theme()->helper()->content_block($content_block);
$wrapper_class = implode(' ', array_filter($wrapper_classes));
?>
<footer class="<?php echo esc_attr($wrapper_class); ?>">
    <?php if (!empty($content_block)) : ?>
        <?php printf('%s', $content_block); ?>
    <?php endif; ?>
</footer>
