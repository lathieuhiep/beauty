<div class="header-bottom">
    <div class="container d-flex align-items-center">
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
    </div>
</div>