<?php
/**
 * Widget Name: Brand Product
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class cosmetics_brand_product_widget extends WP_Widget {

    /**
     * Widget setup.
     */

    public function __construct() {

        $cosmetics_social_widget_ops = array(
            'classname'     =>  'cosmetics_brand_product_widget',
            'description'   =>  'A widget brand product',
        );

        parent::__construct( 'cosmetics_brand_product_widget', 'Cosmetics: Thương hiệu', $cosmetics_social_widget_ops );

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

        $brand_ids    =   !empty( $instance['select_cat'] ) ? $instance['select_cat'] : array( '0' );

        if ( in_array( 0, $brand_ids ) ) :

            $brand_product = get_terms( array(
                'taxonomy'      =>  'brand_cat',
                'hide_empty'    =>  false,
            ) );

        else:

            $brand_product = get_terms( array(
                'taxonomy'  =>  'brand_cat',
                'include'   =>  $brand_ids
            ) );

        endif;

    ?>

        <div class="brand-product-widget">
            <?php foreach ( $brand_product  as $item ) : ?>

                <div class="list-brand">
                    <a href="<?php echo esc_url( get_term_link( $item->term_id, 'brand_cat' ) ); ?>">
                        <?php echo esc_html( $item->name ); ?>

                        <span class="count">
                            (<?php echo esc_html( $item->count ); ?>)
                        </span>
                    </a>
                </div>

            <?php endforeach; ?>
        </div>

    <?php



        echo $args['after_widget'];
    }

    /**
     * Outputs the options form on admin
     *
     * @param array $instance The widget options
     */
    function form( $instance ) {

        $defaults = array(
            'title' => 'Thương hiệu nổi bật',
        );

        $instance   =   wp_parse_args( (array) $instance, $defaults );
        $select_cat =   isset( $instance['select_cat'] ) ? $instance['select_cat'] : array( '0' );

        $terms = get_terms( array(
            'taxonomy'      =>  'brand_cat',
            'orderby'       =>  'id',
            'hide_empty'    =>  false,
        ) );

        ?>

        <!-- Widget Title: Text Input -->
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>">
                <?php esc_html_e( 'Title:', 'cosmetics' ); ?>
            </label>

            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:90%;" />
        </p>

        <!-- Start Select Brand Product -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'select_cat' ) ); ?>">
                <?php esc_attr_e( 'Select Brand Product:', 'cosmetics' ); ?>
            </label>

            <select id="<?php echo esc_attr( $this->get_field_id( 'select_cat' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'select_cat' ) ) . '[]'; ?>" class="widefat" size="10" multiple>

                <option value="0" <?php echo ( in_array( 0, $select_cat ) ? 'selected="selected"' : '' ); ?>>
                    <?php esc_html_e( 'All Brand', 'cosmetics' ); ?>
                </option>

                <?php
                if ( !empty( $terms ) ) :

                    foreach( $terms as $term_item ) :
                ?>
                        <option value="<?php echo $term_item->term_id; ?>" <?php echo ( in_array( $term_item->term_id, $select_cat ) ? 'selected="selected"' : '' ); ?>>
                            <?php echo esc_html( $term_item->name ) . ' (' . esc_html( $term_item->count ) . ')'; ?>
                        </option>
                <?php
                    endforeach;

                endif;
                ?>

            </select>
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
        $instance['select_cat'] =   $new_instance['select_cat'];

        return $instance;
    }

}

// Register social widget
function cosmetics_brand_product_widget_register() {
    register_widget( 'cosmetics_brand_product_widget' );
}

add_action( 'widgets_init', 'cosmetics_brand_product_widget_register' );