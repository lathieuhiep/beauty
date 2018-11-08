<?php

$cosmetics_video_post = get_post_meta(  get_the_ID() , 'cosmetics_video_post', true );

if ( !empty( $cosmetics_video_post ) ):

?>

    <div class="site-post-video">
        <?php echo wp_oembed_get( $cosmetics_video_post ); ?>
    </div>

<?php endif;?>