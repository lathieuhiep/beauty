<?php

global $cosmetics_options;

$cosmetics_show_loading = $cosmetics_options['cosmetics_general_show_loading'] == '' ? '0' : $cosmetics_options['cosmetics_general_show_loading'];

if(  $cosmetics_show_loading == 1 ) :

    $cosmetics_loading_url  = $cosmetics_options['cosmetics_general_image_loading']['url'];
?>

    <div id="site-loadding" class="d-flex align-items-center justify-content-center">

        <?php  if( $cosmetics_loading_url !='' ): ?>

            <img class="loading_img" src="<?php echo esc_url( $cosmetics_loading_url ); ?>" alt="<?php esc_attr_e('loading...','cosmetics') ?>"  >

        <?php else: ?>

            <img class="loading_img" src="<?php echo esc_url(get_theme_file_uri( '/images/loading.gif' )); ?>" alt="<?php esc_attr_e('loading...','cosmetics') ?>">

        <?php endif; ?>

    </div>

<?php endif; ?>