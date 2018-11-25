<?php
global $cosmetics_options;

$cosmetics_information_show_hide = $cosmetics_options['cosmetics_information_show_hide'] == '' ? 1 : $cosmetics_options['cosmetics_information_show_hide'];
?>

<header id="home" class="header">
    <nav id="navigation" class="navbar-expand-lg">

        <?php
        if ( $cosmetics_information_show_hide == 1 ) :
            get_template_part( 'template-parts/header/inc', 'information' );
        endif;

        get_template_part( 'template-parts/header/inc', 'logo' );

        get_template_part( 'template-parts/header/inc', 'menu' );
        ?>

    </nav>
</header>