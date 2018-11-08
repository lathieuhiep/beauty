<?php
    /*
     * Method process option
     * # option 1: config font
     * # option 2: process config theme
    */
    if( !is_admin() ):

        add_action('wp_head','cosmetics_config_theme');

        function cosmetics_config_theme() {

            if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) :

                    global $cosmetics_options;
                    $cosmetics_favicon = $cosmetics_options['cosmetics_favicon_upload']['url'];

                    if( $cosmetics_favicon != '' ) :

                        echo '<link rel="shortcut icon" href="' . esc_url($cosmetics_favicon) . '" type="image/x-icon" />';

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

        add_action( 'wp_enqueue_scripts', 'cosmetics_custom_css', 99 );

        function cosmetics_custom_css() {

            global $cosmetics_options;

            $cosmetics_typo_selecter_1   =   $cosmetics_options['cosmetics_custom_typography_1_selector'];

            $cosmetics_typo1_font_family   =   $cosmetics_options['cosmetics_custom_typography_1']['font-family'] == '' ? '' : $cosmetics_options['cosmetics_custom_typography_1']['font-family'];

            $cosmetics_css_style = '';

            if ( $cosmetics_typo1_font_family != '' ) :
                $cosmetics_css_style .= ' '.esc_attr( $cosmetics_typo_selecter_1 ).' { font-family: '.balanceTags( $cosmetics_typo1_font_family, true ).' }';
            endif;

            if ( $cosmetics_css_style != '' ) :
                wp_add_inline_style( 'cosmetics-style', $cosmetics_css_style );
            endif;

        }

    endif;
