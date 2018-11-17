/**
 * Element events js v1.0.0
 * Copyright 2018-2020
 * Licensed under  ()
 */

( function( $ ) {

    "use strict";

    var product_btn_filter  =   $( '.btn-filter-product' ),
        content_product     =   $( '.element-product-filter .row' );

    $( document ).ready( function () {

        filter_product();

    });

    function filter_product() {

        product_btn_filter.on( 'click', function () {

            var product_tag_id  =   parseInt( $(this).data( 'id' ) );

            // alert( product_tag_id );

            $.ajax({

                url: cosmetics_products_filter_load.url,
                type: 'POST',
                data: ({

                    action: 'cosmetics_product_filter',
                    tag_id_product: product_tag_id

                }),

                beforeSend: function () {



                },

                success: function( data ) {

                    if ( data ) {
                        content_product.empty().append( data );
                    }

                }

            });

        } )

    }

} )( jQuery );