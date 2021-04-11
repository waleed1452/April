<?php
/**
 * The template for displaying infinite-scroll.php
 * @var $settingId
 */
global $wp_query;
$paged   =  $wp_query->get( 'page' ) ? intval( $wp_query->get( 'page' ) ) : ($wp_query->get( 'paged' ) ? intval( $wp_query->get( 'paged' ) ) : 1);
$paged = intval($paged) + 1;
if ($paged > $wp_query->max_num_pages) return;
$next_link = get_next_posts_page_link($wp_query->max_num_pages);
if (empty($next_link)) return;
?>
<div data-items-paging="infinite-scroll" class="gf-paging infinite-scroll clearfix text-center" data-id="<?php echo esc_attr($settingId) ?>">
	<a data-paged="<?php echo esc_attr($paged); ?>" class="no-animation transition03 gsf-link" href="<?php echo esc_url($next_link); ?>">
	</a>
</div>
