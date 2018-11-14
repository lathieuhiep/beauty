<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class cosmetics_widget_partners extends Widget_Base {

    public function get_categories() {
        return array( 'cosmetics_widgets' );
    }

    public function get_name() {
        return 'cosmetics-partners';
    }

    public function get_title() {
        return esc_html__( 'Thương Hiệu', 'cosmetics' );
    }

    public function get_icon() {
        return 'fa fa-window-restore';
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
                'default'       =>  esc_html__( 'THƯƠNG HIỆU NỔI BẬT', 'cosmetics' ),
                'label_block'   =>  true
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_logo',
            [
                'label' => esc_html__( 'Thương hiệu', 'cosmetics' ),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'list_title_partner', [
                'label'         =>  esc_html__( 'Tên thương hiệu', 'cosmetics' ),
                'type'          =>  Controls_Manager::TEXT,
                'default'       =>  esc_html__( 'Thương hiệu' , 'cosmetics' ),
                'label_block'   =>  true,
            ]
        );

        $repeater->add_control(
            'list_logo',
            [
                'label'     =>  esc_html__( 'Logo', 'cosmetics' ),
                'type'      =>  Controls_Manager::MEDIA,
                'default'   =>  [
                    'url'   =>  Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'list_link_partner',
            [
                'label'         =>  esc_html__( 'Link', 'cosmetics' ),
                'type'          =>  Controls_Manager::URL,
                'placeholder'   =>  'https://your-link.com',
                'show_external' =>  true,
                'default' => [
                    'url'           =>  '#',
                ],
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
                        'list_title_partner'    =>  esc_html__( 'Thương hiệu 1', 'cosmetics' ),
                        'list_link'     =>  '#',
                    ],
                    [
                        'list_title_partner'    =>  esc_html__( 'Thương hiệu 2', 'cosmetics' ),
                        'list_link'     =>  '#',
                    ],
                ],
                'title_field' => '{{{ list_title_partner }}}',
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
                'label'     =>  esc_html__( 'Thương Hiệu trên một hàng( Desktop )', 'event_conference' ),
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
                'label'     =>  esc_html__( 'Thương Hiệu trên một hàng( Tablet )', 'event_conference' ),
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
                'label'     =>  esc_html__( 'Thương Hiệu trên một hàng( Mobile )', 'event_conference' ),
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
        /* End Section Slides */

    }

    protected function render() {

        $settings   =   $this->get_settings();
//        $target     =   $settings['link']['is_external'] ? ' target="_blank"' : '';
//        $nofollow   =   $settings['link']['nofollow'] ? ' rel="nofollow"' : '';

        $settings_data     =   [
            'margin_item'   =>  15,
            'number_item'   =>  $settings['item_desktop'],
            'item_tablet'   =>  $settings['item_tablet'],
            'item_mobile'   =>  $settings['item_mobile'],
            'loop'          =>  ( 'yes' === $settings['loop'] ),
            'autoplay'      =>  ( 'yes' === $settings['autoplay'] ),
            'nav'           =>  ( 'yes' === $settings['nav'] ),
        ];

    ?>

        <div class="element-partners">
            <h4 class="element-heading-global">
                <span>
                    <?php echo esc_html( $settings['heading'] ); ?>
                </span>
            </h4>

            <?php if ( $settings['list'] ) : ?>

                <div class="element-partners__logo owl-carousel owl-theme" data-settings='<?php echo esc_attr( wp_json_encode( $settings_data ) ); ?>'>
                    <?php foreach ( $settings['list'] as $item ) : ?>

                        <div class="logo-item">
                            <a href="<?php echo esc_url( $item['list_link_partner']['url'] ); ?>">
                                <?php echo wp_get_attachment_image( $item['list_logo']['id'], 'full' ); ?>
                            </a>
                        </div>

                    <?php endforeach; ?>
                </div>

            <?php endif; ?>
        </div>

    <?php
    }

}

Plugin::instance()->widgets_manager->register_widget_type( new cosmetics_widget_partners );