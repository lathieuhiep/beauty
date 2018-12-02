<?php

$cosmetics_term_cat_post = get_the_terms( get_the_ID(), 'category' );

if ( !empty( $cosmetics_term_cat_post ) ):

    $cosmetics_term_cat_post_ids = array();

    foreach( $cosmetics_term_cat_post as $item_cat_post_id ) $cosmetics_term_cat_post_ids[] = $item_cat_post_id->term_id;

    $cosmetics_post_related_arg = array(
        'post_type'         =>  'post',
        'cat'               =>  $cosmetics_term_cat_post_ids,
        'post__not_in'      =>  array( get_the_ID() ),
        'posts_per_page'    =>  3,
    );

    $cosmetics_post_related_query = new WP_Query( $cosmetics_post_related_arg );

    if ( $cosmetics_post_related_query->have_posts() ) :
?>

    <div class="site-single-post-related">
        <h3 class="title">
            <?php esc_html_e( 'Tin khác', 'cosmetics' ); ?>
        </h3>

        <div class="row">
            <?php
            while ( $cosmetics_post_related_query->have_posts() ) :
                $cosmetics_post_related_query->the_post();
            ?>

                <div class="col-12 col-sm-6 col-md-4 item">
                    <div class="related-post-item">
                        <figure class="post-image">
                            <?php the_post_thumbnail( 'medium' ); ?>
                        </figure>

                        <h4 class="title-post">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h4>
                    </div>
                </div>

            <?php
            endwhile;
            wp_reset_postdata();
            ?>
        </div>
    </div>

<?php
    endif;
endif;