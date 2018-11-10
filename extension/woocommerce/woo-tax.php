<?php

/**
 * General taxonomy used to integrate this theme with WooCommerce.
 */

/* Start taxonomy brand */

add_action( 'init', 'cosmetics_register_taxonomy_product' );

function cosmetics_register_taxonomy_product() {

    $taxonomy_labels = array(

        'name'              => _x( 'Thương hiệu sản phẩm', 'taxonomy general name', 'cosmetics' ),
        'singular_name'     => _x( 'Brands category', 'taxonomy singular name', 'cosmetics' ),
        'search_items'      => __( 'Search template category', 'cosmetics' ),
        'all_items'         => __( 'Tất cả danh mục', 'cosmetics' ),
        'parent_item'       => __( 'Parent category', 'cosmetics' ),
        'parent_item_colon' => __( 'Parent category:', 'cosmetics' ),
        'edit_item'         => __( 'Edit category', 'cosmetics' ),
        'update_item'       => __( 'Update category', 'cosmetics' ),
        'add_new_item'      => __( 'Thêm thương hiệu mới', 'cosmetics' ),
        'new_item_name'     => __( 'New category Name', 'cosmetics' ),
        'menu_name'         => __( 'Thương hiệu', 'cosmetics' ),

    );

    $taxonomy_args = array(

        'labels'            => $taxonomy_labels,
        'hierarchical'      => true,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'thuong-hieu' ),

    );

    register_taxonomy( 'brand_cat', array( 'product' ), $taxonomy_args );

}


/* End taxonomy tour */
