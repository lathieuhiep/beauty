<?php

namespace Elementor;

class cosmetics_plugin_elementor_widgets {

    /**
     * Plugin constructor.
     */
    public function __construct() {

        $this->cosmetics_elementor_add_actions();
    }

    function cosmetics_elementor_add_actions() {

        add_action( 'elementor/elements/categories_registered', [ $this, 'cosmetics_elementor_widget_categories' ] );

        add_action( 'elementor/widgets/widgets_registered', [ $this, 'cosmetics_elementor_widgets_registered' ] );

        add_action( 'elementor/frontend/after_enqueue_styles', [$this, 'cosmetics_elementor_script'] );

    }

    function cosmetics_elementor_widget_categories() {

        Plugin::instance()->elements_manager->add_category(
            'cosmetics_widgets',
            [
                'title' => esc_html__( 'Cosmetics theme Widgets', 'cosmetics' ),
                'icon'  => 'icon-goes-here'
            ]
        );

    }

    function cosmetics_elementor_widgets_registered() {
        foreach(glob( get_parent_theme_file_path( '/extension/elementor/widgets/*.php' ) ) as $file){
            require $file;
        }
    }

    function cosmetics_elementor_script() {

        $products_filter_admin_url  =   admin_url('admin-ajax.php');
        $products_filter_get        =   array( 'url' => $products_filter_admin_url );
        wp_localize_script( 'products_filter', 'cosmetics_products_filter_load', $products_filter_get );
        wp_register_script( 'products_filter', get_theme_file_uri( '/js/product-filter.js' ), array(), '', true );

        wp_register_script( 'cosmetics-elementor-custom', get_theme_file_uri( '/js/elementor-custom.js' ), array(), '1.0.0', true );
    }

}

new cosmetics_plugin_elementor_widgets();


/* Start get Category check box */
function cosmetics_check_get_cat( $type_taxonomy ) {

    $cat_check    =   array();
    $category     =   get_terms(
        array(
            'taxonomy'      =>  $type_taxonomy,
            'hide_empty'    =>  false
        )
    );

    if ( isset( $category ) && !empty( $category ) ):

        foreach( $category as $item ) {

            $cat_check[$item->term_id]  =   $item->name;

        }

    endif;

    return $cat_check;

}
/* End get Category check box */

/* Start get tag check box */
function cosmetics_check_get_tag( $type_taxonomy ) {

    $tag_check  =   array();
    $tag        =   get_terms(
        array(
            'taxonomy'      =>  $type_taxonomy,
            'hide_empty'    =>  false
        )
    );

    if ( isset( $tag ) && !empty( $tag ) ):

        foreach( $tag as $item ) {

            $tag_check[$item->term_id]  =   $item->name;

        }

    endif;

    return $tag_check;

}
/* End get Category check box */