<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class cosmetics_widget_contact_us extends Widget_Base {

    public function get_categories() {
        return array( 'cosmetics_widgets' );
    }

    public function get_name() {
        return 'cosmetics-contact-us';
    }

    public function get_title() {
        return esc_html__( 'Liên Hệ', 'cosmetics' );
    }

    public function get_icon() {
        return 'fa fa-envelope';
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__( 'Content', 'cosmetics' ),
            ]
        );

        $this->add_control(
            'title',
            [
                'label'         =>  esc_html__( 'Tiêu Đề', 'cosmetics' ),
                'type'          =>  Controls_Manager::TEXT,
                'default'       =>  esc_html__( 'Liên Hệ', 'cosmetics' ),
                'label_block'   =>  true
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'list_icon',
            [
                'label'     =>  esc_html__( 'Icon', 'cosmetics' ),
                'type'      =>  Controls_Manager::ICON,
                'default'   =>  'fa fa-home',
            ]
        );

        $repeater->add_control(
            'list_title', [
                'label'         =>  esc_html__( 'Tiêu đề', 'cosmetics' ),
                'type'          =>  Controls_Manager::TEXT,
                'default'       =>  '23/124 Do Nha, Nam Từ Liêm, Hà Nội',
                'label_block'   =>  true,
            ]
        );

        $this->add_control(
            'list_contact',
            [
                'label'     =>  esc_html__( 'Danh sách liên hệ', 'cosmetics' ),
                'type'      =>  Controls_Manager::REPEATER,
                'fields'    =>  $repeater->get_controls(),
                'default'   =>  [
                    [
                        'list_icon'     =>  'fa fa-home',
                        'list_title'    =>  '23/124 Do Nha, Nam Từ Liêm, Hà Nội',
                    ],
                    [
                        'list_icon'     =>  'fa fa-phone',
                        'list_title'    =>  'Tổng đài: 1900 7013',
                    ],
                ],
                'title_field' => '{{{ list_title }}}',
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
                    '{{WRAPPER}} .element-contact_us .title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .element-contact_us .title',
            ]
        );

        $this->add_control(
            'border_color',
            [
                'label'     =>  __( 'Border Color', 'cosmetics' ),
                'type'      =>  Controls_Manager::COLOR,
                'selectors' =>  [
                    '{{WRAPPER}} .element-contact_us' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {

        $settings   =   $this->get_settings();
        $title      =   $settings['title']

    ?>

        <div class="element-contact-us">
            <?php if ( !empty( $title ) ) : ?>
                <h6 class="title">
                    <?php echo esc_html( $settings['title'] ); ?>
                </h6>
            <?php
            endif;

            if ( !empty( $settings['list_contact'] ) ) :
            ?>

            <div class="list-item">

                <?php foreach ( $settings['list_contact'] as $item ) : ?>

                    <div class="item">
                        <i class="<?php echo esc_attr( $item['list_icon'] ); ?>"></i>
                        <span class="item-text">
                            <?php echo esc_html( $item['list_title'] ); ?>
                        </span>
                    </div>

                <?php endforeach; ?>

            </div>
            <?php endif; ?>
        </div>

    <?php
    }

    protected function _content_template() {
    ?>

        <div class="element-contact-us">
            <# if ( settings.title ) { #>
                <h6 class="title">
                    {{{ settings.title }}}
                </h6>
            <# } #>

            <# if ( settings.list_contact.length ) { #>

                <div class="list-item">

                    <# _.each( settings.list_contact, function( item ) { #>

                    <div class="item">
                        <i class="{{ item.list_icon }}"></i>
                        <span class="item-text">
                            {{{ item.list_title }}}
                        </span>
                    </div>

                    <# }); #>

                </div>

            <# } #>
        </div>

    <?php
    }

}

Plugin::instance()->widgets_manager->register_widget_type( new cosmetics_widget_contact_us );