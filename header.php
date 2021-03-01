<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Universal</title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="header">
    <div class="container">
        <div class="header-wrapper">
            <?php
                if( has_custom_logo() ){
                    // логотип есть выводим его
                    the_custom_logo();
                } else {
                    echo 'Universal';
                }
            
                wp_nav_menu( [
                    'theme_location'  => 'header_menu',
                    'container'       => 'nav',
                    'container_class' => 'header-nav',
                    'menu_class'      => 'header-menu', 
                    'echo'            => true,

                ] );
                // Поиск
                get_search_form();
            ?>
            
        </div>


    </div>
</header>