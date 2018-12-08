<div class="header-bottom">
    <div class="container d-flex">
        <div class="site-menu collapse navbar-collapse">

            <?php

            if ( has_nav_menu('primary') ) :

                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'menu_class'     => 'navbar-nav',
                    'container'      => false,
                ) ) ;

            else:

                ?>

                <ul class="main-menu">
                    <li>
                        <a href="<?php echo get_admin_url().'/nav-menus.php'; ?>">
                            <?php esc_html_e( 'ADD TO MENU','cosmetics' ); ?>
                        </a>
                    </li>
                </ul>

            <?php endif; ?>

        </div>

        <div class="site-menu__right d-flex">
            <div class="site-menu__search item d-flex align-items-center">
                <span class="btn-search-menu">
                    <i class="icon-search fas fa-search"></i>
                </span>

                <div class="site-menu-form__search">
                    <?php get_search_form(); ?>
                </div>
            </div>

            <div class="tz-shop-cart item d-flex align-items-center">
                <?php
                /**
                 * maniva_meetup_get_cart_item hook.
                 *
                 * @hooked maniva_meetup_get_cart - 10
                 */
                do_action( 'cosmetics_get_cart_item' );

                ?>
            </div>
        </div>
    </div>
</div>