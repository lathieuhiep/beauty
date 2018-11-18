<?php
//Global variable redux
global $cosmetics_options;

$cosmetics_footer_multi_column_1     =   $cosmetics_options ["cosmetics_footer_multi_column_1"];
$cosmetics_footer_multi_column_1_l   =   $cosmetics_options ["cosmetics_footer_multi_column_1_1"];
$cosmetics_footer_multi_column_1_2   =   $cosmetics_options ["cosmetics_footer_multi_column_1_2"];
$cosmetics_footer_multi_column_1_3   =   $cosmetics_options ["cosmetics_footer_multi_column_1_3"];
$cosmetics_footer_multi_column_1_4   =   $cosmetics_options ["cosmetics_footer_multi_column_1_4"];
?>

<div class="row">
    <?php
    for( $i = 0; $i < $cosmetics_footer_multi_column_1; $i++ ):

        $j = $i +1;

        if ( $i == 0 ) :
            $cosmetics_col = $cosmetics_footer_multi_column_1_l;
        elseif ( $i == 1 ) :
            $cosmetics_col = $cosmetics_footer_multi_column_1_2;
        elseif ( $i == 2 ) :
            $cosmetics_col = $cosmetics_footer_multi_column_1_3;
        else :
            $cosmetics_col = $cosmetics_footer_multi_column_1_4;
        endif;

        if( is_active_sidebar( 'cosmetics-sidebar-footer-multi-column-1-'.$j ) ):
    ?>

        <div class="col-12 col-sm-6 col-md-4 col-lg-<?php echo esc_attr( $cosmetics_col ); ?>">

            <?php dynamic_sidebar( 'cosmetics-sidebar-footer-multi-column-1-'.$j ); ?>

        </div>

    <?php
        endif;

    endfor;
    ?>
</div>
