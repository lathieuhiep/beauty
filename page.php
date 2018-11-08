<?php
get_header();

$beauty_check_elementor =   get_post_meta( get_the_ID(), '_elementor_edit_mode', true );

$beauty_class_elementor =   '';

if ( $beauty_check_elementor ) :
    $beauty_class_elementor =   ' site-container-elementor';
endif;

?>

    <main class="site-container<?php echo esc_attr( $beauty_class_elementor ); ?>">

        <?php
        if ( $beauty_check_elementor ) :
            get_template_part('template-parts/page/content','page-elementor');
        else:
            get_template_part('template-parts/page/content','page');
        endif;
        ?>

    </main>

<?php 

get_footer();