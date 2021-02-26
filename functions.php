<?php

add_action( 'wp_enqueue_scripts', 'enqueue_universal_theme' );
function enqueue_universal_theme() {
	wp_enqueue_style( 'style', get_stylesheet_uri() );
    wp_enqueue_style( 'universal-theme', get_template_directory_uri() . '/essets/css/universal-theme.css', 'style', null, null );

}