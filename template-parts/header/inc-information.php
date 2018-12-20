<?php
global $cosmetics_options;

$cosmetics_information_show_hide    =  $cosmetics_options['cosmetics_information_show_hide'] == '' ? 1 : $cosmetics_options['cosmetics_information_show_hide'];
$cosmetics_information_address      =  $cosmetics_options['cosmetics_information_address'];
$cosmetics_information_mail         =  $cosmetics_options['cosmetics_information_mail'];
$cosmetics_information_phone        =  $cosmetics_options['cosmetics_information_phone'];
?>

<div class="information">
    <div class="container">
        <div class="row">
            <?php if ( $cosmetics_information_show_hide == 1 ) : ?>

                <div class="col-12 col-sm-12 col-md-7">
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

            <?php endif; ?>

            <div class="col-12 col-sm-12 col-md-5 d-none d-md-flex align-items-md-center justify-content-md-end">
                <div class="information-item information__social-network social-network-toTopFromBottom d-md-flex justify-content-md-end">
                    <?php cosmetics_get_social_url(); ?>
                </div>

                <?php if ( class_exists('Woocommerce') ) : ?>

                    <div class="information-item information__recently-viewed-product">
                        <span class="text-recently-viewed">
                             <i class="fas fa-chevron-down"></i>
                            <?php esc_html_e( 'Sản phẩm đã xem', 'cosmetics' ); ?>
                        </span>

                        <?php do_action( 'cosmetics_get_recently_viewed_product' ); ?>
                    </div>

                <?php endif; ?>
            </div>
        </div>
    </div>
</div>