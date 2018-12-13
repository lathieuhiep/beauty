<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class cosmetics_widget_products_carousel extends Widget_Base {

    public function get_categories() {
        return array( 'cosmetics_widgets' );
    }

    public function get_name() {
        return 'cosmetics-products-carousel';
    }

    public function get_title() {
        return esc_html__( 'Products Carousel', 'cosmetics' );
    }

    public function get_icon() {
        return 'fa fa-shopping-basket';
    }

    public function get_script_depends() {
        return ['jquery-countdown', 'cosmetics-elementor-custom'];
    }

    protected function _register_controls() {

        /* Section Query */
        $this->start_controls_section(
            'section_query',
            [
                'label' =>  esc_html__( 'Query', 'cosmetics' )
            ]
        );

        $this->add_control(
            'title',
            [
                'label'         =>  esc_html__( 'Tiêu đề', 'cosmetics' ),
                'type'          =>  Controls_Manager::TEXT,
                'default'       =>  esc_html__( 'SẢN PHẨM', 'cosmetics' ),
                'label_block'   =>  true
            ]
        );

        $this->add_control(
            'select_get_product',
            [
                'label'     =>  esc_html__( 'Sẩn phầm cần lấy', 'cosmetics' ),
                'type'      =>  Controls_Manager::SELECT,
                'default'   =>  'product_on_sale',
                'options'   =>  [
                    'product_on_sale'   =>  esc_html__( 'Sản phẩm khuyến mãi', 'cosmetics' ),
                    'product_all'       =>  esc_html__( 'Sản phẩm bất kì', 'cosmetics' ),
                ],
            ]
        );

        $this->add_control(
            'select_cat',
            [
                'label'         =>  esc_html__( 'Chọn danh mục sản phẩm', 'cosmetics' ),
                'type'          =>  Controls_Manager::SELECT2,
                'options'       =>  cosmetics_check_get_cat( 'product_cat' ),
                'multiple'      =>  true,
                'label_block'   =>  true,
                'condition'    =>  [
                    'select_get_product'   =>  'product_all'
                ]
            ]
        );

        $this->add_control(
            'limit',
            [
                'label'     =>  esc_html__( 'Sản phẩm lấy ra', 'cosmetics' ),
                'type'      =>  Controls_Manager::NUMBER,
                'default'   =>  8,
                'min'       =>  1,
                'max'       =>  100,
                'step'      =>  1,
            ]
        );

        $this->add_control(
            'order_by',
            [
                'label'     =>  esc_html__( 'Sắp xếp theo', 'cosmetics' ),
                'type'      =>  Controls_Manager::SELECT,
                'default'   =>  'id',
                'options'   =>  [
                    'id'    =>  esc_html__( 'ID', 'cosmetics' ),
                    'title' =>  esc_html__( 'Tên sản phẩm', 'cosmetics' ),
                    'date'  =>  esc_html__( 'Ngày đăng', 'cosmetics' ),
                    'rand' =>  esc_html__( 'Random', 'cosmetics' ),
                ],
            ]
        );

        $this->add_control(
            'order',
            [
                'label'     =>  esc_html__( 'Sắp xếp', 'cosmetics' ),
                'type'      =>  Controls_Manager::SELECT,
                'default'   =>  'ASC',
                'options'   =>  [
                    'ASC'   =>  esc_html__( 'Sắp xếp tăng dần', 'cosmetics' ),
                    'DESC'  =>  esc_html__( 'Sắp xếp giảm dần', 'cosmetics' ),
                ],
            ]
        );

        $this->end_controls_section();

        /* Section Countdown */
        $this->start_controls_section(
            'section_countdown',
            [
                'label' => esc_html__( 'Kết thúc khuyến mãi', 'cosmetics' ),
                'tab' => Controls_Manager::SECTION,
                'condition'    =>  [
                    'select_get_product'   =>  'product_on_sale'
                ]
            ]
        );

        $this->add_control(
            'countdown_date',
            [
                'label'             =>  esc_html__( 'Ngày giờ kết thúc', 'cosmetics' ),
                'type'              =>  Controls_Manager::DATE_TIME,
                'picker_options'    =>  array(
                    'enableSeconds' =>  true
                )
            ]
        );

        $this->end_controls_section();

        /* Section Slides */
        $this->start_controls_section(
            'section_slides',
            [
                'label' =>  esc_html__( 'Cài đặt Slides', 'cosmetics' )
            ]
        );

        $this->add_control(
            'item_desktop',
            [
                'label'     =>  esc_html__( 'Sản phẩm trên một hàng( Desktop )', 'event_conference' ),
                'type'      =>  Controls_Manager::NUMBER,
                'default'   =>  5,
                'min'       =>  1,
                'max'       =>  100,
                'step'      =>  1,
            ]
        );

        $this->add_control(
            'item_tablet',
            [
                'label'     =>  esc_html__( 'Sản phẩm trên một hàng( Tablet )', 'event_conference' ),
                'type'      =>  Controls_Manager::NUMBER,
                'default'   =>  3,
                'min'       =>  1,
                'max'       =>  100,
                'step'      =>  1,
            ]
        );

        $this->add_control(
            'item_mobile',
            [
                'label'     =>  esc_html__( 'Sản phẩm trên một hàng( Mobile )', 'event_conference' ),
                'type'      =>  Controls_Manager::NUMBER,
                'default'   =>  1,
                'min'       =>  1,
                'max'       =>  100,
                'step'      =>  1,
            ]
        );

        $this->add_control(
            'loop',
            [
                'type'          =>  Controls_Manager::SWITCHER,
                'label'         =>  esc_html__('Vòng lặp ?', 'event_conference'),
                'label_off'     =>  esc_html__('Không', 'event_conference'),
                'label_on'      =>  esc_html__('Có', 'event_conference'),
                'return_value'  =>  'yes',
                'default'       =>  'yes',
            ]
        );
        $this->add_control(
            'autoplay',
            [
                'label'         => esc_html__('Tự động chạy ?', 'event_conference'),
                'type'          => Controls_Manager::SWITCHER,
                'label_off'     => esc_html__('Không', 'event_conference'),
                'label_on'      => esc_html__('Có', 'event_conference'),
                'return_value'  => 'yes',
                'default'       => 'no',
            ]
        );

        $this->add_control(
            'nav',
            [
                'label'         => esc_html__('Nav Slider', 'event_conference'),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__('Có', 'event_conference'),
                'label_off'     => esc_html__('Không', 'event_conference'),
                'return_value'  => 'yes',
                'default'       => 'yes',
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {

        $settings   =   $this->get_settings_for_display();
        $select_cat =   $settings['select_cat'];
        $limit      =   $settings['limit'];
        $order_by   =   $settings['order_by'];
        $order      =   $settings['order'];

        if ( $settings['select_get_product'] == 'product_on_sale' ) :

            $args = array(
                'post_type'         =>  'product',
                'post__in'		    =>  array_merge( array( 0 ), wc_get_product_ids_on_sale() ),
                'posts_per_page'    =>  $limit,
                'orderby'           =>  $order_by,
                'order'             =>  $order,
            );

        else:

            if ( !empty( $select_cat ) ) :

                $args = array(
                    'post_type'         =>  'product',
                    'posts_per_page'    =>  $limit,
                    'orderby'           =>  $order_by,
                    'order'             =>  $order,
                    'tax_query'         =>  array(
                        array(
                            'taxonomy'  =>  'product_cat',
                            'field'     =>  'id',
                            'terms'     =>  $select_cat,
                        ),
                    ),
                );

            else:

                $args = array(
                    'post_type'         =>  'product',
                    'posts_per_page'    =>  $limit,
                    'orderby'           =>  $order_by,
                    'order'             =>  $order,
                );

            endif;

        endif;

        $query = new \ WP_Query( $args );

        if ( $query->have_posts() ) :

            $settings_data     =   [
                'margin_item'   =>  8,
                'number_item'   =>  $settings['item_desktop'],
                'item_tablet'   =>  $settings['item_tablet'],
                'item_mobile'   =>  $settings['item_mobile'],
                'loop'          =>  ( 'yes' === $settings['loop'] ),
                'autoplay'      =>  ( 'yes' === $settings['autoplay'] ),
                'nav'           =>  ( 'yes' === $settings['nav'] ),
            ];

    ?>

        <div class="element-products-carousel element-product-style">
            <div class="header d-md-flex justify-content-md-between align-items-md-center">
                <h4 class="title">
                    <?php echo esc_html( $settings['title'] ); ?>
                </h4>

                <?php if ( $settings['select_get_product'] == 'product_on_sale' )  : ?>
                    <div class="deals-of-countdown-product">
                        <span class="title-countdown">
                            <?php esc_html_e( 'Kết thúc:', 'cosmetics' ); ?>
                        </span>

                        <div class="count-down-time-product" data-countdown="<?php echo esc_attr(  $settings['countdown_date'] ); ?>"></div>
                    </div>
                <?php endif; ?>
            </div>

            <div class="item-box-products owl-carousel owl-theme" data-settings='<?php echo esc_attr( wp_json_encode( $settings_data ) ); ?>'>
                <?php while ( $query->have_posts() ): $query->the_post(); ?>

                    <div class="item-product">
                        <a class="item-link-product" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">&nbsp;</a>

                        <div class="item-thumbnail">
                            <?php
                            do_action( 'woo_elementor_product_sale_flash' );

                            if ( has_post_thumbnail() ) :
                                the_post_thumbnail( 'large' );
                            else:
                            ?>
                                <img src="<?php echo esc_url( get_theme_file_uri( '/images/no-image.png' ) ); ?>" alt="<?php the_title(); ?>">
                            <?php endif; ?>

                            <div class="item-add-cart">
                                <?php do_action( 'woo_elementor_add_to_cart' ); ?>
                            </div>
                        </div>

                        <div class="item-detail">
                            <h2 class="item-title">
                                <?php the_title(); ?>
                            </h2>

                            <?php woocommerce_template_loop_price(); ?>
                        </div>
                    </div>

                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>

    <?php

        endif;
    }

}

Plugin::instance()->widgets_manager->register_widget_type( new cosmetics_widget_products_carousel );