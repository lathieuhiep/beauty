<?php

/* Option Metabox Post */
add_action( 'cmb2_admin_init', 'cosmetics_option_metaboxes' );

function cosmetics_option_metaboxes() {

    /**
     * Initiate the metabox
     */
    $cosmetics_metabox_post = new_cmb2_box( array(
        'id'            => 'cosmetics_metabox_post',
        'title'         => __( 'Test Metabox', 'cosmetics' ),
        'object_types'  => array( 'post', ),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true,
    ) );

    // Regular text field
    $cosmetics_metabox_post->add_field( array(
        'name'       => __( 'Test Text', 'cosmetics' ),
        'desc'       => __( 'field description (optional)', 'cosmetics' ),
        'id'         => 'cosmetics_metabox_post_text',
        'type'       => 'text',
        'show_on_cb' => 'cmb2_hide_if_no_cats',
    ) );

    // URL text field
    $cosmetics_metabox_post->add_field( array(
        'name' => __( 'Website URL', 'cosmetics' ),
        'desc' => __( 'field description (optional)', 'cosmetics' ),
        'id'   => 'cosmetics_metabox_post_url',
        'type' => 'text_url',
    ) );

    // Email text field
    $cosmetics_metabox_post->add_field( array(
        'name' => __( 'Test Text Email', 'cosmetics' ),
        'desc' => __( 'field description (optional)', 'cosmetics' ),
        'id'   => 'cosmetics_metabox_post_email',
        'type' => 'text_email',
    ) );

    // Group
    $cosmetics_metabox_post_group_id = $cosmetics_metabox_post->add_field( array(
        'id'          => 'wiki_test_repeat_group',
        'type'        => 'group',
        'description' => __( 'Generates reusable form entries', 'cosmetics' ),
        // 'repeatable'  => false, // use false if you want non-repeatable group
        'options'     => array(
            'group_title'   => __( 'Entry {#}', 'cosmetics' ), // since version 1.1.4, {#} gets replaced by row number
            'add_button'    => __( 'Add Another Entry', 'cosmetics' ),
            'remove_button' => __( 'Remove Entry', 'cosmetics' ),
            'sortable'      => true, // beta
            'closed'        => true
        ),
    ) );

    $cosmetics_metabox_post->add_group_field( $cosmetics_metabox_post_group_id, array(
        'name' => 'Entry Title',
        'id'   => 'title',
        'type' => 'text',
        // 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
    ) );

    $cosmetics_metabox_post->add_group_field( $cosmetics_metabox_post_group_id, array(
        'name' => 'Description',
        'description' => 'Write a short description for this entry',
        'id'   => 'description',
        'type' => 'textarea_small',
    ) );

    $cosmetics_metabox_post->add_group_field( $cosmetics_metabox_post_group_id, array(
        'name' => 'Entry Image',
        'id'   => 'image',
        'type' => 'file',
    ) );

    $cosmetics_metabox_post->add_group_field( $cosmetics_metabox_post_group_id, array(
        'name' => 'Image Caption',
        'id'   => 'image_caption',
        'type' => 'text',
    ) );

}