<?php
global $cosmetics_options;

$cosmetics_logo_image_id    =   $cosmetics_options['cosmetics_logo_image']['id'];
?>

<div class="header-logo">
    <div class="container">
        <div class="header-logo__warp d-flex align-items-center">
            <div class="search-warp">
                <?php get_search_form(); ?>
            </div>

            <div class="site-logo">
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

            <div class="site-shop-cart"></div>
        </div>
    </div>
</div>