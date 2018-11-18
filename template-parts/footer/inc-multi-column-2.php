<?php
global $cosmetics_options;

$cosmetics_footer_multi_column_2    =   $cosmetics_options['cosmetics_footer_multi_column_2'];
$cosmetics_footer_multi_column_2_1  =   $cosmetics_options['cosmetics_footer_multi_column_2_1'];
$cosmetics_footer_multi_column_2_2  =   $cosmetics_options['cosmetics_footer_multi_column_2_2'];
$cosmetics_footer_multi_column_2_3  =   $cosmetics_options['cosmetics_footer_multi_column_2_3'];
$cosmetics_footer_multi_column_2_4  =   $cosmetics_options['cosmetics_footer_multi_column_2_4'];
?>

<div class="row">
    <?php

    for( $cosmetics_i = 0; $cosmetics_i < $cosmetics_footer_multi_column_2; $cosmetics_i++ ):

        $cosmetics_j = $cosmetics_i +1;

        if ( $cosmetics_i == 0 ) :
            $cosmetics_col = $cosmetics_footer_multi_column_2_1;
        elseif ( $cosmetics_i == 1 ) :
            $cosmetics_col = $cosmetics_footer_multi_column_2_2;
        elseif ( $cosmetics_i == 2 ) :
            $cosmetics_col = $cosmetics_footer_multi_column_2_3;
        else :
            $cosmetics_col = $cosmetics_footer_multi_column_2_4;
        endif;

        if( is_active_sidebar( 'cosmetics-sidebar-footer-multi-column-2-'.$cosmetics_j ) ):
    ?>

            <div class="col-12 col-sm-6 col-md-4 col-lg-<?php echo esc_attr( $cosmetics_col ); ?>">
                <?php dynamic_sidebar( 'cosmetics-sidebar-footer-multi-column-2-'.$cosmetics_j ); ?>
            </div>

    <?php
        endif;

    endfor;
    ?>
</div>


