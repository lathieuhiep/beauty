<?php
get_header();

global $beauty_options;

$beauty_blog_sidebar_single = !empty( $beauty_options['beauty_blog_sidebar_single'] ) ? $beauty_options['beauty_blog_sidebar_single'] : 'right';

$beauty_class_col_content = beauty_col_use_sidebar( $beauty_blog_sidebar_single, 'beauty-sidebar-main' );

?>

<div class="site-container site-single">
    <div class="container">
        <div class="row">

            <?php

            if( $beauty_blog_sidebar_single == 'left' ):
                get_sidebar();
            endif;

            ?>

            <div class="<?php echo esc_attr( $beauty_class_col_content ); ?>">

                <?php
                if ( have_posts() ) : while (have_posts()) : the_post();

                    get_template_part( 'template-parts/post/content','single' );

                    endwhile;
                endif;
                ?>

            </div>

            <?php

            if( $beauty_blog_sidebar_single == 'right' ):
                get_sidebar();
            endif;

            ?>

        </div>
    </div>
</div>

<?php get_footer(); ?>

