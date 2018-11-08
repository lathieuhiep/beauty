<?php
//Global variable redux
global $beauty_options;

$beauty_footer_multi_column     =   $beauty_options ["beauty_footer_multi_column"];
$beauty_footer_multi_column_l   =   $beauty_options ["beauty_footer_multi_column_1"];
$beauty_footer_multi_column_2   =   $beauty_options ["beauty_footer_multi_column_2"];
$beauty_footer_multi_column_3   =   $beauty_options ["beauty_footer_multi_column_3"];
$beauty_footer_multi_column_4   =   $beauty_options ["beauty_footer_multi_column_4"];

if( is_active_sidebar( 'beauty-sidebar-footer-multi-column-1' ) || is_active_sidebar( 'beauty-sidebar-footer-multi-column-2' ) || is_active_sidebar( 'beauty-sidebar-footer-multi-column-3' ) || is_active_sidebar( 'beauty-sidebar-footer-multi-column-4' ) ) :

?>

    <div class="site-footer__multi--column">
        <div class="container">
            <div class="row">
                <?php
                for( $i = 0; $i < $beauty_footer_multi_column; $i++ ):

                    $j = $i +1;

                    if ( $i == 0 ) :
                        $beauty_col = $beauty_footer_multi_column_l;
                    elseif ( $i == 1 ) :
                        $beauty_col = $beauty_footer_multi_column_2;
                    elseif ( $i == 2 ) :
                        $beauty_col = $beauty_footer_multi_column_3;
                    else :
                        $beauty_col = $beauty_footer_multi_column_4;
                    endif;

                    if( is_active_sidebar( 'beauty-sidebar-footer-multi-column-'.$j ) ):
                ?>

                    <div class="col-12 col-sm-6 col-md-4 col-lg-<?php echo esc_attr( $beauty_col ); ?>">

                        <?php dynamic_sidebar( 'beauty-sidebar-footer-multi-column-'.$j ); ?>

                    </div>

                <?php
                    endif;

                endfor;
                ?>
            </div>
        </div>
    </div>

<?php endif; ?>