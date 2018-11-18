<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class cosmetics_store extends Widget_Base {

    public function get_categories() {
        return array( 'cosmetics_widgets' );
    }

    public function get_name() {
        return 'cosmetics-store';
    }

    public function get_title() {
        return esc_html__( 'Hệ thông cửa hàng', 'cosmetics' );
    }

    public function get_icon() {
        return ' eicon-post';
    }

    public function get_script_depends() {
        return ['cosmetics-elementor-custom'];
    }

    protected function _register_controls() {

        /* Section Heading */
        $this->start_controls_section(
            'section_heading',
            [
                'label' =>  esc_html__( 'Tiêu đề', 'cosmetics' )
            ]
        );

        $this->add_control(
            'heading',
            [
                'label'         =>  esc_html__( 'Tiêu đề', 'cosmetics' ),
                'type'          =>  Controls_Manager::TEXT,
                'default'       =>  esc_html__( 'HỆ THỐNG CỬA HÀNG MỸ PHẨM', 'cosmetics' ),
                'label_block'   =>  true
            ]
        );

        $this->end_controls_section();

        /* Section Store */
        $this->start_controls_section(
            'section_store',
            [
                'label' =>  esc_html__( 'Hệ thông cửa hàng', 'cosmetics' )
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'list_image_store',
            [
                'label'     =>  esc_html__( 'Ảnh cửa hàng', 'cosmetics' ),
                'type'      =>  Controls_Manager::MEDIA,
                'default'   =>  [
                    'url'   =>  Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'list_name_store', [
                'label'         =>  esc_html__( 'Tên cửa hàng', 'cosmetics' ),
                'type'          =>  Controls_Manager::TEXT,
                'default'       =>  esc_html__( 'Tên cửa  hàng' , 'cosmetics' ),
                'label_block'   =>  true,
            ]
        );

        $repeater->add_control(
            'list_address_store', [
                'label'         =>  esc_html__( 'Địa chỉ cửa hàng', 'cosmetics' ),
                'type'          =>  Controls_Manager::TEXT,
                'default'       =>  '',
                'label_block'   =>  true,
            ]
        );

        $this->add_control(
            'list',
            [
                'label'     =>  esc_html__( 'Danh sách của hàng', 'cosmetics' ),
                'type'      =>  Controls_Manager::REPEATER,
                'fields'    =>  $repeater->get_controls(),
                'default'   =>  [
                    [
                        'list_name_store'    =>  esc_html__( 'Tên cửa hàng 1', 'cosmetics' ),
                    ],
                    [
                        'list_name_store'    =>  esc_html__( 'Tên cửa hàng 2', 'cosmetics' ),
                    ],
                ],
                'title_field' => '{{{ list_name_store }}}',
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
                'label'     =>  esc_html__( 'Desktop', 'event_conference' ),
                'type'      =>  Controls_Manager::NUMBER,
                'default'   =>  4,
                'min'       =>  1,
                'max'       =>  100,
                'step'      =>  1,
            ]
        );

        $this->add_control(
            'item_tablet',
            [
                'label'     =>  esc_html__( 'Tablet', 'event_conference' ),
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
                'label'     =>  esc_html__( 'Mobile', 'event_conference' ),
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
                'default'       =>  'no',
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

        $settings_data     =   [
            'margin_item'   =>  30,
            'number_item'   =>  $settings['item_desktop'],
            'item_tablet'   =>  $settings['item_tablet'],
            'item_mobile'   =>  $settings['item_mobile'],
            'loop'          =>  ( 'yes' === $settings['loop'] ),
            'autoplay'      =>  ( 'yes' === $settings['autoplay'] ),
            'nav'           =>  ( 'yes' === $settings['nav'] ),
        ];

    ?>

        <div class="element-store">
            <h4 class="element-heading-global">
                <span>
                    <?php echo esc_html( $settings['heading'] ); ?>
                </span>
            </h4>

            <?php if ( $settings['list'] ) : ?>

                <div class="element-store__slides owl-nav-top owl-carousel owl-theme" data-settings='<?php echo esc_attr( wp_json_encode( $settings_data ) ); ?>'>
                    <?php foreach ( $settings['list'] as $item ) : ?>

                        <div class="item">
                            <div class="item-image">
                                <?php echo wp_get_attachment_image( $item['list_image_store']['id'], 'full' ); ?>

                                <div class="item-address text-center d-flex justify-content-center flex-column">
                                    <i class="fas fa-map-marker-alt"></i>

                                    <h5 class="text-address">
                                        <?php echo esc_html( $item['list_address_store'] ); ?>
                                    </h5>
                                </div>
                            </div>

                            <h4 class="item-name text-center">
                                <?php echo esc_html( $item['list_name_store'] ); ?>
                            </h4>
                        </div>

                    <?php endforeach; ?>
                </div>

            <?php endif; ?>
        </div>

    <?php


    }

}

Plugin::instance()->widgets_manager->register_widget_type( new cosmetics_store );