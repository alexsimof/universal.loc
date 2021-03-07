<?php
//   Добавляем расширенные возможности
if ( ! function_exists( 'universal_theme_setup' ) ) :

    function universal_theme_setup() {
        // title-tag
        add_theme_support( 'title-tag' );

        // Миниатюры
        add_theme_support( 'post-thumbnails', array( 'post' ) );

        // logo
        add_theme_support( 'custom-logo', [
            'width'      => 163,
            'flex-height' => true,
            'header-text' => 'Universal',
            'unlink-homepage-logo' => true, // WP 5.5
        ] );
        // menu
        register_nav_menus( [
            'header_menu' => 'Меню в шапке',
            'footer_menu' => 'Меню в подвале'
        ] );

    }
endif;
add_action( 'after_setup_theme', 'universal_theme_setup' );


// Подключение стилей и скиптов
function enqueue_universal_theme() {
    wp_enqueue_style( 'style', get_stylesheet_uri() );
    wp_enqueue_style( 'universal-theme', get_template_directory_uri() . '/assets/css/universal-theme.css', 'style');
    wp_enqueue_style( 'Roboto-Slab', 'https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@700&display=swap');

}
add_action( 'wp_enqueue_scripts', 'enqueue_universal_theme' );

## отключаем создание миниатюр файлов для указанных размеров
add_filter( 'intermediate_image_sizes', 'delete_intermediate_image_sizes' );
function delete_intermediate_image_sizes( $sizes ){
	// размеры которые нужно удалить
	return array_diff( $sizes, [
		'medium_large',
		'large',
		'1536x1536',
		'2048x2048',
	] );
}
//    Регестрируем миниатюру
if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'article-thumb', 65, 65, true ); // Кадрирование изображения
}