<?php
//Global variable redux
global $cosmetics_options;

$cosmetics_copyright = $cosmetics_options ['cosmetics_footer_copyright_editor'] == '' ? 'Copyright &amp; DiepLK' : $cosmetics_options ['cosmetics_footer_copyright_editor'];

?>

<div class="site-footer__copyright">
    <div class="container">
        <div class="site-copyright-menu d-flex align-items-center">

            <div class="site-copyright">
                <?php echo wp_kses_post( $cosmetics_copyright ); ?>
            </div>

            <?php if ( has_nav_menu( 'footer-menu' ) ) : ?>

                <div class="site-footer__menu">
                    <nav>
                        <?php
                            wp_nav_menu( array(
                                'theme_location'    => 'footer-menu',
                                'menu_class'        => 'menu-footer',
                                'container'         =>  false,
                            ));
                         ?>
                    </nav>
                </div>

            <?php endif; ?>
        </div>
    </div>
</div>