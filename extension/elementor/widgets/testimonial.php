<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class cosmetics_widget_testimonial extends Widget_Base {

    public function get_categories() {
        return array( 'cosmetics_widgets' );
    }

    public function get_name() {
        return 'cosmetics-testimonial';
    }

    public function get_title() {
        return esc_html__( 'Ý kiến khách hàng', 'cosmetics' );
    }

    public function get_icon() {
        return 'fa fa-commenting-o';
    }

    public function get_script_depends() {
        return ['cosmetics-elementor-custom'];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__( 'Tiêu đề', 'cosmetics' ),
            ]
        );

        $this->add_control(
            'heading',
            [
                'label'         =>  esc_html__( 'Tiêu đề', 'cosmetics' ),
                'type'          =>  Controls_Manager::TEXT,
                'default'       =>  esc_html__( 'Ý KIẾN KHÁCH HÀNG', 'cosmetics' ),
                'label_block'   =>  true
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_testimonial',
            [
                'label' => esc_html__( 'Nhận xét khách hàng', 'cosmetics' ),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'list_name', [
                'label'         =>  esc_html__( 'Tên khách hàng', 'cosmetics' ),
                'type'          =>  Controls_Manager::TEXT,
                'default'       =>  esc_html__( 'Khách hàng A' , 'cosmetics' ),
                'label_block'   =>  true,
            ]
        );

        $repeater->add_control(
            'list_avatar',
            [
                'label'     =>  esc_html__( 'Ảnh khách hàng', 'cosmetics' ),
                'type'      =>  Controls_Manager::MEDIA,
                'default'   =>  [
                    'url'   =>  Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'list_content',
            [
                'label'     =>  esc_html__( 'Nhận xét của khách', 'cosmetics' ),
                'type'      =>  Controls_Manager::TEXTAREA,
                'rows'      => 10,
                'default'   => '',
            ]
        );

        $this->add_control(
            'list',
            [
                'label'     =>  esc_html__( 'Danh sách thương hiệu', 'cosmetics' ),
                'type'      =>  Controls_Manager::REPEATER,
                'fields'    =>  $repeater->get_controls(),
                'default'   =>  [
                    [
                        'list_name'    =>  esc_html__( 'Thái Phương Thảo', 'cosmetics' ),
                    ],
                    [
                        'list_name'    =>  esc_html__( 'Hoàng Nhung', 'cosmetics' ),
                    ],
                ],
                'title_field' => '{{{ list_name }}}',
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
        /* End Section Slides */

    }

    protected function render() {

        $settings   =   $this->get_settings();

        $settings_data     =   [
            'loop'          =>  ( 'yes' === $settings['loop'] ),
            'autoplay'      =>  ( 'yes' === $settings['autoplay'] ),
            'nav'           =>  ( 'yes' === $settings['nav'] ),
        ];

    ?>

        <div class="element-testimonial">
            <h4 class="element-heading-global">
                <span>
                    <?php echo esc_html( $settings['heading'] ); ?>
                </span>
            </h4>

            <?php if ( $settings['list'] ) : ?>

                <div class="element-testimonial__slides text-center owl-nav-middle owl-carousel owl-theme" data-settings='<?php echo esc_attr( wp_json_encode( $settings_data ) ); ?>'>
                    <?php foreach ( $settings['list'] as $item ) : ?>

                        <div class="item">
                            <div class="item-avatar">
                                <?php echo wp_get_attachment_image( $item['list_avatar']['id'], array( '60', '60' ) ); ?>
                            </div>

                            <p class="item-content">
                                <?php echo wp_kses_post( $item['list_content'] ); ?>
                            </p>

                            <h5 class="item-name">
                                <?php echo esc_html( $item['list_name'] ); ?>
                            </h5>
                        </div>

                    <?php endforeach; ?>
                </div>

            <?php endif; ?>
        </div>

    <?php
    }

}

Plugin::instance()->widgets_manager->register_widget_type( new cosmetics_widget_testimonial );