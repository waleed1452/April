<?php
/**
 * The template for displaying top-bar
 *
 * @package WordPress
 * @subpackage april
 * @since april 1.0
 */
$top_bar_enable = g5Theme()->options()->get_mobile_top_bar_enable();
if ($top_bar_enable !== 'on') return;
$content_block = g5Theme()->options()->get_mobile_top_bar_content_block();
$content_block = g5Theme()->helper()->content_block($content_block);
?>
<div class="mobile-top-bar">
    <?php if (!empty($content_block)) {
        echo wp_kses_post($content_block);
    } ?>
</div>
