<?php
/**
 * The template for displaying load-more.php
 *
 * @package WordPress
 * @subpackage april
 * @since april 1.0
 * @var $settingId
 * @var $pagenum_link
 */
global $wp_query;
$paged   =  $wp_query->get( 'page' ) ? intval( $wp_query->get( 'page' ) ) : ($wp_query->get( 'paged' ) ? intval( $wp_query->get( 'paged' ) ) : 1);
$next_classes = array(
	'no-animation',
	'gf-button-next'
);
$prev_classes = array(
	'no-animation',
	'gf-button-prev'
);
if ($paged >=  $wp_query->max_num_pages) {
    $next_classes[] = 'disable';
}

if ($paged <= 1) {
    $prev_classes[] = 'disable';
}
$next_class = implode(' ', array_filter($next_classes));
$prev_class = implode(' ', array_filter($prev_classes));

$next_link = get_next_posts_page_link($wp_query->max_num_pages);
$prev_link = get_previous_posts_page_link();
?>
<div data-items-paging="next-prev" class="gf-paging next-prev text-center clearfix" data-id="<?php echo esc_attr($settingId) ?>">
	<a title="<?php esc_html_e('Prev', 'g5plus-april') ?>"class="<?php echo esc_attr($prev_class)?>" href="<?php echo esc_url($prev_link); ?>">
		<i class="ion-arrow-left-c"></i>
	</a>
	<a title="<?php esc_html_e('Next', 'g5plus-april') ?>" class="<?php echo esc_attr($next_class)?>" href="<?php echo esc_url($next_link); ?>">
		<i class="ion-arrow-right-c"></i>
	</a>
</div>
