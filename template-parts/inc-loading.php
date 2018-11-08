<?php

global $beauty_options;

$beauty_show_loading = $beauty_options['beauty_general_show_loading'] == '' ? '0' : $beauty_options['beauty_general_show_loading'];

if(  $beauty_show_loading == 1 ) :

    $beauty_loading_url  = $beauty_options['beauty_general_image_loading']['url'];
?>

    <div id="site-loadding" class="d-flex align-items-center justify-content-center">

        <?php  if( $beauty_loading_url !='' ): ?>

            <img class="loading_img" src="<?php echo esc_url( $beauty_loading_url ); ?>" alt="<?php esc_attr_e('loading...','beauty') ?>"  >

        <?php else: ?>

            <img class="loading_img" src="<?php echo esc_url(get_theme_file_uri( '/images/loading.gif' )); ?>" alt="<?php esc_attr_e('loading...','beauty') ?>">

        <?php endif; ?>

    </div>

<?php endif; ?>