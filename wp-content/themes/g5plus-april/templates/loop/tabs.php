<?php
/**
 * The template for displaying tabs
 * @var $tabs
 */
$accent_color = g5Theme()->options()->get_accent_color();
?>
<ul data-items-tabs class="nav nav-tabs gsf-pretty-tabs">
	<?php $index = 1; ?>
	<?php foreach ($tabs as $tab): ?>
		<?php
			$title = isset($tab['title']) ? $tab['title'] : '';
			$settingId = isset($tab['settingId']) ? $tab['settingId'] : '';
		?>
		<li class="<?php echo esc_attr($index == 1 ? 'active' : '');?>">
			<a data-id="<?php echo esc_attr($settingId)?>" href="#" class="no-animation" title="<?php echo esc_attr($title)?>"><?php echo esc_html($title); ?></a>
		</li>
		<?php $index++; ?>
	<?php endforeach; ?>
</ul>
