<?php

add_filter( 'rwmb_meta_boxes', 'beauty_register_meta_boxes' );

function beauty_register_meta_boxes() {

    /* Start meta box post */
    $beauty_meta_boxes[] = array(
        'id'         => 'post_format_option',
        'title'      => esc_html__( 'Post Format', 'beauty' ),
        'post_types' => array( 'post' ),
        'context'    => 'normal',
        'priority'   => 'high',
        'fields' => array(

            array(
                'id'               => 'beauty_gallery_post',
                'name'             => 'Gallery',
                'type'             => 'image_advanced',
                'force_delete'     => false,
                'max_status'       => false,
                'image_size'       => 'thumbnail',
            ),

            array(
                'id'            => 'beauty_video_post',
                'name'          => 'Video Or Audio',
                'type'          => 'oembed',
            ),


        )
    );
    /* End meta box post */

    return $beauty_meta_boxes;

}