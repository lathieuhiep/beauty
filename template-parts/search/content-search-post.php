<?php
$cosmetics_post_type = get_post_type( get_the_ID() );

if ( $cosmetics_post_type != 'page' ) :

    get_template_part( 'template-parts/archive/content', 'archive-info' );

endif;







