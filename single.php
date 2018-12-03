<?php
get_header();

global $cosmetics_options;

$cosmetics_blog_sidebar_single = !empty( $cosmetics_options['cosmetics_blog_sidebar_single'] ) ? $cosmetics_options['cosmetics_blog_sidebar_single'] : 'right';

$cosmetics_class_col_content = cosmetics_col_use_sidebar( $cosmetics_blog_sidebar_single, 'cosmetics-sidebar-main' );

?>
<div class="site-breadcrumb">
    <div class="container">
        <div class="row">
            <div class="breadcrumbs col-md-12" typeof="BreadcrumbList" vocab="http://schema.org/">
                <?php if(function_exists('bcn_display'))
                {
                    bcn_display();
                }?>
            </div>
        </div>
    </div>
</div>
<div class="site-container site-single">
    <div class="container">
        <div class="row">

            <?php

            if( $cosmetics_blog_sidebar_single == 'left' ):
                get_sidebar();
            endif;

            ?>

            <div class="<?php echo esc_attr( $cosmetics_class_col_content ); ?>">

                <?php
                if ( have_posts() ) : while (have_posts()) : the_post();

                    get_template_part( 'template-parts/post/content','single' );

                    endwhile;
                endif;
                ?>

            </div>

            <?php

            if( $cosmetics_blog_sidebar_single == 'right' ):
                get_sidebar();
            endif;

            ?>

        </div>
    </div>
</div>

<?php get_footer(); ?>

