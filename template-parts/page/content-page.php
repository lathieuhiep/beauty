<?php
/**
 * Displays content for front page
 *
 */

global $cosmetics_options;

$cosmetics_page_default_show_breadcrumb =   !empty( $cosmetics_options['cosmetics_page_default_show_breadcrumb'] ) ? $cosmetics_options['cosmetics_page_default_show_breadcrumb'] : 0;
$cosmetics_page_default_sidebar         =   !empty( $cosmetics_options['cosmetics_page_default_sidebar'] ) ? $cosmetics_options['cosmetics_page_default_sidebar'] : 'right';
$cosmetics_class_col_content            =   cosmetics_col_use_sidebar( $cosmetics_page_default_sidebar, 'cosmetics-sidebar-main' );
?>

<div class="site-content site-page">
    <div class="container">

        <?php
        if ( $cosmetics_page_default_show_breadcrumb == 1 ) :
            get_template_part( 'template-parts/breadcrumb/inc','breadcrumb' );
        endif;
        ?>

        <div class="row">
            <?php

            if( $cosmetics_page_default_sidebar == 'left' ):
                get_sidebar();
            endif;

            ?>

            <div class="<?php echo esc_attr( $cosmetics_class_col_content ); ?>">
                <?php while ( have_posts() ) : the_post(); ?>

                    <div class="site-page-content">

                        <?php
                        the_content();

                        cosmetics_link_page();
                        ?>

                    </div>

                    <?php
                    cosmetics_comment_form();

                endwhile;
                ?>
            </div>

            <?php

            if( $cosmetics_page_default_sidebar == 'right' ):
                get_sidebar();
            endif;

            ?>
        </div>
    </div>
</div>
