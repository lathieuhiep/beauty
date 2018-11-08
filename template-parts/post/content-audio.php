<?php

    $beauty_audio = get_post_meta(  get_the_ID() , '_format_audio_embed', true );
    if( $beauty_audio != '' ):

?>
        <div class="site-post-audio">

            <?php if( wp_oembed_get( $beauty_audio ) ) : ?>

                <?php echo wp_oembed_get( $beauty_audio ); ?>

            <?php else : ?>

                <?php echo balanceTags( $beauty_audio ); ?>

            <?php endif; ?>

        </div>

<?php endif;?>