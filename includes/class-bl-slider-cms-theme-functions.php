<?php

class Bl_Slider_Cms_Theme_Functions {

    function __construct() { }

    public static function  define_theme_functions() {

	   if( ! function_exists( 'bl_slider_content' ) ) {
            function bl_slider_content( $content ) {

                $content = apply_filters( 'bl-slider-content', $content );

                return $content;

            }
        }


    }
}
