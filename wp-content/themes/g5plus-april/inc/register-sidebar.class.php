<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

if (!class_exists('G5Plus_Inc_Register_Sidebar')) {
	class G5Plus_Inc_Register_Sidebar {
		private static $_instance;
		public static function getInstance()
		{
			if (self::$_instance == NULL) {
				self::$_instance = new self();
			}

			return self::$_instance;
		}

		public function init(){
			$sidebars = apply_filters('g5plus_sidebars',array(
				array(
					'id' => 'main',
					'name' => esc_html__('Main', 'g5plus-april'),
				),
			)) ;
			foreach ($sidebars as $sidebar) {
				register_sidebar(array(
					'name' => $sidebar['name'],
					'id' => $sidebar['id'],
					'description' => isset($sidebar['description']) ? $sidebar['description'] : sprintf(esc_html__('Add widgets here to appear in %s sidebar', 'g5plus-april'), $sidebar['name']),
					'before_widget' => '<aside id="%1$s" class="widget %2$s">',
					'after_widget' => '</aside>',
					'before_title' => '<h4 class="widget-title"><span>',
					'after_title' => '</span></h4>',
				));
			}
		}
	}
}