<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class cosmetics_widget_post_type extends Widget_Base {

    public function get_categories() {
        return array( 'cosmetics_widgets' );
    }

    public function get_name() {
        return 'cosmetics-post-type';
    }

    public function get_title() {
        return esc_html__( 'Bài viết', 'cosmetics' );
    }

    public function get_icon() {
        return ' eicon-post';
    }

    public function get_script_depends() {
        return ['cosmetics-elementor-custom'];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_post_type',
            [
                'label' =>  esc_html__( 'Bài viết', 'cosmetics' )
            ]
        );

        $this->add_control(
            'heading',
            [
                'label'         =>  esc_html__( 'Tiêu đề', 'cosmetics' ),
                'type'          =>  Controls_Manager::TEXT,
                'default'       =>  esc_html__( 'THÔNG TIN NỔI BẬT', 'cosmetics' ),
                'label_block'   =>  true
            ]
        );

        $this->add_control(
            'select_cat',
            [
                'label'         =>  esc_html__( 'Chọn danh mục', 'cosmetics' ),
                'type'          =>  Controls_Manager::SELECT2,
                'options'       =>  cosmetics_check_get_cat( 'category' ),
                'multiple'      =>  true,
                'label_block'   =>  true
            ]
        );

        $this->add_control(
            'limit',
            [
                'label'     =>  esc_html__( 'Số bài viết lấy ra', 'cosmetics' ),
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
                    'id'            =>  esc_html__( 'ID', 'cosmetics' ),
                    'title'         =>  esc_html__( 'Tên sản phẩm', 'cosmetics' ),
                    'date'          =>  esc_html__( 'Ngày đăng', 'cosmetics' ),
                    'rand'          =>  esc_html__( 'Random', 'cosmetics' ),
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

        $this->add_control(
            'excerpt_length',
            [
                'label'     =>  esc_html__( 'Excerpt Words', 'cosmetics' ),
                'type'      =>  Controls_Manager::NUMBER,
                'default'   =>  '22',
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
                'label'     =>  esc_html__( 'Bài viết trên một hàng( Desktop )', 'event_conference' ),
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
                'label'     =>  esc_html__( 'Bài viết trên một hàng( Tablet )', 'event_conference' ),
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
                'label'     =>  esc_html__( 'Bài viết trên một hàng( Mobile )', 'event_conference' ),
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

        if ( !empty( $select_cat ) ) :

            $cosmetics_post_type_arg = array(
                'post_type'         =>  'post',
                'posts_per_page'    =>  $limit,
                'orderby'           =>  $order_by,
                'order'             =>  $order,
                'cat'               =>  $select_cat
            );

        else:

            $cosmetics_post_type_arg = array(
                'post_type'         =>  'post',
                'posts_per_page'    =>  $limit,
                'orderby'           =>  $order_by,
                'order'             =>  $order,
            );

        endif;

        $cosmetics_post_type_query = new \ WP_Query( $cosmetics_post_type_arg );

        if ( $cosmetics_post_type_query->have_posts() ) :

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

        <div class="element-post-type">
            <h4 class="element-heading-global">
                <span>
                    <?php echo esc_html( $settings['heading'] ); ?>
                </span>
            </h4>

            <div class="element-post-carousel owl-nav-top owl-carousel owl-theme" data-settings='<?php echo esc_attr( wp_json_encode( $settings_data ) ); ?>'>
                <?php while ( $cosmetics_post_type_query->have_posts() ): $cosmetics_post_type_query->the_post(); ?>

                    <div class="item-post">
                        <div class="item-post__image">
                            <?php
                            if ( has_post_thumbnail() ) :
                                the_post_thumbnail( 'large' );
                            else:
                            ?>

                                <img src="<?php echo esc_url( get_theme_file_uri( '/images/no-image.png' ) ) ?>" alt="<?php the_title(); ?>" />

                            <?php endif; ?>
                        </div>

                        <div class="item-post__detail">
                            <h4 class="item-post__title text-center">
                                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h4>

                            <div class="item-post__des">
                                <p>
                                    <?php
                                    if ( has_excerpt() ) :
                                        echo esc_html( wp_trim_words( get_the_excerpt(), $settings['excerpt_length'], '...' ) );
                                    else:
                                        echo esc_html( wp_trim_words( get_the_content(), $settings['excerpt_length'], '...' ) );
                                    endif;
                                    ?>
                                </p>
                            </div>
                        </div>
                    </div>

                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>

    <?php

        endif;
    }

}

Plugin::instance()->widgets_manager->register_widget_type( new cosmetics_widget_post_type );