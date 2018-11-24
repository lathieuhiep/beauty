<?php
/**
 * Widget Name: Cam Ket
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class cosmetics_cam_ket_widget extends WP_Widget {

    /**
     * Widget setup.
     */

    public function __construct() {

        $cosmetics_social_widget_ops = array(
            'classname'     =>  'cosmetics_cam_ket_widget',
            'description'   =>  'A widget cam_ket',
        );

        parent::__construct( 'cosmetics_cam_ket_widget', 'Cosmetics: Cam Kết', $cosmetics_social_widget_ops );

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

        global $cosmetics_options;
        $cosmetics_cam_ket_list = $cosmetics_options['cosmetics_cam_ket_list'];

        if ( !empty( $cosmetics_cam_ket_list ) ) :

    ?>

        <div class="cam-ket-widget">
            <?php foreach ( $cosmetics_cam_ket_list as $item ) : ?>
                <div class="list d-flex">
                    <div class="item-image">
                        <?php echo wp_get_attachment_image( $item['attachment_id'], 'full' ); ?>
                    </div>

                    <div class="item-content">
                        <h3 class="item-name">
                            <?php echo esc_html( $item['title'] ); ?>
                        </h3>

                        <p class="item-description">
                            <?php echo wp_kses_post( $item['description'] ); ?>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
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
            'title' => 'Chất lượng cho tất cả',
        );

        $instance = wp_parse_args( (array) $instance, $defaults ); ?>

        <!-- Widget Title: Text Input -->
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>">
                <?php esc_html_e( 'Title:', 'cosmetics' ); ?>
            </label>

            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:90%;" />
        </p>

        <p>
            <?php esc_html_e( 'Note: Thiết lập cam kết trong Cosmetics Options', 'cosmetics' ); ?>
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

        $instance['title']  =   strip_tags( $new_instance['title'] );

        return $instance;
    }

}

// Register social widget
function cosmetics_cam_ket_widget_register() {
    register_widget( 'cosmetics_cam_ket_widget' );
}

add_action( 'widgets_init', 'cosmetics_cam_ket_widget_register' );