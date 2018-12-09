<?php

global $cosmetics_options;

$cosmetics_on_off_share_single = $cosmetics_options['cosmetics_on_off_share_single'];

?>

<div id="post-<?php the_ID() ?>" <?php post_class( 'site-post-single-item' ); ?>>
    <?php cosmetics_post_formats(); ?>

    <div class="site-post-content">
        <h1 class="site-post-title">
            <?php the_title(); ?>
        </h1>

        <div class="site-post-excerpt">
            <?php
            the_content();

            cosmetics_link_page()
            ?>
        </div>

        <div class="site-post-cat-tag">

            <?php if( get_the_category() != false ): ?>
                <span class="text-name">
                    <?php esc_html_e('Danh mục: ','cosmetics'); ?>
                </span>

                <p class="item-list-meta">
                    <?php the_category( ', ' ); ?>
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
</div>

<?php
get_template_part( 'template-parts/post/inc','related-post' );




