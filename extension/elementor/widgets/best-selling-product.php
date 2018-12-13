<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class cosmetics_widget_products_best_selling extends Widget_Base {

    public function get_categories() {
        return array( 'cosmetics_widgets' );
    }

    public function get_name() {
        return 'cosmetics-products-best-selling';
    }

    public function get_title() {
        return esc_html__( 'Sản phẩm bán chạy', 'cosmetics' );
    }

    public function get_icon() {
        return 'fa fa-shopping-basket';
    }

    protected function _register_controls() {

        /* Start Section Heading */
        $this->start_controls_section(
            'section_heading',
            [
                'label' =>  esc_html__( 'Heading', 'cosmetics' )
            ]
        );

        $this->add_control(
            'image_heading',
            [
                'label'     =>  esc_html__( 'Image', 'cosmetics' ),
                'type'      =>  Controls_Manager::MEDIA,
                'default'   =>  [
                    'url'   =>  Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'link_heading',
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
            'heading',
            [
                'label'         =>  esc_html__( 'Tiêu đề', 'cosmetics' ),
                'type'          =>  Controls_Manager::TEXT,
                'default'       =>  esc_html__( 'Top 100 bán chạy', 'cosmetics' ),
                'label_block'   =>  true
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'list_top_title', [
                'label'         =>  esc_html__( 'Tiêu đề', 'cosmetics' ),
                'type'          =>  Controls_Manager::TEXT,
                'default'       =>  esc_html__( 'Sản phẩm bán chạy' , 'cosmetics' ),
                'label_block'   =>  true,
            ]
        );

        $repeater->add_control(
            'list_link_top',
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
                'label'     =>  esc_html__( 'Nhóm sản phẩm bán chạy', 'cosmetics' ),
                'type'      =>  Controls_Manager::REPEATER,
                'fields'    =>  $repeater->get_controls(),
                'default'   =>  [
                    [
                        'list_top_title'    =>  esc_html__( 'Trang điểm', 'cosmetics' ),
                        'list_link_top'     =>  '#',
                    ],
                    [
                        'list_top_title'    =>  esc_html__( 'Chăm sóc da', 'cosmetics' ),
                        'list_link_top'     =>  '#',
                    ],
                ],
                'title_field' => '{{{ list_top_title }}}',
            ]
        );

        $this->end_controls_section();
        /* End Section Heading */

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
            'total_sales_product',
            [
                'label'     =>  esc_html__( 'Tổng sản phẩm bán', 'cosmetics' ),
                'type'      =>  Controls_Manager::NUMBER,
                'default'   =>  1,
                'min'       =>  0,
                'max'       =>  300,
                'step'      =>  1,
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
                'default'   =>  6,
                'options'   =>  [
                    6   =>  esc_html__( '6 Column', 'dlk-addons-elementor' ),
                    5   =>  esc_html__( '5 Column', 'dlk-addons-elementor' ),
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

        $settings   =   $this->get_settings_for_display();
        $limit      =   $settings['limit'];
        $target     =   $settings['link_heading']['is_external'] ? ' target="_blank"' : '';
        $nofollow   =   $settings['link_heading']['nofollow'] ? ' rel="nofollow"' : '';

        $args = array(
            'post_type'         =>  'product',
            'posts_per_page'    =>  $limit,
            'orderby'           =>  'meta_value_num',
            'order'             =>  'DESC',
            'meta_query' => array(
                array(
                    'key'     => 'total_sales',
                    'value'   => $settings['total_sales_product'],
                    'compare' => '>=',
                    'type'    => 'NUMERIC',
                ),
            ),
        );

        $query = new \ WP_Query( $args );

        if ( $query->have_posts() ) :

            if ( $settings['column_number'] == 6 ) :
                $class_column_number = 'column-6 col-xl-2';
            elseif ( $settings['column_number'] == 5 ) :
                $class_column_number = 'column-5';
            elseif ( $settings['column_number'] == 4 ) :
                $class_column_number = 'column-4 col-xl-3';
            elseif ( $settings['column_number'] == 3 ) :
                $class_column_number = 'column-3 col-xl-4';
            elseif ( $settings['column_number'] == 2 ) :
                $class_column_number = 'column-2 col-xl-6';
            else:
                $class_column_number = 'column-1 col-xl-12';
            endif;

    ?>

       <div class="element-best-selling-product element-product-grid element-product-style">
           <div class="top-block d-flex">
               <div class="top-block__heading d-flex align-items-center">
                   <?php echo wp_get_attachment_image( $settings['image_heading']['id'], 'full' ); ?>

                   <h4 class="heading">
                       <a href="<?php echo esc_url( $settings['link_heading']['url'] ); ?>" title="<?php echo esc_attr( $settings['heading'] ); ?>"<?php echo $target . $nofollow ; ?>>
                           <?php echo esc_html( $settings['heading'] ); ?>
                       </a>
                   </h4>

                   <i class="fas fa-chevron-right"></i>
               </div>

                <?php if ( $settings['list'] ) : ?>

                   <div class="top-block__list d-flex">
                       <?php
                       foreach ( $settings['list'] as $item ) :
                           $item_target     =   $item['list_link_top']['is_external'] ? ' target="_blank"' : '';
                           $item_nofollow   =   $item['list_link_top']['nofollow'] ? ' rel="nofollow"' : '';
                       ?>

                           <div class="list-item d-flex align-items-center">
                               <a href="<?php echo esc_url( $item['list_link_top']['url'] ); ?>" title="<?php echo esc_attr( $item['list_top_title'] ); ?>"<?php echo $item_target . $item_nofollow ; ?>>
                                   <?php echo esc_html( $item['list_top_title'] ); ?>
                               </a>
                           </div>

                       <?php endforeach; ?>
                   </div>

                <?php endif; ?>
           </div>

           <div class="row">
               <?php while ( $query->have_posts() ): $query->the_post(); ?>

                   <div class="item-col <?php echo esc_attr( $class_column_number ); ?> col-lg-3 col-md-4 col-sm-6 col-12">
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
                   </div>

               <?php
               endwhile; wp_reset_postdata();
               ?>
           </div>
       </div>

    <?php

        endif;
    }

}

Plugin::instance()->widgets_manager->register_widget_type( new cosmetics_widget_products_best_selling );