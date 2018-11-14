(function ($) {

    /* Start element slider */
    let ElementCarouselSlider   =   function( $scope, $ ) {

        let element_slides  =   $scope.find('.element-slides');

        $( document ).general_owlCarousel_item( element_slides );

    };
    /* End element slider */

    /* Start element product slider */
    let ElementProductlSlider   =   function( $scope, $ ) {

        let countdown_time_product_slider = $scope.find('.element-products-carousel .count-down-time-product'),
            element_product_slider = $scope.find('.element-products-carousel .item-box-products');

        countdown_time_product_slider.each(function() {
            let finalDate = $(this).data( 'countdown' );

            $(this).countdown( finalDate, function(event) {
                let $this = $(this).html( event.strftime(''
                    + '<div class="box-count"><span class="number">%D</span><span class="text">days</span></div>'
                    + '<div class="box-count"><span class="number">%H</span><span class="text">hr</span></div>'
                    + '<div class="box-count"><span class="number">%M</span><span class="text">min</span></div>'
                    + '<div class="box-count"><span class="number">%S</span><span class="text">sec</span></div>'
                    )
                );
            });

        });

        $( document ).general_multi_owlCarouse( element_product_slider );

    };
    /* End element slider */

    /* Start element partners */
    let ElementPartners   =   function( $scope, $ ) {

        let element_partners  =   $scope.find('.element-partners__logo');

        $( document ).general_multi_owlCarouse( element_partners );

    };
    /* End element partners */

    /* Start element post */
    let ElementPostSlider   =   function( $scope, $ ) {

        let element_post_slider  =   $scope.find('.element-post-carousel');

        $( document ).general_multi_owlCarouse( element_post_slider );

    };
    /* End element post */

    $( window ).on( 'elementor/frontend/init', function() {

        /* Element slider */
        elementorFrontend.hooks.addAction( 'frontend/element_ready/cosmetics-slides.default', ElementCarouselSlider  );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/cosmetics-products-carousel.default', ElementProductlSlider  );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/cosmetics-partners.default', ElementPartners  );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/cosmetics-post-type.default', ElementPostSlider  );

    } );

})( jQuery );