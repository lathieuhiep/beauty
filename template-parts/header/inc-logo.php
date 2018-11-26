<?php
global $cosmetics_options;

$cosmetics_logo_image_id    =   $cosmetics_options['cosmetics_logo_image']['id'];
?>

<div class="header-logo">
    <div class="container">
        <div class="header-logo__warp d-flex align-items-center">
            <div class="site-logo item">
                <a href="<?php echo esc_url( get_home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?>">
                    <?php
                    if ( !empty( $cosmetics_logo_image_id ) ) :
                        echo wp_get_attachment_image( $cosmetics_logo_image_id, 'full' );
                    else :
                        echo'<img class="logo-default" src="'.esc_url( get_theme_file_uri( '/images/logo.png' ) ).'" alt="'.get_bloginfo('title').'" />';
                    endif;
                    ?>
                </a>

                <button class="navbar-toggler" data-toggle="collapse" data-target=".site-menu">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                </button>
            </div>

            <div class="search-warp item">
                <?php get_search_form(); ?>
            </div>

            <?php if ( class_exists('Woocommerce') ) : ?>

                <div class="site-shop-cart item">
                    <div class="cart-view d-flex justify-content-end">
                        <div class="tz-shop-cart">
                            <?php
                            /**
                             * maniva_meetup_get_cart_item hook.
                             *
                             * @hooked maniva_meetup_get_cart - 10
                             */
                            do_action( 'cosmetics_get_cart_item' );

                            ?>
                        </div>

                        <div class="cart-widget-side">
                            <div class="widget-heading">
                                <h3 class="widget-title">
                                    <?php esc_html_e( 'Giỏ hàng', 'cosmetics' ); ?>
                                </h3>
                            </div>

                            <?php the_widget( 'WC_Widget_Cart', '' ); ?>
                        </div>
                    </div>
                </div>

            <?php endif; ?>
        </div>
    </div>
</div>