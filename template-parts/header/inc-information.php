<?php
global $beauty_options;

$beauty_information_address   =   $beauty_options['beauty_information_address'];
$beauty_information_mail      =   $beauty_options['beauty_information_mail'];
$beauty_information_phone     =   $beauty_options['beauty_information_phone'];
?>

<div class="information">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-7">
                <?php if ( $beauty_information_address != '' ) : ?>

                    <span>
                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                        <?php echo esc_html( $beauty_information_address ); ?>
                    </span>

                <?php
                endif;

                if ( $beauty_information_mail != '' ) :
                ?>

                    <span>
                        <i class="fa fa-envelope-o" aria-hidden="true"></i>
                        <?php echo esc_html( $beauty_information_mail ); ?>
                    </span>

                <?php
                endif;

                if ( $beauty_information_phone != '' ) :
                ?>

                    <span>
                        <i class="fas fa-mobile-alt"></i>
                        <?php echo esc_html( $beauty_information_phone ); ?>
                    </span>

                <?php endif; ?>
            </div>

            <div class="col-12 col-md-12 col-lg-5 d-none d-lg-block">
                <div class="information__social-network social-network-toTopFromBottom d-lg-flex justify-content-lg-end">
                    <?php beauty_get_social_url(); ?>
                </div>
            </div>
        </div>
    </div>
</div>