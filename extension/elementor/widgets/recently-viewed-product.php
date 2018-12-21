<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class cosmetics_widget_recently_viewed_product extends Widget_Base {

    public function get_categories() {
        return array( 'cosmetics_widgets' );
    }

    public function get_name() {
        return 'cosmetics-recently-viewed-product';
    }

    public function get_title() {
        return esc_html__( 'Sản phẩm đã xem', 'cosmetics' );
    }

    public function get_icon() {
        return 'fa fa-shopping-basket';
    }

    protected function _register_controls() {

        /* Start Section Query */
        $this->start_controls_section(
            'section_query',
            [
                'label' =>  esc_html__( 'Query', 'cosmetics' )
            ]
        );

        $this->add_control(
            'limit',
            [
                'label'     =>  esc_html__( 'Sản phẩm lấy ra', 'cosmetics' ),
                'type'      =>  Controls_Manager::NUMBER,
                'default'   =>  12,
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
        /* End Section Query */

        /* Start Section Layout */
        $this->start_controls_section(
            'section_layout',
            [
                'label' =>  esc_html__( 'Layout', 'cosmetics' )
            ]
        );

        $this->add_control(
            'column_number',
            [
                'label'     =>  esc_html__( 'Số cột', 'dlk-addons-elementor' ),
                'type'      =>  Controls_Manager::SELECT,
                'default'   =>  4,
                'options'   =>  [
                    4   =>  esc_html__( '4 Column', 'dlk-addons-elementor' ),
                    3   =>  esc_html__( '3 Column', 'dlk-addons-elementor' ),
                    2   =>  esc_html__( '2 Column', 'dlk-addons-elementor' ),
                    1   =>  esc_html__( '1 Column', 'dlk-addons-elementor' ),
                ],
            ]
        );

        $this->end_controls_section();
        /* End Section Layout */

    }

    protected function render() {

        $settings       =   $this->get_settings_for_display();

        $viewed_products = ! empty( $_COOKIE['woocommerce_recently_viewed'] ) ? (array) explode( '|', wp_unslash( $_COOKIE['woocommerce_recently_viewed'] ) ) : array();
        $viewed_products = array_reverse( array_filter( array_map( 'absint', $viewed_products ) ) );

    ?>

        <div class="element-recently-viewed-product">
            <?php

            if ( !empty( $viewed_products ) ) :

                if ( $settings['column_number'] == 4 ) :
                    $class_column_number = 'col-xl-3';
                elseif ( $settings['column_number'] == 3 ) :
                    $class_column_number = 'col-xl-4';
                elseif ( $settings['column_number'] == 2 ) :
                    $class_column_number = 'col-xl-6';
                else:
                    $class_column_number = 'col-xl-12';
                endif;

                $args = array(
                    'posts_per_page' => $settings['limit'],
                    'no_found_rows'  => 1,
                    'post_status'    => 'publish',
                    'post_type'      => 'product',
                    'post__in'       => $viewed_products,
                    'orderby'        => $settings['order_by'],
                    'order'          => $settings['order'],
                );

                $query = new \ WP_Query( $args );
            ?>

                <div class="row">
                    <?php
                    while ( $query->have_posts() ) :
                        $query->the_post();
                    ?>

                        <div class="<?php echo esc_attr( $class_column_number ); ?> col-lg-3 col-md-4 col-sm-6 col-6">
                            <div class="site-shop__product--item">
                                <div class="site-shop__product--item-image item-thumbnail">
                                    <?php do_action( 'woo_elementor_product_sale_flash' ); ?>

                                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                        <?php the_post_thumbnail( 'medium_large' ); ?>
                                    </a>

                                    <?php cosmetics_woo_loop_add_to_cart(); ?>
                                </div>

                                <div class="site-shop__product--item-content">
                                    <h3 class="title-product">
                                        <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h3>

                                    <?php woocommerce_template_loop_price(); ?>
                                </div>
                            </div>
                        </div>

                    <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>

            <?php else: ?>

                <span class="none-viewed-product d-block text-center">
                    <?php esc_html_e( 'Bạn chưa xem sản phẩm nào', 'cosmetics' ); ?>
                </span>

            <?php endif; ?>
        </div>

    <?php


    }

}

Plugin::instance()->widgets_manager->register_widget_type( new cosmetics_widget_recently_viewed_product );