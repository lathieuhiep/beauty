<?php

    $cosmetics_audio = get_post_meta(  get_the_ID() , '_format_audio_embed', true );
    if( $cosmetics_audio != '' ):

?>
        <div class="site-post-audio">

            <?php if( wp_oembed_get( $cosmetics_audio ) ) : ?>

                <?php echo wp_oembed_get( $cosmetics_audio ); ?>

            <?php else : ?>

                <?php echo balanceTags( $cosmetics_audio ); ?>

            <?php endif; ?>

        </div>

<?php endif;?>