<?php

$beauty_video_post = get_post_meta(  get_the_ID() , 'beauty_video_post', true );

if ( !empty( $beauty_video_post ) ):

?>

    <div class="site-post-video">
        <?php echo wp_oembed_get( $beauty_video_post ); ?>
    </div>

<?php endif;?>