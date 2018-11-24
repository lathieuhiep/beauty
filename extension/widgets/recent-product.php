<?php
/**
 * Widget Name: Recent Product
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class cosmetics_recent_product_widget extends WP_Widget {

    /**
     * Widget setup.
     */

    public function __construct() {

        $widget_ops = array(
            'classname'     =>  'cosmetics_recent_product_widget',
            'description'   =>  esc_html__( 'A widget show product', 'cosmetics' ),
        );

        parent::__construct( 'cosmetics_recent_product_widget', 'Cosmetics Theme: Recent Product', $widget_ops );

    }

    /**
     * Outputs the content of the widget
     *
     * @param array $args
     * @param array $instance
     */
    function widget( $args, $instance ) {

        echo $args['before_widget'];

        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }

        $limit      =   isset( $instance['number'] ) ? $instance['number'] : 5;

        $product_arg = array(
            'post_type'             =>  'product',
            'posts_per_page'        =>  $limit,
            'orderby'               =>  $instance['order_by'],
            'order'                 =>  $instance['order'],
        );

        $product_query   =   new WP_Query( $product_arg );

        if ( $product_query->have_posts() ) :

        ?>

            <div class="product_widget_warp">
                <?php
                while ( $product_query->have_posts() ) :
                    $product_query->the_post();
                ?>

                    <div class="item d-flex">
                        <div class="item-image">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                <?php
                                do_action( 'woo_elementor_product_sale_flash' );

                                if( has_post_thumbnail() ):
                                    the_post_thumbnail( 'medium' );
                                else:
                                    ?>
                                    <img src="<?php echo esc_url( get_theme_file_uri( '/images/no-image.png' ) ); ?>" alt="post">
                                <?php endif; ?>
                            </a>
                        </div>

                        <div class="item-content">
                            <h4 class="item-title">
                                <a href="<?php the_permalink(); ?>" title="<?php the_title() ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h4>

                            <?php woocommerce_template_loop_price(); ?>
                        </div>
                    </div>

                <?php
                endwhile;
                wp_reset_postdata();
                ?>
            </div>

        <?php
        endif;

        echo $args['after_widget'];
    }

    /**
     * Outputs the options form on admin
     *
     * @param array $instance The widget options
     */
    function form( $instance ) {

        $defaults = array(
            'title' => 'Recent Product',
        );

        $instance = wp_parse_args( (array) $instance, $defaults );

        $number     =   isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
        $order      =   isset( $instance['order'] ) ? $instance['order'] : 'DESC';
        $order_by   =   isset( $instance['order_by'] ) ? $instance['order_by'] : 'ID';

        ?>

        <!-- Widget Title: Text Input -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
                <?php esc_html_e( 'Title:', 'cosmetics' ); ?>
            </label>

            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
        </p>

        <!-- Start Order -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>">
                <?php esc_html_e( 'Order:', 'cosmetics' ); ?>
            </label>

            <select id="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>" name="<?php echo $this->get_field_name('order') ?>" class="widefat">
                <option value="DESC" <?php echo ( $order == 'DESC' ) ? 'selected' : ''; ?>>
                    <?php esc_html_e( 'DESC', 'cosmetics' ); ?>
                </option>

                <option value="ASC" <?php echo ( $order == 'ASC' ) ? 'selected' : ''; ?>>
                    <?php esc_html_e( 'ASC', 'cosmetics' ); ?>
                </option>
            </select>
        </p>

        <!-- Start OrderBy -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'order_by' ) ); ?>">
                <?php esc_html_e( 'Order:', 'cosmetics' ); ?>
            </label>

            <select id="<?php echo esc_attr( $this->get_field_id( 'order_by' ) ); ?>" name="<?php echo $this->get_field_name('order_by') ?>" class="widefat">
                <option value="ID" <?php echo ( $order_by == 'ID' ) ? 'selected' : ''; ?>>
                    <?php esc_html_e( 'ID', 'cosmetics' ); ?>
                </option>

                <option value="date" <?php echo ( $order_by == 'date' ) ? 'selected' : ''; ?>>
                    <?php esc_html_e( 'Date', 'cosmetics' ); ?>
                </option>

                <option value="title" <?php echo ( $order_by == 'title' ) ? 'selected' : ''; ?>>
                    <?php esc_html_e( 'Title', 'cosmetics' ); ?>
                </option>

                <option value="rand" <?php echo ( $order_by == 'rand' ) ? 'selected' : ''; ?>>
                    <?php esc_html_e( 'Rand', 'cosmetics' ); ?>
                </option>
            </select>
        </p>

        <!-- Start Number Post Show -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>">
                <?php esc_html_e( 'Number of product to show:', 'cosmetics' ); ?>
            </label>

            <input id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" class="tiny-text" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="number" step="1" min="1" value="<?php echo esc_attr( $number ); ?>" size="3" />
        </p>

        <?php

    }

    /**
     * Processing widget options on save
     *
     * @param array $new_instance The new options
     * @param array $old_instance The previous options
     *
     * @return array
     */
    function update( $new_instance, $old_instance ) {
        $instance = array();

        $instance['title']      =   strip_tags( $new_instance['title'] );
        $instance['order']      =   $new_instance['order'];
        $instance['order_by']   =   $new_instance['order_by'];
        $instance['number']     =   (int) $new_instance['number'];

        return $instance;
    }

}

// Register widget
function cosmetics_recent_product_widget_register() {
    register_widget( 'cosmetics_recent_product_widget' );
}

add_action( 'widgets_init', 'cosmetics_recent_product_widget_register' );