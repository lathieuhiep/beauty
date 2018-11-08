<?php
    /*
     * Method process option
     * # option 1: config font
     * # option 2: process config theme
    */
    if( !is_admin() ):

        add_action('wp_head','beauty_config_theme');

        function beauty_config_theme() {

            if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) :

                    global $beauty_options;
                    $beauty_favicon = $beauty_options['beauty_favicon_upload']['url'];

                    if( $beauty_favicon != '' ) :

                        echo '<link rel="shortcut icon" href="' . esc_url($beauty_favicon) . '" type="image/x-icon" />';

                    endif;

            endif;
        }

        // Method add custom css, Css custom add here
        // Inline css add here
        /**
         * Enqueues front-end CSS for the custom css.
         *
         * @see wp_add_inline_style()
         */

        add_action( 'wp_enqueue_scripts', 'beauty_custom_css', 99 );

        function beauty_custom_css() {

            global $beauty_options;

            $beauty_typo_selecter_1   =   $beauty_options['beauty_custom_typography_1_selector'];

            $beauty_typo1_font_family   =   $beauty_options['beauty_custom_typography_1']['font-family'] == '' ? '' : $beauty_options['beauty_custom_typography_1']['font-family'];

            $beauty_css_style = '';

            if ( $beauty_typo1_font_family != '' ) :
                $beauty_css_style .= ' '.esc_attr( $beauty_typo_selecter_1 ).' { font-family: '.balanceTags( $beauty_typo1_font_family, true ).' }';
            endif;

            if ( $beauty_css_style != '' ) :
                wp_add_inline_style( 'beauty-style', $beauty_css_style );
            endif;

        }

    endif;
