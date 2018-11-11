(function ($) {

    /* Start element slider */
    let ElementCarouselSlider   =   function( $scope, $ ) {

        let element_slides  =   $scope.find('.element-slides');

        $( document ).general_owlCarousel_item( element_slides );

    };
    /* End element slider */

    /* Start element product slider */
    let ElementProductlSlider   =   function( $scope, $ ) {

        let element_product_slider  =   $scope.find('.element-products-carousel .item-box-products');

        $( document ).general_multi_owlCarouse( element_product_slider );

    };
    /* End element slider */

    $( window ).on( 'elementor/frontend/init', function() {

        /* Element slider */
        elementorFrontend.hooks.addAction( 'frontend/element_ready/cosmetics-slides.default', ElementCarouselSlider  );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/cosmetics-products-carousel.default', ElementProductlSlider  );

    } );

})( jQuery );