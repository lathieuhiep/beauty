<?php
/**
 * Breadcrumb file
 */

if ( function_exists( 'bcn_display' ) ) :
?>

<div class="site-breadcrumb">
    <div class="site-breadcrumb-wrapper">
        <div class="breadcrumb-wrapper-content">
            <?php bcn_display(); ?>
        </div>
    </div>
</div>

<?php
endif;