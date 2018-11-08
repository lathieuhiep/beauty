<?php

/**
 * General functions used to integrate this theme with WooCommerce.
 */

add_action( 'after_setup_theme', 'beauty_shop_setup' );

function beauty_shop_setup() {

    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );

}

/* Start limit product */
add_filter('loop_shop_per_page', 'beauty_show_products_per_page');

function beauty_show_products_per_page() {
    global $beauty_options;

    $beauty_product_limit = $beauty_options['beauty_product_limit'];

    return $beauty_product_limit;

}
/* End limit product */

/* Start Change number or products per row */
add_filter('loop_shop_columns', 'beauty_loop_columns_product');

function beauty_loop_columns_product() {
    global $beauty_options;

    $beauty_products_per_row = $beauty_options['beauty_products_per_row'];

    if ( !empty( $beauty_products_per_row ) ) :
        return $beauty_products_per_row;
    else:
        return 4;
    endif;

}
/* End Change number or products per row */

/* Start Sidebar Shop */
if ( ! function_exists( 'beauty_woo_get_sidebar' ) ) :

    function beauty_woo_get_sidebar() {

        if( is_active_sidebar( 'beauty-sidebar-wc' ) ):
    ?>

            <aside class="col-md-3">
                <?php dynamic_sidebar( 'beauty-sidebar-wc' ); ?>
            </aside>

    <?php
        endif;
    }

endif;
/* End Sidebar Shop */

/*
* Lay Out Shop
*/

if ( ! function_exists( 'beauty_woo_before_main_content' ) ) :
    /**
     * Before Content
     * Wraps all WooCommerce content in wrappers which match the theme markup
     */
    function beauty_woo_before_main_content() {
        global $beauty_options;
        $beauty_sidebar_woo_position = $beauty_options['beauty_sidebar_woo'];

    ?>

        <div class="site-shop">
            <div class="container">
                <div class="row">

                <?php
                /**
                 * woocommerce_sidebar hook.
                 *
                 * @hooked beauty_woo_sidebar - 10
                 */
        
                if ( $beauty_sidebar_woo_position == 'left' ) :
                    do_action( 'beauty_woo_sidebar' );
                endif;
                ?>

                    <div class="<?php echo is_active_sidebar( 'beauty-sidebar-wc' ) && $beauty_sidebar_woo_position != 'hide' ? 'col-md-9' : 'col-md-12'; ?>">

    <?php

    }

endif;

if ( ! function_exists( 'beauty_woo_after_main_content' ) ) :
    /**
     * After Content
     * Closes the wrapping divs
     */
    function beauty_woo_after_main_content() {
        global $beauty_options;
        $beauty_sidebar_woo_position = $beauty_options['beauty_sidebar_woo'];
    ?>

                    </div><!-- .col-md-9 -->

                    <?php
                    /**
                     * woocommerce_sidebar hook.
                     *
                     * @hooked beauty_woo_sidebar - 10
                     */

                    if ( $beauty_sidebar_woo_position == 'right' ) :
                        do_action( 'beauty_woo_sidebar' );
                    endif;
                    ?>

                </div><!-- .row -->
            </div><!-- .container -->
        </div><!-- .site-shop -->

    <?php

    }

endif;

if ( ! function_exists( 'beauty_woo_product_thumbnail_open' ) ) :
    /**
     * Hook: woocommerce_before_shop_loop_item_title.
     *
     * @hooked beauty_woo_product_thumbnail_open - 5
     */

    function beauty_woo_product_thumbnail_open() {
    ?>
        <div class="site-shop__product--item-image">
    <?php
    }

endif;

if ( ! function_exists( 'beauty_woo_product_thumbnail_close' ) ) :
    /**
     * Hook: woocommerce_before_shop_loop_item_title.
     *
     * @hooked beauty_woo_product_thumbnail_close - 15
     */

    function beauty_woo_product_thumbnail_close() {
    ?>
        </div><!-- .site-shop__product--item-image -->

        <div class="site-shop__product--item-content">
    <?php
    }

endif;

if ( ! function_exists( 'beauty_woo_get_product_title' ) ) :
    /**
     * Hook: woocommerce_shop_loop_item_title.
     *
     * @hooked beauty_woo_get_product_title - 10
     */

    function beauty_woo_get_product_title() {
    ?>
        <h2 class="woocommerce-loop-product__title">
            <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
                <?php the_title(); ?>
            </a>
        </h2>
    <?php
    }
endif;

if ( ! function_exists( 'beauty_woo_after_shop_loop_item_title' ) ) :
    /**
     * Hook: woocommerce_after_shop_loop_item_title.
     *
     * @hooked beauty_woo_after_shop_loop_item_title - 15
     */
    function beauty_woo_after_shop_loop_item_title() {
    ?>
        </div><!-- .site-shop__product--item-content -->
    <?php
    }
endif;

if ( ! function_exists( 'beauty_woo_loop_add_to_cart_open' ) ) :
    /**
     * Hook: woocommerce_after_shop_loop_item.
     *
     * @hooked beauty_woo_loop_add_to_cart_open - 4
     */

    function beauty_woo_loop_add_to_cart_open() {
    ?>
        <div class="site-shop__product-add-to-cart">
    <?php
    }

endif;

if ( ! function_exists( 'beauty_woo_loop_add_to_cart_close' ) ) :
    /**
     * Hook: woocommerce_after_shop_loop_item.
     *
     * @hooked beauty_woo_loop_add_to_cart_close - 12
     */

    function beauty_woo_loop_add_to_cart_close() {
    ?>
        </div><!-- .site-shop__product-add-to-cart -->
    <?php
    }

endif;

if ( ! function_exists( 'beauty_woo_before_shop_loop_item' ) ) :
    /**
     * Hook: woocommerce_before_shop_loop_item.
     *
     * @hooked beauty_woo_before_shop_loop_item - 5
     */
    function beauty_woo_before_shop_loop_item() {
    ?>

        <div class="site-shop__product--item">

    <?php
    }
endif;

if ( ! function_exists( 'beauty_woo_after_shop_loop_item' ) ) :
    /**
     * Hook: woocommerce_after_shop_loop_item.
     *
     * @hooked beauty_woo_after_shop_loop_item - 15
     */
    function beauty_woo_after_shop_loop_item() {
    ?>

        </div><!-- .site-shop__product--item -->

    <?php
    }
endif;

if ( ! function_exists( 'beauty_woo_before_shop_loop_open' ) ) :
    /**
     * Before Shop Loop
     * woocommerce_before_shop_loop hook.
     *
     * @hooked beauty_woo_before_shop_loop_open - 5
     */
    function beauty_woo_before_shop_loop_open() {

    ?>

        <div class="site-shop__result-count-ordering d-flex align-items-center justify-content-between">

    <?php
    }

endif;

if ( ! function_exists( 'beauty_woo_before_shop_loop_close' ) ) :
    /**
     * Before Shop Loop
     * woocommerce_before_shop_loop hook.
     *
     * @hooked beauty_woo_before_shop_loop_close - 35
     */
    function beauty_woo_before_shop_loop_close() {

    ?>

        </div><!-- .site-shop__result-count-ordering -->

    <?php
    }

endif;

/*
* Single Shop
*/

if ( ! function_exists( 'beauty_woo_before_single_product' ) ) :

    /**
     * Before Content Single  product
     *
     * woocommerce_before_single_product hook.
     *
     * @hooked beauty_woo_before_single_product - 5
     */

    function beauty_woo_before_single_product() {

    ?>

        <div class="site-shop-single">

    <?php

    }

endif;

if ( ! function_exists( 'beauty_woo_after_single_product' ) ) :

    /**
     * After Content Single  product
     *
     * woocommerce_after_single_product hook.
     *
     * @hooked beauty_woo_after_single_product - 30
     */

    function beauty_woo_after_single_product() {

    ?>

        </div><!-- .site-shop-single -->

    <?php

    }

endif;

if ( !function_exists( 'beauty_woo_before_single_product_summary_open_warp' ) ) :

    /**
     * Before single product summary
     * woocommerce_before_single_product_summary hook.
     *
     * @hooked beauty_woo_before_single_product_summary_open_warp - 1
     */

    function beauty_woo_before_single_product_summary_open_warp() {

    ?>

        <div class="site-shop-single__warp">

    <?php

    }

endif;

if ( !function_exists( 'beauty_woo_after_single_product_summary_close_warp' ) ) :

    /**
     * After single product summary
     * woocommerce_after_single_product_summary hook.
     *
     * @hooked beauty_woo_after_single_product_summary_close_warp - 5
     */

    function beauty_woo_after_single_product_summary_close_warp() {

    ?>

        </div><!-- .site-shop-single__warp -->

    <?php

    }

endif;

if ( ! function_exists( 'beauty_woo_before_single_product_summary_open' ) ) :

    /**
     * woocommerce_before_single_product_summary hook.
     *
     * @hooked beauty_woo_before_single_product_summary_open - 5
     */

    function beauty_woo_before_single_product_summary_open() {

    ?>

        <div class="site-shop-single__gallery-box">

    <?php

    }

endif;

if ( ! function_exists( 'beauty_woo_before_single_product_summary_close' ) ) :

    /**
     * woocommerce_before_single_product_summary hook.
     *
     * @hooked beauty_woo_before_single_product_summary_close - 30
     */

    function beauty_woo_before_single_product_summary_close() {

    ?>

        </div><!-- .site-shop-single__gallery-box -->

    <?php

    }

endif;