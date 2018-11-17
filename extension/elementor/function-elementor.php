<?php

/* Start ajax product filter */
add_action( 'wp_ajax_cosmetics_product_filter', 'cosmetics_product_filter' );
add_action( 'wp_ajax_nopriv_cosmetics_product_filter', 'cosmetics_product_filter' );

function cosmetics_product_filter() {
    $product_tag_id =   $_POST['tag_id_product'];

    var_dump($product_tag_id);

    exit();
}
/* End ajax product filter */