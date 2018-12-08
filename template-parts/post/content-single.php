<?php

global $cosmetics_options;

$cosmetics_on_off_share_single = $cosmetics_options['cosmetics_on_off_share_single'];

?>

<div id="post-<?php the_ID() ?>" <?php post_class( 'site-post-single-item' ); ?>>
    <?php cosmetics_post_formats(); ?>

    <div class="site-post-content">
        <h2 class="site-post-title">
            <?php the_title(); ?>
        </h2>

        <?php cosmetics_post_meta(); ?>

        <div class="site-post-excerpt">
            <?php
            the_content();

            cosmetics_link_page()
            ?>
        </div>

        <div class="site-post-cat-tag">

            <?php if( get_the_category() != false ): ?>

                <p class="site-post-category">
                    <?php
                    esc_html_e('Category: ','cosmetics');
                    the_category( ' ' );;
                    ?>
                </p>

            <?php

            endif;

            if( get_the_tags() != false ):

            ?>

                <p class="site-post-tag">
                    <?php
                    esc_html_e('Tag: ','cosmetics');
                    the_tags('',' ');
                    ?>
                </p>

            <?php endif; ?>

        </div>
    </div>

    <?php if ( $cosmetics_on_off_share_single == 1 || $cosmetics_on_off_share_single == null ) : ?>
        <div class="site-post-share">
            <span>
                <?php  esc_html_e('Share this post:', 'cosmetics') ; ?>
            </span>

            <!-- Facebook Button -->
            <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>">
                <i class="fa fa-facebook"></i>
            </a>

            <a target="_blank" href="https://twitter.com/home?status=Check%20out%20this%20article:%20<?php print cosmetics_social_title( get_the_title() ); ?>%20-%20<?php the_permalink(); ?>">
                <i class="fa fa-twitter"></i>
            </a>

            <?php $cosmetics_pin_image = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() )); ?>

            <a data-pin-do="skipLink" target="_blank" href="https://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo esc_url( $cosmetics_pin_image ); ?>&description=<?php the_title(); ?>">
                <i class="fa fa-pinterest"></i>
            </a>

            <a target="_blank" href="https://plus.google.com/share?url=<?php the_permalink(); ?>">
                <i class="fa fa-google-plus"></i>
            </a>
        </div>
    <?php endif; ?>
</div>

<?php
get_template_part( 'template-parts/post/inc','related-post' );

cosmetics_comment_form();




