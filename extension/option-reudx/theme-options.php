<?php
/**
 * ReduxFramework Config File
 */
if ( ! class_exists( 'Redux' ) ) {
    return;
}


// This is your option name where all the Redux data is stored.
$cosmetics_opt_name = "cosmetics_options";

/**
 * ---> SET ARGUMENTS
 * All the possible arguments for Redux.
 * */

$cosmetics_theme = wp_get_theme(); // For use with some settings. Not necessary.

$cosmetics_opt_args = array(

    'opt_name'             => $cosmetics_opt_name,
    // This is where your data is stored in the database and also becomes your global variable name.
    'display_name'         => $cosmetics_theme->get( 'Name' ),
    // Name that appears at the top of your panel
    'display_version'      => $cosmetics_theme->get( 'Version' ),
    // Version that appears at the top of your panel
    'menu_type'            => 'menu',
    //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
    'allow_sub_menu'       => false,
    // Show the sections below the admin menu item or not
    'menu_title'           => $cosmetics_theme->get( 'Name' ) . esc_html__(' Options', 'cosmetics'),
    'page_title'           => $cosmetics_theme->get( 'Name' ) . esc_html__(' Options', 'cosmetics'),
    // You will need to generate a Google API key to use this feature.
    // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
    'google_api_key'       => '',
    // Set it you want google fonts to update weekly. A google_api_key value is required.
    'google_update_weekly' => false,
    // Must be defined to add google fonts to the typography module
    'async_typography'     => true,
    // Use a asynchronous font on the front end or font string
    //'disable_google_fonts_link' => true,
    'admin_bar'            => true,
    // Show the panel pages on the admin bar
    'admin_bar_icon'       => 'dashicons-portfolio',
    // Choose an icon for the admin bar menu
    'admin_bar_priority'   => 50,
    // Choose an priority for the admin bar menu
    'global_variable'      => '',
    // Set a different name for your global variable other than the opt_name
    'dev_mode'             => false,
    // Show the time the page took to load, etc
    'update_notice'        => false,
    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
    'customizer'           => true,

    // OPTIONAL -> Give you extra features
    'page_priority'        => 2,
    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
    'page_parent'          => 'themes.php',
    // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
    'page_permissions'     => 'manage_options',
    // Permissions needed to access the options panel.
    'menu_icon'            => '',
    // Specify a custom URL to an icon
    'last_tab'             => '',
    // Force your panel to always open to a specific tab (by id)
    'page_icon'            => 'icon-themes',
    // Icon displayed in the admin panel next to your menu_title
    'page_slug'            => '',
    // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
    'save_defaults'        => true,
    // On load save the defaults to DB before user clicks save or not
    'default_show'         => false,
    // If true, shows the default value next to each field that is not the default value.
    'default_mark'         => '',
    // What to print by the field's title if the value shown is default. Suggested: *
    'show_import_export'   => true,
    // Shows the Import/Export panel when not used as a field.

    // CAREFUL -> These options are for advanced use only
    'transient_time'       => 60 * MINUTE_IN_SECONDS,
    'output'               => true,
    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
    'output_tag'           => true,
    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
    // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
    'database'             => '',
    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
    'use_cdn'              => true,
    // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

    // HINTS
    'hints'             =>  array(
        'icon'          => 'el el-question-sign',
        'icon_position' => 'right',
        'icon_color'    => 'lightgray',
        'icon_size'     => 'normal',
        'tip_style'     =>  array(
            'color'     => 'red',
            'shadow'    =>  true,
            'rounded'   =>  false,
            'style'     =>  '',
        ),
        'tip_position'  =>  array(
            'my'        =>  'top left',
            'at'        =>  'bottom right',
        ),
        'tip_effect'    =>  array(
            'show'      =>  array(
                'effect'    =>  'slide',
                'duration'  =>  '500',
                'event'     =>  'mouseover',
            ),
            'hide'  =>  array(
                'effect'    =>  'slide',
                'duration'  =>  '500',
                'event'     =>  'click mouseleave',
            ),
        ),
    )
);
Redux::setArgs( $cosmetics_opt_name, $cosmetics_opt_args );
/*
 * ---> END ARGUMENTS
 */

/*
 * ---> START HELP TABS
 */

$cosmetics_opt_tabs = array(
    array(
        'id'        =>  'redux-help-tab-1',
        'title'     =>  esc_html__( 'Theme Information 1', 'cosmetics' ),
        'content'   =>  esc_html__( '<p>This is the tab content, HTML is allowed.</p>', 'cosmetics' )
    ),
    array(
        'id'        =>  'redux-help-tab-2',
        'title'     =>  esc_html__( 'Theme Information 2', 'cosmetics' ),
        'content'   =>  esc_html__( '<p>This is the tab content, HTML is allowed.</p>', 'cosmetics' )
    )
);
Redux::setHelpTab( $cosmetics_opt_name, $cosmetics_opt_tabs );

// Set the help sidebar
$cosmetics_opt_content = esc_html__( '<p>This is the sidebar content, HTML is allowed.</p>', 'cosmetics' );
Redux::setHelpSidebar( $cosmetics_opt_name, $cosmetics_opt_content );


/*
 * <--- END HELP TABS
 */

/*
 *
 * ---> START SECTIONS
 *
 */

// -> START option background

Redux::setSection( $cosmetics_opt_name, array(
    'id'                =>   'cosmetics_theme_option',
    'title'             =>   $cosmetics_theme->get( 'Name' ).' '.$cosmetics_theme->get( 'Version' ),
    'customizer_width'  =>   '400px',
    'icon'              =>   '',
));

// -> END option background

/* Start General Options */

Redux::setSection( $cosmetics_opt_name, array(
    'title'             =>  esc_html__( 'General Options', 'cosmetics' ),
    'id'                =>  'cosmetics_general',
    'desc'              =>  esc_html__( 'General all config', 'cosmetics' ),
    'customizer_width'  =>  '400px',
    'icon'              =>  'el el-th-large',
));

// Favicon Config
Redux::setSection( $cosmetics_opt_name, array(
    'title'         =>  esc_html__( 'Favicon', 'cosmetics' ),
    'id'            =>  'cosmetics_favicon_config',
    'desc'          =>  esc_html__( '', 'cosmetics' ),
    'subsection'    =>  true,
    'fields'        =>  array(
        array(
            'id'        =>  'cosmetics_favicon_upload',
            'type'      =>  'media',
            'url'       =>  true,
            'title'     =>  esc_html__( 'Upload Favicon Image', 'cosmetics' ),
            'subtitle'  =>  esc_html__( 'Favicon image for your website', 'cosmetics' ),
            'desc'      =>  esc_html__( '', 'cosmetics' ),
            'default'   =>  false,
        ),
    )
));

//Loading config
Redux::setSection( $cosmetics_opt_name, array(
    'title'         =>  esc_html__( 'Loading config', 'cosmetics' ),
    'id'            =>  'cosmetics_general_loading',
    'desc'          =>  esc_html__( '', 'cosmetics' ),
    'subsection'    =>  true,
    'fields'        =>  array(
        array(
            'id'        =>  'cosmetics_general_show_loading',
            'type'      =>  'switch',
            'title'     =>  esc_html__( 'Loading On/Off', 'cosmetics' ),
            'default'   =>  false,
        ),
        array(
            'id'        =>  'cosmetics_general_image_loading',
            'type'      =>  'media',
            'url'       =>  true,
            'title'     =>  esc_html__( 'Upload image loading', 'cosmetics' ),
            'subtitle'  =>  esc_html__( 'Upload image .gif', 'cosmetics' ),
            'default'   =>  '',
            'required'  =>  array( 'cosmetics_general_show_loading', '=', true ),
        ),
    )
));

//Background Options
Redux::setSection( $cosmetics_opt_name, array(
    'title'             =>  esc_html__( 'Background', 'cosmetics' ),
    'id'                =>  'cosmetics_background',
    'desc'              =>  esc_html__( 'Background all config', 'cosmetics' ),
    'customizer_width'  =>  '400px',
    'subsection'        => true,
    'fields'            => array(
        array(
            'id'        =>  'cosmetics_background_body',
            'output'    =>  'body',
            'type'      =>  'background',
            'clone'     =>  'true',
            'title'     =>  esc_html__( 'Body background', 'cosmetics' ),
            'subtitle'  =>  esc_html__( 'Body background with image, color, etc.', 'cosmetics' ),
            'hint'      =>  array(
                'content'   =>  'This is a <b>hint</b> tool-tip for the text field.<br/><br/>Add any HTML based text you like here.',
            )
        ),
    ),
));

/* End General Options */

/* Start Header Options */
Redux::setSection( $cosmetics_opt_name, array(
    'title'             =>  esc_html__( 'Header Options', 'cosmetics' ),
    'id'                =>  'cosmetics_header',
    'desc'              =>  esc_html__( 'Header all config', 'cosmetics' ),
    'customizer_width'  =>  '400px',
    'icon'              =>  'el el-arrow-up',
));

//Logo Config
Redux::setSection( $cosmetics_opt_name, array(
    'title'         =>  esc_html__( 'Logo', 'cosmetics' ),
    'id'            =>  'cosmetics_logo_config',
    'desc'          =>  esc_html__( '', 'cosmetics' ),
    'subsection'    =>  true,
    'fields'        =>  array(

        array(
            'id'        =>  'cosmetics_logo_image',
            'type'      =>  'media',
            'url'       =>  true,
            'title'     =>  esc_html__( 'Upload logo', 'cosmetics' ),
            'subtitle'  =>  esc_html__( 'logo image for your website', 'cosmetics' ),
            'desc'      =>  esc_html__( '', 'cosmetics' ),
            'default'   =>  false,
        ),

        array(
            'id'                => 'cosmetics_logo_images_size',
            'type'              => 'dimensions',
            'units'             => array( 'em', 'px', '%' ),
            'title'             => esc_html__( 'Set width/height for logo', 'cosmetics' ),
            'subtitle'          => esc_html__( '', 'cosmetics' ),
            'units_extended'    => 'true',
            'default'           => array(
                'width'     =>  '',
                'height'    =>  '',
            ),
            'output'         => array('.site-logo img'),
        ),
    )
));

// information
Redux::setSection( $cosmetics_opt_name, array(
    'title'         =>  esc_html__( 'Information', 'cosmetics' ),
    'id'            =>  'cosmetics_information_config',
    'desc'          =>  esc_html__( '', 'cosmetics' ),
    'subsection'    =>  true,
    'fields'        =>  array(

        array(
            'id'        =>  'cosmetics_information_show_hide',
            'type'      =>  'select',
            'title'     =>  esc_html__( 'Show Or Hide Information', 'cosmetics' ),
            'default'   =>  1,
            'options'   =>  array(
                1   =>  esc_html__( 'Show', 'cosmetics' ),
                0   =>  esc_html__( 'Hide', 'cosmetics' )
            )
        ),

        array(
            'id'        =>  'cosmetics_information_address',
            'type'      =>  'text',
            'title'     =>  esc_html__( 'Address', 'cosmetics' ),
            'default'   =>  '988782, Our Street, S State.',
        ),

        array(
            'id'        =>  'cosmetics_information_mail',
            'type'      =>  'text',
            'title'     =>  esc_html__( 'Mail', 'cosmetics' ),
            'default'   =>  'info@domain.com',
        ),

        array(
            'id'        =>  'cosmetics_information_phone',
            'type'      =>  'text',
            'title'     =>  esc_html__( 'Phone', 'cosmetics' ),
            'default'   =>  '+1 234 567 186',
        ),

    )
));

/* End Header Options */

/* Start Page Option */

/* End Page Option */
Redux::setSection( $cosmetics_opt_name, array(
    'title'             =>  esc_html__( 'Page Default Options', 'cosmetics' ),
    'id'                =>  'cosmetics_page_default_option',
    'customizer_width'  =>  '400px',
    'icon'              =>  'el el-file-alt',
    'fields'            =>  array(

        array(
            'id'        =>  'cosmetics_page_default_show_breadcrumb',
            'type'      =>  'select',
            'title'     =>  esc_html__( 'Show Or Hide Breadcrumb', 'cosmetics' ),
            'default'   =>  1,
            'options'   =>  array(
                1   =>  esc_html__( 'Show', 'cosmetics' ),
                0   =>  esc_html__( 'Hide', 'cosmetics' )
            )
        ),

        array(
            'id'        =>  'cosmetics_page_default_sidebar',
            'type'      =>  'image_select',
            'title'     =>  esc_html__( 'Sidebar Page', 'cosmetics' ),
            'default'   =>  'right',
            'options'   =>  array(
                'hide' =>  array(
                    'alt'   =>  'None Sidebar',
                    'img'   =>  ReduxFramework::$_url . 'assets/img/1col.png'
                ),

                'left' =>  array(
                    'alt'   =>  'Sidebar Left',
                    'img'   =>  ReduxFramework::$_url . 'assets/img/2cl.png'
                ),

                'right' =>  array(
                    'alt'   =>  'Sidebar Right',
                    'img'   =>  ReduxFramework::$_url . 'assets/img/2cr.png'
                ),

            ),
        ),

    )
));
/* Start Blog Option */
Redux::setSection( $cosmetics_opt_name, array(
    'title'             =>  esc_html__( 'Blog Options', 'cosmetics' ),
    'id'                =>  'cosmetics_blog_option',
    'customizer_width'  =>  '400px',
    'icon'              =>  'el el-blogger',
    'fields'            =>  array(

        array(
            'id'        =>  'cosmetics_blog_sidebar_archive',
            'type'      =>  'image_select',
            'title'     =>  esc_html__( 'Sidebar Archive', 'cosmetics' ),
            'desc'      =>  esc_html__( 'Use for archive, index, page search', 'cosmetics' ),
            'default'   =>  'right',
            'options'   =>  array(
                'hide' =>  array(
                    'alt'   =>  'None Sidebar',
                    'img'   =>  ReduxFramework::$_url . 'assets/img/1col.png'
                ),

                'left' =>  array(
                    'alt'   =>  'Sidebar Left',
                    'img'   =>  ReduxFramework::$_url . 'assets/img/2cl.png'
                ),

                'right' =>  array(
                    'alt'   =>  'Sidebar Right',
                    'img'   =>  ReduxFramework::$_url . 'assets/img/2cr.png'
                ),

            ),
        ),

        array(
            'id'        =>  'cosmetics_blog_sidebar_single',
            'type'      =>  'image_select',
            'title'     =>  esc_html__( 'Sidebar Single', 'cosmetics' ),
            'default'   =>  'right',
            'options'   =>  array(
                'hide' =>  array(
                    'alt'   =>  'None Sidebar',
                    'img'   =>  ReduxFramework::$_url . 'assets/img/1col.png'
                ),

                'left' =>  array(
                    'alt'   =>  'Sidebar Left',
                    'img'   =>  ReduxFramework::$_url . 'assets/img/2cl.png'
                ),

                'right' =>  array(
                    'alt'   =>  'Sidebar Right',
                    'img'   =>  ReduxFramework::$_url . 'assets/img/2cr.png'
                ),

            ),
        ),

        array(
            'id'        =>  'cosmetics_on_off_share_single',
            'type'      =>  'switch',
            'title'     =>  esc_html__( 'On/Off Share Post Single', 'cosmetics' ),
            'default'   =>  true,
        ),

    )
));
/* End Blog Option */

/* Start Social Network */
Redux::setSection( $cosmetics_opt_name, array(
    'title'             =>  esc_html__( 'Social Network', 'cosmetics' ),
    'id'                =>  'cosmetics_social_network',
    'customizer_width'  =>  '400px',
    'icon'              =>  'el el-globe-alt',
    'fields'            =>  array(
        array(
            'id'        =>  'cosmetics_social_network_facebook',
            'type'      =>  'text',
            'title'     =>  esc_html__( 'Facebook', 'cosmetics' ),
            'default'   =>  '#',
        ),

        array(
            'id'        =>  'cosmetics_social_network_twitter',
            'type'      =>  'text',
            'title'     =>  esc_html__( 'Twitter', 'cosmetics' ),
            'default'   =>  '#',
        ),

        array(
            'id'        =>  'cosmetics_social_network_google-plus',
            'type'      =>  'text',
            'title'     =>  esc_html__( 'Google Plus', 'cosmetics' ),
            'default'   =>  '#',
        ),

        array(
            'id'        =>  'cosmetics_social_network_linkedin',
            'type'      =>  'text',
            'title'     =>  esc_html__( 'Linkedin', 'cosmetics' ),
            'default'   =>  '#',
        ),

        array(
            'id'        =>  'cosmetics_social_network_pinterest',
            'type'      =>  'text',
            'title'     =>  esc_html__( 'Pinterest', 'cosmetics' ),
            'default'   =>  '#',
        ),

        array(
            'id'        =>  'cosmetics_social_network_youtube',
            'type'      =>  'text',
            'title'     =>  esc_html__( 'Youtube', 'cosmetics' ),
            'default'   =>  '#',
        ),

        array(
            'id'        =>  'cosmetics_social_network_instagram',
            'type'      =>  'text',
            'title'     =>  esc_html__( 'Instagram', 'cosmetics' ),
            'default'   =>  '#',
        ),

        array(
            'id'        =>  'cosmetics_social_network_vimeo',
            'type'      =>  'text',
            'title'     =>  esc_html__( 'Vimeo', 'cosmetics' ),
            'default'   =>  '#',
        ),

    )
));
/* End Social Network */

/* Start Shop */
Redux::setSection( $cosmetics_opt_name, array(
    'title'             =>  esc_html__( 'Shop', 'cosmetics' ),
    'id'                =>  'cosmetics_shop_woo',
    'desc'              =>  esc_html__( 'Settings WooCommerce', 'cosmetics' ),
    'customizer_width'  =>  '400px',
    'icon'              =>  'el el-shopping-cart',
    'fields'            =>  array(
        array(
            'id'            =>  'cosmetics_product_limit',
            'type'          =>  'slider',
            'title'         =>  esc_html__( 'Product Limit Page Shop', 'cosmetics' ),
            'min'           =>  1,
            'step'          =>  1,
            'max'           =>  250,
            'default'       =>  12,
            'display_value' => 'text'
        ),

        array(
            'id'        =>  'cosmetics_products_per_row',
            'type'      =>  'select',
            'title'     =>  esc_html__( 'Products Per Row', 'cosmetics' ),
            'default'   =>  4,
            'options'   =>  array(
                3   =>  '3 Column',
                4   =>  '4 Column',
                5   =>  '5 Column',
            )
        ),

        array(
            'id'        =>  'cosmetics_sidebar_woo',
            'type'      =>  'select',
            'title'     =>  esc_html__( 'Position Sidebar Page Shop', 'cosmetics' ),
            'desc'          =>  esc_html__( 'Position Sidebar Page Shop', 'cosmetics' ),
            'default'   =>  'left',
            'options'   =>  array(
                'left'  =>  'Left',
                'right' =>  'Right',
                'hide'  =>  'Hide',
            )
        ),

        array(
            'id'        =>  'cosmetics_sidebar_single_product',
            'type'      =>  'select',
            'title'     =>  esc_html__( 'Position Sidebar Single Product', 'cosmetics' ),
            'desc'          =>  esc_html__( 'Position Sidebar single product', 'cosmetics' ),
            'default'   =>  'right',
            'options'   =>  array(
                'left'  =>  'Left',
                'right' =>  'Right',
                'hide'  =>  'Hide',
            )
        ),

    )
));

Redux::setSection( $cosmetics_opt_name, array(
    'title'         =>  esc_html__( 'Cam kết', 'cosmetics' ),
    'id'            =>  'cosmetics_cam_ket',
    'desc'          =>  esc_html__( '', 'cosmetics' ),
    'subsection'    =>  true,
    'fields'        =>  array(

        array(
            'id'          => 'cosmetics_cam_ket_list',
            'type'        => 'slides',
            'title'       => __('Cam kết của chúng tôi', 'redux-framework-demo'),
            'placeholder' => array(
                'title'           => __('This is a title', 'redux-framework-demo'),
                'description'     => __('Description Here', 'redux-framework-demo'),
            ),
        )

    )
));
/* End Shop */

/* Start Typography Options */
Redux::setSection( $cosmetics_opt_name, array(
    'title'             =>  esc_html__( 'Typography', 'cosmetics' ),
    'id'                =>  'cosmetics_typography',
    'desc'              =>  esc_html__( 'Typography all config', 'cosmetics' ),
    'customizer_width'  =>  '400px',
    'icon'              =>  'el el-fontsize'
));

// Body font
Redux::setSection( $cosmetics_opt_name, array(
    'title'         =>  esc_html__( 'Body Typography', 'cosmetics' ),
    'id'            =>  'cosmetics_body_typography',
    'desc'          =>  esc_html__( '', 'cosmetics' ),
    'subsection'    =>  true,
    'fields'        =>  array(

        array(
            'id'        =>  'cosmetics_body_typography_font',
            'type'      =>  'typography',
            'output'    =>  array( 'body' ),
            'title'     =>  esc_html__( 'Body Font', 'cosmetics' ),
            'subtitle'  =>  esc_html__( 'Specify the body font properties.', 'cosmetics' ),
            'google'    =>  true,
            'default'   =>  array(
                'color'         =>  '',
                'font-size'     =>  '',
                'font-family'   =>  '',
                'font-weight'   =>  '',
            ),
        ),

        array(
            'id'        =>  'cosmetics_link_color',
            'type'      =>  'link_color',
            'output'    =>  array( 'a' ),
            'title'     =>  esc_html__( 'Link Color', 'cosmetics' ),
            'subtitle'  =>  esc_html__( 'Controls the color of all text links.', 'cosmetics' ),
            'default'   =>  ''
        ),
    )
));

// Header font
Redux::setSection( $cosmetics_opt_name, array(
    'title'         =>  esc_html__( 'Custom Typography', 'cosmetics' ),
    'id'            =>  'cosmetics_custom_typography',
    'desc'          =>  esc_html__( '', 'cosmetics' ),
    'subsection'    =>  true,
    'fields'        =>  array(

        array(
            'id'        =>  'cosmetics_custom_typography_1',
            'type'      =>  'typography',
            'title'     =>  esc_html__( 'Custom 1 Typography', 'cosmetics' ),
            'subtitle'  =>  esc_html__( 'These settings control the typography for all Custom 1.', 'cosmetics' ),
            'google'    =>  true,
            'default'   =>  array(
                'font-size'     =>  '',
                'font-family'   =>  '',
                'font-weight'   =>  '',
                'color'         =>  '',
            ),
        ),

        //selector custom typo 1
        array(
            'id'        =>  'cosmetics_custom_typography_1_selector',
            'type'      =>  'textarea',
            'title'     =>  esc_html__( 'Selectors 1', 'cosmetics' ),
            'desc'      =>  esc_html__( 'Import selectors. You can import one or multi selector.Example: #selector1,#selector2,.selector3', 'cosmetics' ),
            'default'   =>  ''
        ),

        array(
            'id'        =>  'cosmetics_custom_typography_2',
            'type'      =>  'typography',
            'title'     =>  esc_html__( 'Custom 2 Typography', 'cosmetics' ),
            'subtitle'  =>  esc_html__( 'These settings control the typography for all Custom 2.', 'cosmetics' ),
            'google'    =>  true,
            'default'   =>  array(
                'font-size'     =>  '',
                'font-family'   =>  '',
                'font-weight'   =>  '',
                'color'         =>  '',
            ),
        ),

        //selector custom typo 2
        array(
            'id'        => 'cosmetics_custom_typography_2_selector',
            'type'      => 'textarea',
            'title'     => esc_html__( 'Selectors 2', 'cosmetics' ),
            'desc'      => esc_html__( 'Import selectors. You can import one or multi selector.Example: #selector1,#selector2,.selector3', 'cosmetics' ),
            'default'   => ''
        ),

        array(
            'id'        =>  'cosmetics_custom_typography_3',
            'type'      =>  'typography',
            'title'     =>  esc_html__( 'Custom 3 Typography', 'cosmetics' ),
            'subtitle'  =>  esc_html__( 'These settings control the typography for all Custom 3.', 'cosmetics' ),
            'google'    =>  true,
            'default'   =>  array(
                'font-size'     =>  '',
                'font-family'   =>  '',
                'font-weight'   =>  '',
                'color'         =>  '',
            ),
            'output'    =>  '',
        ),

        //selector custom typo 3
        array(
            'id'        =>  'cosmetics_custom_typography_3_selector',
            'type'      =>  'textarea',
            'title'     =>  esc_html__( 'Selectors 3', 'cosmetics' ),
            'desc'      =>  esc_html__( 'Import selectors. You can import one or multi selector.Example: #selector1,#selector2,.selector3', 'cosmetics' ),
            'default'   =>  ''
        ),

    )
));

/* End Typography Options */

/* Start 404 Options */
Redux::setSection( $cosmetics_opt_name, array(
    'title'             =>  esc_html__( '404 Options', 'cosmetics' ),
    'id'                =>  'cosmetics_404',
    'desc'              =>  esc_html__( '404 page all config', 'cosmetics' ),
    'customizer_width'  =>  '400px',
    'icon'              =>  'el el-warning-sign',
    'fields'            =>  array(

        array(
            'id'        =>  'cosmetics_404_background',
            'type'      =>  'media',
            'url'       =>  true,
            'title'     =>  esc_html__( '404 Background', 'cosmetics' ),
            'default'   =>  false,
        ),

        array(
            'id'        =>  'cosmetics_404_title',
            'type'      =>  'text',
            'title'     =>  esc_html__( '404 Title', 'cosmetics' ),
            'default'   =>  'Awww...Do Not Cry',
        ),

        array(
            'id'        =>  'cosmetics_404_editor',
            'type'      =>  'editor',
            'title'     =>  esc_html__( '404 Content', 'cosmetics' ),
            'default'   =>  esc_html__( 'It is just a 404 Error! What you are looking for may have been misplaced in Long Term Memory.', 'cosmetics' ),
            'args'          =>  array(
                'wpautop'       => false,
                'media_buttons' => false,
                'textarea_rows' => 5,
                'teeny'         => false,
                'quicktags'     => true,
            )
        ),

    )
));
/* End 404 Options */

/* Start Footer Options */
Redux::setSection( $cosmetics_opt_name, array(
    'title'             =>  esc_html__( 'Footer Options', 'cosmetics' ),
    'id'                =>  'cosmetics_footer',
    'desc'              =>  esc_html__( 'Footer all config', 'cosmetics' ),
    'customizer_width'  =>  '400px',
    'icon'              =>  'el el-arrow-down'
));

// Footer Sidebar Multi Column 1
Redux::setSection( $cosmetics_opt_name, array(
    'title'         =>  esc_html__( 'Sidebar Footer Multi Column', 'cosmetics' ),
    'id'            =>  'cosmetics_footer_sidebar_multi_column_1',
    'subsection'    =>  true,
    'fields'        =>  array(
        array(
            'id'        =>  'cosmetics_footer_multi_column_1',
            'type'      =>  'image_select',
            'title'     =>  esc_html__( 'Number of Footer Columns', 'cosmetics' ),
            'subtitle'  =>  esc_html__( 'Controls the number of columns in the footer', 'cosmetics' ),
            'default'   =>  0,
            'options'   =>  array(
                '0' =>  array(
                    'alt'   =>  'No Footer',
                    'img'   =>  get_theme_file_uri( '/extension/assets/images/no-footer.png' )
                ),

                '1' =>  array(
                    'alt'   =>  '1 Columnn',
                    'img'   =>  get_theme_file_uri(  '/extension/assets/images/1column.png' )
                ),

                '2' =>  array(
                    'alt'   =>  '2 Columnn',
                    'img'   =>  get_theme_file_uri( '/extension/assets/images/2column.png' )
                ),
                '3' =>  array(
                    'alt'   =>  '3 Columnn',
                    'img'   =>  get_theme_file_uri(   '/extension/assets/images/3column.png' )
                ),
                '4' =>  array(
                    'alt'   =>  '4 Columnn',
                    'img'   =>  get_theme_file_uri( '/extension/assets/images/4column.png' )
                ),
            ),
        ),

        array(
            'id'            =>  'cosmetics_footer_multi_column_1_1',
            'type'          =>  'slider',
            'title'         =>  esc_html__( 'Column width 1', 'cosmetics' ),
            'subtitle'      =>  esc_html__( 'Select the number of columns to display in the footer', 'cosmetics' ),
            'desc'          =>  esc_html__( 'Min: 1, max: 12, default value: 1', 'cosmetics' ),
            'default'       =>  1,
            'min'           =>  1,
            'step'          =>  1,
            'max'           =>  12,
            'display_value' =>  'label',
            'required'      =>  array(
                array( 'cosmetics_footer_multi_column_1', 'equals','1', '2', '3', '4' ),
                array( 'cosmetics_footer_multi_column_1', '!=', '0' ),
            )
        ),

        array(
            'id'            =>  'cosmetics_footer_multi_column_1_2',
            'type'          =>  'slider',
            'title'         =>  esc_html__( 'Column width 2', 'cosmetics' ),
            'subtitle'      =>  esc_html__( 'Select the number of columns to display in the footer', 'cosmetics' ),
            'desc'          =>  esc_html__( 'Min: 1, max: 12, default value: 1', 'cosmetics' ),
            'default'       =>  1,
            'min'           =>  1,
            'step'          =>  1,
            'max'           =>  12,
            'display_value' =>  'label',
            'required'      =>  array(
                array( 'cosmetics_footer_multi_column_1', 'equals', '2', '3', '4' ),
                array( 'cosmetics_footer_multi_column_1', '!=', '1' ),
                array( 'cosmetics_footer_multi_column_1', '!=', '0' ),
            )
        ),

        array(
            'id'            =>  'cosmetics_footer_multi_column_1_3',
            'type'          =>  'slider',
            'title'         =>  esc_html__( 'Column width 3', 'cosmetics' ),
            'subtitle'      =>  esc_html__( 'Select the number of columns to display in the footer', 'cosmetics' ),
            'desc'          =>  esc_html__( 'Min: 1, max: 12, default value: 1', 'cosmetics' ),
            'default'       =>  1,
            'min'           =>  1,
            'step'          =>  1,
            'max'           =>  12,
            'display_value' =>  'label',
            'required'      =>  array(
                array( 'cosmetics_footer_multi_column_1', 'equals', '3', '4' ),
                array( 'cosmetics_footer_multi_column_1', '!=', '1' ),
                array( 'cosmetics_footer_multi_column_1', '!=', '2' ),
                array( 'cosmetics_footer_multi_column_1', '!=', '0' ),
            )
        ),

        array(
            'id'            =>  'cosmetics_footer_multi_column_1_4',
            'type'          =>  'slider',
            'title'         =>  esc_html__( 'Column width 4', 'cosmetics' ),
            'subtitle'      =>  esc_html__( 'Select the number of columns to display in the footer', 'cosmetics' ),
            'desc'          =>  esc_html__( 'Min: 1, max: 12, default value: 1', 'cosmetics' ),
            'default'       =>  1,
            'min'           =>  1,
            'step'          =>  1,
            'max'           =>  12,
            'display_value' =>  'label',
            'required'      =>  array(
                array( 'cosmetics_footer_multi_column_1',  'equals', '4' ),
                array( 'cosmetics_footer_multi_column_1', '!=', '1' ),
                array( 'cosmetics_footer_multi_column_1', '!=', '2' ),
                array( 'cosmetics_footer_multi_column_1', '!=', '3' ),
                array( 'cosmetics_footer_multi_column_1', '!=', '0' ),
            )
        ),
    )

));

//Copyright
Redux::setSection( $cosmetics_opt_name, array(
    'title'         =>  esc_html__( 'Copyright', 'cosmetics' ),
    'id'            =>  'cosmetics_footer_copyright',
    'desc'          =>  esc_html__( '', 'cosmetics' ),
    'subsection'    =>  true,
    'fields'        =>  array(
        array(
            'id'            =>  'cosmetics_footer_copyright_editor',
            'type'          =>  'editor',
            'title'         =>  esc_html__( 'Enter content copyright', 'cosmetics' ),
            'full_width'    =>  true,
            'default'       =>  'Copyright &amp; DiepLK',
            'args'          =>  array(
                'wpautop'       => false,
                'media_buttons' => false,
                'textarea_rows' => 5,
                'teeny'         => false,
                'quicktags'     => true,
            )
        ),
    )
));

//Copyright
Redux::setSection( $cosmetics_opt_name, array(
    'title'         =>  esc_html__( 'Footer Scripts', 'cosmetics' ),
    'id'            =>  'cosmetics_footer_scripts',
    'subsection'    =>  true,
    'fields'        =>  array(
        array(
            'id'    =>  'cosmetics_footer_scripts_editor',
            'type'  =>  'ace_editor',
            'title' =>  esc_html__( 'Footer Scripts', 'cosmetics' ),
            'mode'  =>  'javascript'
        ),
    )
));

/* End Footer Options */


/*
 * <--- END SECTIONS
 */

// Function to test the compiler hook and demo CSS output.
add_filter('redux/options/' . $cosmetics_opt_name . '/compiler', 'compiler_action', 10, 3);

/**
 * This is a test function that will let you see when the compiler hook occurs.
 * It only runs if a field    set with compiler=>true is changed.
 * */
if ( ! function_exists( 'compiler_action' ) ) {
    function compiler_action( $options, $css, $changed_values ) {
        echo '<h1>The compiler hook has run!</h1>';
        echo "<pre>";
        print_r( $changed_values ); // Values that have changed since the last save
        echo "</pre>";
        print_r($options); //Option values
        print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
    }
}
