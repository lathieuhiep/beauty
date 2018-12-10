<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/*
 *constants
 */
if( !function_exists('cosmetics_setup') ):

    function cosmetics_setup() {

        /**
         * Set the content width based on the theme's design and stylesheet.
         */
        global $content_width;
        if ( ! isset( $content_width ) )
            $content_width = 900;

        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         */
        load_theme_textdomain( 'cosmetics', get_parent_theme_file_path( '/languages' ) );

        /**
         * Set up theme defaults and registers support for various WordPress features.
         *
         * Note that this function is hooked into the after_setup_theme hook, which
         * runs before the init hook. The init hook is too late for some features, such
         * as indicating support post thumbnails.
         *
         */
        add_theme_support( 'custom-header' );

        add_theme_support( 'custom-background' );

        //Enable support for Post Thumbnails
        add_theme_support('post-thumbnails');

        // Add RSS feed links to <head> for posts and comments.
        add_theme_support( 'automatic-feed-links' );

        // This theme uses wp_nav_menu() in two locations.
        register_nav_menus(
            array(
                'primary'       =>  esc_html__( 'Primary Menu', 'cosmetics' ),
                'menu-icon'     =>  esc_html__( 'Menu Icon', 'cosmetics' ),
                'footer-menu'   =>  esc_html__( 'Footer Menu', 'cosmetics' ),
            )
        );

        // add theme support title-tag
        add_theme_support( 'title-tag' );

        /*  Post Type   */
        add_theme_support( 'post-formats', array( 'gallery', 'video', 'audio' ) );

        /*
	    * This theme styles the visual editor to resemble the theme style,
	    * specifically font, colors, icons, and column width.
	    */
        add_editor_style( array( 'css/editor-style.css', cosmetics_fonts_url()) );
    }

    add_action( 'after_setup_theme', 'cosmetics_setup' );

endif;

/*
 * post formats
 * */
function cosmetics_post_formats() {

    if( has_post_format('audio') || has_post_format('video') ):
        get_template_part( 'template-parts/post/content','video' );
    elseif ( has_post_format('gallery') ):
        get_template_part( 'template-parts/post/content','gallery' );
    else:
        get_template_part( 'template-parts/post/content','image' );
    endif;

}

/*
* Required: include plugin theme scripts
*/
require get_parent_theme_file_path( '/extension/process-option.php' );

if ( class_exists( 'ReduxFramework' ) ) {
    /*
     * Required: Redux Framework
     */
    require get_parent_theme_file_path( '/extension/option-reudx/theme-options.php' );
}

if ( class_exists( 'RW_Meta_Box' ) ) {
    /*
     * Required: Meta Box Framework
     */
    require get_parent_theme_file_path( '/extension/meta-box/meta-box-options.php' );
}

if ( ! function_exists( 'rwmb_meta' ) ) {
    function rwmb_meta( $key, $args = '', $post_id = null ) {
        return false;
    }
}

/*
* Required: Meta Box CMB2
*/
//require get_parent_theme_file_path( '/extension/meta-box/meta-box-cmb2-options.php' );

if ( did_action( 'elementor/loaded' ) ) :
    /*
     * Required: Elementor
     */
    require get_parent_theme_file_path( '/extension/elementor/elementor.php' );
    require get_parent_theme_file_path( '/extension/elementor/function-elementor.php' );

endif;

/* Require Widgets */
foreach(glob( get_parent_theme_file_path( '/extension/widgets/*.php' ) ) as $cosmetics_file_widgets ) {
    require $cosmetics_file_widgets;
}

if ( class_exists('Woocommerce') ) :
    /*
     * Required: Woocommerce
     */
    require get_parent_theme_file_path( '/extension/woocommerce/woo-tax.php' );
    require get_parent_theme_file_path( '/extension/woocommerce/woo-template-hooks.php' );
    require get_parent_theme_file_path( '/extension/woocommerce/woo-template-functions.php' );

endif;

/**
 * Register Sidebar
 */
add_action( 'widgets_init', 'cosmetics_widgets_init');

function cosmetics_widgets_init() {

        register_sidebar( array(
            'name'          =>  esc_html__( 'Sidebar Main', 'cosmetics' ),
            'id'            =>  'cosmetics-sidebar-main',
            'description'   =>  esc_html__( 'Display sidebar right or left on all page.', 'cosmetics' ),
            'before_widget' =>  '<section id="%1$s" class="widget %2$s">',
            'after_widget'  =>  '</section>',
            'before_title'  =>  '<h2 class="widget-title">',
            'after_title'   =>  '</h2>'
        ));

         register_sidebar( array(
             'name'          =>  esc_html__( 'Sidebar Woocommerce', 'cosmetics' ),
             'id'            =>  'cosmetics-sidebar-wc',
             'description'   =>  esc_html__( 'Display sidebar on page shop.', 'cosmetics' ),
             'before_widget' =>  '<section id="%1$s" class="widget %2$s">',
             'after_widget'  =>  '</section>',
             'before_title'  =>  '<h2 class="widget-title">',
             'after_title'   =>  '</h2>'
         ));

        register_sidebar( array(
            'name'          =>  esc_html__( 'Sidebar Single Woocommerce', 'cosmetics' ),
            'id'            =>  'cosmetics-sidebar-single-wc',
            'description'   =>  esc_html__( 'Display sidebar on page shop single.', 'cosmetics' ),
            'before_widget' =>  '<section id="%1$s" class="widget %2$s">',
            'after_widget'  =>  '</section>',
            'before_title'  =>  '<h2 class="widget-title">',
            'after_title'   =>  '</h2>'
        ));

        register_sidebar( array(
            'name'          =>  esc_html__( 'Sidebar Footer Multi Column 1-1', 'cosmetics' ),
            'id'            =>  'cosmetics-sidebar-footer-multi-column-1-1',
            'description'   =>  esc_html__( 'Display footer column 1 on all page.', 'cosmetics' ),
            'before_widget' =>  '<section id="%1$s" class="widget %2$s">',
            'after_widget'  =>  '</section>',
            'before_title'  =>  '<p class="widget-title">',
            'after_title'   =>  '</p>'
        ));

        register_sidebar( array(
            'name'          =>  esc_html__( 'Sidebar Footer Multi Column 1-2', 'cosmetics' ),
            'id'            =>  'cosmetics-sidebar-footer-multi-column-1-2',
            'description'   =>  esc_html__( 'Display footer column 2 on all page.', 'cosmetics' ),
            'before_widget' =>  '<section id="%1$s" class="widget %2$s">',
            'after_widget'  =>  '</section>',
            'before_title'  =>  '<p class="widget-title">',
            'after_title'   =>  '</p>'
        ));

        register_sidebar( array(
            'name'          =>  esc_html__( 'Sidebar Footer Multi Column 1-3', 'cosmetics' ),
            'id'            =>  'cosmetics-sidebar-footer-multi-column-1-3',
            'description'   =>  esc_html__( 'Display footer column 3 on all page.', 'cosmetics' ),
            'before_widget' =>  '<section id="%1$s" class="widget %2$s">',
            'after_widget'  =>  '</section>',
            'before_title'  =>  '<p class="widget-title">',
            'after_title'   =>  '</p>'
        ));

        register_sidebar( array(
            'name'          =>  esc_html__( 'Sidebar Footer Multi Column 1-4', 'cosmetics' ),
            'id'            =>  'cosmetics-sidebar-footer-multi-column-1-4',
            'description'   =>  esc_html__( 'Display footer column 4 on all page.', 'cosmetics' ),
            'before_widget' =>  '<section id="%1$s" class="widget %2$s">',
            'after_widget'  =>  '</section>',
            'before_title'  =>  '<p class="widget-title">',
            'after_title'   =>  '</p>'
        ));

        register_sidebar( array(
            'name'          =>  esc_html__( 'Sidebar Footer Multi Column 2-1', 'cosmetics' ),
            'id'            =>  'cosmetics-sidebar-footer-multi-column-2-1',
            'description'   =>  esc_html__( 'Display footer column 2-1 on all page.', 'cosmetics' ),
            'before_widget' =>  '<section id="%1$s" class="widget %2$s">',
            'after_widget'  =>  '</section>',
            'before_title'  =>  '<p class="widget-title">',
            'after_title'   =>  '</p>'
        ));

        register_sidebar( array(
            'name'          =>  esc_html__( 'Sidebar Footer Multi Column 2-2', 'cosmetics' ),
            'id'            =>  'cosmetics-sidebar-footer-multi-column-2-2',
            'description'   =>  esc_html__( 'Display footer column 2-2 on all page.', 'cosmetics' ),
            'before_widget' =>  '<section id="%1$s" class="widget %2$s">',
            'after_widget'  =>  '</section>',
            'before_title'  =>  '<p class="widget-title">',
            'after_title'   =>  '</p>'
        ));

        register_sidebar( array(
            'name'          =>  esc_html__( 'Sidebar Footer Multi Column 2-3', 'cosmetics' ),
            'id'            =>  'cosmetics-sidebar-footer-multi-column-2-3',
            'description'   =>  esc_html__( 'Display footer column 2-3 on all page.', 'cosmetics' ),
            'before_widget' =>  '<section id="%1$s" class="widget %2$s">',
            'after_widget'  =>  '</section>',
            'before_title'  =>  '<p class="widget-title">',
            'after_title'   =>  '</p>'
        ));

        register_sidebar( array(
            'name'          =>  esc_html__( 'Sidebar Footer Multi Column 2-4', 'cosmetics' ),
            'id'            =>  'cosmetics-sidebar-footer-multi-column-2-4',
            'description'   =>  esc_html__( 'Display footer column 2-4 on all page.', 'cosmetics' ),
            'before_widget' =>  '<section id="%1$s" class="widget %2$s">',
            'after_widget'  =>  '</section>',
            'before_title'  =>  '<p class="widget-title">',
            'after_title'   =>  '</p>'
        ));

}

// Remove jquery migrate
add_action( 'wp_default_scripts', 'cosmetics_remove_jquery_migrate' );
function cosmetics_remove_jquery_migrate( $scripts ) {
    if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
        $script = $scripts->registered['jquery'];
        if ( $script->deps ) {
            $script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
        }
    }
}

// Check deregister styles
add_action( 'wp_print_styles', 'logi_deregister_styles', 100 );
function logi_deregister_styles() {

    wp_deregister_style('font-awesome');

}

//Register Back-End script
add_action('admin_enqueue_scripts', 'cosmetics_register_back_end_scripts');

function cosmetics_register_back_end_scripts(){

    /* Start Get CSS Admin */
    wp_enqueue_style( 'cosmetics-admin-styles', get_theme_file_uri( '/extension/assets/css/admin-styles.css' ) );

}

//Register Front-End Styles
add_action('wp_enqueue_scripts', 'cosmetics_register_front_end');

function cosmetics_register_front_end() {

    /*
    * Start Get Css Front End
    * */
    wp_enqueue_style( 'cosmetics-fonts', cosmetics_fonts_url(), array(), null );

    /* Start main Css */
    wp_enqueue_style( 'cosmetics-library', get_theme_file_uri( '/css/library.min.css' ), array(), '' );
    /* End main Css */

//    wp_enqueue_style( 'hungkv', get_theme_file_uri( '/css/hungkv.css' ), array(), '' );

    /*  Start Style Css   */
    wp_enqueue_style( 'cosmetics-style', get_stylesheet_uri() );
    /*  Start Style Css   */

    /*
    * End Get Css Front End
    * */


    /*
    * Start Get Js Front End
    * */

    // Load the html5 shiv.
    wp_enqueue_script( 'html5', get_theme_file_uri( '/js/html5.js' ), array(), '3.7.3' );
    wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

    wp_enqueue_script( 'cosmetics-main', get_theme_file_uri( '/js/main.min.js' ), array('jquery'), '', true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    wp_register_script( 'jquery-countdown', get_theme_file_uri( '/js/library/jquery.countdown.min.js' ), array(), '2.2.0', true );

    wp_enqueue_script( 'cosmetics-custom', get_theme_file_uri( '/js/custom.js' ), array(), '1.0.0', true );

    /*
   * End Get Js Front End
   * */

}

/**
 * Show full editor
 */
if ( !function_exists('cosmetics_ilc_mce_buttons') ) :

    function cosmetics_ilc_mce_buttons( $cosmetics_buttons_TinyMCE ) {

        array_push( $cosmetics_buttons_TinyMCE,
                "backcolor",
                "anchor",
                "hr",
                "sub",
                "sup",
                "fontselect",
                "fontsizeselect",
                "styleselect",
                "cleanup"
            );

        return $cosmetics_buttons_TinyMCE;

    }

    add_filter("mce_buttons_2", "cosmetics_ilc_mce_buttons");

endif;

// Start Customize mce editor font sizes
if ( ! function_exists( 'cosmetics_mce_text_sizes' ) ) :

    function cosmetics_mce_text_sizes( $cosmetics_font_size_text ){
        $cosmetics_font_size_text['fontsize_formats'] = "9px 10px 12px 13px 14px 16px 17px 18px 19px 20px 21px 24px 28px 32px 36px";
        return $cosmetics_font_size_text;
    }

    add_filter( 'tiny_mce_before_init', 'cosmetics_mce_text_sizes' );

endif;
// End Customize mce editor font sizes

/* Start callback comment list */
function cosmetics_comments( $cosmetics_comment, $cosmetics_comment_args, $cosmetics_comment_depth ) {

    if ( 'div' === $cosmetics_comment_args['style'] ) :

        $cosmetics_comment_tag       = 'div';
        $cosmetics_comment_add_below = 'comment';

    else :

        $cosmetics_comment_tag       = 'li';
        $cosmetics_comment_add_below = 'div-comment';

    endif;

?>
    <<?php echo $cosmetics_comment_tag ?> <?php comment_class( empty( $cosmetics_comment_args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">

    <?php if ( 'div' != $cosmetics_comment_args['style'] ) : ?>

        <div id="div-comment-<?php comment_ID() ?>" class="comment-body">

    <?php endif; ?>

    <div class="comment-author vcard">
        <?php if ( $cosmetics_comment_args['avatar_size'] != 0 ) echo get_avatar( $cosmetics_comment, $cosmetics_comment_args['avatar_size'] ); ?>

    </div>

    <?php if ( $cosmetics_comment->comment_approved == '0' ) : ?>
        <em class="comment-awaiting-moderation">
            <?php esc_html_e( 'Your comment is awaiting moderation.', 'cosmetics' ); ?>
        </em>
    <?php endif; ?>

    <div class="comment-meta commentmetadata">
        <div class="comment-meta-box">
             <span class="name">
                <?php comment_author_link(); ?>
            </span>
            <span class="comment-metadata">
                <?php comment_date(); ?>
            </span>

            <?php edit_comment_link( esc_html__( 'Edit ', 'cosmetics' ) ); ?>

            <?php comment_reply_link( array_merge( $cosmetics_comment_args, array( 'add_below' => $cosmetics_comment_add_below, 'depth' => $cosmetics_comment_depth, 'max_depth' => $cosmetics_comment_args['max_depth'] ) ) ); ?>

        </div>
        <div class="comment-text-box">
            <?php comment_text(); ?>
        </div>
    </div>

    <?php if ( 'div' != $cosmetics_comment_args['style'] ) : ?>
        </div>
    <?php endif; ?>

<?php
}
/* End callback comment list */

/* Font Google */
if ( ! function_exists( 'cosmetics_fonts_url' ) ) :

    function cosmetics_fonts_url() {
        $cosmetics_fonts_url = '';

        /* Translators: If there are characters in your language that are not
        * supported by Open Sans, translate this to 'off'. Do not translate
        * into your own language.
        */
        $cosmetics_font_google = _x( 'on', 'Google font: on or off', 'cosmetics' );

        if ( 'off' !== $cosmetics_font_google ) {
            $cosmetics_font_families = array();

            if ( 'off' !== $cosmetics_font_google ) {
                $cosmetics_font_families[] = 'Roboto:400,500,700';
            }

            $cosmetics_query_args = array(
                'family' => urlencode( implode( '|', $cosmetics_font_families ) ),
                'subset' => urlencode( 'latin,vietnamese' ),
            );

            $cosmetics_fonts_url = add_query_arg( $cosmetics_query_args, 'https://fonts.googleapis.com/css' );
        }

        return esc_url_raw( $cosmetics_fonts_url );
    }

endif;

/*
 * Content Nav
 */

if ( ! function_exists( 'cosmetics_comment_nav' ) ) :

    function cosmetics_comment_nav() {
        // Are there comments to navigate through?
        if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :

    ?>
            <nav class="navigation comment-navigation">
                <h2 class="screen-reader-text">
                    <?php _e( 'Comment navigation', 'cosmetics' ); ?>
                </h2>
                <div class="nav-links">
                    <?php
                    if ( $prev_link = get_previous_comments_link( esc_html__( 'Older Comments', 'cosmetics' ) ) ) :
                        printf( '<div class="nav-previous">%s</div>', $prev_link );
                    endif;

                    if ( $next_link = get_next_comments_link( esc_html__( 'Newer Comments', 'cosmetics' ) ) ) :
                        printf( '<div class="nav-next">%s</div>', $next_link );
                    endif;
                    ?>
                </div><!-- .nav-links -->
            </nav><!-- .comment-navigation -->

    <?php
        endif;
    }

endif;

/*
 * TWITTER AMPERSAND ENTITY DECODE
 */
if( ! function_exists( 'cosmetics_social_title' )):

    function cosmetics_social_title( $cosmetics_title ) {

        $cosmetics_title = html_entity_decode( $cosmetics_title );
        $cosmetics_title = urlencode( $cosmetics_title );

        return $cosmetics_title;

    }

endif;

/**
 * Include the TGM_Plugin_Activation class.
 */
require get_parent_theme_file_path( '/plugins/class-tgm-plugin-activation.php' );

add_action( 'tgmpa_register', 'cosmetics_register_required_plugins' );
function cosmetics_register_required_plugins() {

    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $cosmetics_plugins = array(

        // This is an example of how to include a plugin from the WordPress Plugin Repository
        array(
            'name'      =>  'Redux Framework',
            'slug'      =>  'redux-framework',
            'required'  =>  true,
        ),

        // This is an example of how to include a plugin from the WordPress Plugin Repository
        array(
            'name'      =>  'Meta Box',
            'slug'      =>  'meta-box',
            'required'  =>  true,
        ),

        // This is an example of how to include a plugin from the WordPress Plugin Repository
        array(
            'name'      =>  'CMB2',
            'slug'      =>  'cmb2',
            'required'  =>  true,
        ),

        // This is an example of how to include a plugin from the WordPress Plugin Repository
        array(
            'name'      =>  'Elementor',
            'slug'      =>  'elementor',
            'required'  =>  true,
        ),

        // This is an example of how to include a plugin from the WordPress Plugin Repository
        array(
            'name'      =>  'Woocommerce',
            'slug'      =>  'woocommerce',
            'required'  =>  true,
        ),

    );

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $cosmetics_config = array(
        'id'           => 'cosmetics',          // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'parent_slug'  => 'themes.php',            // Parent menu slug.
        'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
    );

    tgmpa( $cosmetics_plugins, $cosmetics_config );
}

/* Start Social Network */
function cosmetics_get_social_url() {

    global $cosmetics_options;
    $cosmetics_social_networks = cosmetics_get_social_network();

    foreach( $cosmetics_social_networks as $cosmetics_social ) :
        $cosmetics_social_url = $cosmetics_options['cosmetics_social_network_' . $cosmetics_social['id']];

        if( $cosmetics_social_url ) :
?>

        <div class="social-network-item item-<?php echo esc_attr( $cosmetics_social['id'] ); ?>">
            <a href="<?php echo esc_url( $cosmetics_social_url ); ?>">
                <i class="fa fa-<?php echo esc_attr( $cosmetics_social['id'] ); ?>" aria-hidden="true"></i>
            </a>
        </div>


<?php
        endif;

    endforeach;
}

function cosmetics_get_social_network() {
    return array(

        array('id' => 'facebook', 'title' => 'Facebook'),
        array('id' => 'twitter', 'title' => 'Twitter'),
        array('id' => 'google-plus', 'title' => 'Google Plus'),
        array('id' => 'linkedin', 'title' => 'linkedin'),
        array('id' => 'pinterest', 'title' => 'Pinterest'),
        array('id' => 'youtube', 'title' => 'Youtube'),
        array('id' => 'instagram', 'title' => 'instagram'),
        array('id' => 'vimeo', 'title' => 'Vimeo'),

    );
}
/* End Social Network */

/* Start pagination */
function cosmetics_pagination() {

    the_posts_pagination( array(
        'type' => 'list',
        'mid_size' => 2,
        'prev_text' => esc_html__( 'Previous', 'cosmetics' ),
        'next_text' => esc_html__( 'Next', 'cosmetics' ),
        'screen_reader_text' => esc_html__( '&nbsp;', 'cosmetics' ),
    ) );

}

// pagination nav query
function cosmetics_paging_nav_query( $cosmetics_querry ) {

    $cosmetics_pagination_args  =   array(

        'prev_text' => '<i class="fa fa-angle-double-left"></i>' . esc_html__(' Previous', 'cosmetics' ),
        'next_text' => esc_html__('Next', 'cosmetics' ) . '<i class="fa fa-angle-double-right"></i>',
        'current'   => max( 1, get_query_var('paged') ),
        'total'     => $cosmetics_querry -> max_num_pages,
        'type'      => 'list',

    );

    $cosmetics_paginate_links = paginate_links( $cosmetics_pagination_args );

    if ( $cosmetics_paginate_links ) :

    ?>
        <nav class="pagination">

            <?php echo $cosmetics_paginate_links; ?>

        </nav>

    <?php

    endif;

}

/* End pagination */

// Sanitize Pagination
add_action('navigation_markup_template', 'cosmetics_sanitize_pagination');
function cosmetics_sanitize_pagination( $cosmetics_content ) {
    // Remove role attribute
    $cosmetics_content = str_replace('role="navigation"', '', $cosmetics_content);

    // Remove h2 tag
    $cosmetics_content = preg_replace('#<h2.*?>(.*?)<\/h2>#si', '', $cosmetics_content);

    return $cosmetics_content;
}

/* Start Get col global */
function cosmetics_col_use_sidebar( $option_sidebar, $active_sidebar ) {

    if ( $option_sidebar != 'hide' && is_active_sidebar( $active_sidebar ) ):
        $class_col_content = 'col-12 col-md-8 col-lg-9';
    else:
        $class_col_content = 'col-md-12';
    endif;

    return $class_col_content;
}

function cosmetics_col_sidebar() {
    $class_col_sidebar = 'col-12 col-md-4 col-lg-3';

    return $class_col_sidebar;
}
/* End Get col global */

/* Start Post Meta */
    function cosmetics_post_meta() {
?>

        <div class="site-post-meta">
            <span class="site-post-author">
                <?php echo esc_html__('Author:','cosmetics');?>
                <a href="<?php echo get_author_posts_url( get_the_author_meta('ID') );?>">
                    <?php the_author();?>
                </a>
            </span>

            <span class="site-post-date">
                <?php esc_html_e( 'Post date: ','cosmetics' ); the_date(); ?>
            </span>

            <span class="site-post-comments">
                <?php
                comments_popup_link( '0 '. esc_html__('Comment','cosmetics'),'1 '. esc_html__('Comment','cosmetics'), '% '. esc_html__('Comments','cosmetics') );
                ?>
            </span>
        </div>

<?php
    }
/* End Post Meta */

/* Start Link Pages */
function cosmetics_link_page() {

    wp_link_pages( array(
        'before'      => '<div class="page-links">' . __( 'Pages:', 'cosmetics' ),
        'after'       => '</div>',
        'link_before' => '<span class="page-number">',
        'link_after'  => '</span>',
    ) );

}
/* End Link Pages */

/* Start comment */
function cosmetics_comment_form() {

    if ( comments_open() || get_comments_number() ) :
?>

        <div class="site-comments">
            <?php comments_template( '', true ); ?>
        </div>

<?php
    endif;
}
/* End comment */
