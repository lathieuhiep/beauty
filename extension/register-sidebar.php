<?php
/**
 * Register Sidebar
 */
add_action( 'widgets_init', 'cosmetics_widgets_init');

function cosmetics_widgets_init() {

    register_sidebar( array(
        'name'          =>  esc_html__( 'Sidebar Main', 'cosmetics' ),
        'id'            =>  'cosmetics-sidebar-main',
        'description'   =>  esc_html__( 'Display sidebar right or left on all page.', 'cosmetics' ),
        'before_widget' =>  '<section id="%1$s" class="widget %2$s">',
        'after_widget'  =>  '</section>',
        'before_title'  =>  '<h2 class="widget-title">',
        'after_title'   =>  '</h2>'
    ));

    register_sidebar( array(
        'name'          =>  esc_html__( 'Sidebar Woocommerce', 'cosmetics' ),
        'id'            =>  'cosmetics-sidebar-wc',
        'description'   =>  esc_html__( 'Display sidebar on page shop.', 'cosmetics' ),
        'before_widget' =>  '<section id="%1$s" class="widget %2$s">',
        'after_widget'  =>  '</section>',
        'before_title'  =>  '<h2 class="widget-title">',
        'after_title'   =>  '</h2>'
    ));

    register_sidebar( array(
        'name'          =>  esc_html__( 'Sidebar Single Woocommerce', 'cosmetics' ),
        'id'            =>  'cosmetics-sidebar-single-wc',
        'description'   =>  esc_html__( 'Display sidebar on page shop single.', 'cosmetics' ),
        'before_widget' =>  '<section id="%1$s" class="widget %2$s">',
        'after_widget'  =>  '</section>',
        'before_title'  =>  '<h2 class="widget-title">',
        'after_title'   =>  '</h2>'
    ));

    register_sidebar( array(
        'name'          =>  esc_html__( 'Sidebar Footer Multi Column 1-1', 'cosmetics' ),
        'id'            =>  'cosmetics-sidebar-footer-multi-column-1-1',
        'description'   =>  esc_html__( 'Display footer column 1 on all page.', 'cosmetics' ),
        'before_widget' =>  '<section id="%1$s" class="widget %2$s">',
        'after_widget'  =>  '</section>',
        'before_title'  =>  '<p class="widget-title">',
        'after_title'   =>  '</p>'
    ));

    register_sidebar( array(
        'name'          =>  esc_html__( 'Sidebar Footer Multi Column 1-2', 'cosmetics' ),
        'id'            =>  'cosmetics-sidebar-footer-multi-column-1-2',
        'description'   =>  esc_html__( 'Display footer column 2 on all page.', 'cosmetics' ),
        'before_widget' =>  '<section id="%1$s" class="widget %2$s">',
        'after_widget'  =>  '</section>',
        'before_title'  =>  '<p class="widget-title">',
        'after_title'   =>  '</p>'
    ));

    register_sidebar( array(
        'name'          =>  esc_html__( 'Sidebar Footer Multi Column 1-3', 'cosmetics' ),
        'id'            =>  'cosmetics-sidebar-footer-multi-column-1-3',
        'description'   =>  esc_html__( 'Display footer column 3 on all page.', 'cosmetics' ),
        'before_widget' =>  '<section id="%1$s" class="widget %2$s">',
        'after_widget'  =>  '</section>',
        'before_title'  =>  '<p class="widget-title">',
        'after_title'   =>  '</p>'
    ));

    register_sidebar( array(
        'name'          =>  esc_html__( 'Sidebar Footer Multi Column 1-4', 'cosmetics' ),
        'id'            =>  'cosmetics-sidebar-footer-multi-column-1-4',
        'description'   =>  esc_html__( 'Display footer column 4 on all page.', 'cosmetics' ),
        'before_widget' =>  '<section id="%1$s" class="widget %2$s">',
        'after_widget'  =>  '</section>',
        'before_title'  =>  '<p class="widget-title">',
        'after_title'   =>  '</p>'
    ));

}