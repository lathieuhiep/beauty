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
            let $this = $(this), finalDate = $(this).data( 'countdown' );

            $this.countdown( finalDate, function(event) {
                $this.html(event.strftime(''
                    + '<div class="box-count"><span class="number">%D</span><span class="text">Ngày</span></div>'
                    + '<div class="box-count"><span class="number">%H</span><span class="text">Giờ</span></div>'
                    + '<div class="box-count"><span class="number">%M</span><span class="text">Phút</span></div>'
                    + '<div class="box-count"><span class="number">%S</span><span class="text">Giây</span></div>'
                ));
            } );
        });

        $( document ).general_multi_owlCarouse( element_product_slider );

    };
    /* End element slider */

    $( window ).on( 'elementor/frontend/init', function() {

        /* Element slider */
        elementorFrontend.hooks.addAction( 'frontend/element_ready/cosmetics-slides.default', ElementCarouselSlider  );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/cosmetics-products-carousel.default', ElementProductlSlider  );

    } );

})( jQuery );