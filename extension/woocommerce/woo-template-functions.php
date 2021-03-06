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

/* Start get cart */
if ( ! function_exists( 'cosmetics_get_cart' ) ):

    function cosmetics_get_cart(){

    ?>

        <p class="cart-customlocation" title="<?php esc_html_e('View your shopping cart', 'cosmetics'); ?>">
            <i class="fas fa-shopping-cart"></i>

            <span class="text-cart">
                <?php esc_html_e( 'Giỏ hàng', 'cosmetics' ); ?>
            </span>

            <span class="number-cart-product">
                <?php echo sprintf ( _n( '%d', '%d', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?>
            </span>
        </p>

    <?php
    }

endif;

/* To ajaxify your cart viewer */
add_filter( 'woocommerce_add_to_cart_fragments', 'cosmetics_add_to_cart_fragment' );

if ( ! function_exists( 'cosmetics_add_to_cart_fragment' ) ) :

    function cosmetics_add_to_cart_fragment( $cosmetics_fragments ) {

        ob_start();

        do_action( 'cosmetics_get_cart_item' );

        $cosmetics_fragments['p.cart-customlocation'] = ob_get_clean();

        return $cosmetics_fragments;

    }

endif;
/* End get cart */

/* Start Sidebar Shop */
if ( ! function_exists( 'cosmetics_woo_get_sidebar' ) ) :

    function cosmetics_woo_get_sidebar() {

        if ( !is_product() ) :
            $cosmetics_sidebar_shop = 'cosmetics-sidebar-wc';
        else:
            $cosmetics_sidebar_shop = 'cosmetics-sidebar-single-wc';
        endif;

        if( is_active_sidebar( $cosmetics_sidebar_shop ) ):
    ?>

            <aside class="<?php echo esc_attr( cosmetics_col_sidebar() ); ?> site-sidebar">
                <?php dynamic_sidebar( $cosmetics_sidebar_shop); ?>
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

        if ( !is_product() ) :
            $cosmetics_sidebar_woo_position = $cosmetics_options['cosmetics_sidebar_woo'];
        else:
            $cosmetics_sidebar_woo_position = $cosmetics_options['cosmetics_sidebar_single_product'];
        endif;

    ?>

        <div class="site-shop">
            <div class="container">
                <?php do_action( 'cosmetics_woo_breadcrumb' ); ?>

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

                    <div class="<?php echo is_active_sidebar( 'cosmetics-sidebar-wc' ) && $cosmetics_sidebar_woo_position != 'hide' ? 'col-12 col-md-8 col-lg-9' : 'col-md-12'; ?>">

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

        if ( !is_product() ) :
            $cosmetics_sidebar_woo_position = $cosmetics_options['cosmetics_sidebar_woo'];
        else:
            $cosmetics_sidebar_woo_position = $cosmetics_options['cosmetics_sidebar_single_product'];
        endif;

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
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
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
            </a>
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

if ( ! function_exists( 'cosmetics_woo_loop_add_to_cart' ) ) :
    /**
     * Hook: woocommerce_after_shop_loop_item.
     *
     * @hooked cosmetics_woo_loop_add_to_cart - 4
     */

    function cosmetics_woo_loop_add_to_cart() {
    ?>
        <div class="site-shop__product-add-to-cart d-flex align-items-center justify-content-center">
            <?php woocommerce_template_loop_add_to_cart(); ?>
        </div>
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

if ( !  function_exists( 'cosmetics_brand_product' ) ) :

    /**
     * woocommerce_single_product_summary hook.
     *
     * @hooked cosmetics_brand_product - 15
     */

    function cosmetics_brand_product() {

        $cosmetics_product_brand = get_the_terms( get_the_ID(), 'brand_cat' );

        if ( !empty( $cosmetics_product_brand ) ) :
    ?>

        <div class="product-brand d-flex">
            <span class="product-brand__name">
                <?php esc_html_e( 'Thương hiệu:' ); ?>
            </span>

            <div class="product-brand__list">
                <?php foreach ( $cosmetics_product_brand as $item ) : ?>
                    <a href="<?php echo esc_url( get_term_link( $item->term_id, 'brand_cat' ) ); ?>">
                        <?php echo esc_html(  $item->name ); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>

    <?php
        endif;
    }

endif;

if ( ! function_exists( 'cosmetics_upsell_products' ) ) :

    /**
     * woocommerce_after_single_product_summary hook.
     *
     * @hooked cosmetics_upsell_products - 15
     */

    function cosmetics_upsell_products() {

        $cosmetics_product_upsell_ids = get_post_meta( get_the_ID(), '_upsell_ids', true );

        if ( !empty( $cosmetics_product_upsell_ids ) ) :

            $cosmetics_product_upsell_arg = array(
                'post_type'         =>  'product',
                'post__in'          =>  $cosmetics_product_upsell_ids,
                'post__not_in'      =>  array( get_the_ID() ),
                'posts_per_page'    =>  -1,
                'orderby'           =>  'ID',
                'order'             =>  'DESC',
            );

            $cosmetics_product_upsell_query = new WP_Query( $cosmetics_product_upsell_arg );

            $settings_data     =   [
                'margin_item'   =>  30,
                'margin_item_mobile' => 15,
                'number_item'   =>  4,
                'item_tablet_2' =>  3,
                'item_tablet'   =>  2,
                'item_mobile'   =>  2,
                'nav'           =>  true,
            ];

    ?>

        <div class="up-sells upsells products">
            <p class="title">
                <?php esc_html_e( 'Sản phẩm cùng xem', 'cosmetics' ); ?>
            </p>

            <div class="related-product-slider element-product-style owl-carousel owl-theme" data-settings='<?php echo esc_attr( wp_json_encode( $settings_data ) ); ?>'>
                <?php
                while ( $cosmetics_product_upsell_query->have_posts() ) :
                    $cosmetics_product_upsell_query->the_post();

                    cosmetics_product_slides();

                endwhile;
                wp_reset_postdata();
                ?>
            </div>
        </div>

    <?php

        endif;


    }

endif;

if ( ! function_exists( 'cosmetics_crosssell_products' ) ) :

    /**
     * woocommerce_after_single_product_summary hook.
     *
     * @hooked cosmetics_crosssell_products - 18
     */

    function cosmetics_crosssell_products() {

        $cosmetics_product_crosssell_ids = get_post_meta( get_the_ID(), '_crosssell_ids', true );

        if ( !empty( $cosmetics_product_crosssell_ids ) ) :

            $cosmetics_product_crosssell_arg = array(
                'post_type'         =>  'product',
                'post__in'          =>  $cosmetics_product_crosssell_ids,
                'post__not_in'      =>  array( get_the_ID() ),
                'posts_per_page'    =>  -1,
                'orderby'           =>  'ID',
                'order'             =>  'DESC',
            );

            $cosmetics_product_crosssell_query = new WP_Query( $cosmetics_product_crosssell_arg );

            $settings_data     =   [
                'margin_item'   =>  30,
                'margin_item_mobile' => 15,
                'number_item'   =>  4,
                'item_tablet_2' =>  3,
                'item_tablet'   =>  2,
                'item_mobile'   =>  2,
                'nav'           =>  true,
            ];

    ?>

            <div class="cross-sells products">
                <p class="title">
                    <?php esc_html_e( 'Sản phẩm mua cùng', 'cosmetics' ); ?>
                </p>

                <div class="related-product-slider element-product-style owl-carousel owl-theme" data-settings='<?php echo esc_attr( wp_json_encode( $settings_data ) ); ?>'>
                    <?php
                    while ( $cosmetics_product_crosssell_query->have_posts() ) :
                        $cosmetics_product_crosssell_query->the_post();

                        cosmetics_product_slides();

                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>

    <?php

        endif;

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
                    'margin_item_mobile' => 15,
                    'number_item'   =>  4,
                    'item_tablet_2' =>  3,
                    'item_tablet'   =>  2,
                    'item_mobile'   =>  2,
                    'nav'           =>  true,
                ];

    ?>

            <div class="related products">

                <p class="title">
                    <?php esc_html_e( 'Sản phẩm cùng loại', 'cosmetics' ); ?>
                </p>

                <div class="related-product-slider element-product-style owl-carousel owl-theme" data-settings='<?php echo esc_attr( wp_json_encode( $settings_data ) ); ?>'>
                    <?php
                    while ( $cosmetics_product_related_query->have_posts() ) :
                        $cosmetics_product_related_query->the_post();

                        cosmetics_product_slides();

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

/* Start Product Slides */
function cosmetics_product_slides() {

?>

    <div class="item-product">
        <div class="item-thumbnail">
            <?php

            do_action( 'woo_elementor_product_sale_flash' );

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

}
/* End Product Slides */

/* Start Sale percentage */
add_filter('woocommerce_sale_flash', 'cosmetics_custom_sale_flash');
function cosmetics_custom_sale_flash() {

    $regular_price_product  =   get_post_meta( get_the_ID(), '_regular_price', true );
    $sale_price_product     =   get_post_meta( get_the_ID(), '_sale_price', true );

    $percentage = round( ( ( $regular_price_product - $sale_price_product ) / $regular_price_product ) * 100 );

    return '<span class="onsale">-'.$percentage.'%</span>';
}
/* End Sale percentage */

/**
 * Change title tab
 */
add_filter( 'woocommerce_product_description_heading', 'cosmetics_change_text_product_description_heading' );
add_filter( 'woocommerce_product_additional_information_heading', 'cosmetics_change_text_product_description_heading' );
function cosmetics_change_text_product_description_heading() {
    return '';
}

/**
 * Rename product data tabs
 */
add_filter( 'woocommerce_product_tabs', 'woo_rename_tabs', 98 );
function woo_rename_tabs( $tabs ) {

    // Rename the description tab
    $tabs['description']['title'] = esc_html__( 'Chi tiết sản phẩm' );
    // Remove the reviews tab
    unset( $tabs['reviews'] );

    return $tabs;

}

function cosmetics_custom_comments_template() {
?>

    <div class="site-reviews-product">
        <?php comments_template(); ?>
    </div>

<?php
}

/*
 * Recently viewed product
 * */
function custom_track_product_view() {

    if ( ! is_singular( 'product' ) ) {
        return;
    }

    global $post;

    if ( empty( $_COOKIE['woocommerce_recently_viewed'] ) ) { // @codingStandardsIgnoreLine.
        $viewed_products = array();
    } else {
        $viewed_products = wp_parse_id_list( (array) explode( '|', wp_unslash( $_COOKIE['woocommerce_recently_viewed'] ) ) ); // @codingStandardsIgnoreLine.
    }

    // Unset if already in viewed products list.
    $keys = array_flip( $viewed_products );

    if ( isset( $keys[ $post->ID ] ) ) {
        unset( $viewed_products[ $keys[ $post->ID ] ] );
    }

    $viewed_products[] = $post->ID;

    if ( count( $viewed_products ) > 15 ) {
        array_shift( $viewed_products );
    }

    // Store for session only.
    wc_setcookie( 'woocommerce_recently_viewed', implode( '|', $viewed_products ) );

}
add_action( 'template_redirect', 'custom_track_product_view', 20 );

if ( ! function_exists( 'cosmetics_recently_viewed_product' ) ) :

    function cosmetics_recently_viewed_product() {

        $viewed_products = ! empty( $_COOKIE['woocommerce_recently_viewed'] ) ? (array) explode( '|', wp_unslash( $_COOKIE['woocommerce_recently_viewed'] ) ) : array();
        $viewed_products = array_reverse( array_filter( array_map( 'absint', $viewed_products ) ) );

    ?>

        <div class="site-recently-viewed-product">
            <?php

            if ( !empty( $viewed_products ) ) :

                $recently_viewed_product_args = array(
                    'posts_per_page' => 6,
                    'no_found_rows'  => 1,
                    'post_status'    => 'publish',
                    'post_type'      => 'product',
                    'post__in'       => $viewed_products,
                    'orderby'        => 'rand',
                );

                $recently_viewed_product_query = new WP_Query( $recently_viewed_product_args );
            ?>

                <div class="row">
                    <?php
                    while ( $recently_viewed_product_query->have_posts() ) :
                        $recently_viewed_product_query->the_post();
                    ?>

                        <div class="col-md-2 item">
                            <div class="item-thumbnail">
                                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                    <?php the_post_thumbnail( 'medium_large' ); ?>
                                </a>
                            </div>
                        </div>

                    <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>

            <?php else: ?>

                <span class="none-viewed-product d-block text-center">
                    <?php esc_html_e( 'Bạn chưa xem sản phẩm nào', 'cosmetics' ); ?>
                </span>

            <?php endif; ?>
        </div>

    <?php

    }

endif;

function cosmetics_comment_facebook_product() {
?>

    <div class="fb-comments" data-href="<?php the_permalink(); ?>" data-numposts="10" data-width="100%"></div>

<?php
}

/* Comment facebook jdk */
function cosmetics_sdk_facebook() {
    if ( is_product() ) :
?>
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.2';
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>
<?php
    endif;
}
add_action( 'wp_footer', 'cosmetics_sdk_facebook' );