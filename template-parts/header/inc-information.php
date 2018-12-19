<?php
global $cosmetics_options;

$cosmetics_information_address   =   $cosmetics_options['cosmetics_information_address'];
$cosmetics_information_mail      =   $cosmetics_options['cosmetics_information_mail'];
$cosmetics_information_phone     =   $cosmetics_options['cosmetics_information_phone'];
?>

<div class="information">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-7">
                <?php if ( $cosmetics_information_address != '' ) : ?>

                    <span class="item-address">
                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                        <?php echo esc_html( $cosmetics_information_address ); ?>
                    </span>

                <?php
                endif;

                if ( $cosmetics_information_mail != '' ) :
                ?>

                    <span class="item-mail">
                        <i class="fa fa-envelope-o" aria-hidden="true"></i>
                        <?php echo esc_html( $cosmetics_information_mail ); ?>
                    </span>

                <?php
                endif;

                if ( $cosmetics_information_phone != '' ) :
                ?>

                    <span class="item-phone">
                        <i class="fas fa-mobile-alt"></i>
                        <?php echo esc_html( $cosmetics_information_phone ); ?>
                    </span>

                <?php endif; ?>
            </div>

            <div class="col-12 col-md-12 col-lg-5 d-none d-lg-block">
                <div class="information__social-network social-network-toTopFromBottom d-lg-flex justify-content-lg-end">
                    <?php cosmetics_get_social_url(); ?>
                </div>
            </div>
        </div>
    </div>
</div>