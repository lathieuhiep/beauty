<?php
get_header();

global $cosmetics_options;

$cosmetics_title = $cosmetics_options['cosmetics_404_title'];
$cosmetics_content = $cosmetics_options['cosmetics_404_editor'];
$cosmetics_background = $cosmetics_options['cosmetics_404_background']['id'];

?>

<div class="site-error text-center">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-6">
                <figure class="site-error__image404">
                    <?php
                    if( !empty( $cosmetics_background ) ):
                        echo wp_get_attachment_image( $cosmetics_background, 'full' );
                    else:
                        echo'<img src="'.esc_url( get_theme_file_uri( '/images/404.jpg' ) ).'" alt="'.get_bloginfo('title').'" />';
                    endif;
                    ?>
                </figure>
            </div>

            <div class="col-md-6">
                <h1 class="site-title-404">
                    <?php
                    if ( $cosmetics_title != '' ):
                        echo esc_html( $cosmetics_title );
                    else:
                        esc_html_e( 'Awww...Do Not Cry', 'cosmetics' );
                    endif;
                    ?>
                </h1>

                <div id="site-error-content">
                    <?php
                    if ( $cosmetics_content != '' ) :
                        echo wp_kses_post( $cosmetics_content );
                    else:
                    ?>
                        <p>
                            <?php esc_html_e( 'It is just a 404 Error!', 'cosmetics' ); ?>
                            <br />
                            <?php esc_html_e( 'What you are looking for may have been misplaced', 'cosmetics' ); ?>
                            <br />
                            <?php esc_html_e( 'in Long Term Memory.', 'cosmetics' ); ?>
                        </p>
                    <?php endif; ?>
                </div>

                <div id="site-error-back-home">
                    <a href="<?php echo esc_url( get_home_url('/') ); ?>" title="<?php echo esc_html__('Go to the Home Page', 'cosmetics'); ?>">
                        <?php esc_html_e('Go to the Home Page', 'cosmetics'); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>