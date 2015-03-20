<?php
class Bl_Slider_Cms_Model {

    private static $_instance = null;

    private function __construct() { }

    private function  __clone() { }

    public static function getInstance() {
        if( !is_object(self::$_instance) )
            self::$_instance = new Bl_Slider_Cms_Model();
        return self::$_instance;
    }

    public function get_slider_posts( $atts ){

        $args = array(
            'post_type' => 'bl-slider',
            'posts_per_page' => $atts['limit'],
            'orderby' => 'menu_order',
            'order' => 'ASC',
            'suppress_filters' => 0
        );

        if( ! empty ( $atts['categories'] ) ){
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'bl-slider-category',
                    'field' => 'slug',
                    'terms' => explode( ',', $atts['categories']),
                    'operator' => 'AND'
                )
            );
        }

        return get_posts( $args );

    }

} 