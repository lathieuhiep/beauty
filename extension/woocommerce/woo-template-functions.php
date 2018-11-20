<?php

/**
 * General functions used to integrate this theme with WooCommerce.
 */

add_action( 'after_setup_theme', 'cosmetics_shop_setup' );

function cosmetics_shop_setup() {

    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );

}

/* Start limit product */
add_filter('loop_shop_per_page', 'cosmetics_show_products_per_page');

function cosmetics_show_products_per_page() {
    global $cosmetics_options;

    $cosmetics_product_limit = $cosmetics_options['cosmetics_product_limit'];

    return $cosmetics_product_limit;

}
/* End limit product */

/* Start Change number or products per row */
add_filter('loop_shop_columns', 'cosmetics_loop_columns_product');

function cosmetics_loop_columns_product() {
    global $cosmetics_options;

    $cosmetics_products_per_row = $cosmetics_options['cosmetics_products_per_row'];

    if ( !empty( $cosmetics_products_per_row ) ) :
        return $cosmetics_products_per_row;
    else:
        return 4;
    endif;

}
/* End Change number or products per row */

/* Start Sidebar Shop */
if ( ! function_exists( 'cosmetics_woo_get_sidebar' ) ) :

    function cosmetics_woo_get_sidebar() {

        if( is_active_sidebar( 'cosmetics-sidebar-wc' ) ):
    ?>

            <aside class="col-md-3">
                <?php dynamic_sidebar( 'cosmetics-sidebar-wc' ); ?>
            </aside>

    <?php
        endif;
    }

endif;
/* End Sidebar Shop */

/*
* Lay Out Shop
*/

if ( ! function_exists( 'cosmetics_woo_before_main_content' ) ) :
    /**
     * Before Content
     * Wraps all WooCommerce content in wrappers which match the theme markup
     */
    function cosmetics_woo_before_main_content() {
        global $cosmetics_options;
        $cosmetics_sidebar_woo_position = $cosmetics_options['cosmetics_sidebar_woo'];

    ?>

        <div class="site-shop">
            <div class="container">
                <div class="row">

                <?php
                /**
                 * woocommerce_sidebar hook.
                 *
                 * @hooked cosmetics_woo_sidebar - 10
                 */
        
                if ( $cosmetics_sidebar_woo_position == 'left' ) :
                    do_action( 'cosmetics_woo_sidebar' );
                endif;
                ?>

                    <div class="<?php echo is_active_sidebar( 'cosmetics-sidebar-wc' ) && $cosmetics_sidebar_woo_position != 'hide' ? 'col-md-9' : 'col-md-12'; ?>">

    <?php

    }

endif;

if ( ! function_exists( 'cosmetics_woo_after_main_content' ) ) :
    /**
     * After Content
     * Closes the wrapping divs
     */
    function cosmetics_woo_after_main_content() {
        global $cosmetics_options;
        $cosmetics_sidebar_woo_position = $cosmetics_options['cosmetics_sidebar_woo'];
    ?>

                    </div><!-- .col-md-9 -->

                    <?php
                    /**
                     * woocommerce_sidebar hook.
                     *
                     * @hooked cosmetics_woo_sidebar - 10
                     */

                    if ( $cosmetics_sidebar_woo_position == 'right' ) :
                        do_action( 'cosmetics_woo_sidebar' );
                    endif;
                    ?>

                </div><!-- .row -->
            </div><!-- .container -->
        </div><!-- .site-shop -->

    <?php

    }

endif;

if ( ! function_exists( 'cosmetics_woo_product_thumbnail_open' ) ) :
    /**
     * Hook: woocommerce_before_shop_loop_item_title.
     *
     * @hooked cosmetics_woo_product_thumbnail_open - 5
     */

    function cosmetics_woo_product_thumbnail_open() {
    ?>
        <div class="site-shop__product--item-image">
    <?php
    }

endif;

if ( ! function_exists( 'cosmetics_woo_product_thumbnail_close' ) ) :
    /**
     * Hook: woocommerce_before_shop_loop_item_title.
     *
     * @hooked cosmetics_woo_product_thumbnail_close - 15
     */

    function cosmetics_woo_product_thumbnail_close() {
    ?>
        </div><!-- .site-shop__product--item-image -->

        <div class="site-shop__product--item-content">
    <?php
    }

endif;

if ( ! function_exists( 'cosmetics_woo_get_product_title' ) ) :
    /**
     * Hook: woocommerce_shop_loop_item_title.
     *
     * @hooked cosmetics_woo_get_product_title - 10
     */

    function cosmetics_woo_get_product_title() {
    ?>
        <h2 class="woocommerce-loop-product__title">
            <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
                <?php the_title(); ?>
            </a>
        </h2>
    <?php
    }
endif;

if ( ! function_exists( 'cosmetics_woo_after_shop_loop_item_title' ) ) :
    /**
     * Hook: woocommerce_after_shop_loop_item_title.
     *
     * @hooked cosmetics_woo_after_shop_loop_item_title - 15
     */
    function cosmetics_woo_after_shop_loop_item_title() {
    ?>
        </div><!-- .site-shop__product--item-content -->
    <?php
    }
endif;

if ( ! function_exists( 'cosmetics_woo_loop_add_to_cart_open' ) ) :
    /**
     * Hook: woocommerce_after_shop_loop_item.
     *
     * @hooked cosmetics_woo_loop_add_to_cart_open - 4
     */

    function cosmetics_woo_loop_add_to_cart_open() {
    ?>
        <div class="site-shop__product-add-to-cart">
    <?php
    }

endif;

if ( ! function_exists( 'cosmetics_woo_loop_add_to_cart_close' ) ) :
    /**
     * Hook: woocommerce_after_shop_loop_item.
     *
     * @hooked cosmetics_woo_loop_add_to_cart_close - 12
     */

    function cosmetics_woo_loop_add_to_cart_close() {
    ?>
        </div><!-- .site-shop__product-add-to-cart -->
    <?php
    }

endif;

if ( ! function_exists( 'cosmetics_woo_before_shop_loop_item' ) ) :
    /**
     * Hook: woocommerce_before_shop_loop_item.
     *
     * @hooked cosmetics_woo_before_shop_loop_item - 5
     */
    function cosmetics_woo_before_shop_loop_item() {
    ?>

        <div class="site-shop__product--item">

    <?php
    }
endif;

if ( ! function_exists( 'cosmetics_woo_after_shop_loop_item' ) ) :
    /**
     * Hook: woocommerce_after_shop_loop_item.
     *
     * @hooked cosmetics_woo_after_shop_loop_item - 15
     */
    function cosmetics_woo_after_shop_loop_item() {
    ?>

        </div><!-- .site-shop__product--item -->

    <?php
    }
endif;

if ( ! function_exists( 'cosmetics_woo_before_shop_loop_open' ) ) :
    /**
     * Before Shop Loop
     * woocommerce_before_shop_loop hook.
     *
     * @hooked cosmetics_woo_before_shop_loop_open - 5
     */
    function cosmetics_woo_before_shop_loop_open() {

    ?>

        <div class="site-shop__result-count-ordering d-flex align-items-center">

    <?php
    }

endif;

if ( ! function_exists( 'cosmetics_woo_before_shop_loop_close' ) ) :
    /**
     * Before Shop Loop
     * woocommerce_before_shop_loop hook.
     *
     * @hooked cosmetics_woo_before_shop_loop_close - 35
     */
    function cosmetics_woo_before_shop_loop_close() {

    ?>

        </div><!-- .site-shop__result-count-ordering -->

    <?php
    }

endif;

/*
* Single Shop
*/

if ( ! function_exists( 'cosmetics_woo_before_single_product' ) ) :

    /**
     * Before Content Single  product
     *
     * woocommerce_before_single_product hook.
     *
     * @hooked cosmetics_woo_before_single_product - 5
     */

    function cosmetics_woo_before_single_product() {

    ?>

        <div class="site-shop-single">

    <?php

    }

endif;

if ( ! function_exists( 'cosmetics_woo_after_single_product' ) ) :

    /**
     * After Content Single  product
     *
     * woocommerce_after_single_product hook.
     *
     * @hooked cosmetics_woo_after_single_product - 30
     */

    function cosmetics_woo_after_single_product() {

    ?>

        </div><!-- .site-shop-single -->

    <?php

    }

endif;

if ( !function_exists( 'cosmetics_woo_before_single_product_summary_open_warp' ) ) :

    /**
     * Before single product summary
     * woocommerce_before_single_product_summary hook.
     *
     * @hooked cosmetics_woo_before_single_product_summary_open_warp - 1
     */

    function cosmetics_woo_before_single_product_summary_open_warp() {

    ?>

        <div class="site-shop-single__warp">

    <?php

    }

endif;

if ( !function_exists( 'cosmetics_woo_after_single_product_summary_close_warp' ) ) :

    /**
     * After single product summary
     * woocommerce_after_single_product_summary hook.
     *
     * @hooked cosmetics_woo_after_single_product_summary_close_warp - 5
     */

    function cosmetics_woo_after_single_product_summary_close_warp() {

    ?>

        </div><!-- .site-shop-single__warp -->

    <?php

    }

endif;

if ( ! function_exists( 'cosmetics_woo_before_single_product_summary_open' ) ) :

    /**
     * woocommerce_before_single_product_summary hook.
     *
     * @hooked cosmetics_woo_before_single_product_summary_open - 5
     */

    function cosmetics_woo_before_single_product_summary_open() {

    ?>

        <div class="site-shop-single__gallery-box">

    <?php

    }

endif;

if ( ! function_exists( 'cosmetics_woo_before_single_product_summary_close' ) ) :

    /**
     * woocommerce_before_single_product_summary hook.
     *
     * @hooked cosmetics_woo_before_single_product_summary_close - 30
     */

    function cosmetics_woo_before_single_product_summary_close() {

    ?>

        </div><!-- .site-shop-single__gallery-box -->

    <?php

    }

endif;

if ( ! function_exists( 'cosmetics_related_products' ) ) :

    /**
     * woocommerce_after_single_product_summary hook.
     *
     * @hooked cosmetics_related_products - 30
     */

    function cosmetics_related_products() {

        $cosmetics_product_cat = get_the_terms( get_the_ID(), 'product_cat' );

        if ( !empty( $cosmetics_product_cat ) ) :

            $cosmetics_product_cat_ids = array();

            foreach( $cosmetics_product_cat as $item_product_cat_id ) $cosmetics_product_cat_ids[] = $item_product_cat_id->term_id;

            $cosmetics_product_related_arg = array(
                'post_type'         =>  'product',
                'post__not_in'      =>  array( get_the_ID() ),
                'orderby'           =>  'rand',
                'posts_per_page'    =>  6,
                'tax_query'         =>  array(
                    array(
                        'taxonomy'  =>  'product_cat',
                        'field'     =>  'id',
                        'terms'     =>  $cosmetics_product_cat_ids
                    ),
                )
            );

            $cosmetics_product_related_query = new WP_Query( $cosmetics_product_related_arg );

            if ( $cosmetics_product_related_query->have_posts() ) :

                $settings_data     =   [
                    'margin_item'   =>  30,
                    'number_item'   =>  4,
                    'item_tablet'   =>  2,
                    'item_mobile'   =>  1,
                    'nav'           =>  true,
                ];

    ?>

            <div class="related products">

                <h2 class="title">
                    <?php esc_html_e( 'Sản phẩm cùng loại', 'cosmetics' ); ?>
                </h2>

                <div class="related-product-slider element-product-style owl-carousel owl-theme" data-settings='<?php echo esc_attr( wp_json_encode( $settings_data ) ); ?>'>
                    <?php
                    while ( $cosmetics_product_related_query->have_posts() ) :
                        $cosmetics_product_related_query->the_post();
                    ?>

                        <div class="item-product">
                            <div class="item-thumbnail">
                                <?php
                                if ( has_post_thumbnail() ) :
                                    the_post_thumbnail( 'large' );
                                else:
                                ?>
                                    <img src="<?php echo esc_url( get_theme_file_uri( '/images/no-image.png' ) ); ?>" alt="<?php the_title(); ?>">
                                <?php endif; ?>

                                <div class="item-add-cart">
                                    <?php do_action( 'woo_elementor_add_to_cart' ); ?>
                                </div>
                            </div>

                            <div class="item-detail">
                                <h2 class="item-title">
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h2>

                                <?php woocommerce_template_loop_price(); ?>
                            </div>
                        </div>

                    <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>

    <?php

            endif;

        endif;

    }

endif;