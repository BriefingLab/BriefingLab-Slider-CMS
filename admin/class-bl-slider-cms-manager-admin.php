<?php

class Bl_Slider_Cms_Manager_Admin {

    private $version;

    private $data_model;

    private $cache_manager;

    private $options;

    function __construct( $version, $options, $data_model, $cache_manager )
    {

        $this->version = $version;

        $this->options = $options;

        $this->data_model = $data_model;

        $this->cache_manager = $cache_manager;

    }

    function register_bl_slider_post_type() {

        $labels = array(
            'name'               => __( 'Sliders', 'bl-slider-cms' ),
            'singular_name'      => __( 'Slide', 'bl-slider-cms' ),
            'menu_name'          => __( 'Sliders', 'admin menu', 'bl-slider-cms' ),
            'name_admin_bar'     => __( 'Slide', 'add new on admin bar', 'bl-slider-cms' ),
            'add_new'            => __( 'Add New Slide', 'bl-slider-cms' ),
            'add_new_item'       => __( 'Add New Slide', 'bl-slider-cms' ),
            'new_item'           => __( 'New Slide', 'bl-slider-cms' ),
            'edit_item'          => __( 'Edit Slide', 'bl-slider-cms' ),
            'view_item'          => __( 'View Slide', 'bl-slider-cms' ),
            'all_items'          => __( 'All Sliders', 'bl-slider-cms' ),
            'search_items'       => __( 'Search Sliders', 'bl-slider-cms' ),
            'parent_item_colon'  => __( 'Parent Sliders:', 'bl-slider-cms' ),
            'not_found'          => __( 'No sliders found.', 'bl-slider-cms' ),
            'not_found_in_trash' => __( 'No sliders found in Trash.', 'bl-slider-cms' )
        );

        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'slide' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'map_meta_cap'       => true,
            'exclude_from_search'=> true,
            'menu_position'      => null,
            'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'page-attributes' )
        );

        register_post_type( 'bl-slider', $args );

        $slider_category_labels = array(
            'name' => __( 'Category', 'bl-slider-cms' ),
            'singular_name' => __( 'Categoria', 'bl-slider-cms' ),
            'search_items' =>  __( 'Search Category', 'bl-slider-cms' ),
            'all_items' => __( 'All Categories', 'bl-slider-cms' ),
            'parent_item' => __( 'Parent Category', 'bl-slider-cms' ),
            'parent_item_colon' => __( 'Parent Category', 'bl-slider-cms' ),
            'edit_item' => __( 'Edit Category', 'bl-slider-cms' ),
            'update_item' => __( 'Update Category', 'bl-slider-cms' ),
            'add_new_item' => __( 'Add New Category', 'bl-slider-cms' ),
            'new_item_name' => __( 'New Category', 'bl-slider-cms' ),
            'menu_name' => __( 'Category', 'bl-slider-cms' ),
        );

        $slider_category_args = array(
            'hierarchical' => true,
            'labels' => $slider_category_labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'sliders' ),
            'show_in_nav_menus' => true,
        );

        register_taxonomy('bl-slider-category', array('bl-slider'), $slider_category_args);

        if( ! get_option( 'bl-slider-default-category') ){

            $default_bl_slider_category_cats = array('homepage');

            foreach($default_bl_slider_category_cats as $cat){

                if(!term_exists($cat, 'bl-slider-category')) wp_insert_term($cat, 'bl-slider-category');

            }

            add_option( 'bl-slider-default-category', true );

        }

    }

    public function add_delete_cache_menu_link(){

        add_submenu_page( 'edit.php?post_type=bl-slider', __( 'Briefinglab Slider CMS Cache', 'bl-slider-cms' ), __( 'Delete Cache', 'bl-slider-cms' ), 'manage_options', 'delete-cache-slider', array( $this, 'delete_cache' ) );

    }

    public function delete_cache() {

        $delete_status = $this->cache_manager->delete_cache();

        ?>

        <div class="wrap">

            <h2><?php _e( 'Slider CMS Cache', 'bl-slider-cms' ); ?></h2>

            <?php if( $delete_status ):?>

                <div class="update-nag">
                    <?php _e( 'Cache have been deleted successfully', 'bl-slider-cms' ); ?>
                </div>

            <?php else: ?>

                <div class="update-nag">
                    <?php _e( 'There was an error trying to delete the cache. Please check write permission for the cache folder', 'bl-slider-cms' ); ?>
                </div>

            <?php endif; ?>

        </div>

<?php
    }

    function load_textdomain() {

        load_plugin_textdomain( 'bl-slider-cms', false, dirname( dirname( plugin_basename( __FILE__ ) ) )  . '/langs/' );

    }

    function delete_cache_updating_post( $post_id, $post, $update ) {

        // If this isn't a 'book' post, don't update it.
        if ( 'bl-slider' != $post->post_type ) {
            return;
        }

        $this->cache_manager->delete_cache();

    }

}