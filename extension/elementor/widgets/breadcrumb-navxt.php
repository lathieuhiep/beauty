<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class cosmetics_widget_breadcrumb_navxt extends Widget_Base {

    public function get_categories() {
        return array( 'cosmetics_widgets' );
    }

    public function get_name() {
        return 'cosmetics-breadcrumb-navxt';
    }

    public function get_title() {
        return esc_html__( 'Breadcrumb Navxt', 'cosmetics' );
    }

    public function get_icon() {
        return 'eicon-product-breadcrumbs';
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__( 'Content', 'cosmetics' ),
            ]
        );

        $this->end_controls_section();


    }

    protected function render() {

        $settings   =   $this->get_settings();

        get_template_part( 'template-parts/breadcrumb/inc','breadcrumb' );

    }

    protected function _content_template() {}

}

Plugin::instance()->widgets_manager->register_widget_type( new cosmetics_widget_breadcrumb_navxt );