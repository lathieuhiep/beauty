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

        /*STYLE TAB*/
        $this->start_controls_section(
            'section_style_title',
            [
                'label' => esc_html__( 'Title', 'cosmetics' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     =>  __( 'Title Color', 'cosmetics' ),
                'type'      =>  Controls_Manager::COLOR,
                'selectors' =>  [
                    '{{WRAPPER}} .element-partners .element-partners__content .title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .element-partners .element-partners__content .title',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_sub_title',
            [
                'label' => esc_html__( 'Sub Title', 'cosmetics' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'sub_title_color',
            [
                'label'     =>  __( 'Sub Title Color', 'cosmetics' ),
                'type'      =>  Controls_Manager::COLOR,
                'selectors' =>  [
                    '{{WRAPPER}} .element-partners .element-partners__content .sub-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sub_title_typography',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .element-partners .element-partners__content .sub-title',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_description',
            [
                'label' => esc_html__( 'Description', 'cosmetics' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label'     =>  __( 'Description Color', 'cosmetics' ),
                'type'      =>  Controls_Manager::COLOR,
                'selectors' =>  [
                    '{{WRAPPER}} .element-partners .element-partners__content .description' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .element-partners .element-partners__content .description',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_text_link',
            [
                'label' => esc_html__( 'Text Link', 'cosmetics' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'text_link_color',
            [
                'label'     =>  __( 'Text Link Color', 'cosmetics' ),
                'type'      =>  Controls_Manager::COLOR,
                'selectors' =>  [
                    '{{WRAPPER}} .element-partners .element-partners__content .link-text' => 'color: {{VALUE}}; border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'text_link_hover_color',
            [
                'label'     =>  __( 'Text Link Hover Color', 'cosmetics' ),
                'type'      =>  Controls_Manager::COLOR,
                'selectors' =>  [
                    '{{WRAPPER}} .element-partners .element-partners__content .link-text:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'text_link_hover_background',
            [
                'label'     =>  __( 'Text Link Hover Background', 'cosmetics' ),
                'type'      =>  Controls_Manager::COLOR,
                'selectors' =>  [
                    '{{WRAPPER}} .element-partners .element-partners__content .link-text:hover' => 'border-color: {{VALUE}}; background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_link_typography',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .element-partners .element-partners__content .link-text',
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {

        $settings   =   $this->get_settings();
//        $target     =   $settings['link']['is_external'] ? ' target="_blank"' : '';
//        $nofollow   =   $settings['link']['nofollow'] ? ' rel="nofollow"' : '';

        $settings_data     =   [
            'margin_item'   =>  15,
            'number_item'   =>  5,
            'item_tablet'   =>  3,
            'item_mobile'   =>  1,
        ];

    ?>

        <div class="element-partners">
            <h4 class="title">
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