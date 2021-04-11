<?php
if (!class_exists('G5P_Inc_Term_Meta')) {
    class G5P_Inc_Term_Meta {
        private static $_instance;
        public static function getInstance() {
            if (self::$_instance == NULL) { self::$_instance = new self(); }
            return self::$_instance;
        }
        public function get_page_title_enable($id = ''){ return $this->getMetaValue('gsf_april_page_title_enable', $id); }
        public function get_page_title_content_block($id = ''){ return $this->getMetaValue('gsf_april_page_title_content_block', $id); }
        public function get_page_title_content($id = ''){ return $this->getMetaValue('gsf_april_page_title_content', $id); }
        public function get_product_taxonomy_color($id = ''){ return $this->getMetaValue('gsf_april_product_taxonomy_color', $id); }
        public function getMetaValue($meta_key, $id = '') {
            if ($id === '') {
                $queried_object = get_queried_object();
                $id = $queried_object->term_id;
            }

            $value = get_term_meta($id, $meta_key, true);
            if ($value === '') {
                $default = &$this->getDefault();
                if (isset($default[$meta_key])) {
                    $value = $default[$meta_key];
                }
            }
            return $value;
        }


        public function &getDefault() {
            $default = array (
                'gsf_april_page_title_enable' => '',
                'gsf_april_page_title_content_block' => '',
                'gsf_april_page_title_content' => '',
                'gsf_april_product_taxonomy_color' => '#000'
            );
            return $default;
        }
    }
}