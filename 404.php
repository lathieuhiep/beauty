<?php
get_header();

global $beauty_options;

$beauty_title = $beauty_options['beauty_404_title'];
$beauty_content = $beauty_options['beauty_404_editor'];
$beauty_background = $beauty_options['beauty_404_background']['id'];

?>

<div class="site-error text-center">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-6">
                <figure class="site-error__image404">
                    <?php
                    if( !empty( $beauty_background ) ):
                        echo wp_get_attachment_image( $beauty_background, 'full' );
                    else:
                        echo'<img src="'.esc_url( get_theme_file_uri( '/images/404.jpg' ) ).'" alt="'.get_bloginfo('title').'" />';
                    endif;
                    ?>
                </figure>
            </div>

            <div class="col-md-6">
                <h1 class="site-title-404">
                    <?php
                    if ( $beauty_title != '' ):
                        echo esc_html( $beauty_title );
                    else:
                        esc_html_e( 'Awww...Do Not Cry', 'beauty' );
                    endif;
                    ?>
                </h1>

                <div id="site-error-content">
                    <?php
                    if ( $beauty_content != '' ) :
                        echo wp_kses_post( $beauty_content );
                    else:
                    ?>
                        <p>
                            <?php esc_html_e( 'It is just a 404 Error!', 'beauty' ); ?>
                            <br />
                            <?php esc_html_e( 'What you are looking for may have been misplaced', 'beauty' ); ?>
                            <br />
                            <?php esc_html_e( 'in Long Term Memory.', 'beauty' ); ?>
                        </p>
                    <?php endif; ?>
                </div>

                <div id="site-error-back-home">
                    <a href="<?php echo esc_url( get_home_url('/') ); ?>" title="<?php echo esc_html__('Go to the Home Page', 'beauty'); ?>">
                        <?php esc_html_e('Go to the Home Page', 'beauty'); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>