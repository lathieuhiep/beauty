<?php

/* Option Metabox Post */
add_action( 'cmb2_admin_init', 'beauty_option_metaboxes' );

function beauty_option_metaboxes() {

    /**
     * Initiate the metabox
     */
    $beauty_metabox_post = new_cmb2_box( array(
        'id'            => 'beauty_metabox_post',
        'title'         => __( 'Test Metabox', 'beauty' ),
        'object_types'  => array( 'post', ),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true,
    ) );

    // Regular text field
    $beauty_metabox_post->add_field( array(
        'name'       => __( 'Test Text', 'beauty' ),
        'desc'       => __( 'field description (optional)', 'beauty' ),
        'id'         => 'beauty_metabox_post_text',
        'type'       => 'text',
        'show_on_cb' => 'cmb2_hide_if_no_cats',
    ) );

    // URL text field
    $beauty_metabox_post->add_field( array(
        'name' => __( 'Website URL', 'beauty' ),
        'desc' => __( 'field description (optional)', 'beauty' ),
        'id'   => 'beauty_metabox_post_url',
        'type' => 'text_url',
    ) );

    // Email text field
    $beauty_metabox_post->add_field( array(
        'name' => __( 'Test Text Email', 'beauty' ),
        'desc' => __( 'field description (optional)', 'beauty' ),
        'id'   => 'beauty_metabox_post_email',
        'type' => 'text_email',
    ) );

    // Group
    $beauty_metabox_post_group_id = $beauty_metabox_post->add_field( array(
        'id'          => 'wiki_test_repeat_group',
        'type'        => 'group',
        'description' => __( 'Generates reusable form entries', 'beauty' ),
        // 'repeatable'  => false, // use false if you want non-repeatable group
        'options'     => array(
            'group_title'   => __( 'Entry {#}', 'beauty' ), // since version 1.1.4, {#} gets replaced by row number
            'add_button'    => __( 'Add Another Entry', 'beauty' ),
            'remove_button' => __( 'Remove Entry', 'beauty' ),
            'sortable'      => true, // beta
            'closed'        => true
        ),
    ) );

    $beauty_metabox_post->add_group_field( $beauty_metabox_post_group_id, array(
        'name' => 'Entry Title',
        'id'   => 'title',
        'type' => 'text',
        // 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
    ) );

    $beauty_metabox_post->add_group_field( $beauty_metabox_post_group_id, array(
        'name' => 'Description',
        'description' => 'Write a short description for this entry',
        'id'   => 'description',
        'type' => 'textarea_small',
    ) );

    $beauty_metabox_post->add_group_field( $beauty_metabox_post_group_id, array(
        'name' => 'Entry Image',
        'id'   => 'image',
        'type' => 'file',
    ) );

    $beauty_metabox_post->add_group_field( $beauty_metabox_post_group_id, array(
        'name' => 'Image Caption',
        'id'   => 'image_caption',
        'type' => 'text',
    ) );

}